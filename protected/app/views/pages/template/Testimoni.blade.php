<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3>Testimonial</h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">{{ Lang::get('core.home') }}</a></li>
			<li class="active">Testimonial</li>
		  </ul>		
		</div>		  
    </div>
</div>	

<div style='height:40px;'></div>
<div class="container">
    <div class="row" style="color:#999; background-color:#fff; padding:5px 15px 5px 15px;">
        <div class="area-header col-md-6 col-sm-6 col-xs-12" >
            <h2 style="font-size:30px;">{{ Lang::get('core.home_bene') }}</h2>
            <h4 style="color:black">{{ Lang::get('core.home_bene_d') }}</h4>


        </div>
        <div class="col-md-6 col-sm-6 col-xs-12 testimonial">
            <div class="owl-carousel owl-carousel5-brands">
                @foreach($beneficiary_testimonials as $testimoni)
                <div class="client-item">
                  <blockquote style="color:black;"><p>{{ strip_tags($testimoni->testimoni) }}</p></blockquote>
                  <div class="carousel-info" style="padding-left:20px;">
                      @if($testimoni->picture != '')
                        <img class="pull-left" src="uploads/testi/{{ $testimoni->picture }}" alt="{{ $testimoni->picture }}" style="border-radius: 50%; overflow:hidden; width:50px; margin-right:20px;">
                      @endif
                    <div class="pull-left" style="padding-left:0px;">
                      <span class="testimonials-name" style="color:black">{{ $testimoni->name }}</span><br/>
                      <span class="testimonials-post" style="color:black">{{ $testimoni->job }}</span>
                    </div>
                  </div>
                </div>
                @endforeach
            </div>          
          </div>       
    </div>

    <div class="row" style="padding:5px;">
    	<div class="area-header col-md-6 col-sm-6 col-xs-12" >
            <h2 style="font-size:30px;">{{ Lang::get('core.home_testi') }}</h2>
            <h4>{{ Lang::get('core.home_testi_d') }}</h4>
        </div>
        
         <!-- TESTIMONIALS -->
          <div class="col-md-6 col-sm-6 col-xs-12 testimonial">
            <div class="owl-carousel owl-carousel5-brands">
                @foreach($testimonials as $testimoni)
                <div class="client-item">
                  <blockquote><p>{{ strip_tags($testimoni->testimoni) }}</p></blockquote>
                  <div class="carousel-info" style="padding-left:20px;">
                      @if($testimoni->picture != '')
                        <img class="pull-left" src="uploads/testi/{{ $testimoni->picture }}" alt="{{ $testimoni->picture }}" style="border-radius: 50%; overflow:hidden; width:50px; margin-right:20px;">
                      @endif
                    <div class="pull-left" style="padding-left:0px;">
                      <span class="testimonials-name">{{ $testimoni->name }}</span><br/>
                      <span class="testimonials-post">{{ $testimoni->job }}</span>
                    </div>
                  </div>
                </div>
                @endforeach
            </div>
             
          </div>
          <!-- END TESTIMONIALS -->
    </div>
</div>



<script type="text/javascript">
    jQuery(document).ready(function(){       
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
    });
</script>