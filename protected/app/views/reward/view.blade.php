<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('reward?md='.$masterdetail["filtermd"]) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('reward?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('reward/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Project Id</td>
						<td>{{ SiteHelpers::gridDisplayView($row->project_id,'project_id','1:project:project_id:title') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Reward Title</td>
						<td>{{ $row->reward_title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Reward Description</td>
						<td>{{ $row->reward_description }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Reward Minimum</td>
						<td>{{ $row->reward_minimum }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Reward Available</td>
						<td>{{ $row->reward_available }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Reward Image</td>
						<td>{{ SiteHelpers::showUploadedFile($row->reward_image,'/uploads/reward/') }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  