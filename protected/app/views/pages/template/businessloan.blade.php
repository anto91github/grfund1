<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3> Business Loan </h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
			<li class="active">Business Loan </li>
		  </ul>		
		</div>
		  
    </div>
</div>	
<div class="container">
        <div class="row" >
            <div class="col-md-2" style="border-right: 1px solid #E0E0E0;">
                <div style="padding: 5px; padding-left:10px; margin-bottom: 4px; background-color: #303030; color:#FFF; border-right: 5px solid #33CC33; ">Loan Term</div>
                <div class="row">
                    <div class="col-md-6"><input type="checkbox" value="1" id="fltr1month" class="filterMonth"
                        @if(strpos($term,'1') !== FALSE)
                            checked
                        @endif
                                                 /> 1 bulan</div>
                    <div class="col-md-6"><input type="checkbox" value="6" id="fltr6month" class="filterMonth"
                        @if(strpos($term,'6') !== FALSE)
                            checked
                        @endif
                                                 /> 6 bulan</div>
                </div>
                <div class="row">
                    <div class="col-md-6"><input type="checkbox" value="2" id="fltr2month" class="filterMonth"
                        @if(strpos($term,'2') !== FALSE)
                            checked
                        @endif
                                                 /> 2 bulan</div>
                    <div class="col-md-6"><input type="checkbox" value="9" id="fltr9month" class="filterMonth"
                        @if(strpos($term,'9') !== FALSE)
                            checked
                        @endif
                                                 /> 9 bulan</div>
                </div>
                <div class="row">
                    <div class="col-md-6"><input type="checkbox" value="3" id="fltr3month" class="filterMonth"
                        @if(strpos($term,'3') !== FALSE)
                            checked
                        @endif
                                                 /> 3 bulan</div>
                    <div class="col-md-6">&nbsp;</div>
                </div>
                <br/>
                <div style="padding: 5px; padding-left:10px; margin-bottom: 4px; background-color: #303030; color:#FFF; border-right: 5px solid #33CC33; ">Interest Rate</div>
                @foreach($loangradeList as $loangrade)
                <div class="row" style="margin-top:2px;">
                    <div class="col-md-1" >
                        <input type="checkbox" id="fltrgrade{{ $loangrade->loangrade_id }}" data-id="{{ $loangrade->loangrade_id }}" data-type="fltrgrade" data-rate1="{{ $loangrade->rate1 }}" data-rate2="{{ $loangrade->rate2 }}" data-rate3="{{ $loangrade->rate3 }}" value="{{ $loangrade->loangrade_id }}" style="padding:0px; margin:0px; vertical-align: middle;"
                               @if(stripos($grade,$loangrade->loangrade_id."") !== FALSE)
                                    checked
                               @endif
                               />
                    </div>
                    <div class="col-md-4" style="padding:0px 2px 0px 2px;" >
                        <div class="loan-grade" style="background-color: {{ $loangrade->grade_color }}; border-color: {{ $loangrade->grade_color }};" >{{ $loangrade->grade }}</div>
                        <div class="loan-subgrade" style="color: {{ $loangrade->grade_color }};  border-color: {{ $loangrade->grade_color }};" >{{ $loangrade->subgrade }}</div> 
                    </div>
                    <div class="col-md-5" style="padding:0px;"><span id="labelgrade{{ $loangrade->loangrade_id }}" style="vertical-align: middle;">{{ $loangrade->rate1 }}%</span> p.a</div>
                </div>
                @endforeach
                <br/>
                <button type="button" id="btnsearch" class="btn btn-primary">Search</button>
                <br/>
                <br/>
            </div>
            <div class="col-md-10">
                <table class="grid">
                    <thead>
                    <tr>
                        <th data-field="amount" class="
                            @if($fsort=='amount')
                                sorting_{{ $sort }}
                            @else
                                sorting
                            @endif
                            ">Lending Amount</th>
                        <th data-field="rate" class="
                            @if($fsort=='rate')
                                sorting_{{ $sort }}
                            @else
                                sorting
                            @endif
                            ">Rate</th>
                        <th data-field="term" class="
                            @if($fsort=='term')
                                sorting_{{ $sort }}
                            @else
                                sorting
                            @endif
                            ">Term</th>
                        <th data-field="purpose" class="
                            @if($fsort=='purpose')
                                sorting_{{ $sort }}
                            @else
                                sorting
                            @endif
                            ">Purpose</th>
                        <th data-field="outstanding" class="
                            @if($fsort=='outstanding')
                                sorting_{{ $sort }}
                            @else
                                sorting
                            @endif
                            ">%Outstanding Debt</th>
                        <th data-field="amountleft" class="
                            @if($fsort=='amountleft')
                                sorting_{{ $sort }}
                            @else
                                sorting
                            @endif
                            ">Amount/Time Left</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 0; ?>
                    @foreach($businessList as $business)
                    @if($i%2==0)
                    <tr data-id="{{ $i }}" onclick="showId(this)">
                    @else
                    <tr data-id="{{ $i }}" class="alt" onclick="showId(this)">
                    @endif
                        <td>IDR {{ number_format($business->valuation,0,",",".") }}</td>
                        <td>
                            <div style="padding:0px 2px 0px 2px; display: table-cell;" width="100%" >
                                <div class="loan-grade" style="background-color: {{ $business->grade_color }}; border-color: {{ $business->grade_color }};" >{{ $business->grade }}</div>
                                <div class="loan-subgrade" style="color: {{ $business->grade_color }};  border-color: {{ $business->grade_color }};" >{{ $business->subgrade }}</div>
                            </div>{{ $business->loan_rate }}%
                        </td>
                        <td>{{ $business->term }}</td>
                        <td>{{ $business->invoice_category }}</td>
                        <td>
                            <div class="bar-empty">
                                <div class="bar-fill" style="width: {{ $business->lending_percent }}%" ></div>
                            </div>
                            <div class="text-right">{{ 100 - $business->lending_percent }}%</div>
                        </td>
                        <td>IDR {{ number_format($business->fundleave,0,",",".") }}<br/>{{ $business->datediff }} days</td>
                        <td><!--<a href="#"><span class="icon-arrow-down" > </span></a>--></td>
                    </tr>
                    <tr id="{{ "id".$i }}" class="display-none">
                        <td colspan="7" style="padding:5px;">
                            <div id="div{{ "id".$i }}" class="width-full background-white display-none lending-profile-container">
                                <div style="background-color: #3366CC; color:#fff; padding:4px;">Borrower : </div>
                                <div style="padding:4px;">
                                    <p>Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet
                                    Loren ipsum dolore sitamet Loren ipsum dolore sitamet</p>
                                </div>
                                <div style="background-color: #3366CC; color:#fff; padding:4px;">Borrower Profile : </div>
                                <div style="padding:4px;">
                                    <p>Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet Loren ipsum dolore sitamet
                                    Loren ipsum dolore sitamet Loren ipsum dolore sitamet</p>
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach
                    <tbody>
                </table>
                {{ $businessList->appends(array('fsort'=>$fsort,'sort'=>$sort,'term'=>$term,'grade'=>$grade))->links() }}
                <!--
                <div class="row" style="padding:5px 0px 5px 0px;">
                    <div class="col-md-2"><a href="#">IDR 100.000</a></div>
                    <div class="col-md-1"><div style="color:#fff; width:40px; border: 1px solid #000; background-color: #002166; text-align: center;">AAA</div>10%</div>
                    <div class="col-md-1">1</div>
                    <div class="col-md-2">IDR 50.000.000</div>
                    <div class="col-md-2">Invoice Financing</div>
                    <div class="col-md-2">
                        <div style="margin-left:0px; margin-right:0px;height:15px; border-radius:4px; background-color:#CCCCCC; overflow:hidden; vertical-align: middle;">
                                <div style="background-color:#2bde73; height:100%; width: 20%" ></div>
                        </div>
                        20%
                    </div>
                    <div class="col-md-2">IDR 17.000.000<br/>6 days</div>
                </div>-->
            </div>
        </div>
</div>
<br/>
<br/>
<script type="text/javascript">
    
    var showId = function(row){
        var id = row.dataset.id;
        $("#id"+id).slideToggle();
        $("#divid"+id).slideToggle();
    }
    
    $(document).ready(function(){
        $(".filterMonth").on("click", function(){
           var obj = $(this);
           var i=0;
           var rate = 0;
           if(obj.is(":checked")){
                var tmp = $("[data-type='fltrgrade']");
                if(obj.val() === "6" || obj.val() === "9"){
                    $("#fltr1month").attr('checked', false);
                    $("#fltr2month").attr('checked', false);
                    $("#fltr3month").attr('checked', false);
                    if(obj.val() === "6") {
                        $("#fltr9month").attr('checked', false);
                        for(i=0;i<tmp.length;i++){
                            rate = tmp[i].dataset.rate2;
                            $("#labelgrade"+tmp[i].dataset.id).html(rate+"%");
                        }
                    }
                    else{ 
                        $("#fltr6month").attr('checked', false);
                        for(i=0;i<tmp.length;i++){
                            rate = tmp[i].dataset.rate3;
                            $("#labelgrade"+tmp[i].dataset.id).html(rate+"%");
                        }
                    }
                }else{
                    $("#fltr9month").attr('checked', false);
                    $("#fltr6month").attr('checked', false);
                    for(i=0;i<tmp.length;i++){
                         rate = tmp[i].dataset.rate1;
                         $("#labelgrade"+tmp[i].dataset.id).html(rate+"%");
                    }
                }
           }
        });
        $(".sorting").click(function(){
            //console.log(document.URL);
            
            var param = updateParameter("fsort",$(this)[0].dataset.field);
            param = updateParameter("sort","asc", param);
            window.location.href=window.location.pathname+"?"+param;
            
        });
        $(".sorting_asc").click(function(){
            //console.log(document.URL);
            
            var param = updateParameter("fsort",$(this)[0].dataset.field);
            param = updateParameter("sort","desc", param);
            window.location.href=window.location.pathname+"?"+param;
            
        });
        $(".sorting_desc").click(function(){
            //console.log(document.URL);
            
            var param = updateParameter("fsort",$(this)[0].dataset.field);
            param = updateParameter("sort","asc", param);
            
            window.location.href=window.location.pathname+"?"+param;
        });
        $("#btnsearch").click(function(){
            var tmp = $("[class='filterMonth']");
            var term = "";
            for(i=0;i<tmp.length;i++){
                if(tmp[i].checked) term += tmp[i].value+"|";
            }
            if(term != "")
                term = term.substr(0,term.length-1);
            
            tmp = $("[data-type='fltrgrade']");
            var grade = "";
            for(i=0;i<tmp.length;i++){
                if(tmp[i].checked) grade += tmp[i].value+"|";
            }
            if(grade != "")
                grade = grade.substr(0,grade.length-1);
            
            var param = updateParameter("term",term);
            param = updateParameter("grade",grade, param);
            window.location.href=window.location.pathname+"?"+param;
            
        });
    });
</script>
<!--
<div class="container" style="margin-bottom:100px;">
	<div class="row">
	
	
	</div>
</div>
-->