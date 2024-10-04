<div class="h-100 d-flex align-items-center">
    <form class="w-100" action="{{ route('catalog.product-all') }}" method="get">
        <div class="input-group">
            <input type="text" class="form-control p-2" placeholder="Search.." aria-label="Search.." value="{{ $search ?? '' }}" name="search">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i
                    class="fa fa-search"></i>
            </button>
        </div>
    </form>
</div>
