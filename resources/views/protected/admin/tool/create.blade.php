@extends('protected.admin.includes.layout')
@section('content')
<div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{trans('label.admin.product.title')}}<small>{{trans('label.create')}}</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form class="form-horizontal form-label-left">
                            <p>All field has <code>*</code> is require
                            </p>
                            <span class="section"></span>

                            <div class="item form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last_name">Table<code>*</code>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('tables', $tables, null,['id' => 'selectTable', 'class' => 'form-control'] ) !!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-1 col-sm-1 col-xs-12" for="name">URL<code>*</code>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('url', null, [
                                    'placeholder' => '',
                                    'id' => 'url',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'required' => 'required'])!!}
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <p><b>Setting HTML tag</b></p>
                            <span class="section"></span>

                            <div id="setting-html-row">
                                <div id="0">
                                    <div class="row marginTop10">
                                        <div class="col-md-4">
                                            <div class="form-inline">
                                                {{--<button class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>--}}
                                                <select class="form-control">
                                                    <option>Tag</option>
                                                    <option>ID</option>
                                                    <option>Class</option>
                                                </select>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 no-padding">
                                            <button onclick="add('0')" class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-danger">Reset</button>
                                    <button type="button" class="btn btn-success">Save Setting</button>
                                    {!! Form::submit('Start Crawl', ['class' => 'btn btn-primary', 'id' => 'send']) !!}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Small modal -->
    <div class="modal fade bs-example-modal-sm" id="modalSelectField" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal form-label-left">
                        <input type="hidden" id="hidID">
                        <div class="form-group">
                            <label class="control-label col-md-1 col-sm-1 col-xs-12" for="last_name">Field
                            </label>
                            <div class="col-md-10 col-sm-10 col-xs-12" id="selectFieldBox">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button onclick="selectedField()" type="button" class="btn btn-primary">Select item</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('outJS')
    <!-- form validation -->
    <script src="{{asset('assets/js/validator/validator.js')}}"></script>
    <script src="{{asset('assets/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('assets/js/admin/create_slug.js')}}"></script>
    <script src="{{asset('assets/js/admin/tool-crawler.js')}}"></script>
@stop