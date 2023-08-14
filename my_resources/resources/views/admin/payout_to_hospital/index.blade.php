
@extends('admin.layouts.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="d-flex align-items-center">
        <div class="me-auto">
          <h4 class="page-title">{{ __('messages.payout_to_hospital') }} </h4>
          <!-- <div class="d-inline-block align-items-center">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                <li class="breadcrumb-item" aria-current="page">User management</li>
                <li class="breadcrumb-item active" aria-current="page">Patients</li>
              </ol>
            </nav>
          </div> -->
        </div>
        
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
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
               
                    <div class="col-md-2">
                      <input type="text" name="serach" placeholder="Search" id="serach" class="form-control focus:shadow-outline">
                    </div>
                    <?php /*<div class="col-md-2">
                       <select id="payout_done" name="payout_done" tabindex="6" class="form-control forum forum_name user_listing" style="margin-left: 10px;">
                        <option value="">Select Patient</option>
                          @foreach($payout_to_hospital as $row)
                              <option value="{{ $row->payout_done }}">{{ $row->patient_name }}</option>
                          @endforeach
                        </select>
                    </div>
                    */?>
                    <!-- <div class="col-md-2">
                       <select id="payout_done" name="payout_done" tabindex="6" class="form-control forum forum_name user_listing" style="margin-left: 10px;">
                        <option value="">Select Payout Done</option>
                              <option value="1">Yes</option>
                              <option value="0">No</option>
                        </select>
                    </div> -->
                     <div class="col-md-2">
                      
                     <select id="month" name="month" tabindex="6" class="form-control forum forum_name user_listing" style="margin-left: 10px;">

                        <?php for($i=1;$i<=12;$i++){ ?> 
                         <option value="<?=$i?>"  <?=($i == $month)?'selected="selected"':''?> ><?=$i?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="col-md-2">
                     <select id="year" name="year" tabindex="6" class="form-control forum forum_name user_listing" style="margin-left: 10px;">
                      <!-- <option value="">Select Year</option> -->
                        <?php for($i=0;$i<=12;$i++){ 
                          $cyear = date('Y')-$i;?> 
                         <option value="<?=$cyear?>" <?=($cyear == $year)?'selected="selected"':''?> ><?=$cyear?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="col-md-1">
                     <select id="per_page" name="per_page" tabindex="6" class="form-control forum forum_name user_listing" style="margin-left: 10px;">
                         <option value="20">20</option>
                         <option value="50">50</option>
                         <option value="100">100</option>
                    </select>
                    </div>
                    <div class="col-md-1"><input type="button" name="Reset" class="btn btn-primary"  value="Reset Filter" id="reset_filter"></div>
                    
              </div>
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table id="complex_header" class="table table-striped table-bordered display" style="width:100%">
               <thead>
                        <tr class="text-left border-b-2 border-gray-300">
                            <th class="px-4 py-3 sorting" data-sorting_type="asc" data-column_name="name" style="cursor: pointer">Hospital Name</th>
                            
                            <th class="px-4 py-3 sorting">Mobile</th>
                            <!-- <th class="px-4 py-3">Total Invoice Amount</th> -->
                            <!-- <th class="px-4 py-3 sorting" data-sorting_type="asc" data-column_name="year_name" style="cursor: pointer">Payment Done</th>
                            <th class="px-4 py-3 sorting" data-sorting_type="asc" data-column_name="year_name" style="cursor: pointer">Payment Done Date</th> -->
                            
                            
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('admin.payout_to_hospital.ajax_data')
                    </tbody>
              </table>
               <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
  </div>
  </div>
   <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 60%; margin: 1.75rem auto;">
            <div class="modal-content">
                <div class="modal-header">
                   <h4 class="ptitle"> Payout</h4>  
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="partial"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div>
        </div>
    </div>
  <script>

$(document).ready(function(){

  function clear_icon()
 {
  $('#id_icon').html('');
  $('#post_title_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by, query, per_page,payout_done,month,year)
 {
  $.ajax({
   url:"/admin/payout_to_hospital/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query+"&per_page="+per_page+"&payout_done="+payout_done+"&month="+month+"&year="+year,
   success:function(data)
   {
    $('tbody').html('');
    $('tbody').html(data);
   }
  })
 }
$(document).on('click', '.payout_done', function(event){
         var datavalue= $(this).val();
         var id = $(this).data('assigned-id');
        if ($(this).is(":checked")) {
           var payout_done = 1;
        }
        else
        {
          var payout_done = 0;
        }
        var month = $('#month').val();
        var year = $('#year').val();
        $.ajax({
           url:"/admin/payout_to_hospital/payout_done?therapist_id="+id+"&payout_done="+payout_done+"&month="+month+"&year="+year,
             success:function(data)
             {
              if(data == 1)
              {
                toastr.success('Update successfully.');
                var query = $('#serach').val();
              var column_name = $('#hidden_column_name').val();
              var sort_type = $('#hidden_sort_type').val();
              var per_page = $('#per_page').val();
              var payout_done = $('#payout_done').val();
              var month = $('#month').val();
              var year = $('#year').val();
              var page = '';
              fetch_data(page, sort_type, column_name, query,per_page,payout_done,month,year);
              }
              else
              {
                toastr.success('Something went wrong');
              }
              
             }
            })

    });
 $(document).on('keyup', '#serach', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
  var payout_done = $('#payout_done').val();
  var month = $('#month').val();
  var year = $('#year').val();
  var page = '';
  fetch_data(page, sort_type, column_name, query,per_page,payout_done,month,year);
 });
 $(document).on('change', '#payout_done', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
   var payout_done = $('#payout_done').val();
  var month = $('#month').val();
  var year = $('#year').val();
  var page = '';
  fetch_data(page, sort_type, column_name, query,per_page,payout_done,month,year);
 });
 $(document).on('change', '#month', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
   var payout_done = $('#payout_done').val();
  var month = $('#month').val();
  var year = $('#year').val();
  var page = '';
  fetch_data(page, sort_type, column_name, query,per_page,payout_done,month,year);
 });
 $(document).on('change', '#year', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
   var payout_done = $('#payout_done').val();
  var month = $('#month').val();
  var year = $('#year').val();
  var page = '';
  fetch_data(page, sort_type, column_name, query,per_page,payout_done,month,year);
 });
 $(document).on('change', '#payout_done', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
   var payout_done = $('#payout_done').val();
  var month = $('#month').val();
  var year = $('#year').val();
  var page = '';
  fetch_data(page, sort_type, column_name, query,per_page,payout_done,month,year);
 });
 $(document).on('change', '#per_page', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = '1';
  var per_page = $('#per_page').val();
   var payout_done = $('#payout_done').val();
  var month = $('#month').val();
  var year = $('#year').val();
  fetch_data(page, sort_type, column_name, query,per_page,payout_done,month,year);
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
   var payout_done = $('#payout_done').val();
  var month = $('#month').val();
  var year = $('#year').val();
  fetch_data(page, reverse_order, column_name, query, per_page,payout_done,month,year);
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
   var payout_done = $('#payout_done').val();
  var month = $('#month').val();
  var year = $('#year').val();
  fetch_data(page, sort_type, column_name, query, per_page,payout_done,month,year);
 });
 $(document).on('click', '#reset_filter', function(){
    $('#serach').val('');
    $('#payout_done').val('');
    $('#month').val('<?=$month?>');
    $('#year').val('<?=$year?>');
    $('#from_date').val('');
    $('#to_date').val('');

    $('#hidden_column_name').val('patients.id');
    $('#hidden_sort_type').val('desc');
    $(".user_listing").select2();
    var query = $('#serach').val();
    var column_name = $('#hidden_column_name').val();
    var sort_type = $('#hidden_sort_type').val();
    var page = '1';
    var per_page = $('#per_page').val();
    var payout_done = $('#payout_done').val();
    var month = $('#month').val();
    var year = $('#year').val();
    fetch_data(page, sort_type, column_name, query,per_page,payout_done,month,year);
 });
});
</script>

  <!-- /.content-wrapper -->
@endsection
  