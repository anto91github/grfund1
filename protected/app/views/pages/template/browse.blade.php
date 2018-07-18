
<div class='container'>
    <div class='row' style='background-color:#E8E8E8;'>
        <div class='col-md-12'><h4>MEDIA LIBRARY</h4></div>
    </div>
    <div class="row">
        <div class='col-md-8' style='border:1px solid #E8E8E8; max-height: 560px; min-height: 560px; overflow: auto;'>
            @foreach($images as $image)
            <div id="div-{{$image->id}}" class='col-md-4 browse-thumbnail-container' style="margin:10px; padding:4px; ">
                <img src='{{ $image->url }}' alt="{{ $image->name }}" width='100%' class="thumbnail-list" data-id="{{ $image->id }}" data-width='{{ $image->width }}' data-height='{{ $image->height }}'  />
            </div>
            @endforeach
        </div>
        <div class='col-md-4' style='background-color:#F0F0F0; max-height: 560px; min-height: 560px; overflow:auto;'>
            <div>
                <img src="images/default_project.jpg" width='100%' alt='default' id='preview'>
            </div>
            <div class="form-group form-horizontal">
                <label class="control-label">Url</label>
                <input type='text' class="form-control" readonly='readonly' id="imgUrl" value="" >
                <input type='text' class="form-control hidden" readonly='readonly' id="imgId" value="" >
            </div>
            <div class="form-group form-horizontal">
                <label class="control-label">Image Name</label>
                <input type='text' class="form-control" readonly='readonly' id="imgName" value="" >
            </div>
            <div class="form-group form-horizontal">
                <label class="control-label">Width</label>
                <input type='text' class="form-control" readonly='readonly' id="imgWidth" value="" >
            </div>
            <div class="form-group form-horizontal">
                <label class="control-label">Height</label>
                <input type='text' class="form-control" readonly='readonly' id="imgHeight" value="" >
            </div>
            <div class="form-group form-horizontal">
                <button id="btnDelete" type='button' class="btn btn-warning">Delete</button>
            </div>
        </div>
    </div>
    <div class='row'>
        <div class='col-md-12' align='right'><button type="buttom" class="btn btn-primary" id='submit'>Use This Image</button> <button type="buttom" class="btn btn-default" id="btnCancel">Cancel</button></div>
    </div>
</div>
{{ HTML::style('css/browse.css')}}
<script type="text/javascript">
    $(document).ready(function(){
        $(".thumbnail-list").click(function(){
           var url = $(this).attr('src'); 
           var alt = $(this).attr('alt'); 
           var width = $(this).data("width");
           var height = $(this).data("height");
           var id = $(this).data("id");
           
           $("#preview").attr("src",url);
           $("#imgId").val(id);
           $("#imgUrl").val(url);
           $("#imgName").val(alt);
           $("#imgWidth").val(width);
           $("#imgHeight").val(height);
        });
        $("#btnCancel").click(function(){
           window.close();
        });
        $("#btnDelete").click(function(){
            if($("#imgId").val() == ''){
                alert('Pilih image yang ingin dihapus.');
                return;
            }else{
                $.ajax({
                    type: "POST",
                    url: "./protected/app/webservice/deleteImage.php",
                    data: {"id":$("#imgId").val()},
                    dataType: "json",
                    error: function(jqXHR, textStatus, errorThrown){
                        alert(errorThrown);
                        //success1.hide();                    
                        //error1.show();                            
                    },
                    success: function(data){
                        if (data === 1) {
                            alert("Delete Success");
                            $("#div-"+$("#imgId").val()).addClass("hidden");
                            //window.location.replace(location.protocol + "//" + location.host + config.contextPath + "/templates/backend/userlist.jsp");
                            $("#preview").attr("src","");
                            $("#imgId").val("");
                            $("#imgUrl").val("");
                            $("#imgName").val("");
                            $("#imgWidth").val("");
                            $("#imgHeight").val("");
                        } else {
                            alert("Error : " + ' ' + data);
                        }
                    }
                });
            }
        });
        $("#submit").click(function(){
            var url = $("#imgUrl").val(); 
            if(url == "") {
                alert("Please Choose Image");
            }else{
                //console.log(window.parent.opener);
                window.parent.opener.CKEDITOR.tools.callFunction(1, url);
                window.close();
            }
        });
    });
</script>