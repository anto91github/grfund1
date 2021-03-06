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
  <div class="homepageHero">
      <div class="homepageHero-title" style="font-weight:900"></div>
      <div class="homepageHero-subtitle">
        <div id="content">   
          <a class="video"  title="Tutorial 'How To Make Video Pitch'" href="https://www.youtube.com/watch?v=RDR02AzqUBA&amp;autoplay=1">{{ HTML::image('images/YouTube-icon-full_color.png', 'video', array('class'=>'vid_head')) }}</a>    
        </div>
      </div>      
    </div>    
</div>
<!-- header END -->
<div style="background-color:#F7F7F7;">
  <div class="container">
    <div class="row" style="padding-top:16px">     
      <span class="sec-menu-1"><a href="show-project/{{ $staffpick[0]->project_alias }}" target="blank">Staff Pick</a></span>
      <!--<span class="sec-menu-2" style="margin-left:20px;"><a href="show-project/{{ $newest[0]->project_alias }}" target="blank">Newest Projects</a></span>-->
      <span class="sec-menu-2" style="margin-left:20px;"><a href="./NewestProjects" target="blank">Newest Projects</a></span>
      <span class="sec-menu-3" style="margin-left:20px;"><a href="./SosialStream" target="blank">Social Stream</a></span>
      <span class="sec-menu-5" style="margin-left:20px;"><a href="./Reference" target="blank">Tutorial & Tips</a></span>      
    </div>
  </div>
</div>

<div style="background-color:#f7f7f7; padding-top:40px;">
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
        <div class="col-sm-6 col-md-3" style="padding-left:15px;padding-right:15px; padding-bottom:10px;">
          <div style="border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; background-color:#fff;  ">
            <div style=" overflow:hidden; border-top-right-radius: 4px; border-top-left-radius: 4px; text-alignment:center;position:relative">
              <a href="show-project/{{ $charity->project_alias }}">
                @if($charity->category == 3)                                                        
                 {{--HTML::image('img/emergency7.png', 'emergency', array('stype' => 'max-width:100%;', 'style' => 'position:absolute; z-index:2;', 'width'=>'20%', 'height'=>'50px'))--}}                                                        
                 {{--HTML::image('uploads/banner/'.$charity->banner_img, $charity->banner_img, array('stype' => 'max-width:100%;' , 'width'=>'100%', 'height'=>'200px'))--}}                                                        
                 {{-- HTML::image('img/emergency.png', $charity->banner_img, array('stype' => 'max-width:100%;' , 'width'=>'100%', 'height'=>'35px')) --}}                                                        
                 {{ HTML::image('uploads/banner/'.$charity->banner_img, $charity->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'234px')) }}                                    
                @elseif($charity->category == 10)
                 {{--HTML::image('img/charity3blue.png', 'emergency', array('stype' => 'max-width:100%;', 'style' => 'position:absolute; z-index:2; left:5px; top:5px', 'width'=>'20%', 'height'=>'50px'))--}}                                                        
                 {{--HTML::image('uploads/banner/'.$charity->banner_img, $charity->banner_img, array('stype' => 'max-width:100%;', 'style' => 'position:relative; z-index:1;' , 'width'=>'100%', 'height'=>'200px')) --}}                                                        
                 {{-- HTML::image('img/charity.png', $charity->banner_img, array('stype' => 'max-width:100%;' , 'width'=>'100%', 'height'=>'35px')) --}}                                                        
                 {{ HTML::image('uploads/banner/'.$charity->banner_img, $charity->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'234px')) }}
                @else                                                        
                 {{ HTML::image('uploads/banner/'.$charity->banner_img, $charity->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'234px')) }}
                @endif
              </a>
            </div>
                                                <div style="padding-left:10px; padding-right:10px;">
                                                  @if($charity->category == 3 || $charity->category == 10 )
                                                    <div style="padding-top:10px; text-align:center; padding-bottom:5px;" >
                                                        <a class="project-title" href="show-project/{{ $charity->project_alias }}" title="{{$charity->title_lang}}">{{ substr($charity->title_lang,0,27).(strlen($charity->title_lang) > 26 ? "...": "")  }}</a>
                                                    </div>
                                                  @else
                                                    <div style="padding-top:11px; text-align:center; padding-bottom:5px;" >
                                                        <a class="project-title" href="show-project/{{ $charity->project_alias }}" title="{{$charity->title_lang}}">{{ substr($charity->title_lang,0,27).(strlen($charity->title_lang) > 26 ? "...": "")  }}</a>
                                                    </div>
                                                  @endif
                                                    <div style="padding-bottom:70px; height:50px; font-family: 'PT Sans Narrow'; color:#898989;">{{ $charity->small_content_lang }}</div>
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
                                                        @if($charity->category == 3 || $charity->category == 10)
                                                          <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:5px">{{ $charity->days_to_go->format("%r%a") }}<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                                                        @else
                                                          <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:10px">{{ $charity->days_to_go->format("%r%a") }}<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                                                        @endif
                                                    @endif
                                                </div>
          </div>
                                    
        </div>
          <?php $i ++; ?>
          
      @endforeach
      <div class="col-md-12">            
            <span style="text-align:center"><h1><a class="btn btn-primary" href="./projects" style="font-size:18px;color:#696969;border-radius:5px !important;background-color:#F7F7F7">{{ Lang::get('core.home_see_more') }}</a></h1></span>
        </div>
    </div>
   
  </div>


</div>

<hr/>
<div class="container" style="background-color:#fff;">
  <div class="row" style="color:#999; background-color:#fff; padding:5px 15px 5px 15px;">
        <div class="area-header col-md-12" >
            <h2 style="font-size:30px;">{{ Lang::get('core.home_projects_map') }}</h2>
            <h4>{{ Lang::get('core.home_projects_map_d') }}</h4>
        </div>
    </div>
  <div id="mapdiv" style="width: 100%; height: 550px;"></div>
</div>

<hr/>
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
        <!--<div class="col-md-4 col-sm-6 col-xs-12" align="center">
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
        </div>-->
        <!--<div class="col-md-4 col-sm-6 col-xs-12" align="center">
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
        </div>-->
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
        <!--<div class="col-md-4 col-sm-6 col-xs-12 " align="center">
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
        </div>-->
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
<div>&nbsp;</div>
<hr/>

<div class="container">
    <!-- BEGIN CLIENTS -->
    <div class="row margin-bottom-40 our-clients" style="padding-left:10px; padding-right:10px;">
      <div class="area-header col-sm-3 col-md-3">
        <h2 style="font-size:20px;">{{ Lang::get('core.home_our_client') }}</h2>
        <p>{{ Lang::get('core.home_our_client_d') }}</p>
      </div>
      <div class="col-sm-9 col-md-9 client">
        <div class="owl-carousel owl-carousel6-brands">
            @foreach($clients as $client)
          <div class="client-item"  >
              <a href="{{$client->link==''?'#' : $client->link}}" target="_blank">
                  <img src="uploads/client/{{ $client->image }}" class='img-responsive' alt="{{ $client->image }}" style="opacity: 0.5;" >
            </a>            
          </div>
            @endforeach  
        </div>
      </div>          
    </div>
    <!-- END CLIENTS -->    
</div>

<a href="./csrSlide">
  <div class="{{ Lang::get('core.home_banner_csr') }}" style="margin-bottom:10px">
      <div class="homepageHero-title" style="font-weight:900"></div>
      <div class="homepageHero-subtitle">
        
      </div>      
    </div>
</a>
<!-- Checkout block BEGIN -->

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

{{ HTML::script('js/plugins/social-feed/bower_components/social-feed/js/jquery.socialfeed.js') }}

{{--HTML::script('css/circularnavigation/js/polyfills.js')--}}
{{--HTML::script('css/circularnavigation/js/demo2.js')--}}

{{--HTML::script('sximo/js/plugins/lightbox2-master/src/js/lightbox.js')--}}
{{--HTML::style('sximo/js/plugins/lightbox2-master/src/css/lightbox.css')--}}
{{--HTML::style('css/lightbox-vid/lightbox.css')--}}

{{ HTML::script('js/plugins/ammap/ammap/ammap.js') }}
{{ HTML::style('js/plugins/ammap/ammap/ammap.css') }}
{{ HTML::script('js/plugins/ammap/ammap/maps/js/indonesiaHigh.js') }}




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
 
