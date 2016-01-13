/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var id = $("#valManagerID").val();
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname+"="+cvalue+"; "+expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    //alert($("#valManagerID").val());
    var punch = getCookie("punchStatus"+id);
    if(punch === ""){
        setCookie("punchStatus"+id, "in", 30);
        //alert("$( \"#punch-in\" ): " + $( "#punch-in" ));
        $( "#punch-in" ).show();
        $( "#punch-out" ).hide();
    } else if(punch === "in"){
        $( "#punch-in" ).show();
    $( "#punch-out" ).hide();
       // alert("IN $( \"#punch-in\" ): " + $( "#punch-in" ));
    } else if (punch === "out"){
        //alert("OUT $( \"#punch-in\" ): " + $( "#punch-in" ));
        $( "#punch-in" ).hide();
        $( "#punch-out" ).show();
    }
}
checkCookie();//run for the first time/cycle
//alert("getCookie(\"punchStatus\");"+getCookie("punchStatus"));

$( "#punch-in" ).click(function() {
    var punch__= getCookie("punchStatus"+id);
    if(punch__ === "in"){
    $( "#punch-in" ).hide();
    $( "#punch-out" ).show();
     setCookie("punchStatus"+id, "out", 30);
    }
    //alert("punch-in ID"+$("#valManagerID").val());
});

$( "#punch-out" ).click(function() {
    var punch_=getCookie("punchStatus"+id.val());
    if(punch_ === "out"){
    $( "#punch-out" ).hide();
    $( "#punch-in" ).show();
         setCookie("punchStatus"+id, "in", 30);

    }
    //alert("punch-out ID"+$("#valManagerID").val());
});


$('#outstation').click(function () {
//alert("click check?");
    if ($(this).is(':checked')) {
        $("#outstationStatus").modal({
            backdrop: 'static',
            keyboard: false ,
            close: function () {
                $('#outstation').prop('checked', false);

            }
        });
    } else {
        $("#outstationStatus").modal('close');
       
    }
});
 $('#canceloutstation').click(function () {
     $('#outstation').prop('checked', false);
    /*. if($('#outstationStatusTxt').html() != " Please state your reason..."){
       alert("not rite txt");

     }*/

 });
 $('#saveoutstation').click(function () {
     //alert("OSTxt: "+$('#outstationStatusTxt').val());
     console.log("$('#outstationStatusTxt').val(): " + $('#outstationStatusTxt').val().length);
    if($('#outstationStatusTxt').val().length !==0){
     outstationTxt.innerHTML = '<label><input id=\"outstation\" type=\"checkbox\"><i></i>' + $('#outstationStatusTxt').val() + '</label>' ;
 }else{
     alert("You need to fill-in your reason before save or cancel to exit.");
     return;
 }
 $('#outstation').prop('checked', true);
     $("#outstationStatus").modal('hide');
 });

 $('#canceloutstation_X').click(function () {
     $('#outstation').prop('checked', false);

 });

