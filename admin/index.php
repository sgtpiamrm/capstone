<?php require_once('../config.php'); ?>
<!-- Includes the config.php file, which likely contains database or environment settings -->

<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<!-- HTML structure with language set to English, and the style set to auto height -->

<?php require_once('inc/header.php') ?>
<!-- Includes the header.php file, which likely contains meta tags, CSS, and other necessary header elements -->

<body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs"
  data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">
  <!-- Main body of the page, includes various classes for the layout and sidebar configuration -->

  <div class="wrapper">
    <!-- Main wrapper for the content -->

    <?php require_once('inc/topBarNav.php') ?>
    <!-- Includes the topBarNav.php file, which likely contains the top navigation bar -->

    <?php require_once('inc/navigation.php') ?>
    <!-- Includes the navigation.php file, which likely contains the sidebar or main menu -->

    <?php if ($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
      </script>
      <!-- If there's a success message stored in flashdata, a toast alert is shown with the message -->
    <?php endif; ?>

    <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
    <!-- Gets the page parameter from the URL, defaulting to 'home' if not set -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper pt-3" style="min-height: 567.854px;">
      <!-- Wrapper for the page content, adds top padding and sets a minimum height -->

      <!-- Main content section -->
      <section class="content ">
        <div class="container-fluid">
          <?php
          if (!file_exists($page . ".php") && !is_dir($page)) {
            include '404.html';
          } else {
            if (is_dir($page))
              include $page . '/index.php';
            else
              include $page . '.php';
          }
          ?>
          <!-- Dynamically includes the appropriate PHP page based on the 'page' parameter.
               If the page doesn't exist, it includes a 404 error page -->
        </div>
      </section>
      <!-- /.content -->

      <!-- Modal for confirmation actions -->
      <div class="modal fade" id="confirm_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirmation</h5>
              <!-- Modal header with the title 'Confirmation' -->
            </div>
            <div class="modal-body">
              <div id="delete_content"></div>
              <!-- Placeholder for dynamic content to be displayed in the modal body -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-flat" id='confirm' onclick="">Continue</button>
              <!-- Button to confirm the action in the modal -->
              <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Close</button>
              <!-- Button to close the modal without confirming -->
            </div>
          </div>
        </div>
      </div>

      <!-- Modal for generic actions (e.g., saving data) -->
      <div class="modal fade" id="uni_modal" role='dialog'>
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <!-- Placeholder for dynamic modal title -->
            </div>
            <div class="modal-body">
              <!-- Placeholder for dynamic content in the modal body -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary btn-flat" id='submit'
                onclick="$('#uni_modal form').submit()">Save</button>
              <!-- Button to submit the form inside the modal -->
              <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Cancel</button>
              <!-- Button to cancel the modal action -->
            </div>
          </div>
        </div>
      </div>

      <!-- Modal for actions that appear on the right side of the screen -->
      <div class="modal fade" id="uni_modal_right" role='dialog'>
        <div class="modal-dialog modal-full-height  modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span class="fa fa-arrow-right"></span>
              </button>
              <!-- Modal header with a close button on the right -->
            </div>
            <div class="modal-body">
              <!-- Placeholder for dynamic content in the modal body -->
            </div>
          </div>
        </div>
      </div>

      <!-- Modal for displaying images (viewer modal) -->
      <div class="modal fade" id="viewer_modal" role='dialog'>
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
            <!-- Close button for the modal -->
            <img src="" alt="">
            <!-- Placeholder for dynamically displaying an image -->
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->

    <?php require_once('inc/footer.php') ?>
    <!-- Includes the footer.php file, which likely contains footer content like scripts or links -->
</body>

</html>