
@extends('admin.layouts.main')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">{{ __('messages.product_purchase') }}</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ __('messages.product_purchase') }}</li> --}}
                                <li class="breadcrumb-item active" aria-current="page">{{$title}} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="container">
                    <div class="box-header">
                        <a href="{{route('product_purchase.index')}}"  class="btn btn-secondary fa fa-arrow-left btn-sm float-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <form method="POST" action="{{ route('product_purchase.store') }}" class="form" novalidate data-parsley-validate="" enctype="multipart/form-data">
            <section class="content">
              <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">

                                @csrf
                                <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="product_name">Products Name<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline" name="product_name" id="product_name">
                                                  <option value="">Select Products</option>
                                                    @foreach($product_name as $row)
                                                        <option <?=(!empty($product_purchase[0]->product_id) && $product_purchase[0]->product_id == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->product_name }}</option>
                                                    @endforeach
                                            </select>

                                            @error('product_name')
                                                <p class="help invalid-feedback">{{ $errors->first('product_name') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <?php    if(!Auth::user()->hasRole('Vendor')) { ?>
                                <div class="col-md-4">
                                        <div class="form-group">

                                            <div class="form-label">
                                                <label for="vendor_id">Vendor Name<span style="color:#F00">*</span> </label>
                                            </div>

                                            <div class="input-block">
                                                <select class="form-control appearance-none focus:shadow-outline" name="vendor_id" id="vendor_id" required>
                                                    <option value="">Select Vendor</option>
                                                        @foreach ($vendor_name as $row)
                                                            <option <?=(!empty($product_purchase[0]->vendor_id) && $product_purchase[0]->vendor_id == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->first_name }} {{ $row->last_name }} </option>
                                                        @endforeach
                                                </select>
                                                @error('vendor_id')
                                                    <p class="help invalid-feedback">{{ $errors->first('vendor_id') }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="supplier_id">Suppliers Name<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline" name="supplier_id" id="supplier_id">
                                                  <option value="">Select Suppliers</option>
                                                    @foreach($supllier_name as $row)
                                                        <option <?=(!empty($product_purchase[0]->supplier_id) && $product_purchase[0]->supplier_id == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->first_name }} {{ $row->last_name }}</option>
                                                    @endforeach
                                            </select>

                                            @error('product_name')
                                                <p class="help invalid-feedback">{{ $errors->first('product_name') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="purchase_date">Purchase Date<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="purchase_date" id="purchase_date" class="form-control focus:shadow-outline @error('visit_date') is-invalid @enderror opening_datepicker1" value="{{ !empty($product_purchase[0]->purchase_date)?change_Date_Format($product_purchase[0]->purchase_date):date('d-m-Y')}}"   required="" />
                                            @error('visit_date')
                                                <p class="help invalid-feedback">{{ $errors->first('visit_date') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="variation_type">Variation Type</label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline" name="variation_type" id="variation_type"  >
                                                <option <?=(!empty($product_purchase[0]->variation_type) && $product_purchase[0]->variation_type == '0')?'selected="selected"':''?>  value="0">Select Variation Type</option>
                                                    <option <?=(!empty($product_purchase[0]->variation_type) && $product_purchase[0]->variation_type == '1')?'selected="selected"':''?>  value="1">Variation </option>
                                                    <option <?=(!empty($product_purchase[0]->variation_type) && $product_purchase[0]->variation_type == '2')?'selected="selected"':''?>  value="2">Not Variation </option>

                                            </select>

                                            @error('patient_id')
                                                <p class="help invalid-feedback">{{ $errors->first('patient_id') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4 color-chnarge-div" <?=(!empty($product_purchase[0]->variation_type) && $product_purchase[0]->variation_type == '1')?'style="display: block;"':'style="display: none;"'?>>
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="color">Color</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="color" name="color" id="color" class="form-control focus:shadow-outline @error('color') is-invalid @enderror" value="{{ !empty($product_purchase[0]->color)?$product_purchase[0]->color:''}}" autocomplete="off" />
                                            @error('color')
                                                <p class="help invalid-feedback">{{ $errors->first('color') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 size-chnarge-div" <?=(!empty($product_purchase[0]->variation_type) && $product_purchase[0]->variation_type == '1')?'style="display: block;"':'style="display: none;"'?>>
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="size">Size</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="size" id="size"  maxlength="7"  class="form-control focus:shadow-outline @error('size') is-invalid @enderror" value="{{ !empty($product_purchase[0]->size)?$product_purchase[0]->size:''}}" onkeypress="return restrictInput(this, event, digitsOnly);" autocomplete="off"/>
                                            @error('size')
                                                <p class="help invalid-feedback">{{ $errors->first('size') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="qty">Qty<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="qty" id="qty"  maxlength="7"  class="form-control focus:shadow-outline @error('qty') is-invalid @enderror final_amount" value="{{ !empty($product_purchase[0]->qty)?$product_purchase[0]->qty:''}}" onkeypress="return restrictInput(this, event, digitsOnly);" autocomplete="off" required/>
                                            @error('qty')
                                                <p class="help invalid-feedback">{{ $errors->first('qty') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="purchase_price">Purchase Price (₹)<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="purchase_price" id="purchase_price"  maxlength="7"  class="form-control focus:shadow-outline @error('purchase_price') is-invalid @enderror final_amount" value="{{ !empty($product_purchase[0]->purchase_price)?$product_purchase[0]->purchase_price:''}}" onkeypress="return restrictInput(this, event, digitsOnly);" autocomplete="off" required/>
                                            @error('purchase_price')
                                                <p class="help invalid-feedback">{{ $errors->first('purchase_price') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="purchase_total_price">Purchase Total Price (₹)<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="purchase_total_price" id="purchase_total_price"  maxlength="7"  class="form-control focus:shadow-outline @error('purchase_total_price') is-invalid @enderror final_amount" value="{{ !empty($product_purchase[0]->purchase_total_price)?$product_purchase[0]->purchase_total_price:''}}" onkeypress="return restrictInput(this, event, digitsOnly);" autocomplete="off" required/>
                                            @error('purchase_total_price')
                                                <p class="help invalid-feedback">{{ $errors->first('purchase_total_price') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                    <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="product_weight">Product Weight<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="product_weight" id="product_weight" class="form-control focus:shadow-outline @error('product_weight') is-invalid @enderror" value="{{ !empty($product_purchase[0]->product_weight)?$product_purchase[0]->product_weight:''}}" autocomplete="off" required/>
                                            @error('product_weight')
                                                <p class="help invalid-feedback">{{ $errors->first('product_weight') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                        <div class="form-group">

                                            <div class="form-label">
                                                <label for="product_desc">Product Description</label>
                                            </div>

                                            <div class="input-block">
                                                <textarea name="product_desc" id="product_desc" class="form-control focus:shadow-outline @error('product_desc') is-invalid @enderror" autocomplete="off" maxlength="255" >{{ !empty($product_purchase[0]->product_desc)?$product_purchase[0]->product_desc:''}}</textarea>
                                                @error('address')
                                                    <p class="help invalid-feedback">{{ $errors->first('product_desc') }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>





                        <div class="box-footer">
                            <div id="remove_images_id"></div>

                        <input type="hidden" name="id" value="{{ !empty($product_purchase[0]->id)?$product_purchase[0]->id:''}}">
                            <button type="submit" class="btn btn-primary" name="submit">
                              <i class="ti-save-alt"></i> Save
                            </button>
                            <a href="{{route('product_purchase.index')}}"  class="btn btn-secondary">Cancel</a>
                        </div>

                    </div>
                </div>
              </div>
            </section>
        </form>
    </div>
  </div>
<script type="text/javascript">


     $(document).on("change","#product_name",function(){
        var product_name = $('#product_name').val();

        // alert(product_name);

        $.ajax({
                type: "get",
                url:"/admin/product_purchase/product_purchase_amount?product_name="+product_name,
                dataType: "json",
                success: function(html) {
                    $("#purchase_price").val(html.amount);
                    $("#vendor_id").val(html.v_id);
                    $("#product_weight").val(html.product_weight);
                    $("#product_desc").val(html.product_desc);
                    $("#variation_type").val(html.variation_type);
                    $("#color").val(html.color);
                    $("#size").val(html.size);
                    var size =(html.variation_type);

                    $('#size').parsley().reset();
                    $('#color').parsley().reset();
                    if(size=="1"){
                    $('.size-chnarge-div').show();
                    $('.color-chnarge-div').show();
                }else{
                $('.color-chnarge-div').hide();
                $('.size-chnarge-div').hide();
            }
        }
        });
    })
    $(document).on('change', '#variation_type', function(event){
            // alert(1);
            var variation_type = $('#variation_type').val();
            // alert(variation_type);
            $('#size').parsley().reset();
            $('#color').parsley().reset();

            if(variation_type == 1)
            {
                $('.size-chnarge-div').show();

                // $('#size').attr('required',"");

                $('.color-chnarge-div').show();

                // $('#color').attr('required',"");

            }else{
                $('.size-chnarge-div input').val('');

                $('.size-chnarge-div').hide();

                $('.color-chnarge-div input').val('');

                $('.color-chnarge-div').hide();
            }

        });
    $(document).on("change",".final_amount",function(){
        // alert('hi');
        get_calculation();
    })
   function get_calculation(){
    // var discount = $('#discount').val();
        var product_id = $('#product_name').val();
        var quantity = $('#qty').val();
        var purchase_price = $('#purchase_price').val();

        // alert(product_id);
        $.ajax({
                type: "get",
                url:"/admin/product_purchase/final_amount?product_id="+product_id+"&quantity="+quantity+"&purchase_price="+purchase_price,


                success: function(html) {
                    $("#purchase_total_price").val(html);
                }
        });
   }

</script>
@endsection

