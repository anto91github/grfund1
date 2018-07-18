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
	   		<a href="{{ URL::to('ProjectNew/add?md='.$masterdetail["filtermd"].$trackUri) }}" class="tips btn btn-xs btn-info"  title="{{ Lang::get('core.btn_create') }}">
			<i class="icon-plus-circle2"></i>&nbsp;{{ Lang::get('core.btn_create') }}</a>
			@endif  
			@if($access['is_remove'] ==1)
			<a href="javascript://ajax"  onclick="SximoDelete();" class="tips btn btn-xs btn-danger" title="{{ Lang::get('core.btn_remove') }}">
			<i class="icon-bubble-trash"></i>&nbsp;{{ Lang::get('core.btn_remove') }}</a>
			@endif 		
			@if($access['is_excel'] ==1)
			<a href="{{ URL::to('ProjectNew/download?md='.$masterdetail["filtermd"]) }}" class="tips btn btn-xs btn-default" title="{{ Lang::get('core.btn_download') }}">
			<i class="icon-folder-download2"></i>&nbsp;{{ Lang::get('core.btn_download') }} </a>
			@endif		
		 	@if(Session::get('gid') ==1)
			<a href="{{ URL::to('module/config/ProjectNew') }}" class="tips btn btn-xs btn-default"  title="{{ Lang::get('core.btn_config') }}">
			<i class="icon-cog"></i>&nbsp;{{ Lang::get('core.btn_config') }} </a>	
			@endif  			
	 
	</div> 	
	 
		
	@if(Session::has('message'))	  
		   {{ Session::get('message') }}
	@endif	
	{{ $details }}
	
	 {{ Form::open(array('url'=>'ProjectNew/destroy/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) }}
	 <div class="table-responsive">
    <table class="table table-striped ">
        <thead>
			<tr>
				<th> No </th>
				<th> <input type="checkbox" class="checkall" /></th>
				<th>Title</th>
				<th>Author</th>
				<th>Due Date</th>
				<th>Amount</th>
				<th>Status</th>				
				
				<th>{{ Lang::get('core.btn_action') }}</th>
			  </tr>
        </thead>

        <tbody>
			<!--<tr id="sximo-quick-search" >
				<td> # </td>
				<td> </td>

				<td style="width:130px;">
				<input type="hidden"  value="Search">
				<button type="button"  class=" do-quick-search btn btn-sx btn-info"> GO</button></td>
			  </tr>-->				
            @foreach ($rowData as $row)
                <tr>
					<td width="50"> {{ ++$i }}</td>
					<td width="50"><input type="checkbox" class="ids" name="id[]" value="{{ $row->project_id }}" />  </td>									
					 	<!--loop disini-->
					 						 	
					 	<td>{{$row->title}}</td>
					 	<td>{{$row->first_name}} {{$row->last_name}}</td>
					 	<td>{{$row->due_date}}</td>
					 	<td>{{$row->amount}}</td>
					 	<td>{{$row->status}}</td>					 	
					 	<!--end loop disini-->
					 	
				 <td>
				 	
					{{--*/ $id = SiteHelpers::encryptID($row->project_id) /*--}}
				 	@if($access['is_detail'] ==1)
					<a href="{{ URL::to('ProjectNew/show/'.$id.'?md='.$masterdetail["filtermd"].$trackUri)}}"  class="tips btn btn-xs btn-primary"  title="{{ Lang::get('core.btn_view') }}"><i class="fa  fa-search"></i> </a>
					@endif
					@if($access['is_edit'] ==1)
					<a  href="{{ URL::to('ProjectNew/add/'.$id.'?md='.$masterdetail["filtermd"].$trackUri)}}"  class="tips btn btn-xs btn-success"  title="{{ Lang::get('core.btn_edit') }}"> <i class="fa fa-edit"></i></a>
					@endif
					@foreach($subgrid as $md)
					<a href="{{ URL::to($md['module'].'?md='.$md['master'].'+'.$md['master_key'].'+'.$md['module'].'+'.$md['key'].'+'.$id) }}"  class="tips btn btn-xs btn-info"  title=" {{ $md['title'] }}">
						<i class="icon-eye2"></i></a>
					@endforeach							
					
				</td>				 
                </tr>
				
            @endforeach
              
        </tbody>
      
    </table>
	<input type="hidden" name="md" value="{{ $masterdetail['filtermd']}}" />
	</div>
	{{ Form::close() }}
	@include('footer')
	
	</div>	  
</div>	
<script>
$(document).ready(function(){

	$('.do-quick-search').click(function(){
		$('#SximoTable').attr('action','{{ URL::to("ProjectNew/multisearch")}}');
		$('#SximoTable').submit();
	});
	
});	
</script>		