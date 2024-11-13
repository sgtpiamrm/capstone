<?php require_once('./config.php'); ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">

<!-- Style block for custom CSS -->
<style>
  /* Header section style */
  #header {
    height: 70vh;
    /* Set header height to 70% of the viewport height */
    width: calc(100%);
    /* Set width to 100% of the container */
    position: relative;
    /* Position relative for absolute children */
    top: -1em;
    /* Move the header up by 1em */
  }

  /* Background image for the header */
  #header:before {
    content: "";
    /* Empty content */
    position: absolute;
    /* Position absolute inside the parent */
    height: calc(100%);
    /* Fill the full height of the header */
    width: calc(100%);
    /* Fill the full width of the header */
    background-image: url(<?= validate_image($_settings->info("cover")) ?>);
    /* Use a dynamic image URL */
    background-size: cover;
    /* Ensure background image covers the entire area */
    background-repeat: no-repeat;
    /* Prevent image repetition */
    background-position: center center;
    /* Center the background image */
  }

  /* Positioning for elements inside the header */
  #header>div {
    position: absolute;
    /* Position absolutely within the header */
    height: calc(100%);
    /* Fill the full height of the header */
    width: calc(100%);
    /* Fill the full width of the header */
    z-index: 2;
    /* Ensure the content appears above the background image */
  }

  /* Style for active navigation links */
  #top-Nav a.nav-link.active {
    color: #001f3f;
    /* Set the active link color */
    font-weight: 900;
    /* Make the active link text bold */
    position: relative;
    /* Make position relative to create a pseudo-element */
  }

  /* Underline for active navigation links */
  #top-Nav a.nav-link.active:before {
    content: "";
    /* Empty content for the pseudo-element */
    position: absolute;
    /* Position absolutely under the link */
    border-bottom: 2px solid #001f3f;
    /* Create a solid border under the link */
    width: 33.33%;
    /* Set the width of the underline */
    left: 33.33%;
    /* Center the underline */
    bottom: 0;
    /* Align the underline at the bottom */
  }
</style>

<!-- Including the header -->
<?php require_once('inc/header.php') ?>

<body class="layout-top-nav layout-fixed layout-navbar-fixed" style="height: auto;">
  <div class="wrapper">
    <!-- Get current page from URL parameter or default to 'home' -->
    <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>

    <!-- Including top navigation bar -->
    <?php require_once('inc/topBarNav.php') ?>

    <!-- Success flash message display (if available) -->
    <?php if ($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
      </script>
    <?php endif; ?>

    <!-- Main content wrapper -->
    <div class="content-wrapper pt-5" style="">

      <!-- Display header for home or about_us page -->
      <?php if ($page == "home" || $page == "about_us"): ?>
        <div id="header" class="shadow mb-4">
          <div class="d-flex justify-content-center h-100 w-100 align-items-center flex-column px-3">
            <!-- Title of the site -->
            <h1 class="w-100 text-center site-title"><?php echo $_settings->info('name') ?></h1>
            <p class="text-center" style="font-size: 40px; font-style: italic;">"Building Bridges to Knowledge, One
              Archive
              at a Time"</p>
          </div>
        </div>
      <?php endif; ?>

      <!-- Main content section -->
      <section class="content ">
        <div class="container">
          <?php
          // Include content based on the page variable
          if (!file_exists($page . ".php") && !is_dir($page)) {
            include '404.html';  // If the page is not found, include the 404 error page
          } else {
            if (is_dir($page))
              include $page . '/index.php';  // If it's a directory, include its index.php
            else
              include $page . '.php';  // Otherwise, include the page as a PHP file
          }
          ?>
        </div>
      </section>
      <!-- /.content -->

      <!-- Modal for confirmation (e.g., delete confirmation) -->
      <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmation</h5>
            </div>
            <div class="modal-body">
              <div id="delete_content"></div> <!-- Content for the confirmation message -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
              <!-- Continue button -->
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> <!-- Close button -->
            </div>
          </div>
        </div>
      </div>

      <!-- Modal for general purposes (e.g., editing or saving data) -->
      <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id='submit'
                onclick="$('#uni_modal form').submit()">Save</button> <!-- Save button -->
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <!-- Cancel button -->
            </div>
          </div>
        </div>
      </div>

      <!-- Modal for displaying content on the right side -->
      <div class="modal fade" id="uni_modal_right" role='dialog'>
        <div class="modal-dialog modal-full-height  modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="fa fa-arrow-right"></span>
              </button>
            </div>
            <div class="modal-body">
            </div>
          </div>
        </div>
      </div>

      <!-- Modal for viewing images -->
      <div class="modal fade" id="viewer_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
            <!-- Close button -->
            <img src="" alt=""> <!-- Placeholder for image to be displayed -->
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Including footer -->
    <?php require_once('inc/footer.php') ?>
</body>

</html>