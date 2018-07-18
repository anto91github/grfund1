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
                        <a href="http://localhost/grfund/projects?category=all"><strong>{{ Lang::get('core.project_sidemenu_all') }}</strong></a>
                    </li>
                    <li class="@if($categorySearch=='creative-project')
                                active
                                @endif">
                        <a href="http://localhost/grfund/projects?category=creative-project"><strong>{{ Lang::get('core.project_sidemenu_project') }}</strong></a>
                    </li>
                    <li class="@if($categorySearch=='art')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=art">&nbsp;&nbsp;&nbsp;Art & Creative</a>
                    </li>
                    <li class="@if($categorySearch=='crafts')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=crafts">&nbsp;&nbsp;&nbsp;Business/Startup</a>
                    </li>
                    <li class="@if($categorySearch=='dance')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=dance">&nbsp;&nbsp;&nbsp;Charity</a>
                    </li>
                    <li class="@if($categorySearch=='design')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=design">&nbsp;&nbsp;&nbsp;Community</a>
                    </li>
                    <li class="@if($categorySearch=='film-video')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=film-video">&nbsp;&nbsp;&nbsp;Education</a>
                    </li>
                    <li class="@if($categorySearch=='fashion')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=fashion">&nbsp;&nbsp;&nbsp;Emergency</a>
                    </li>
                    <li class="@if($categorySearch=='food')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=food">&nbsp;&nbsp;&nbsp;Environment</a>
                    </li>
                    <li class="@if($categorySearch=='games')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=games">&nbsp;&nbsp;&nbsp;Event</a>
                    </li>
                    <li class="@if($categorySearch=='journalism')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=journalism">&nbsp;&nbsp;&nbsp;Family</a>
                    </li>
                    <li class="@if($categorySearch=='music')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=music">&nbsp;&nbsp;&nbsp;Health & Disabilities</a>
                    </li>
                    <li class="@if($categorySearch=='photography')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=photography">&nbsp;&nbsp;&nbsp;Sport</a>
                    </li>
                    <li class="@if($categorySearch=='publishing')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=publishing">&nbsp;&nbsp;&nbsp;Technology</a>
                    </li>
                    
					@foreach ($listCharity as $list)
                    <li>					
                        <a href="show-project/{{$list->project_alias}}">{{$list->title}}</a>
                    </li>	
					@endforeach
                    <li class="@if($categorySearch=='solidarity')
                                active
                                @endif">
                        <a href="http://localhost/grfund/projects?category=solidarity"><strong>SOLIDARITY</strong></a>
                    </li>
					@foreach ($listSolidarity as $solid)
                    <li>					
                        <a href="show-project/{{$solid->project_alias}}">{{$solid->title}}</a>
                    </li>	
					@endforeach
                    <li class="@if($categorySearch=='gift')
                                active        
                                @endif">
                        <a href="http://localhost/grfund/projects?category=gift"><strong>GIFT</strong></a>
                    </li>
                    <li class="@if($categorySearch=='birthday')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=birthday-gift">&nbsp;&nbsp;&nbsp;Birthday</a>
                    </li>
                    <li class="@if($categorySearch=='farewell')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=farewell-gift">&nbsp;&nbsp;&nbsp;Farewell</a>
                    </li>
                    <li class="@if($categorySearch=='wedding')
                                active        
                            @endif">
                        <a href="http://localhost/grfund/projects?subcategory=wedding-gift">&nbsp;&nbsp;&nbsp;Wedding</a>
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
                                                        <a class="project-title" href="show-project/{{ $project->project_alias }}" title="{{$project->title}}"><h4>{{ substr($project->title,0,26) }}</a></h4>
                                                    </div>
                                                    <div style="padding-bottom:0px; height:70px;" >{{ $project->small_content }}</div>
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
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; color: white; background-color: #00FF00;">Successful !</h4></div>
                                                        @elseif ($project->status == 3)  
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; background-color: #FF5050;">Unsuccessful !</h4></div>
                                                        @else
                                                            <div style="text-align: center;"><h4 style="font-size: 16px;">0<small> days left</small></h4></div>
                                                        @endif                                                  
                                                    @else
                                                        <div style="text-align: center;"><h4 style="font-size: 16px;">{{ $project->days_to_go->format("%r%a") }}<small> days left</small></h4></div>
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
                    { label:"Donated", data:  fund , color:"#43B3CF" },
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
                                   codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px; color: white; background-color: #00FF00;\">Successful !</h4></div>";
                                }
                                else if(proj['status']  == 3)
                                {
                                    codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px; color: black; background-color: #FF5050;\">Unsuccessful !</h4></div>";
                                }
                                else
                                {
                                    codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px;\">0<small> days left</small></h4></div>";  
                                }
                            }
                            else
                            {
                            codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px;\">"+proj['formated_days']+"<small> days left</small></h4></div>";
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