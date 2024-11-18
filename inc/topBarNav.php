<style>
  /* Style for user image: positions the image and sets its size and appearance */
  .user-img {
    position: absolute;
    height: 27px;
    width: 27px;
    object-fit: cover;
    left: -7%;
    top: -12%;
  }

  /* Style for rounded buttons */
  .btn-rounded {
    border-radius: 50px;
  }

  /* Fixed position style for the login navbar */
  #login-nav {
    position: fixed !important;
    top: 0 !important;
    z-index: 1037;
    padding: 1em 1.5em !important;
  }

  /* Adjusts the top spacing for the main navbar */
  #top-Nav {
    top: 4em;
  }

  /* Adjusts content wrapper's margin for fixed navbar */
  .text-sm .layout-navbar-fixed .wrapper .main-header~.content-wrapper,
  .layout-navbar-fixed .wrapper .main-header.text-sm~.content-wrapper {
    margin-top: calc(3.6) !important;
    padding-top: calc(5em) !important;
  }

  /* Style for user image in the navbar */
  #student-img-avatar {
    height: 27px;
    width: 27px;
    object-fit: cover;
    border-radius: 50%;
    margin-left: 10px;
  }

  /* Styling for navbar link hover effect */
  .navbar-nav .nav-item .nav-link {
    position: relative;
    display: inline-block;
    text-decoration: none;
    transition: color 0.3s ease;
    /* Add transition for text color */
  }

  /* Underline effect */
  .navbar-nav .nav-item .nav-link::before {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background-color: #003c72;
    /* Underline color */
    transition: width 0.3s, left 0.3s;
    /* Transition for underline */
  }

  .navbar-nav .nav-item .nav-link:hover::before {
    width: 100%;
    left: 0;
  }

  /* Change text color on hover */
  .navbar-nav .nav-item .nav-link:hover {
    color: #003c72;
    /* Hover text color */
  }

  /* Style for the Main Header Navbar */
  #top-Nav .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  /* Ensure logo and website name stay on the left */
  .navbar-brand {
    display: flex;
    align-items: center;
  }

  /* Align everything else to the right */
  .navbar-collapse {
    display: flex;
    justify-content: flex-end;
    width: 100%;
  }

  /* Optional: Ensure the navbar links are spaced properly */
  .navbar-nav {
    display: flex;
    justify-content: flex-end;
    margin-left: auto;
    /* Align navbar items to the right */
  }

  .navbar-nav .nav-item {
    margin-left: 15px;
    /* Space out the nav items */
  }

  /* Fix the user image in the login navbar */
  #student-img-avatar {
    height: 27px;
    width: 27px;
    object-fit: cover;
    border-radius: 50%;
    margin-left: 10px;
  }
</style>

<!-- Main Header Navbar -->
<nav class="main-header navbar navbar-expand navbar-light border-0 navbar-light text-sm" id="top-Nav">
  <div class="container">
    <a href="./" class="navbar-brand">
      <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Site Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
      <span><?= $_settings->info('short_name') ?></span>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="./" class="nav-link <?= isset($page) && $page == 'home' ? "active" : "" ?>">Home</a>
        </li>

        <?php if ($_settings->userdata('id') > 0): ?>
          <li class="nav-item">
            <a href="./?page=projects"
              class="nav-link <?= isset($page) && $page == 'projects' ? "active" : "" ?>">Projects</a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Department</a>
            <ul class="dropdown-menu">
              <?php
              $departments = $conn->query("SELECT * FROM department_list WHERE status = 1 ORDER BY `name` ASC");
              while ($row = $departments->fetch_assoc()):
                ?>
                <li><a href="./?page=projects_per_department&id=<?= $row['id'] ?>" class="dropdown-item">
                    <?= ucwords($row['name']) ?></a></li>
              <?php endwhile; ?>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Courses</a>
            <ul class="dropdown-menu">
              <?php
              $curriculums = $conn->query("SELECT * FROM curriculum_list WHERE status = 1 ORDER BY `name` ASC");
              while ($row = $curriculums->fetch_assoc()):
                ?>
                <li><a href="./?page=projects_per_curriculum&id=<?= $row['id'] ?>" class="dropdown-item">
                    <?= ucwords($row['name']) ?></a></li>
              <?php endwhile; ?>
            </ul>
          </li>
        <?php endif; ?>

        <li class="nav-item">
          <a href="./?page=about" class="nav-link <?= isset($page) && $page == 'about' ? "active" : "" ?>">About Us</a>
        </li>

        <?php if ($_settings->userdata('id') > 0): ?>
          <li class="nav-item">
            <a href="./?page=profile"
              class="nav-link <?= isset($page) && $page == 'profile' ? "active" : "" ?>">Profile</a>
          </li>
          <li class="nav-item">
            <a href="./?page=submit-archive"
              class="nav-link <?= isset($page) && $page == 'submit-archive' ? "active" : "" ?>">Submit Thesis/Capstone</a>
          </li>
        <?php endif; ?>

        <?php if ($_settings->userdata('id') == 0): ?>
          <li class="nav-item">
            <a href="./register.php" class="nav-link text-light">Register</a>
          </li>
          <li class="nav-item">
            <a href="./login.php" class="nav-link text-light">Student Login</a>
          </li>
          <li class="nav-item">
            <a href="./admin" class="nav-link text-light">Admin Login</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Login Navbar (Now without login options) -->
<nav class="bg-navy w-100 px-2 py-1 position-fixed top-0" id="login-nav">
  <div class="d-flex justify-content-between w-100">
    <div>
      <span class="mr-2 text-white"><i class="fa fa-map-marker mr-1"></i> <?= $_settings->info('address') ?></span>
      <span class="mr-2 text-white"><i class="fa fa-phone mr-1"></i> <?= $_settings->info('contact') ?></span>
      <span class="mr-2 text-white"><i class="fa fa-envelope mr-1"></i> <?= $_settings->info('email') ?></span>
    </div>
    <div>
      <?php if ($_settings->userdata('id') > 0): ?>
        <span class="mx-2"><img src="<?= validate_image($_settings->userdata('avatar')) ?>" alt="User Avatar"
            id="student-img-avatar"></span>
        <span class="mx-2">Hello, <?= $_settings->userdata('firstname') ?: $_settings->userdata('username') ?></span>
        <span class="mx-1"><a href="<?= base_url . 'classes/Login.php?f=student_logout' ?>"><i
              class="fa fa-power-off"></i></a></span>
      <?php endif; ?>
    </div>
  </div>
</nav>