 <?php //echo '<pre>';print_r($users); ?>
 @if((!$product_purchase->isEmpty()))
     @foreach ($product_purchase as $row)
        <tr class="border-b border-gray-200">
            <td class="border px-8">{{ $row->product_name }}</td>
            <?php   if(!Auth::user()->hasRole('Vendor')) { ?>
            <td class="border px-8">{{ $row->vendor_name }}</td>
            <?php } ?>
            <td class="border px-8">{{ !empty($row->purchase_date)?date('d-m-Y',strtotime($row->purchase_date)):'' }}</td>
            <td class="border px-8">{{ $row->qty }}</td>
            <td class="border px-8">{{ $row->purchase_price }}</td>
            <td class="border px-8">{{ $row->purchase_total_price }}</td>
           

                  
          
            <td class="border px-8 text-center">
               
                <form method="POST" action="{{ route('product_purchase.destroy', $row->id) }}" class="">
                        @csrf
                        {{ method_field('DELETE') }}                                   
                        <!-- <a href="/admin/rows/{{ $row->id }}/show" class="bg-primary text-white p-2 ml-2  approval"><i class="fa fa-eye" title="View"></i></a>  
 -->
                      <a href="/admin/product_purchase/{{ $row->id }}/edit" class="bg-success mr-3 text-white p-2 ml-2 "><i class="fa fa-edit text-white" title="Edit"></i></a>
                        
                        <button class="bg-danger text-white p-1 px-2 ml-2 " onclick="return confirm('Are you sure you want to delete?');">
                        <i class="fa fa-trash text-white" title="Delete"> </i>    
                        </button>
                      
                </form>
            </td>
        </tr>
    @endforeach
@else
    <tr>
       <td colspan="10" align="center">
        No Data Found.
       </td>
    </tr>
@endif
<tr>
   <td colspan="10" align="center">
    <div class="pagination"> 
    {!! $product_purchase->links() !!}
    </div>
   </td>
</tr>