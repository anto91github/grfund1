<?php
header("X-Frame-Options: GOFORIT");
?>
{{--*/ $i=0 /*--}}
<style>
  @font-face{
    font-family:'Helvetica Neue';
    font-weight:400;
    font-style:normal;
    src:url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_55_Roman.eot');
    src:local('☺︎'),
      url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_55_Roman.eot?#iefix') format('embedded-opentype'),
      url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_55_Roman.woff') format('woff'),
      url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_55_Roman.ttf') format('truetype'),
      url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_55_Roman.svg') format('svg');
  }
  @font-face{
    font-family:'Helvetica Neue';
    font-weight:600;
    font-style:normal;
    src:url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_65_Medium.eot');
    src:local('☺︎'),
      url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_65_Medium.eot?#iefix') format('embedded-opentype'),
      url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_65_Medium.woff') format('woff'),
      url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_65_Medium.ttf') format('truetype'),
      url('//widget.givealittle.co.nz/css/fonts/Helvetica_Neue_65_Medium.svg') format('svg');
  }
  @font-face{
    font-family:Intro;
    font-weight:400;
    font-style:normal;
    src:url('//widget.givealittle.co.nz/css/fonts/Intro_Regular.eot');
    src:local('☺︎'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Regular.eot?#iefix') format('embedded-opentype'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Regular.woff') format('woff'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Regular.ttf') format('truetype'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Regular.svg') format('svg');
  }
  @font-face{
    font-family:Intro;
    font-weight:700;
    font-style:normal;
    src:url('//widget.givealittle.co.nz/css/fonts/Intro_Bold.eot');
    src:local('☺︎'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Bold.eot?#iefix') format('embedded-opentype'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Bold.woff') format('woff'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Bold.ttf') format('truetype'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Bold.svg') format('svg');
  }
  @font-face{
    font-family:Intro;
    font-weight:800;
    font-style:normal;
    src:url('//widget.givealittle.co.nz/css/fonts/Intro_Black.eot');
    src:local('☺︎'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Black.eot?#iefix') format('embedded-opentype'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Black.woff') format('woff'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Black.ttf') format('truetype'),
      url('//widget.givealittle.co.nz/css/fonts/Intro_Black.svg') format('svg');
  }
  
  /* Reset */

  /* http://meyerweb.com/eric/tools/css/reset/ 
     v2.0 | 20110126
     License: none (public domain)
  */

  html, body, div, span, applet, object, iframe,
  h1, h2, h3, h4, h5, h6, p, blockquote, pre,
  a, abbr, acronym, address, big, cite, code,
  del, dfn, em, img, ins, kbd, q, s, samp,
  small, strike, strong, sub, sup, tt, var,
  b, u, i, center,
  dl, dt, dd, ol, ul, li,
  fieldset, form, label, legend,
  table, caption, tbody, tfoot, thead, tr, th, td,
  article, aside, canvas, details, embed, 
  figure, figcaption, footer, header, hgroup, 
  menu, nav, output, ruby, section, summary,
  time, mark, audio, video {
    margin: 0;
    padding: 0;
    border: 0;
    font-size: 100%;
    font: inherit;
    vertical-align: baseline;
  }
  /* HTML5 display-role reset for older browsers */
  article, aside, details, figcaption, figure, 
  footer, header, hgroup, menu, nav, section {
    display: block;
  }
  body {
    line-height: 1;
  }
  ol, ul {
    list-style: none;
  }
  blockquote, q {
    quotes: none;
  }
  blockquote:before, blockquote:after,
  q:before, q:after {
    content: '';
    content: none;
  }
  table {
    border-collapse: collapse;
    border-spacing: 0;
  }

  /* end reset */

  body {
    margin: 0;
    padding: 0;
    border: 0;
  }

  #widget, #widget_black {
    border: 3px solid #94A6BC;
    display: block;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    overflow: hidden;
    white-space: nowrap;
  }

  #widget {
    background: #ffffff;
  }

  #widget_black {
    background: #2A3139;
  }

  .font1 {
    font-family: 'Helvetica Neue';
    font-weight: 400;
  }

  .font2 {
    font-family: 'Helvetica Neue';
    font-weight: 600;
  }

  .font3 {
    font-family: 'Intro';
    font-weight: 400;
  }

  .font4 {
    font-family: 'Intro';
    font-weight: 700;
  }

  .font5 {
    font-family: 'Intro';
    font-weight: 800;
  }

  .title {
    font-family: 'Intro';
    font-weight: 600;
    font-size: 18px;
    text-align: center;
    margin-top: 10px;
    margin-bottom: 10px;
    margin-left: 15px;
    margin-right: 15px;
    width: 330px;
    text-align: left;
    color: #575759;        
}

.price1 {
    font-family: 'Intro';
    font-weight: 800;
    font-size: 20px;
    text-align: center;
    color: #DB4990;
    margin-top: 15px;      
}

.price2 {
    font-family: 'Intro';
    font-weight: 800;
    font-size: 20px;
    text-align: center;
    color: #03A9E3;
    margin-top: 15px;        
}

.price1_black {
    font-family: 'Intro';
    font-weight: 800;
    font-size: 20px;
    text-align: center;
    color: #fff;
    margin-top: 15px;      
}

.price2_black {
    font-family: 'Intro';
    font-weight: 800;
    font-size: 20px;
    text-align: center;
    color: #fff;
    margin-top: 15px;        
}

.small {
    font-family: 'Helvetica Neue';
    font-weight: 400;
    font-size: 14px;
    text-align: left;    
    width: 330px;  
    color: #575759;
    margin: 15px;
    margin-top: 10px;
    margin-bottom: 20px;
}

.small_price1 {
    font-family: 'Intro';
    font-weight: 400;
    font-size: 2.4vw;
    text-align: left;      
    color: #575759;
    margin-left: 15px;
    float: left;
    margin-top: 3px;
    margin-bottom: 4px;
}

.small_price2 {
    font-family: 'Intro';
    font-weight: 400;
    font-size: 2.4vw;
    text-align: right;      
    color: #575759;
    float: right;
    margin-top: 3px;
    margin-bottom: 4px;
}

.small_price1_black {
    font-family: 'Intro';
    font-weight: 400;
    font-size: 2.4vw;
    text-align: left;      
    color: #fff;
    margin-left: 15px;
    float: left;
    margin-top: 3px;
    margin-bottom: 4px;
}

.small_price2_black {
    font-family: 'Intro';
    font-weight: 400;
    font-size: 2.4vw;
    text-align: right;      
    color: #fff;
    float: right;
    margin-top: 3px;
    margin-bottom: 4px;
}

.img_widget {
    margin-top: 0px;
    margin-bottom: 40px;
}

.button_link {
    display: inline-block;
    font-family: 'Intro';
    font-weight: 700;
    //font-size: 2.6vw;
    font-size: 12px;
    text-align: center;
    color: #fff;
    background: #dc008c;
    text-decoration: none;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 15px;
    padding-right: 15px;   
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    text-transform: uppercase;
}

  .button_link.button_donate { background: #dc008c; }
  .button_link.button_pledge { background: #78be20; }
  .button_link.button_view { background: #5e9cd2; }

.button_link_div {
    width: 100%;  
    margin: 0 auto;
}

.button_link_root {
    width: 25%;  
    /*margin-right: 15px;*/
    float: right;
    margin-top: 6px;
}

.left {
    float: left;    
}

.right {
    float: right;
}

.meter { 
    height: 12px;
    position: relative;
    background: #D3D3D3;
    -moz-border-radius: 9px;
    -webkit-border-radius: 9px;
    border-radius: 9px;
    -webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.2);
    -moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.2);
    box-shadow        : inset 0 -1px 1px rgba(255,255,255,0.2);
    width: 98%;
    margin-left: 15px;
    margin-bottom: .3vw;
    overflow: hidden;
}
.meter.square {
  -moz-border-radius: 0;
  -webkit-border-radius: 0;
  border-radius: 0;
  height: 15px;
}

.meter_div {
    float: left;
    width: 65%;
    margin-top: 6px;
}

  .goal_progress {
    display: block;
    height: 100%;
    //background-color: #dc008c;
    /*
    background-image: -webkit-gradient(
      linear,
      left bottom,
      left top,
      color-stop(0, rgb(43,194,83)),
      color-stop(1, rgb(84,240,84))
      );
    background-image: -webkit-gradient(
      linear,
      left bottom,
      left top,
      color-stop(0, rgb(43,194,83)),
      color-stop(1, rgb(84,240,84))
      );
    background-image: -webkit-linear-gradient(
      center bottom,
      rgb(43,194,83) 37%,
      rgb(43,194,83) 69%
      );
    background-image: -moz-linear-gradient(
      center bottom,
      rgb(43,194,83) 37%,
      rgb(43,194,83) 69%
      );
    background-image: -ms-linear-gradient(
      center bottom,
      rgb(43,194,83) 37%,
      rgb(43,194,83) 69%
      );
    background-image: -o-linear-gradient(
      center bottom,
      rgb(43,194,83) 37%,
      rgb(43,194,83) 69%
      );
    */
      -webkit-box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
    -moz-box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
    position: relative;
    overflow: hidden;
  }

  .target_progress {
    display: block;
    height: 100%;
    background-color: #78be20;
    /*
    background-image: -webkit-gradient(
      linear,
      left bottom,
      left top,
      color-stop(0, rgb(43,194,83)),
      color-stop(1, rgb(84,240,84))
      );
    background-image: -webkit-gradient(
      linear,
      left bottom,
      left top,
      color-stop(0, rgb(43,194,83)),
      color-stop(1, rgb(84,240,84))
      );
    background-image: -webkit-linear-gradient(
      center bottom,
      rgb(43,194,83) 37%,
      rgb(43,194,83) 69%
      );
    background-image: -moz-linear-gradient(
      center bottom,
      rgb(43,194,83) 37%,
      rgb(43,194,83) 69%
      );
    background-image: -ms-linear-gradient(
      center bottom,
      rgb(43,194,83) 37%,
      rgb(43,194,83) 69%
      );
    background-image: -o-linear-gradient(
      center bottom,
      rgb(43,194,83) 37%,
      rgb(43,194,83) 69%
      );
    */
      -webkit-box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
    -moz-box-shadow: 
      inset 0 2px 9px  rgba(255,255,255,0.3),
      inset 0 -2px 6px rgba(0,0,0,0.4);
    position: relative;
    overflow: hidden;
  }

</style>

   <div id="widget">  
        
        <div class="meter_div">
          <div class="small_price1" style="margin-top:0px;margin-left:15px">
          <a target="_blank" href="http://localhost/grfund/">
            GotongRoyong.Fund
          </a>
        </div>

            <div class="meter square">                
                  <span class="goal_progress" style="width: 100%;background-color:#1DB262"><span style="color:white">&nbsp;</span></span>
            </div>          

        </div>
      <div class="button_link_root" style="margin-top:0px;margin-right:10px">
        
        <div class="button_link_div" style="margin-left:45px;margin-top:5px;">
            <a class="button_link button_view" style="color:white" href="http://localhost/grfund">Visit</a>
        </div>  
      </div>
    </div>
    
    {{--*/ $i++ /*--}}                    

    
            
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