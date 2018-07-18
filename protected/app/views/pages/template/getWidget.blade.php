<div class="wrapper-header ">
    <div class="container" >
        <div class="col-sm-6 col-xs-6">
          <div class="page-title" style="padding-bottom:10px;">
            <h3> Get Widget <small></small></h3>
          </div>
        </div>
        <div class="col-sm-6 col-xs-6 ">
          <ul class="breadcrumb pull-right">
            <li><a href="{{ URL::to('') }}">Home</a></li>                       
            <li class="active">Get Widget</li>
          </ul>     
        </div>
          
    </div>
</div>  

<div class="container">
    <div class="row" style="">
        <div id="wid-height" class="col-md-12" style="height:800px">
        <div class="col-md-3">
	        <div style="font-size:20pt;">Ukuran:</div>
	        <div>
		        <select id="widsize" style="font-size:16pt;width:250px">
		        	<option value="general-size">General - 250 X 385</option>
		        	<option value="medium-size">Medium - 650 X 150</option>
		        </select>
	        </div>
	      </div>
	      <div class="col-md-9">
	      	<div style="font-size:20pt">Preview :</div>
	      	<div id="wid-height2" style="background-color:#F5F5F5; height:740px; width:760px;">
	      		<div style="text-align:center">
	      			<iframe id="widgen" height="405" width="250" style="padding-top:20px; display:inline" src="http://www.gotongroyong.fund/widgetGen" frameborder="0"></iframe>
	      			<iframe id="widmed" height="165" width="650" style="padding-top:20px; display:none" src="http://www.gotongroyong.fund/widgetGenMed" frameborder="0"></iframe>
	      		</div>
	      		<div style="padding-left:20px; padding-top:30px;" >
	      			<div style="font-size:14pt; font-weight:bold">Kode :</div>	      			
	      				<textarea id="igeneral" style="width:600px;height:75;text-align:left;font-size:14pt;display:inline" readonly="readonly" ><iframe height="385" width="250" src="http://www.gotongroyong.fund/widgetGen" frameborder="0"></iframe></textarea>
	      				<textarea id="imed" style="width:600px;height:75;text-align:left;font-size:14pt;display:none" readonly="readonly" ><iframe height="150" width="650" src="http://www.gotongroyong.fund/widgetGenMed" frameborder="0"></iframe></textarea>
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

			$('#imed').css('display', 'inline');
			$('#widmed').css('display', 'inline');

			$('#wid-height2').css('height', '460px');
			$('#wid-height').css('height', '550px');
			//alert(this.value);
		}
		else
		{
			$('#igeneral').css('display', 'inline');
			$('#widgen').css('display', 'inline');

			$('#imed').css('display', 'none');
			$('#widmed').css('display', 'none');

			$('#wid-height2').css('height', '740px');
			$('#wid-height').css('height', '800px');
			//alert(this.value);
		}
	//alert(this.value);
	
  		
	});

});
</script>	
