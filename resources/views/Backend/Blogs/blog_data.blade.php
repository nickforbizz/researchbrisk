
@extends("layouts.backend")
@section("content")
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold"> Add | Edit Blog</h2>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
						<a href="{{ route('blogPage') }}" id="add_order" class="btn btn-secondary btn-round"> <i class="fa fa-chevron-back"></i> Back </a>
					</div>
				</div>
			</div>
		</div>






        <div class="page-inner">

        <div class="row">
            
            <div class="col-sm-12">
                <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Actions</h4>
                        </div>
                        <div class="card-body">
                            <form class="form row " id="blog_form">
                                @csrf
                                <input type="hidden" id="form_action"  @isset($blog->uuid) value="E" @else value="A" @endisset />
                                <input type="hidden" id="uuid" name="uuid" @isset($blog->uuid) value="{{$blog->uuid}}" @endisset>

                                
                                <div class="form-group col-sm-12">
                                    <label for="featured_image">Featured Image:</label>
                                    <input type="file" name="featured_image" class="form-control" id="featured_image" @isset($blog->uuid) '' @else required @endisset />
                                    <small class="input_msg" id="featured_image_msg"></small>
                                    @isset($blog->media_link) <img src="{{ asset(str_replace('public', 'storage',$blog->media_link)) }}" height=100 /> @endisset
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="title">Title:</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter title" id="title" @isset($blog->title) value="{{$blog->title}}" @endisset required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="slug">Slug:</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Enter slug - to be displayed on url" id="slug" @isset($blog->slug) value="{{$blog->slug}}" @endisset required>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="category">Category:</label>
                                    <select name="blog_category_id" class="form-control" id="category" required>
                                        <option selected disabled> -- select item --</option>
                                        @foreach($categories as $category)
                                            @isset($blog->blog_category_id )
                                                @if($category->id == $blog->blog_category_id)
                                                    <option value="{{ $category->id }}" selected> {{ $category->name }} </option>
                                                @endif
                                            @endisset
                                            <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                               

                                <div class="form-group col-sm-6">
                                    <label for="archived">Archive:</label>
                                    <select name="archived" class="form-control" id="archived" required>
                                        @isset($blog->archived)
                                            @if($blog->archived == 1)
                                                <option value="1" selected> Yes </option>
                                                <option value="0"> No </option>    
                                            @else
                                                <option value="1"> Yes </option>
                                                <option value="0" selected> No </option>    
                                            @endif
                                        @else
                                        <option value="1"> Yes </option>
                                        <option value="0" selected> No </option>
                                        @endisset   
                                    </select>
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="descr">Description:</label>
                                    <textarea name="description" class="form-control" cols="5" id="descr" placeholder="Enter description about the post" > @isset($blog->description) {{$blog->description}} @endisset required </textarea>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="tags">Tags:</label>
                                    <select name="blog_tags[]" class="form-control" id="tags" required multiple>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}"> {{ $tag->title }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label for="blog_body">Content:</label>
                                    <textarea name="body" class="form-control" cols="5" id="blog_body" placeholder="Enter content"> @isset($blog->body) {{$blog->body}} @endisset </textarea>
                                </div>
                                <div class="col-sm-12">
                                <hr>
                                    @role("superadmin|admin|writer")
                                    <button type="submit" class="btn btn-primary float-right ml-2">Submit</button>
                                    @endrole
                                </div>       
                            </form>

                        </div>
                    </div>
                </div>
                
            <!-- </div> -->
        </div>
            

            <!-- // modal -->
            <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="blogModalLabel"> Add | Edit Blog </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mb-3">
                    
                    </div>
                   
                    </div>
                </div>
            </div>


        </div>
		
		
	</div>
@endsection 

@section('scripts')
<script src="https://cdn.tiny.cloud/1/4u3cmri3397u1tzsz152g7glvdjkfwp1sj0uph3ng27nqet8/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    $(document).ready(function() {

            $('#tags').select2();

			$('#basic-datatables').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 5,
                // scrollX: true,
                "order": [[ 0, "desc" ]],
                ajax: "{{ route('blogList') }}",
                columns: [
                    {data: 'title'},
                    {data: 'description'},
                    {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
			});


            // check image size
            var _URL = window.URL || window.webkitURL;
            $("#featured_image").change(function (e) {
                let file, img;
                if ((file = this.files[0])) {
                    img = new Image();
                    img.onload = function () {
                    let width=this.width;
                    let height=this.height;
                    console.log(width);
                    console.log(height);
                    if(width < 400 || height < 350){
                        $("#featured_image_msg").text(`Add an image greater than this dimensions [ 350 * 400 ], your image is [ ${height} * ${width} ]`);
                        $("#featured_image").val(''); 
                    }else{
                        $("#featured_image_msg").text(''); 
                    }
                    
                    
                        
                    };
                    img.src = _URL.createObjectURL(file);
                }
            });

            $("#slug").change(function(e){
                let str = $(this).val();
                $(this).val(str.replace(/ /g, '_'))
            })

            // modal
            $("#add_blog").click(()=>{
                $("#blog_form")[0].reset();
                $("#form_action").val('A')
                $("#blogModal").modal()
            })

            $("#blog_form").submit(function(e) {
                e.preventDefault();

                let form_action = $("#form_action").val();
                let row_id = $("#uuid").val();
                let action_url = '';
                (form_action == 'A') ? action_url = "{{ route('blogCreate')}}" : action_url = "blog_advance_update/"+row_id;

                let fd = new FormData($(this)[0]);
                $.ajax({
                    url: action_url,
                    method: "post",
                    data: fd,
                    processData: false,
                    contentType: false,
                    success: (payload) => {
                        $('#basic-datatables').DataTable().ajax.reload();
                        console.log(payload);
                        $("#blogModal").modal('hide');
                        let type = 'info'
                        if (payload.code != 1) {
                            type = 'danger'
                        }

                        $.notify({
                            icon: 'flaticon-alarm-1',
                            message: payload.msg,
                        },{
                            type: type,
                            time: 1000,
                        });

                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    },
                    error: (err) => { console.error(err)}
                })
            })
    }); 

    // edit data
    function editCategory(id) {
        $("#row_id").val(id);
        $("#form_action").val('E')
        
        //data to edit
        $.ajax({
            url: 'blog_edit_category/'+id,
            method: 'get',
            success: (payload) => {
                console.log(payload.data);
                if(payload.data){
                    $("#title").val(payload.data.title)
                    $("#descr").val(payload.data.description)
                }
                $("#blogModal").modal()
            },
            error: (err) => {console.error(err);}
        })
    }






    
tinymce.init({
  selector: 'textarea#blog_body',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});



</script>
@endsection
			
		
		
	