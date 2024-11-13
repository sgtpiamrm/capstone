<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
    <!-- Brand Logo and Title -->
    <a href="<?php echo base_url ?>index3.html" class="navbar-brand">
      <!-- Logo Image -->
      <img src="<?php echo base_url ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Navbar Toggle Button (For Mobile) -->
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible Navbar Content -->
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <!-- Home Link -->
        <li class="nav-item">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <!-- Contact Link -->
        <li class="nav-item">
          <a href="#" class="nav-link">Contact</a>
        </li>
        <!-- Dropdown Menu -->
        <li class="nav-item dropdown">
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle">Dropdown</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
            <!-- Dropdown Items -->
            <li><a href="#" class="dropdown-item">Some action </a></li>
            <li><a href="#" class="dropdown-item">Some other action</a></li>

            <!-- Divider between menu items -->
            <li class="dropdown-divider"></li>

            <!-- Nested Level Two Dropdown -->
            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <!-- Level Two Dropdown Items -->
                <li><a tabindex="-1" href="#" class="dropdown-item">level 2</a></li>

                <!-- Level Three Nested Dropdown -->
                <li class="dropdown-submenu">
                  <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                  <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                    <!-- Level Three Dropdown Items -->
                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                    <li><a href="#" class="dropdown-item">3rd level</a></li>
                  </ul>
                </li>
                <!-- End of Level Three Nested Dropdown -->

                <!-- More Level Two Items -->
                <li><a href="#" class="dropdown-item">level 2</a></li>
                <li><a href="#" class="dropdown-item">level 2</a></li>
              </ul>
            </li>
            <!-- End of Level Two Dropdown -->
          </ul>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-0 ml-md-3">
        <div class="input-group input-group-sm">
          <!-- Search Input Field -->
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <!-- Search Button -->
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- Individual Message Items -->
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="<?php echo base_url ?>dist/img/user1-128x128.jpg" alt="User Avatar"
                class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="<?php echo base_url ?>dist/img/user8-128x128.jpg" alt="User Avatar"
                class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <div class="media">
              <img src="<?php echo base_url ?>dist/img/user3-128x128.jpg" alt="User Avatar"
                class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- Notifications Header -->
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <!-- Individual Notification Items -->
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <!-- Sidebar Control Button -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </div>
</nav>