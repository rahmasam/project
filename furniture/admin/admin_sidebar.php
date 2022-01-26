
<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="admin_index.php">
                <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                <span class="menu-title">Home page</span>
            </a>
        </li>
       
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-puzzle-outline menu-icon"></i>
                <span class="menu-title">Manage categories</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="add_category.php">Add category</a></li>
                    <li class="nav-item"> <a class="nav-link" href="view_categories.php">List of categories</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
                <i class="mdi mdi-bullseye-arrow menu-icon"></i>
                <span class="menu-title">Product Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="add_product.php">add products</a></li>
                    <li class="nav-item"> <a class="nav-link" href="view_products.php">List of products</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">Slide Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="add_slide.php">add slides</a></li>
                    <li class="nav-item"><a class="nav-link" href="view_slides.php">Slide List</a></li>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view_transactions.php">
                <i class="mdi mdi-playlist-check menu-icon"></i>
                <span class="menu-title">orders Management</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view_users.php">
                <i class="mdi mdi-comment-account-outline menu-icon"></i>
                <span class="menu-title">List of users accounts</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="view_roles.php">
                <i class="mdi mdi-file-document-box-outline menu-icon"></i>
                <span class="menu-title">permissions management</span>
            </a>
        </li>
    </ul>
</nav>
<!-- partial -->