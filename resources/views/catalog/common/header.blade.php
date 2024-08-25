<nav class="p-1 sticky-top" style="background:#ff006f;margin-top: -1px;">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="/"><img height="80" width="150" src="{{ URL::asset('image/logo.png') }}" alt="ez lifestyle" class="d-block d-md-none"></a>
            </div>
            <div class="col-6 col-md-12">
                <div class="nav_desktop nav_mobile_view">
                    <ul class="list-unstyled text-white d-flex justify-content-center mb-0">
                        <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none text-white" href="/">Home</a></li>
                        <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none text-white" href="#">Our Story</a></li>
                        <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none text-white" href="#">Services</a></li>
                        <li class="px-3 fs-5 navbar_items active-link">
                            <a class="text-decoration-none text-white" href="#">Register</a>
                            <ul class="navbar_items-link">
                                <li><a href="#">Register As A Brand</a></li>
                                <li><a href="#">Register As A Retailer</a></li>
                                <li><a href="#">Register As A Wholesaler</a></li>
                            </ul>
                        </li>
                        <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none text-white" href="#">Blog</a></li>
                        <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none text-white" href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="nav_mobile text-end column-left-mobile">
                    <button class="btn text-white border" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="fa-solid fa-bars fs-3 mt-1"></i></button>
                </div>
            </div>
        </div>

        <!-- For mobile -->
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="true" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
          <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="list-unstyled mb-0">
                <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none d-block text-dark" href="/">Home</a></li>
                <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none d-block text-dark" href="#">Our Story</a></li>
                <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none d-block text-dark" href="#">Services</a></li>
                <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none d-block text-dark" href="#">Register As A Brand</a></li>
                <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none d-block text-dark" href="#">Register As A Retailer</a></li>
                <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none d-block text-dark" href="#">Register As A Wholesaler</a></li>
                <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none d-block text-dark" href="#">Blog</a></li>
                <li class="px-3 fs-5 navbar_items"><a class="text-decoration-none d-block text-dark" href="#">Contact Us</a></li>
            </ul>
          </div>
        </div>
    </div>
</nav>

<script>
    let navbar_items_link = document.querySelector('.navbar_items-link');
    let active_link = document.querySelector('.active-link');

    active_link.addEventListener('mouseover', () => {
        navbar_items_link.style.display = 'block';
    });

    // Add event listener to hide the dropdown only when the mouse leaves both active_link and navbar_items_link
    active_link.addEventListener('mouseleave', () => {
        setTimeout(() => {
            if (!isHover(active_link) && !isHover(navbar_items_link)) {
                navbar_items_link.style.display = 'none';
            }
        }, 200);
    });

    navbar_items_link.addEventListener('mouseleave', () => {
        setTimeout(() => {
            if (!isHover(active_link) && !isHover(navbar_items_link)) {
                navbar_items_link.style.display = 'none';
            }
        }, 200);
    });

    // Helper function to check if element is being hovered
    function isHover(element) {
        return element.matches(':hover');
    }

</script>