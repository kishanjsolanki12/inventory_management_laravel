<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
            
            <!-- <h4>Payment Collected</h4> -->
                <div class="form-row">
                   <div class="input-block">
                    <input class="form-control" placeholder="Payout date" type="payment_collected" name="payment_collected" value="{{$invoice->final_amount}}">
                    <input type="hidden" name="invoice_id" value="{{$id}}">
                   </div>

                </div>
                <br>
                <div class="form-row">
                   <div class="input-block">
                    <select id="mop" name="mop" tabindex="6" class="form-control forum forum_name user_listing" style="margin-left: 10px;">
                        <option value="">Slect MOP</option>
                         <option value="1">Cash</option>
                         
                    </select>
                   </div>

                </div>
              <?php /*  <div class="form-row">

                   
                    <div class="input-block">
                       <!--  <a href="/orders/<?=$id?>/download_all" style="margin-top: 5px;" class="btn btn-secondary">Download All</a> --> 
                         <a href="javascript:void()" id="download_all"  style="margin-top: 5px;" class="btn btn-secondary">Download All</a>
           
                    </div>

                </div> */?>
                 <div class="form-row" style="margin: 11px 0px;">

                    <div class="label-block md:mb-0 ">
                       
                    </div>

                   <!--  <div class="input-block md:w-1/5">
                        <input type="hidden" name="order_id" value="{{ $id }}">
                        <input class="btn-submit focus:shadow-outline" type="submit" value="Save" id="button" />
                    </div> -->

                </div>


        </div>
    </div>
</div>