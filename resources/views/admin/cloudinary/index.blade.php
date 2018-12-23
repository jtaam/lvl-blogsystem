@extends('layouts.backend.app')

@section('title','Cloudinary')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endpush

@section('content')
    <div class="container-fluid">

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            CLOUDINARY SETTINGS
                            <span class="pull-right">
                                <a href="{{route('admin.cloudinary.create')}}" class="btn btn-primary waves-effect"><i class="material-icons">add</i> <span>Add Settings</span></a>
                            </span>
                        </h2>
                    </div>
                    <div class="body">
                        @if (isset($cloudinary))
                            <h4>Cloud Name</h4>
                            <p>- {{$cloudinary->cloud_name}}</p>
                            <h4>API KEY</h4>
                            <p>- {{$cloudinary->api_key}}</p>
                            <h4>API SECRET</h4>
                            <p>- NOT VISIBLE</p>
                            <h4>MEDIA URL</h4>
                            <p>- <a href="{{$cloudinary->media_url}}" target="_blank">{{$cloudinary->media_url}}</a></p>
                            <a href="{{route('admin.cloudinary.edit', $cloudinary->id)}}" type="button" class="btn btn-warning m-t-15 waves-effect">EDIT</a>
                        @else
                            <h3>No data found</h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Jquery DataTable Plugin Js -->
    <script src="{{asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>

@endpush