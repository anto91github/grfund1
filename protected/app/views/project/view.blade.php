<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('project?md='.$masterdetail["filtermd"]) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('project?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('project/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Title</td>
						<td>{{ $row->title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Author</td>
						<td>{{ SiteHelpers::gridDisplayView($row->author,'author','1:tb_users:id:email') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Category</td>
						<td>{{ SiteHelpers::gridDisplayView($row->category,'category','1:ms_projectcategory:id:name') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Start Date</td>
						<td>{{ $row->start_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Due Date</td>
						<td>{{ $row->due_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Amount</td>
						<td>{{ $row->amount }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Fund Amount</td>
						<td>{{ $row->fund_amount }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Status</td>
						<td>{{ SiteHelpers::gridDisplayView($row->status,'status','1:ms_status:status_id:status') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Subcategory</td>
						<td>{{ $row->subcategory }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  