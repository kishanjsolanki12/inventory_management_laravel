
@extends('admin.layouts.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
 
  <div class="content-wrapper">
      <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">{{ __('messages.admin_user_management') }}</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ __('messages.admin_user_management') }}</li> --}}
                                <li class="breadcrumb-item active" aria-current="page">Edit User </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="container">
                    <div class="box-header">                        
                        <a href="{{route('admin_user.index')}}"  class="btn btn-secondary fa fa-arrow-left btn-sm float-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
       
         <form method="POST" id="user-form" action="{{ route('admin_user.update', $user->id) }}" class="form" novalidate data-parsley-validate="">
            <section class="content">
              <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-body">
                            
                                 @csrf
                                {{ method_field('PUT') }}
                                <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="name">Name<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="name" id="name" class="form-control focus:shadow-outline @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" autocomplete="off" required/>
                                            @error('name')
                                                <p class="help invalid-feedback">{{ $errors->first('name') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="role">Role<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline" name="role" id="role" required>
                                                  <option value="">Select Role</option>
                                                    @foreach($roles as $key => $role)
                                                        <option value="{{ $role }}" @if($user->roleName == $role) selected @endif>{{ $role }}</option>
                                                    @endforeach
                                            </select>

                                            @error('role')
                                                <p class="help invalid-feedback">{{ $errors->first('role') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div> -->
                                  <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="mobilenumber">Mobile Number<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="mobilenumber" id="mobilenumber" class="form-control focus:shadow-outline @error('mobilenumber') is-invalid @enderror" value="{{ !empty($user->mobilenumber)?$user->mobilenumber:''}}" maxlength="10" onkeypress="return restrictInput(this, event, digitsOnly);" autocomplete="off" required/>
                                            @error('mobilenumber')
                                                <p class="help invalid-feedback">{{ $errors->first('mobilenumber') }}</p>
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
                                            <input type="text" name="email" id="email" class="form-control focus:shadow-outline @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" autocomplete="off" required/>
                                            @error('email')
                                                <p class="help invalid-feedback">{{ $errors->first('email') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="password">Password</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="password" name="password" id="password" class="form-control focus:shadow-outline @error('password') is-invalid @enderror" autocomplete="off" />
                                            @error('password')
                                                <p class="help invalid-feedback">{{ $errors->first('password') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="password_confirmation">Confirm Password</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="password" name="password_confirmation" id="password_confirmation" data-parsley-equalto="#password" class="form-control focus:shadow-outline" autocomplete="off" />
                                            @error('password_confirmation')
                                                <p class="help invalid-feedback">{{ $errors->first('password_confirmation') }}</p>
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
                                            <textarea name="address" id="address" class="form-control focus:shadow-outline @error('address') is-invalid @enderror" value="{{ old('address') }}" maxlength="255" autocomplete="off">{{ old('address', $user->address) }}</textarea>
                                            @error('address')
                                                <p class="help invalid-feedback">{{ $errors->first('address') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="country">Country</label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline country" name="country" id="country" >
                                                <option value="">Select Coutry</option>
                                                @foreach($countries as $row)
                                                    <option <?=(!empty($user->country) && $user->country == $row->id)?'selected="selected"':''?>  value="{{ $row->id }}">{{ $row->country_name }}</option>
                                                @endforeach
                                            </select>

                                            @error('country')
                                                <p class="help invalid-feedback">{{ $errors->first('country') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="state">State</label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline statecls state" name="state" id="state" >
                                                <option value="">Select State</option>
                                                <?php if(isset($state) && !empty($state)){ ?>
                                                    @foreach($state as $row)
                                                        <option <?=(!empty($user->state) && $user->state == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->state_name }}</option>
                                                    @endforeach
                                                <?php } ?>
                                            </select>

                                            @error('state')
                                                <p class="help invalid-feedback">{{ $errors->first('state') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="city">City</label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline citycls city" name="city" id="city" >
                                                <option value="">Select City</option>
                                                <?php if(isset($city) && !empty($city)){ ?>
                                                    @foreach($city as $row)
                                                        <option <?=(!empty($user->city) && $user->city == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->city_name }}</option>
                                                    @endforeach
                                                <?php } ?>
                                            </select>

                                            @error('city')
                                                <p class="help invalid-feedback">{{ $errors->first('city') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>-->
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="area">Area</label>
                                        </div>

                                        <div class="input-block">

                                            <select class="form-control appearance-none focus:shadow-outline areacls" name="area" id="area" >
                                                <option value="">Select Area</option>
                                                <?php if(isset($area) && !empty($area)){ ?>
                                                    @foreach($area  as $row)
                                                        <option <?=(!empty($user->area) && $user->area == $row->id)?'selected="selected"':''?> value="{{ $row->id }}">{{ $row->area_name }}</option>
                                                    @endforeach
                                                <?php } ?>
                                            </select>

                                            @error('area')
                                                <p class="help invalid-feedback">{{ $errors->first('area') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div> 
                                
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="pincode">Pincode<span style="color:#F00">*</span></label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="pincode" id="pincode" class="form-control focus:shadow-outline @error('pincode') is-invalid @enderror" value="{{ old('pincode', $user->pincode) }}" autocomplete="off"  maxlength="10" required/>
                                            @error('pincode')
                                                <p class="help invalid-feedback">{{ $errors->first('pincode') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                               <!--  <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="google_location">Google Location</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="google_location" id="google_location" class="form-control focus:shadow-outline @error('google_location') is-invalid @enderror" value="{{ !empty($user->google_location)?$user->google_location:''}}" autocomplete="off"  maxlength="255" />
                                            @error('google_location')
                                                <p class="help invalid-feedback">{{ $errors->first('google_location') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="latitude">Latitude</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="latitude" id="latitude" class="form-control focus:shadow-outline @error('latitude') is-invalid @enderror" value="{{ !empty($user->latitude)?$user->latitude:''}}" autocomplete="off" maxlength="12" onkeypress="return restrictInput(this, event, integerOnly);"/>
                                            @error('latitude')
                                                <p class="help invalid-feedback">{{ $errors->first('latitude') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="longitude">Longitude</label>
                                        </div>

                                        <div class="input-block">
                                            <input type="text" name="longitude" id="longitude" class="form-control focus:shadow-outline @error('longitude') is-invalid @enderror" value="{{ !empty($user->longitude)?$user->longitude:''}}" autocomplete="off" maxlength="12" onkeypress="return restrictInput(this, event, integerOnly);"/>
                                            @error('longitude')
                                                <p class="help invalid-feedback">{{ $errors->first('longitude') }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                </div> -->
                              
                                </div><!-- row   -->
                           
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name="submit">
                              <i class="ti-save-alt"></i> Update
                            </button>
                            <a href="{{route('admin_user.index')}}"  class="btn btn-secondary">Cancel</a>
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
  
  