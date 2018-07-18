<style>
			video#bgvid 
			{ 
			    position: fixed;
			    top: 50%;
			    left: 50%;
			    min-width: 100%;
			    min-height: 100%;
			    width: auto;
			    height: auto;
			    z-index: -100;
			    -ms-transform: translateX(-50%) translateY(-50%);
			    -moz-transform: translateX(-50%) translateY(-50%);
			    -webkit-transform: translateX(-50%) translateY(-50%);
			    transform: translateX(-50%) translateY(-50%);
			    background: url(header_new.jpg) no-repeat;
			    background-size: cover; 
			}

			video#bgvid {
    			transition: 1s opacity;
			}

			.charity-btn
			{
				background: url('video/home-vid/charity.png') center;
				//background-color: red;
				height: 85%;
				background-repeat: no-repeat;
				width:100%
				background-size: contain;				
			}

			
			.charity-btn:hover
			{
				background: url('video/home-vid/charity-hover.png') center;
				//background-color: yellow;
				height: 85%;
				background-repeat: no-repeat;
				width:100%
				background-size: contain;				
			}

			.business-btn
			{
				background: url('video/home-vid/business.png') center;
				//background-color: blue;
				height: 85%;
				background-repeat: no-repeat;
				width:100%
				background-size: contain;
			}

			.business-btn:hover
			{
				background: url('video/home-vid/business-hover.png') center;
				//background-color: green;
				height: 85%;
				background-repeat: no-repeat;
				width:100%
				background-size: contain;
			}
			.binus-partner
			{
				background: url('video/home-vid/binus.png') center;
				//background-color: yellow;
				height: 291px;
				background-repeat: no-repeat;
			}
			.binus-partner:hover
			{
				background: url('video/home-vid/binus-hover.png') center;
				//background-color: yellow;
				height: 291px;
				background-repeat: no-repeat;
			}

			.white_label
			{
				background: url('video/home-vid/footer.png');
				//background-color: yellow;				
				height: 145px;
				background-repeat: no-repeat;
			}

      .our-clients
      {
        background: url('video/home-vid/footer.png');
        background-repeat: no-repeat;
      }



			.stopfade { opacity: .5; }

			@media screen and (max-device-width: 580px) {
			    /*html {
			         background: url(header_new.jpg) #000 no-repeat center center fixed;
			    }
			    #bgvid {
			        display: none;
			    }*/
			}

			@media (max-width: 580px) {
				#bgvid {
			        display: none;
			    }
				html {
			         //background: url(../img/header_new7.jpg) no-repeat center center fixed;
			         background-color:transparent;
			    }

			    .charity-btn
				{
					background: url('video/home-vid/charity.png') center;					
					height: 40%;
					background-repeat: no-repeat;
					width:100%
					//background-size: contain;				
				}

				.business-btn
				{
					background: url('video/home-vid/business.png') center;				
					height: 40%;
					background-repeat: no-repeat;
					width:100%
					//background-size: contain;
				}			

			}

</style>

		<div style="text-align:right;padding-top:0px">
			<ul class="list-unstyled list-inline pull-right">
                        <span style="color:#1ab394" class="hidden-xs">{{ Lang::get('core.language') }}</span>
                         @if(!Auth::check())
                            @if(CNF_MULTILANG ==1)
                            <li class="user dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">{{ HTML::image('images/'.Lang::get('core.lang_flag')) }}<!--<i class="icon-flag2"></i>--><i class="caret"></i></a>
                                 <ul class="dropdown-menu dropdown-menu-right icons-right">                                    
                                    @foreach(SiteHelpers::langOption() as $lang)
                                        <li><a href="{{ URL::to('home/lang/'.$lang['folder'])}}">
                                            <?php if ($lang['name']=='English'){ ?>
                                               {{ HTML::image('images/britishFlagIcon.png', 'eng', array('style' => 'float:right;')) }}                                       
                                            <?php } else { ?>                                          
                                               {{ HTML::image('images/Indonesia-Flag-icon.png', 'ind', array('style' => 'float:right;')) }}  
                                            <?php } ?> 
                                            <!--<i class="icon-flag2"></i>--> {{  $lang['name'] }}</a></li>
                                    @endforeach 
                                </ul>
                            </li>   
                            @endif	
                            
                        @else
                                <!--<li><a href="{{-- URL::to('user/profile') --}}"><i class="fa fa-user "></i>Account</a></li>-->
                                 @if(CNF_MULTILANG ==1)
                                <li  class="user dropdown"><a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">{{ HTML::image('images/'.Lang::get('core.lang_flag')) }}<!--<i class="icon-flag2"></i>--><i class="caret"></i></a>
                                     <ul class="dropdown-menu dropdown-menu-right icons-right">
                                        @foreach(SiteHelpers::langOption() as $lang)
                                            <li><a href="{{ URL::to('home/lang/'.$lang['folder'])}}">
                                                <?php if ($lang['name']=='English'){ ?>                                      
                                                    {{ HTML::image('images/britishFlagIcon.png', 'eng', array('style' => 'float:right;')) }}
                                                <?php } else { ?>                                         
                                                    {{ HTML::image('images/Indonesia-Flag-icon.png', 'ind', array('style' => 'float:right;')) }}  
                                                <?php } ?>                                              
                                                <!--<i class="icon-flag2"></i>--> {{  $lang['name'] }}</a></li>
                                        @endforeach 
                                    </ul>
                                </li>   
                                @endif  
                                <li><a href="{{ URL::to('account') }}"><i class="fa fa-user "></i>{{ Lang::get('core.header_account') }}</a></li>
                                @if(Auth::user()->group_id==1 || Auth::user()->group_id==2 || Auth::user()->group_id==4)
                                <li><a href="{{ URL::to('dashboard') }}"><i class="fa fa-desktop"></i>{{ Lang::get('core.header_dashboard') }}</a></li>	
                                @endif
                                <li><a href="{{ URL::to('user/logout') }}" ><i class="fa  fa-sign-out"></i><span class="hidden-xs">{{ Lang::get('core.header_logout') }}</span></a></li>
                               				 
                        @endif	
                    </ul>
		</div>

		<div style="text-align:center;padding-top:0px; background: url('video/home-vid/logo.png') center no-repeat; height:165px;">
			<!--<img src="video/home-vid/logo.png" height="100px">-->
			<!--<div style="background: url('video/home-vid/binus.png') center height:200px; width:100px">
				&nbsp;
			</div>-->
		</div>
		<video autoplay loop poster="header_new.jpg" id="bgvid">		    
		    <source src="video/home-vid/Comp_2.mp4" type="video/mp4">
		</video>
		<!--<button id="vidpause">Pause</button>-->
		<br/>
		<!--<div style="height:305px;margin-top:80px">-->
		<div style="height:305px;padding-top:80px;" >
			<a href="charity">
				<div class="col-xs-6 charity-btn"></div>
				<!--<img src="video/home-vid/charity.png" height="55%">-->
			</a>

			<a href="UnderConstruction">
      <!--<a href="startup">-->
				<div class="col-xs-6 business-btn">
					<!--<img src="video/home-vid/business.png" height="55%">-->
				</div>
			</a>	
		</div>
		
		<!--<div class="container" style="text-align:center;background-color:black;color:white;margin-bottom:10px;opacity:0.25;font-size:21px;"><b>Our Partners Site</b></div>-->
		<div class="" style="text-align:center; padding-bottom:0px">
			<div style="text-align:center;padding-bottom:0px;color:white;font-size:35px;font-family:verdana">
				<!--<b>OR</b>-->
			</div>
			<!--<img src="video/home-vid/our-partner-site.png">-->
		</div>

		<!--<div class="white_label">
			<div class="col-xs-4" style="text-align:center;">
				<a href=""><img src="video/home-vid/binus.png" height="130" onmouseover="hover_binus(this);" onmouseout="unhover_binus(this);"></a>
			</div>			
			<div class="col-xs-4" style="text-align:center">
				<a href=""><img src="video/home-vid/tahir.png" height="130" onmouseover="hover_tahir(this);" onmouseout="unhover_tahir(this);"></a>
			</div>
			<div class="col-xs-4" style="text-align:center">
				<a href=""><img src="video/home-vid/tzuchi.png" height="130" onmouseover="hover_tzuchi(this);" onmouseout="unhover_tzuchi(this);"></a>
			</div>
		</div>-->

		<!-- BEGIN CLIENTS -->
    
    <div class="row margin-bottom-40 our-clients" style="padding-left:60px; padding-right:10px;">
      <!--<div class="area-header col-sm-3 col-md-3">
        <h2 style="font-size:20px;">{{ Lang::get('core.home_our_client') }}</h2>
        <p>{{ Lang::get('core.home_our_client_d') }}</p>
      </div>-->

      <!--<div class="col-sm-12 col-md-12 client">
        <div class="owl-carousel owl-carousel6-brands">
         @foreach($label as $label)   
          <div class="client-item" style="height:128px;">
              <a href="showHome/{{$label->alias}}" target="_blank">
                  <img src="video/home-vid/{{$label->image}}" class="img-responsive" height="130" onmouseover="hover_{{$label->alias}}(this);" onmouseout="unhover_{{$label->alias}}(this);">
              </a>            
          </div>
          @endforeach
          
          
            
        </div>
      </div>-->          
    </div>

    <!-- END CLIENTS --> 


		<div id="footer" style="position: fixed ; bottom: 0; width: 100%; background-color:#E9E9E9">
			<div class="container">
				<div class="col-md-12" style="padding:10 0 10 0"> Copyright 2015 GotongRoyongFund. ALL Rights Reserved. Supported by <a href="http://cerdasmadani.org/">Yayasan Pendidikan Cerdas Madani Indonesia</a> <a href="privacy-policy">Privacy Policy</a> | <a href="terms-conditions">Terms</a></div>
				
			</div>	
		</div>

		{{ HTML::style('sximo/themes/mango/js/owl-carousel/owl.carousel.css')}}	
		{{ HTML::style('sximo/themes/mango/js/owl-carousel/owl.theme.css')}}
		{{ HTML::script('sximo/themes/mango/js/owl-carousel/owl.carousel.js') }}

<script type="text/javascript">
	var vid = document.getElementById("bgvid"),
pauseButton = document.getElementById("vidpause");
function vidFade() {
    vid.classList.add("stopfade");
}
vid.addEventListener('ended', function() {
    // only functional if "loop" is removed 
     vid.pause();
	// to capture IE10
	vidFade();
});
/*pauseButton.addEventListener("click", function() {
    vid.classList.toggle("stopfade");
	if (vid.paused) {
vid.play();
		pauseButton.innerHTML = "Pause";
	} else {
        vid.pause();
        pauseButton.innerHTML = "Paused";
	}
})*/
@foreach($label_2 as $label)
  function hover_{{$label->alias}}(element) {
      element.setAttribute('src', 'video/home-vid/{{$label->alias}}-hover.png');
  }
  function unhover_{{$label->alias}}(element) {
      element.setAttribute('src', 'video/home-vid/{{$label->image}}');
  }
@endforeach
jQuery(document).ready(function(){
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
	});

</script>