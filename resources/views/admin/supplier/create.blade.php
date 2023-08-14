
@extends('admin.layouts.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">{{ __('messages.suppliers') }}</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ __('messages.suppliers') }}</li> --}}
                                <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="container">
                    <div class="box-header">                        
                        <a href="{{route('supplier.index')}}"  class="btn btn-secondary fa fa-arrow-left btn-sm float-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <form method="POST" action="{{ route('supplier.store') }}" class="form" novalidate data-parsley-validate="" enctype="multipart/form-data">
            <section class="content">
              <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            
                                @csrf
                                <div class="row">
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
                                                            <option <?=(!empty($suppliers[0]->vendor_id) && $suppliers[0]->vendor_id == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->first_name }} {{ $row->last_name }} </option>                                                  
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
                                            <label for="first_name">First Name<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="first_name" id="first_name" class="form-control focus:shadow-outline @error('first_name') is-invalid @enderror" value="{{ !empty($suppliers[0]->first_name)?$suppliers[0]->first_name:''}}" autocomplete="off" required/>
                                            @error('first_name')
                                                <p class="help invalid-feedback">{{ $errors->first('first_name') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="last_name">Last Name<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="last_name" id="last_name" class="form-control focus:shadow-outline @error('last_name') is-invalid @enderror" value="{{ !empty($suppliers[0]->last_name)?$suppliers[0]->last_name:''}}" autocomplete="off" required/>
                                            @error('last_name')
                                                <p class="help invalid-feedback">{{ $errors->first('last_name') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                               
                                  <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="mobile">Mobile Number<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="mobile" id="mobile" class="form-control focus:shadow-outline @error('mobile') is-invalid @enderror" value="{{ !empty($suppliers[0]->mobile)?$suppliers[0]->mobile:''}}" maxlength="10" onkeypress="return restrictInput(this, event, digitsOnly);" autocomplete="off" required/>
                                            @error('mobile')
                                                <p class="help invalid-feedback">{{ $errors->first('mobile') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="email">Email<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="email" name="email" id="email" class="form-control focus:shadow-outline @error('email') is-invalid @enderror" value="{{ !empty($suppliers[0]->email)?$suppliers[0]->email:''}}" autocomplete="off" required/>
                                            @error('email')
                                                <p class="help invalid-feedback">{{ $errors->first('email') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                               
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="address">Address</label>
                                        </div>

                                        <div class="input-block">
                                            <textarea name="address" id="address" class="form-control focus:shadow-outline @error('address') is-invalid @enderror" value="{{ old('address') }}" maxlength="255" autocomplete="off">{{ !empty($suppliers[0]->address)?$suppliers[0]->address:''}}</textarea>
                                            @error('address')
                                                <p class="help invalid-feedback">{{ $errors->first('address') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                              
                                </div>
                                <div class="col-md-4">
                                   <div class="form-group">

                                       <div class="form-label">
                                           <label for="image_name">Add Image</label>
                                       </div>

                                       <div class="input-block">
                                            <input type="file"  multiple class="form-control" id="image_name"  name="image_name"  accept=".jpg,.png,.jpeg">
                                           @error('image_name')
                                               <p class="help invalid-feedback">{{ $errors->first('image_name') }}</p>
                                           @enderror
                                           <?php if(!empty($suppliers[0]->image)) { ?>
                                             <div class="col-md-3">
                                              
                                                <img data-dz-thumbnail="" alt="productlisting.png" src="{{ asset('/images/'.$suppliers[0]->image) }}" style="height: 120px;">
                                               
                                             </div>
                                            
                                            <?php } ?>
                                            <div id="fileremoveid"></div> 
                                       </div>
                                        
                                           
                                       </div>

                                   </div>
                                <!-- row   -->
                           
                        </div>
                        <div class="box-footer">
                        <input type="hidden" name="id" value="{{ !empty($suppliers[0]->id)?$suppliers[0]->id:''}}">

                            <button type="submit" class="btn btn-primary" name="submit">
                              <i class="ti-save-alt"></i> Save
                            </button>
                            <a href="{{route('supplier.index')}}"  class="btn btn-secondary">Cancel</a>
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
</script>
@endsection
  
  