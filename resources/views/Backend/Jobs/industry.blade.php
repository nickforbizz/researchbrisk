
@extends("layouts.backend")
@section("content")
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Industries</h2>
						<h5 class="text-white op-7 mb-2">Industries for Jobs</h5>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
                        @role("superadmin|admin")
						<a href="#" id="add_industry" class="btn btn-secondary btn-round">Add An Industry</a>
                        @endrole
					</div>
				</div>
			</div>
		</div>






        <div class="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Available Industries</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover" >
                                    <thead>
                                        <tr>
                                            <th>Name</th>
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

            <!-- // modal -->
            <div class="modal fade" id="industryModal" tabindex="-1" role="dialog" aria-labelledby="industryModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="industryModalLabel">Add | Edit Industry</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="form row " id="industry_form">
                        @csrf
                        <input type="hidden" id="form_action" value="A">
                        <input type="hidden" id="row_id" >
                        <div class="form-group col-sm-12">
                            <label for="industry_name">Name:</label>
                            <input type="name" name="name" class="form-control" placeholder="Enter name" id="industry_name" required>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="industry_descr">Description:</label>
                            <textarea name="description" class="form-control" cols="5" id="industry_descr" placeholder="Enter description" required></textarea>
                        </div>
                         <div class="col-sm-12">
                         <hr>
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                         </div>       
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
                ajax: "{{ route('jobIndustryList') }}",
                columns: [
                    {data: 'name'},
                    {data: 'description'},
                    {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
			});

            // modal
            $("#add_industry").click(()=>{
                $("#industry_form")[0].reset();
                $("#form_action").val('A')
                $("#industryModal").modal()
            })

            $("#industry_form").submit((e) => {
                e.preventDefault();

                let form_action = $("#form_action").val();
                let row_id = $("#row_id").val();
                let action_url = '';
                (form_action == 'A') ? action_url = "{{ route('jobCreateIndustry')}}" : action_url = "job_update_industry/"+row_id;
                $.ajax({
                    url: action_url,
                    method: "post",
                    data: $("#industry_form").serialize(),
                    success: (payload) => {
                        $('#basic-datatables').DataTable().ajax.reload();
                        console.log(payload);
                        $("#industryModal").modal('hide');
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
    function editIndustry(id) {
        $("#row_id").val(id);
        $("#form_action").val('E')
        
        //data to edit
        $.ajax({
            url: 'job_edit_industry/'+id,
            method: 'get',
            success: (payload) => {
                console.log(payload.data);
                if(payload.data){
                    $("#industry_name").val(payload.data.name)
                    $("#industry_descr").val(payload.data.description)
                }
                $("#industryModal").modal()
            },
            error: (err) => {console.error(err);}
        })
    }
</script>
@endsection
			
		
		
	