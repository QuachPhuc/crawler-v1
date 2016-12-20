<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $model = new Product();
        return view('protected.admin.tool.create', compact('tables', 'model'));
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
            if($type == '0') {
                // get text
                $data[$hid_field][] = $item->plaintext;
            }

            if($type == '1') {
                //upload image
                $data[$hid_field][] = $item->src;
            }

            if($type == '2') {
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
}