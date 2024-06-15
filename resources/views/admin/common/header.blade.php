<div class="dashboard-header">
    <div class="d-flex justify-content-between align-items-center p-3">
        <h2>DEMO</h2>
        <div>
            <a target="blank" href="/" class="text-decoration-none text-dark fs-4 me-3">View</a>
            <a class="fs-4 text-danger" href="{{ route('admin-logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"><i class="fa-solid fa-power-off"></i></a>
        </div>
    </div>
    <form id="frm-logout" action="{{ route('admin-logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>   