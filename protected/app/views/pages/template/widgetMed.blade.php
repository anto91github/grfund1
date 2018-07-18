<?php
header("X-Frame-Options: GOFORIT");
?>
{{--*/ $i=0 /*--}}
<style>
  
  
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
    //border: 1px solid #E8E8E8;
    border: 2px solid #94a6bc;
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
    font-size: 2.8vw;
    text-align: center;
    margin-top: 12px;
    margin-bottom: 10px;
    margin-left: 15px;
    margin-right: 15px;
    width: 96%;
    text-align: left;
    color: #575759;
    line-height: 1.4;  
  }
  .title a {
    color: #575759;
    text-decoration: none;
    text-transform: uppercase;
  }
  .title a:hover {
    color: #7F7F7F;
  }

  .title_black {
    font-family: 'Intro';
    font-weight: 800;
    font-size: 2.8vw;
    text-align: center;
    margin-top: 12px;
    margin-bottom: 10px;
    margin-left: 15px;
    margin-right: 15px;
    width: 96%;
    text-align: left;
    color: #fff;
    line-height: 1.4;
  }
  .title_black a {
    color: #ffffff;
    text-decoration: none;
    text-transform: uppercase;
  }
  .title_black a:hover {
    color: #f2f2f2;
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

.small {
    font-family: 'Intro';
    font-weight: 400;
    font-size: 1.8vw;
    text-align: left;    
    width: 94%;  
    color: #575759;
    margin: 15px;
    margin-top: 3%;
    margin-bottom: 3%;
}

.small_black {
    font-family: 'Intro';
    font-weight: 400;
    font-size: 1.8vw;
    text-align: left;    
    width: 94%;  
    color: #fff;
    margin: 15px;
    margin-top: 3%;
    margin-bottom: 3%;
}

.small_price1 {
    font-family: 'Intro';
    font-size: 2.2vw;
    display: block;
    text-align: left;      
    color: #575759;
    margin-top: 10px;
    line-height: 1.3;
    font-weight: 700;
}

.small_price2 {
    font-family: 'Intro';
    font-size: 2.2vw;
    display: block;
    text-align: left;      
    color: #575759;
    margin-top: 3px;
    line-height: 1.3;
    font-weight: 700;
}

.small_price1_black {
    font-family: 'Intro';
    font-size: 2.2vw;
    display: block;
    text-align: left;    
    color: #fff;
    margin-top: 10px;
    line-height: 1.3;
    font-weight: 700;
}

.small_price2_black {
    font-family: 'Intro';
    font-size: 2.2vw;
    display: block;
    text-align: left;      
    color: #fff;
    margin-top: 3px;
    line-height: 1.3;
    font-weight: 700;
}

.pitch {
    line-height: 1.4;
}

.img_widget {
    height: 100%;
    overflow: hidden;
    text-align: center;
}

.img_widget img {
    //width: auto;
    height: 100%;
    margin: 0 auto;
}

.button_link {
    display: inline-block;
    font-family: 'Intro';
    font-weight: 700;
    font-size: 2.6vw;
    text-align: center;
    color: #fff;
    background: #dc008c;
    text-decoration: none;
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 23px;
    padding-right: 23px;   
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
    width: 39%;
    float: right;
}

.left {
    float: left; 
    width: 40%;
    height: 100%;
}

.right {
    float: left;
    width: 58%;
    height: 100%;
    margin-left: 12px;
}

.meter { 
    height: 20px;
    position: relative;
    background: #D3D3D3;
    -moz-border-radius: 9px;
    -webkit-border-radius: 9px;
    border-radius: 9px;
    -webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.2);
    -moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.2);
    box-shadow        : inset 0 -1px 1px rgba(255,255,255,0.2);
    width: 97%;
    margin-bottom: 4px;
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
    width: 51%;
    margin-left: 15px;
    position: relative;
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
    background-image: -webkit-linear-gradient(
      center bottom,
      rgb(220,0,140) 37%,
      rgb(220,0,140) 69%
     );
    background-image: -moz-linear-gradient(
      center bottom,
      rgb(220,0,140) 37%,
      rgb(220,0,140) 69%
     );
    background-image: -ms-linear-gradient(
      center bottom,
      rgb(220,0,140) 37%,
      rgb(220,0,140) 69%
     );
    background-image: -o-linear-gradient(
      center bottom,
      rgb(220,0,140) 37%,
      rgb(220,0,140) 69%
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
    background-image: -webkit-linear-gradient(
      center bottom,
      rgb(220,0,140) 37%,
      rgb(220,0,140) 69%
     );
    background-image: -moz-linear-gradient(
      center bottom,
      rgb(220,0,140) 37%,
      rgb(220,0,140) 69%
     );
    background-image: -ms-linear-gradient(
      center bottom,
      rgb(220,0,140) 37%,
      rgb(220,0,140) 69%
     );
    background-image: -o-linear-gradient(
      center bottom,
      rgb(220,0,140) 37%,
      rgb(220,0,140) 69%
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
@foreach ($projectList as $project)
    <div id="widget">
      <div class="left">
        <div class="img_widget">
         {{ HTML::image('uploads/banner/'.$project->banner_img, $project->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'140px')) }}
        </div>
      </div>
      <div class="right">
      
        <div class="title">
          <a target="_blank" href="../show-project/{{ $project->project_alias }}">
            {{$project->title}}
          </a>
        </div>
          
        <div class="small">
          <p class="pitch">
            {{$project->small_content}}
          </p>
        </div>
          <?php
          $meter=0; 
          $fund= $project->hitung_f;
          $goal= $project->amount;                

           $meter = $fund/$goal*100;
          ?>
          <div class="meter_div">
              <div class="meter square">
                @if( $project->status == 2) 
                  <span class="goal_progress" style="width: 100%;background-color:#1DB262"><span style="color:white">&nbsp;{{round($meter)}}%</span></span>
                @elseif ($project->status == 3)
                  <span class="goal_progress" style="width:{{round($meter)}}%;background-color:#e54a1a;"><span style="color:white">&nbsp;{{round($meter)}}%</span></span>
                @else              
                  <span class="goal_progress" style="width:{{round($meter)}}%;background-color:#43B3CF;"><span style="color:white">&nbsp;{{round($meter)}}%</span></span>
                @endif
              </div>

            <div>
              <span class="small_price1">Rp {{ number_format($project->hitung_f,0,",",".") }} donated</span>
               @if( $project->days_to_go->format("%r%a") <= 0) 
                   @if( $project->status == 2) 
                    <span class="small_price2">Successful !</span>
                  @elseif ($project->status == 3)
                    <span class="small_price2">Unsuccessful !</span>
                  @else
                    <span class="small_price2">0 days left</span>
                  @endif
                @else
                <span class="small_price2">{{ $project->days_to_go->format("%r%a") }} days left</span>
              @endif
            </div>
            
          </div>
      
        <div class="button_link_root">
          <div class="button_link_div">
            <a class="button_link button_view" style="color:white;" href="../show-project/{{ $project->project_alias }}">Open</a>
          </div>  
        </div>
        <div class="project-logo" style="margin-top:58px;">{{ HTML::image('sximo/images/logo1_project.png') }}</div>
      </div>
    </div> 
    
    {{--*/ $i++ /*--}}                    
@endforeach
    
            
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