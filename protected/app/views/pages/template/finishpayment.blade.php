<div class="wrapper-header ">
    <div class=" container">
		<div class="col-sm-6 col-xs-6">
		  <div class="page-title">
			<h3> {{ $project->title }} </h3>
		  </div>
		</div>
		<div class="col-sm-6 col-xs-6 ">
		  <ul class="breadcrumb pull-right">
			<li><a href="{{ URL::to('') }}">Home</a></li>
			<li class="active">{{ $project->title }} </li>
		  </ul>		
		</div>
		  
    </div>
</div>



<div class="container">
    <div class="row">
        <div class="col-md-12" style="text-align:left;height:350px">
            <div class="span6" style="text-align: center; font-size: 16px; margin: 0px 0; line-height: 40px">
            @if($pm == 2)
                @if($bank == 'bni') 
                    {{ HTML::image('images/bni.jpg','bni',array('width'=>'90px','height'=>'25px','style'=>'margin-right:13px'))}}
                @elseif($bank == 'bca')
                    {{ HTML::image('images/bca.jpg','bca',array('width'=>'90px','height'=>'100%px','style'=>'margin-right:9px'))}}
                @elseif($bank == 'mandiri')
                    {{ HTML::image('images/mandiri.png','mandiri',array('width'=>'100px','height'=>'100%'))}}
                @elseif($bank == 'bri')
                    {{ HTML::image('images/bri.png','bri',array('width'=>'90px','height'=>'100%','style'=>'margin-right:13px'))}}
                @elseif($bank == 'cimb')
                    {{ HTML::image('images/cimb.png','cimb',array('width'=>'115px','height'=>'100%','style'=>'margin-right:9px'))}}
                @else
                    {{ HTML::image('images/Logo_Bank_Permata.png','permata',array('width'=>'118px','height'=>'100%','style'=>'margin-top:-12px'))}}                   
                @endif
                <h3>No Invoice Anda: <?php echo Input::get('inv')?></h3>
                 <p>
                    Please transfer to the following bank account            </p>
                    <h3>Yayasan Pendidikan Cerdas Madani Indonesia <br>
                        Bank Central Asia<br>
                        Cabang Thamrin, Jakarta<br>
                        206.3010.600<br> </h3>               
                <p>Link to your Bank :
                    @if($bank == 'bni') 
                        <a target="_blank" href="https://ibank.bni.co.id/corp/AuthenticationController?__START_TRAN_FLAG__=Y&FORMSGROUP_ID__=AuthenticationFG&__EVENT_ID__=LOAD&FG_BUTTONS__=LOAD/ACTION.LOAD=Y&AuthenticationFG.LOGIN_FLAG=1&BANK_ID=BNI01&LANGUAGE_ID=002">
                            <u>BNI Login</u>
                        </a>
                    @elseif($bank == 'bca')
                        <a target="_blank" href="http://www.klikbca.com/">BCA Login</a>
                    @elseif($bank == 'mandiri')
                        <a target="_blank" href="https://ib.bankmandiri.co.id/retail/Login.do?action=form&lang=in_ID">Mandiri Login</a>
                    @elseif($bank == 'bri')
                        <a target="_blank" href="https://ib.bri.co.id/ib-bri/Login.html">BRI</a>
                    @elseif($bank == 'cimb')
                        <a target="_blank" href="https://www.cimbclicks.co.id/ib-cimbniaga/Login.html">CIMB Niaga</a>
                    @else
                        <a target="_blank" href="https://new.permatanet.com/permatanet/retail/individualLogon">Permata Bank</a>
                    @endif
                </p>
                 <p>Please Confirm your money transfer to this email <a href="mailto:support@gotongroyong.fund">support@gotongroyong.fund</a></p>
            @else
                @if($status == "")
                <!--<p>Thanks for committing to fund our project. We appreciate your support.</p>-->

                <h3>No Invoice Anda: <?php echo Input::get('inv')?></h3>
                <p>Terima kasih telah mendanai project ini</p>
                <p>Dana yang anda kirim akan di konfirmasi oleh tim kami kurang dari 24jam</p>
                <p>Dana yang sudah di konfirmasi akan terdaftar di tab "Backer" yang ada di projek tersebut</p>
                <!--<p>Please Confirm to this email <a href="mailto:support@gotongroyong.fund">support@gotongroyong.fund</a></p>-->
                <p>Silahkan Konfirmasi ke <a href="mailto:support@gotongroyong.fund">support@gotongroyong.fund</a> atau hubungi kami di +6221 - 3190 9100</p>
                @else
                    <p style="color:red;">Payment canceled. Please try again or choose other method payment.</p>
                @endif
            @endif
            <p><a href="{{ URL::to('show-project/'.$project->project_alias)}}"  class="btn btn-primary" >back to project</a></p>
            </div>
        </div>
    </div>
</div>


		

<div class="container" style="margin-bottom:40px;">
	<div class="row">
	
	
	</div>
</div>					