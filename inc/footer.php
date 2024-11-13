<!-- jQuery Script Section -->
<script>
  $(document).ready(function () {
    // Loop through each .list-group element and clear its content if empty
    $('.list-group').each(function () {
      if (String($(this).text()).trim() == "") {
        $(this).html("")
      }
    })

    // Function to display content in a modal viewer (image or video)
    window.viewer_modal = function ($src = '') {
      start_loader()
      var t = $src.split('.')
      t = t[1]
      if (t == 'mp4') {
        var view = $("<video src='" + $src + "' controls autoplay></video>")
      } else {
        var view = $("<img src='" + $src + "' />")
      }
      $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
      $('#viewer_modal .modal-content').append(view)
      $('#viewer_modal').modal({
        show: true,
        backdrop: 'static',
        keyboard: false,
        focus: true
      })
      end_loader()
    }

    // Function to load content into a modal from a URL
    window.uni_modal = function ($title = '', $url = '', $size = "") {
      start_loader()
      $.ajax({
        url: $url,
        error: err => {
          console.log()
          alert("An error occurred")
        },
        success: function (resp) {
          if (resp) {
            $('#uni_modal .modal-title').html($title)
            $('#uni_modal .modal-body').html(resp)
            if ($size != '') {
              $('#uni_modal .modal-dialog').addClass($size + '  modal-dialog-centered')
            } else {
              $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
            }
            $('#uni_modal').modal({
              show: true,
              backdrop: 'static',
              keyboard: false,
              focus: true
            })
            end_loader()
          }
        }
      })
    }

    // Function to show confirmation modal with custom message and action
    window._conf = function ($msg = '', $func = '', $params = []) {
      $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
      $('#confirm_modal .modal-body').html($msg)
      $('#confirm_modal').modal('show')
    }
  })
</script>

<!-- Footer Section -->
<footer class="main-footer text-sm">
  <div class="container">
    <!-- Footer Content -->
    <strong>© 2024 New Era University.<?php echo date('Y') ?>.</strong>
    All rights reserved. Designed By MRS
    <div class="float-right d-none d-sm-inline-block">
      <!-- Social Media and Footer Info (commented out) -->
      <!-- <b><?php echo $_settings->info('short_name') ?> (by: <a target="blank">MRS</a> )</b> v1.0 -->
    </div>
  </div>
</footer>
<!-- End of Footer Section -->

<!-- Wrapper End -->
</div>

<!-- External Libraries and Scripts -->
<div id="libraries">
  <!-- Resolving jQuery UI Tooltip Conflict with Bootstrap -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>

  <!-- Bootstrap 4 JavaScript -->
  <script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Chart.js -->
  <script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>

  <!-- Sparkline -->
  <script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>

  <!-- Select2 -->
  <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>

  <!-- JQVMap (Interactive Map Plugin) -->
  <script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>

  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>

  <!-- Daterangepicker -->
  <script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>

  <!-- Tempusdominus Bootstrap 4 (Datetime Picker) -->
  <script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

  <!-- Summernote (WYSIWYG Editor) -->
  <script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>

  <!-- DataTables (Interactive Table Plugin) -->
  <script src="<?php echo base_url ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

  <!-- AdminLTE Core JavaScript -->
  <script src="<?php echo base_url ?>dist/js/adminlte.js"></script>
</div>

<!-- Date Range Picker UI Section -->
<div class="daterangepicker ltr show-ranges opensright">
  <div class="ranges">
    <!-- Date Range Options -->
    <ul>
      <li data-range-key="Today">Today</li>
      <li data-range-key="Yesterday">Yesterday</li>
      <li data-range-key="Last 7 Days">Last 7 Days</li>
      <li data-range-key="Last 30 Days">Last 30 Days</li>
      <li data-range-key="This Month">This Month</li>
      <li data-range-key="Last Month">Last Month</li>
      <li data-range-key="Custom Range">Custom Range</li>
    </ul>
  </div>
  <!-- Calendar Layout -->
  <div class="drp-calendar left">
    <div class="calendar-table"></div>
    <div class="calendar-time" style="display: none;"></div>
  </div>
  <div class="drp-calendar right">
    <div class="calendar-table"></div>
    <div class="calendar-time" style="display: none;"></div>
  </div>
  <!-- Apply and Cancel Buttons -->
  <div class="drp-buttons">
    <span class="drp-selected"></span>
    <button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button>
    <button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button>
  </div>
</div>

<!-- jqvmap Label (Dynamic map label display) -->
<div class="jqvmap-label" style="display: none; left: 1093.83px; top: 394.361px;">Idaho</div>

<!-- Set Content Wrapper Height -->
<script>
  $(function () {
    // Set the minimum height of the content-wrapper based on window size and footer height
    $('.wrapper>.content-wrapper').css("min-height", $(window).height() - $('#top-Nav').height() - $('#login-nav').height() - $("footer.main-footer").height())
  })
</script>