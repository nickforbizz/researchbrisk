<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from themekita.com/demo-atlantis-lite-bootstrap/livepreview/examples/demo1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 May 2021 11:23:50 GMT -->
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>ResearchBrisk Admin Dashboard</title>
	<meta name="csrf_token" content="{{ csrf_token() }}" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

	
	<link rel="icon" href="https://themekita.com/demo-atlantis-lite-bootstrap/livepreview/examples/assets/img/icon.ico" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="{{ asset('backend/js/plugin/webfont/webfont.min.js') }}"></script>
	

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/atlantis.min.css') }}">

	<!-- CSS Just for your project -->
	<link rel="stylesheet" href="{{ asset('backend/css/master.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/font-awesome-4.7.0/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('common/css/toastr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('common/css/select2.min.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
	<style>
        body{
            /* background: #f1f1f1; */
        }
        .card-body{
            background: #efefefde !important;
        }
		.modal-body{
			margin-bottom: 3rem;
		}
    </style>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="index.html" class="logo">
					<img src="https://themekita.com/demo-atlantis-lite-bootstrap/livepreview/examples/assets/img/logo.svg" alt="navbar brand" class="navbar-brand">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<!-- <div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</form>
					</div> -->
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-envelope"></i>
							</a>
							<ul class="dropdown-menu messages-notif-box animated fadeIn" aria-labelledby="messageDropdown">
								<li>
									<div class="dropdown-title d-flex justify-content-between align-items-center">
										Messages 									
										<a href="#" class="small">Mark all as read</a>
									</div>
								</li>
								<li>
									<div class="message-notif-scroll scrollbar-outer">
													<div class="notif-center">
											<a href="#">
												<div class="notif-img"> 
													<img src="{{ asset('backend/img/jm_denis.jpg') }}" alt="Img Profile">
												</div>
												<div class="notif-content">
													<span class="subject">Jimmy Denis</span>
													<span class="block">
														How are you ?
													</span>
													<span class="time">5 minutes ago</span> 
												</div>
											</a>
											
											
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all messages<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">4</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notification</div>
								</li>
								<li>
									<div class="notif-scroll scrollbar-outer">
										<div class="notif-center">
											<a href="#">
												<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
												<div class="notif-content">
													<span class="block">
														New user registered
													</span>
													<span class="time">5 minutes ago</span> 
												</div>
											</a>
											
										</div>
									</div>
								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Quick Actions</span>
									<span class="subtitle op-8">Shortcuts</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<a class="col-6 col-md-4 p-0" href="#">
												<div class="quick-actions-item">
													<i class="flaticon-file-1"></i>
													<span class="text">Generated Report</span>
												</div>
											</a>
											
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="{{ asset('backend/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="{{ asset('backend/img/profile.jpg') }}" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4>{{ Auth::user()->name }}</h4>
												<p class="text-muted">{{ Auth::user()->email }}</p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">My Profile</a>
										<a class="dropdown-item" href="#">Inbox</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Account Setting</a>
										<div class="dropdown-divider"></div>
										<form action="{{ route('logout') }}" method="post" class="">
											@csrf
											<button type="submit" class="dropdown-item">Logout</button>
										</form>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="{{ asset('backend/img/profile.jpg') }}" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									{{ Auth::user()->name }}
									<span class="user-level">{{ Auth::user()->email }}</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">

						<li class="nav-item {{ (request()->routeIs('dashboard')) ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <span class="sub-item">Dashboard </span>
                            </a>							
						</li>

						@role("superadmin|admin|student")
						<li class="nav-item {{ (request()->routeIs('academic*')) ? 'active' : '' }}">
							<a data-toggle="collapse" href="#academics">
								<p>Academics</p>
								<span class="caret"></span>
							</a>
							<div class="collapse {{ (request()->routeIs('academic*')) ? 'show' : '' }}" id="academics">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('academicFormat') }}">
											<span class="sub-item">Formats</span>
										</a>
									</li>	
									<li>
										<a href="{{ route('academicCategory') }}">
											<span class="sub-item">Categories</span>
										</a>
									</li>	
									<li>
										<a href="{{ route('academicOrderPage') }}">
											<span class="sub-item">Orders</span>
										</a>
									</li>						
								</ul>
							</div>
						</li>
						@endrole

						@role("superadmin|admin|writer")
                        <li class="nav-item {{ (request()->routeIs('blog*')) ? 'active' : '' }}">
							<a data-toggle="collapse" href="#blogs">
								<p>Blogs</p>
								<span class="caret"></span>
							</a>
							<div class="collapse  {{ (request()->routeIs('blog*')) ? 'show' : '' }}" id="blogs">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('blogCategory') }}">
											<span class="sub-item">Categories</span>
										</a>
									</li>
									<li>
										<a href="{{ route('blogPage') }}">
											<span class="sub-item">Blog</span>
										</a>
									</li>						
								</ul>
							</div>
						</li>
						@endrole

						@role('superadmin|admin')
						<li class="nav-item {{ (request()->routeIs('job*')) ? 'active' : '' }}">
							<a data-toggle="collapse" href="#jbs">
								<p>Jobs</p>
								<span class="caret"></span>
							</a>
							<div class="collapse  {{ (request()->routeIs('job*')) ? 'show' : '' }}" id="jbs">
								<ul class="nav nav-collapse">
									<li>
										<a href="{{ route('jobCategory') }}">
											<span class="sub-item">Categories</span>
										</a>
									</li>
									<li>
										<a href="{{ route('jobIndustry') }}">
											<span class="sub-item">Industries</span>
										</a>
									</li>
									<li>
										<a href="{{ route('job') }}">
											<span class="sub-item">Job</span>
										</a>
									</li>						
								</ul>
							</div>
						</li>

                        <li class="nav-item">
							<a href="{{ route('manageUsers') }}">
								<p>Users</p>
							</a> 
                        </li>

						<li class="nav-item">
							<a href="{{ route('settings') }}">
								<p>Settings</p>
							</a> 
                        </li>
						@endrole

                        <li class="nav-item">
							<form action="{{ route('logout') }}" method="post" class="mt-4">
								@csrf
								<button type="submit" class="btn nav-item">Logout</button>
							</form>
                        </li>
					
					</ul>
				</div>
			</div>
		</div>
		<!-- End Sidebar -->


        <div class="main-panel">
            <!-- content here -->
            @yield("content")


			<!-- // modal -->
            <div class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="delModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="delModalLabel">Delete Item!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
						<input type="hidden" class="form-control" id="del_id" readonly>
						<input type="hidden" class="form-control" id="del_url" readonly>
						<p class="text-danger">Are you sure you want to delete this item? </p>
                    </div>
                    <div class="modal-footer">
						<button type="button" class="btn btn-primary" id="del_item">Proceed</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					</div>
                    </div>
                </div>
            </div>

            <footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="https://www.themekita.com/">
									ThemeKita
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com/">ThemeKita</a>
					</div>				
				</div>
			</footer>
		</div>

        </div>
	<!--   Core JS Files   -->
	<script src="{{ asset('backend/js/core/jquery.3.2.1.min.js') }}"></script>
	<script src="{{ asset('backend/js/core/popper.min.js') }}"></script>
	<script src="{{ asset('backend/js/core/bootstrap.min.js') }}"></script>

	<!-- jQuery UI -->
	<script src="{{ asset('backend/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src="{{ asset('backend/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('backend/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


	<!-- Chart JS -->
	<script src="{{ asset('backend/js/plugin/chart.js/chart.min.js') }}"></script>

	<!-- jQuery Sparkline -->
	<script src="{{ asset('backend/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

	<!-- Chart Circle -->
	<script src="{{ asset('backend/js/plugin/chart-circle/circles.min.js') }}"></script>

	<!-- Datatables -->
	<script src="{{ asset('backend/js/plugin/datatables/datatables.min.js') }}"></script>

	<!-- Bootstrap Notify -->
	<script src="{{ asset('backend/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

	<!-- jQuery Vector Maps -->
	<script src="{{ asset('backend/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
	<script src="{{ asset('backend/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('backend/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

	<!-- Atlantis JS -->
	<script src="{{ asset('backend/js/atlantis.min.js') }}"></script>
	<script src="{{ asset('common/js/toastr.min.js') }}"></script>
	<script src="{{ asset('common/js/select2.min.js') }}"></script>
	




	<script>

		$('.select2').select2({
			theme: 'bootstrap4',
			placeholder: 'choose your option(s)'
		});

		// delete item with id provided
		$("#del_item").click((e) => {
			let url = $("#del_url").val();
			let del_id = $("#del_id").val();
			$.ajax({
				url: url+"/"+del_id,
				method: 'DELETE',
				data : { 
					"_token": "{{ csrf_token() }}" 
				},
				success: function(payload) {
					// handle success
					
					$("#del_url, #del_id").val('');
					console.log(payload);
					$("#delModal").modal('hide');
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
				error: function(request,msg,error) {
					// handle failure
					console.error(error)
					$.notify({
						icon: 'flaticon-alarm-1',
						message: 'Fatal error while deleting item',
					},{
						type: 'info',
						time: 1000,
					});
				}
			});
		})
		
		// helper funcs
		function delData(id, url) {
			$("#del_id").val(id);
			$("#del_url").val(url);
			$("#delModal").modal()
		}
	</script>




	<!-- notifications -->
	<script>
		 @if(Session::has('message'))
			var type = "{{ Session::get('alert-type', 'info') }}";
			switch(type){
				case 'info':
					toastr.info("{{ Session::get('message') }}");
					break;

				case 'warning':
					toastr.warning("{{ Session::get('message') }}");
					break;

				case 'success':
					toastr.success("{{ Session::get('message') }}");
					break;

				case 'error':
					toastr.error("{{ Session::get('message') }}");
					break;
			}
		@endif
	</script>


    @yield('scripts')

    
</body>

</html>