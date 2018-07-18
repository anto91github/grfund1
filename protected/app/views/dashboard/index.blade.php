{{ HTML::script('sximo/js/plugins/chartjs/Chart.min.js') }}
<div class="page-content row">
	<div class="page-header">
	  <div class="page-title">
		<h3> Dashboard <small> Summary info site </small></h3>
	  </div>

		  <ul class="breadcrumb">
			<li><a href="{{ URL::to('config/dashboard') }}">Home</a></li>
			<li class="active">Dashboard</li>
		  </ul>
		  
	</div>
	<div class="page-content-wrapper"> 	
	
	@if(Session::get('gid') ==1 || Session::get('gid') ==2)
		<section >	
				<div class="row m-l-none m-r-none m-t  white-bg shortcut " >				
					<h4 style="padding-left:20px;">New Submitted Project</h4>
				</div>					 
					<div class="table-responsive">
						    <table class="table table-striped ">
						        <thead>
									<tr>
										<th> No </th>
										<th> Name</th>					
										<th> Tgl. Submit</th>											
										<th> Email</th>
										<th> Owner</th>
										<th> Show</th>
									  </tr>
						        </thead>
						        	  {{--*/ $i=1 /*--}}
						        <tbody>
						        	@foreach ($pending as $p)
						        	{{--*/ $id = SiteHelpers::encryptID($p->project_id) /*--}}
							          <tr>
							          	<td width="50"> {{ $i }}</td>
							          	<td>{{ $p->title }}</td>
							          	<td>{{ $p->created_date }}</td>
							          	<td>{{ $p->email }}</td>
							          	<td>{{ $p->first_name }}</td>
							          	<td><a href="{{ URL::to('project/add/'.$id)}}" class="tips btn btn-xs btn-success" title="Edit"><i class="fa fa-edit"></i></a></td>
							          </tr>
							          {{--*/ $i++ /*--}}
						          @endforeach    
						        </tbody>						      
						    </table>							
						</div>						
				

				<div class="row m-l-none m-r-none m-t  white-bg shortcut " >		
					<h4 style="padding-left:20px;">Expired Project</h4>
				</div> 
					<div class="table-responsive">
						    <table class="table table-striped ">
						        <thead>
									<tr>
										<th> No </th>
										<th> Name </th>
										<th> Due Date</th>					
										<th> Total</th>											
										<th> Funded</th>										
										<th> Show</th>
									 </tr>
						        </thead>
						        		{{--*/ $i=1 /*--}}	  
						        <tbody>
						        	@foreach ($expired as $e)
						        	{{--*/ $id = SiteHelpers::encryptID($e->project_id) /*--}}
							          <tr>
							          	<td width="50">{{ $i }}</td>							          	
							          	<td width="300">{{ $e->title }}</td>
							          	<td width="220">{{ $e->due_date }}</td>
							          	<td width="258">{{ number_format($e->amount,0,",",".") }}</td>
							          	<td>{{  number_format($e->funded,0,",",".") }}</td>
							          	<td><a href="{{ URL::to('project/add/'.$id)}}" class="tips btn btn-xs btn-success" title="Edit"><i class="fa fa-edit"></i></a></td>
							          </tr>
							          {{--*/ $i++ /*--}}
						          @endforeach    
						        </tbody>						      
						    </table>							
						</div>	

				<div class="row m-l-none m-r-none m-t  white-bg shortcut " >		
					<h4 style="padding-left:20px;">Draft backer</h4>
				</div> 
					<div class="table-responsive">
						    <table class="table table-striped ">
						        <thead>
									<tr>
										<th> No </th>
										<th> Name </th>
										<th> Back Date</th>					
										<th> Project</th>											
										<th> Reward</th>
										<th> Payment</th>										
										<th> Show</th>
									 </tr>
						        </thead>
						        		{{--*/ $i=1 /*--}}	  
						        <tbody>
						        	@foreach ($draft as $d)
						        	{{--*/ $id = SiteHelpers::encryptID($d->backer_id) /*--}}
							          <tr>
							          	<td width="50">{{ $i }}</td>							          	
							          	<td width="150">{{ $d->name }}</td>
							          	<td width="150">{{ $d->backer_date }}</td>
							          	<td width="258">{{ $d->title }}</td>
							          	<td>{{ $d->reward_title }}</td>
							          	<td width="100">{{ $d->payment_method }} </td>
							          	<td><a href="{{ URL::to('backer/add/'.$id)}}" class="tips btn btn-xs btn-success" title="Edit"><i class="fa fa-edit"></i></a></td>
							          </tr>
							          {{--*/ $i++ /*--}}
						          @endforeach    
						        </tbody>						      
						    </table>							
						</div>

				<div class="row m-l-none m-r-none m-t  white-bg shortcut " >		
					<h4 style="padding-left:20px;">Project Canceled</h4>
				</div> 
					<div class="table-responsive">
						    <table class="table table-striped ">
						        <thead>
									<tr>
										<th> No </th>
										<th> Name</th>					
										<th> Tgl. Submit</th>											
										<th> Email</th>
										<th> Owner</th>
										<th> Show</th>
									  </tr>
						        </thead>
						        		{{--*/ $i=1 /*--}}	  
						        <tbody>
						        	@foreach ($cancel as $c)
						        	{{--*/ $id = SiteHelpers::encryptID($c->project_id) /*--}}
							          <tr>
							          	<td width="50"> {{ $i }}</td>
							          	<td>{{ $c->title }}</td>
							          	<td>{{ $c->created_date }}</td>
							          	<td>{{ $c->email }}</td>
							          	<td>{{ $c->first_name }}</td>
							          	<td><a href="{{ URL::to('project/add/'.$id)}}" class="tips btn btn-xs btn-success" title="Edit"><i class="fa fa-edit"></i></a></td>
							          </tr>
							          {{--*/ $i++ /*--}}
						          @endforeach    
						        </tbody>						      
						    </table>							
						</div>	
		</section>	

				
	</div>
	@endif




