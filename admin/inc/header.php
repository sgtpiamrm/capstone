<?php
require_once('sess_auth.php'); // Include session authentication to protect page access
?>

<head>
  <!-- Root style variables -->
  <style>
    :root {
      --base_url:
        <?php echo base_url ?>
      ; // Define a CSS variable for the base URL
    }
  </style>

  <!-- Meta Information -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    <?php echo $_settings->info('title') != false ? $_settings->info('title') . ' | ' : '' ?><?php echo $_settings->info('name') ?>
  </title>
  <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" /> <!-- Set the website favicon -->

  <!-- Stylesheets -->
  <!-- Google Fonts (commented out in this code) -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"> -->

  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css">

  <!-- Tempusdominus Bootstrap 4 (for date/time picker) -->
  <link rel="stylesheet"
    href="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- DataTables (for tables with search and sorting functionality) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Select2 (for advanced dropdowns) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- iCheck (for custom checkboxes and radio buttons) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- JQVMap (for vector maps) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/jqvmap/jqvmap.min.css">

  <!-- AdminLTE (the theme style) -->
  <link rel="stylesheet" href="<?php echo base_url ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dist/css/custom.css"> <!-- Custom styles -->

  <!-- overlayScrollbars (for custom scrollbars) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Daterange Picker -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.css">

  <!-- Summernote (for WYSIWYG editor) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.css">

  <!-- SweetAlert2 (for customizable alerts) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Custom style for Chart.js animations -->
  <style type="text/css">
    /* Chart.js specific styles */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99
      }

      to {
        opacity: 1
      }
    }

    .chartjs-render-monitor {
      animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
      position: absolute;
      direction: ltr;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      pointer-events: none;
      visibility: hidden;
      z-index: -1
    }

    .chartjs-size-monitor-expand>div {
      position: absolute;
      width: 1000000px;
      height: 1000000px;
      left: 0;
      top: 0
    }

    .chartjs-size-monitor-shrink>div {
      position: absolute;
      width: 200%;
      height: 200%;
      left: 0;
      top: 0
    }
  </style>

  <!-- jQuery and other necessary scripts -->
  <!-- jQuery library -->
  <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>

  <!-- jQuery UI (for interactions like datepickers and sliders) -->
  <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>

  <!-- SweetAlert2 for popups -->
  <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- Toastr (for notification messages) -->
  <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>

  <!-- Custom JavaScript variables -->
  <script>
    var _base_url_ = '<?php echo base_url ?>';  // Store the base URL in a JavaScript variable
  </script>

  <!-- Custom script for the application -->
  <script src="<?php echo base_url ?>dist/js/script.js"></script>

</head>