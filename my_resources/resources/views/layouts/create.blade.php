<x-front-layout>
    <x-slot name="header">
        
        <link rel="stylesheet" href="{{URL::asset('/css/dropify.min.css')}}">

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Build an order
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="px-6 bg-white overflow-hidden shadow-sm sm:rounded-lg" style="padding-top: 13px;">

                <form method="POST" action="{{ route('order.store') }}" class="form" novalidate data-parsley-validate="" enctype="multipart/form-data">
                    
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Store Address</h4>
                            <div class="form-group">
                                <label for="select-multi-input">New store or update<span style="color:#F00">*</span></label>
                                <select id="select_store" name="select_store" tabindex="6" class="form-control forum forum_name user_listing" >
                                    <option value="1">New store</option>
                                    <option value="2" <?=(!empty($order->store_address_id))?'selected="selected"':''; ?>>Update of existing store</option>
                                </select>
                               
                                
                            </div>
                            <div class="form-group existing_store" style="<?=!empty($order->store_address_id)?'':'display: none'; ?>">
                                <label for="select-multi-input">Existing store<span style="color:#F00">*</span></label>
                                <select id="existing_store_id" name="existing_store_id" tabindex="6" class="form-control forum forum_name user_listing">
                                     <option value="">Select Store Name</option>
                                    @foreach ($storeAddresses as $store)
                                    <option value="{{ $store->id }}" <?=(!empty($order->store_address_id) && $order->store_address_id == $store->id)?'selected="selected"':''; ?>>{{ $store->store_name }}</option>
                                   
                                    @endforeach
                                    
                                </select>
                            </div>
                            <div class="store_address_div">
                            <div class="form-group">
                                <label for="select-multi-input">Type of store<span style="color:#F00">*</span></label>
                                <select id="type_of_store_id" name="type_of_store_id" tabindex="6" class="form-control forum forum_name user_listing" required="">
                                     <option value="">Select Store Type</option>
                                    @foreach ($storeType as $type)
                                    <option value="{{ $type->id }}" <?=(!empty($order->type_of_store_id) && $order->type_of_store_id == $type->id)?'selected="selected"':''; ?>>{{ $type->store_type }}</option>
                                   
                                    @endforeach
                                    
                                </select>
                            </div>
                             <div class="form-group">
                                <label for="select-multi-input">Store total area(sqm)<span style="color:#F00">*</span></label>
                                <input id="store_total_area" name="store_total_area" placeholder="" maxlength="100" class="form-control title" type="text" value="{{ !empty($order->store_total_area)?$order->store_total_area:'' }}" required="">
                               
                                
                                
                            </div>
                            <div class="form-group">
                                <label for="select-multi-input">LEGO net sales area (sqm)<span style="color:#F00">*</span></label>
                                <input id="lego_net_sales_area" name="lego_net_sales_area" placeholder="" class="form-control title" maxlength="100" type="text" required value="{{ !empty($order->lego_net_sales_area)?$order->lego_net_sales_area:'' }}" required="">
                               
                                
                                
                            </div>
                            <div class="form-group">
                                <label for="select-multi-input">Opening date (if new)<span style="color:#F00">*</span></label>
                                <input id="opening_date" name="opening_date" placeholder="" class="form-control title opening_datepicker" type="text" required value="{{ !empty($order->opening_date)?$order->opening_date:'' }}">
                               
                                
                                
                            </div>
                            <div class="form-group">
                            <label for="Address Line 1">Address<span style="color:#F00">*</span></label>
                            <textarea type="text" name="address_line_1" id="address_line_1" maxlength="255" class="form-control title" autocomplete="off" required>{{ !empty($order->address_line_1)?$order->address_line_1:'' }}</textarea>
                             </div>
                            <!--<div class="form-group">
                            <label for="Address Line 2">Address Line 2</label>
                            <input type="text" name="address_line_2" id="address_line_2" class="form-control title" autocomplete="off" required value="{{ !empty($order->product_name)?$order->product_name:'' }}"/>
                             </div>
                             <div class="form-group">
                            <label for="Address Line 3">Address Line 3</label>
                            <input type="text" name="address_line_3" id="address_line_3" class="form-control title" autocomplete="off" />
                             </div>
                            <div class="form-group">
                            <label for="Address Line 4">Address Line 4</label>
                            <input type="text" name="address_line_4" id="address_line_4" class="form-control title" autocomplete="off" />
                             </div> -->
                            <div class="form-group">
                            <label for="Town/City">Town/City<span style="color:#F00">*</span></label>
                            <input type="text" name="town_city" id="town_city" class="form-control title" maxlength="100" autocomplete="off" required value="{{ !empty($order->town_city)?$order->town_city:'' }}"/>
                             </div>
                            <div class="form-group">
                            <label for="Country">Country<span style="color:#F00">*</span></label>
                            <input type="text" name="country" maxlength="100" id="country" class="form-control title" autocomplete="off" required value="{{ !empty($order->country)?$order->country:'' }}"/>
                             </div>
                            <div class="form-group">
                            <label for="Postcode">Postcode<span style="color:#F00">*</span></label>
                            <input type="text" name="postcode" id="postcode" class="form-control title" maxlength="50" autocomplete="off" required value="{{ !empty($order->postcode)?$order->postcode:'' }}"/>
                            </div>
                            <!-- <div class="form-group">
                            <label for="Postcode">Email<span style="color:#F00">*</span></label>
                            <input type="text" name="email" id="email" class="form-control title" maxlength="100" autocomplete="off" required value="{{ !empty($order->email)?$order->email:'' }}"/>
                            </div> -->
                            <h4>Contact in-store</h4>
                            <div class="form-group">
                                <label for="select-multi-input">Name<span style="color:#F00">*</span></label>
                                <input id="contact_name" name="contact_name" placeholder="" maxlength="50" class="form-control title" type="text" required value="{{ !empty($order->contact_name)?$order->contact_name:'' }}">
                               
                                
                                
                            </div>
                            <div class="form-group">
                                <label for="select-multi-input">Phone<span style="color:#F00">*</span></label>
                                <!-- <input id="delivery_contact_phone" maxlength="12" minlength="10" maxlength="15"  name="country_dialling_code" placeholder="" class="form-control title" type="text" required value="{{ !empty($territories[0]->country_dialling_code)?$territories[0]->country_dialling_code:'' }}"> -->
                                <input id="country_dialling_code" maxlength="12" minlength="10" maxlength="15" onkeypress="return restrictInput(this, event, digitsOnly);" name="contact_phone" placeholder="" class="form-control title" type="text" required value="{{ !empty($order->contact_phone)?$order->contact_phone:'' }}">
                               
                                
                                
                            </div>
                            <div class="form-group">
                                <label for="select-multi-input">Email<span style="color:#F00">*</span></label>
                                <input id="contact_email" name="contact_email" placeholder="" maxlength="50" class="form-control title" type="email" required value="{{ !empty($order->contact_email)?$order->contact_email:'' }}">
                               
                                
                                
                            </div>
                            </div>
                             <h4>Delivery address</h4>
                           <!--  <div class="form-group">
                                <label for="Postcode">Name<span style="color:#F00">*</span></label>
                                <input type="text" name="delivery_name" id="delivery_name" class="form-control title" autocomplete="off" maxlength="100" value="{{ !empty($order->delivery_name)?$order->delivery_name:'' }}" required/>
                            </div> -->
                            <div class="form-group">
                            <label for="Store Name">Store Name<span style="color:#F00">*</span></label>
                            <input type="text" name="store_name" id="store_name" class="form-control title" maxlength="255" autocomplete="off" required value="{{ !empty($order->store_name)?$order->store_name:'' }}"/>
                             </div>
                            <div class="form-group">
                                <label for="Postcode">Address<span style="color:#F00">*</span></label>
                                <textarea type="text" name="delivery_address" id="delivery_address" class="form-control title" autocomplete="off" maxlength="255" required/>{{ !empty($order->delivery_address)?$order->delivery_address:'' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Postcode">Country<span style="color:#F00">*</span></label>
                                <input type="text" name="delivery_country" id="delivery_country" class="form-control title" autocomplete="off" maxlength="50" value="{{ !empty($order->delivery_country)?$order->delivery_country:'' }}" required/>
                            </div>
                            <div class="form-group">
                            <label for="Delivery_postalcode">Postcode <span style="color:#F00">*</span></label>
                            <input type="text" name="delivery_postalcode" id="delivery_postalcode" class="form-control title" autocomplete="off" required value="{{ !empty($order->delivery_postalcode)?$order->delivery_postalcode:'' }}"/>
                            </div>
                            <!-- <div class="form-group">
                                <label for="Postcode">Phone<span style="color:#F00">*</span></label>
                                <input type="text" name="delivery_phone" maxlength="12" minlength="10" onkeypress="return restrictInput(this, event, digitsOnly);" id="delivery_phone" class="form-control title" autocomplete="off" value="{{ !empty($order->delivery_phone)?$order->delivery_phone:'' }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="Postcode">Email</label>
                                <input type="email" name="delivery_email" id="delivery_email" maxlength="50" class="form-control title" value="{{ !empty($order->delivery_email)?$order->delivery_email:'' }}" autocomplete="off" />
                            </div> -->
                            <div class="form-group">
                                <label for="Postcode">Special instructions</label>
                                <input type="text" name="delivery_special_instructions" id="delivery_special_instructions" value="{{ !empty($order->delivery_special_instructions)?$order->delivery_special_instructions:'' }}" class="form-control title" maxlength="255" autocomplete="off"/>
                            </div>
                            
                            
                        </div>
                        <div class="col-lg-6">
                            <h4>Contact for delivery</h4>
                            <div class="form-group">
                                <label for="select-multi-input">Name<span style="color:#F00">*</span></label>
                                <input id="delivery_contact_name" name="delivery_contact_name" placeholder="" maxlength="50" class="form-control title" type="text" required value="{{ !empty($order->delivery_contact_name)?$order->delivery_contact_name:'' }}">
                               
                               </div>
                            <div class="form-group">
                                <label for="select-multi-input">Phone<span style="color:#F00">*</span></label>
                                <input id="delivery_contact_phone" maxlength="12" minlength="10" onkeypress="return restrictInput(this, event, digitsOnly);" name="delivery_contact_phone" placeholder="" class="form-control title" type="text" required value="{{ !empty($order->delivery_contact_phone)?$order->delivery_contact_phone:'' }}">
                               
                               </div>
                            <div class="form-group">
                                <label for="select-multi-input">Email<span style="color:#F00">*</span></label>
                                <input id="delivery_contact_email" name="delivery_contact_email" placeholder="" class="form-control title" type="email" maxlength="50" required value="{{ !empty($order->delivery_contact_email)?$order->delivery_contact_email:'' }}">
                               
                               </div>
                            <h4>LEGO Market contact</h4>
                            <div class="form-group">
                                <label for="select-multi-input">Name<span style="color:#F00">*</span></label>
                                <input id="lego_name" name="lego_name" placeholder="" maxlength="255" class="form-control title" type="text" required value="{{ !empty($order->lego_name)?$order->lego_name:'' }}">
                               
                                
                                
                            </div>
                            <div class="form-group">
                                <label for="select-multi-input">Phone<span style="color:#F00">*</span></label>
                                <input id="lego_phone" maxlength="12" minlength="10" onkeypress="return restrictInput(this, event, digitsOnly);" name="lego_phone" placeholder="" class="form-control title" type="text" required value="{{ !empty($order->lego_phone)?$order->lego_phone:'' }}">
                               
                                
                                
                            </div>
                            <div class="form-group">
                                <label for="select-multi-input">Email<span style="color:#F00">*</span></label>
                                <input id="lego_email" name="lego_email" placeholder="" maxlength="50" class="form-control title" type="email" required value="{{ !empty($order->lego_email)?$order->lego_email:'' }}">
                               
                                
                                
                            </div>
                            <h4>Billing address</h4>
                            <div class="form-group">
                                <label for="Postcode">Name<span style="color:#F00">*</span></label>
                                <input type="text" name="billing_name" id="billing_name" class="form-control title" autocomplete="off" maxlength="100" value="{{ !empty($order->billing_name)?$order->billing_name:'' }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="Postcode">Address<span style="color:#F00">*</span></label>
                                <textarea type="text" maxlength="255" name="billing_address" id="billing_address" class="form-control title" autocomplete="off" required/>{{ !empty($order->billing_address)?$order->billing_address:'' }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="Postcode">Country<span style="color:#F00">*</span></label>
                                <input type="text" name="billing_country" id="billing_country" class="form-control title" autocomplete="off" maxlength="20" value="{{ !empty($order->billing_country)?$order->billing_country:'' }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="Postcode">Phone<span style="color:#F00">*</span></label>
                                <input type="text" name="billing_phone" maxlength="12" minlength="10" onkeypress="return restrictInput(this, event, digitsOnly);" id="billing_phone" class="form-control title" autocomplete="off" value="{{ !empty($order->billing_phone)?$order->billing_phone:'' }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="Postcode">Email<span style="color:#F00">*</span></label>
                                <input type="email" name="billing_email" id="billing_email" maxlength="50" class="form-control title" autocomplete="off" value="{{ !empty($order->billing_email)?$order->billing_email:'' }}" required/>
                            </div>
                            <div class="form-group">
                                <label for="Postcode">Commercial references<span style="color:#F00">*</span></label>
                                <input type="text" name="billing_commercial_references" id="billing_commercial_references" class="form-control title" autocomplete="off" maxlength="100" value="{{ !empty($order->billing_commercial_references)?$order->billing_commercial_references:'' }}" required/>
                            </div>
                           
                             <div class="form-group">
                                <label for="Postcode">WBS number<span style="color:#F00">*</span></label>
                                <input type="text" name="billing_WBS_number" id="billing_WBS_number" class="form-control title" autocomplete="off" maxlength="50" value="{{ !empty($order->billing_WBS_number)?$order->billing_WBS_number:'' }}" required/>
                            </div>
                             <div class="form-group">
                                <label for="Postcode">Cost Centre<span style="color:#F00">*</span></label>
                                <input type="text" name="billing_cost_centre" id="billing_cost_centre" maxlength="50" class="form-control title" autocomplete="off" value="{{ !empty($order->billing_cost_centre)?$order->billing_cost_centre:'' }}" required/>
                            </div>
                             <div class="form-group">
                                <label for="Postcode">GL Account Number<span style="color:#F00">*</span></label>
                                <input type="text" name="billing_GL_account_number" id="billing_GL_account_number" class="form-control title" autocomplete="off" maxlength="100" value="{{ !empty($order->billing_GL_account_number)?$order->billing_GL_account_number:'' }}" required/>
                            </div>
                           
                               <div class="form-group">
                                <label for="select-multi-input">Drop Sketchup Bill of materials here</label>
                                 <input type="file" class="dropify" id="sketchup_file"  name="sketchup_file" accept=".csv,.xlsx" data-default-file="<?php if(!empty($order) && !empty($order->sketchup_file)) echo asset("/order_files/".$order->sketchup_file); else echo asset('/img/img-1.jpg'); ?>"/>
                               </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                    <input type="hidden" name="order_id" value="{{ !empty($order->id)?$order->id:'' }}">
                                    <button type="submit" class="btn btn-primary submitbtncls" id="save" title="" value="submitForm" name="save">Save & Continue</button>
                                    @if(empty($order->id))
                                    <button type="submit" class="btn btn-primary submitbtncls" id="save" title="" value="draft" name="save">Save for later</button>
                                    @endif
                                    <a href="/" class="btn btn-secondary waves-effect m-l-5 cancel_form" tabindex="-1">  
                                      Cancel Changes
                                      </a>
                                    
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        
         $(document).ready(function() {

          $(".opening_datepicker").datepicker({
                 format: 'yyyy-mm-dd',
                 //autoclose:true,
                 //startDate: new Date(),
        });
          $("#select_store").change(function(){ 
            if($(this).val() == 2)
            {
                $('.existing_store').show();
                $('select#existing_store_id').attr('required',"");
            } 
            else
            {
                $('.existing_store').hide();
                $('#existing_store_id').removeAttr('required');
                $('.store_address_div input').val('');
                $('.store_address_div select').val('');
                $('#address_line_1').val('');
            }
         });
          $("#existing_store_id").change(function(){ 
            $.ajax({
               url:"/order/fetch_store_data",
               data: { "_token": "{{ csrf_token() }}",'existing_store_id' : $(this).val() },
               type:"POST",
               dataType:"json",
               success:function(data)
               {
                    $('#store_name').val(data.store_name);
                    $('#type_of_store_id').val(data.type_of_store_id);
                    $('#store_total_area').val(data.store_total_area);
                    $('#lego_net_sales_area').val(data.lego_net_sales_area);
                    $('#opening_date').val(data.opening_date);
                    $('#email').val(data.email);
                    $('#address_line_1').val(data.address_line_1);
                    $('#town_city').val(data.town_city);
                    $('#country').val(data.country);
                    $('#postcode').val(data.postcode);
                    $('#contact_name').val(data.contact_name);
                    $('#contact_phone').val(data.contact_phone);
                    $('#contact_email').val(data.contact_email);


               }
              });
          });
     
    });
    </script>
    <script type="text/javascript">
    // Restrict user input in a text field
    // create as many regular expressions here as you need:
    var digitsOnly = /[1234567890]/g;
    var integerOnly = /[0-9\.]/g;
    var alphaOnly = /[A-Za-z]/g;
    var usernameOnly = /[0-9A-Za-z\._-]/g;

    function restrictInput(myfield, e, restrictionType, checkdot){
        if (!e) var e = window.event
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);

        // if user pressed esc... remove focus from field...
        if (code==27) { this.blur(); return false; }

        // ignore if the user presses other keys
        // strange because code: 39 is the down key AND ' key...
        // and DEL also equals .
        if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
            if (character.match(restrictionType)) {
                if(checkdot == "checkdot"){
                    return !isNaN(myfield.value.toString() + character);
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
    }
</script>
    <script type="text/javascript" src="{{URL::asset('/js/dropify.min.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/js/jquery.dropify.init.js')}}"></script>
</x-front-layout>
