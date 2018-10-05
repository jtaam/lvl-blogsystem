@extends('layouts.backend.app')

@section('title','Category')

@push('css')
    <!-- JQuery DataTable Css -->
    <link href="{{asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <style>
        .category-slider-image{
            width: 80px;
            height: auto;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="block-header">

        </div>

        <!-- Exportable Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            POSTS IN {{strtoupper(trans($category->name))}}
                            <span class="badge bg-red">{{$category->posts->count()}}</span>
                            <span class="pull-right">
                                <a href="{{route('admin.category.index')}}" class="btn btn-warning waves-effect"><i class="material-icons">arrow_back</i> <span>Back</span></a>
                            </span>
                        </h2>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th class="text-center">Serial</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th class="text-center">Serial</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @foreach($category->posts as $key=>$post)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>{{$post->title}}</td>
                                        <td><img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="{{$post->image}}" class="category-slider-image"></td>
                                        <td>{{$post->created_at}}</td>
                                        <td>
                                            @if($post->status == true)
                                                <span class="badge bg-green">Published</span>
                                            @else
                                                <span class="badge bg-pink">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.post.show',$post->id)}}" class="btn btn-sm btn-success waves-effect"><i class="material-icons">visibility</i><span></span></a>
                                            <a href="{{route('admin.post.edit',$post->id)}}" class="btn btn-sm btn-info waves-effect"><i class="material-icons">edit</i><span></span></a>
                                            <button onclick="deletePost({{$post->id}});" class="btn btn-sm btn-danger waves-effect"><i class="material-icons">delete</i><span></span></button>
                                            <form id="delete-post-{{$post->id}}" action="{{route('admin.post.destroy',$post->id)}}" method="post" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
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
    <!-- Custom Js -->
    <script src="{{asset('assets/backend/js/pages/tables/jquery-datatable.js')}}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.26.10/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        function deletePost(id) {
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })

            swalWithBootstrapButtons({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-post-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })

        }
    </script>
@endpush