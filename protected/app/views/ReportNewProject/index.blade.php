{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
  <div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>

      <ul class="breadcrumb">
        <li><a href="{{ URL::to('dashboard') }}">{{ Lang::get('core.home') }}</a></li>
        <li class="active">{{ $pageTitle }}</li>
      </ul>	  
	  
    </div>

   
	
	
	<div class="page-content-wrapper">
    <div class="toolbar-line ">
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('ReportNewProject/add?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-info"  title="{{ Lang::get('core.btn_create') }}">
			<i class="icon-plus-circle2"></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}">
			<i class="icon-bubble-trash"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 		
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('ReportNewProject/download?md='.$masterdetail["filtermd"]) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_download') }}">
			<i class="icon-folder-download2"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif		
		 	@if(Session::get('gid') ==1)
			<a href="{{ URL::to('module/config/ReportNewProject') }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
			<i class="icon-cog"></i>&nbsp;{{ Lang::get('core.btn_config') }} </a>	
			@endif
	</div> 	
	 
		
	{{ $details }}
	
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
	{{ Form::open(array('url'=>'report/view', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) }}
		<div class="col-md-12">
			<fieldset>
				<div class="form-group">
					<!--<label for="Project Id" class=" control-label col-md-4 text-left">Project Name :</label>
						<div class="col-md-6">
							 <select class='form-control'>
								  <option value="all_project">ALL Project</option>
								  @foreach ($report1 as $r1)
								  <option value="{{$r1->project_alias}}">{{"$r1->title"}}</option>
								  @endforeach
							 </select> 
						</div>--> 
						 
						<label for="start_date" class=" control-label col-md-4 text-left">Start Date :</label>
						<div class="col-md-6">							 
								{{ Form::text('start_date', date('Y-m-d'), array('class'=>'form-control date', 'id'=>'start_date','style'=>'width:150px !important;')) }} 	  
						</div>
						<hr />
						<label for="end_date" class=" control-label col-md-4 text-left">End Date :</label>
						<div class="col-md-6">							 
								{{ Form::text('end_date', date('Y-m-d'), array('class'=>'form-control date', 'style'=>'width:150px !important;')) }} 	  
						</div>  									 
				</div> 		
			</fieldset>
	    </div>		  
				
			<div style="clear:both"></div>	
				
			  <div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
				
				<input type="submit" name="submit" class="btn btn-primary" value="View"/>
				
				</div>	  
		
			  </div> 
	</div>		
{{ Form::close() }}
			

	 {{ Form::open(array('url'=>'ReportNewProject/destroy/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) }}
	 <div class="table-responsive">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th> No </th>
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
						<th>{{ $t['label'] }}</th>
					@endif
				@endforeach
				<th>{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>
			

            @foreach ($report1 as $report)
            {{--*/ $id = SiteHelpers::encryptID($report->project_id) /*--}}
                <tr>
					<td width="50"> {{ ++$i }} </td>														
				 	<td>{{$report->project_id}}</td>				 	
				 	<td>{{$report->title}}</td>	
				 	<td>{{$report->start_date}}</td>
				 	<td>{{$report->due_date}}</td>
				 	<td>{{ number_format($report->amount,0,",",".") }}</td>
				 	<td><a href="{{ URL::to('project/add/'.$id)}}" class="tips btn btn-xs btn-success" title="Edit"><i class="fa fa-edit"></i></a></td>				 
                </tr>
				
            @endforeach
              
        </tbody>
      
    </table>
	<input type="hidden" name="md" value="{{ $masterdetail['filtermd']}}" />
	</div>
	{{ Form::close() }}

	
	</div>	  
</div>	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("ReportNewProject/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
</script>