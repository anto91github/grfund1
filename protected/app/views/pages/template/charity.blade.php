<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3> Charity <small> Category</small></h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
			<li class="active">Charity </li>
		  </ul>		
		</div>
		  
    </div>
</div>

<div class="container">
    <div class="row">
            <div class="col-md-2" style="border-right: 1px solid #E0E0E0;" >
                <ul class="menu">
                    <li class="@if($categorySearch=='all')
                                category-active
                            @else
                                category-inactive
                            @endif"><a href="http://localhost/grfund/charity?category=all">ALL</a></li>
                    <li class="@if($categorySearch=='crafts')
                                category-active
                            @else
                                category-inactive
                            @endif"><a href="http://localhost/grfund/charity?category=crafts">Crafts</a></li>
                    <li class="@if($categorySearch=='design')
                                category-active
                            @else
                                category-inactive
                            @endif"><a href="http://localhost/grfund/charity?category=design">Design</a></li>
                    <li class="@if($categorySearch=='games')
                                category-active
                            @else
                                category-inactive
                            @endif"><a href="http://localhost/grfund/charity?category=games">Games</a></li>
                </ul>
            </div>
            <div class="col-md-10">
                {{-- @foreach ($charityList as $charity) --}}
                        {{--*/ $i=0 /*--}}
			@foreach ($charityList as $charity)
				<div class="col-md-4" style="padding-left:10px;padding-right:10px; padding-bottom:5px;">
					<div style="border:1px solid #E8E8E8;  min-height:570px; overflow:hidden; ">
						<div style=" overflow:hidden;">
							<img src="{{ $charity->banner_img }}" stye="max-width:100%;" width="100%" height="250px" alt="{{ $charity->banner_img }}" />
						</div>
                                                <div style="padding-left:10px; padding-right:10px;">
                                                    <div style="padding-top:10px;" >
                                                            <a href="#"><h4>{{ $charity->title }}</a></h4>
                                                    </div>
                                                    <div style="padding-bottom:10px;" >{{ $charity->small_content }}</div>
                                                    <div style="height: 110px;">
                                                        <div class="donutHolder" id="itemholder{{ $i }}">
                                                            <div class="donut" id="itemdonut{{ $i }}"></div>
                                                            <span class="donutData" id="itemdonutData{{ $i }}"></span>   
                                                        </div>
                                                    </div>
                                                    <div style="text-align: center;"><h4 style="font-size:16px;">Rp {{ number_format($charity->fund_amount,0,",",".") }}<br/><small>of Rp {{ number_format($charity->amount,0,",",".") }}</small></h4></div>
                                                    <div style="text-align: center;"><h4 style="font-size: 16px;">6<small> pledger</small></h4></div>
                                                    <div style="text-align: center;"><h4 style="font-size: 16px;">{{ $charity->days_to_go->format("%d") }}<small> days left</small></h4></div>
                                                </div>
					</div>
                                    
				</div>
                            {{--*/ $i++ /*--}}
			@endforeach
                        <!--
                        <div class="col-md-4" style="padding-left:5px;padding-right:5px; padding-bottom:5px; margin-bottom: 10px;">
                                <div style="border:1px solid #696969; border-radius: 8px; min-height:360px; overflow:hidden;">
                                        <div style="border-top-left-radius:8px; border-top-right-radius:8px; overflow:hidden;">
                                                <img src="img/{{-- $charity->banner_img --}}" stye="max-width:100%;" width="100%" height="200px" alt="{{ $charity->banner_img }}" />
                                        </div>
                                        <div style="padding:10px 10px 0px 10px;" >
                                                <a href="#"><h4>{{-- $charity->title --}}</a></h4>
                                        </div>
                                        <div style="padding:0px 10px 10px 10px;" >{{-- $charity->small_content --}}</div>
                                        <div style="margin-left:10px; margin-right:10px;height:10px; border-radius:4px; background-color:#CCCCCC; overflow:hidden;">
                                                        <div style="background-color:#2bde73; height:100%; width: {{-- $charity->fund_percent --}}%" ></div>
                                        </div>
                                        <div style="margin-top: 5px;">
                                                <div class="col-md-3"><span style="font-weight:bold;">{{-- $charity->fund_percent --}}%<br/><small style="color:#999">Funded</small></span></div>
                                                <div class="col-md-5"><span style="font-weight:bold;">Rp.{{-- number_format($charity->amount,0,",",".") --}}<br/><small style="color:#999">Target</small></span></div>
                                                <div class="col-md-4"><span style="font-weight:bold;">{{-- $charity->days_to_go->format("%d") --}}<br/><small style="color:#999">days to go</small></span></div>
                                        </div>
                                </div>
                        </div>-->
                {{-- @endforeach --}}
            </div>
    </div>
		
		 <!--
		<div class="row">
			
		</div>
			 -->
</div>
<div id="test">
</div>
<br/>
<br/>
{{ HTML::script('js/jquery.flot.min.js') }}
{{ HTML::script('js/jquery.flot.pie.min.js') }}
<script type="text/javascript">
    /*
    $.post("protected/app/webservice/testing.php",{id:''},function(result){
        console.log(result);
        $("#test").html(result);
      });*/
    jQuery(document).ready(function(){
        {{--*/ $i=0 /*--}}
        @foreach ($charityList as $charity)
            var tmpdata = [
                { label:"Donated", data: {{ $charity->fund_amount }}, color:"#43B3CF" },
                { label:"Goal", data: {{ $charity->amount }}, color:"#D3D3D3" },
            ];
            $.plot($("#itemdonut{{ $i }}"), tmpdata,
            {
                series: {
                    pie: {
                        innerRadius: 0.8,
                        show: true,
                        label: { show: false }
                    }
                },
                legend: { show: false }
            });
            $("#itemdonutData{{ $i }}").text(Math.round(tmpdata[0].data/tmpdata[1].data*100)+"%");
            {{--*/ $i++ /*--}}
        @endforeach 
    });
</script>
		
<!--
<div class="container" style="margin-bottom:100px;">
	<div class="row">
	
	
	</div>
</div>-->