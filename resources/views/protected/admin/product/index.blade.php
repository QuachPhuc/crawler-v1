@extends('protected.admin.includes.layout')
{{--include extra css--}}
@section('outCSS')
    <link href="{{asset('assets/css/icheck/flat/green.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/datatables/tools/css/dataTables.tableTools.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{trans('label.admin.product.title')}}<small>{{ trans('label.list') }}</small></h2>

                <div class="clearfix"></div>
            </div>
            @if(Session::has('success'))
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{Session::get('success')}}
            </div>
            @endif
            <div class="x_content">
                <table id="product" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th width="5%">{{trans('label.admin.product.id')}}</th>
                                <th width="40%">{{trans('label.admin.product.name')}}</th>
                                <th width="10%">{{trans('label.admin.product.category')}}</th>
                                <th width="10%">{{trans('label.admin.product.author')}}</th>
                                <th width="5%">{{trans('label.admin.product.status')}}</th>
                                <th width="15%">{{trans('label.admin.product.created_at')}}</th>
                                <th width="15%" class=" no-link last"><span class="nobr">{{trans('label.action')}}</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($viewData as $item)
                                <tr class="even pointer">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name}}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->author->name }}</td>
                                    <td>{{ \App\Commons\Common::$STATUS[$item->status] }}</td>
                                    <td>{{ $item->created_at}}</td>
                                    <td>
                                    <a class="btn btn-success" href="{{route('admin.product.edit', array('id' => $item->id ))}}">
                                       <i class="fa fa-pencil-square-o fa-x"></i>
                                    </a>
                                    <a class="btn btn-danger" onclick="doAction('{{trans('message.MSG_DO_ACTION_DELETE')}}', {{ $item->id  }})">
                                       <i class="fa fa-times fa-x"></i>
                                    </a>
                                    </td>
                                 </tr>
                                @endforeach

                        </tbody>
                    </table>
            </div>
        </div>
    </div>

    <br />
    <br />
    <br />

    <a href="{{route('admin.product.create')}}" class="btn btn-app">
        <i class="fa fa-plus"></i> {{trans('label.create')}}
    </a>

</div>

@stop

@section('outJS')
    <!-- Datatables -->
    <script src="{{ asset('assets/js/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{asset('assets/js/datatables/tools/js/dataTables.tableTools.js')}}"></script>
    <script src="{{asset('assets/js/admin/product.js')}}"></script>

@stop
