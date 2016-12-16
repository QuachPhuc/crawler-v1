<?php

namespace App\Http\Controllers\Admin;

use App\Business\AuthorBusiness;
use App\Business\CategoryBusiness;
use App\Business\ProductBusiness;
use App\Commons\Common;
use App\Commons\UploadFileImage;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    private $productBusiness;

    private $categoryBusiness;

    private $authorBusiness;

    private $model;

    /**
     * tableColumn array use to save field of table
     * @var array
     */
    private  $tableColumns = array('name', 'slug', 'url','category_id', 'link_preview', 'price', 'detail', 'author_id', 'status');

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

        //set image
        if($request->file('thumbnail')) {
            $this->dataInput['thumbnail'] = $request->file('thumbnail');
        }
        if ($request->file('big_image')) {
            $this->dataInput['big_image'] = $request->file('big_image');
        }
    }
    /*
     * construct function
     * */
    function  __construct(ProductBusiness $productBusiness, CategoryBusiness $categoryBusiness, AuthorBusiness $authorBusiness) {
        $this->productBusiness = $productBusiness;
        $this->categoryBusiness = $categoryBusiness;
        $this->authorBusiness = $authorBusiness;
        $this->model = new Product();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $viewData = $this->productBusiness->getAll();
        return view('protected.admin.product.index', compact('viewData'));
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
        $author = $this->authorBusiness->getListAuthor();
        $status = Common::$STATUS;
        return view('protected.admin.product.create', compact('viewData', 'category', 'status', 'author'));
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

        //if has image
        if ($requests->file('thumbnail')) {
            $this->model->thumbnail = UploadFileImage::upload($requests->file('thumbnail'));
        }
        if ($requests->file('big_image')) {
            $this->model->big_image = UploadFileImage::upload($requests->file('big_image'));
        }

        $this->model->save();
        return Redirect::to('admin/product')->with('success', trans('message.SUCCESS'));
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
        $author = $this->authorBusiness->getListAuthor();
        $status = Common::$STATUS;
        return view('protected.admin.product.create', compact('viewData', 'category', 'status', 'author'));

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

        //if has image
        if ($requests->file('thumbnail')) {
            $this->model->thumbnail = UploadFileImage::upload($requests->file('thumbnail'));
        }
        if ($requests->file('big_image')) {
            $this->model->big_image = UploadFileImage::upload($requests->file('big_image'));
        }

        $this->model->save();
        return Redirect::to('admin/product')->with('success', trans('message.SUCCESS'));
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
    }
}
