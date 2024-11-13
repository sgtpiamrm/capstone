<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4 sidebar-no-expand bg-wood-dark">

  <!-- Brand Logo: Display the logo of the store with a link to the admin dashboard -->
  <a href="<?php echo base_url ?>admin" class="brand-link bg-primary bg-gradient text-sm">
    <!-- Logo Image -->
    <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Store Logo"
      class="brand-image img-circle elevation-3 bg-white"
      style="width: 1.8rem;height: 1.8rem;max-height: unset;object-fit:scale-down;object-position:center center">
    <!-- Short name of the store -->
    <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
  </a>

  <!-- Sidebar: Main sidebar content including navigation links -->
  <div
    class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
    <div class="os-resize-observer-host observed">
      <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
    </div>
    <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
      <div class="os-resize-observer"></div>
    </div>
    <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
    <div class="os-padding">
      <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
        <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">

          <!-- Sidebar user panel (optional) -->
          <div class="clearfix"></div>

          <!-- Sidebar Menu: Navigation links for the sidebar -->
          <nav class="mt-4">
            <ul
              class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child"
              data-widget="treeview" role="menu" data-accordion="false">

              <!-- Dashboard Link: Navigates to the dashboard -->
              <li class="nav-item dropdown">
                <a href="./" class="nav-link nav-home">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <!-- Create New Registration Link: Navigates to the registration creation page -->
              <li class="nav-item">
                <a href="<?php echo base_url ?>?page=manage_registration" class="nav-link nav-manage_registration">
                  <i class="nav-icon fas fa-plus"></i>
                  <p>Create New Registration</p>
                </a>
              </li>

              <!-- All Application Link: Navigates to the list of all registrations -->
              <li class="nav-item">
                <a href="<?php echo base_url ?>?page=registration_list" class="nav-link nav-registration_list">
                  <i class="nav-icon fas fa-th-list"></i>
                  <p>All Application</p>
                </a>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
      </div>
    </div>

    <!-- Scrollbars for the sidebar content (horizontal and vertical) -->
    <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
      <div class="os-scrollbar-track">
        <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
      </div>
    </div>
    <div class="os-scrollbar-corner"></div>
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Script to dynamically manage the active navigation link and modal interactions -->
<script>
  var page;
  $(document).ready(function () {
    // Determine the current page based on the 'page' URL parameter, defaulting to 'home'
    page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    page = page.replace(/\//gi, '_');

    // Set the active state on the sidebar links based on the current page
    if ($('.nav-link.nav-' + page).length > 0) {
      $('.nav-link.nav-' + page).addClass('active')

      // Expand the dropdown menu if the active link belongs to a tree item
      if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
        $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open')
      }

      // Open the tree view menu if the active link belongs to a tree
      if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
        $('.nav-link.nav-' + page).parent().addClass('menu-open')
      }
    }

    // Modal interaction: Triggered when the receive-nav link is clicked
    $('#receive-nav').click(function () {
      // Show the tracking number modal when triggered
      $('#uni_modal').on('shown.bs.modal', function () {
        $('#find-transaction [name="tracking_code"]').focus();
      })
      // Open the modal for entering tracking number
      uni_modal("Enter Tracking Number", "transaction/find_transaction.php");
    })
  })
</script>