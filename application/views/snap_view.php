<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<div class="camcontent">testest
            <video id="video" autoplay width="640" height="480"></video>
            <canvas id="canvas" width="640" height="480">
            </div>
        <div class="cambuttons">
            <button id="snap" style="display:none;">  Capture </button> 
            <button id="reset" style="display:none;">  Reset  </button>     
            <button id="upload" style="display:none;"> Upload </button> 
            <br> <span id=uploading style="display:none;"> Uploading has begun . . .  </span> 
            <span id=uploaded  style="display:none;"> Success, your photo has been uploaded! 
            <a href="javascript:history.go(-1)"> Return </a> </span> 
        </div>
        <!--<script src="<?php echo base_url();?>js/geolocation/geolocation.js"></script>-->
</body>
</html>