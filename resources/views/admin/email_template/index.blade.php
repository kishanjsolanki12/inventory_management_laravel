<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Email Templates') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="grid grid-cols-3 gap-4 p-1 pt-6 pb-6 bg-white border-b border-gray-200">

                    <div class="col-span-2">
                        
                            <!-- <a href="/admin/email_templates/create" class="action-btn text-sm float-left">Add New Email Template</a>  -->
                            <!-- <a href="/admin/roles" class="action-btn text-sm float-left" style="margin-left: 10px;">Role Management</a> -->
                        
                    </div>

                    <div class="col-span-1">
                        
                            @if (session('message'))

                                <div class="alert-banner bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 shadow-md" role="alert">
                                    <div class="flex">
                                        <div class="py-1">
                                            <svg class="fill-current h-6 w-5 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
                                        </div>
                                        <div>
                                            <p class="py-1">{{ session('message') }}</p>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        
                    </div>

                </div>

                
                <div class="grid grid-cols-5 p-1 pt-6 pb-6 bg-white ">

                    <input type="text" name="serach" placeholder="Search" id="serach" class="text-input focus:shadow-outline">
                     <select id="per_page" name="per_page" tabindex="6" class="text-input forum forum_name user_listing" style="margin-left: 10px;">
                         <option value="20">20</option>
                         <option value="50">50</option>
                         <option value="100">100</option>
                    </select>
                </div>

                <table class="min-w-full rounded-t-lg m-5 w-5/6 mx-auto bg-gray-200 text-gray-800">
                    <thead>
                        <tr class="text-left border-b-2 border-gray-300">
                            <th class="px-4 py-3 sorting" data-sorting_type="asc" data-column_name="template_title" style="cursor: pointer">Template Title</th>
                            <th class="px-4 py-3 sorting" data-sorting_type="asc" data-column_name="template_subject" style="cursor: pointer">Template Subject</th>
                            <th class="px-4 py-3 sorting" data-sorting_type="asc" data-column_name="template_unique_id" style="cursor: pointer">Template Unique Id</th>
                             <th class="px-4 py-3 sorting" data-sorting_type="asc" data-column_name="template_status" style="cursor: pointer">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('admin.email_template.email_template_ajax_data')
                    </tbody>
                </table>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
               

            </div>
        </div>
    </div>
</x-admin-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

 function clear_icon()
 {
  $('#id_icon').html('');
  $('#post_title_icon').html('');
 }

 function fetch_data(page, sort_type, sort_by, query, per_page)
 {
  $.ajax({
   url:"/admin/email_templates/fetch_data?page="+page+"&sortby="+sort_by+"&sorttype="+sort_type+"&query="+query+"&per_page="+per_page,
   success:function(data)
   {
    $('tbody').html('');
    $('tbody').html(data);
   }
  })
 }

 $(document).on('keyup', '#serach', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var per_page = $('#per_page').val();
  var page = '';
  fetch_data(page, sort_type, column_name, query,per_page);
 });
 $(document).on('change', '#per_page', function(){
  var query = $('#serach').val();
  var column_name = $('#hidden_column_name').val();
  var sort_type = $('#hidden_sort_type').val();
  var page = '1';
  var per_page = $('#per_page').val();
  fetch_data(page, sort_type, column_name, query,per_page);
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
  fetch_data(page, reverse_order, column_name, query, per_page);
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
  fetch_data(page, sort_type, column_name, query, per_page);
 });

});
</script>