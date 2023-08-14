$(".user_listing").select2();
var date = new Date();
$(".opening_datepicker1").datepicker({
         format: 'dd-mm-yyyy',
         //autoclose:true,
         //endDate: date,
});
$(".opening_datepicker_year").datepicker({
         format: 'yyyy',
         viewMode: "years", 
         minViewMode: "years",
         //autoclose:true,
         //endDate: date,
});
$(".opening_datepicker_month").datepicker({
         format: 'mm',
         viewMode: "months", 
         minViewMode: "months",
         //autoclose:true,
         //endDate: date,
});
 $(".future_datepicker").datepicker({
         format: 'dd-mm-yyyy',
         //autoclose:true,
         startDate: new Date(),
  });
  $(".past_datepicker").datepicker({
         format: 'dd-mm-yyyy',
         //autoclose:true,
         endDate: new Date(),
  });
  $(".current_datepicker").datepicker({
         format: 'yyyy-mm-dd',
         //autoclose:true,
         //endDate: new Date(),
  });
/*$(".opening_timepicker1").datetimepicker({
         format: 'H:i:s',
         //autoclose:true,
         //endDate: date,
});*/
// Restrict user input in a text field
    // create as many regular expressions here as you need:
    var digitsOnly = /[1234567890]/g;
    var integerOnly = /[0-9\.]/g;
    var alphaOnly = /[A-Za-z]/g;
    var usernameOnly = /[0-9A-Za-z\._-]/g;

    function restrictInput(myfield, e, restrictionType, checkdot){
        if (!e) var e = window.event
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);

        // if user pressed esc... remove focus from field...
        if (code==27) { this.blur(); return false; }

        // ignore if the user presses other keys
        // strange because code: 39 is the down key AND ' key...
        // and DEL also equals .
        if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
            if (character.match(restrictionType)) {
                if(checkdot == "checkdot"){
                    return !isNaN(myfield.value.toString() + character);
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
    }
     $(document).ready(function () {
  var start = new Date();
// set end date to max one year period:
var end = new Date(new Date().setYear(start.getFullYear()+1));

     $('#from_date').datepicker({
        format: 'mm/dd/yyyy',
        //startDate : start,
        //endDate   : start,
        autoclose: true,
    // update "to_date" defaults whenever "from_date" changes
    }).on('changeDate', function(){
        // set the "to_date" start to not be later than "from_date" ends:
        $('#to_date').datepicker('setStartDate', new Date($(this).val()));
        $('#to_date').val($(this).val());
        $('#to_date').focus();

         
    }); 

    $('#to_date').datepicker({
        format: 'mm/dd/yyyy',
        //startDate : start,
       // endDate   : start,
        autoclose: true,
    // update "from_date" defaults whenever "to_date" changes
    }).on('changeDate', function(){
        // set the "from_date" end to not be later than "to_date" starts:
        $('#from_date').datepicker('setEndDate', new Date($(this).val()));

       
    });
  });