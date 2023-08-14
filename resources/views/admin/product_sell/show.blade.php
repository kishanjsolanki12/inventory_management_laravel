
@extends('admin.layouts.main')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <div class="container-full">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="d-flex align-items-center">
                <div class="me-auto">
                    <h4 class="page-title">{{ __('messages.user_management') }}</h4>
                    <div class="d-inline-block align-items-center">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                {{-- <li class="breadcrumb-item" aria-current="page">{{ __('messages.user_management') }}</li> --}}
                                <li class="breadcrumb-item active" aria-current="page">View User </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="container">
                    <div class="box-header">                        
                        <a href="{{route('users.index')}}"  class="btn btn-secondary fa fa-arrow-left btn-sm float-right">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
         <form method="POST" id="user-form" action="{{ route('users.update', $user) }}" class="form" novalidate data-parsley-validate="">
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
                                            <label for="name">Name</label>
                                        </div>

                                        <div class="input-block">
                                           {{ old('name', $user->name) }}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="email">Email</label>
                                        </div>

                                        <div class="input-block">
                                           {{ old('email', $user->email) }}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="role">Role</label>
                                        </div>

                                        <div class="input-block">

                                            @foreach($roles as $key => $role)
                                                       @if($user->roleName == $role) 
                                                       {{ $role }} 
                                                       @endif
                                                    @endforeach
                                        </div>

                                    </div>
                                </div>
                                 <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="address">Address</label>
                                        </div>

                                        <div class="input-block">
                                          {{ old('address', $user->address) }}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="city">City</label>
                                        </div>

                                        <div class="input-block">
                                            {{ old('city', $user->city) }}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="state">State</label>
                                        </div>

                                        <div class="input-block">
                                            {{ old('city', $user->state) }}
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <div class="form-label">
                                            <label for="pincode">Pincode</label>
                                        </div>

                                        <div class="input-block">
                                            {{ old('city', $user->pincode) }}
                                        </div>

                                    </div>
                                </div>
                               
                                </div><!-- row   -->
                           
                        </div>
                        <div class="box-footer">
                           
                        </div>  
                       
                    </div>
                </div>
              </div>
            </section>
        </form>
    </div>
  </div>

@endsection
  
  