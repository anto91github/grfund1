<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "86d54a76-a930-440e-9900-706d82f0623a", doNotHash: true, doNotCopy: true, hashAddressBar: true});</script>
<style>
    .stButton 
    {
        font-size: 11px;
        line-height: 16px;
        margin-left: 3px;
        margin-right: 3px;
        position: relative;
        z-index: 1;
    }
    
    .stButton .stFb, .stButton .stTwbutton, .stButton .stMainServices
    {
    background-image: url("/images/facebook_counter.png");
    background-repeat: no-repeat;
    display: inline-block;
    font-family: Verdana,Helvetica,sans-serif;
    font-size: 11px;
    height: 100%;
    line-height: 20px;
    padding-bottom: 3px;
    padding-top: 3px;
    position: relative;
    white-space: nowrap;
    width: auto;
    }
    
    .stButton .st-sharethis-counter 
    {
    width: 86px;
    line-height: 25px;
    }
    
    .stButton .st-facebook-counter
    {
    width: 86px;
    margin-left: 35px;
    line-height: 25px;
    }
    
    .stButton .st-twitter-counter
    {
    width: 86px;
    margin-left: 35px;
    line-height: 25px;
    }

    .stButton .st-email-counter 
    {
    width: 60px;
    margin-left: 35px;
    line-height: 25px;
    }
    
    .stButton .stArrow 
    {
    background: url("http://w.sharethis.com/share4x/images/bubble_arrow.png") no-repeat scroll 3px 8px rgba(0, 0, 0, 0);
    display: inline-block;
    height: 14px;
    line-height: 25px;
    margin-left: -1px;
    padding-left: 3px;
    padding-top: 1px;
    width: 7px;
    }

.stButton .stHBubble
 {
    display: none;
    margin-left: 3px;
    margin-right: 3px;
    position: relative;
    z-index: -1;
}
.stButton .stButton_gradient {
    background: -moz-linear-gradient(center top , #d5d5d5 0px, #efefef 48%, #fff 94%) repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #bfbfbf;
    border-radius: 4px;
    display: inline-block;
    font-family: serif;
    height: 20px;
    width: 35px;
}

.stButton .stBubble_hcount {
    font-family: Verdana,Helvetica,sans-serif;
    font-size: 11px;
    height: 16px;
    line-height: 15px;
    white-space: nowrap;
    margin-left: 1px;
    vertical-align: 4px;
}
.stButton .st-twitter-counter, .stButton .st-facebook-counter {
    width: 60px;
}
</style>
<div class="wrapper-header ">
    <div class="container" >
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title" style="padding-bottom:10px;">
			<h3> {{ $project->title }} <small></small></h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
                        <li><a href="{{ URL::to('projects') }}">Projects</a></li>
			<li class="active">{{ $project->title }} </li>
		  </ul>		
		</div>
		  
    </div>
</div>	
<div class="container">
        <div class="row" style="padding-left: 30px; padding-right: 30px;">
            @if(Input::get("step") == "" || Input::get("step") < 1 || Input::get("step") > 2 )
            <ul class="nav nav-pills">
                <li class="active" style="width:200px;font-size:18px;text-align:center; background-color:#dadac8;">
                        <a href="#tabHome" data-toggle="tab">
                        Home </a>
                </li>
                <li style="width:200px;font-size:18px;text-align:center; background-color:#dadac8;">
                        <a href="#tabBacker" data-toggle="tab">
                        Backers </a>
                </li>
            </ul>
            <div class="tab-content col-md-8" style="padding-left:0px; padding-right:0px;">
                <div class="tab-pane fade active in" id="tabHome" style="border:1px solid #D8D8D8; background-color: #FFFFFF; padding-top:10px; padding-bottom:10px; padding-left:20px; padding-right:20px; ">
                    {{ HTML::image('uploads/banner/'.$project->banner_img, $project->banner_img, array('width'=>'100%')) }}
                    <br/><br/>
					<div class="project-social col-md-12" style="display:inline-block; padding-top:10px; padding-bottom:1px; padding-left:20px; background-color:#DADAC8;">
					    <span class='st_sharethis_hcount' displayText='ShareThis'></span>
                        <span class='st_facebook_hcount' displayText='Facebook'></span>
                        <span class='st_twitter_hcount' displayText='Tweet'></span>
                        <span class='st_email_hcount' displayText='Email'></span>
					</div>
					<div>&nbsp;</div>
                    {{ html_entity_decode($project->content) }}
                </div>
				
                <div class="tab-pane fade in" id="tabBacker" style="padding-left:20px; padding-right:20px;">
                    @if(count((array)$backers) > 0)
                    @foreach($backers as $backer)
                    <div class="row" style="border:1px solid #E8E8E8; padding:10px; margin-bottom:5px; margin-top:5px; background-color: #E8E8E8;">
                        <div class="col-md-2" style="width:90px;"><img src="../uploads/users/default.png" width="100%" alt="default" style="border:1px solid green;" /></div>
                        <div class="col-md-2"><span style="font-size:16px;">{{ $backer->name }}</span></div>
                        <div class="col-md-8"><span style="font-size:16px;">Rp. {{ number_format($backer->backer_amount,0,",",".") }} - {{ $backer->reward_title }}</span></div>
                    </div>
                    @endforeach
                    @else
                    <div class="row" style="border:1px solid #E8E8E8; padding:10px; margin-bottom:5px; margin-top:5px; background-color: #E8E8E8;">
                        <div class="col-md-12"><span style="font-size:16px;">No backers</span></div>
                    </div>
                    @endif
                </div>
            </div>
            @elseif(Input::get("step") == 1)
            {{ Form::open(array('url'=>'show-project/submitpledge?pid='.$pid, 'id'=>'formPledge')) }}
            <div class="col-md-8" style="border:1px solid #D8D8D8; background-color: #f2f2f2; padding-top:10px; padding-bottom:10px; padding-left:20px; padding-right:20px;">
                <div class="col-md-12"><h3>How much would you like to contribute?</h3></div>
                <span class="col-md-1 color-green" style="font-size:20px;">Rp. </span><div class="col-md-4"><input type="text" id="amount" name="amount" class="form-control" style="border:1px solid #1DB262;" value="{{ Input::get('amount') }}"></div>
                <div class="col-md-12" style="margin-top:10px;">
                    <span style="font-size:19px;">Choose your reward :</span>
                </div>
                <div class="col-md-12">
                    <ul class="reward-wrapper">
                        @foreach($rewards as $reward)
                        <li>
                            <label style="width:100%;">
                                <input type="radio" id="{{ $reward->reward_id }}" value="{{ $reward->reward_id }}" name="reward" 
                                       @if(Input::get('pledge') == $reward->reward_id)
                                            checked="checked"
                                       @endif
                                       style="float:left;">
                                <div style="float:left; width: 93%; margin-left: 15px; ">
                                    @if($reward->reward_image != "")
                                    <img src="../uploads/reward/{{ $reward->reward_image }}" width="120" style="float:right;" alt="{{ $reward->reward_image }}">
                                    @endif
                                    <h4>{{ $reward->reward_title }}</h4>
                                    <div>pledge Rp. {{ number_format($reward->reward_minimum,0,",",".") }} or more</div>
                                    <p style="font-weight: normal; ">{{ $reward->reward_description }}</p>
                                </div>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12"><h3>Who are you</h3></div>
                    <div class="col-md-12">Your name</div><div class="col-md-12"><input type="text" name="name" class="form-control"></div>
                    <div class="col-md-12">Email</div><div class="col-md-12"><input type="text" name="email" class="form-control"></div>
                    <div class="col-md-12">Comment</div><div class="col-md-12"><textarea name="comment" class="form-control"></textarea></div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12"><h3>Choose a funding method</h3></div>
                    <div class="col-md-12">Please select your funding method</div>
                    <div class="col-md-12">
                        <ul style="padding:0px;">
                            <li style="list-style:outside none none;"><input type="radio" id="p1" value="veritrans" name="pm"> Credit Card</li>
                            <li style="list-style:outside none none;"><input type="radio" id="p2" value="transfer" name="pm"> Bank Transfer</li>
                            <li style="list-style:outside none none;"><input type="radio" id="p3" value="others" name="pm"> Other Payment</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px; text-align:center;"><button type="submit" class="btn btn-primary" id="btn-sub-fun">Commit to Funding</button></div>
            </div>
            {{ Form::close() }}
            @elseif(Input::get("step") == 2)
            {{ Form::open(array('url'=>'show-project/topuppledge?pid='.$pid.'&bid='.$backerid, 'id'=>'formTopup' )) }}
            <div class="col-md-8" style="border:1px solid #D8D8D8; background-color: #f2f2f2; padding-top:10px; padding-bottom:10px; padding-left:20px; padding-right:20px;">
                <div class="col-md-12"><h3>Your Pledge</h3></div>
                <span class="col-md-1 color-green" style="font-size:20px;">Rp. </span><div class="col-md-4"><input type="text" id="pledgeAmount" name="pledgeamount" class="form-control" style="border:1px solid #1DB262;" value="{{ $topup->backer_amount }}" readonly="readonly"></div>
                <div class="col-md-12" style="margin-top:10px;"><h3>How much would you like to top up?</h3></div>
                <span class="col-md-1 color-green" style="font-size:20px;">Rp. </span><div class="col-md-4"><input type="text" id="topupAmount" name="topupamount" class="form-control" style="border:1px solid #1DB262;" value="0"></div>
                <div class="col-md-12" style="margin-top:10px;">
                    <span style="font-size:19px;">Choose your reward :</span>
                </div>
                <div class="col-md-12">
                    <ul class="reward-wrapper">
                        @foreach($rewards as $reward)
                        <li>
                            <label style="width:100%;">
                                <input type="radio" id="{{ $reward->reward_id }}" value="{{ $reward->reward_id }}" name="reward" 
                                       @if($topup->reward_id == $reward->reward_id)
                                            checked="checked"
                                       @endif
                                       style="float:left;">
                                <div style="float:left; width: 93%; margin-left: 15px; ">
                                    @if( $reward->reward_image != "" )
                                    <img src="../uploads/reward/{{ $reward->reward_image }}" width="120" style="float:right;" alt="{{ $reward->reward_image }}">
                                    @endif
                                    <h4>{{ $reward->reward_title }}</h4>
                                    <div>pledge Rp. {{ number_format($reward->reward_minimum,0,",",".") }} or more</div>
                                    <p style="font-weight: normal;">{{ $reward->reward_description }}</p>
                                </div>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12"><h3>Who are you</h3></div>
                    <div class="col-md-12">Your name</div><div class="col-md-12"><input type="text" class="form-control" value="{{ $topup->name }}"></div>
                    <div class="col-md-12">Email</div><div class="col-md-12"><input type="text" class="form-control" value="{{ $topup->email }}"></div>
                    <div class="col-md-12">Comment</div><div class="col-md-12"><textarea class="form-control">{{ $topup->comment }}</textarea></div>
                </div>
                <div class="col-md-6">
                    <div class="col-md-12"><h3>Choose a funding method</h3></div>
                    <div class="col-md-12">Please select your funding method</div>
                    <div class="col-md-12">
                        <ul style="padding:0px;">
                            <li style="list-style:outside none none;"><input type="radio" id="p1" value="veritrans" name="pm"> Credit Card</li>
                            <li style="list-style:outside none none;"><input type="radio" id="p2" value="transfer" name="pm"> Bank Transfer</li>
                            <li style="list-style:outside none none;"><input type="radio" id="p3" value="others" name="pm"> Other Payment</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top:10px; text-align:center;"><button type="submit" class="btn btn-primary">Commit to Topup</button></div>
            </div>
            {{ Form::close() }}
            @endif
            <div class="col-md-4">
                <div style="border:1px solid #E8E8E8;  min-height:260px; overflow:hidden; margin-bottom: 10px; background-color: #FFFFFF;">
                        <div style="padding:10px;">
                            <div align="center" >
                                <a class="projecttitle" href="{{ $project->project_alias }}"><h3>{{ $project->title }}</h3></a>
                            </div>
                            <div style="height: 90px;">
                                <div class="donutHolder" id="itemholder0">
                                    <div class="donut" id="itemdonut0"></div>
                                    <span class="donutData" id="itemdonutData0"></span>   
                                </div>
                            </div>
							 @foreach($total_fund as $jumlah)
                            <div style="text-align: center;"><h4 style="font-size:16px;">Rp {{ number_format($jumlah->hitung_f,0,",",".") }}<br/><small>of Rp {{ number_format($project->amount,0,",",".") }}</small></h4></div>
                            @endforeach
							<div style="text-align: center;"><h4 style="font-size: 16px;">{{ count((array)$backers) }}<small> pledger</small></h4></div>
                            @if( $project->days_to_go->format("%r%a") <= 0)
                                        @if( $project->status == 2)                                                    
                                            <div style="text-align: center;"><h4 style="font-size: 16px; color: white; background-color: #00FF00;">Successful !</h4></div>
                                        @elseif ($project->status == 3)  
                                            <div style="text-align: center;"><h4 style="font-size: 16px; background-color: #FF5050;">Unsuccessful !</h4></div>
                                        @else
                                        <div style="text-align: center;"><h4 style="font-size: 16px;">0<small> days left</small></h4></div>
                                        @endif                                                  
                                    @else
                                        <div style="text-align: center;"><h4 style="font-size: 16px;">{{ $project->days_to_go->format("%r%a") }}<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                                        @endif
                            <div style="text-align: center;"><h4 style="font-size: 16px;"><small>project finished at {{ $project->due_date }}</small></h4></div>
                             @if( $project->days_to_go->format("%r%a") > 0)
                            <div class="text-center"><a href="?step=1" class="btn btn-primary" >Fund this project</a></div>
                             @endif                           
                        </div>
                </div>
                <div class="col-md-12" style="border:1px solid #E8E8E8; padding-top:5px; padding-bottom:5px; margin-bottom:10px; background-color: #E8E8E8; padding-right:0px; border:1px solid green;">
                    <div class="col-md-4" style="padding:0px; width: 80px;"><img src="../uploads/users/{{ $project->avatar == null ? 'default.png' : $project->avatar }}" width="100%" alt="{{ $project->avatar }}" /></div>
                    <div class="col-md-8" style="padding:0px; padding-left:10px; padding-right: 0px; margin-right:0px;"><h4 style="padding-right:0px; margin-right:0px; margin-bottom:0px;"><small>project sponsor</small><br/>{{ $project->first_name }} {{ $project->last_name }}</h4><span class="fa fa-map-marker"></span> {{ $project->country }}, {{ $project->city }}</div>
                </div>
                @foreach($rewards as $reward)
                <div class="col-md-12 container-reward" style="margin-bottom:10px;">
                    <div><h3 style="margin-bottom:0px">{{ $reward->reward_title }}</h3></div>
					@if($reward->reward_available > 0)
                    <div>
							<span class="available" style='color:#f05c50'>
							<?php
								$a =$reward->reward_available;
								$b=	$reward->hitung_h;
								$c= $a-$b;
							?>
							({{$c}} of {{ $reward->reward_available }} Available)
							</span>
					</div>
                    @endif
					<div><img src="../uploads/reward/{{ $reward->reward_image }}" width="80" style="float:left; margin-right:15px" alt="{{ $reward->reward_image }}">{{ $reward->reward_description }}</div>
                    @if($project->days_to_go->format("%r%a") > 0)
                        @if($c > 0)
                            <div style="width:100%; float:left; margin-top:5px;" align="center" ><a href="?step=1&pledge={{ $reward->reward_id }}&amount={{ $reward->reward_minimum }}" class="btn btn-primary" style="width: 200px;">Fund Rp. {{ number_format($reward->reward_minimum,0,",",".") }} or more</a></div>
                        @else
                            <div style="width:100%; float:left; margin-top:5px;" align="center" class="btn btn-primary">Out of Stock</div>
                        @endif
                    @endif
                </div>
                @endforeach

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
{{ HTML::script('sximo/js/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}
<script type="text/javascript">
    /*
    $.post("protected/app/webservice/testing.php",{id:''},function(result){
        console.log(result);
        $("#test").html(result);
      });*/



    jQuery(document).ready(function(){
        
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
                $("#itemdonutData"+i).text(Math.round(fund / goal*100)+"%");
            }
            
        var handleDonutChart = function(){
			var hitung ={{$jumlah->hitung_f == null ? 0 : $jumlah->hitung_f}} ;
            redrawDonut(0,hitung, {{ $project->amount }});            
        }
        
        $(window).resize(function(){
            handleDonutChart();
        });
        handleDonutChart();
        
        $.extend($.inputmask.defaults, {
                'autounmask': true
            });
        $("#amount").inputmask('999.999.999.999', {
                numericInput: true
            }); //123456  =>  € ___.__1.234,56
        $("#pledgeAmount").inputmask('999.999.999.999', {
                numericInput: true
            }); //123456  =>  € ___.__1.234,56
            $("#topupAmount").inputmask('999.999.999.999', {
                numericInput: true
            }); //123456  =>  € ___.__1.234,56
			
		$("#btn-sub-fun").click(function()
		{
            if($('#amount').val()=="")
            {
                alert("Insert How much would you like to contribute ");
                return false;
            }
            if ( ! $("input[name='reward']").is(':checked') )
            {
                alert("Please Choose Your Reward ");
                return false;
            }
		   if ( ! $("input[name='pm']").is(':checked') )
			{
				alert("Choose Your Funding Method ");
				return false;
			}			
        });
			
    });
</script>				