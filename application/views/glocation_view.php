<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-gb">
<head>
	<meta charset="utf-8" />
	<title>Geolocation API getCurrentPosition example</title>
	<style>
		#map { width:100%; height:800px; }
	</style>
	<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <!----<script src="<?php echo base_url();?>js/geolocation/geolocation.js"></script>-->
</head>
<body>
	<p>Click on the marker for position information.</p>
        <div id="output"></div>
	<div id="map"></div>
        <script src="<?php echo base_url();?>js/geolocation/geolocation.js"></script>
        
</body>
</html>