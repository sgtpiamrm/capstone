<!-- jQuery and JavaScript functions -->
<script>
  $(document).ready(function () {
    // Function to display media (image/video) in a modal
    window.viewer_modal = function ($src = '') {
      start_loader();  // Start the loading animation
      var t = $src.split('.');  // Split the file extension from the source
      t = t[1];  // Get the file extension (e.g., mp4, jpg)
      if (t == 'mp4') {
        // Create a video element if the file is a video
        var view = $("<video src='" + $src + "' controls autoplay></video>");
      } else {
        // Create an image element if the file is an image
        var view = $("<img src='" + $src + "' />");
      }
      $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove();  // Remove previous content in the modal
      $('#viewer_modal .modal-content').append(view);  // Append the new content (image/video)
      $('#viewer_modal').modal({  // Show the modal
        show: true,
        backdrop: 'static',
        keyboard: false,
        focus: true
      });
      end_loader();  // End the loading animation
    }

    // Function to open a modal with content loaded via AJAX
    window.uni_modal = function ($title = '', $url = '', $size = "") {
      start_loader();  // Start the loading animation
      $.ajax({
        url: $url,  // The URL for the content to load
        error: err => {
          console.log(err);
          alert("An error occurred");  // Show an alert if there's an error
        },
        success: function (resp) {
          if (resp) {
            $('#uni_modal .modal-title').html($title);  // Set the modal title
            $('#uni_modal .modal-body').html(resp);  // Set the modal content
            if ($size != '') {
              // If size is provided, apply it to the modal
              $('#uni_modal .modal-dialog').addClass($size + '  modal-dialog-centered');
            } else {
              // Default size and alignment
              $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered");
            }
            $('#uni_modal').modal({  // Show the modal
              show: true,
              backdrop: 'static',
              keyboard: false,
              focus: true
            });
            end_loader();  // End the loading animation
          }
        }
      });
    }

    // Function to display a confirmation modal
    window._conf = function ($msg = '', $func = '', $params = []) {
      $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")");  // Set the function to be called on confirm
      $('#confirm_modal .modal-body').html($msg);  // Set the confirmation message
      $('#confirm_modal').modal('show');  // Show the confirmation modal
    }
  });
</script>

<!-- Footer Section -->
<footer class="main-footer text-sm" style="background-color: #007bff; color: white; padding: 15px; text-align: left;">
  <strong>© 2024 New Era University <?php echo date('Y') ?>.</strong> All rights reserved. Designed By MRS
  <!-- Backup code for the footer -->
  <!-- 
  <div class="float-right d-none d-sm-inline-block">
    <b><?php echo $_settings->info('short_name') ?> (by: <a href="mailto:pia.mahinay@neu.edu.ph" target="blank">MRS</a>)</b> v1.0
  </div>
  -->
</footer>

<!-- Wrapper End -->
</div> <!-- ./wrapper -->

<!-- Libraries Section -->
<div id="libraries">
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);  // Resolve conflict between jQuery UI and Bootstrap tooltips
  </script>

  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>
  <!-- JQVMap -->
  <script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url ?>dist/js/adminlte.js"></script>
</div>

<!-- Date Range Picker -->
<div class="daterangepicker ltr show-ranges opensright">
  <div class="ranges">
    <ul>
      <!-- Date Range Options -->
      <li data-range-key="Today">Today</li>
      <li data-range-key="Yesterday">Yesterday</li>
      <li data-range-key="Last 7 Days">Last 7 Days</li>
      <li data-range-key="Last 30 Days">Last 30 Days</li>
      <li data-range-key="This Month">This Month</li>
      <li data-range-key="Last Month">Last Month</li>
      <li data-range-key="Custom Range">Custom Range</li>
    </ul>
  </div>
  <!-- Calendar Tables -->
  <div class="drp-calendar left">
    <div class="calendar-table"></div>
    <div class="calendar-time" style="display: none;"></div>
  </div>
  <div class="drp-calendar right">
    <div class="calendar-table"></div>
    <div class="calendar-time" style="display: none;"></div>
  </div>
  <!-- Date Range Picker Buttons -->
  <div class="drp-buttons">
    <span class="drp-selected"></span>
    <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button>
    <button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button>
  </div>
</div>

<!-- jQVMap Label (hidden element for map interaction) -->
<div class="jqvmap-label" style="display: none; left: 1093.83px; top: 394.361px;">Idaho</div>