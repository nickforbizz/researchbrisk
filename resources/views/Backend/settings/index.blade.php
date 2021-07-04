
@extends("layouts.backend")
@section("content")
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Settings</h2>
						<h5 class="text-white op-7 mb-2">This are the settings for this site</h5>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
						<!-- <a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
						<a href="#" class="btn btn-secondary btn-round">Add Customer</a> -->
					</div>
				</div>
			</div>
		</div>
		
		<div class="page-inner mt--5">
			<div class="row mt--2">

				<div class="col-md-12">
					<div class="card full-height">
						<div class="card-body">
							<div class="card-title">Overall statistics</div>
							<div class="card-category">Daily information about statistics in system</div>

							<div class="row pb-2 pt-4">
								<div class="col-md-4">
								
								</div>
								<div class="col-md-8">

									<div class="card">
										<div class="card-header">
											<h4 class="card-title">Actions</h4>
										</div>
										<div class="card-body">
											<div class="row">
												@can('add role')
												<div class="col-sm-6 p-2">
													<button  class="btn btn-primary btn-round ml-2" id="add_role"  >Add Role</button>
												</div>
												@endcan


												<div class="col-sm-6 p-2">
													<button  class="btn btn-primary btn-round ml-2" id="add_permission"  >Add permission</button>
												</div>

												<div class="col-sm-6 p-2">
													<button  class="btn btn-primary btn-round ml-2" data-toggle="modal" data-target="#role_permissionModal" >Assign permissions to Role</button>
												</div>

												<div class="col-sm-6 p-2">
													<button  class="btn btn-primary btn-round ml-2" data-toggle="modal" data-target="#user_rolesModal" >Assigns Roles to User</button>
												</div>

												<div class="col-sm-6 p-2">
													<button  class="btn btn-primary btn-round ml-2" data-toggle="modal" data-target="#user_permissionsModal" >Assigns Permissions to User</button>
												</div>
												
											</div>

										</div>
									</div>
									<!-- .card -->
								
								</div>

								<div class="col-sm-12">
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="approle-tab" data-toggle="tab" href="#approle" role="tab" aria-controls="approle" aria-selected="true">Roles</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="apppermission-tab" data-toggle="tab" href="#apppermission" role="tab" aria-controls="apppermission" aria-selected="false">Permissions</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Other</a>
										</li>
									</ul>


									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="approle" role="tabpanel" aria-labelledby="approle-tab">
											
											<div class="card">
												<div class="card-header">
													<h4 class="card-title">Available Roles</h4>
												</div>
												<div class="card-body">
													<div class="table-responsive">
														<table id="tb_roles" class="display table table-striped table-hover" >
															<thead>
																<tr>
																	<th>Name</th>
																	<th>Guard</th>
																	<th>Created At</th>
																	<th>Actions</th>
																	
																</tr>
															</thead>
															<tbody></tbody>
														</table>
													</div>
												</div>
											</div>

										</div>


										<div class="tab-pane fade" id="apppermission" role="tabpanel" aria-labelledby="apppermission-tab">
											<div class="card">
												<div class="card-header">
													<h4 class="card-title">Available Permission</h4>
												</div>
												<div class="card-body">
													<div class="table-responsive">
														<table id="tb_permissions" class="display table table-striped table-hover" >
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



										<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
											<div class="card">
												<div class="card-header">
													<h4 class="card-title">Other Details</h4>
												</div>
												<div class="card-body">
													something
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>



				<div class="col-sm-12">
					<!-- // modal -->
					<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="roleModalLabel">Add | Edit role</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body mb-3">
								<form class="form row " id="role_form">
									@csrf
									<input type="hidden" id="form_action" value="A">
									<input type="hidden" id="row_id" >
									<div class="form-group col-sm-12">
										<label for="name"> Name:</label>
										<input type="text" name="name" class="form-control" placeholder="Enter name" id="role_name">
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




					<!-- permission modal -->
					<div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="permissionModalLabel">Add | Edit permission</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body mb-3">
								<form class="form row " id="permission_form">
									@csrf
									<input type="hidden" id="formP_action" value="A">
									<input type="hidden" id="rowP_id" >
									<div class="form-group col-sm-12">
										<label for="name"> Name:</label>
										<input type="text" name="name" class="form-control" placeholder="Enter name" id="permission_name">
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
					<!-- .modal -->



					<!-- permission modal -->
					<div class="modal fade" id="role_permissionModal" tabindex="-1" role="dialog" aria-labelledby="role_permissionModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="RolePermissionModalLabel">Role Give permission</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body mb-3">
								<form class="form row " id="role_give_permission_form" action="{{ route('roleGivePermissions') }}" method="post">
									@csrf
									<!-- <input type="hidden" id="form_action" value="A">
									<input type="hidden" id="row_id" > -->

									<div class="form-group col-sm-12">
										<label for="role_to_permissions">Select Role:</label>
										<select name="role_id" class=" select2 form-control" id="role_to_permissions" style="width: 100%" required>
											<option selected disabled>Choose your option</option>
											@foreach($roles as $role)
												<option value="{{ $role->id }}"> {{ $role->name }} </option>
											@endforeach
										</select>
									</div>

									<div class="form-group col-sm-12">
										<label for="to_permissions">Select Permissions:</label>
										<select name="to_permissions[]" class="select2 form-control " id="to_permissions" multiple="multiple" style="width: 100%" required>
											@foreach($permissions as $permission)
												<option value="{{ $permission->id }}"> {{ $permission->name }} </option>
											@endforeach
										</select>
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
					<!-- .modal -->



					<!-- user Roles modal -->
					<div class="modal fade" id="user_rolesModal" tabindex="-1" role="dialog" aria-labelledby="user_rolesModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="RolePermissionModalLabel">Assign User Roles</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body mb-3">
								<form class="form row " id="role_give_permission_form" action="{{ route('userGiveRoles') }}" method="post">
									@csrf
									<!-- <input type="hidden" id="form_action" value="A">
									<input type="hidden" id="row_id" > -->

									<div class="form-group col-sm-12">
										<label for="user_action">Select Action:</label>
										<select name="user_action" class=" select2 form-control" id="user_action" style="width: 100%" required>
											<option selected disabled>Choose your option</option>
											<option value="assign"> Assign </option>
											<option value="revoke"> Revoke </option>
										</select>
									</div>

									<div class="form-group col-sm-12">
										<label for="user_roles">Select User:</label>
										<select name="user_roles" class=" select2 form-control" id="user_roles" style="width: 100%" required>
											<option selected disabled>Choose your option</option>
											@foreach($users as $user)
												<option value="{{ $user->id }}"> {{ $user->name }} </option>
											@endforeach
										</select>
									</div>

									<div class="form-group col-sm-12">
										<label for="user2roles">Select Roles:</label>
										<select name="user2roles[]" class="select2 form-control " id="user2roles" multiple="multiple" style="width: 100%" required>
											@foreach($roles as $role)
												<option value="{{ $role->id }}"> {{ $role->name }} </option>
											@endforeach
										</select>
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
					<!-- .modal -->


						<!-- user user_permissionsModal modal -->
						<div class="modal fade" id="user_permissionsModal" tabindex="-1" role="dialog" aria-labelledby="user_permissionsModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="RolePermissionModalLabel">Assign User Roles</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body mb-3">
								<form class="form row " id="user_permissions_form" action="{{ route('userGivePermissions') }}" method="post">
									@csrf
									<!-- <input type="hidden" id="form_action" value="A">
									<input type="hidden" id="row_id" > -->

									<div class="form-group col-sm-12">
										<label for="user_permissions">Select User:</label>
										<select name="user_permissions" class=" select2 form-control" id="user_permissions" style="width: 100%" required>
											<option selected disabled>Choose your option</option>
											@foreach($users as $user)
												<option value="{{ $user->id }}"> {{ $user->name }} </option>
											@endforeach
										</select>
									</div>

									<div class="form-group col-sm-12">
										<label for="user2permissions">Select Permission:</label>
										<select name="user2permissions[]" class="select2 form-control " id="user2permissions" multiple="multiple" style="width: 100%" required>
											@foreach($permissions as $permission)
												<option value="{{ $permission->id }}"> {{ $permission->name }} </option>
											@endforeach
										</select>
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
					<!-- .modal -->


				</div>
				<!-- .col-sm-12 -->


			</div>
			<!-- .row mt--2 -->
			
			
			
		</div>
	</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {

			/// call tables
			authTbs('#tb_roles', "{{ route('roleList') }}");
			authTbs('#tb_permissions', "{{ route('permissionList') }}");


            // roles
            $("#add_role").click(()=>{
                $("#role_form")[0].reset();
                $("#form_action").val('A')
                $("#roleModal").modal()
            })

            $("#role_form").submit((e) => {
                e.preventDefault();

                let form_action = $("#form_action").val();
                let row_id = $("#row_id").val();
                let action_url = '';
                (form_action == 'A') ? action_url = "{{ route('roleCreate')}}" : action_url = "role_update/"+row_id;
                $.ajax({
                    url: action_url,
                    method: "post",
                    data: $("#role_form").serialize(),
                    success: (payload) => {
                        $('#tb_roles').DataTable().ajax.reload();
                        console.log(payload);
                        $("#roleModal").modal('hide');
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







			// Permission
            $("#add_permission").click(()=>{
                $("#permission_form")[0].reset();
                $("#form_action").val('A')
                $("#permissionModal").modal()
            })

            $("#permission_form").submit((e) => {
                e.preventDefault();

                let form_action = $("#formP_action").val();
                let row_id = $("#rowP_id").val();
                let action_url = '';
                (form_action == 'A') ? action_url = "{{ route('permissionCreate')}}" : action_url = "permission_update/"+row_id;
                $.ajax({
                    url: action_url,
                    method: "post",
                    data: $("#permission_form").serialize(),
                    success: (payload) => {
                        $('#tb_permissions').DataTable().ajax.reload();
                        console.log(payload);
                        $("#roleModal").modal('hide');
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




	// datatables
	function authTbs(tb_id, route) {
		$(tb_id).DataTable().destroy()
		$(tb_id).DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 5,
                // scrollX: true,
                "order": [[ 0, "desc" ]],
                ajax: route,
                columns: [
                    {data: 'name'},
                    {data: 'guard_name'},
                    {data: 'created_at'},
                    {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                ]
			});
	}

    // edit data
    function editRole(id) {
        $("#row_id").val(id);
        $("#form_action").val('E')
        
        //data to edit
        $.ajax({
            url: 'role_edit/'+id,
            method: 'get',
            success: (payload) => {
                console.log(payload.data);
                if(payload.data){
                    $("#role_name").val(payload.data.name)
                }
                $("#roleModal").modal()
            },
            error: (err) => {console.error(err);}
        })
    }

	function editPermission(id) {
        $("#rowP_id").val(id);
        $("#formP_action").val('E')
        
        //data to edit
        $.ajax({
            url: 'permission_edit/'+id,
            method: 'get',
            success: (payload) => {
                console.log(payload.data);
                if(payload.data){
                    $("#permission_name").val(payload.data.name)
                }
                $("#permissionModal").modal()
            },
            error: (err) => {console.error(err);}
        })
    }
</script>
@endsection
			
		
		
	