
@extends('admin.layouts.main')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">{{ __('messages.product_management') }}</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ __('messages.product_management') }}</li> --}}
                                <li class="breadcrumb-item active" aria-current="page">{{$title}} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="container">
                    <div class="box-header">
                        <a href="{{route('product_management.index')}}"  class="btn btn-secondary fa fa-arrow-left btn-sm float-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <form method="POST" action="{{ route('product_management.store') }}" class="form" novalidate data-parsley-validate="" enctype="multipart/form-data">
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
                                            <label for="product_name">Product Name<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="product_name" id="product_name" class="form-control focus:shadow-outline @error('product_name') is-invalid @enderror" value="{{ !empty($product_management[0]->product_name)?$product_management[0]->product_name:''}}" autocomplete="off" required/>
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
                                                <label for="vendor_id">Vendor Name</label>
                                            </div>

                                            <div class="input-block">
                                                <select class="form-control appearance-none focus:shadow-outline" name="vendor_id" id="vendor_id">
                                                    <option value="">Select Vendor</option>
                                                        @foreach ($vendor_name as $row)
                                                            <option <?=(!empty($product_management[0]->vendor_id) && $product_management[0]->vendor_id == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->first_name }} {{ $row->last_name }} </option>
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
                                            <label for="category_id">Category</label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline" name="category_id" id="category_id">
                                                  <option value="">Select Category</option>
                                                    @foreach($category_name as $row)
                                                        <option <?=(!empty($product_management[0]->category_id) && $product_management[0]->category_id == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->category_name }}</option>
                                                    @endforeach
                                            </select>

                                            @error('category_id')
                                                <p class="help invalid-feedback">{{ $errors->first('category_id') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="rack">Rack</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="rack" id="rack" class="form-control focus:shadow-outline @error('product_weight') is-invalid @enderror" value="{{ !empty($product_management[0]->rack)?$product_management[0]->rack:''}}" autocomplete="off" />
                                            @error('product_weight')
                                                <p class="help invalid-feedback">{{ $errors->first('product_weight') }}</p>
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

                                            <select class="form-control appearance-none focus:shadow-outline" name="variation_type" id="variation_type" >
                                                <option value="">Select Variation Type</option>

                                                    <option <?=(!empty($product_management[0]->variation_type) && $product_management[0]->variation_type == '1')?'selected="selected"':''?>  value="1">Variation </option>
                                                    <option <?=(!empty($product_management[0]->variation_type) && $product_management[0]->variation_type == '2')?'selected="selected"':''?>  value="2">Not Variation </option>

                                            </select>

                                            @error('patient_id')
                                                <p class="help invalid-feedback">{{ $errors->first('patient_id') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 color-chnarge-div" <?=(!empty($product_management[0]->variation_type) && $product_management[0]->variation_type == '1')?'style="display: block;"':'style="display: none;"'?>>
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="color">Color</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="color" name="color" id="color" class="form-control focus:shadow-outline @error('color') is-invalid @enderror" value="{{ !empty($product_management[0]->color)?$product_management[0]->color:''}}" autocomplete="off" />
                                            @error('color')
                                                <p class="help invalid-feedback">{{ $errors->first('color') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4 size-chnarge-div" <?=(!empty($product_management[0]->variation_type) && $product_management[0]->variation_type == '1')?'style="display: block;"':'style="display: none;"'?>>
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="size">Size</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="size" id="size"  maxlength="7"  class="form-control focus:shadow-outline @error('size') is-invalid @enderror" value="{{ !empty($product_management[0]->size)?$product_management[0]->size:''}}" onkeypress="return restrictInput(this, event, digitsOnly);" autocomplete="off"/>
                                            @error('size')
                                                <p class="help invalid-feedback">{{ $errors->first('size') }}</p>
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
                                            <input type="text" name="purchase_price" id="purchase_price"  maxlength="7"  class="form-control focus:shadow-outline @error('purchase_price') is-invalid @enderror" value="{{ !empty($product_management[0]->purchase_price)?$product_management[0]->purchase_price:''}}" onkeypress="return restrictInput(this, event, digitsOnly);" autocomplete="off" required/>
                                            @error('purchase_price')
                                                <p class="help invalid-feedback">{{ $errors->first('purchase_price') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="sell_price">Sell Price (₹)<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="sell_price" id="sell_price"  maxlength="7"  class="form-control focus:shadow-outline @error('sell_price') is-invalid @enderror" value="{{ !empty($product_management[0]->sell_price)?$product_management[0]->sell_price:''}}" onkeypress="return restrictInput(this, event, digitsOnly);" autocomplete="off" required/>
                                            @error('sell_price')
                                                <p class="help invalid-feedback">{{ $errors->first('sell_price') }}</p>
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
                                            <input type="text" name="product_weight" id="product_weight" class="form-control focus:shadow-outline @error('product_weight') is-invalid @enderror" value="{{ !empty($product_management[0]->product_weight)?$product_management[0]->product_weight:''}}" autocomplete="off" required/>
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
                                                <textarea name="product_desc" id="product_desc" class="form-control focus:shadow-outline @error('product_desc') is-invalid @enderror" autocomplete="off" maxlength="255" >{{ !empty($product_management[0]->product_desc)?$product_management[0]->product_desc:''}}</textarea>
                                                @error('address')
                                                    <p class="help invalid-feedback">{{ $errors->first('product_desc') }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                   <div class="form-group">

                                       <div class="form-label">
                                           <label for="product_image">Product Image</label>
                                       </div>

                                       <div class="input-block">
                                            <input type="file"  multiple class="form-control" id="product_image"  name="product_image"   accept=".jpg,.png,.jpeg" data-default-file="" value="">
                                           @error('product_image')
                                               <p class="help invalid-feedback">{{ $errors->first('product_image') }}</p>
                                           @enderror
                                         <?php if(!empty($product_management[0]->product_image)) { ?>
                                             <div class="col-md-3">

                                                <img data-dz-thumbnail="" alt="productlisting.png" src="{{ asset('/products_image/'.$product_management[0]->product_image) }}" style="height: 120px;">

                                             </div>

                                            <?php } ?>
                                            <div id="fileremoveid"></div>
                                       </div>


                                       </div>

                                   </div>

                                    <div class="col-md-4">
                                   <div class="form-group">

                                       <div class="form-label">
                                           <label for="product_image">Multiple Product Image</label>
                                       </div>

                                       <div class="input-block">
                                            <input type="file"  multiple class="form-control" id="multiple_image"  name="multiple_image[]"   accept=".jpg,.png,.jpeg" data-default-file="" value="">

                                            @error('product_image')
                                               <p class="help invalid-feedback">{{ $errors->first('product_image') }}</p>
                                           @enderror


                                            <div id="fileremoveid"></div>
                                       </div>


                                       </div>

                                   </div>
                               <!-- </div> -->

                            <?php    if(!empty($images)){ ?>
                             <div class="col-md-12">
                             <label for="product_image">Product Other Image</label>

                            <div class="row">

                            <?php
                                if(!empty($images)){
                                foreach($images as $imagess) { ?>

                                    <div class="col-md-1">
                                    <div class="dz-preview dz-image-preview">
                                    <img data-dz-thumbnail="" alt="productlisting.png" src="{{ asset('/products_image/') }}/{{$imagess->image_name}}" style="height: 120px;">


                                    <button type="button" class="btn btn-danger delete_image" data-id="<?= $imagess->id ?>" name="delete_image" >
                              <i class="ti-delete-alt"></i> Delete </button>







                                </div>
                                </div>

                                    <?php   } } ?>

                            </div>
                        </div>

                        <?php } ?>



                        <div class="box-footer">
                            <div id="remove_images_id"></div>

                        <input type="hidden" name="id" value="{{ !empty($product_management[0]->id)?$product_management[0]->id:''}}">
                            <button type="submit" class="btn btn-primary" name="submit">
                              <i class="ti-save-alt"></i> Save
                            </button>
                            <a href="{{route('product_management.index')}}"  class="btn btn-secondary">Cancel</a>
                        </div>

                    </div>
                </div>
              </div>
            </section>
        </form>
    </div>
  </div>
<script type="text/javascript">

     $(document).on("click",".delete_image",function(){
        // var id = $(this).data("id");
        //     alert(id);
        if(confirm('Are you sure you want to remove?'))
        {
            var id = $(this).data("id");
            // alert(id);

            var html = '<input type="hidden" value="'+id+'" name="remove_image_id[]">';
            // alert(html);
            $('#remove_images_id').append(html);
            $(this).parent('.dz-preview').remove();
        }

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

            }else {
                $('.size-chnarge-div input').val('');

                $('.size-chnarge-div').hide();

                $('.color-chnarge-div input').val('');

                $('.color-chnarge-div').hide();
            }

        });
</script>
@endsection

