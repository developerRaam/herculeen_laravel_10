<style>
    .user-dropdown{
        margin-top: 15px !important;
    }

    /* .user-dropdown::before{
        position: absolute;
        content: ''; 
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        top: -10px;
        left: 116px;
        border-bottom: 10px solid #ddd;
    } */

</style>

<header class="bg-light py-2 top_desktop_view">
    <div class="container">
        <div class="row">
           <div class="col-sm-3">
            @if (app('settings') && isset(app('settings')['desktop_logo']))
                <a href="/"><img height="80" width="150" src="{{ URL::asset('image/setting/site') .'/'. app('settings')['desktop_logo'] }}" alt="ez lifestyle"></a>
            @endif
           </div>
           <div class="col-sm-6">
            
                @include('catalog.product.search')
            
           </div>
           <div class="col-sm-3">
            <ul class="h-100 d-flex align-items-center p-2 mx-3 list-unstyled">
                <li class="mx-2">
                    <a href="{{ route('catalog.wishlist') }}" class="text-decoration-none text-white position-relative">
                        <i class="fa-regular fa-heart p-3 rounded-circle" style="background-color: #000; transition: background-color 0.3s;"></i>
                        <span class="fs-6 fw-bold text-white position-absolute rounded-circle" style="top:-27px; left:50%; background:#ff5722; padding:0px 11px">{{ $getWishlist }}</span>
                    </a>
                </li>
                <li class="mx-2">
                    <a href="{{ route('catalog.cart') }}" class="text-decoration-none text-white position-relative">
                        <i class="fa-solid fa-cart-shopping p-3 rounded-circle" style="background-color: #000; transition: background-color 0.3s;"></i>
                        <span class="fs-6 fw-bold text-white position-absolute rounded-circle" style="top:-27px; left:50%; background:#ff5722; padding:0px 11px">{{$getCart}}</span>
                    </a>
                </li>
                <li class="dropdown mx-2">
                    <a href="#" class="text-decoration-none text-white " data-bs-toggle="dropdown" aria-expanded="false">
                        @if (session('isUser'))
                            <span class="rounded-circle px-3 py-2 fs-4 fw-bold text-uppercase" style="background-color: #000; transition: background-color 0.3s;">{{ substr(session('user_name'), 0, 1) }}</span>
                        @else
                            <i class="fa-solid fa-user p-3 rounded-circle" style="background-color: #000; transition: background-color 0.3s;"></i>
                        @endif

                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dropdown" style="z-index: 1500; line-height: 25px;">
                        @if (session('isUser'))
                            <li class="mb-0"><a class="dropdown-item" href="{{ route('catalog.front-user-account') }}"><i class="fa-solid fa-dashboard"></i> My Account</a></li>
                            <li class="mb-0"><a class="dropdown-item" href="{{ route('catalog.profile') }}"><i class="fa-solid fa-user"></i> Profile</a></li>
                            <li class="mb-0"><a class="dropdown-item" href="{{ route('catalog.order') }}"><i class="fa-brands fa-jedi-order"></i> My Order</a></li>
                            <li class="mb-0"><a class="dropdown-item" href="{{ route('catalog.cart') }}"><i class="fa-solid fa-cart-shopping"></i> Cart</a></li>
                            <li class="mb-0"><a class="dropdown-item" href="{{ route('catalog.wishlist') }}"><i class="fa-solid fa-heart"></i> Wishlist</a></li>
                            <li class="mb-0"><a class="dropdown-item" href="#"><i class="fa-solid fa-clock-rotate-left"></i> Order History</a></li>
                            <li class="mb-0"><a class="dropdown-item" href="{{ route('catalog.address') }}"><i class="fa-solid fa-address-book"></i> Address</a></li>
                            <li class="mb-0"><a class="dropdown-item" href="{{ route('catalog.viewChangePassword') }}"><i class="fa-solid fa-lock"></i> Change Password</a></li>
                            <li class="mb-0"><a class="dropdown-item" href="{{ route('catalog.logout') }}"><i class="fa-solid fa-power-off text-danger"></i> Logout</a></li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('catalog.user-login') }}">Login Account</a></li>
                        @endif
                    </ul>
                </li>
            </ul>
            
           </div>
        </div>
    </div>
</header>