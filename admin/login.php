<?php require_once('../config.php') ?>
<!-- Includes the config.php file, which likely contains configuration settings for the app like database connection -->

<!DOCTYPE html>
<html lang="en">
<!-- The HTML document begins, with the language set to English -->

<?php require_once('inc/header.php') ?>
<!-- Includes the header.php file, likely containing metadata, CSS links, and other head elements -->

<body class="hold-transition">
  <!-- The body of the HTML document begins. "hold-transition" class is likely used for page transitions -->

  <script>start_loader()</script>
  <!-- Calls a JavaScript function to start a loading animation -->

  <style>
    html,
    body {
      height: 100% !important;
      width: 100% !important;
    }

    /* Ensures the page fills the entire height and width of the viewport */

    body {
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size: cover;
      background-repeat: no-repeat;
    }

    /* Sets a dynamic background image based on the settings, ensuring it covers the entire page */

    .login-title {
      text-shadow: 2px 2px black;
    }

    /* Adds a text shadow to the login title for styling */

    #login {
      flex-direction: column !important;
    }

    /* Sets the layout of the login container to a column, overrides flex-direction with !important */

    #logo-img {
      height: 150px;
      width: 150px;
      object-fit: scale-down;
      object-position: center center;
      border-radius: 100%;
    }

    /* Styles the logo image: sets dimensions, centers it, and makes it circular */

    #login .col-7,
    #login .col-5 {
      width: 100% !important;
      max-width: unset !important;
    }

    /* Makes the columns inside the #login section fill 100% of the width */
  </style>

  <div class="h-100 d-flex align-items-center w-100" id="login">
    <!-- Creates a flex container for the login section with full height and width -->

    <div class="col-7 h-100 d-flex align-items-center justify-content-center">
      <!-- Left side of the login screen (logo area), occupies 7/12 of the width -->
      <div class="w-100">
        <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="" id="logo-img"></center>
        <!-- Displays the logo dynamically with the settings from $_settings -->

        <h1 class="text-center py-5 login-title"><b><?php echo $_settings->info('short_name') ?> - Admin</b></h1>
        <!-- Displays the title of the site (admin page), with text-shadow -->
      </div>
    </div>

    <div class="col-5 h-100 bg-gradient">
      <!-- Right side of the login screen (form area), occupies 5/12 of the width, with a gradient background -->

      <div class="d-flex w-100 h-100 justify-content-center align-items-center">
        <!-- Flex container to center the login form -->

        <div class="card col-sm-12 col-md-6 col-lg-3 card-outline card-primary">
          <!-- Card container for the login form -->

          <div class="card-header">
            <h4 class="text-navy text-center"><b>Login</b></h4>
            <!-- Card header with "Login" title -->
          </div>

          <div class="card-body">
            <form id="login-frm" action="" method="post">
              <!-- Login form starts, uses POST method -->

              <div class="input-group mb-3">
                <input type="text" class="form-control" autofocus name="username" placeholder="Username">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <!-- Username input field with icon inside the input group -->

              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <!-- Password input field with lock icon inside the input group -->

              <div class="row">
                <div class="col-8">
                  <a href="<?php echo base_url ?>">Go to Website</a>
                  <!-- Link to the main website (outside of the admin page) -->
                </div>
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                  <!-- Submit button for the login form -->
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- External Scripts -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery script for additional functionality (e.g., form validation, AJAX requests) -->

  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap JS for UI components like modals, buttons, and tooltips -->

  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE custom JS for additional features, likely UI customizations -->

  <script>
    $(document).ready(function () {
      end_loader();
    });
  </script>
  <!-- Ends the loading animation when the page finishes loading -->
</body>

</html>