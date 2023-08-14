 <?php //echo '<pre>';print_r($users); ?>
 @if((!$product_reports->isEmpty()))
     @foreach ($product_reports as $row)
        <tr class="border-b border-gray-200">
            <td class="border px-8">{{$row->product_name}}</td>
            <td class="border px-8">{{$row->qty}}</td>
            <td class="border px-8">{{$row->purchase_price}}</td>
            <td class="border px-8">{{$row->purchase_total_price}}</td>
            <td class="border px-8">{{$row->sell_qty}}</td>
            <td class="border px-8">{{$row->sell_price}}</td>
            <td class="border px-8">{{$row->sell_total_amount}}</td>
            <td class="border px-8">
                    <?php
                        $remaining_qty = $row->qty - $row->sell_qty ;
                    ?>

            {{$remaining_qty}}</td>



            <td class="border px-8"><?php
                        $remiaing_amount = $remaining_qty * $row->sell_price;

            ?>{{$remiaing_amount}}</td>
            <td class="border px-8">   <?php
                        // $total_sell_amount = $row->qty * $row->sell_price;
                        if($row->sell_total_amount > $row->purchase_total_price)
                        {
                            // $profit_amount = $row->sell_total_amount - $remiaing_amount;
                            $profit_amount =  $row->sell_total_amount -  $row->purchase_total_price;
                        }else{
                            $profit_amount = 0;
                        }

                    ?>
                    {{$profit_amount}}</td>

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
    {!! $product_reports->links() !!}
    </div>
   </td>
</tr>