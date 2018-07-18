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
        <div class="col-md-12">
            <div class="span6" style="text-align: center; font-size: 16px; margin: 50px 0; line-height: 40px">
            @if($pm == 2)
            
                <p>
                    Thanks for committing to fund our project. We appreciate your support.            </p>
                <p>
                    Please transfer to the following bank account            </p>
                    <h3>Rek. BCA 206.3083.658 <br>atas nama<br> Koperasi Selaras</h3>
                <p>Please Confirm your money transfer to this email <a href="mailto: contact@gotongroyongfund.com">contact@gotongroyongfund.com</a></p>
                
            
            @else
                <p>
                    Thanks for committing to fund our project. We appreciate your support.            </p>
            
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