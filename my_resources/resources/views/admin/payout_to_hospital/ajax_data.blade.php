 <?php //echo '<pre>';print_r($payout_to_hospital); ?>
 @if((!$payout_to_hospital->isEmpty()))
     @foreach ($payout_to_hospital as $user)
     <?php if(!empty($user->hospital_name)){ ?>
        <tr class="border-b border-gray-200">
            <td class="border px-8">{{ !empty($user->hospital_name)?$user->hospital_name:'N/A' }}</td>
            <td class="border px-8">{{ !empty($user->mobilenumber)?$user->mobilenumber:'N/A' }}</td>
            
           <!--  <td class="border px-8">{{ !empty($user->final_amount)?$user->final_amount:'N/A' }}</td>
          
            <td class="border px-8"><input type="checkbox"  <?=!empty($user->payout_done)?'checked="checked"':''?> class="form-input payout_done " name="payout_done" data-assigned-id="{{$user->therapist_id}}" value="1"></td>
            <td class="border px-8">{{ !empty($user->payment_received_date)?change_Date_Format($user->payment_received_date):'N/A' }}</td>
 -->
            <td class="border px-8">
                        <!-- <a href="/admin/payout_to_hospital/{{ $user->id }}/show" class="bg-primary text-white p-2 ml-2  approval"><i class="fa fa-eye" title="View"></i></a> -->  
                       
                        <a href="/admin/payout_to_hospital/invoice/{{ $user->id }}/{{ $month }}/{{ $year }}" class="bg-primary text-white p-2 ml-2  approval">View</a>  
            </td>
        </tr>
    <?php } ?>
    @endforeach
@else
    <tr>
       <td colspan="9" align="center">
        No Data Found.
       </td>
    </tr>
@endif
<tr>
   <td colspan="9" align="center">
    <div class="pagination"> 
       
    </div>
   </td>
</tr>
    <script type="text/javascript">
$(function () {
    /*$('.payout_done').click(function () {
        var id = $(this).data('assigned-id');
        var route = "/admin/orders/"+id+"/download_documents";
        $('.modal-content').load(route);
    });*/
    /*$(document).on('click', '.payout_done', function(event){
         var datavalue= $(this).val();
        if ($(this).is(":checked")) {
            $('#exampleModalLong').modal('show');
             var id = $(this).data('assigned-id');
            var route = "/admin/payout_to_hospital/payout_done/"+id;
            $('#partial').load(route);

        }
      

    });*/

});
</script>