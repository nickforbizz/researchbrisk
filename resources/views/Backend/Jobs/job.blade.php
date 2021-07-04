
@extends("layouts.backend")
@section("content")
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Job</h2>
						<h5 class="text-white op-7 mb-2"> Jobs</h5>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
                        @role("admin")
						<a href="{{ route('jobCategory') }}" class="btn btn-secondary btn-round">Add Category</a>
						<a href="{{ route('jobIndustry') }}" class="btn btn-secondary btn-round">Add Industry</a>
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
                            @role("admin")
                            <a href="#"  id="add_job" class="btn btn-info btn-round float-right">Add Job</a>
                            @endrole
                            <h4 class="card-title">Available Jobs</h4>
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
            <div class="modal fade" id="jobModal" tabindex="-1" role="dialog" aria-labelledby="jobModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="jobModalLabel">Add | Edit Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <form class="form row " id="job_form">
                            @csrf
                            <input type="hidden" id="form_action" value="A">
                            <input type="hidden" id="row_id" >

                            <div class="form-group col-sm-12">
                                <label for="job_name">Name:</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter name" id="job_name" required>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="job_descr">Description:</label>
                                <textarea name="description" class="form-control" cols="5" id="job_descr" placeholder="Enter description" required></textarea>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="job_cat">Category:</label>
                                <select name="job_category_id" id="job_cat"class="form-control" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->id }} - {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="job_industry">Industry:</label>
                                <select name="job_industry_id" id="job_industry"class="form-control" required>
                                    @foreach($industries as $industry)
                                        <option value="{{ $industry->id }}">{{ $industry->id }} - {{ $industry->name }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group col-sm-6">
                                <label for="job_email">Email To Apply:</label>
                                <input type="email" name="email_apply" class="form-control" placeholder="Enter email" id="job_email">
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="work_time">Work Time:</label>
                                <select name="working_time" id="work_time"class="form-control" required>
                                    <option value="Full-Time">Full-Time</option>
                                    <option value="Part-Time">Part-Time</option>
                                </select>
                            </div>

                            




                            <div class="form-group col-sm-6">
                                <label for="job_salary"> Expected Salary:</label>
                                <input type="number" min="0" name="salary" class="form-control" placeholder="Enter salary" id="job_salary" required>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="job_company"> Company Name:</label>
                                <input type="text" name="company" class="form-control" placeholder="Enter company" id="job_company">
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="job_location">Location</label>
                                <input type="location" name="location" class="form-control" placeholder="Enter location" id="job_location">
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
                ajax: "{{ route('jobList') }}",
                columns: [
                    {data: 'title'},
                    {data: 'description'},
                    {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
			});

            // modal
            $("#add_job").click(()=>{
                $("#job_form")[0].reset();
                $("#form_action").val('A')
                $("#jobModal").modal()
            })

            $("#job_form").submit((e) => {
                e.preventDefault();

                let form_action = $("#form_action").val();
                let row_id = $("#row_id").val();
                let action_url = '';
                (form_action == 'A') ? action_url = "{{ route('jobCreate')}}" : action_url = "job_update/"+row_id;
                $.ajax({
                    url: action_url,
                    method: "post",
                    data: $("#job_form").serialize(),
                    success: (payload) => {
                        $('#basic-datatables').DataTable().ajax.reload();
                        console.log(payload);
                        $("#jobModal").modal('hide');
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
    function editJob(id) {
        $("#row_id").val(id);
        $("#form_action").val('E')
        
        //data to edit
        $.ajax({
            url: 'job_edit/'+id,
            method: 'get',
            success: (payload) => {
                console.log(payload.data);
                if(payload.data){
                    $("#job_name").val(payload.data.title);
                    $("#job_descr").val(payload.data.description);
                    $("#job_cat").val(payload.data.job_category_id);
                    $("#job_industry").val(payload.data.job_industry_id);
                    $("#job_email").val(payload.data.email_apply);
                    $("#work_time").val(payload.data.working_time);
                    $("#job_salary").val(payload.data.salary);
                    $("#job_company").val(payload.data.company);
                    $("#job_location").val(payload.data.location);
                }
                $("#jobModal").modal()
            },
            error: (err) => {console.error(err);}
        })
    }
</script>
@endsection
			
		
		
	