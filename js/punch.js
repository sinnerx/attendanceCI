$('#outstation').click(function () {
    if (this.checked){
        $("#outstationStatus").modal({
            backdrop: 'static',
            keyboard: false ,
            close: function () {
                $('#outstation').prop('checked', false);
            }
        });
    } else {
       $('#outstationStatusTxt').val("");
       $('#outstationspan').text(" Add Notes");
    }
});
 $('#canceloutstation').click(function () {
     $('#outstation').prop('checked', false);
     $('#outstationStatusTxt').val("");
     $('#outstationspan').text(" Add Notes");
 });
 $('#saveoutstation').click(function () {
     console.log("$('#outstationStatusTxt').val(): " + $('#outstationStatusTxt').val().length);
    if($('#outstationStatusTxt').val().length !==0){
        $('#outstationspan').text(" "+$('#outstationStatusTxt').val());
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

