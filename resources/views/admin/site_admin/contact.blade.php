@extends('admin.layouts.site_admin.site_admin_design')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .imagePreview {
            width: 100%;
            height: 150px;
            background-position: center center;
            background:url('http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg');
            background-color:#fff;
            background-size: cover;
            background-repeat:no-repeat;
            display: inline-block;
            /* box-shadow:0px -3px 6px 2px rgba(0,0,0,0.2); */
        }
        .upload_btn
        {
            display:block;
            border-radius:10px;
            /* box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2); */
            margin-bottom: 15px;
        }
        .imgUp
        {
            margin-bottom:15px;
        }
    </style>
@endsection

@section('nav_bar_text')
    Contact
@endsection
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <button type="button" name="button" class="btn btn-success pull-right" data-target="#modalBox" data-toggle="modal" data-keyboard="false" data-backdrop="static">Add</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead class=" text-primary">
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th></th>
                                    <th></th>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- insert_model --}}
         <div class="modal fade" id="modalBox" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="insert_blog" class="md-form" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <input type="hidden" value="" name="blog_id">
                        
                        <div class="row">
                           <div class="col-md-12">
                           <div class="form-group">
                                <label for="name" class="col-form-label">Name:</label><br>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                           </div>
                        </div>

                        {{-- <span class="detail_error"></span> --}}
                       <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone" class="col-form-label">Phone:</label><br>
                                   <input type="phone" class="form-control" name="phone" id="phone" required>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                         <button type="submit" class="btn btn-primary rounded-0 pull-right" id="btn_submit">Create</button>
            
                    </div>
                </form>
            </div>
        </div>
    </div>

       

        <!-- edit modal -->
        <div class="modal fade" id="edit_modalBox">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit New</h4>
                        <button data-dismiss="modal" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                    <form id="update_data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <input type="hidden" value="" name="blog_id">
                    

                        <div class="row">
                           <div class="col-md-12">
                           <div class="form-group">
                                <label for="update_name" class="col-form-label">Name:</label><br>
                                <input type="text" class="form-control" name="name" id="update_name" required>
                            </div>
                           </div>
                        </div>

                        {{-- <span class="detail_error"></span> --}}
                       <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="update_phone" class="col-form-label">Phone:</label><br>
                                   <input type="phone" class="form-control" name="phone" id="update_phone" required>
                                </div>
                            </div>
                       </div>

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                         <button type="submit" class="btn btn-primary rounded-0 pull-right" id="btn_submit">Update</button>
                        <!-- <input type="submit" value="Create" class="btn btn-success"> -->
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            var t=$("#datatable").DataTable({
                "ordering": false,
                // "paging": false,
                "bInfo" : false,
                // "bPaginate": false,
                "bLengthChange": false
                // "bFilter": true,
                // "bAutoWidth": false
            });
            

        });
    </script>
@endsection