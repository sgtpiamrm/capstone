<?php
// Uncomment the line below to include session authentication logic
// require_once('sess_auth.php');
?>

<head>
  <!-- Set the background image using a PHP variable for dynamic content -->
  <style>
    :root {
      --bg-img: url('<?php echo validate_image($_settings->info('cover')) ?>');
    }
  </style>

  <!-- Meta tags for character set and responsive design -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Title of the webpage, including the dynamic application name -->
  <title>
    <?php echo $_settings->info('title') != false ? $_settings->info('title') . ' | ' : '' ?><?php echo $_settings->info('name') ?>
  </title>

  <!-- Favicon for the webpage, dynamically loaded from settings -->
  <link rel="icon" href="<?php echo validate_image($_settings->info('logo')) ?>" />

  <!-- External CSS libraries -->
  <!-- Google Font: Source Sans Pro (commented out) -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"> -->

  <!-- Font Awesome for icon sets -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css">

  <!-- Ionicons (commented out) -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

  <!-- Tempusdominus Bootstrap 4 for date and time picker -->
  <link rel="stylesheet"
    href="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!-- DataTables for advanced table functionality (responsive and interactive) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Select2 for enhanced select elements (dropdowns) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- iCheck for styled checkboxes and radio buttons -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- JQVMap for interactive maps -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/jqvmap/jqvmap.min.css">

  <!-- Main theme style for the application -->
  <link rel="stylesheet" href="<?php echo base_url ?>dist/css/adminlte.css">
  <link rel="stylesheet" href="<?php echo base_url ?>dist/css/custom.css">
  <link rel="stylesheet" href="<?php echo base_url ?>assets/css/styles.css">

  <!-- overlayScrollbars for custom scrollbars -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Daterange picker for selecting date ranges -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.css">

  <!-- Summernote for rich text editing (WYSIWYG editor) -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.css">

  <!-- SweetAlert2 for beautiful pop-up alerts -->
  <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- Custom internal styles for specific elements -->
  <style type="text/css">
    /* Custom animation for Chart.js render */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99
      }

      to {
        opacity: 1
      }
    }

    /* Additional chart styles */
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

  <!-- jQuery library for DOM manipulation -->
  <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>

  <!-- jQuery UI for additional UI components (e.g., date pickers) -->
  <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>

  <!-- SweetAlert2 for pop-up alerts -->
  <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- Toastr for non-blocking notifications -->
  <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>

  <!-- Set the base URL for JavaScript usage -->
  <script>
    var _base_url_ = '<?php echo base_url ?>';
  </script>

  <!-- Custom script for application functionality -->
  <script src="<?php echo base_url ?>dist/js/script.js"></script>

  <!-- Custom header styles -->
  <style>
    /* Styling for the main header with a background gradient */
    #main-header {
      position: relative;
      background: rgb(0, 0, 0) !important;
      background: radial-gradient(circle, rgba(0, 0, 0, 0.48503151260504207) 22%, rgba(0, 0, 0, 0.39539565826330536) 49%, rgba(0, 212, 255, 0) 100%) !important;
    }

    /* Background image applied on top of the header */
    #main-header:before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url(<?php echo base_url . $_settings->info('cover') ?>);
      background-repeat: no-repeat;
      background-size: cover;
      filter: drop-shadow(0px 7px 6px black);
      z-index: -1;
    }
  </style>

</head>