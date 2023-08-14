/*$(".opening_datepicker1").datepicker({
         format: 'dd-mm-yyyy',
         autoclose:true,
         startDate: new Date('<?=date("Y-m-d")?>'),
});*/
 $( "#treatment_date" ).datepicker({
        dateFormat: 'yy/mm/dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
        });
