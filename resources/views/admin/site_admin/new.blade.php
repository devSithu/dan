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
                            <button type="button" id="btn_special" onclick="change('special')">Special</button>
                            <button type="button" id="btn_normal" onclick="change('normal')">Normal</button>

                            <button type="button" name="button" class="btn btn-success pull-right" data-target="#modalBox" data-toggle="modal" data-keyboard="false" data-backdrop="static">Add</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="datatable">
                                    <thead class=" text-primary">
                                        <tr>
                                             <th>
                                                No
                                            </th>
                                            <th>
                                                Photo
                                            </th>
                                            <th>
                                                Title
                                            </th>
                                            <th>Action</th>
                                        </tr>
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
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="insert_update_form" class="md-form" enctype="multipart/form-data">
                        <input type="hidden" value="0" name="id" id="id">
                        <input type="hidden" name="form_type" id="form_type" value="insert">
                        <div class="modal-body">
                            {{csrf_field()}}
                            <div class="row">
                            <div class="col-md-6">
                                    <div class="col-md-12">
                                        <img src="{{asset('images/upload.png')}}" class="imagePreview" id="image" style="height: 150px;">

                                        <label class="btn btn-md btn-primary container-fluid rounded-0 m-0" for="upload_photo">Upload</label>

                                        <input type="file" style="display:none;" id="upload_photo" name="photo" class="form-control package_photo" onchange="displaySelectedPhoto('upload_photo','image')">

                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="title" class="col-form-label">Title:</label><br>
                                                    <input type="text" id="title" class="form-control" name="title" required>
                                                </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="new_type" class="col-form-label">Type:</label><br>
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="">select new type</option>
                                                    <option value="normal">Normal</option>
                                                    <option value="special">Special</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            </div><br>
                        
                            
                        

                            {{-- <span class="detail_error"></span> --}}
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="detail" class="col-form-label">Detail:</label><br>
                                        <textarea id="detail" class="form-control" name="detail"></textarea>
                                    </div>
                                </div>
                        </div>

                        
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="p"></div>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-primary rounded-0 pull-right" id="btn_submit">Create</button>
                
                        </div>
                    </form>
                </div>
            </div>
         </div>

       

    </div>

@endsection

@section('js')

    <script src="{{url('js/helper.js')}}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {
            //  $('#mymodal').modal('show'); 

            var t=$("#datatable").DataTable({
                // "ordering": false,
                // "paging": false,
                "bInfo" : false,
                // "bPaginate": false,
                "bLengthChange": false
                // "bFilter": true,
                // "bAutoWidth": false
            });

            var detail = new FroalaEditor('#detail', {
                            height: 300
                            });
                                        

            // start summernote

            // $("#summernote").summernote({
            //     // height : "150px",
            //     // placeholder: 'Text',
            //     // toolbar: [
            //     //     ['style', ['style','bold', 'italic', 'underline', 'clear','fontname','fontsize']],
            //     //     ['font', ['strikethrough', 'superscript', 'subscript']],
            //     //     ['color', ['color']],
            //     //     ['para', ['ul', 'ol', 'paragraph']],
            //     //     ['height', ['height']],
            //     //     ['view', ['fullscreen', 'codeview', 'help']],
            //     //     ['insert', ['link', 'picture', 'video']],
            //     // ],
            // });


            //********************************************

             
            var url="http://localhost/DAN/public/api/news/special";
            load_data(url);
            function load_data(request_url){
                fetch(request_url)
                .then(response=>response.json())
                .then(news=>{
                    show_data(news);
                })
                .catch(err=>console.log(err));
            }

        // let change=function(type){
        //     // type==="special"?url="http://localhost/DAN/public/api/news/special":url="http://localhost/DAN/public/api/news/normal";
        //     // load_data(url);
        //     alert(type);
        // }

            change=function(type){
                type==="special"?url="http://localhost/DAN/public/api/news/special":url="http://localhost/DAN/public/api/news/normal";
                load_data(url);
                //alert(type);
            }
        
        // document.querySelector('#btn_special').addEventListener('click',change('special'),true);

            get_news_data=function(id){
                fetch(`http://localhost/DAN/public/api/news/detail/${id}`)
                .then(response=>response.json())
                .then((result)=>{
                    console.log(typeof result);
                    let txt_title=document.querySelector('#title');
                    let txt_detail=document.querySelector('#detail');
                    let txt_type=document.querySelector('#type');
                    let photo=document.querySelector('#image');
                    let id=document.querySelector('#id');
                    let form_type=document.querySelector('#form_type');

                    let modal=document.querySelector('#modal');

                    txt_title.value=result.title;
                    detail.html.set(result.detail);
                    txt_type.value=result['type'];
                    photo.src=result['photo'];

                    form_type.value="update";
                    id.value=result.id;



                    $('#modalBox').modal('show'); 

                })
                .catch(err=>console.log(err));
            }


            //@***********
            function show_data(news){
                let table=document.querySelector('#tbody');
                t.clear();
                let i=1;
                news.forEach(data => {
                    t.row.add( [ i++,
                            `<img src="${data['photo']}" width="80" height="80">`,
                            data['title'],
                            `<button class="btn btn-sm btn-primary">Detail</button>
                            <button class="btn btn-sm btn-success" onclick="get_news_data('${data['id']}')">Update</button>
                            <button class="btn btn-sm btn-danger">Delete</button>`] )
                        .draw(false);
                });            
            }

            //@insert update form submit*I***********
            document.querySelector('#insert_update_form').addEventListener("submit",()=>{
                event.preventDefault();
                var progressBar = document.getElementById("p");
                var insert_form = document.querySelector('#insert_update_form');
                let form=new FormData(insert_form);
                let url="http://localhost/DAN/public/api/news/insert";
                if (form.get('form_type')=="update") {
                    url="http://localhost/DAN/public/api/news/update/"+form.get('id');
                }

                xhr = new XMLHttpRequest();
                xhr.open("POST", url,true);
                // xhr.setRequestHeader('Content-Type','multipart/form-data');
                xhr.onprogress = function(pe) {
                    if(pe.lengthComputable) {
                        progressBar.max = pe.total
                        progressBar.value = pe.loaded
                    }
                }
                xhr.onloadend = function(pe) {
                    progressBar.value = pe.loaded
                }
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status==200){
                        let response=JSON.parse(xhr.responseText);
                        if(response){
                        //   document.querySelector('#modal').classList.remove('show');
                          response['type']==="normal"? change('normal'): change('special');
                        }
                          $('#modalBox').modal('hide'); 
                        // console.log(response);
                        // document.getElementById('result').innerHTML = xhr.responseText;
                    }
                };
                // let data=`title=${form.get('title')}&detail=${form.get('detail')}&type=${form.get('type')}&photo=${form.get('photo')}`;
                xhr.send(form);

               
            },true);



        });
    </script>




@endsection