@extends('admin.layouts.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="d-flex align-items-center">
        <div class="me-auto">
          <h4 class="page-title">{{ __('messages.payout_to_hospital') }} - {{!empty($hospital->name)?ucfirst($hospital->name):''}}</h4>
         
        </div>
        
      </div>
      <div class="container">
          <div class="box-header">                        
              <a href="/admin/payout_to_hospital/index"  class="btn btn-secondary fa fa-arrow-left btn-sm float-right">Back</a>
          </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="row ptabs">
       <!--  <ul class="nav">
          
           <li class="nav-item <?=(request()->routeIs('payout_to_hospital.*'))?'active':''?>">
            <a class="nav-link" href="/admin/payout_to_hospital/index/<?=$patient_id?>">Patient Invoice</a>
          </li>
         
        </ul> -->
      </div>
      <div class="row">
      <div class="col-12">
        <div class="box">
          <div class="box-header">  
             
              @if (session('message'))

                    <div class="alert-banner bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 " role="alert">
                        <div class="flex">
                          
                            <div>
                               {{ session('message') }}
                            </div>
                        </div>
                    </div>


                @endif
              <div class="row">
               
                    <!-- <div class="col-md-2">
                      <input type="text" name="serach" placeholder="Search" id="serach" class="form-control focus:shadow-outline">
                    </div>
                     -->
                    
                    <div class="col-md-2">
                      
                     <select id="month" name="month" tabindex="6" class="form-control forum forum_name " style="margin-left: 10px;">

                         <?php for($i=1;$i<=12;$i++){ ?> 
                         <option value="<?=$i?>"  <?=($i == $month)?'selected="selected"':''?> ><?=$i?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="col-md-2">
                     <select id="year" name="year" tabindex="6" class="form-control forum forum_name " style="margin-left: 10px;">
                      <option value="">Select Year</option>
                        <?php for($i=0;$i<=12;$i++){ 
                          $year1 = date('Y')-$i;?> 
                         <option value="<?=$year1?>" <?=($year1 == date('Y'))?'selected="selected"':''?> ><?=$year1?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="col-md-1">
                     <select id="per_page" name="per_page" tabindex="6" class="form-control forum forum_name " style="margin-left: 10px;">
                         <option value="20">20</option>
                         <option value="50">50</option>
                         <option value="100">100</option>
                    </select>
                    </div>
                     <div class="col-md-1"><input type="button" name="Reset" class="btn btn-primary"  value="Reset Filter" id="reset_filter"></div>
                    <div class="col-md-2">
                      <a target="_blank" href="/admin/payout_to_hospital/{{$patient_id}}/{{$month}}/{{$year}}/print_invoice" class="btn btn-primary" style="margin-bottom: 2px;float: right;">Download Invoice</a>
                    </div>
              </div>
          </div>
          <div class="box-body">
             @include('admin.payout_to_hospital.invoice')
          </div>
        </div>
      </div>
      </div>
    </section>
  </div>
  </div>
  <script>

$(document).ready(function(){

function clear_icon()
 {
  $('#id_icon').html('');
  $('#post_title_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by, query, per_page,month,year,visit_type)
 {
   var patient_id = "<?=$patient_id?>";
  $.ajax({
   url:"/admin/payout_to_hospital/fetch_invoice_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query+"&per_page="+per_page+"&month="+month+"&year="+year+"&visit_type="+visit_type+"&patient_id="+patient_id,
   success:function(data)
   {
    $('.box-body').html('');
    $('.box-body').html(data);
   }
  })
 }

 $(document).on('keyup', '#serach', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
  var month = $('#month').val();
  var year = $('#year').val();
  var visit_type = $('#visit_type').val();
  var page = '';
  fetch_data(page, sort_type, column_name, query,per_page,month,year,visit_type);
 });
 $(document).on('change', '#month', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
   var month = $('#month').val();
  var year = $('#year').val();
  var visit_type = $('#visit_type').val();
  var page = '';
  fetch_data(page, sort_type, column_name, query,per_page,month,year,visit_type);
 });
 $(document).on('change', '#year', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
   var month = $('#month').val();
  var year = $('#year').val();
  var visit_type = $('#visit_type').val();
  var page = '';
  
  fetch_data(page, sort_type, column_name, query,per_page,month,year,visit_type);
 });
 $(document).on('change', '#visit_type', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
   var month = $('#month').val();
  var year = $('#year').val();
  var visit_type = $('#visit_type').val();
  var page = '';
  fetch_data(page, sort_type, column_name, query,per_page,month,year,visit_type);
 });
 $(document).on('change', '#per_page', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = '1';
  var per_page = $('#per_page').val();
   var month = $('#month').val();
  var year = $('#year').val();
  var visit_type = $('#visit_type').val();
  fetch_data(page, sort_type, column_name, query,per_page,month,year,visit_type);
 });
 $(document).on('click', '.sorting', function(){
  var column_name = $(this).data('column_name');
  var order_type = $(this).data('sorting_type');
  var per_page = $('#per_page').val();
  var reverse_order = '';
  if(order_type == 'asc')
  {
   $(this).data('sorting_type', 'desc');
   reverse_order = 'desc';
   clear_icon();
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-bottom"></span>');
  }
  if(order_type == 'desc')
  {
   $(this).data('sorting_type', 'asc');
   reverse_order = 'asc';
   clear_icon
   $('#'+column_name+'_icon').html('<span class="glyphicon glyphicon-triangle-top"></span>');
  }
  $('#hidden_column_name').val(column_name);
  $('#hidden_sort_type').val(reverse_order);
  var page = '';
  var query = $('#serach').val();
   var month = $('#month').val();
  var year = $('#year').val();
  var visit_type = $('#visit_type').val();
  fetch_data(page, reverse_order, column_name, query, per_page,month,year,visit_type);
 });

 $(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('#hidden_page').val(page);
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
  var query = $('#serach').val();

  $('li').removeClass('active');
        $(this).parent().addClass('active');
   var month = $('#month').val();
  var year = $('#year').val();
  var visit_type = $('#visit_type').val();
  fetch_data(page, sort_type, column_name, query, per_page,month,year,visit_type);
 });
 $(document).on('click', '#reset_filter', function(){
    $('#serach').val('');
    $('#month').val('');
    $('#year').val('');
    $('#visit_type').val('');
    $('#from_date').val('');
    $('#to_date').val('');

    $('#hidden_column_name').val('patients_treatments.id');
    $('#hidden_sort_type').val('desc');
    $(".user_listing").select2();
    var query = $('#serach').val();
    var column_name = $('#hidden_column_name').val();
    var sort_type = $('#hidden_sort_type').val();
    var page = '1';
    var per_page = $('#per_page').val();
    var month = $('#month').val();
    var year = $('#year').val();
    var visit_type = $('#visit_type').val();
    fetch_data(page, sort_type, column_name, query,per_page,month,year,visit_type);
 });

 $(document).on('click', '#save_deduction', function(){
  var deduction = $('#deduction').val();
  var amount = $('#amount').val();
  var month = "<?=$month?>";
  var year = "<?=$year?>";
  var therapist_id = "<?=$patient_id?>";
    $.ajax({
       url:"/admin/payout_to_hospital/save_deduction_amount?deduction="+deduction+"&amount="+amount+"&month="+month+"&year="+year+"&therapist_id="+therapist_id,
       success:function(data)
       {
        if(data == '1')
        {
          var final_amount = parseFloat(amount) - parseFloat(deduction);
          $('.final_amount').html(final_amount);
          toastr.success("Update successfully");
        }
         else{
          toastr.success("Something went wrong");
         } 
       }
      })
 });
});
</script>
  <!-- /.content-wrapper -->
@endsection
  