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
                <h2>{{trans('label.admin.author.title')}}<small>{{ trans('label.list') }}</small></h2>

                <div class="clearfix"></div>
            </div>
            @if(Session::has('success'))
            <div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{Session::get('success')}}
            </div>
            @endif
            <div class="x_content">
                <table id="author" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
                                <th>{{trans('label.admin.author.id')}}</th>
                                <th>{{trans('label.admin.author.name')}}</th>
                                <th>{{trans('label.admin.author.email')}}</th>
                                <th>{{trans('label.admin.author.website')}}</th>
                                <th>{{trans('label.admin.author.image')}}</th>
                                <th>{{trans('label.admin.author.created_at')}}</th>
                                <th class=" no-link last"><span class="nobr">{{trans('label.action')}}</span>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($viewData as $item)
                                <tr class="even pointer">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name}}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->website }}</td>
                                    <td><img style="width: 100px; height: 120px;" src="{{ asset($item->image == '' ? 'assets/images/No_Image.png' : $item->image) }}" alt=""/></td>
                                    <td>{{ $item->created_at}}</td>
                                    <td>
                                    <a class="btn btn-success" href="{{route('admin.author.edit', array('id' => $item->id ))}}">
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

    <a href="{{route('admin.author.create')}}" class="btn btn-app">
        <i class="fa fa-plus"></i> {{trans('label.create')}}
    </a>

</div>

@stop

@section('outJS')
    <!-- Datatables -->
    <script src="{{ asset('assets/js/datatables/js/jquery.dataTables.js') }}"></script>
    <script src="{{asset('assets/js/datatables/tools/js/dataTables.tableTools.js')}}"></script>
    <script src="{{asset('assets/js/admin/author.js')}}"></script>
@stop
