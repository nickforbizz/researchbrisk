
@extends("layouts.backend")
@section("content")
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Manage Users</h2>
						<h5 class="text-white op-7 mb-2">We Research, We Write. Get personalized Research Help in 100+ Fields. Also, find Your Dream Job Here..</h5>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="page-inner mt--5">
			<div class="row mt--2">
				<div class="col-md-12">
					<div class="card full-height">
						<div class="card-body">
							<div class="card-title"> Users Records</div>

							<div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Active</th>
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
		
			

				<!-- // modal -->
				<div class="modal fade" id="actdeactivateuserModal" tabindex="-1" role="dialog" aria-labelledby="actdeactivateuserModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="actdeactivateuserModalLabel">Authorise User!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
					<form action="{{ route('manageUsersActdeactivate') }}" method="get">
                    <div class="modal-body">
					@csrf
						<input type="hidden" name="user_id" class="form-control" id="actdeactivate_id" readonly>
						<input type="hidden" name="rec_type" class="form-control" id="actdeactivate_rec_type" readonly>
						<p class="text-danger" id="actdeactivate_msg"> </p>
                    </div>
                    <div class="modal-footer">
						<button type="submit" class="btn btn-primary">Proceed</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
					</form>
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
                ajax: "{{ route('manageUsersList') }}",
                columns: [
                    {data: 'name'},
                    {data: 'email'},
                    {data: 'created_at'},
                    {data: 'status'},
                    {data: 'active'},
                    {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
			});

            // modal
            $("#add_category").click(()=>{
                $("#category_form")[0].reset();
                $("#form_action").val('A')
                $("#categoryModal").modal()
            })

            $("#category_form").submit((e) => {
                e.preventDefault();

                let form_action = $("#form_action").val();
                let row_id = $("#row_id").val();
                let action_url = '';
                // (form_action == 'A') ? action_url = "{{ route('blogCreateCategory')}}" : action_url = "blog_update_category/"+row_id;
                $.ajax({
                    url: action_url,
                    method: "post",
                    data: $("#category_form").serialize(),
                    success: (payload) => {
                        $('#basic-datatables').DataTable().ajax.reload();
                        console.log(payload);
                        $("#categoryModal").modal('hide');
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
                    error: (err) => { 
                        console.error(err.responseJSON.message)
                        $("#categoryModal").modal('hide');
                        $.notify({
                            icon: 'flaticon-alarm-1',
                            message: err.responseJSON.message,
                        },{
                            type: 'error',
                            time: 1000,
                        });
                    }
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
                    $("#category_name").val(payload.data.name)
                    $("#category_descr").val(payload.data.description)
                }
                $("#categoryModal").modal()
            },
            error: (err) => {console.error(err);}
        })
    }

	// helper funcs
	function activateDeactivate(id, rec_type) {
			$("#actdeactivate_id").val(id);
			$("#actdeactivate_rec_type").val(rec_type);

			if(rec_type == 'active'){
				$("#actdeactivate_msg").text("De activate user")
			}else{
				$("#actdeactivate_msg").text("Activate user")
			}
			$("#actdeactivateuserModal").modal()
		}
</script>
@endsection
			
		
		
	