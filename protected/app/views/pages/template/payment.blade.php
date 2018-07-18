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
            <div class="col-md-4"><h3>Credit Card / Paypal</h3>
                <div style="text-align:left">Pembayaran aman menggunakan kartu yang berlogo VISA & Mastercard </div>
                <div style="text-align:right;"><a href="#" style="color:blue">(How to)</a><hr/></div>

                <div style="text-align:center;padding-top:10px;padding-right:15px">
                    {{ HTML::image('images/visa.jpg','visa',array('width'=>'110','height'=>'35px'))}}
                    {{ HTML::image('images/mastercard.jpg','visa',array('width'=>'110px','height'=>'50px'))}}
                </div>

                <div class="col-md-12" style="margin-top:82px; text-align:center;"><button type="submit" class="btn btn-primary" id="btn-sub-fun">Commit to Funding</button></div>
            </div>

        
            <div class="col-md-4"><h3>Bank Transfer</h3>
                <div>Pembayaran transfer antar bank yang lebih mudah.</div>
                <div style="text-align:right;"><a href="#" style="color:blue">(How to)</a><hr/></div>
                <div class="col-md6" style="margin-bottom:35px;margin-top:27px">
                    <input type="radio" name="bank" value="bni">{{ HTML::image('images/bni.jpg','bni',array('width'=>'90px','height'=>'25px','style'=>'margin-right:13px'))}}                   
                    <input type="radio" name="bank" value="bca">{{ HTML::image('images/bca.jpg','bca',array('width'=>'90px','height'=>'25px','style'=>'margin-right:9px'))}}
                    <input type="radio" name="bank" value="mandiri">{{ HTML::image('images/mandiri.png','mandiri',array('width'=>'100px','height'=>'30px'))}}
                </div>
                <div class="col-md6">                    
                   <input type="radio" name="bank" value="bri">{{ HTML::image('images/bri.png','bri',array('width'=>'90px','height'=>'25px','style'=>'margin-right:13px'))}}
                   <input type="radio" name="bank" value="cimb">{{ HTML::image('images/cimb.png','cimb',array('width'=>'90px','height'=>'25px','style'=>'margin-right:9px'))}}
                   <input type="radio" name="bank" value="permata">{{ HTML::image('images/permata.jpg','permata',array('width'=>'98px','height'=>'35px','style'=>'margin-top:-12px'))}}                   
                </div>
                
                <div class="col-md-12" style="margin-top:45px; text-align:center;"><button type="submit" class="btn btn-primary" id="btn-sub-fun">Commit to Funding</button></div>   
            </div>
        

            <div class="col-md-4"><h3>Other Payment <small>(Debet Card , Cash, etc)</small></h3>
                <div>Pembayaran lainnya melalui kartu debet, cash, atau transaksi lainnya.</div>
                <div style="text-align:right;"><a href="#" style="color:blue">(How to)</a><hr/></div>
                <div style="text-align:center;padding-top:10px">
                    {{ HTML::image('images/debit bca.jpg','visa',array('width'=>'100px','height'=>'55px','style'=>'margin-right:13px'))}}
                    {{ HTML::image('images/DEBIT MANDIRI.jpg','visa',array('width'=>'100px','height'=>'50px'))}}
                </div>
                <div class="col-md-12" style="margin-top:77px; text-align:center;"><button type="submit" class="btn btn-primary" id="btn-sub-fun">Commit to Funding</button></div>
            </div>
        </div>
    </div>
</div>