@extends('layouts.backend.app')

@section('title','Post')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

    <!-- Multi Select Css -->
    {{--<link href="{{asset('assets/backend/plugins/multi-select/css/multi-select.css')}}" rel="stylesheet">--}}
@endpush

@section('content')
    <div class="container-fluid">
        <form action="{{route('admin.post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD A POST
                            </h2>
                        </div>
                        <div class="body">

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="title" class="form-control" name="title">
                                        <label class="form-label">Post Title</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image">Featured Image</label>
                                    <input type="file" name="image" id="image">
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" name="status" id="publish" class="filled-in" value="1">
                                    <label for="publish">Publish</label>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CATEGORIES & TAGS
                            </h2>
                        </div>
                        <div class="body">

                            <div class="form-group form-float">
                                <div class="form-line {{$errors->has('categories'?'focused error':'')}}">
                                    <label for="category">Select Categories</label>
                                    <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="form-group form-float">
                                <div class="form-line {{$errors->has('tags'?'focused error':'')}}">
                                    <label for="tag">Select Tags</label>
                                    <select name="tags[]" id="tag" class="form-control show-tick" data-live-search="true" multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                POST BODY
                            </h2>
                        </div>
                        <div class="body">
                            <textarea name="body" id="tinymce"></textarea>
                            <br>
                            <a href="{{route('admin.post.index')}}" type="button" class="btn btn-warning m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
    <!-- Select Plugin Js -->
    <script src="{{asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

    <!-- Multi Select Plugin Js -->
    {{--<script src="{{asset('assets/backend/plugins/multi-select/js/jquery.multi-select.js')}}"></script>--}}
    <!-- TinyMCE -->
    <script src="{{asset('assets/backend/plugins/tinymce/tinymce.js')}}"></script>
    <script type="text/javascript">
       $(function () {
           tinymce.init({
               selector: "textarea#tinymce",
               theme: "modern",
               height: 300,
               plugins: [
                   'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                   'searchreplace wordcount visualblocks visualchars code fullscreen',
                   'insertdatetime media nonbreaking save table contextmenu directionality',
                   'emoticons template paste textcolor colorpicker textpattern imagetools'
               ],
               toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
               toolbar2: 'print preview media | forecolor backcolor emoticons',
               image_advtab: true
           });
           tinymce.suffix = ".min";
           tinyMCE.baseURL = '{{asset('assets/backend/plugins/tinymce')}}';
       })
    </script>
    <!-- Custom Js -->
    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>
@endpush