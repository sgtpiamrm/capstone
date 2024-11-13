<?php
// Include the configuration file to establish database connection
require_once('../../config.php');

// Check if the 'id' parameter is set in the URL query string
if (isset($_GET['id'])) {
    // Query the database to fetch package details based on the provided id
    $qry = $conn->query("SELECT * FROM `package_list` where id = '{$_GET['id']}'");

    // If a package record is found
    if ($qry->num_rows > 0) {
        // Fetch the package data as an associative array
        $res = $qry->fetch_array();

        // Loop through each record field and assign values to variables
        foreach ($res as $k => $v) {
            // Avoid assigning numeric keys as variable names
            if (!is_numeric($k))
                $$k = $v; // Dynamically assign values to variables based on the field names
        }
    }
}
?>

<style>
    /* Hide the modal footer (buttons) in the modal window */
    #uni_modal .modal-footer {
        display: none !important;
    }
</style>

<div class="container-fluid">
    <!-- Definition list (dl) to display package details -->

    <!-- Package name -->
    <dl>
        <dt class="text-muted">Name</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($name) ? $name : '' ?></dd> <!-- Display the package name -->

        <!-- Package description -->
        <dt class="text-muted">Description</dt>
        <dd class='pl-4'>
            <p class=""><small><?= isset($description) ? $description : '' ?></small></p>
            <!-- Display the package description -->
        </dd>

        <!-- Package status -->
        <dt class="text-muted">Status</dt>
        <dd class='pl-4'>
            <?php
            // Check if the status variable is set
            if (isset($status)):
                // Display the status based on the value of the 'status' field
                switch ($status) {
                    case '1':
                        // If the status is '1', display 'Active' as a green badge
                        echo "<span class='badge badge-success badge-pill'>Active</span>";
                        break;
                    case '0':
                        // If the status is '0', display 'Inactive' as a gray badge
                        echo "<span class='badge badge-secondary badge-pill'>Inactive</span>";
                        break;
                }
            endif;
            ?>
        </dd>
    </dl>

    <!-- Close button to dismiss the modal -->
    <div class="col-12 text-right">
        <button class="btn btn-flat btn-sm btn-dark" type="button" data-dismiss="modal">
            <i class="fa fa-times"></i> Close
        </button>
    </div>
</div>