<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Master Management</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse
            {{ Request::segment(1) == 'category' ? 'show' : '' }}
            {{ Request::segment(1) == 'subcategory' ? 'show' : '' }}
            {{ Request::segment(1) == 'product' ? 'show' : '' }}
            {{ Request::segment(1) == 'city' ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a class="{{ Request::segment(1) == 'category' ? 'active' : '' }} collapse-item"
                        href="{{ route('category.index') }}">
                        <i class="bi bi-circle"></i><span>Category</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Request::segment(1) == 'subcategory' ? 'active' : '' }} collapse-item"
                        href="{{ route('subcategory.index') }}">
                        <i class="bi bi-circle"></i><span>Sub Category</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Request::segment(1) == 'product' ? 'active' : '' }} collapse-item"
                        href="{{ route('product.index') }}">
                        <i class="bi bi-circle"></i><span>Product</span>
                    </a>
                </li>
                <li>
                    <a class="{{ Request::segment(1) == 'city' ? 'active' : '' }} collapse-item"
                        href="{{ route('city.index') }}">
                        <i class="bi bi-circle"></i><span>City</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
    </ul>
</aside><!-- End Sidebar-->
