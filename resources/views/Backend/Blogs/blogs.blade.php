
@extends("layouts.backend")
@section("content")
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Blogs</h2>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
                        @role("admin|writer")
						    <a href="#" id="add_blog" class="btn btn-secondary btn-round">Add Blog</a>
                        @endrole
					</div>
				</div>
			</div>
		</div>





 
        <div class="page-inner">

        <div class="row">
            <div class="col-sm-6">
                <div class="p-5">
                    <h4>Blogs <small>22</small></h4>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Actions</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @role("admin|writer")
                                <div class="col-sm-6 p-2">
                                    <button  class="btn btn-primary btn-round ml-2"  data-toggle="modal" data-target="#blogtag">Add Tags</button>
                                </div>
                                <div class="col-sm-6 p-2">
                                    <a href="{{ route('blogAdvanceAddUpdate') }}" class="btn btn-primary btn-round ml-2">Add Blog</a>
                                
                                </div>
                                <div class="col-sm-6 p-2">
                                    <a href="{{ route('blogCategory') }}" class="btn btn-primary btn-round ml-2">Add Categories</a>
                                </div>
                                @endrole
                                <div class="col-sm-6 p-2">
                                    <a href="{{ route('blogAdvanceAddUpdate') }}" class="btn btn-primary btn-round ml-2">View Comments</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            <!-- </div> -->
        </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Available Blogs</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!-- tags -->
            <div class="modal" tabindex="-1" role="dialog" id="blogtag">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Tags </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="form row" method="post" id="tag_form" action="{{ route('addTags') }}">
                            @csrf

                            <div class="form-group col-sm-12">
                                <label for="title">Title:</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter title" id="title">
                            </div>
                      
                            <div class="col-sm-12">
                            <hr>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>       
                        </form>
                    </div>
                  
                    </div>
                </div>
            </div>
            <!-- // tags -->

            <!-- // modal -->
            <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="blogModalLabel"> | Edit Blog</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mb-3">
                        <form class="form row " id="blog_form">
                            @csrf
                            <input type="hidden" id="form_action" value="A">
                            <input type="hidden" id="row_id" >
                            <div class="form-group col-sm-12">
                                <label for="title">Title:</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter title" id="title">
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="descr">Description:</label>
                                <textarea name="description" class="form-control" cols="5" id="descr" placeholder="Enter description"></textarea>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="category">Category:</label>
                                <select name="blog_category_id" class="form-control" id="category" required>
                                    <option selected disabled> -- select item --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"> {{ $category->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="archived">Archive?:</label>
                                <select name="archived" class="form-control" id="archived" required>
                                    <option selected disabled> -- select item --</option>
                                    <option value="1"> Yes </option>
                                    <option value="0"> No </option>
                                </select>
                            </div>


                            <div class="col-sm-12">
                            <hr>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>       
                        </form>
                    </div>
                        <div class="container">
                            <form action="{{ route('blogAdvanceAddUpdate') }}" class="mb-2" method="get">
                                <input type="hidden" name="uuid" id="post_uuid">
                                <button type="submit" class="btn btn-danger ml-3" id="advance_edit">Advanced Editing</button>
                            </form>
                        </div>
                   
                    </div>
                </div>
            </div>
        </div>
		
		
	</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
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

            
        

            $("#blog_form").submit((e) => {
                e.preventDefault();

                let form_action = $("#form_action").val();
                console.log(form_action);
                let row_id = $("#row_id").val();
                let action_url = '';
                (form_action == 'A') ? action_url = "{{ route('blogAdvanceAddUpdate')}}" : action_url = "blog_update/"+row_id;
                $.ajax({
                    url: action_url,
                    method: "post",
                    data: $("#blog_form").serialize(),
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
            url: 'blog_edit/'+id,
            method: 'get',
            success: (payload) => {
                console.log(payload.data);
                if(payload.data){
                    // console.log(payload.data);
                    $("#category").val(payload.data.blog_category_id);
                    $("#archived").val(payload.data.archived);
                    $("#title").val(payload.data.title);
                    $("#descr").val(payload.data.description);
                    $("#post_uuid").val(payload.data.uuid);
                    $("#blogModal").modal();
                }
            },
            error: (err) => {console.error(err);}
        })
    }
</script>
@endsection
			
		
		
	