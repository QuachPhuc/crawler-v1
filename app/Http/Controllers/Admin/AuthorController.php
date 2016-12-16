<?php

namespace App\Http\Controllers\Admin;

use App\Commons\UploadFileImage;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Business\AuthorBusiness;
use Illuminate\Support\Facades\Redirect;

class AuthorController extends Controller
{
    private $model;

    private  $authorBusiness;

    /**
     * tableColumn array use to save field of table
     * @var array
     */
    private  $tableColumns = array('name', 'email', 'website');

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

        //if has image
        if ($request->file('image')) {
            $this->dataInput['image'] = $request->file('image');
        }

    }

    /**
     * @param authorBusiness $authorBusiness
     */
    function __construct(AuthorBusiness $authorBusiness) {
        $this->authorBusiness = $authorBusiness;
        $this->model = new Author();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $viewData = $this->authorBusiness->getAll();
        return view('protected.admin.author.index', compact('viewData'));
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
        return view('protected.admin.author.create', compact('viewData'));
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
        if ($requests->file('image')) {
            $this->model->image = UploadFileImage::upload($requests->file('image'));
        }

        $this->model->save();
        return Redirect::to('admin/author')->with('success', trans('message.SUCCESS'));
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
        return view('protected.admin.author.create', compact('viewData'));
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
        if ($requests->file('image')) {
            $this->model->image = UploadFileImage::upload($requests->file('image'));
        }
        $this->model->save();
        return Redirect::to('admin/author')->with('success', trans('message.SUCCESS'));
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
