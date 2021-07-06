
@extends("layouts.backend")
@section("content")
	<div class="content">
		<div class="panel-header bg-primary-gradient">
			<div class="page-inner py-5">
				<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
					<div>
						<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
						<h5 class="text-white op-7 mb-2">We Research, We Write. Get personalized Research Help in 100+ Fields. Also, find Your Dream Job Here..</h5>
					</div>
					<div class="ml-md-auto py-2 py-md-0">
						@role('admin')
						<a href="#" class="btn btn-white btn-border btn-round mr-2">Manage</a>
						<a href="#" class="btn btn-secondary btn-round">Add User</a>
						@endrole
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
							<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
								<div class="px-2 pb-2 pb-md-0 text-center">
									<div id="active_users_circle"></div>
									<h6 class="fw-bold mt-3 mb-0">Active Users</h6>
								</div>
								<div class="px-2 pb-2 pb-md-0 text-center">
									<div id="blogs_circle"></div>
									<h6 class="fw-bold mt-3 mb-0">Blogs</h6>
								</div>
								<div class="px-2 pb-2 pb-md-0 text-center">
									<div id="jobs_circle"></div>
									<h6 class="fw-bold mt-3 mb-0">Jobs</h6>
								</div>
								<div class="px-2 pb-2 pb-md-0 text-center">
									<div id="orders_circle"></div>
									<h6 class="fw-bold mt-3 mb-0">Orders</h6>
								</div>
								<div class="px-2 pb-2 pb-md-0 text-center">
									<div id="circles-3"></div>
									<h6 class="fw-bold mt-3 mb-0">Subscribers</h6>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>
		
			
			
			<div class="row">
				<div class="col-md-12">
					<div class="card full-height">
						<div class="card-header">
							<div class="card-title">Feed Activity</div>
						</div>
						<div class="card-body">
							<ol class="activity-feed">
								<li class="feed-item feed-item-secondary">
									<time class="date" datetime="9-25">Sep 25</time>
									<span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
								</li>
								<li class="feed-item feed-item-success">
									<time class="date" datetime="9-24">Sep 24</time>
									<span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
								</li>
								<li class="feed-item feed-item-info">
									<time class="date" datetime="9-23">Sep 23</time>
									<span class="text">Joined the group <a href="single-group.html">"Boardsmanship Forum"</a></span>
								</li>
								<li class="feed-item feed-item-warning">
									<time class="date" datetime="9-21">Sep 21</time>
									<span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
								</li>
								<li class="feed-item feed-item-danger">
									<time class="date" datetime="9-18">Sep 18</time>
									<span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
								</li>
								<li class="feed-item">
									<time class="date" datetime="9-17">Sep 17</time>
									<span class="text">Attending the event <a href="single-event.html">"Some New Event"</a></span>
								</li>
							</ol>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
@endsection

@section('scripts')
<script>
		Circles.create({
			id:'active_users_circle',
			radius:45,
			value:"{{ count($active_users) / count($users) * 100 }}",
			maxValue:100,
			width:7,
			text: "{{ count($active_users) }}",
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'blogs_circle',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: "{{ count($blogs) }}",
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'jobs_circle',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: "{{ count($jobs) }}",
			colors:['#f1f1f1', '#1269db'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'orders_circle',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: "{{ count($orders) }}",
			colors:['#f1f1f1', '#c1ec14'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: 12,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})



		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
@endsection
			
		
		
	