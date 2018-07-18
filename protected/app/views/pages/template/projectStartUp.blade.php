<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3> Projects <small></small></h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
			<li class="active">Projects </li>
		  </ul>		
		</div>
		  
    </div>
</div>	
<div class="container">
    <div class="row">
            <div class="col-md-2" style="border-right: 1px solid #E0E0E0;" >
                <ul class="faq-section">
                    <li class="@if($categorySearch=='all')
                                active
                                @endif">
                        <a href="./projects?category=all"><strong>{{ Lang::get('core.project_sidemenu_all') }}</strong></a>
                    </li>
                   
                    <li class="@if($categorySearch=='art')
                                active        
                            @endif">
                        <a href="./projects?category=art">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_art') }}</a>
                    </li>
                    <li class="@if($categorySearch=='business')
                                active        
                            @endif">
                        <a href="./projects?category=business">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_business') }}</a>
                    </li>
                    <li class="@if($categorySearch=='charity')
                                active        
                            @endif">
                        <a href="./projects?category=charity">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_charity') }}</a>
                    </li>
                    <li class="@if($categorySearch=='community')
                                active        
                            @endif">
                        <a href="./projects?category=community">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_community') }}</a>
                    </li>
                    <li class="@if($categorySearch=='education')
                                active        
                            @endif">
                        <a href="./projects?category=education">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_education') }}</a>
                    </li>
                    <li class="@if($categorySearch=='emergency')
                                active        
                            @endif">
                        <a href="./projects?category=emergency">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_emergency') }}</a>
                    </li>
                    <li class="@if($categorySearch=='environment')
                                active        
                            @endif">
                        <a href="./projects?category=environment">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_environment') }}</a>
                    </li>
                    <!--<li class="@if($categorySearch=='event')
                                active        
                            @endif">
                        <a href="./projects?category=event">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_event') }}</a>
                    </li>-->
                    <!--<li class="@if($categorySearch=='family')
                                active        
                            @endif">
                        <a href="./projects?category=family">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_family') }}</a>
                    </li>-->
                    <li class="@if($categorySearch=='health')
                                active        
                            @endif">
                        <a href="./projects?category=health">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_health') }}</a>
                    </li>
                    <!--<li class="@if($categorySearch=='sport')
                                active        
                            @endif">
                        <a href="./projects?category=sport">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_sport') }}</a>
                    </li>-->
                    <li class="@if($categorySearch=='technology')
                                active        
                            @endif">
                        <a href="./projects?category=technology">&nbsp;&nbsp;&nbsp;{{ Lang::get('core.cat_technology') }}</a>
                    </li>
                    
					
                </ul>
            </div>
            <div class="col-md-10">
                <div id="container-project" class="col-md-12" style="margin:0px; padding:0px;">
                        {{--*/ $i=0 /*--}}
                        {{--*/ $flag=0 /*--}}
                       
			@foreach ($projectList as $project)
				<div class="col-sm-6 col-md-3" style="padding-left:15px;padding-right:15px; padding-bottom:10px;">
					<div style="border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; ">
						<div style=" overflow:hidden; border-radius: 4px;">
                                                    <a href="show-project/{{ $project->project_alias }}">{{ HTML::image('uploads/banner/'.$project->banner_img, $project->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'140px')) }}</a>
						</div>
                                                <div style="padding-left:10px; padding-right:10px;">
                                                    <div style="padding-top:10px;" >
                                                        <a class="project-title" href="show-project/{{ $project->project_alias }}" title="{{$project->title_lang}}"><h4>{{ substr($project->title_lang,0,20).(strlen($project->title_lang) > 18 ? "...": "") }}</a></h4>
                                                    </div>
                                                    <div style="padding-bottom:80px; height:70px;" >{{ $project->small_content_lang }}</div>
                                                    <div style="height: 90px;">
                                                        <div class="donutHolder" id="{{ $i }}" data-amount="{{ $project->amount }}" data-funded="{{ $project->hitung_f }}">
                                                            <div class="donut" id="itemdonut{{ $i }}"></div>
                                                            <span class="donutData" id="itemdonutData{{ $i }}"></span>   
                                                        </div>
                                                    </div>
                                                    <div style="text-align: center;"><h4 style="font-size:16px;">Rp {{ number_format($project->hitung_f,0,",",".") }}<br/><small>of Rp {{ number_format($project->amount,0,",",".") }}</small></h4></div>
                                                    <div style="text-align: center;"><h4 style="font-size: 16px;">{{ $project->backer }}<small> pledger</small></h4></div>
                                                    
                                                    @if( $project->days_to_go->format("%r%a") <= 0)
                                                        @if( $project->status == 2)                                                    
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; color: white; background-color: #1db262; padding-top:5px; padding-bottom:5px">Successful !</h4></div>
                                                        @elseif ($project->status == 3)  
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; color: white; background-color: #e54a1a; padding-top:5px; padding-bottom:5px">Unsuccessful !</h4></div>
                                                        @else
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:5px; padding-bottom:5px">0<small> days left</small></h4></div>
                                                        @endif                                                  
                                                    @else
                                                        <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:5px; padding-bottom:5px">{{ $project->days_to_go->format("%r%a") }}<small> days left</small></h4></div>
                                                    @endif
                                                </div>
					    </div>                                    
				</div>
                        {{--*/ $flag = $project->total /*--}} 
                        {{--*/ $i++ /*--}}                    
			@endforeach
                </div>   
                    @if( $i < $flag  )
                        <div class="col-md-12" align="center"><button type="button" id="btn-loadmore" class="btn btn-primary" >Load More </button>{{ HTML::image('images/ajax-loader.gif', 'loading', array('id' => 'img-loading', 'style'=>'display:none;')) }}</div>
                    @endif
                    
            </div>
    </div>
		
		 <!--
		<div class="row">
			
		</div>
			 -->
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
        var page = 1;
        var total;
        function redrawDonut(i, fund, goal){
                var tmpdata = [
                    { label:"Donated", data: fund, color: fund >= goal ? "#1db262" : "#43B3CF" },
                    { label:"Goal", data: goal-fund, color:"#D3D3D3" },
                ];
                $.plot($("#itemdonut"+i), tmpdata,
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
                $("#itemdonutData"+i).text(Math.round(fund/goal*100)+"%");
                $("#itemdonutData"+i).css('color',fund >= goal ? "#1db262" : "#43B3CF")
            }
            
        var handleDonutChart = function(){
            var all = $(".donutHolder").map(function() {
                return this;
            }).get();
            
            for(var arr in all){
                var donut = all[arr];
                redrawDonut(donut['id'],$(donut).data('funded'),$(donut).data('amount'));
            }
        }
        
        $(window).resize(function(){
            handleDonutChart();
        });
        handleDonutChart();
        
        
        $("#btn-loadmore").click(function(){
            var data = {"category":"{{ Input::get('category') }}","subcategory":"{{ Input::get('subcategory') }}", "page":page};
            $.ajax({
                    type: "POST",
                    url: "protected/app/webservice/getListProject.php",
                    data: data,
                    dataType: "json",
                    beforeSend:function(){                            
                        //success1.hide();                    
                        //error1.hide();
                        $("#btn-loadmore").css("display","none");
                        $("#img-loading").css("display","inherit");
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        alert(errorThrown);
                        //success1.hide();                    
                        //error1.show();     
                        $("#btn-loadmore").css("display","inherit");
                        $("#img-loading").css("display","none");
                    },
                    success: function(data){
                        console.log('masuk '+data);
                        for(var arr in data){
                            var proj = data[arr];
                             var i = 0;
                            var codeHtml = "<div class=\"col-sm-6 col-md-3\" style=\"padding-left:15px;padding-right:15px; padding-bottom:10px;\">";
                            codeHtml +="<div style=\"border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; \">";
                            codeHtml +="<div style=\"overflow:hidden; border-radius: 4px;\">";
                            codeHtml +="<a href=\"show-project/"+proj['project_alias']+"\"><img src=\"uploads/banner/"+proj['banner_img']+"\" stye=\"max-width:100%;\" width=\"100%\" height=\"140px\" alt=\""+proj['banner_img']+"\" /></a>";
                            codeHtml +="</div>";
                            codeHtml +="<div style=\"padding-left:10px; padding-right:10px;\">";
                            codeHtml +="<div style=\"padding-top:10px;\" >";
                            codeHtml +="<a class=\"project-title\" href=\"show-project/"+proj['project_alias']+"\" title=\""+proj['title']+"\"><h4>"+proj['formated_title']+"</a></h4>";
                            codeHtml +="</div>";
                            codeHtml +="<div style=\"padding-bottom:0px; height:70px;\" >"+proj['small_content']+"</div>";
                            codeHtml +="<div style=\"height: 90px;\">";
                            codeHtml +="<div class=\"donutHolder\" id=\""+proj['project_alias']+"\" data-amount=\""+proj['amount']+"\" data-funded=\""+proj['hitung_f']+"\">";   //cek untuk id donut
                            codeHtml +="<div class=\"donut\" id=\"itemdonut"+proj['project_alias']+"\"></div>";
                            codeHtml +="<span class=\"donutData\" id=\"itemdonutData"+proj['project_alias']+"\"></span>";
                            codeHtml +="</div>";
                            codeHtml +="</div>";
                            codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px;\">Rp "+proj['formated_hitung_f']+"<br/><small>of Rp "+proj['formated_amount']+"</small></h4></div>";
                            codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px;\">"+proj['backer']+"<small> pledger</small></h4></div>";
                            
                            if(proj['formated_days'] <= 0)
                            {
                                if(proj['status']  == 2)
                                {
                                   codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px; color: white; background-color: #00FF00; padding-top:5px; padding-bottom:5px\">Successful !</h4></div>";
                                }
                                else if(proj['status']  == 3)
                                {
                                    codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px; color: black; background-color: #FF5050; padding-top:5px; padding-bottom:5px\">Unsuccessful !</h4></div>";
                                }
                                else
                                {
                                    codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px; padding-top:5px; padding-bottom:5px\">0<small> days left</small></h4></div>";  
                                }
                            }
                            else
                            {
                            codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px; padding-top:5px; padding-bottom:5px\">"+proj['formated_days']+"<small> days left</small></h4></div>";
                            }

                            codeHtml +="</div>";
                            codeHtml +="</div>";
                            codeHtml +="</div>";
                            
                            $("#container-project").append(codeHtml);
                            i++;
                            total = proj['project_total'];
                        }   
                        //console.log(total);

                        if(data.length > 0){
                            handleDonutChart();
                            page++;

                            if(total == page )
                             {
                                $("#btn-loadmore").css("display","none");
                                $("#img-loading").css("display","none");
                             }
                            else
                             {
                                $("#btn-loadmore").css("display","inherit");
                                $("#img-loading").css("display","none");
                             }
                        }
                      
                    }
                });
        });
    });
</script>				