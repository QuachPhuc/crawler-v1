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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">Table<code>*</code>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('tables', $tables, null,['class' => 'form-control'] ) !!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">URL<code>*</code>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('url', 'aa', [
                                    'placeholder' => '',
                                    'id' => 'url',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'required' => 'required'])!!}
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <p>Setting HTML tag</p>
                            <span class="section"></span>

                            <div id="setting-html-row">
                                <div id="0_0" class="row marginTop10">
                                    <div class="col-md-4">
                                        <div class="form-inline">
                                            <button class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>
                                            <select class="form-control">
                                                <option>Tag</option>
                                                <option>ID</option>
                                                <option>Class</option>
                                            </select>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 no-padding">
                                        <button onclick="add('0_0')" class="btn blue margin0" type="button"><i class="fa fa-plus"></i></button>
                                        <button onclick="remove()" class="btn red margin0" type="button"><i class="fa fa-times"></i></button>
                                        <button class="btn green margin0" type="button"><i class="fa fa-paper-plane-o"></i></button>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <div class="form-group">
                                {{--<div class="col-md-6 col-md-offset-3">--}}
                                    {{--<button type="reset" class="btn btn-primary">Reset</button>--}}
                                    {{--{!! Form::submit('Submit', ['class' => 'btn btn-success', 'id' => 'send']) !!}--}}
                                {{--</div>--}}
                            </div>
                        </form>

                    </div>
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