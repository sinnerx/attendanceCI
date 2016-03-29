<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<title>Simple Google Map with two Markers with InfoWindows using Marker Clusters</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Simple Google Map with two Markers with InfoWindows using Marker Clusters">
	<meta name="keywords" content="marker cluster, google maps API, google.maps.event.addListener">
	<meta name="author" content="">
  

	<style>
	body{
		padding:20px
	}
	#map-canvas {        
		height: 500px;
		width: 600px;        
	}
	pre {
		border:1px solid #D6E0F5;
		padding:5px;
		margin:5px;
		background:#EBF0FA;
	}	
	
	/* fix for unwanted scroll bar in InfoWindow */
	.scrollFix {
		line-height: 1.35;
		overflow: hidden;
		white-space: nowrap;
	}
	
	</style>
	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
	<!-- an additional library is required to make cluster markers-->
	<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer.js"></script>
	<script type="text/javascript"> 
		
		// global "map" variable
		var map = null;

		// marker cluster variable
		var markerclusterer = null;

		// define infowindow
		var infowindow = new google.maps.InfoWindow();

		// arrays to hold copies of the markers
		var gmarkers = []; 

		// -----------------------------------------------------------------------
		// A function to create the marker and set up the event window function 
		// -----------------------------------------------------------------------
		function createMarker(latlng, info) {
			
			var marker = new google.maps.Marker({
				position: latlng,
				map: map				
			});

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.setContent(info); 
				infowindow.open(map,marker);
				});

			// save the info (not used here)
			gmarkers.push(marker);
		}
		 
		// -----------------------------------------------------------------------
		// This function picks up the click and opens the corresponding info window
		// -----------------------------------------------------------------------
		function myclick(i) {
		  google.maps.event.trigger(gmarkers[i], "click");
		}

		// -----------------------------------------------------------------------
		// Initialize
		// -----------------------------------------------------------------------
		function initialize() {
		  
			// create the map
			var myOptions = {
				zoom: 8,
				center: new google.maps.LatLng(44.95,-93.215),
				mapTypeControl: true,
				navigationControl: true,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
			
			map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
			google.maps.event.addListener(map, 'click', function() {
				infowindow.close();
			});
			  
			// define array of locations
			var markers = [
				[1, "Minneapolis", 44.970,-93.261],
				[2, "St Paul", 44.939,-93.106]
			];
			
			// extract data and  create markers
			for (var i = 0; i < markers.length; i++) {
			  var point = new google.maps.LatLng( markers[i][2],  markers[i][3]);
			  var marker = createMarker( point, "<div class='scrollFix'>" + markers[i][0] + ". " 			+ markers[i][1] + 
												"<br/> " + "lat: " 		 + markers[i][2] + "</br> lng: " 	+  markers[i][3] + " </div>") ;
			}
				
			// create a Marker Clusterer that clusters markers
			markerCluster = new MarkerClusterer(map, gmarkers);
			
		}  // end of initialize

		// ------------------------------------------------------------------------------- //
		// initial load event
		// ------------------------------------------------------------------------------- //		
		google.maps.event.addDomListener(window, 'load', initialize);
		
	</script> 

</head> 
<body>
</script>
	<a href="../index.php">BACK</a><br/>
	<a href="../maps_01">same without Cluster markers...</a><br/>
			
	<h3>Simple Google Map with two Markers with InfoWindows using Marker Clusters</h3>
	<ul>
		<li>Click on cluster to see markers</li>		
		<li>Click on Marker to activate infoWindow</li>		
		<li>Click on X in right corner or other Marker to close first infoWindow</li>		
	</ul>

		<div id="map-canvas"></div>

 
            </div><!--/span-->            
          </div><!--/row-->
          
          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->
	
      <hr>

      

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->    
	<script src="../bootstrap/js/jquery.js"></script>
    
	
  </body>
</html>