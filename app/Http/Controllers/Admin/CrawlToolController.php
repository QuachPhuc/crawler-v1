<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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
}