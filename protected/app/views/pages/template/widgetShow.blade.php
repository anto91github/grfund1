{{--*/ $i=0 /*--}}


@foreach ($projectList as $project)
    <div class="col-sm-6 col-md-3" style="padding-left:1px;padding-right:1px; padding-bottom:1px; padding-top:1px;">
        <div style="border:3px solid #E8E8E8;  min-height:400px; overflow:hidden; border-radius:5px ">
				<div style=" overflow:hidden; border-radius: 4px;">
					<a href="show-project/{{ $project->project_alias }}">{{ HTML::image('uploads/banner/'.$project->banner_img, $project->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'140px')) }}</a>
				</div>
			<div style="padding-left:10px; padding-right:10px;">
						<div style="padding-top:10px;" >
							<a class="project-title" href="show-project/{{ $project->project_alias }}" title="{{$project->title}}"><h4>{{ substr($project->title,0,23).(strlen($project->title) > 22 ? "...": "") }}</a></h4>
						</div>
						<div style="padding-bottom:80px; height:70px;" >{{ $project->small_content }}</div>
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
    
    {{--*/ $i++ /*--}}                    
@endforeach
    
            
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
        
        
       
    });
</script>