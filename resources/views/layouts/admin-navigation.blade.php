<style type="text/css">
   .bell-counter {
    position: absolute;
    bottom: 8px;
    left: -21px;
    background: #fff;
    border-radius: 50%;
    color: #A6A4A1;
    font-family: 'cera_problack';
    height: 30px;
    width: 30px;
    text-align: center;
    padding: 0;
    line-height: 36px;
    top: -1px;
}
</style>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-1 sm:px-1 lg:px-1">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- <x-application-logo class="block h-10 w-auto fill-current text-gray-600" /> --}}
                        <!-- <img src="/img/lego-logo.png" class="nav-logo" /> -->
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
                 <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                        {{ __('Users') }}
                    </x-nav-link>
                </div>
                 <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('daily_therapist_visit.index')" :active="request()->routeIs('daily_therapist_visit.*')">
                        {{ __('Daily Therapist Visit') }}
                    </x-nav-link>
                </div>
               <?php /* <!--  <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('admin.orders.index')" :active="request()->routeIs('orders.*') || request()->routeIs('admin.orders.*')">
                        Order History
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.*') || request()->routeIs('categories.*')">
                        Catalogue Management
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                        {{ __('Users') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('assembley_guide.index')" :active="request()->routeIs('assembley_guide.*')">
                        Assembly Instruction
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                   
                     <x-nav-link :href="route('admin.reports.index')" :active="request()->routeIs('admin.reports.index')">
                        Stock Reporting
                    </x-nav-link>
                   
                </div>
                 <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                   
                     <x-nav-link :href="route('country_management.index')" :active="request()->routeIs('country_management.*')">
                        Country/Incoterm Management 
                    </x-nav-link>
                   
                </div> -->
              <!--   <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link >
                        Forecasting
                    </x-nav-link>
                </div> -->
                <!-- <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('currencyExchange.index')" :active="request()->routeIs('currencyExchange.*')">
                        Currency Exchange
                    </x-nav-link>
                </div> -->
               <!--  <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('email_templates.index')" :active="request()->routeIs('email_templates.*')">
                        Email Templates
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('territories.index')" :active="request()->routeIs('territories.*')">
                        Territories
                    </x-nav-link>
                </div> -->
              <!--   <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex sm:pt-6">
                    <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>Reports</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('previous_stock_report')" :active="request()->routeIs('previous_stock_report')">
                            Previous Stock Report
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.reports.inventory_movement')" :active="request()->routeIs('admin.reports.inventory_movement')">
                            {{ __('messages.item_movement_report') }} 
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.reports.stock_forecast')" :active="request()->routeIs('admin.reports.stock_forecast')">
                            {{ __('messages.stock_forecast_report') }} 
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.reports.country_sales_reports')" :active="request()->routeIs('admin.reports.country_sales_reports')">
                            {{ __('messages.country_sales_report') }} 
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.reports.order_bill_reports')" :active="request()->routeIs('admin.reports.order_bill_reports')">
                            {{ __('messages.order_bill_report') }} 
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.reports.stock_usage_reports')" :active="request()->routeIs('admin.reports.stock_usage_reports')">
                            {{ __('messages.stock_usage_reports') }} 
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.reports.sales_aging_reports')" :active="request()->routeIs('admin.reports.sales_aging_reports')">
                            {{ __('messages.sales_aging_reports') }} 
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.reports.contingency_reports')" :active="request()->routeIs('admin.reports.contingency_reports')">
                            {{ __('messages.contingency_reports') }} 
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.reports.item_sales_aging_reports')" :active="request()->routeIs('admin.reports.item_sales_aging_reports')">
                            {{ __('messages.item_sales_aging_reports') }} 
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                </div> --> */?>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
               
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Logout') }}
                            </x-dropdown-link>

                        </form>
                       
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="bell-inner-header flex">
                     <ul>
                   
                     </ul>
                 </div>
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-responsive-nav-link>
                </form>
                
            </div>
        </div>
    </div>
</nav>
