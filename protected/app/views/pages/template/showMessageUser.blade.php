<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3> My Account <small></small></h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
			<li class="active">Account </li>
		  </ul>		
		</div>
		  
    </div>
</div>	

<div class="container">
        <div class="row" style="padding:10px 40px 10px 40px;" >
            <div class="col-md-2" style="padding:10px; border:1px solid #E8E8E8;">
                <img src="../uploads/users/{{ $profile->avatar == "" ? "default.png" : $profile->avatar }}" width="100%" alt="{{ $profile->username }}"/>
            </div>
            <div class="col-md-10" style="padding-left:50px;">
                <h3>{{ $profile->first_name }} {{ $profile->last_name }}</h3>
                <table width="100%" class="default">
                    <tbody>
                        <tr>
                            <td width="30%">Email</td><td width="70%" >{{ $profile->email }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Username</td><td width="70%" >{{ $profile->username }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Member Since</td><td width="70%" >{{ date("d-m-Y", strtotime($profile->created_at)) }}</td>
                        </tr>
                        
                    </tbody>
                </table>
                <div style="padding:5px;">
                    <a href="edit-profile" class="btn btn-primary">Edit Profile</a> <a href="change-password" class="btn btn-default">Change Password</a>
                </div>
                @if($message != null || $message != "")                    
                    <label style="color:green">{{ $message }}</label>
                @endif
                
            </div>
        </div>
    <div class="row">
        <div class="col-md-12" style='margin-bottom:5px;'><span style='font-size:20px;'>Projects</span> <a href="create-project" class="btn btn-primary" style='float:right;'>Create Project</a></div>
        {{--*/ $i=0 /*--}}
        {{--*/ $flag=0 /*--}}
        <div id="container-project" class="col-md-12" style="margin:0px; padding:0px; border:1px solid white;">
        @foreach ($projects as $project)
                <div class="col-sm-6 col-md-2" style="padding-left:10px;padding-right:10px; padding-bottom:15px;">
                        <div style="border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; ">
                                <div style=" overflow:hidden;border-radius: 4px;">
                                    <a href="show-project/{{ $project->project_alias }}">{{ HTML::image('uploads/banner/'.$project->banner_img, $project->banner_img, array('stype' => 'max-width:100%;', 'width'=>'100%', 'height'=>'140px')) }}</a>
                                </div>
                                <div style="padding-left:10px; padding-right:10px;">
                                    <div style="padding-top:10px;" >
                                            <a href="show-project/{{ $project->project_alias }}" title="{{$project->title}}"><h4>{{ substr($project->title,0,21) }}</a></h4>
                                    </div>
                                    <div style="padding-bottom:0px; height:80px; font-family: 'PT Sans Narrow'; color:#898989;" >{{ substr($project->small_content,0,85) }}</div>
                                    <div style="height: 90px;">
                                        <div class="donutHolder" id="{{ $i }}" data-amount="{{ $project->amount }}" data-funded="{{ $project->hitung_f }}">
                                            <div class="donut" id="itemdonut{{ $i }}" style="padding: 0px; position: relative;"></div>
                                            <span class="donutData" id="itemdonutData{{ $i }}"></span>   
                                        </div>
                                    </div>
                                    <div style="text-align: center;"><h4 style="font-size:16px;">Rp {{ number_format($project->hitung_f,0,",",".") }}<br/><small>of Rp {{ number_format($project->amount,0,",",".") }}</small></h4></div>
                                    <div style="text-align: center;"><h4 style="font-size: 16px;">{{ $project->backer }}<small> pledger</small></h4></div>
                                    
                                    @if( $project->days_to_go->format("%r%a") <= 0)
                                        @if( $project->status == 2)                                                    
                                            <div style="text-align: center;"><h4 style="font-size: 16px; color: white; background-color: #1db262;">Successful !</h4></div>
                                        @elseif ($project->status == 3)  
                                            <div style="text-align: center;"><h4 style="font-size: 16px; color: white; background-color: #e54a1a;">Unsuccessful !</h4></div>
                                        @else
                                        <div style="text-align: center;"><h4 style="font-size: 16px;">0<small> days left</small></h4></div>
                                        @endif                                                  
                                    @else
                                        <div style="text-align: center;"><h4 style="font-size: 16px;">{{ $project->days_to_go->format("%r%a") }}<small> {{ Lang::get('core.home_days_left') }}</small></h4></div>
                                        @endif
                                    
                                    <div style="text-align: center; padding-bottom:8px;"><a href="manage-project/{{ $project->project_alias }}" class='btn btn-primary'>Manage</a></div>
                                </div>
                        </div>

                </div>
                {{--*/ $flag = $project->total /*--}} 
            {{--*/ $i++ /*--}}
        @endforeach
        </div>
        @if( $i < $flag  )
            <div class="col-md-12" align="center"><button type="button" id="btn-loadmore" class="btn btn-primary" >Load More</button>{{ HTML::image('images/ajax-loader.gif', 'loading', array('id' => 'img-loading', 'style'=>'display:none;')) }}</div>
        @endif
    </div>
    <div class="row" style="padding:10px 20px 10px 20px; border-top:1px solid #E8E8E8;">
        <div class="col-md-12" style='margin-bottom:5px;' id="list-backer"><span style='font-size:20px;'>Backed Project</span> </div>
        <table class="grid">
            <thead>
            <tr>
                <th class="col-md-3">Project</th>
                <th class="col-md-2">Pledge Amount</th>
                <th class="col-md-2">Status</th>
                <th class="col-md-3">Reward</th>
                <th class="col-md-1">Date</th>
                <th class="col-md-1">&nbsp;</th>
            </tr>
            </thead>
        {{--*/ $j=0 /*--}}
        <tbody>
            <tr>
                <td colspan="6">
                    <div style="height:400px; overflow:auto;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        @foreach ($backeds as $backed)
                        <tr>            
                                <td class="col-md-3"><img src="../uploads/banner/{{ $backed->banner_img }}" width="60" style="margin-right:20px;" />{{ substr($backed->title,0,33).(strlen($backed->title) > 34 ? "...": "") }}</td>
                                <td class="col-md-2">Rp. {{ number_format($backed->backer_amount,0,",",".") }}</td>
                                <td class="col-md-2">
                                    @if($backed->status ==1)
                                        Confirm
                                    @elseif($backed->status ==0)
                                        Pending
                                    @else
                                        Cancel
                                    @endif
                                </td>
                                <td class="col-md-3">
                                    @if($backed->reward_title == "")
                                    -
                                    @else
                                    {{ $backed->reward_title }}<br/>{{ substr($backed->reward_description,0,90).(strlen($backed->reward_description) > 100 ? "...": "") }}
                                    @endif
                                </td>
                                <td class="col-md-1">{{ date_format($backed->backedDate,"d-m-Y") }}</td>
                                <!--<td class="col-md-1"><a href="topuppledge/{{ $backed->backer_id }}" class="btn btn-primary">Top Up</a></td>-->
                                <td class="col-md-1"><a href="../showMessageUser/{{$backed->project_alias}}?pid={{$backed->project_id}}&bid={{$backed->backer_id}}&e={{Crypt::encrypt($backed->email)}}" style="color:blue">Messages</a></td>

                                

                        </tr>
            {{--*/ $j++ /*--}}
                        @endforeach
                    </table>
                    </div>
                </td>
            </tr>
        </tbody>
        </table>
        <div id="content" style="display:none">                               
            <p>{{ HTML::image('uploads/banner/'.$p_project->banner_img, $p_project->banner_img, array('width'=>'50%')) }}</p>
            <hr/>
            <!--<p style="text-align:center;font-size:16px;"></p>-->
                @foreach($donatur as $d)
                    <p style="font-size:16px;"><b>To: {{$p_owner->first_name}} {{$p_owner->last_name}}</b> </p>
                    <input name="user_id2" type="hidden" value="{{$backed->user_id}}">
                    {{ Form::open(array('url'=>'account/addMessages', 'files'=>true, 'id'=>'formMessage' )) }}
                        <textarea rows="3" name="message_body" id="message_body" style="width:100%;resize:none"></textarea>
                            <br/><br/>
                        <input name="project_id" type="hidden" value="{{$p_project->project_id}}">
                        <input name="user_id" type="hidden" value="{{$d->user_id}}">
                        <input name="email" type="hidden" value="{{$d->email}}">
                        <button type="submit" class="btn btn-primary" id="btn-send-msg">Send Message</button>
                    {{ Form::close() }}
                    <hr/>
                @endforeach
                @foreach($pesan as $message)
                    <p style="font-size:16px;"><u>{{$message->first_name}}&nbsp;{{$message->last_name}}</u></p>
                    <p>{{$message->message}}</p>
                    <p style="font-size:12px;">{{$message->date}}</p>
                    <hr/>
                @endforeach                                                                                                    
        </div>
    </div>
</div>


		

<div class="container" style="margin-bottom:50px;">
	<div class="row">
	
	
	</div>
</div>	
{{ HTML::script('js/jquery.flot.min.js') }}
{{ HTML::script('js/jquery.flot.pie.min.js') }}

{{ HTML::script('js/plugins/js-modal-master/jh-modal-5.js') }}
{{ HTML::style('js/plugins/js-modal-master/jh-modal-4.css') }}


<script type="text/javascript">
    /*
    $.post("protected/app/webservice/testing.php",{id:''},function(result){
        console.log(result);
        $("#test").html(result);
      });*/

    jQuery(document).ready(function(){        
        var page = 1;
        var total;
        $("#btn-loadmore").click(function(){
            var data = {"page":page};
            $.ajax({
                    type: "POST",
                    url: "protected/app/webservice/getListProjectAccount.php",
                    data: data,
                    dataType: "json",
                    beforeSend:function(){                            
                        //success1.hide();                    
                        //error1.hide();
                        $("#btn-loadmore").css("display","none");
                        $("#img-loading").css("display","inherit");
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        alert(errorThrown);
                        //success1.hide();                    
                        //error1.show();     
                        $("#btn-loadmore").css("display","inherit");
                        $("#img-loading").css("display","none");
                    },
                    success: function(data){
                        for(var arr in data){
                            var proj = data[arr];
                            var i = 0;
                            var codeHtml = "<div class=\"col-sm-6 col-md-2\" style=\"padding-left:10px;padding-right:10px; padding-bottom:15px;\">";
                            codeHtml +="<div style=\"border:1px solid #E8E8E8;  min-height:400px; overflow:hidden; \">";
                            codeHtml +="<div style=\"overflow:hidden; border-radius: 4px;\">";
                            codeHtml +="<a href=\"show-project/"+proj['project_alias']+"\"><img src=\"uploads/banner/"+proj['banner_img']+"\" stye=\"max-width:100%;\" width=\"100%\" height=\"140px\" alt=\""+proj['banner_img']+"\" /></a>";
                            codeHtml +="</div>";
                            codeHtml +="<div style=\"padding-left:10px; padding-right:10px;\">";
                            codeHtml +="<div style=\"padding-top:10px;\" >";
                            codeHtml +="<a class=\"project-title\" href=\"show-project/"+proj['project_alias']+"\" title=\""+proj['title']+"\"><h4>"+proj['formated_title']+"</a></h4>";
                            codeHtml +="</div>";
                            codeHtml +="<div style=\"padding-bottom:0px; height:80px; font-family: \'PT Sans Narrow\'; color:#898989;\" >"+proj['small_content'].substr(0,84)+"</div>";
                            codeHtml +="<div style=\"height: 90px;\">";
                            codeHtml +="<div class=\"donutHolder\" id=\""+proj['project_alias']+"\" data-amount=\""+proj['amount']+"\" data-funded=\""+proj['hitung_f']+"\">";   //cek untuk id donut
                            codeHtml +="<div class=\"donut\" id=\"itemdonut"+proj['project_alias']+"\"></div>";
                            codeHtml +="<span class=\"donutData\" id=\"itemdonutData"+proj['project_alias']+"\"></span>";
                            codeHtml +="</div>";
                            codeHtml +="</div>";
                            codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px;\">Rp "+proj['formated_hitung_f']+"<br/><small>of Rp "+proj['formated_amount']+"</small></h4></div>";
                            codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px;\">"+proj['backer']+"<small> pledger</small></h4></div>";
                            if(proj['formated_days'] <= 0)
                            {
                                if(proj['status']  == 2)
                                {
                                   codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px; color: white; background-color: #1db262;\">Successful !</h4></div>";
                                }
                                else if(proj['status']  == 3)
                                {
                                    codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px; color: white; background-color: #e54a1a;\">Unsuccessful !</h4></div>";
                                }
                                else
                                {
                                    codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px;\">0<small> days left</small></h4></div>";  
                                }
                            }
                            else
                            {
                            codeHtml +="<div style=\"text-align: center;\"><h4 style=\"font-size:16px;\">"+proj['formated_days']+"<small> days left</small></h4></div>";
                            }
                            codeHtml +="<div style=\"text-align: center; padding-bottom:8px;\"><a href=\"manage-project/"+proj['project_alias']+"\" class=\'btn btn-primary\'>Manage</a></div>";
                            codeHtml +="</div>";
                            codeHtml +="</div>";
                            codeHtml +="</div>";
                            
                            $("#container-project").append(codeHtml);
                            i++;
                            total = proj['project_total'];                            
                        }   
                        console.log(total);

                        if(data.length > 0){
                            handleDonutChart();
                            page++;

                            if(total == page )
                             {
                                $("#btn-loadmore").css("display","none");
                                $("#img-loading").css("display","none");
                             }
                            else
                             {
                                $("#btn-loadmore").css("display","inherit");
                                $("#img-loading").css("display","none");
                             }
                        }

                        
                    }
                });
            });

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
                var funded= $(donut).data('funded');
                if (funded == null)
                    funded = 0;
                redrawDonut(donut['id'],funded,$(donut).data('amount'));
            }
        
        }
        
        
        $(window).resize(function(){
          handleDonutChart();
        });
        handleDonutChart();


    });
</script>	