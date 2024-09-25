<nav class="p-1 sticky-top" style="background:#ff006f;margin-top: -1px;">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href="/"><img height="80" width="150" src="{{ URL::asset('image/setting/site') .'/'. app('settings')['site_logo'] }}" alt="ez lifestyle" class="d-block d-md-none"></a>
            </div>
            <div class="col-6 col-md-12">
                <div class="nav_desktop nav_mobile_view">
                    <ul class="list-unstyled text-white d-flex justify-content-center mb-0">
                        @foreach ($service_categories as $category)
                            @if ($category->menu_top === 1)
                                <li class="px-3 fs-5 navbar_items active-link">
                                    <a class="text-decoration-none text-white" href="{{ route('catalog.product-all', [$category->id, $category->slug]) . '?sort=latest' }}">
                                        {{ $category->category_name }}
                                    </a>
                                    @if ($category->children->isNotEmpty())
                                        <ul class="navbar_items-link">
                                            @foreach ($category->children as $child)
                                                <li class="p-0 mb-0">
                                                    <a class="text-decoration-none d-block ps-2" href="{{ route('catalog.product-all', [$child->id, $child->slug]) }}">
                                                        {{ $child->category_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    {{-- @if ($category->children->isNotEmpty())
                                        <ul class="navbar_items-link">
                                            @include('partials.category_list', ['categories' => $category->children])
                                        </ul>
                                    @endif --}}
                                </li>
                            @endif
                        @endforeach
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
                @foreach ($service_categories as $category)
                    @if ($category->menu_top === 1)
                        <li class="px-3 fs-5 navbar_items active-link">
                            <a class="text-decoration-none text-dark" href="javascript:void(0)">
                                {{ $category->category_name }}
                            </a>
                            @if ($category->children->isNotEmpty())
                                <ul class="navbar_items-link">
                                    @foreach ($category->children as $child)
                                        <li class="p-0 mb-0">
                                            <a class="text-decoration-none d-block text-dark d-block ps-2" href="{{ route('catalog.product-all', [$child->id, $child->slug]) }}">
                                                {{ $child->category_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            {{-- @if ($category->children->isNotEmpty())
                                <ul class="navbar_items-link">
                                    @include('partials.category_list', ['categories' => $category->children])
                                </ul>
                            @endif --}}
                        </li>
                    @endif
                @endforeach
            </ul>
          </div>
        </div>
    </div>
</nav>

<script>
    // Select all active links
    let active_links = document.querySelectorAll('.navbar_items.active-link');

    // Loop through each active link and add event listeners
    active_links.forEach(active_link => {
        const navbar_items_link = active_link.querySelector('.navbar_items-link');

        active_link.addEventListener('mouseenter', () => {
            if (navbar_items_link) {
                navbar_items_link.style.display = 'block';
            }
        });

        active_link.addEventListener('mouseleave', () => {
            hideDropdown(navbar_items_link);
        });

        // Hide dropdown when mouse leaves the ul
        if (navbar_items_link) {
            navbar_items_link.addEventListener('mouseleave', () => {
                hideDropdown(navbar_items_link);
            });
        }
    });

    // Function to hide the dropdown
    function hideDropdown(dropdown) {
        setTimeout(() => {
            if (!isHover(dropdown) && !isHover(dropdown.parentElement)) {
                if (dropdown) {
                    dropdown.style.display = 'none';
                }
            }
        }, 50);
    }

    // Helper function to check if a single element is being hovered
    function isHover(element) {
        return element.matches(':hover');
    }
</script>