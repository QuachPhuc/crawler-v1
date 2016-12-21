<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Yangqi\Htmldom\Htmldom;

/**
 * Class CrawlToolController
 * @package App\Http\Controllers\Admin
 */
class CrawlToolController extends Controller
{

    /**
     * show tool craweler
     */
    public function index() {

        $tables = $this->getTables();
        $settings = $this->getSetting();
        $model = new Product();
        return view('protected.admin.tool.create', compact('tables', 'model', 'settings'));
    }

    /**
     * @return array
     */
    public function getTables() {
        $tables = DB::select('SHOW TABLES');
        $tableList = array("" => "select one");
        foreach($tables as $tab) {
            $tableList[$tab->Tables_in_buy_theme] = $tab->Tables_in_buy_theme;
        }

        return $tableList;
    }

    /**
     * @return array
     */
    public function getSetting() {
        $orders = Order::all();
        $orderList = array("" => "select one");
        foreach($orders as $od) {
            $orderList[$od->id] = $od->name;
        }

        return $orderList;
    }

    /**
     * add form setting
     */
    public function addFormSetting(Request $request) {
        $id = $request->id;
        $arrElm = explode('_', $id);
        $margin = count($arrElm);
        return view('protected.admin.tool.form-setting', compact('id', 'margin'));
    }

    /**
     * get table field
     */
    public function getTableField(Request $request) {
        $tableName = $request->tableName;
        $columns = Schema::getColumnListing($tableName);
        $fields = array("" => "select one");
        foreach($columns as $col) {
            $fields[$col] = $col;
        }

        return view('protected.admin.tool.select-box', compact('fields'));
    }

    /**
     * @param Request $request
     */
    public function store(Request $request) {
        $table = $request->table;
        $url = $request->url;
        $tags = $request->tags;
        $htmls = $request->htmls;
        $hid_fields = $request->hid_fields;
        $depths = $request->depths;
        $types = $request->types;
        $data = array();
        $arrDepths = $this->divDepth($depths);

        // Start clone content
        $page = new Htmldom($url);

        foreach($arrDepths as $depth) {
            $data = $this->lastValue($data, $page, $depth, $tags, $htmls, $types, $hid_fields, 0);
        }

        dd($data);
    }

    /**
     * @param $data
     * @param $page
     * @param $depths
     * @param $tags
     * @param $htmls
     * @param $types
     * @param $hid_fields
     * @param int $count
     * @return mixed
     */
    public function lastValue($data, $page, $depths, $tags, $htmls, $types, $hid_fields, $count) {
        $length = count($depths);
        $tag = $htmls[$depths[$count]] != "" ? $tags[$depths[$count]] . '[' . $htmls[$depths[$count]] . ']' : $tags[$depths[$count]];
        $type = $count > 0 ? $types[$depths[$count]] : '';
        $hid_field = $count > 0 ? $hid_fields[$depths[$count]] : '';

        foreach ($page->find($tag) as $item) {
            if($type == '1') {
                // get text
                $data[$hid_field][] = $item->plaintext;
            }

            if($type == '2') {
                //upload image
                $data[$hid_field][] = $item->src;
            }

            if($type == '3') {
                //get link
                $data[$hid_field][] = $item->href;
            }

            if($count < $length - 1) {
                $count ++;
                $data = $this->lastValue($data, $item, $depths, $tags, $htmls, $types, $hid_fields, $count);
                $count --;
            }
        }

        return $data;
    }

    /**
     * @param $depths
     * @return array
     */
    public function divDepth($depths) {
        $arrDepths = array();
        $parentKey = 0;
        $count = 0;
        foreach($depths as $key => $depth) {
            $arrTmp = explode('_', $depth);
            if(count($arrTmp) > $count) {
                $arrDepths[$parentKey][] = $depth;
                $count = count($arrTmp);
            } else {
                $parentKey ++;
                for($i = 0; $i< count($arrTmp) - 1; $i ++) {
                    $arrDepths[$parentKey][] = $depths[$i];
                }
                $arrDepths[$parentKey][] = $depth;
                $count = count($arrTmp);
            }
        }
        return $arrDepths;
    }

    /**
     * @param Request $request
     */
    public function saveSetting(Request $request) {
        $data = $request->data;
        $table = $data['tables'];
        $url = $data['url'];
        $sName = $data['sName'];
        $setting = $data['setting'];

        $tags = array();
        $htmls = array();
        $types = array();
        $depths = array();
        $hid_fields = array();

        //unset data not an array
        unset($data['_token']);
        unset($data['tables']);
        unset($data['url']);
        unset($data['sName']);
        unset($data['setting']);

        // convert data for each array
        foreach ($data as $key => $item) {
            $arrExplodeKey = explode('[', $key);
            if(count($arrExplodeKey) <= 1) {
                continue;
            }
            $arrExplodeValue = explode(']', $arrExplodeKey[1]);
            switch($arrExplodeKey[0]) {
                case 'tags' :
                    $tags[$arrExplodeValue[0]] = $item;
                    break;

                case 'htmls' :
                    $htmls[$arrExplodeValue[0]] = $item;
                    break;

                case 'types' :
                    $types[$arrExplodeValue[0]] = $item;
                    break;

                case 'depths' :
                    $depths[$arrExplodeValue[0]] = $item;
                    break;

                case 'hid_fields' :
                    $hid_fields[$arrExplodeValue[0]] = $item;
                    break;
            }
        }

        //save data into table order
        $order = new Order();
        $order->name = $sName;
        $order->save();

        //save data into table settings
        $isSave = false;
        foreach($tags as $key => $tag) {
            $setting = new Setting();
            $setting->table = $table;
            $setting->url = $url;
            $setting->order = $order->id;
            $setting->tag = $tag;
            $setting->name = $key;
            $setting->html = isset($htmls[$key]) ? $htmls[$key] : '';
            $setting->type = isset($types[$key]) ? $types[$key] : 0;
            $setting->field = isset($hid_fields[$key]) ? $hid_fields[$key] : '';
            $isSave = $setting->save();
        }

        return Response::json($isSave);
    }

    /**
     *
     */
    public function loadSetting(Request $request) {
        $order_id = $request->order;
        $settings = Setting::where('order', $order_id)->get();
        $a =  view('protected.admin.tool.form-load-setting', compact('settings'));
        dd($a);
    }

    public function renderHTML($setting, $count) {

    }
} //class