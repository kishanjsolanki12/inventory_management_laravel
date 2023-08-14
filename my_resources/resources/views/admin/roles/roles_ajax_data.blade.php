 <?php //echo '<pre>';print_r($users); ?>
 @if((!$roles->isEmpty()))
 <?php $i=1; ?>
     @foreach ($roles as $role)
        <tr class="bg-gray-100 border-b border-gray-200">
            <td class="border px-8 py-4">{{ $i }}</td>
            <td class="border px-8 py-4">{{ $role->name }}</td>
            <td class="border px-8 py-4">
                <form method="POST" action="{{ route('roles.destroy', $role->id) }}" class="">
                    @csrf
                    {{ method_field('DELETE') }}
                    <a href="/admin/roles/{{ $role->id }}/edit" class="action-btn">Edit</a>
                    <input class="action-btn" type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete?')"  />
                </form>
            </td>
        </tr>
        <?php $i++;?>
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
        {!! $roles->links() !!}
    </div>
   </td>
</tr>