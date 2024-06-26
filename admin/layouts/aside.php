<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="<?=url('admin')?>">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-people-fill"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?=url('admin/users')?>">
                        <i class="bi bi-circle"></i><span>Show List</span>
                    </a>
                </li>


            </ul>
        </li><!-- End Components Nav -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-news" data-bs-toggle="collapse" href="#">
                <i class="bi bi-newspaper"></i><span>News</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-news" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?= url('admin/manage-category') ?>">
                        <i class="bi bi-circle"></i><span>Manage Category</span>
                    </a> <a href="<?= url('admin/add-news') ?>">
                        <i class="bi bi-circle"></i><span>Add News</span>
                    </a>
                </li>


            </ul>
        </li><!-- End Components Nav -->


    </ul>

</aside><!-- End Sidebar-->
