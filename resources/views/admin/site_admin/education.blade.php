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
    New
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
                                <table class="table" id="datatable" >
                                    <thead class=" text-primary">
                                    <th>
                                        No
                                    </th>
                                    <th>
                                        Photo
                                    </th>
                                    <th>
                                        title
                                    </th>
                                    <th>
                                        Detail
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th></th>
                                    <th></th>
                                    </thead>
                                    <tbody id="tbody">

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
                    <h5 class="modal-title" id="exampleModalLabel">Add Education</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" class="md-form" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <img src="{{asset('images/default.jpg')}}" class="imagePreview" id="image" style="width: 100%;height: 150px;">
                                <label class="btn btn-md btn-primary container-fluid rounded-0 m-0" for="upload_photo">Upload</label>
                                <input type="file" style="display:none;" id="upload_photo" name="photo" required class="form-control package_photo" onchange="displaySelectedPhoto('upload_photo','image')">
                            </div>
                        </div>
                        <input type="hidden" value="" name="blog_id">
                        
                        <div class="row">
                           <div class="col-md-12">
                           <div class="form-group">
                                <label for="title" class="col-form-label">Title:</label><br>
                                <textarea type="text" id="title" class="form-control" name="title" required rows="1"></textarea>
                            </div>
                           </div>
                        </div>

                        {{-- <span class="detail_error"></span> --}}
                       <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail" class="col-form-label">Detail:</label>
                                    <textarea id="summernote" class="form-control" rows="5" name="detail"></textarea>
                                </div>
                            </div>
                       </div>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-diimagesmiss="modal">Close</button> -->
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
                        <h4 class="modal-title">Edit Education</h4>
                        <button data-dismiss="modal" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                    <form id="updateForm" enctype="multipart/form-data" >
                    <div class="modal-body" >
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6 mx-auto">
                                <img src="{{asset('images/default.jpg')}}" class="imagePreview" id="updateImage" style="width: 100%;height: 150px;">
                                <label class="btn btn-md btn-primary container-fluid rounded-0 m-0" for="update_photo" id="upload_btn" onclick="document.getElementById('update_photo').click(); return false">Upload</label>
                                <input type="file" style="display:none;" id="update_photo" name="photo" onchange="readURL(this)" required class="form-control package_photo" onchange="displaySelectedPhoto('update_photo','image')">
                            </div>
                        </div>
                        <input type="hidden" value="" name="blog_id" id="id">
                        
                        <div class="row">
                           <div class="col-md-12">
                           <div class="form-group">
                                <label for="update_title" class="col-form-label">Title:</label><br>
                                <textarea type="text" id="update_title" class="form-control" name="title" required rows="1"></textarea>
                            </div>
                           </div>
                        </div>

                        {{-- <span class="detail_error"></span> --}}
                       <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="detail" class="col-form-label">Detail:</label>
                                    <textarea id="update_summernote" class="form-control" rows="5" name="detail"></textarea>
                                </div>
                            </div>
                       </div>

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                         <button type="submit" class="btn btn-primary rounded-0 pull-right" id="btn_submit" onclick="update()">Update</button>
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
            
            // start summernote

            $("#summernote").summernote({
                height : "150px",
                placeholder: 'Text',
                toolbar: [
                    ['style', ['style','bold', 'italic', 'underline', 'clear','fontname','fontsize']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['insert', ['link', 'picture', 'video']],
                ],
            });

        });

         //ajax
        
       load_data();
        var txt_photo=document.querySelector("#upload_photo");
        var txt_title=document.querySelector("#title");
        var txt_detail=document.querySelector('#summernote');

        var update_photo=document.querySelector("#update_photo");
        var update_title=document.querySelector("#update_title");
        var update_summernote=document.querySelector('#update_summernote');
        var update_id=document.querySelector('#id');
        var img=document.querySelector('#updateImage');
        var upload_btn=document.querySelector("#upload_btn");
            

        var form=document.querySelector('#form');
        var updateForm=document.querySelector('#updateForm');

        form.addEventListener("submit",create_education,false);
        updateForm.addEventListener("submit",update,false);


        function create_education(){
            event.preventDefault();
            var form_data=new FormData(form);
            fetch('http://localhost/dan/public/api/insert_education',{
                method:'post',
                body: form_data,
                contentType: 'multipart/form-data'
            })
            .then(response=>response.json())
            .then(result=>result['message']===true?load_data():alert('error'))
            .catch(err=>console.log(err))
        }

        function load_data(){
            fetch('http://localhost/dan/public/api/get_all_education')
            .then(response=>response.json())
            .then(education=>show_data(education))
            .catch(err=>console.log(err))
            
        }

        function show_data(educations){
            var tbody=document.querySelector('#tbody');
            tbody.innerHTML=" ";
            
            educations.forEach(function (edu) {
                tbody.innerHTML+=`
                        <tr>
                        <td><img src="${edu['photo']}" width="80" height="80"></td>
                        <td>${edu['title']}</td>
                        <td>${edu['detail']}</td>
                        <td>
                                    <button class="btn btn-success" onclick="update_education('${edu["id"]}')" data-target="#edit_modalBox" data-toggle="modal" data-keyboard="false" data-backdrop="static">Update</button>
                                    <button class="btn btn-danger" onclick="delete_education('${edu["id"]}')">Delete</button>
                                </td>
                        </tr>
                `;
            })
        }

        


        //delete

        function delete_education(id){
            fetch('http://localhost/dan/public/api/delete_edu/'+id)
            .then(response=>response.json())
            .then(result=>{
                result['message']===true?load_data():alert('error');
            })
            .catch(err=>console.log(err))
        }

        //update


        //show image when click update button
        function readURL(input){
            if(input.files && input.files[0]){
                var reader=new FileReader();
                reader.onload=function(e){
                    img.setAttribute('src',e.target.result)
                    .style.width(500)
                    .style.height(200)
                }
                reader.readAsDataURL(input.files[0]);
            }
        }


        function update_education(id){
            fetch("http://localhost/dan/public/api/edit_edu/"+id)
            .then(response=>response.json())
            .then(data_return=>{
                
                img.src=data_return['photo'];
                
                update_title.value=data_return['title'];
                update_summernote.value=data_return['detail'];
                update_id.value=data_return['id'];
               
                 
            })
            .catch(err=>console.log(err));
        }

        function update(){
            event.preventDefault();
                var id=update_id.value;
                
              
                var form_data=new FormData(updateForm);
       
         fetch(`http://localhost/dan/public/api/update_edu/${id}`, {
            method: 'post',
            body: form_data
          }) .then(response=>response.json())
            .then(result=>{
                result['message']===true?load_data():alert('error');

            })
            .catch(err=>console.log(err));
        }
    </script>
@endsection