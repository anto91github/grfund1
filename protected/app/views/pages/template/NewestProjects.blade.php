<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3>Newest Projects</h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">{{ Lang::get('core.home') }}</a></li>
			<li class="active">Newest Projects</li>
		  </ul>		
		</div>		  
    </div>
</div>	
	
<div class="container">
    <div class="row">
    	<?php $i =0; ?>
      @foreach($newest_pro as $newest)      
        <div class="col-sm-6 col-md-3" style="padding-left:15px;padding-right:15px; padding-bottom:10px;">
          
          <div style="border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; background-color:#fff;  ">
            <div style=" overflow:hidden; border-top-right-radius: 4px; border-top-left-radius: 4px; text-alignment:center;">
                                                    <a href="show-project/{{ $newest->project_alias }}">{{ HTML::image('uploads/banner/'.$newest->banner_img, $newest->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'200px')) }}</a>
            </div>
                                                <div style="padding-left:10px; padding-right:10px;">
                                                    <div style="padding-top:10px; text-align:center; padding-bottom:5px;" >
                                                        <a class="project-title" href="show-project/{{ $newest->project_alias }}" title="{{$newest->title}}">{{ substr($newest->title,0,27).(strlen($newest->title) > 26 ? "...": "")  }}</a>
                                                    </div>
                                                    <div style="padding-bottom:70px; height:50px; font-family: 'PT Sans Narrow'; color:#898989;">{{ $newest->small_content }}</div>
                                                    <div style="height: 90px;">
                                                        <div class="donutHolder" id="itemholder{{ $i }}">
                                                            <div class="donut" id="itemdonut{{ $i }}"></div>
                                                            <span class="donutData" id="itemdonutData{{ $i }}"></span>   
                                                        </div>
                                                    </div>
                          
                                                    <div style="text-align: center;"><h4 style="font-size:16px;">Rp {{ number_format($newest->hitung_f,0,",",".") }}<br/><small>{{ Lang::get('core.home_of') }} Rp {{ number_format($newest->amount,0,",",".") }}</small></h4></div>
                                                    
                          <div style="text-align: center;"><h4 style="font-size: 16px;">{{ $newest->backer }}<small> {{ Lang::get('core.home_pledger') }}</small></h4></div>
                                                    @if( $newest->days_to_go->format("%r%a") <= 0)
                                                        @if( $newest->status == 2)                                                    
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; color:#fff; background-color: #1db262; padding-top:5px; padding-bottom:5px">{{ Lang::get('core.home_success') }}</h4></div>
                                                        @elseif ($newest->status == 3)  
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; color:#fff; background-color: #e54a1a; padding-top:5px; padding-bottom:5px">{{ Lang::get('core.home_unsuccess') }}</h4></div>
                                                        @else
                                                            <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:5px; padding-bottom:5px;">0<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                                                        @endif                                                  
                                                    @else
                                                        <div style="text-align: center;"><h4 style="font-size: 16px; padding-top:5px">{{ $newest->days_to_go->format("%r%a") }}<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                                                    @endif
                                                </div>
          </div>
                                    
        </div>
          <?php $i ++; ?>
          
      @endforeach
    </div>
</div>		

{{ HTML::script('js/jquery.flot.min.js') }}
{{ HTML::script('js/jquery.flot.pie.min.js') }}

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
        @foreach ($newest_pro as $charity)
            var hitung ={{$charity->hitung_f == null ? 0 : $charity->hitung_f}} ;     
            redrawDonut({{ $i }},hitung, {{ $charity->amount }});
            <?php $i++; ?>
        @endforeach
        
        $(window).resize(function(){
            {{--*/ $i=0 /*--}}
            //var dataPopular = [];
            @foreach ($newest_pro as $charity)
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