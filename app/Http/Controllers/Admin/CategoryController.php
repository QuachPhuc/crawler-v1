<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Commons\Common;
use App\Business\CategoryBusiness;
use Redirect;

class CategoryController extends Controller
{
    private $model;

    private  $categoryBusiness;

    /**
     * tableColumn array use to save field of table
     * @var array
     */
    private  $tableColumns = array('name', 'slug', 'class', 'parent_id', 'status', 'description');

    /**
     * @var array
     */
    private  $dataInput = array();

    /**
     * @param $request
     */
    public function setData($request) {
        foreach($this->tableColumns as $field) {
            $this->model->$field = $request->input($field);
            $this->dataInput[$field] = $request->input($field);
        }
    }

    /**
     * @param CategoryBusiness $categoryBusiness
     */
    function __construct(CategoryBusiness $categoryBusiness) {
        $this->categoryBusiness = $categoryBusiness;
        $this->model = new Category();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $viewData = $this->categoryBusiness->getAll();
        return view('protected.admin.category.index', compact('viewData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //get list data
        $viewData = $this->model;
        $category = $this->categoryBusiness->getListCategory();
        $class = Common::$CLASS;
        $status = Common::$STATUS;
        return view('protected.admin.category.create', compact('viewData', 'category', 'status', 'class'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $requests)
    {
        //set data
        $this->setData($requests);
        //validate data
        $validator = $this->model->validation($this->dataInput);
        if ($validator->fails()) {
            $error = $validator->errors();
            return Redirect::back()->withInput()->withErrors( $error );
        }

        $this->model->save();
        return Redirect::to('admin/category')->with('success', trans('message.SUCCESS'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //get list data
        $viewData = $this->model->find($id);
        $category = $this->categoryBusiness->getListCategory();
        $class = Common::$CLASS;
        $status = Common::$STATUS;
        return view('protected.admin.category.create', compact('viewData', 'category', 'status', 'class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $requests, $id)
    {
        $this->model = $this->model->find($id);
        //set data
        $this->setData($requests);
        //validate data
        $validator = $this->model->validation($this->dataInput);
        if ($validator->fails()) {
            $error = $validator->errors();
            return Redirect::back()->withInput()->withErrors( $error );
        }

        $this->model->save();
        return Redirect::to('admin/category')->with('success', trans('message.SUCCESS'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $this->model->find($id)->delete();
        //return Redirect::to('admin/category')->with('success', trans('message.SUCCESS'));
    }
}
