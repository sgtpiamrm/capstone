<style>
  /* Style for the user image in the navbar */
  .user-img {
    position: absolute;
    /* Absolute positioning within its parent */
    height: 30px;
    /* Set height of the image */
    width: 30px;
    /* Set width of the image */
    object-fit: cover;
    /* Ensures the image covers the area without distorting */
    left: -20%;
    /* Position the image slightly to the left */
    top: -25%;
    /* Position the image slightly upwards */
  }

  /* Style for rounded buttons */
  .btn-rounded {
    border-radius: 50px;
    /* Make the button's corners fully rounded */
  }
</style>

<!-- Navbar -->
<nav
  class="main-header navbar navbar-expand navbar-light border border-dark border-top-0 border-left-0 border-right-0 navbar-light text-sm shadow-sm">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <!-- Menu Button -->
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

    <!-- Navbar Brand/Title -->
    <li class="nav-item d-none d-sm-inline-block">
      <a href="<?php echo base_url ?>" class="nav-link">
        <b><?php echo (!isMobileDevice()) ? $_settings->info('name') : $_settings->info('short_name'); ?> - Admin</b>
      </a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search (Currently Disabled) -->
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search"></i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li> -->

    <!-- User Profile Dropdown -->
    <li class="nav-item">
      <div class="btn-group nav-link">
        <!-- Profile Button -->
        <button type="button" class="btn btn-rounded badge badge-light dropdown-toggle dropdown-icon"
          data-toggle="dropdown">
          <!-- User Image -->
          <span><img src="<?php echo validate_image($_settings->userdata('avatar')) ?>"
              class="img-circle elevation-2 user-img" alt="User Image"></span>
          <!-- User Name -->
          <span
            class="ml-3"><?php echo ucwords($_settings->userdata('firstname') . ' ' . $_settings->userdata('lastname')) ?></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button>

        <!-- Dropdown Menu -->
        <div class="dropdown-menu" role="menu">
          <!-- My Account Link -->
          <a class="dropdown-item" href="<?php echo base_url . 'admin/?page=user' ?>"><span class="fa fa-user"></span>
            My Account</a>
          <div class="dropdown-divider"></div>
          <!-- Logout Link -->
          <a class="dropdown-item" href="<?php echo base_url . '/classes/Login.php?f=logout' ?>"><span
              class="fas fa-sign-out-alt"></span> Logout</a>
        </div>
      </div>
    </li>

    <!-- Additional Navbar Items (Currently Empty) -->
    <li class="nav-item">
    </li>
  </ul>
</nav>
<!-- /.navbar -->