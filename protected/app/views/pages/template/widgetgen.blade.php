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
    border: 2px solid #94A6BC;
    display: block;
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    overflow: hidden;
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
    font-weight: 800;
    font-size: 20px;
    text-align: center;
    margin-top: 25px;
    margin-bottom: 20px;
    margin-left: 15px;
    margin-right: 15px; 
    color: #575759;
  }
  .title_black {
    font-family: 'Intro';
    font-weight: 800;
    font-size: 20px;
    text-align: center;
    margin-top: 25px;
    margin-bottom: 20px;
    margin-left: 15px;
    margin-right: 15px; 
    color: #ffffff;       
  }
  .title a, .title_black a {
    text-tranform: uppercase;
    text-decoration: none;
  }
  .title a {
    color: #575759;
  }
  .title a:hover {
    color: #7F7F7F;
  }
  .title_black a {
    color: #ffffff;
  }
  .title_black a:hover {
    color: #f2f2f2;
  }

  .price1 {
    font-family: 'Intro';
    font-weight: 800;
    font-size: 20px;
    text-align: center;
    margin-top: 15px;    
    margin-bottom: 4px;  
  }

  .price1.pledged {
    color: #78be20;
  }
  .price1.donated {
    color: #dc008c;
  }

  .price2 {
    font-family: 'Intro';
    font-weight: 800;
    font-size: 20px;
    text-align: center;
    color: #03A9E3;
    margin-top: 15px;
    margin-bottom: 4px;       
  }

  .small {
    font-family: 'PT Sans Narrow';
    font-weight: 500;
    font-size: 16px;
    text-align: center;
    color: #52555A;      
  }

  .small_black {
    font-family: 'Intro';
    font-weight: 400;
    font-size: 14px;
    text-align: center;
    color: #fff;      
  }

  .img_widget {
    margin-top: 20px;
    margin-bottom: 30px;
  }

  .button_link {
    font-family: 'Intro';
    font-weight: 500;
    font-size: 20px;
    text-align: center;
    color: #fff;
    background: #dc008c;
    text-decoration: none;
    padding-top: 5px;
    padding-bottom: 5px;
    padding-left: 15px;
    padding-right: 15px;   
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;   
    text-transform: uppercase   
  }

  .button_link_div {
    width: 146px;  
    margin: 0 auto;
  }

  .button_pledge {
    background-color: #78be20;
  }

  .button_donate {
    background-color: rgb(220,0,140);
  }

  .button_view {
    background-color: #5e9cd2;
  }

</style>


    <div id="widget">
      <div class="title">
        <a target="_blank" href="http://gotongroyong.fund" target="_blank">
          <img style="max-width:100%; width: 100%; height:auto;" src="sximo/themes/mango/img/logo.png">

        </a>
      </div>
        <div class="small" style="padding-left:5px;padding-right:5px">           
          Konsep GotongRoyongFund's adalah untuk menciptakan dukungan keuangan dan inovator yang diperlukan untuk membangun sebuah ide menjadi proyek besar.
           <hr/>
        </div>
        <div class="small">
          
        </div>
          <div class="price2"</div>
        
      <div class="img_widget">
        <img style="max-width:100%; width: 100%; height:auto;" src="img/2.png">
      </div>
        
      <div class="button_link_div">
            <a class="button_link button_view" style="color:white;font-family: 'PT Sans Narrow';" href="http://gotongroyong.fund" target="_blank">Visit</a>
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