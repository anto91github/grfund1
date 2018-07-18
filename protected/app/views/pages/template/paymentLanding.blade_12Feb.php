<div class="wrapper-header ">
    <div class="container" >
        <div class="col-sm-6 col-xs-6">
          <div class="page-title" style="padding-bottom:10px;">
            <h3> Payment <small></small></h3>
          </div>
        </div>
        <div class="col-sm-6 col-xs-6 ">
          <ul class="breadcrumb pull-right">
            <li><a href="{{ URL::to('') }}">Home</a></li>
                        <li><a href="{{ URL::to('projects') }}">Projects</a></li>
            <li class="active">Payment</li>
          </ul>     
        </div>
          
    </div>
</div>  

<div class="container">
    <div class="row" style="">
        <div class="col-md-12" style="text-align:left;height:359px">
        {{Form::open(array('url'=>'submitpledge/veritrans'))}} 
            <div class="col-md-3"><h3>Credit Card / Paypal</h3>
                <div style="text-align:left">Pembayaran menggunakan VISA, Mastercard dan juga PayPal </div>
                <div style="text-align:right;"><a href="#" style="color:blue;font-size:15px" id="trigger">(How to)</a><hr/></div>
                    <div id="content" style="display:none">
                        <h3>Credit Card</h3><hr />
                        <p>1. Pilih pembayaran melalui Kartu kredit.</p>
                        <p>2. Anda akan di redirect ke website pembayaran veritrans.</p>
                        <p>3. Masukkan nomor kartu kredit, expiration date & CVV dari kartu kredit yang Anda gunakan.</p>
                        <p>4. Pastikan detail pembayaran Anda benar & lanjutkan ke step 3D Secure.</p>
                        <p>5. One Time Password (OTP) akan dikirimkan ke nomor ponsel Anda yang teregistrasi dengan kartu kredit yang Anda gunakan. </p> 
                        <p>6. Masukkan OTP yang Anda dapat ke halaman 3D Secure. </p> 
                        <p>7. Pembayaran Anda dengan Kartu Kredit 3DS selesai. </p>                                             
                    </div>
                
                <div style="text-align:center;padding-top:0px;padding-right:15px" class="row">
                    <div  style="padding-top:0px">{{ HTML::image('images/visa.jpg','visa',array('width'=>'85','height'=>'100%'))}}</div>
                    <div  style="padding-top:25px">{{ HTML::image('images/mastercard.jpg','visa',array('width'=>'65','height'=>'100%x'))}}</div>
                    <div  style="padding-top:20px" >{{ HTML::image('images/paypal_02.png','visa',array('width'=>'95px','height'=>'100%'))}}</div>
                </div>
            
        
                <div class="col-md-12" style="margin-top:23px; text-align:center;"><button type="submit" class="btn btn-primary" id="btn-sub-fun">Credit Card</button></div>
            </div>
        {{ Form::close() }}
 {{Form::open(array('url'=>'submitpledge/veritrans'))}} 
         <div class="col-md-3"><h3>Internet Banking <small>(Veritrans)</small></h3>
           <div style="text-align:left">Pembayaran dengan fasilitas Internet Banking via Veritrans.</div>
		   <div style="text-align:right;"><a href="#" style="color:blue;font-size:15px" id="trigger4">(How to)</a><hr/></div>
            <div id="content4" style="display:none">
                        <h3>Internet Banking (Veritrans)</h3><hr />
                        <p>1. Pilih pembayaran melalui Internet Banking.</p>
                        <p>2. Untuk sementara, fasilitas Internet Banking yang tersedia hanya Mandiri ClickPay.</p>
                        <p>3. Anda akan di redirect ke website pembayaran veritrans.</p>                        
                        <p>4. Pilih Tab Mandiri Clickpay di Select Payment Method.</p>
                        <p>5. Masukan Token Mandiri.</p> 
                        <p>6. Tunggu hingga proses selesai.</p>                                             
                </div>
            
            <div style="padding-top:0px;padding-right:0px" class="row">                    
                <div class="col-md-6">{{ HTML::image('images/logo_bcaklikpay.png','visa',array('width'=>'69px','height'=>'100%'))}}</div>
                <div class="col-md-6">{{ HTML::image('images/ATM_Bersama.png','visa',array('width'=>'59','height'=>'100%'))}}</div>
                                      
            </div>

            <div style="padding-top:10px;" class="row">
				<div class="col-md-6" style="padding-left:20px">{{ HTML::image('images/logo_prima_atm(4).png','visa',array('width'=>'59px','height'=>'100%'))}}</div>
                <div class="col-md-6" style="padding-left:13px">{{ HTML::image('images/mandiri-clickpay.png','visa',array('width'=>'75','height'=>'100%'))}}</div>              				
            </div>

			<div style="padding-top:15px;" class="row">
				<div class="col-md-6" style="padding-left:10px">{{ HTML::image('images/cimb-clicks.png','visa',array('width'=>'100','height'=>'100%'))}}</div>
                 <div class="col-md-6" style="padding-left:18px">{{ HTML::image('images/logo_epay_bri.png','visa',array('width'=>'85px','height'=>'100%'))}}</div> 
			</div>
        
            
            <div class="col-md-12" style="margin-top:14px; text-align:center;"><button type="submit" class="btn btn-primary" id="btn-sub-fun">Internet Banking</button></div>
         </div>
		{{ Form::close() }}
		{{Form::open(array('url'=>'submitpledge/transfer'))}}
            <div class="col-md-3"><h3>Bank Transfer</h3>
                <div>Pembayaran transfer yang lebih mudah dari berbagai bank terkemuka</div>
                 <div style="text-align:right;"><a href="#" style="color:blue;font-size:15px" id="trigger2">(How to)</a><hr/></div>
                    <div id="content2" style="display:none">
                        <h3>Bank Transfer</h3><hr />
                        <p>1. Pilih salah satu Bank.</p>
                        <p>2. Dihalaman selanjutnya silahkan klik link menuju login bank yang anda pilih.</p>
                        <p>3. Transfer ke rek BCA 206.3083.658 atas nama Koperasi Selaras</p> 
                        <p>4. Anda juga dapat mentransfer dana melalui mesin ATM atau teller bank</p>
                        <p>5. Setelah melakukan transfer, silahkan konfirmasi lewat email di support@gotongroyong.fund atau hubungi kami di +6221 - 2506616</p>                                              
                    </div>
                <div class="row" style="margin-bottom:35px;margin-top:27px">
                    <div class="col-md-6"><input type="radio" name="bank" value="bni" style="margin-right:5px">{{ HTML::image('images/bni.jpg','bni',array('width'=>'60px','height'=>'100%'))}}</div>
                    <div class="col-md-6"><input type="radio" name="bank" value="bca" style="margin-right:5px">{{ HTML::image('images/bca.jpg','bca',array('width'=>'66px','height'=>'100%'))}}</div>                   
                </div>
                <div class="row">                    
                     <div class="col-md-6"><input type="radio" name="bank" value="mandiri" style="margin-right:5px">{{ HTML::image('images/mandiri.png','mandiri',array('width'=>'63px','height'=>'100%'))}}</div>
					<div class="col-md-6"><input type="radio" name="bank" value="bri" style="margin-right:5px">{{ HTML::image('images/bri.png','bri',array('width'=>'80px','height'=>'100%','style'=>'margin-right:13px'))}}</div>
                 </div>
				<div class="row" style="margin-top:27px">
						<div class="col-md-6"><input type="radio" name="bank" value="cimb" style="margin-right:5px">{{ HTML::image('images/cimb.png','cimb',array('width'=>'85px','height'=>'100%','style'=>'margin-right:9px'))}}</div>
                       <div class="col-md-6"><input type="radio" name="bank" value="permata" style="margin-right:5px">{{ HTML::image('images/Logo_Bank_Permata.png','permata',array('width'=>'90px','height'=>'100%','style'=>'margin-top:-12px'))}}</div>
				</div>
                
                <div class="col-md-12" style="margin-top:9px; text-align:center;"><button type="submit" class="btn btn-primary" id="btn-sub-fun">Bank Transfer</button></div>   
            </div>
        {{ Form::close()}}
		
        {{Form::open(array('url'=>'submitpledge/other'))}}
            <div class="col-md-3"><h3>Other Payment <small>(Debet Card , Cash, etc)</small></h3>
                <div>Pembayaran lainnya melalui kartu debet, cash, atau transaksi lainnya.</div>
                <div style="text-align:right;"><a href="#" style="color:blue;font-size:15px" id="trigger3">(How to)</a><hr/></div>
                    <div id="content3" style="display:none">
                        <h3>Other Payment</h3><hr />
                        <p>1. Other payment merupakan pembayaran langsung kepada staff kami</p>
                        <p>2. Pembayaran dapat menggunakan kartu debet / cash</p>
                        <p>3. Untuk pembayaran secara cash dapat langsung datang ke kantor kami di alamat :</p> 
                        <p>Gedung Sona Topas, Jl. Jenderal Sudirman Kavling 26</p>
                        <p>Jakarta Selatan 12920, Indonesia</p>

                    </div>
                <div style="padding-top:10px">
                    <div class="row">
                        <div class="col-md-6" style="text-align:center">{{ HTML::image('images/debit bca.jpg','visa',array('width'=>'57','height'=>'100%'))}}</div>
                        <div class="col-md-6" style="text-align:center">{{ HTML::image('images/DEBIT MANDIRI.jpg','visa',array('width'=>'75','height'=>'100%'))}}</div>
                       
                    </div>

                    <div class="row" style="margin-top:20px">
						 <div class="col-md-6" style="text-align:center;padding-left:35px">{{ HTML::image('images/mandiri ecash_logo.png','visa',array('width'=>'75','height'=>'100%'))}}</div>
                        <div class="col-md-6" style="text-align:center">{{ HTML::image('images/T-Cash.png','visa',array('width'=>'70','height'=>'100%'))}}</div>                    
                     </div>
					
					<div class="row" style="margin-top:20px">
						<div class="col-md-6" style="text-align:center;padding-left:30px">{{ HTML::image('images/Logo_Indosat_Dompetku.png','visa',array('width'=>'75','height'=>'100%'))}}</div>
						<div class="col-md-6" style="text-align:center">{{ HTML::image('images/20120826113520!Indomaret_Baru_1.png','visa',array('width'=>'75','height'=>'100%'))}}</div>
                </div>
                <div class="col-md-12" style="margin-top:11px; text-align:center;"><button type="submit" class="btn btn-primary" id="btn-sub-fun">Other Payment</button></div>
            </div>
        {{ Form::close()}}
        </div>
    </div>
</div>

{{ HTML::script('js/plugins/js-modal-master/jh-modal.js') }}
{{ HTML::style('js/plugins/js-modal-master/jh-modal.css') }}