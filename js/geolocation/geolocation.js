
    /* global google, output */

if (navigator.geolocation) {
            var timeoutVal = 10 * 1000 * 1000;
            navigator.geolocation.getCurrentPosition(
                    displayPosition, 
                    displayError,
                    { enableHighAccuracy: true, timeout: timeoutVal, maximumAge: 0 }
            );
    }
    else {
            alert("Geolocation is not supported by this browser");
    }
    function displayPosition(position) {
            var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            var options = {
                    //zoom low - furthest | high - closest
                    zoom: 14,
                    center: pos,
                    /*mapTypeId: google.maps.MapTypeId.ROADMAP*/
                    //styler for map
                    styles: [{"stylers":[{"hue":"#ff1a00"},{"invert_lightness":true},{"saturation":-100},{"lightness":33},{"gamma":0.5}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#2D333C"}]}]
            };
            var map = new google.maps.Map(document.getElementById("map"), options);
            var marker = new google.maps.Marker({
                    position: pos,
                    map: map,
                    title: "User location"
            });
            var contentString = "<b>Date/Time:</b> " + parseTimestamp(position.timestamp) + "<br/><b>Geolocation:</b> " + position.coords.latitude.toFixed(7) + ", " + position.coords.longitude.toFixed(7) + "<br/><b>Accuracy:</b> " + position.coords.accuracy +" meters";
            var infowindow = new google.maps.InfoWindow({
                    content: contentString
            });
            google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map,marker);
            });
            //pass value to html/canvas
            var latitude  = position.coords.latitude;
            var longitude = position.coords.longitude;
            
            //check if lat/long & date/time element is ready
           /* if( $('#curLatLong').is(':empty') ) {
                alert("if empty: "+$.trim( $('#curLatLong').html() ).length);
            }else{
                
               alert("not empty: "+ $.trim( $('#curLatLong').html() ).length);
            }*/
            //output.innerHTML = '<p>Latitude is ' + latitude + '° <br>Longitude is ' + longitude + '°</p>' + "<br>Timestamp is "+ parseTimestamp(position.timestamp);
            
            curLatLong.innerHTML = '<p style="text-align: center"><a href="#" class="block h4 font-bold m-b text-black">Current Location:<br>' + latitude.toFixed(7)  + '°,' + longitude.toFixed(7)  + '°</a></p>';
            curDateTime.innerHTML = '<p style="text-align: center"><a href="#" class="block h4 font-bold m-b text-black">Current Date/Time:<br>' + parseTimestamp(position.timestamp) + '</a></p>';
           // $("#valLatLong").val(latitude.toFixed(7)  + '°, ' + longitude.toFixed(7) + '°');
            $("#valLatLong").val(latitude.toFixed(7)  + ', ' + longitude.toFixed(7));
            $("#valDateTime").val(parseTimestamp(position.timestamp));
            $("#valDate").val(parseTimestamp(position.timestamp).substr(0,10));
            $("#valTime").val(parseTimestamp(position.timestamp).substr(-6));
             
           // $("#valActivityStatus").val('IN');
            //console.log("parseTimestamp(timestamp): "+parseTimestamp(timestamp));
            
            
    }
    function displayError(error) {
            var errors = { 
                    1: 'Permission denied',
                    2: 'Position unavailable',
                    3: 'Request timeout'
            };
            alert("Error: " + errors[error.code]);
    }
    function parseTimestamp(timestamp) {
            var d = new Date(timestamp);
            //('0' + d.getHours()).slice(-2);
            var day = ('0' + d.getDate()).slice(-2);
            var month = ( '0' + (d.getMonth() + 1)).slice(-2);
            var year = d.getFullYear();
            //var hour = d.getHours();
            var hour = ('0' + d.getHours()).slice(-2);
            //var mins = d.getMinutes();
            //get minutes by 00 digits 
            var mins = ('0' + d.getMinutes()).slice(-2);
            /*var secs = d.getSeconds();*/
            //get seconds by 00 digits (2 digits e.g: 01,02,...09)
            var secs = ('0' + d.getSeconds()).slice(-2);
            //alert("secs :"+secs);
            var msec = d.getMilliseconds();
            return day + "-" + month + "-" + year + " " + hour + ":" + mins/* + ":" + secs + "," + msec*/;
    }

