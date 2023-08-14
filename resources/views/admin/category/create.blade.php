
@extends('admin.layouts.main')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">{{ __('messages.category') }}</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ __('messages.category') }}</li> --}}
                                <li class="breadcrumb-item active" aria-current="page">{{$title}} </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="container">
                    <div class="box-header">
                        <a href="{{route('category.index')}}"  class="btn btn-secondary fa fa-arrow-left btn-sm float-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <form method="POST" action="{{ route('category.store') }}" class="form" novalidate data-parsley-validate="" enctype="multipart/form-data">
            <section class="content">
              <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">

                                @csrf
                                <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="sub_category_id">Parent Category</label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline" name="sub_category_id" id="sub_category_id">
                                                  <option value="">Select Category</option>

                                                  @foreach ($sub_category_name as $row)
                                                  <?php $dash=''; ?>
                                                        <option <?=(!empty($category[0]->parent_id) && $category[0]->parent_id == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->category_name }} </option>

                                                        @if (count($row->_nLevelCat) > 0)
                                                            @include('admin.category.subcategories', ['sub_category_name' => $row->_nLevelCat, 'parent' => $row->name])
                                                        @endif

                                                    @endforeach

                                            </select>

                                            @error('category_id')
                                                <p class="help invalid-feedback">{{ $errors->first('category_id') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <div class="form-label">
                                                <label for="category_name">Category Name<span style="color:#F00">*</span></label>
                                            </div>

                                            <div class="input-block">
                                                <input type="text" name="category_name" id="category_name" class="form-control focus:shadow-outline @error('category_name') is-invalid @enderror" value="{{ !empty($category[0]->category_name)?$category[0]->category_name:''}}" autocomplete="off" required/>
                                                @error('category_name')
                                                    <p class="help invalid-feedback">{{ $errors->first('category_name') }}</p>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <?php    if(!Auth::user()->hasRole('Vendor')) { ?>
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <div class="form-label">
                                                <label for="vendor_id">Vendor Name</label>
                                            </div>

                                            <div class="input-block">
                                                <select class="form-control appearance-none focus:shadow-outline" name="vendor_id" id="vendor_id">
                                                    <option value="">Select Vendor</option>
                                                        @foreach ($vendor_name as $row)
                                                            <option <?=(!empty($category[0]->vendor_id) && $category[0]->vendor_id == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->first_name }} {{ $row->last_name }} </option>
                                                        @endforeach
                                                </select>
                                                @error('vendor_id')
                                                    <p class="help invalid-feedback">{{ $errors->first('vendor_id') }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <div class="col-md-6">
                                   <div class="form-group">

                                       <div class="form-label">
                                           <label for="category_image">Category Image</label>
                                       </div>

                                       <div class="input-block">
                                            <input type="file"  multiple class="form-control" id="category_image"  name="category_image"   accept=".png" data-default-file="" value="">
                                           @error('category_image')
                                               <p class="help invalid-feedback">{{ $errors->first('category_image') }}</p>
                                           @enderror
                                         <?php if(!empty($category[0]->category_image)) { ?>
                                             <div class="col-md-3">

                                                <img data-dz-thumbnail="" alt="productlisting.png" src="{{ asset('/category_images/'.$category[0]->category_image) }}" style="height: 120px;">

                                             </div>

                                            <?php } ?>
                                            <div id="fileremoveid"></div>
                                       </div>


                                       </div>

                                   </div>
                               </div>


                        </div>
                        <div class="box-footer">
                        <input type="hidden" name="id" value="{{ !empty($category[0]->id)?$category[0]->id:''}}">
                            <button type="submit" class="btn btn-primary" name="submit">
                              <i class="ti-save-alt"></i> Save
                            </button>
                            <a href="{{route('category.index')}}"  class="btn btn-secondary">Cancel</a>
                        </div>

                    </div>
                </div>
              </div>
            </section>
        </form>
    </div>
  </div>
<script type="text/javascript">
     $(document).on("change",".country",function(){
        var country_id = $(this).val();
        var url = "/admin/users/get_state";

        $.ajax({
                type: "get",
                url: url,
                data: {
                        result_type: 'ajax',country_id:country_id
                },
                success: function(html) {
                    $(".statecls").html(html);
                }
        });
    });
    $(document).on("change",".state",function(){
        var state_id = $(this).val();
        var url = "/admin/users/get_city";

        $.ajax({
                type: "get",
                url: url,
                data: {
                        result_type: 'ajax',state_id:state_id
                },
                success: function(html) {
                    $(".citycls").html(html);
                }
        });
    });


    $(document).on("change",".city",function(){
        var city_id = $(this).val();
        var url = "/admin/users/get_area";

        $.ajax({
                type: "get",
                url: url,
                data: {
                        result_type: 'ajax',city_id:city_id
                },
                success: function(html) {
                    $(".areacls").html(html);
                }
        });
    })
     $(document).on("change","#razorpay_plan_id",function(){
        var razorpay_plan_id = $(this).val();
        var url = "/admin/premium_management/get_plan_amount";

        $.ajax({
                type: "get",
                url: url,
                data: {
                        result_type: 'ajax',razorpay_plan_id:razorpay_plan_id
                },
                success: function(html) {
                    $("#premium_amount").val(html);
                }
        });
    })
</script>
@endsection

