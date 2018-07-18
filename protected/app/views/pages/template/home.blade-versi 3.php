<!-- header BEGIN -->
<!--<div style="height:170px; background-color:#b1b1a9; text-align:center; padding-top:40px; ">
<h1><span style="color:#fff;">Indonesia’s Crowdfunding Platform!</style></h1>
<span style="color:#fff; font-size:20px;"><b>Gotong Royong</b> : community self-help, mutual cooperation among many people to attain a shared goal.</span>
</div>-->


<script>(function(d, s, id) {
  
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

<div>
  <!--<img src="img/header.jpg" alt="projects" width="100%"  />-->
  <div class="page-slider">
        <div class="fullwidthbanner-container revolution-slider">
          <div class="fullwidthabnner">
            <ul id="revolutionul">
        <!--first slide-->        
          <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="frontend/web/slide/ani1/thumbs/thumb2.jpg">
            <img src="img/header.jpg" alt="">      
          </li>
        <!--second slide-->   
        <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="frontend/web/slide/ani1/thumbs/thumb2.jpg">
          <img src="images/portfolio/10.jpg" alt=""> 
        </li>
      
        <li data-transition="fade" data-slotamount="8" data-masterspeed="700" data-delay="9400" data-thumb="frontend/web/slide/ani1/thumbs/thumb2.jpg">
           <img src="images/portfolio/7.jpg" alt=""> 
        </li>
      
            </ul>
            <div class="tp-bannertimer tp-bottom"></div>
            </div>
        </div>
    </div>
</div>
<!-- header END -->

<div style="background-color:#f7f7f7; padding-top:20px;">
  <div class="container">
    <div class="row" style="color:#999; background-color:#f7f7f7; padding:5px 15px 5px 15px;">
        <div class="col-xs-12 col-sm-2 col-md-2" style="padding-top:20px;">
          {{-- HTML::link('/projects?category=all', 'Start Project', array('class' => 'btn btn-primary'))--}}
        </div>
        <div class="area-header col-xs-12 col-sm-8 col-md-8" >
            <h2 style="font-size:30px;">{{ Lang::get('core.home_center_popular') }}</h2>
            <h4>{{ Lang::get('core.home_center_popular_d') }}</h4>
        </div>
        <div class="col-xs-12 col-sm-2 col-md-2" align="right" style="padding-top:20px;">
            {{-- HTML::link('/projects?category=all', Lang::get('core.home_center_see_all'), array('class' => 'btn btn-primary'))--}}
        </div>
    </div>

    <div class="row">
                        <?php $i =0; ?>
      @foreach($popularCharity as $charity)
        <div class="col-sm-6 col-md-3" style="padding-left:15px;padding-right:15px; padding-bottom:5px;">
          <div style="border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; background-color:#fff;  ">
            <div style=" overflow:hidden; border-top-right-radius: 4px; border-top-left-radius: 4px; text-alignment:center;">
                                                    <a href="show-project/{{ $charity->project_alias }}">{{ HTML::image('uploads/banner/'.$charity->banner_img, $charity->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'200px')) }}</a>
            </div>
                                                <div style="padding-left:10px; padding-right:10px;">
                                                    <div style="padding-top:10px; text-align:center; padding-bottom:5px;" >
                                                        <a class="project-title" href="show-project/{{ $charity->project_alias }}" title="{{$charity->title}}">{{ substr($charity->title,0,27).(strlen($charity->title) > 26 ? "...": "")  }}</a>
                                                    </div>
                                                    <div style="padding-bottom:70px; height:50px; font-family: 'PT Sans Narrow'; color:#898989;">{{ $charity->small_content }}</div>
                                                    <div style="height: 90px;">
                                                        <div class="donutHolder" id="itemholder{{ $i }}">
                                                            <div class="donut" id="itemdonut{{ $i }}"></div>
                                                            <span class="donutData" id="itemdonutData{{ $i }}"></span>   
                                                        </div>
                                                    </div>
                          
                                                    <div style="text-align: center;"><h4 style="font-size:16px;">Rp {{ number_format($charity->hitung_f,0,",",".") }}<br/><small>{{ Lang::get('core.home_of') }} Rp {{ number_format($charity->amount,0,",",".") }}</small></h4></div>
                                                    
                          <div style="text-align: center;"><h4 style="font-size: 16px;">{{ $charity->backer }}<small> {{ Lang::get('core.home_pledger') }}</small></h4></div>
                                                    @if( $charity->days_to_go->format("%r%a") <= 0)
                                                        @if( $charity->status == 2)                                                    
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; color:#fff; background-color: #1db262; padding-top:5px; padding-bottom:5px">{{ Lang::get('core.home_success') }}</h4></div>
                                                        @elseif ($charity->status == 3)  
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; color:#fff; background-color: #e54a1a; padding-top:5px; padding-bottom:5px">{{ Lang::get('core.home_unsuccess') }}</h4></div>
                                                        @else
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:5px; padding-bottom:5px;">0<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                                                        @endif                                                  
                                                    @else
                                                        <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:5px">{{ $charity->days_to_go->format("%r%a") }}<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                                                    @endif
                                                </div>
          </div>
                                    
        </div>
                            <?php $i ++; ?>
      @endforeach
    </div>
    <hr style="width:95%; background-color:#f7f7f7;" />
  </div>


</div>
<div style="padding-top:5px; padding-bottom:20px; background-color:#f7f7f7;">
  
  <div class="container" >
    <div class="row" style="text-align:center; margin-top:0px;">
      <div class="col-md-3">
          <div class="area-header col-xs-12 col-sm-12 col-md-12" >
            <h2 style="font-size:30px;">{{ Lang::get('core.home_staff_pick') }} {{ date('F') }}</h2>
          </div>
          <div class="col-md-12" style="padding-left:15px;padding-right:15px; padding-bottom:5px;">
          <div style="border:1px solid #E8E8E8;  min-height:300px; overflow:hidden; background-color:#fff;  ">
            <div style=" overflow:hidden; border-top-right-radius: 4px; border-top-left-radius: 4px; text-alignment:center;">
                                                    <a href="show-project/{{ $staffpick[0]->project_alias }}">{{ HTML::image('uploads/banner/'.$staffpick[0]->banner_img, $staffpick[0]->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'200px')) }}</a>
            </div>
                                                <div style="padding-left:10px; padding-right:10px;">
                                                    <div style="padding-top:10px; text-align:center; padding-bottom:5px;" >
                                                        <a class="project-title" href="show-project/{{ $staffpick[0]->project_alias }}" title="{{$staffpick[0]->title}}">{{ substr($staffpick[0]->title,0,24).(strlen($staffpick[0]->title) > 23 ? "...": "") }}</a>
                                                    </div>
                                                    <div style="padding-bottom:68px; height:50px; font-family: 'PT Sans Narrow'; color:#898989;" >{{ $staffpick[0]->small_content }}</div>
                                                    
                                                </div>
          </div>
                                    
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-md-12">
            <span class="col-md-1">
              &nbsp;   
            </span>
            <div class="col-md-10 button-start">&nbsp;
                <a href="./create-project"><span style="float:left;position:absolute;right:218px;width:270px;height:83px;text-decoration: none;"></span></a>
                <a href="./projects"><span style="float:right;position:absolute;top:0px;width:27px;height:83px;text-decoration:none;"></span></a>
             </div>            
            <span class="col-md-1">
              &nbsp;  
            </span>          
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-6" style="text-align:left; font-size:16px; color:#696969; margin-bottom:20px; margin-top:20px; ">
              <table border="0">
                <tr>
                  <td><span style="font-size:30px; color:green; float:left;" class="fa fa-check-square-o"></span></td>
                  <td style="padding-left:5px;">{{ Lang::get('core.home_check1') }}</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6" style="text-align:right; font-size:16px; color:#696969; margin-bottom:20px; margin-top:20px; ">{{ Lang::get('core.home_target1') }} &nbsp;&nbsp;<span style="font-size:30px; color:red; float:right;" class="fa fa-bullseye"></span></div>
          </div>
          <div class="row">
            <div class="col-md-6" style="text-align:left; font-size:16px; color:#696969; margin-bottom:20px;">
              <table border="0">
                <tr>
                  <td><span style="font-size:30px; color:green; float:left;" class="fa fa-check-square-o"></span></td>
                  <td style="padding-left:5px;">{{ Lang::get('core.home_check2') }}</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6" style="text-align:right; font-size:16px; color:#696969; margin-bottom:20px; ">{{ Lang::get('core.home_target2') }} &nbsp;&nbsp;<span style="font-size:30px; color:red; float:right;" class="fa fa-bullseye"></span></div>
          </div>
          <div class="row">
            <div class="col-md-6" style="text-align:left; font-size:16px; color:#696969; margin-bottom:20px;">
              <table border="0">
                <tr>
                  <td><span style="font-size:30px; color:green; float:left;" class="fa fa-check-square-o"></span></td>
                  <td style="padding-left:5px;">{{ Lang::get('core.home_check3') }}</td>
                </tr>
              </table>
            </div>
            <div class="col-md-6" style="text-align:right; font-size:16px; color:#696969; margin-bottom:20px; ">{{ Lang::get('core.home_target3') }} &nbsp;&nbsp;<span style="font-size:30px; color:red; float:right;" class="fa fa-bullseye"></span></div>
          </div>
        </div>
        
        <div class="col-md-12" style="padding-top:20px;">
          {{ Lang::get('core.home_read') }} <a href="faq">Frequently Ask Question (FAQ)</a> {{ Lang::get('core.home_and') }} <a href="terms-conditions">{{ Lang::get('core.home_term') }}</a> {{ Lang::get('core.home_minfo') }}
        </div>
      </div>

      <div class="col-md-3">
          <div class="area-header col-xs-12 col-sm-12 col-md-12" >
            <h2 style="font-size:30px;">{{ Lang::get('core.home_newest') }}</h2>
          </div>
          <div class="col-md-12" style="padding-left:15px;padding-right:15px; padding-bottom:5px;">
          <div style="border:1px solid #E8E8E8;  min-height:300px; overflow:hidden; background-color:#fff;  ">
            <div style=" overflow:hidden; border-top-right-radius: 4px; border-top-left-radius: 4px; text-alignment:center;">
                                                    <a href="show-project/{{ $newest[0]->project_alias }}">{{ HTML::image('uploads/banner/'.$newest[0]->banner_img, $newest[0]->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'200px')) }}</a>
            </div>
                                                <div style="padding-left:10px; padding-right:10px;">
                                                    <div style="padding-top:10px; text-align:center; padding-bottom:5px;" >
                                                        <a class="project-title" href="show-project/{{ $newest[0]->project_alias }}" title="{{$newest[0]->title}}">{{ substr($newest[0]->title,0,24).(strlen($newest[0]->title) > 23 ? "...": "") }}</a>
                                                    </div>
                                                    <div style="padding-bottom:68px; height:50px; font-family: 'PT Sans Narrow'; color:#898989;" >{{ $newest[0]->small_content }}</div>
                                                    
                                                </div>
          </div>
                                    
        </div>
      </div>
    </div>
    
    
</div>
</div>
<hr style="width:90%;"/>
<div class="container" style="background-color:#fff;">
    <div class="row" style="color:#999; background-color:#fff; padding:5px 15px 5px 15px;">
        <div class="area-header col-md-12" >
            <h2 style="font-size:30px;">{{ Lang::get('core.home_projects_c') }}</h2>
            <h4>{{ Lang::get('core.home_projects_c_1') }}</h4>
        </div>
    </div>
    <div class="row" style="padding-top:20px; padding-bottom:20px; padding-left:40px; padding-right:40px;">
        <div class="col-md-4 col-sm-6 col-xs-12" align="center">
            <a href="./projects?category=community">
              <table border="0" width="100%">
                <tr>
                  <td align="center" width="60px">
                    <img src="img/icons/1.png" alt="projects" width="40px" style="margin-bottom:10px;" />
                  </td>
                  <td>
                    <div>
                        <span style="font-size:23px;">{{ Lang::get('core.cat_community') }}</span><br/>
                        <p>{{ Lang::get('core.cat_community_d') }}</p>
                    </div>
                  </td>
                </tr>
              </table>
            </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" align="center">
          <a href="./projects?category=art">
          <table border="0" width="100%">
              <tr>
                <td align="center" width="60px">
                  <img src="img/icons/5.png" alt="charity" width="40px" style="margin-bottom:10px;" />
                </td>
                <td>
                  <div>
                      <span style="font-size:23px;">{{ Lang::get('core.cat_art') }}</span><br/>
                      <p>{{ Lang::get('core.cat_art_d') }}</p>
                  </div>
                </td>
              </tr>
            </table>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" align="center">
          <a href="projects?category=health">
          <table border="0" width="100%">
            <tr>
              <td align="center" width="60px">
                <img src="img/icons/9.png" alt="solidarity" width="40px" style="margin-bottom:10px;" />
              </td>
              <td>
                <div>
                    <span style="font-size:23px;">{{ Lang::get('core.cat_health') }}</span><br/>
                    <p>{{ Lang::get('core.cat_health_d') }}</p>
                </div>
              </td>
            </tr>
          </table>
         </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" align="center">
          <a href="projects?category=education">
          <table border="0" width="100%">
            <tr>
              <td align="center" width="60px">
                <img src="img/icons/2.png" alt="gift" width="40px" style="margin-bottom:10px;" />
              </td>
              <td>
                <div>
                    <span style="font-size:23px;">{{ Lang::get('core.cat_education') }}</span><br/>
                    <p>{{ Lang::get('core.cat_education_d') }}</p>
                </div>
              </td>
            </tr>
          </table>
        </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 " align="center">
          <a href="projects?category=business">
          <table border="0" width="100%">
            <tr>
              <td align="center" width="60px">
                <img src="img/icons/6.png" alt="gift" width="40px" style="margin-bottom:10px;" />
              </td>
              <td>
                <div>
                    <span style="font-size:23px;">{{ Lang::get('core.cat_business') }}</span><br/>
                    <p>{{ Lang::get('core.cat_business_d') }}</p>
                </div>
              </td>
            </tr>
          </table>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" align="center">
          <a href="projects?category=charity">
          <table border="0" width="100%">
              <tr>
                <td align="center" width="60px">
                  <img src="img/icons/10.png" alt="charity" width="40px" style="margin-bottom:10px;" />
                </td>
                <td>
                  <div>
                      <span style="font-size:23px;">{{ Lang::get('core.cat_charity') }}</span><br/>
                      <p>{{ Lang::get('core.cat_charity_d') }}</p>
                  </div>
                </td>
              </tr>
            </table>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" align="center">
          <a href="projects?category=emergency">
          <table border="0" width="100%">
            <tr>
              <td align="center" width="60px">
                <img src="img/icons/3.png" alt="solidarity" width="40px" style="margin-bottom:10px;" />
              </td>
              <td>
                <div>
                    <span style="font-size:23px;">{{ Lang::get('core.cat_emergency') }}</span><br/>
                    <p>{{ Lang::get('core.cat_emergency_d') }}</p>
                </div>
              </td>
            </tr>
          </table>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" align="center">
          <a href="projects?category=event">
            <table border="0" width="100%">
              <tr>
                <td align="center" width="60px">
                  <img src="img/icons/7.png" alt="projects" width="40px" style="margin-bottom:10px;" />
                </td>
                <td>
                  <div>
                      <span style="font-size:23px;">{{ Lang::get('core.cat_event') }}</span><br/>
                      <p>{{ Lang::get('core.cat_event_d') }}</p>
                  </div>
                </td>
              </tr>
            </table>
            </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" align="center">
          <a href="projects?category=sport">
          <table border="0" width="100%">
            <tr>
              <td align="center" width="60px">
                <img src="img/icons/11.png" alt="gift" width="40px" style="margin-bottom:10px;" />
              </td>
              <td>
                <div>
                    <span style="font-size:23px;">{{ Lang::get('core.cat_sport') }}</span><br/>
                    <p>{{ Lang::get('core.cat_sport_d') }}</p>
                </div>
              </td>
            </tr>
          </table>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 " align="center">
          <a href="projects?category=environment">
          <table border="0" width="100%">
            <tr>
              <td align="center" width="60px">
                <img src="img/icons/4.png" alt="gift" width="40px" style="margin-bottom:10px;" />
              </td>
              <td>
                <div>
                    <span style="font-size:23px;">{{ Lang::get('core.cat_environment') }}</span><br/>
                    <p>{{ Lang::get('core.cat_environment_d') }}</p>
                </div>
              </td>
            </tr>
          </table>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12 " align="center">
          <a href="projects?category=family">
          <table border="0" width="100%">
            <tr>
              <td align="center" width="60px">
                <img src="img/icons/8.png" alt="gift" width="40px" style="margin-bottom:10px;" />
              </td>
              <td>
                <div>
                    <span style="font-size:23px;">{{ Lang::get('core.cat_family') }}</span><br/>
                    <p>{{ Lang::get('core.cat_family_d') }}</p>
                </div>
              </td>
            </tr>
          </table>
          </a>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12" align="center">
          <a href="projects?category=technology">
          <table border="0" width="100%">
              <tr>
                <td align="center" width="60px">
                  <img src="img/icons/12.png" alt="charity" width="40px" style="margin-bottom:10px;" />
                </td>
                <td>
                  <div>
                      <span style="font-size:23px;">{{ Lang::get('core.cat_technology') }}</span><br/>
                      <p>{{ Lang::get('core.cat_technology_d') }}</p>
                  </div>
                </td>
              </tr>
            </table>
            </a>
        </div>
        
    </div>
</div>
<hr style="width:90%;"/>
<!-- Checkout block BEGIN -->
<div class="container">
  <div class="row" style="color:#999; background-color:#fff; padding:5px 15px 5px 15px;">
        <div class="area-header col-md-12" >
            <h2 style="font-size:30px;">{{ Lang::get('core.home_socialstream') }}</h2>
            <h4>{{ Lang::get('core.home_socialstream_d') }}</h4>
        </div>
    </div>
  <div class="row">
    <!--<div id="contentFeed" class="col-md-12" ></div>-->
    
    <div class="col-md-6" style="margin-left:80px;margin-right:0px;">
       <div id="fb-root">
         <div class="fb-page" data-href="https://www.facebook.com/gotongroyongfund" data-width="380" data-height="330" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/gotongroyongfund"><a href="https://www.facebook.com/gotongroyongfund">Gotong Royong Fund</a></blockquote></div></div>
       </div>
    </div>

    <!--<div class="col-md-6" style="width:410px;">-->
    <div class="col-md-6" style="width:410px;">
         <a class="twitter-timeline" href="https://twitter.com/GRfund" data-widget-id="611107252494143488">Tweets by @GRfund</a>
    </div>
     

    <!--<div class="col-md-3">
         <iframe src="http://widgetsplus.com:8080/70538.htm" width="260" height="372" style="padding:0; margin:0; overflow:hidden;" frameborder="0"></iframe>
         <iframe src="http://widgetsplus.com:8080/71712.htm" width="263" height="335" style="padding:0; margin:0; overflow:hidden;" frameborder="0"></iframe>

    </div>-->

   <!--<div class="col-md-3">            
            <blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="4" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:50% 0; text-align:center; width:100%; height:320px;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAAGFBMVEUiIiI9PT0eHh4gIB4hIBkcHBwcHBwcHBydr+JQAAAACHRSTlMABA4YHyQsM5jtaMwAAADfSURBVDjL7ZVBEgMhCAQBAf//42xcNbpAqakcM0ftUmFAAIBE81IqBJdS3lS6zs3bIpB9WED3YYXFPmHRfT8sgyrCP1x8uEUxLMzNWElFOYCV6mHWWwMzdPEKHlhLw7NWJqkHc4uIZphavDzA2JPzUDsBZziNae2S6owH8xPmX8G7zzgKEOPUoYHvGz1TBCxMkd3kwNVbU0gKHkx+iZILf77IofhrY1nYFnB/lQPb79drWOyJVa/DAvg9B/rLB4cC+Nqgdz/TvBbBnr6GBReqn/nRmDgaQEej7WhonozjF+Y2I/fZou/qAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="https://instagram.com/p/wf4HIDKRSt/" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_top">Join us #carfreeday #campaign #crowdfunding #stopchildabuse</a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">A photo posted by @gotongroyongfund on <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2014-12-12T07:20:42+00:00">Dec 11, 2014 at 11:20pm PST</time></p></div></blockquote>
            <blockquote class="instagram-media" data-instgrm-version="4" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:658px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:50% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAAGFBMVEUiIiI9PT0eHh4gIB4hIBkcHBwcHBwcHBydr+JQAAAACHRSTlMABA4YHyQsM5jtaMwAAADfSURBVDjL7ZVBEgMhCAQBAf//42xcNbpAqakcM0ftUmFAAIBE81IqBJdS3lS6zs3bIpB9WED3YYXFPmHRfT8sgyrCP1x8uEUxLMzNWElFOYCV6mHWWwMzdPEKHlhLw7NWJqkHc4uIZphavDzA2JPzUDsBZziNae2S6owH8xPmX8G7zzgKEOPUoYHvGz1TBCxMkd3kwNVbU0gKHkx+iZILf77IofhrY1nYFnB/lQPb79drWOyJVa/DAvg9B/rLB4cC+Nqgdz/TvBbBnr6GBReqn/nRmDgaQEej7WhonozjF+Y2I/fZou/qAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://instagram.com/p/wf4HIDKRSt/?taken-by=gotongroyongfund" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_top">A photo posted by @gotongroyongfund</a> on <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2015-06-26T12:58:59+00:00">Jun 26, 2015 at 5:58am PDT</time></p></div></blockquote>
            <script async defer src="//platform.instagram.com/en_US/embeds.js"></script>
    </div>--> 
    </div>
  <hr /> 
</div>
  <!--<div class="checkout-block content" style='background-color: #333333;'>
    <div class="container">
      <div class="row">
        <div class="col-md-10">
          <h2 style="color:#fff;">{{ Lang::get('core.home_checkout') }}</h2>
        </div>
        <div class="col-md-2 text-right">
          <a href="projects?category=all" class="btn btn-primary" style="background-color:#f26649;">{{ Lang::get('core.home_checkout_project') }}</a>
        </div>
      </div>
    </div>
  </div>-->
  <!-- Checkout block END -->
<!-- Facts block BEGIN -->
<!--
<div class="facts-block content content-center" id="facts-block">
      <h2>{{ Lang::get('core.home_fact') }}</h2>
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-3 col-xs-6">
        <div class="item">
              <strong>39</strong>
              {{ Lang::get('core.home_fact_1') }}
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-6">
        <div class="item">
              <strong>14</strong>
              {{ Lang::get('core.home_fact_2') }}
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-6">
        <div class="item">
              <strong>29k+</strong>
              {{ Lang::get('core.home_fact_3') }}
        </div>
      </div>
      <div class="col-md-3 col-sm-3 col-xs-6">
        <div class="item">
              <strong>500</strong>
              {{ Lang::get('core.home_fact_4') }}
        </div>
      </div>
    </div>
  </div>
</div>
-->
<!-- Facts block END -->


 <!-- BEGIN STEPS -->
<!--<div class="container">
    <div class="row margin-bottom-40 front-steps-wrapper front-steps-count-3">
      <div class="col-md-4 col-sm-4 front-step-col">
        <div class="front-step front-step1">
          <h2>{{-- Lang::get('core.home_step_1') --}}</h2>
          <p>Lorem ipsum dolor sit amet sit consectetur adipisicing eiusmod tempor.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 front-step-col">
        <div class="front-step front-step2">
          <h2>{{-- Lang::get('core.home_step_2') --}}</h2>
          <p>Lorem ipsum dolor sit amet sit consectetur adipisicing eiusmod tempor.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-4 front-step-col">
        <div class="front-step front-step3">
          <h2>{{-- Lang::get('core.home_step_3') --}}</h2>
          <p>Lorem ipsum dolor sit amet sit consectetur adipisicing eiusmod tempor.</p>
        </div>
      </div>
    </div>
</div>-->
<!-- END STEPS -->


{{ HTML::script('js/jquery.flot.min.js') }}
{{ HTML::script('js/jquery.flot.pie.min.js') }}

{{-- HTML::style('js/plugins/jquery.socialist.css') --}}
{{-- HTML::script('js/plugins/jquery.isotope.min.js') --}}
{{-- HTML::script('js/plugins/jquery.socialist.js') --}}

{{ HTML::style('js/plugins/social-feed/bower_components/social-feed/css/jquery.socialfeed.css') }}
{{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') }}
{{-- HTML::script('js/plugins/social-feed/bower_components/jquery/dist/jquery.min.js') --}}
{{ HTML::script('js/plugins/social-feed/bower_components/codebird-js/codebird.js') }}
{{ HTML::script('js/plugins/social-feed/bower_components/doT/doT.min.js') }}
{{ HTML::script('js/plugins/social-feed/bower_components/moment/min/moment.min.js') }}
{{ HTML::script('js/plugins/social-feed/bower_components/social-feed/js/jquery.socialfeed.js') }}




<script type="text/javascript">
    jQuery(document).ready(function(){             
        RevosliderInit.initRevoSlider();     

        function redrawDonut(i, fund, goal){
            var tmpdata = [
                { label:"Donated", data: fund, color: fund >= goal ? "#1db262" : "#43B3CF" },
                { label:"Goal", data: goal - fund, color:"#D3D3D3" },
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
        <?php $i=0; ?>
        //var dataPopular = [];
        @foreach ($popularCharity as $charity)
            var hitung ={{$charity->hitung_f == null ? 0 : $charity->hitung_f}} ;     
            redrawDonut({{ $i }},hitung, {{ $charity->amount }});
            <?php $i++; ?>
        @endforeach
        
        $(window).resize(function(){
            {{--*/ $i=0 /*--}}
            //var dataPopular = [];
            @foreach ($popularCharity as $charity)
            var hitung ={{$charity->hitung_f == null ? 0 : $charity->hitung_f}} ;
                redrawDonut({{ $i }},hitung, {{ $charity->amount }});
                {{--*/ $i++ /*--}}
            @endforeach
        });
        /*----START PORTFOLIO RESPONSIVE----*/
        function valignCenterMessageFunction () {
                MessageCurrentElemHeight = $(".message-block .valign-center-elem").height();

               $(".message-block .valign-center-elem").css("position", "absolute")
                   .css ("top", "50%")
                   .css ("margin-top", "-"+MessageCurrentElemHeight/2+"px")
                   .css ("width", "100%")
                   .css ("height", MessageCurrentElemHeight);
           }

           function valignCenterPortfolioFunction () {
                PortfolioCurrentElemHeight = $(".portfolio-block .valign-center-elem").height();

               $(".portfolio-block .valign-center-elem").css("position", "absolute")
                   .css ("top", "50%")
                   .css ("margin-top", "-"+PortfolioCurrentElemHeight/2+"px")
                   .css ("width", "100%")
                   .css ("height", PortfolioCurrentElemHeight);
           }

           var valignCenterMessage = function () {
               valignCenterMessageFunction();
               $(window).resize(function() {
                   valignCenterMessageFunction();
               });
           }
           var valignCenterPortfolio = function () {
               valignCenterPortfolioFunction();
               $(window).resize(function() {
                   valignCenterPortfolioFunction();
               });
           }
        valignCenterMessage();
        valignCenterPortfolio();
        /*----END PORTFOLIO RESPONSIVE----*/
        
        $(".owl-carousel6-brands").owlCarousel({
                pagination: false,
                navigation: $(window).width() > 640 ? true : false,
                navigationText: [
                    "<span class='fa fa-angle-left' style='color:#fff;'></span>",
                    "<span class='fa fa-angle-right' style='color:#fff;'></span>"
                    ],
                items: 6,
                addClassActive: true,
                itemsCustom : [
                    [0, 1],
                    [320, 2],
                    [480, 2],
                    [700, 3],
                    [975, 5],
                    [1200, 7],
                    [1400, 7],
                    [1600, 7]
                ],
            });
            
            $(".owl-carousel5-brands").owlCarousel({
                pagination: false,
                navigation: $(window).width() > 640 ? true : false,
                navigationText: [
                    "<span class='fa fa-angle-left' style='color:#fff;'></span>",
                    "<span class='fa fa-angle-right' style='color:#fff;'></span>"
                    ],
                items: 1,
                addClassActive: true,
                singleItem:true
            });
         var defaultSrc="";
         /*
         $(".img-responsive").hover(function(){
             defaultSrc = $(this).attr("src");
             var res = defaultSrc.replace("_gray", ""); 
             $(this).attr("src",res);             
            },function(){
                $(this).attr("src",defaultSrc);
            });
            */

        /*$('#contentFeed').socialist({
            networks: [
                //{name:'linkedin',id:'buddy-media'},
                //{name:'facebook',id:'in1dotcom'},
                {name:'facebook',id:'534529523335914',random:false}
                //{name:'facebook',id:'gotongroyongfund'}
                //{name:'pinterest',id:'potterybarn'},
                //{name:'twitter',id:'in1dotcom'},
                //{name:'googleplus',id:'105588557807820541973/posts'}
                //{name:'rss',id:' http://feeds.feedburner.com/good/lbvp'},
                //{name:'rss',id:'http://www.makebetterwebsites.com/feed/'},
                //{name:'craigslist',id:'boo',areaName:'southcoast'},
                //{name:'rss',id:'http://www.houzz.com/getGalleries/featured/out-rss'}
               ],
            isotope:false,
            random:false,            
            maxResults:10,
            //fields:['source','image','followers','likes']
            //fields:['source','heading','text','date','image','followers','likes','share']
        });*/

        /*$('#contentFeed').socialfeed({                    
                    facebook:{
                        accounts: ['#gotongroyongfund'],
                        limit: 2,
                        access_token: '816069161780370|55df0dc31f7014a8fd27ae408b6f320a' // APP_ID|APP_SECRET
                    },                    
                   twitter:{
                        accounts: ['@spacex'],
                        limit: 2,
                        consumer_key: 'YOUR_CONSUMER_KEY', // make sure to have your app read-only
                        consumer_secret: 'YOUR_CONSUMER_SECRET_KEY', // make sure to have your app read-only
                     },                   
                    vk:{
                        accounts: ['@125936523','#teslamotors'], 
                        limit: 2,
                        source: 'all'
                    },                   
                    google:{
                         accounts: ['#teslamotors'],
                         limit: 2,
                         access_token: 'YOUR_GOOGLE_PLUS_ACCESS_TOKEN'
                     },                    
                    instagram:{
                        accounts: ['@teslamotors','#teslamotors'],
                        limit:2,
                        client_id: 'YOUR_INSTAGRAM_CLIENT_ID'
                    },
                    
                    length:400,
                    show_media:true,
                    // Moderation function - if returns false, template will have class hidden
                    moderation: function(content){
                        return  (content.text) ? content.text.indexOf('fuck') == -1 : true;
                    },
                    //update_period: 5000,
                    // When all the posts are collected and displayed - this function is evoked
                    callback: function(){
                        console.log('all posts are collected');
                    }
                });*/
            

    });
</script>
 
