 <?php
 $is_author= Session::get('is_author');
?>
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

<div class="wrapper-header ">
    <div class="container" >
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title" style="padding-bottom:10px;">
			<h3> {{ $project->title_lang }} <small></small></h3>           
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
                        <li><a href="{{ URL::to('projects') }}">Projects</a></li>
			<li class="active">{{ $project->title_lang }} </li>
		  </ul>		
		</div>
		  
    </div>
</div>	
<div class="container">
        <div class="row" style="padding-left: 30px; padding-right: 30px;">
            @if(Input::get("step") == "" || Input::get("step") < 1 || Input::get("step") > 2 )
            <ul class="nav nav-pills">
                <li {{ $tab == 1 ? "class='active'" : "" }} style="width:183px;font-size:18px;text-align:center; background-color:#dadac8;">
                        <a href="#tabHome" data-toggle="tab">
                        Home </a>
                </li>
                <li {{ $tab == 2 ? "class='active'" : "" }} style="width:183px;font-size:18px;text-align:center; background-color:#dadac8;">
                        <a href="#tabBacker" data-toggle="tab">
                        Backers </a>
                </li>
                <li {{ $tab == 3 ? "class='active'" : "" }} style="width:183px;font-size:18px;text-align:center; background-color:#dadac8;">
                        <a href="#tabComment" id="fb-comment" data-toggle="tab">
                        Comments </a>
                </li>
                <li {{ $tab == 4 ? "class='active'" : "" }} style="width:183px;font-size:18px;text-align:center; background-color:#dadac8;">
                        <a href="#tabUpdate" data-toggle="tab">
                        Updates ({{$updates_count}}) </a>
                </li>
            </ul>
            <div class="tab-content col-md-8" style="padding-left:0px; padding-right:0px;">
                <div class="tab-pane fade {{ $tab == 1 ? "active" : "" }} in" id="tabHome" style="border:1px solid #D8D8D8; background-color: #FFFFFF; padding-top:10px; padding-bottom:10px; padding-left:20px; padding-right:20px; ">
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
                    {{--html_entity_decode($project->content)--}}
                    {{--Lang::get('core.project_content')--}}

                    {{html_entity_decode($contentProject)}}
                                   


                </div>

                <div class="tab-pane fade {{ $tab == 2 ? "active" : "" }} in" id="tabBacker" style="padding-left:20px; padding-right:20px;">
                    @if(count((array)$backers) > 0)
                    <?php $i=0;?>
                    @foreach($backers as $backer)
                    <div class="row" style="border:1px solid #E8E8E8; padding:10px; margin-bottom:5px; margin-top:5px; background-color: #E8E8E8;">
                        <div class="col-md-2" style="width:90px;"><img src="../uploads/users/{{$backer->avatar}}" width="100%" alt="default" style="border:1px solid green;" /></div>
                        <div class="col-md-2"><span style="font-size:16px;">{{ $backer->name }}</span></div>
                        <div class="col-md-6"><span style="font-size:16px;">Rp. {{ number_format($backer->backer_amount,0,",",".") }} - {{ $backer->reward_title_lang }}</span></div>
                        <?php                        
                            if($is_author==1)
                            {
                        ?>
                                <div class="col-md-2">
                                        <span style="font-size:16px;">
                                            <!--<a href="#" style="color:blue" class="trigger-comment" id="trigger-comment{{$i}}">Messages</a>-->
                                            <a href="../showMessages/{{$project->project_alias}}?t=2&pid={{$project->project_id}}&bid={{$backer->backer_id}}&e={{Crypt::encrypt($backer->email)}}" style="color:blue">Messages</a>
                                            
                                        </span>
                                </div>
                                <div id="content{{$i}}" style="display:none">
                                    <p>{{ HTML::image('uploads/banner/'.$project->banner_img, $project->banner_img, array('width'=>'50%')) }}</p>
                                    <hr/>
                                    <!--<p style="text-align:center;font-size:16px;">{{$project->title}}</p>-->
                                    <p style="font-size:16px;"><b>To:</b> {{ $backer->name }}</p>
                                    <input name="user_id2" type="hidden" value="{{$backer->user_id}}">
                                    {{ Form::open(array('url'=>'showproject/addMessages', 'files'=>true, 'id'=>'formMessage' )) }}
                                        <textarea rows="3" name="message_body" id="message_body" style="width:100%;resize:none"></textarea>
                                        <br/><br/>
                                        <input name="project_id" type="hidden" value="{{$project->project_id}}">
                                        <input name="user_id" type="hidden" value="{{$backer->user_id}}">
                                        <input name="email" type="hidden" value="{{$backer->email}}">
                                        <button type="submit" class="btn btn-primary" id="btn-send-msg">Send Message</button>
                                    {{ Form::close() }}
                                    <hr/>                                   
                                    
                                                                                                    
                                </div>
                         <?php   
                            }                        
                          ?>
                        
                          
                    </div>
                    <?php $i++?>                    
                    @endforeach
                    <input id="backerNum" type="hidden" value="{{$i}}">
                    @else
                    <div class="row" style="border:1px solid #E8E8E8; padding:10px; margin-bottom:5px; margin-top:5px; background-color: #E8E8E8;">
                        <div class="col-md-12"><span style="font-size:16px;">No backers</span></div>
                    </div>
                    @endif
                    @if($message != null || $message != "")
                        <div class="row" style="border:1px solid #E8E8E8; padding:10px; margin-bottom:5px; margin-top:5px; background-color: #1ab394;">
                            <div class="col-md-12" style="text-align:center"><span style="font-size:16px; color:white">Add messages Success</span></div>
                        </div>
                    @endif
                    
                </div>
                
                <div class="tab-pane fade {{ $tab == 3 ? "active" : "" }} in" id="tabComment" style="padding-left:20px; padding-right:20px;">
                    <br/>Please use hashtag #gotongroyong
                    <div id="fb-root">
                        <div class="fb-comments" style="height:auto;" data-href="http://gotongroyong.fund/show-project/{{$project->project_alias}}" data-numposts="5"></div>
                    </div>                   
                </div>

                <div class="tab-pane fade {{ $tab == 4 ? "active" : "" }} in" id="tabUpdate" style="padding-left:20px; padding-right:20px;">
                    @if(count((array)$recent_updates) > 0)
                    @foreach($recent_updates as $update)
                    <!--<div class="row" style="border:1px solid #E8E8E8; padding:10px; margin-bottom:5px; margin-top:5px; background-color: #E8E8E8;">
                        <div class="col-md-2"><span style="font-size:16px;">{{$update->post_date}}</span></div>
                        <div class="col-md-4"><span style="font-size:16px;">{{$update->post_header}}</span></div>
                        <div class="col-md-6"><span style="font-size:16px;">{{ substr($update->post_content,0,90).(strlen($update->post_content) > 89 ? "...": "")  }}&nbsp;&nbsp;(Read more)</span></div>                        
                    </div>-->
                    <div class="row">
                        <div style="font-size:24px">{{$update->post_date}}</div>
                        <div style="font-size:20px;padding-bottom:10px"><a href="../ShowUpdates?id={{$update->post_id}}&pid={{$update->project_id}}">{{$update->post_header_lang}}</a></div>
                        <!--<div style="font-size:16px">{{ substr($update->post_content,0,300).(strlen($update->post_content) > 299 ? "...": "")  }}</div>-->
                        <div style="font-size:16px">{{$update->small_content_lang}}</div>
                        <div style="font-size:14px"><a style="color:blue"href="../ShowUpdates?id={{$update->post_id}}&pid={{$update->project_id}}">(See More)</a></div>
                        <hr/>
                    </div>
                    @endforeach
                    <div class="row" style="border:1px solid #E8E8E8; padding:10px; margin-bottom:5px; margin-top:5px; background-color: #1ab394;">
                        <div class="col-md-12" style="text-align:center"><span style="font-size:16px; color:white">{{ $project->start_date }}&nbsp;&nbsp;&nbsp;&nbsp;Project Start !</span></div>
                                                
                    </div>
                    
                    @else
                    <div class="row" style="border:1px solid #E8E8E8; padding:10px; margin-bottom:5px; margin-top:5px; background-color: #E8E8E8;">
                        <div class="col-md-12"><span style="font-size:16px;">No updates yet</span></div>
                    </div>
                    @endif                   
                </div>


            </div>
            
                <?php //return Redirect::to('user/login');?> 
            @elseif(Input::get("step") == 1)            
            {{Form::open(array('url'=>'payment-landing?pid='.$pid, 'id' => 'formPledge'))}}
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
                                <input type="radio" id="{{ $reward->reward_id }}" value="{{ $reward->reward_id }}" data-value="{{ $reward->reward_minimum }}" name="reward" 
                                       @if(Input::get('pledge') == $reward->reward_id)
                                            checked="checked"
                                       @endif
                                       style="float:left;">
                                <div style="float:left; width: 93%; margin-left: 15px; ">
                                    @if($reward->reward_image != "")
                                    <img src="../uploads/reward/{{ $reward->reward_image }}" width="120" style="float:right;" alt="{{ $reward->reward_image }}">
                                    @endif
                                    <h4>{{ $reward->reward_title_lang }}</h4>
                                    <div>pledge Rp. {{ number_format($reward->reward_minimum,0,",",".") }} or more</div>
                                    <p style="font-weight: normal; ">{{ $reward->reward_description_lang }}</p>
                                </div>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-12">                    
                    <div class="col-md-12"><h3>Who are you</h3></div>                    
                    <div class="col-md-12">Your name&nbsp;?&nbsp;<input type="checkbox" name="Anonymous" class="anonymous" value="Anonymous">&nbsp;Anonymous <span style="color:red;">*</span></div><div class="col-md-12"><input type="text" name="name" class="form-control input-name"></div>
                    <div class="col-md-12">Email <span style="color:red;">*</span></div><div class="col-md-12"><input type="text" name="email" class="form-control" value="{{$email_login->email}}" readonly></div>
                    <div class="col-md-12">Phone Number <span style="color:red;">*</span></div><div class="col-md-12"><input type="text" name="phone" id="phone" class="form-control"></div>
                    <div class="col-md-12">Comment</div><div class="col-md-12"><textarea name="comment" class="form-control"></textarea></div>
                    <div class="col-md-12"><input type="radio" name="tran_fund" id="tran_fund1" value="1" checked="checked">{{ Lang::get('core.trans_owner') }}<br></div>
                    @if($project->category != 3 && $project->category !=10)
                        <div class="col-md-12"><input type="radio" name="tran_fund" id="tran_fund2" value="2">{{ Lang::get('core.trans_project') }}<br></div>
                        <div class="col-md-12">
                             <select id="select_tran_fund" name="select_tran_fund">
                                <option value="none">-- Please Select Project --</option>
                                @foreach($project_list as $pl)
                                    <option value="{{$pl->project_id}}">{{$pl->title}}</option> 
                                @endforeach                         
                             </select> 
                        </div>
                    @endif

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
                                    <h4>{{ $reward->reward_title_lang }}</h4>
                                    <div>pledge Rp. {{ number_format($reward->reward_minimum,0,",",".") }} or more</div>
                                    <p style="font-weight: normal;">{{ $reward->reward_description_lang }}</p>
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
                                <a class="projecttitle" href="{{ $project->project_alias }}"><h3>{{ $project->title_lang }}</h3></a>
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
                    <div class="col-md-8" style="padding:0px; padding-left:10px; padding-right: 0px; margin-right:0px;"><h4 style="padding-right:0px; margin-right:0px; margin-bottom:0px;"><small>Created By</small><br/><a href="http://{{$project->website}}" target="_blank">{{ $project->first_name }} {{ $project->last_name }}</a></h4><span class="fa fa-map-marker"></span> {{ $project->country }}, {{ $project->city }}</div>
                </div>
                @foreach($rewards as $reward)                
                <div class="col-md-12 container-reward" style="margin-bottom:10px;">
                    <div><h3 style="margin-bottom:0px">{{$reward->reward_title_lang}}</h3></div>
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
                            {{ $reward->reward_description_lang }}
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
{{ HTML::script('sximo/themes/mango/js/jquery.min.js') }}
{{ HTML::script('js/jquery.flot.min.js') }}
{{ HTML::script('js/jquery.flot.pie.min.js') }}
{{ HTML::script('sximo/js/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js')}}

{{ HTML::script('sximo/js/plugins/lightbox2-master/dist/js/lightbox.js') }}
{{ HTML::style('sximo/js/plugins/lightbox2-master/dist/css/lightbox.css')}}

{{ HTML::script('js/plugins/js-modal-master/jh-modal-4.js') }}
{{ HTML::style('js/plugins/js-modal-master/jh-modal-4.css') }}

{{ HTML::style('css/custom.css') }}



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

        var is_mobile = false;
        if( $('#amount').css('display')=='none') {
            is_mobile = true;
            $("#amount").show();       
        }

        if (is_mobile == false) {
            $("#amount").inputmask('999.999.999.999', {
                numericInput: true
            }); //123456  =>  € ___.__1.234,56
        }
        
        /*else
        {
            $("#amount").show();
        }*/
        

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

            var amount = $('#amount').val();            

            var amount_new =amount.replace(/_/g,""); 
            var amount_new_2 =amount_new.replace(/\./g,"");           
            
            
            if($('#amount').val()=="")
            {
                alert("Insert How much would you like to contribute ");
                return false;
            }

            /*if(! $("input[name='reward']").is(':checked'))
            {
                alert("tidak ada yg dipilih");
                return false;
            }*/

            /*if ( ! $("input[name='reward']").is(':checked') && reward_count != 0)
            {
                alert("Please Choose Your Reward ");
                return false;
            }*/
            
            //if($('input[name="reward"]:checked').attr("data-value") > $('#amount').inputmask('unmaskedvalue') )
            //console.log($('input[name="reward"]:checked').attr("data-value"));
            if(Number($('input[name="reward"]:checked').attr("data-value")) > Number(amount_new_2))
            {                
                alert("The Amount is not Match With The Reward");
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

            

                if ($('input[name=tran_fund]:checked', '#formPledge').val()==2)
                {
                    if($( "#select_tran_fund" ).val()== 'none')
                    {
                        alert("Please Select Project, If It Doesn't Reach 50% of Fund");return false;
                    }
                }



            /*if ( ! $("input[name='pm']").is(':checked') )
			{
				alert("Choose Your Funding Method ");
				return false;
			}*/
        });

        /*$("#btn-send-msg").click(function()
        {
            alert("tahan");
            return false;
        });*/        
		

        $('.anonymous').change(function() {
            if($(this).is(':checked'))
            {
                $(".input-name").val('Anonymous');
            }
            else
            {
                $(".input-name").val('');
            }    
        }); 	
    });
</script>				