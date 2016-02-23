<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    
$(document).ready(function() {
	$('form').submit(function() {
    
  		var checked_boxes = $(":checkbox:checked").length;

  		if(checked_boxes < 1){
      			alert("Please Select Files");
      			return false;
  		}else if($('#file_name').val() == ''){
      			alert("Please Enter Name");
      			return false;
  		}
  
	});
        
        $("#content img").each(function() {
        var imageCaption = $(this).attr("alt");
        if (imageCaption != '') {
        var imgWidth = $(this).width();
        var imgHeight = $(this).height();
        var position = $(this).position();
        //var positionTop = (position.top + imgHeight - 26)
        var positionTop = 0;
        $("<span class='img-caption'><em>" + imageCaption +
            "</em></span>").css({
            "position": "absolute",
            "top": positionTop + "px",
            "left": "0",
            "width": imgWidth + "px"
         }).insertAfter(this);
        }
    });
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
});
</script>
<style type="text/css">

li{
    list-style-type:none;
    margin-right:10px;
    margin-bottom:10px;
    float:left;
}
.container { position: relative; width: 160px; height: 130px; float: left; margin-left: 0px; }
.checkbox { position: absolute; bottom: 0px; right: 0px; z-index: 99;}
.submit { position: relative; }

#content {
	margin:10px 0 0 10px;
	position:relative;
	/*width:300px;*/
	
}
#content img:first-child {
	/*margin-bottom:10px;*/
}
#content span.img-caption {
    background:url(images/caption-bg.png);
    color:#FFF;
    display:block;
    font-size:11px;
    height:26px;
    line-height:26px;
    
}
#content span.img-caption em {
    font-style:normal;
    display:block;
	padding-left:5px;
	font-size:11px;
	font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
        overflow: hidden;
        
}

</style>
</head>
<form name="dlform" action="download/download_zip" method="post">

<!-- <select>
  <option value="">All Zone</option>
  <option value="">West Malaysia Cluster</option>
  <option value="">East Malaysia Cluster</option>
</select> 
<select><option value="volvo">All Cluster</option></select>
<select><option value="volvo">All Site</option></select>
<select><option value="volvo">All Manager</option></select>
<input type="date" name="" id="" placeholder=" Pick Date">


<input type="text" name="zone" id="" placeholder=" All Site">
<input type="text" name="zone" id="" placeholder=" All Manager">-->
<label><input type="checkbox" id="checkAll"/> Check all</label>

<input type="text" name="file_name" id="file_name" placeholder=" Please name your file">
    <input type="submit" class="submit" value="Download" id="download">
    <br>
<?php
foreach($files as $key=>$file_name){
    //display table-like
   // echo "<tr><td><input type='checkbox' name='files[]' value='".$file_name."' /></td><td>".$file_name."</td><td><img src=\"images/attendance/$file_name.\" alt=\"Smiley face\" height=\"42\" width=\"42\"></td></tr>";
     //echo "<li><input type='checkbox' name='files[]' value='".$file_name."' />".$file_name."<a href='images/attendance/".$file_name."'><img src=\"images/attendance/$file_name.\"alt='' height=\"42\" width=\"42\" /></a></li>";
     echo "<div id='content' class='container'><li><input type='checkbox' class='checkbox' name='files[]' value='".$file_name."' /><a href='images/attendance/".$file_name."'><img src='images/attendance/".$file_name."' alt='".$file_name."' height='130' width='160' /></a></li></div>"; 
}
?>

    
</form>

