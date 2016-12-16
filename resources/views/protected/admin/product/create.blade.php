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
                        {!! Form::model($viewData, ['route' => $viewData->id == '' ? 'admin.product.store' : array('admin.product.update', $viewData->id), 'method' => $viewData->id == '' ? 'POST' : 'PUT', 'class' => 'form-horizontal form-label-left', 'files' => 'true']) !!}
                            <p>All field has <code>*</code> is require
                            </p>
                            <span class="section"></span>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('label.admin.product.name')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('name', $viewData->name, [
                                    'placeholder' => '',
                                    'id' => 'name',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'required' => 'required'])!!}
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">{{trans('label.admin.product.slug')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('slug', $viewData->slug, [
                                    'placeholder' => '',
                                    'id' => 'slug',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    ])!!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('label.admin.product.url')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('url', $viewData->url, [
                                    'placeholder' => '',
                                    'id' => 'url',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'required' => 'required'])!!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('label.admin.product.preview')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::text('link_preview', $viewData->link_preview, [
                                    'placeholder' => '',
                                    'id' => 'link_preview',
                                    'class' => 'form-control col-md-7 col-xs-12',
                                    'required' => 'required'])!!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('label.admin.product.price')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" value="{{ $viewData->price }}" placeholder= ''
                                    id = 'price'
                                    name="price"
                                    class= 'form-control col-md-7 col-xs-12'
                                    required = 'required'/>

                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">{{trans('label.admin.product.category')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('category_id', $category, $viewData->category_id, ['class' => 'form-control'] ) !!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">{{trans('label.admin.product.author')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('author_id', $author, $viewData->author_id, ['class' => 'form-control'] ) !!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">{{trans('label.status')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('status', $status, $viewData->status, ['class' => 'form-control', 'required' => 'required'] ) !!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">{{trans('label.admin.product.thumb_image')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                {!! Form::file('thumbnail', array('onchange'=>'loadPreview("thumbnail")')) !!}
                                </div>
                                <div class="imagePreview col-md-9 col-md-offset-3" style="margin-top: 10px;">

                                    @if($viewData->thumbnail != null)
                                        <div id='ImgPreviewthumbnail'>
                                            <img style="width: 80px; height: 80px;" src="{{asset($viewData->thumbnail)}}" alt=""/>
                                        </div>
                                    @else
                                        <div id='ImgPreviewthumbnail'></div>
                                    @endif
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">{{trans('label.admin.product.large_image')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::file('big_image', array('onchange'=>'loadPreview("big_image")')) !!}
                                </div>
                                <div class="imagePreview col-md-9 col-md-offset-3" style="margin-top: 10px;">
                                    @if($viewData->big_image != null)
                                        <div id='ImgPreviewbig_image'>
                                            <img style="width: 589px; height: 299px;" src="{{asset($viewData->big_image)}}" alt=""/>
                                        </div>
                                    @else
                                        <div id='ImgPreviewbig_image'></div>
                                    @endif
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">{{trans('label.admin.product.detail')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <textarea class="ckeditor form-control" name="detail" rows="6" data-error-container="#editor2_error">{{ $viewData->detail }}</textarea>
                                    <div id="editor2_error">
                                    </div>
                                </div>
                            </div>


                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    {!! Form::submit('Submit', ['class' => 'btn btn-success', 'id' => 'send']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}

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
    <script src="{{asset('assets/js/admin/product.js')}}"></script>
    <script>
        //make slug
        $('#name').makeSlug({
            slug: $('#slug')
        });

        // initialize the validator function
        validator.message['date'] = 'not a real date';

        // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
        $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

        $('.multi.required')
            .on('keyup blur', 'input', function () {
                validator.checkField.apply($(this).siblings().last()[0]);
            });

        // bind the validation to the form submit event
        //$('#send').click('submit');//.prop('disabled', true);

        $('form').submit(function (e) {
            e.preventDefault();
            var submit = true;
            // evaluate the form using generic validaing
            if (!validator.checkAll($(this))) {
                submit = false;
            }

            if (submit)
                this.submit();
            return false;
        });

        /* FOR DEMO ONLY */
        $('#vfields').change(function () {
            $('form').toggleClass('mode2');
        }).prop('checked', false);

        $('#alerts').change(function () {
            validator.defaults.alerts = (this.checked) ? false : true;
            if (this.checked)
                $('form .alert').remove();
        }).prop('checked', false);
    </script>
@stop