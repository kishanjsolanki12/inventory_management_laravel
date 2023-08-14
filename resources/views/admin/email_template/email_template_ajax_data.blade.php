 <?php //echo '<pre>';print_r($users); ?>
 @if((!$email_templates->isEmpty()))
     @foreach ($email_templates as $email_template)
        <tr class="bg-gray-100 border-b border-gray-200">
            <td class="border px-8 py-4">{{ $email_template->template_title }}</td>
            <td class="border px-8 py-4">{{ $email_template->template_subject }}</td>
            <td class="border px-8 py-4">{{ $email_template->template_unique_id }}</td>
            <td class="border px-8 py-4">
                <?=(!empty($email_template->template_status) && $email_template->template_status == '1')?'Active':''?>
                <?=($email_template->template_status == '0')?'Deactive':''?>
            </td>
            <td class="border px-8 py-4">
                <a href="/admin/email_templates/{{ $email_template->id }}/show" class="action-btn margintop">View</a>
                <a href="/admin/email_templates/{{ $email_template->id }}/edit" class="action-btn margintop">Edit</a>
                
            </td>
        </tr>
    @endforeach
@else
    <tr>
       <td colspan="3" align="center">
        No Data Found.
       </td>
    </tr>
@endif
<tr>
   <td colspan="3" align="center">
    <div class="pagination"> 
        {!! $email_templates->links() !!}
    </div>
   </td>
</tr>