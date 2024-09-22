<style>
    .user-dropdown{
        margin-top: 10px !important;
    }

    .user-dropdown::before{
        position: relative;
        content: '';
        width: 0; 
        height: 0; 
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        
        border-bottom: 10px solid #f00;
    }

</style>

<header class="bg-light py-2 top_desktop_view">
    <div class="container">
        <div class="row">
           <div class="col-sm-3">
            <a href="/"><img height="80" width="150" src="{{ URL::asset('image/setting/site') .'/'. app('settings')['site_logo'] }}" alt="ez lifestyle"></a>
           </div>
           <div class="col-sm-6">
            <div class="h-100 d-flex align-items-center">
                <div class="input-group">
                    <input type="text" class="form-control p-2" placeholder="Search.." aria-label="Search.." name="q">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search"></i></button>
                </div>
            </div>
           </div>
           <div class="col-sm-3">
            <ul class="h-100 d-flex align-items-center p-2 mx-3 list-unstyled">
                <li class="mx-2">
                    <a href="#" class="text-decoration-none text-white">
                        <i class="fa-regular fa-heart p-2 rounded-circle" style="background-color: #ff006f;"></i>
                    </a>
                </li>
                <li class="mx-2">
                    <a href="#" class="text-decoration-none text-white">
                        <i class="fa-solid fa-cart-plus p-2 rounded-circle" style="background-color: #ff006f;"></i>
                    </a>
                </li>
                <li class="dropdown mx-2">
                    <a href="#" class="text-decoration-none text-white " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user p-2 rounded-circle" style="background-color: #ff006f;"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dropdown" style="z-index: 1500">
                        <li><a class="dropdown-item" href="#">Register</a></li>
                        <li><a class="dropdown-item" href="#">Login</a></li>
                    </ul>
                </li>
            </ul>
            
           </div>
        </div>
    </div>
</header>