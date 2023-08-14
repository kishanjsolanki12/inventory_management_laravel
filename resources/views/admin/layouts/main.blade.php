@include('admin.partials.header')
@include('admin.partials.main-sidebar')
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.19.0/jquery.validate.min.js"></script>

<div class="main">
	
  @yield('content')

</div>

@include('admin.partials.footer')