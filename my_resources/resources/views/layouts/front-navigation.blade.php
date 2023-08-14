<style type="text/css">
    .bell-counter {
    position: absolute;
    left: 5px;
    bottom: 3px;
    right: 219px;
    background: #fff;
    border-radius: 50%;
    color: #000000;
    font-family: 'cera_problack';
    height: 30px;
    width: 30px;
    text-align: center;
    padding: 0;
    line-height: 30px;
    top: -20px;
}
</style>
<div class="inner-header wp-float">
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-4">
               <!--  <a href="{{route('home')}}"><img src="{{ asset('images/lep-logo.png') }}" class="img-fluid logo-left"></a> -->
            </div>
            <div class="col-sm-8 col-8">
                 
                <ul>
                    <li><b>Welcome to physiocare</b> ,</li>
                    <!-- <li><select class="text-input appearance-none focus:shadow-outline" name="select_currency" id="select_currency"> -->
                
            
                </select></li>
                   
                </ul>
                <div class="menu" >
                    <ul>
                        <li> <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        Home
                    </x-nav-link></li>
                   
                     <li><form style="margin: 0px;" method="POST" action="{{ route('logout') }}">
                            @csrf

                            

                            <x-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-nav-link>

                        </form></li>
                       <!--  <li><a href="#"><b>Shopping Card</b> &nbsp; 00</a></li> -->

                    </ul>

                </div>
            </div>


        </div>
    </div>
    </div>

