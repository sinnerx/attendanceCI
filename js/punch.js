/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$( "#punch-in" ).click(function() {
    $( "#punch-in" ).hide();
    $( "#punch-out" ).show();


$( "#punch-out" ).click(function() {
    $( "#punch-out" ).hide();
    $( "#punch-in" ).show();
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

