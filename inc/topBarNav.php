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
</style>

<!-- Navbar Styles -->
<style>
  /* Fixed position style for the login navbar, ensuring it's always on top */
  #login-nav {
    position: fixed !important;
    top: 0 !important;
    z-index: 1037;
    padding: 1em 1.5em !important;
  }

  /* Adjusts the top spacing for the main navbar to account for the login navbar */
  #top-Nav {
    top: 4em;
  }

  /* Adjusts the content wrapper's margin and padding for fixed navbar */
  .text-sm .layout-navbar-fixed .wrapper .main-header~.content-wrapper,
  .layout-navbar-fixed .wrapper .main-header.text-sm~.content-wrapper {
    margin-top: calc(3.6) !important;
    padding-top: calc(5em) !important;
  }
</style>

<!-- Main Navbar -->
<nav class="bg-navy w-100 px-2 py-1 position-fixed top-0" id="login-nav">
  <div class="d-flex justify-content-between w-100">
    <!-- Left side: Display address, contact, and email from settings -->
    <div>
      <span class="mr-2  text-white"><i class="fa fa-map-marker mr-1"></i> <?= $_settings->info('address') ?></span>
      <span class="mr-2  text-white"><i class="fa fa-phone mr-1"></i> <?= $_settings->info('contact') ?></span>
      <span class="mr-2  text-white"><i class="fa fa-envelope mr-1"></i> <?= $_settings->info('email') ?></span>
    </div>

    <!-- Right side: User login or registration options -->
    <div>
      <?php if ($_settings->userdata('id') > 0): ?>
        <!-- Display user avatar and logout link if user is logged in -->
        <span class="mx-2"><img src="<?= validate_image($_settings->userdata('avatar')) ?>" alt="User Avatar"
            id="student-img-avatar"></span>
        <span class="mx-2">Hello,
          <?= !empty($_settings->userdata('firstname')) ? $_settings->userdata('firstname') : $_settings->userdata('username') ?>
          <span class="mx-1"><a href="<?= base_url . 'classes/Login.php?f=student_logout' ?>"><i
                class="fa fa-power-off"></i></a></span>
        <?php else: ?>
          <!-- Display registration and login links if the user is not logged in -->
          <a href="./register.php" class="mx-2 text-light me-2">Register</a>
          <a href="./login.php" class="mx-2 text-light me-2">Student Login</a>
          <a href="./admin" class="mx-2 text-light">Admin login</a>
        <?php endif; ?>
    </div>
  </div>
</nav>

<!-- Main header navbar for navigation -->
<nav class="main-header navbar navbar-expand navbar-light border-0 navbar-light text-sm" id='top-Nav'>
  <div class="container">
    <!-- Site Logo and name with a link to the homepage -->
    <a href="./" class="navbar-brand">
      <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Site Logo"
        class="brand-image img-circle elevation-3" style="opacity: .8">
      <span><?= $_settings->info('short_name') ?></span>
    </a>

    <!-- Navbar toggle button for mobile view -->
    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
      aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible navbar menu -->
    <div class="collapse navbar-collapse order-3" id="navbarCollapse">
      <!-- Left navbar links: Main navigation links (Home, Projects, Department, etc.) -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="./" class="nav-link <?= isset($page) && $page == 'home' ? "active" : "" ?>">Home</a>
        </li>
        <li class="nav-item">
          <a href="./?page=projects"
            class="nav-link <?= isset($page) && $page == 'projects' ? "active" : "" ?>">Projects</a>
        </li>
        <li class="nav-item dropdown">
          <!-- Department Dropdown menu -->
          <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
            class="nav-link dropdown-toggle  <?= isset($page) && $page == 'projects_per_department' ? "active" : "" ?>">Department</a>
          <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"
            style="left: 0px; right: inherit;">
            <!-- Fetch departments from database and list them -->
            <?php
            $departments = $conn->query("SELECT * FROM department_list where status = 1 order by `name` asc");
            $dI = $departments->num_rows;
            while ($row = $departments->fetch_assoc()):
              $dI--;
              ?>
              <li>
                <a href="./?page=projects_per_department&id=<?= $row['id'] ?>"
                  class="dropdown-item"><?= ucwords($row['name']) ?></a>
                <?php if ($dI != 0): ?>
                <li class="dropdown-divider"></li>
              <?php endif; ?>
          </li>
        <?php endwhile; ?>
      </ul>
      </li>

      <li class="nav-item dropdown">
        <!-- Courses Dropdown menu -->
        <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
          class="nav-link dropdown-toggle  <?= isset($page) && $page == 'projects_per_curriculum' ? "active" : "" ?>">Courses</a>
        <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
          <!-- Fetch curriculums from database and list them -->
          <?php
          $curriculums = $conn->query("SELECT * FROM curriculum_list where status = 1 order by `name` asc");
          $cI = $curriculums->num_rows;
          while ($row = $curriculums->fetch_assoc()):
            $cI--;
            ?>
            <li>
              <a href="./?page=projects_per_curriculum&id=<?= $row['id'] ?>"
                class="dropdown-item"><?= ucwords($row['name']) ?></a>
              <?php if ($cI != 0): ?>
              <li class="dropdown-divider"></li>
            <?php endif; ?>
        </li>
      <?php endwhile; ?>
      </ul>
      </li>

      <li class="nav-item">
        <!-- About Us Link -->
        <a href="./?page=about" class="nav-link <?= isset($page) && $page == 'about' ? "active" : "" ?>">About Us</a>
      </li>
      <?php if ($_settings->userdata('id') > 0): ?>
        <!-- Profile and Submit Thesis/Capstone Links for logged-in users -->
        <li class="nav-item">
          <a href="./?page=profile" class="nav-link <?= isset($page) && $page == 'profile' ? "active" : "" ?>">Profile</a>
        </li>
        <li class="nav-item">
          <a href="./?page=submit-archive"
            class="nav-link <?= isset($page) && $page == 'submit-archive' ? "active" : "" ?>">Submit Thesis/Capstone</a>
        </li>
      <?php endif; ?>
      </ul>
    </div>

    <!-- Right navbar links: Search functionality -->
    <div class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
      <a href="javascript:void(0)" class="text-navy" id="search_icon"><i class="fa fa-search"></i></a>
      <div class="position-relative">
        <!-- Search input field -->
        <div id="search-field" class="position-absolute">
          <input type="search" id="search-input" class="form-control rounded-0" required placeholder="Search..."
            value="<?= isset($_GET['q']) ? $_GET['q'] : '' ?>">
        </div>
      </div>
    </div>
  </div>
</nav>

<!-- Navbar Script -->
<script>
  $(function () {
    // Search form submission event
    $('#search-form').submit(function (e) {
      e.preventDefault()
      if ($('[name="q"]').val().length == 0)
        location.href = './';
      else
        location.href = './?' + $(this).serialize();
    })
    // Toggle search field visibility on icon click
    $('#search_icon').click(function () {
      $('#search-field').addClass('show')
      $('#search-input').focus();
    })
    // Hide search field when input loses focus
    $('#search-input').focusout(function (e) {
      $('#search-field').removeClass('show')
    })
    // Trigger search on enter key press
    $('#search-input').keydown(function (e) {
      if (e.which == 13) {
        location.href = "./?page=projects&q=" + encodeURI($(this).val());
      }
    })
  })
</script>