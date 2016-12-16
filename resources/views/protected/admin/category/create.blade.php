@extends('protected.admin.includes.layout')
@section('content')
<div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{trans('label.admin.category.title')}}<small>{{trans('label.create')}}</small></h2>

                        <div class="clearfix"></div>
                    </div>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="error-item">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="x_content">
                        {!! Form::model($viewData, ['route' => $viewData->id == '' ? 'admin.category.store' : array('admin.category.update', $viewData->id), 'method' => $viewData->id == '' ? 'POST' : 'PUT', 'class' => 'form-horizontal form-label-left']) !!}
                            <p>All field has <code>*</code> is require
                            </p>
                            <span class="section"></span>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">{{trans('label.admin.category.name')}}<span class="required">*</span>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">{{trans('label.admin.category.slug')}}<span class="required">*</span>
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="parent_id">{{trans('label.admin.category.parent')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('parent_id', $category, $viewData->parent_id, ['class' => 'form-control'] ) !!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="class">{{trans('label.admin.category.class')}}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('class', $class, $viewData->class, ['class' => 'form-control'] ) !!}
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">{{trans('label.admin.category.description')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::textarea('description', $viewData->description, ['class' => 'form-control'] ) !!}
                                </div>

                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">{{trans('label.status')}}<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    {!! Form::select('status', $status, $viewData->status, ['class' => 'form-control', 'required' => 'required'] ) !!}
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
    <script src="{{asset('assets/js/admin/create_slug.js')}}"></script>
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