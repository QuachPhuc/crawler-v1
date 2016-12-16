<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
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
     *
     */
    public function index() {

        $tables = $this->getTables();
        return view('protected.admin.tool.create', compact('tables'));
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
     *
     */
    public function addFormSetting(Request $request) {
        $id = $request->id;
        return view('protected.admin.tool.form-setting', compact('id'));
    }

    public function tmp() {
        $tables = DB::select('SHOW TABLES');
        //dd($tables[0]->Tables_in_buy_theme);
        foreach($tables as $tab) {
            $columns = Schema::getColumnListing($tab->Tables_in_buy_theme);
            foreach($columns as $key => $col) {
                $col = DB::connection()->getDoctrineColumn($tab->Tables_in_buy_theme, $col);
                $columns[$key] = $col;
            }
            $tab->columns = $columns;
        }

        return $tables;
    }
}