<script type="text/javascript">var switchTo5x=true;</script>
<!--<script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>-->
<!--<script type="text/javascript">stLight.options({publisher: "86d54a76-a930-440e-9900-706d82f0623a", doNotHash: true, doNotCopy: true, hashAddressBar: true});</script>-->
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=835062946569282";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>


<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.4";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


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
    //background-image: url("/images/facebook_counter.png");
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
    //background: url("http://w.sharethis.com/share4x/images/bubble_arrow.png") no-repeat scroll 3px 8px rgba(0, 0, 0, 0);
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

.fb-btn{
    background-color:#3b5998;
    border-radius: 15px;
    width:90px;
    text-align: center;
    color:white;
    font-size:30px;
    padding-top:10px;
    padding-bottom: 10px;
    margin-top: 10px;
    margin-left: 60px;  
}

.fb-btn:hover{
    background-color:#324C81;
}
.tw-btn{
    background-color:#55acee;
    border-radius: 15px;
    width:90px;
    text-align: center;
    color:white;
    font-size:30px;
    padding-top:10px;
    padding-bottom: 10px;
    margin-top: 10px; 
    margin-left: 20px; 
}
.tw-btn:hover{
    background-color: #3A9FEB;
}
</style>

<link rel="image_src" href="../images/20120826113520!Indomaret_Baru_1.png"/>
<!--<img src="../images/20120826113520!Indomaret_Baru_1.png" width="100%" alt="default" style="border:1px solid green;" />-->
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
                <li style="width:200px;font-size:18px;text-align:center; background-color:#dadac8;">
                        <a href="#tabComment" id="fb-comment" data-toggle="tab">
                        Comments </a>
                </li>
            </ul>
            <div class="tab-content col-md-8" style="padding-left:0px; padding-right:0px;">
                <div class="tab-pane fade active in" id="tabHome" style="border:1px solid #D8D8D8; background-color: #FFFFFF; padding-top:10px; padding-bottom:10px; padding-left:20px; padding-right:20px; ">
                    {{ HTML::image('uploads/banner/'.$project->banner_img, $project->banner_img, array('width'=>'100%')) }}
                    <br/><br/>
					<!--<div class="project-social col-md-12" style="display:inline-block; padding-top:10px; padding-bottom:1px; padding-left:20px; background-color:#DADAC8;">
					    <span class='st_sharethis_hcount' displayText='ShareThis'></span>
                        <span class='st_facebook_hcount' displayText='Facebook'></span>
                        <span class='st_twitter_hcount' displayText='Tweet'></span>
                        <span class='st_email_hcount' displayText='Email'></span>
					</div>-->
                    <div class="col-md-12" style="display:inline-block; padding-top:3px; padding-bottom:1px; padding-left:20px; background-color:#DADAC8;"></div>
					<div>&nbsp;</div>
                    {{-- html_entity_decode($project->content) --}}
                    <div><div style="color:#000; font-weight:bold; font-size:18px;">{{ $project->issue }}</div></div>
                    <hr/>
                    <h4>Who we are:</h4>
                    <div><p style="color:#000;">{{ $project->who_we_are }}</p></div>
                    <hr/>
                    <h4>What We Need:</h4>
                    <div><p style="color:#000;">{{ $project->what_need }}</p></div>
                    <hr/>
                    <h4>The Impact:</h4>
                    <div><p style="color:#000;">{{ $project->impact }}</p></div>
                    <hr/>
                    <h4>Time Line: </h4>
                    <div><p style="color:#000;">{{ $project->time_line }}</p></div>
                    <hr/>
                    <h4>Acknowledgements / rewards :</h4>
                    <div><p style="color:#000;">{{ $project->ack_reward }}</p></div>
                    <hr/>
                    <h4>Additional Link :</h4>
                    <div class="row">
                        @if($project->facebook != '')
                        <div class="col-md-2">Link to Facebook : </div><div class="col-md-10"><a href="{{$project->facebook}}" alt="link facebook" >{{$project->facebook}}</a></div>
                        @endif
                        @if($project->twitter != '')
                        <div class="col-md-2">Link to Twitter : </div><div class="col-md-10"><a href="{{$project->twitter}}" alt="link twitter" >{{$project->twitter}}</a></div>
                        @endif
                        @if($project->google != '')
                        <div class="col-md-2">Link to Google+ : </div><div class="col-md-10"><a href="{{$project->google}}" alt="link google" >{{$project->google}}</a></div>
                        @endif
                        @if($project->instagram != '')
                        <div class="col-md-2">Link to Instagram : </div><div class="col-md-10"><a href="{{$project->instagram}}" alt="link instagram" >{{$project->instagram}}</a></div>
                        @endif
                        @if($project->youtube != '')
                        <div class="col-md-2">Link to Youtube : </div><div class="col-md-10"><a href="{{$project->youtube}}" alt="link youtube" >{{$project->youtube}}</a></div>
                        @endif
                        @if($project->linkedin != '')
                        <div class="col-md-2">Link to LinkedIn : </div><div class="col-md-10"><a href="{{$project->linkedin}}" alt="link linkedin" >{{$project->linkedin}}</a></div>
                        @endif
                    </div>
                    <hr/>

                    @if($project->facebook_id != '' || $project->twitter_id != '')                 
                        <h4>Social Streams</h4>
                        <div class="row">
                            <div class="col-md-12">                        
                                @if($project->facebook_id != '')
                                    <div id="fb-root" class="col-md-6">
                                       <div class="fb-page" data-href="{{$project->facebook}}" data-width="305" data-height="372" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="{{$project->facebook}}"><a href="{{$project->facebook}}">Facebook</a></blockquote></div></div>
                                    </div>
                                @endif

                                @if($project->twitter_id != '')
                                    <div id="twitter-root" class="col-md-6">
                                       <a class="twitter-timeline"  href="{{$project->twitter}}" data-widget-id="{{$project->twitter_id}}">Tweets</a>
                                    </div>
                                @endif
                            </div> 
                        </div>
                        <hr />                                                                                          
                    @endif

                    
                    <h4>Images :</h4>
                    

                    <div class="row" >
                        <!--<div class="col-md-4">{{ HTML::image('uploads/project/'.$project->img_content1, $project->img_content1, array('width'=>'100%')) }}</div>
                        <div class="col-md-4">{{ HTML::image('uploads/project/'.$project->img_content2, $project->img_content1, array('width'=>'100%')) }}</div>
                        <div class="col-md-4">{{ HTML::image('uploads/project/'.$project->img_content3, $project->img_content1, array('width'=>'100%')) }}</div>-->
                         <div class="col-md-4"><a href="../uploads/project/{{$project->img_content1}}" data-lightbox="project">{{ HTML::image('uploads/project/'.$project->img_content1, $project->img_content1, array('width'=>'100%')) }}</a></div>
                         <div class="col-md-4"><a href="../uploads/project/{{$project->img_content2}}" data-lightbox="project" style="padding: 0px;">{{ HTML::image('uploads/project/'.$project->img_content2, $project->img_content2, array('width'=>'100%')) }}</a></div>
                         <div class="col-md-4"><a href="../uploads/project/{{$project->img_content3}}" data-lightbox="project">{{ HTML::image('uploads/project/'.$project->img_content3, $project->img_content3, array('width'=>'100%')) }}</a></div>

                    </div>
                    @if($project->url != '')
                    <hr/>
                    <div>
                        <h4>Video :</h4>
                        <div>
                            <p><strong><em><iframe frameborder="0" height="350" scrolling="no" src="{{ $project->url }}" width="100%"></iframe></em></strong></p>
                        </div>
                    </div>
                    @endif


                </div>
				
                <div class="tab-pane fade in" id="tabBacker" style="padding-left:20px; padding-right:20px;">
                    @if(count((array)$backers) > 0)
                    @foreach($backers as $backer)
                    <div class="row" style="border:1px solid #E8E8E8; padding:10px; margin-bottom:5px; margin-top:5px; background-color: #E8E8E8;">
                        <div class="col-md-2" style="width:90px;"><img src="../uploads/users/{{$backer->avatar}}" width="100%" alt="default" style="border:1px solid green;" /></div>
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

                <div class="tab-pane fade in" id="tabComment" style="padding-left:20px; padding-right:20px;">
                    <div id="fb-root">
                        <div class="fb-comments" style="height:285px;" data-href="http://gotongroyong.fund/show-project/{{$project->project_alias}}" data-numposts="5"></div>
                    </div>
                   
                </div>

            </div>
            @elseif(Input::get("step") == 1)
            {{Form::open(array('url'=>'payment-landing?pid='.$pid))}}
            {{-- Form::open(array('url'=>'show-project/submitpledge?pid='.$pid, 'id'=>'formPledge')) --}}
            <div class="col-md-8" style="border:1px solid #D8D8D8; background-color: #f2f2f2; padding-top:10px; padding-bottom:10px; padding-left:20px; padding-right:20px;">
                <div class="col-md-12"><h3>How much would you like to contribute?</h3></div>
                <span class="col-md-1 color-green" style="font-size:20px;">Rp. </span><div class="col-md-4"><input type="text" id="amount" name="amount" class="form-control" style="border:1px solid #1DB262;" value="{{ Input::get('amount') }}"></div>
                
                <div class="col-md-12" style="margin-top:10px;">
                    @if(count($rewards)!=0)
                        <span style="font-size:19px;">Choose your reward :</span>
                    @endif
                </div>
                
                <div class="col-md-12">
                    <ul class="reward-wrapper">
                        @foreach($rewards as $reward)
                        <li>
                            <label style="width:100%;">
                                <input type="hidden" name="reward_count" value="{{count($rewards)}}">
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
                <div class="col-md-12">                    
                    <div class="col-md-12"><h3>Who are you</h3></div>                    
                    <div class="col-md-12">Your name <span style="color:red;">*</span></div><div class="col-md-12"><input type="text" name="name" class="form-control"></div>
                    <div class="col-md-12">Email <span style="color:red;">*</span></div><div class="col-md-12"><input type="text" name="email" class="form-control"></div>
                    <div class="col-md-12">Phone Number <span style="color:red;">*</span></div><div class="col-md-12"><input type="text" name="phone" id="phone" class="form-control"></div>
                    <div class="col-md-12">Comment</div><div class="col-md-12"><textarea name="comment" class="form-control"></textarea></div>
                    <div class="col-md-12" style="float:right"><span style="color:red;">(* Must be filled)</span></div>
                </div>
                <!--<div class="col-md-6">
                    <div class="col-md-12"><h3>Choose a funding method</h3></div>
                    <div class="col-md-12">Please select your funding method</div>
                    <div class="col-md-12">
                        <ul style="padding:0px;">
                            <li style="list-style:outside none none;"><input type="radio" id="p1" value="veritrans" name="pm"> Credit Card</li>
                            <li style="list-style:outside none none;"><input type="radio" id="p2" value="transfer" name="pm"> Bank Transfer</li>
                            <li style="list-style:outside none none;"><input type="radio" id="p3" value="others" name="pm"> Other Payment (debet / cash)</li>
                        </ul>
                    </div>
                </div>-->
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
                                <input type="radio" id="{{ $reward->reward_id }}" value="{{ $reward->reward_id }}" name="reward" class="radio_reward" 
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
                                            <div style="text-align: center;"><h4 style="font-size: 16px; color: white; background-color: #1db262; padding-top:5px; padding-bottom:5px">Successful !</h4></div>
                                        @elseif ($project->status == 3)  
                                            <div style="text-align: center;"><h4 style="font-size: 16px; background-color: #e54a1a; color:#fff; padding-top:5px; padding-bottom:5px">Unsuccessful !</h4></div>
                                        @else
                                        <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:5px; padding-bottom:5px">0<small> days left</small></h4></div>
                                        @endif                                                  
                                    @else
                                        <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:5px; padding-bottom:5px">{{ $project->days_to_go->format("%r%a") }}<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                                        @endif
                            <div style="text-align: center;"><h4 style="font-size: 16px;"><small>project finished at {{ $project->due_date }}</small></h4></div>
                             @if( $project->days_to_go->format("%r%a") > 0)
                            <div class="text-center"><a href="?step=1" class="btn btn-primary">Fund this project</a></div>
                             @endif                           
                        </div>
                </div>
                <div class="col-md-12" style="border:1px solid #E8E8E8; padding-top:5px; padding-bottom:5px; margin-bottom:10px; background-color: #E8E8E8; padding-right:0px; border:1px solid green;">
                    <div class="col-md-4" style="padding:0px; width: 80px;"><a href="http://{{$project->website}}" target="_blank"><img src="../uploads/users/{{ $project->avatar == null ? 'default.png' : $project->avatar }}" width="100%" alt="{{ $project->avatar }}" /></a></div>
                    <div class="col-md-8" style="padding:0px; padding-left:10px; padding-right: 0px; margin-right:0px;"><h4 style="padding-right:0px; margin-right:0px; margin-bottom:0px;"><small>project sponsor</small><br/><a href="http://{{$project->website}}" target="_blank">{{ $project->first_name }} {{ $project->last_name }}</a></h4><span class="fa fa-map-marker"></span> {{ $project->country }}, {{ $project->city }}</div>
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
                        <div>
                            @if($reward->reward_image != "" && $reward->reward_image != "NULL" )
        					   <img src="../uploads/reward/{{ $reward->reward_image }}" width="80" style="float:left; margin-right:15px" alt="{{ $reward->reward_image }}">
                            @endif
                            {{ $reward->reward_description }}
                        </div>
                    @if($project->days_to_go->format("%r%a") > 0)
                        @if($c > 0)
                            <div style="width:100%; float:left; margin-top:5px;" align="center" ><a href="?step=1&pledge={{ $reward->reward_id }}&amount={{ $reward->reward_minimum }}" class="btn btn-primary" style="width: 200px; border-radius:10px !important;">Fund Rp. {{ number_format($reward->reward_minimum,0,",",".") }} or more</a></div>
                        @else
                            <div style="width:100%; float:left; margin-top:5px;" align="center" class="btn btn-primary">Out of Stock</div>
                        @endif
                    @endif                    
                </div>
                @endforeach
                <!--add new widget-->
                <div class="col-md-12 container-reward" style="margin-bottom:10px;">
                    <div style="font-family:'PT Sans Narrow';font-size:20pt;text-align:center">Share This</div>
                    <div style="width:100%; float:left; margin-top:5px" align="center" >
                        <!--<a href="getWidgetProject/" class="btn btn-primary" style="width: 200px; border-radius:10px !important;font-size:16pt;background-color:#484848;">&lt;/&gt;Get Widget</a>-->
                        {{ HTML::link('/getWidgetProject?p='.$project->project_alias, '&lt;/&gt;Get Widget', array('class' => 'btn btn-primary','style'=>'width: 200px; border-radius:10px !important;font-size:16pt;background-color:#484848'))}}
                    </div>
                    <div class="row col-md-12">
                            <a onclick="window.open(this.href, 'fbwin',
                            'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" href="http://www.facebook.com/sharer.php?u=http://{{$_SERVER['SERVER_NAME']}}/show-project/{{$project->project_alias}}" class="button facebook">
                                <div class="col-md-6 fb-btn fa fa-facebook-square"></div>
                            </a>
                        
                        <!--<div class="fb-share-button" data-href="http://{{$_SERVER['SERVER_NAME']}}/grfund/show-project/{{$project->project_alias}}" data-layout="button_count"></div>-->
                           
                            <a onclick="window.open('http://twitter.com/intent/tweet?url=http://{{$_SERVER['SERVER_NAME']}}/show-project/{{$project->project_alias}}', 'twwin',
                            'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" href="#" class="button twitter"  >
                            <div class="col-md-6 tw-btn fa fa-twitter-square"></div>
                            </a>
                        
                    </div>
                    
                </div>
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

{{ HTML::script('sximo/js/plugins/lightbox2-master/dist/js/lightbox.js') }}
{{ HTML::style('sximo/js/plugins/lightbox2-master/dist/css/lightbox.css')}}


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

        function validatePhone(txtPhone) {
            //var a = document.getElementById(txtPhone).value;
            var a = $('#phone').val();
            var filter = /^[0-9-+]+$/;
            if (filter.test(a)) {
                return true;
            }
            else {
                return false;
            }
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

    	$("#fb-comment").click(function(){
            FB.XFBML.parse();
        });

		$("#btn-sub-fun").click(function()
		{
            var reward_count= {{count($rewards)}};
            

            if($('#amount').val()=="")
            {
                alert("Insert How much would you like to contribute ");
                return false;
            }
            if ( ! $("input[name='reward']").is(':checked') && reward_count != 0)
            {
                alert("Please Choose Your Reward ");
                return false;
            }
            if($("input[name='name']").val()=="")
            {
                alert("Please Insert Your Name ");
                return false;
            }
             if($("input[name='email']").val()=="")
            {
                alert("Please Insert Your Email ");
                return false;
            }
            if($("input[name='phone']").val()=="")
            {
                alert("Please Insert Your Phone Number");
                return false;
            }

            if (!validatePhone('phone')) {
                alert("Phone Number must be numeric");
                return false;
            }

            

		   /*if ( ! $("input[name='pm']").is(':checked') )
			{
				alert("Choose Your Funding Method ");
				return false;
			}*/

        });
			
    });
</script>				