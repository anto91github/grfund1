<?php
	$alias= Input::get('p');
?>
<div class="wrapper-header ">
    <div class="container" >
        <div class="col-sm-6 col-xs-6">
          <div class="page-title" style="padding-bottom:10px;">
            <h3> Get Widget Project <small></small></h3>
          </div>
        </div>
        <div class="col-sm-6 col-xs-6 ">
          <ul class="breadcrumb pull-right">
            <li><a href="{{ URL::to('show-project/'.$alias) }}">Project</a></li>                       
            <li class="active">Get Widget Project 123</li>
          </ul>     
        </div>
          
    </div>
</div>  

<div class="container">
    <div class="row" style="">
        <div id="wid-height" class="col-md-12" style="height:840px">
        <div class="col-md-3">
	        <div style="font-size:20pt;">Ukuran:</div>
	        <div>
		        <select id="widsize" style="font-size:16pt;width:250px">
		        	<option value="general-size">General - 240 X 470</option>
		        	<option value="medium-size">Medium - 650 X 200</option>
		        	<option value="small-size">Small - 650 X 70</option>
		        </select>
	        </div>
	      </div>
	      <div class="col-md-9">
	      	<div style="font-size:20pt">Preview :</div>
	      	<div id="wid-height2" style="background-color:#F5F5F5; height:780px; width:760px;">
	      		<div style="text-align:center">
	      			<iframe id="widgen" src="http://www.gotongroyong.fund/widgetShow/{{$alias}}" style="padding-top:20px;display:inline" frameborder="0" height="490" width="240" scrolling="no"></iframe>
	      			<iframe id="widmed" src='http://www.gotongroyong.fund/widgetMed/{{$alias}}' style="padding-top:20px;display:none" frameborder='0' height='210' width='650' scrolling='no'></iframe>
	      			<iframe id="widsml" src='http://www.gotongroyong.fund/WidgetSml/{{$alias}}' style="padding-top:20px;display:none" frameborder='0' height='90' width='650' scrolling='no'></iframe>	      			
	      		</div>
	      		<div style="padding-left:20px; padding-top:30px;">
	      			<div style="font-size:14pt; font-weight:bold">Kode :</div>	      			
	      				<textarea id="igeneral" style="width:600px;height:75;text-align:left;font-size:14pt;display:inline" readonly="readonly" ><iframe src="http://www.gotongroyong.fund/widgetShow/{{$alias}}" frameborder="0" height="470" width="240" scrolling="no"></iframe></textarea>
	      				<textarea id="imed" style="width:600px;height:75;text-align:left;font-size:14pt;display:none" readonly="readonly" ><iframe src='http://www.gotongroyong.fund/widgetMed/{{$alias}}' frameborder='0' height='200' width='650' scrolling='no'></iframe></textarea>
	      				<textarea id="isml" style="width:600px;height:75;text-align:left;font-size:14pt;display:none" readonly="readonly" ><iframe src='http://www.gotongroyong.fund/WidgetSml/{{$alias}}' frameborder='0' height='70' width='650' scrolling='no'></iframe></textarea>
	      			<div style="font-size:14pt; font-weight:bold; padding-top:30px">Cara Memasukan Widget ke Website Anda :</div>
	      			<div style="font-size:12pt">1. Paste kode widget ke kode halaman web Anda</div>
    				<div style="font-size:12pt">2. Refresh halaman Anda untuk melihat perubahan</div>
    				<div style="padding-left:10px;padding-top:10px">NB: Anda harus memiliki akses admin ke halaman web host untuk menambahkan widget.</div>
	
	      		</div>
	      	</div>
	      </div>
    </div>
</div>	

<script type="text/javascript">
jQuery(document).ready(function(){

	$('#widsize').on('change', function() {
		if(this.value == "medium-size")
		{
			$('#igeneral').css('display', 'none');
			$('#widgen').css('display', 'none');

			$('#widsml').css('display', 'none');
			$('#isml').css('display', 'none');

			$('#imed').css('display', 'inline');
			$('#widmed').css('display', 'inline');

			$('#wid-height2').css('height', '500px');
			$('#wid-height').css('height', '550px');			
		}
		else if(this.value == "small-size")
		{
			$('#widsml').css('display', 'inline');
			$('#isml').css('display', 'inline');

			$('#igeneral').css('display', 'none');
			$('#widgen').css('display', 'none');

			$('#imed').css('display', 'none');
			$('#widmed').css('display', 'none');

			$('#wid-height2').css('height', '380px');
			$('#wid-height').css('height', '450px');

		}
		else
		{
			$('#widsml').css('display', 'none');
			$('#isml').css('display', 'none');
			
			$('#imed').css('display', 'none');
			$('#widmed').css('display', 'none');

			$('#igeneral').css('display', 'inline');
			$('#widgen').css('display', 'inline');	

			$('#wid-height2').css('height', '780px');
			$('#wid-height').css('height', '840px');			
		}
	
	
  		
	});

});
</script>	