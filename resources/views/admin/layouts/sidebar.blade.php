<aside id="sidebar" class="shadow-lg">
    <div class="d-flex ">
        <button class="toggle-btn" type="button">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
    <ul class="sidebar-nav sidebaar">
        <li class="sidebar-item">
            <li class="sidebar-item {{setActive(['admin.dashboard'])}}">
                <a href="{{route('admin.dashboard')}}" class="sidebar-link">
                    <i class="fa-solid fa-d "></i>
                    <span>dashboard</span>
                </a>
            </li>
            <li class="sidebar-item {{setActive(['admin.order'])}}">
                <a href="{{route('admin.order')}}" class="sidebar-link ">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Orders</span>
                </a>
            </li>
        </li>
        <li class="sidebar-item {{setActive(['admin.products.index'])}}">
            <a href="{{route('admin.products.index')}}" class="sidebar-link ">
                <i class="fa-solid fa-shirt"></i>
                <span>Products</span>
            </a>
        </li>

        </li>
        <li class="sidebar-item {{setActive(['admin.Loading-photo.index'])}}">
            <a href="{{route('admin.Loading-photo.index')}}" class="sidebar-link ">
                <i class="fa-solid fa-image"></i>
                <span>Loading Photo</span>
            </a>
        </li>
        <li class="sidebar-item {{setActive(['admin.category.index'])}}">
            <a href="{{route('admin.category.index')}}" class="sidebar-link">
                <i class="fa-solid fa-table-list"></i>
                <span>categories</span>
            </a>
        </li>
        <li class="sidebar-item {{setActive(['admin.coupon.* ', 'admin.sale.* '])}}">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#sales" aria-expanded="false" aria-controls="sales">
                <i class="fa-solid fa-tag"></i>
                <span>Sales</span>
            </a>
            <ul id="sales" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
                <li class="sidebar-item {{setActive(['admin.coupon.index '])}}">
                    <a href="{{route('admin.coupon.index')}}" class="sidebar-link">Copoun</a>
                </li>
                <li class="sidebar-item {{setActive(['admin.sale.index '])}}">
                    <a href="{{route('admin.sale.index')}}" class="sidebar-link">sale</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item {{setActive(['admin.shipping.* '])}} ">
            <a href="{{route('admin.shipping.index')}}" class="sidebar-link">
                <i class="fa-solid fa-book"></i>
                <span>Shipping</span>
            </a>
        </li>
        <li class="sidebar-item {{setActive(['admin.transaction.* '])}}">
            <a href="{{route('admin.transaction')}}" class="sidebar-link">
                <i class="fa-solid fa-money-check-dollar"></i>
                <span>Transactions</span>
            </a>
        </li>
        <li class="sidebar-item {{setActive(['admin.home-page-settings.* '])}}">
            <a href="{{route('admin.home-page-settings')}}" class="sidebar-link">
                <i class="fa-solid fa-gear"></i>
                <span>Home Page Setting</span>
            </a>
        </li>
    </ul>

</aside>
