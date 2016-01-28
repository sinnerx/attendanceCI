<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

	<!DOCTYPE html>
<html dir="ltr" lang="en-gb">
<head>
	<meta charset="utf-8" />
	<title>Camera</title>
	<style>
            .camcontent{
              display: inline-block;
              position: relative;
              overflow: hidden;
              height: 480px;
              width: 640px;
              margin: 0px auto;
              }
            
            .cambuttons button {
              border-radius: 15px;
              font-size: 18px;
              }
            .cambuttons button:hover {
              cursor: pointer;
              border-radius: 15px;
              background: #00dd00 ;    /* green */ 
              }
	</style>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
        // Put event listeners into place
        window.addEventListener("DOMContentLoaded", function() {
            // Grab elements, create settings, etc.
            var canvas = document.getElementById("canvas"),
                context = canvas.getContext("2d"),
                video = document.getElementById("video"),
                videoObj = { "video": true },
                image_format= "jpeg",
                jpeg_quality= 85,
                errBack = function(error) {
                    console.log("Video capture error: ", error.code); 
                };
                canvas.height = 480;
                canvas.width = 640;

            // Put video listeners into place
            if(navigator.getUserMedia) { // Standard
                navigator.getUserMedia(videoObj, function(stream) {
                    video.src = stream;
                    video.play();
                    $("#snap").show();
                }, errBack);
            } else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
                navigator.webkitGetUserMedia(videoObj, function(stream){
                    //deprecated
                    //video.src = window.webkitURL.createObjectURL(stream);
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                    $("#snap").show();
                }, errBack);
            } else if(navigator.mozGetUserMedia) { // moz-prefixed
                navigator.mozGetUserMedia(videoObj, function(stream){
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                    $("#snap").show();
                }, errBack);
            }
                  // video.play();       these 2 lines must be repeated above 3 times
                  // $("#snap").show();  rather than here once, to keep "capture" hidden
                  //                     until after the webcam has been activated.  

            // Get-Save Snapshot - image 
            document.getElementById("snap").addEventListener("click", function() {
                //context.drawImage(video, 0, 0, 640, 480);
                context.drawImage(video, 0, 0, 640, 480);
                // the fade only works on firefox?
                //$("#video").fadeOut("slow");
                //$("#canvas").fadeIn("slow");
                 $("#video").hide();
                $("#canvas").show();
                $("#snap").hide();
                $("#reset").show();
                $("#upload").show();
            });
            // reset - clear - to Capture New Photo
            document.getElementById("reset").addEventListener("click", function() {
                //$("#video").fadeIn("slow");
                //$("#canvas").fadeOut("slow");
                $("#video").show();
                $("#canvas").hide();
                $("#snap").show();
                $("#reset").hide();
                $("#upload").hide();
            });
            // Upload image to sever 
            document.getElementById("upload").addEventListener("click", function(){
                var dataUrl = canvas.toDataURL("image/jpeg", 0.85);
                $("#uploading").show();
                $.ajax({
                  type: "POST",
                  url: "snap/saveFace",
                  data: { 
                     imgBase64: dataUrl,
                     user: "Joe",       
                     userid: 25   
                  }
                }).done(function(msg) {
                  console.log("saved");
                  $("#uploading").hide();
                  $("#uploaded").show();
                });
            });
        }, false);

   </script>
</head>
<body>