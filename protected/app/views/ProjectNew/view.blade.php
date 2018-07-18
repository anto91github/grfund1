<div class="page-content row">
    <!-- Page header -->
    <div class="page-header">
      <div class="page-title">
        <h3> {{ $pageTitle }} <small>{{ $pageNote }}</small></h3>
      </div>
      <ul class="breadcrumb">
        <li><a href="{{ URL::to('config/dashboard') }}">{{ Lang::get('core.home') }}</a></li>
		<li><a href="{{ URL::to('ProjectNew?md='.$masterdetail["filtermd"]) }}">{{ $pageTitle }}</a></li>
        <li class="active"> {{ Lang::get('core.detail') }} </li>
      </ul>
	 </div>  
	 
	 
 	<div class="page-content-wrapper">   
	   <div class="toolbar-line">
	   		<a href="{{ URL::to('ProjectNew?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_back') }}"><i class="icon-table"></i>&nbsp;{{ Lang::get('core.btn_back') }}</a>
			@if($access['is_add'] ==1)
	   		<a href="{{ URL::to('ProjectNew/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-primary" title="{{ Lang::get('core.btn_edit') }}"><i class="icon-pencil3"></i>&nbsp;{{ Lang::get('core.btn_edit') }}</a>
			@endif  		   	  
		</div>
	<div class="table-responsive">
	<table class="table table-striped table-bordered" >
		<tbody>	
	
					<tr>
						<td width='30%' class='label-view text-right'>Project Id</td>
						<td>{{ $row->project_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Title</td>
						<td>{{ $row->title }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Author</td>
						<td>{{ $row->author }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Category</td>
						<td>{{ $row->category }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Start Date</td>
						<td>{{ $row->start_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Small Content</td>
						<td>{{ $row->small_content }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Content</td>
						<td>{{ $row->content }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Content En</td>
						<td>{{ $row->content_en }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Due Date</td>
						<td>{{ $row->due_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Banner Img</td>
						<td>{{ $row->banner_img }} </td>
						
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
						<td>{{ $row->status }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Created Date</td>
						<td>{{ $row->created_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Modified By</td>
						<td>{{ $row->modified_by }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Modified Date</td>
						<td>{{ $row->modified_date }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Subcategory</td>
						<td>{{ $row->subcategory }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Entry By</td>
						<td>{{ $row->entry_by }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Project Tags</td>
						<td>{{ $row->project_tags }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Project Alias</td>
						<td>{{ $row->project_alias }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Recipient</td>
						<td>{{ $row->recipient }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Issue</td>
						<td>{{ $row->issue }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Who We Are</td>
						<td>{{ $row->who_we_are }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>What Need</td>
						<td>{{ $row->what_need }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Impact</td>
						<td>{{ $row->impact }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Time Line</td>
						<td>{{ $row->time_line }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Ack Reward</td>
						<td>{{ $row->ack_reward }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Facebook</td>
						<td>{{ $row->facebook }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Facebook Id</td>
						<td>{{ $row->facebook_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Twitter</td>
						<td>{{ $row->twitter }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Twitter Id</td>
						<td>{{ $row->twitter_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Google</td>
						<td>{{ $row->google }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Google Id</td>
						<td>{{ $row->google_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Instagram</td>
						<td>{{ $row->instagram }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Instagram Id</td>
						<td>{{ $row->instagram_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Youtube</td>
						<td>{{ $row->youtube }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Youtube Id</td>
						<td>{{ $row->youtube_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Linkedin</td>
						<td>{{ $row->linkedin }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Linkedin Id</td>
						<td>{{ $row->linkedin_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Img Content1</td>
						<td>{{ $row->img_content1 }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Img Content2</td>
						<td>{{ $row->img_content2 }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Img Content3</td>
						<td>{{ $row->img_content3 }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Url</td>
						<td>{{ $row->url }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Staff Pick</td>
						<td>{{ $row->staff_pick }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Widget Id</td>
						<td>{{ $row->widget_id }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>NPWP</td>
						<td>{{ $row->NPWP }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>KTP</td>
						<td>{{ $row->KTP }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>SIUP</td>
						<td>{{ $row->SIUP }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>Domicile</td>
						<td>{{ $row->Domicile }} </td>
						
					</tr>
				
		</tbody>	
	</table>    
	</div>
	</div>
</div>
	  