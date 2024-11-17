<?php
// Include the configuration file to establish database connection
require_once('../../config.php');

// Sanitize and validate the 'id' parameter
$id = isset($_GET['id']) ? $conn->real_escape_string($_GET['id']) : null;

if ($id) {
    // Query the database
    $qry = $conn->query("SELECT * FROM `curriculum_list` WHERE id = '{$id}'");

    if ($qry) {
        if ($qry->num_rows > 0) {
            $res = $qry->fetch_array();
            foreach ($res as $k => $v) {
                if (!is_numeric($k)) {
                    $$k = $v;
                }
            }
        } else {
            // Handle case when no records are found
            die("<div class='alert alert-warning'>No package found for the given ID.</div>");
        }
    } else {
        // Handle query execution failure
        die("<div class='alert alert-danger'>Query failed: " . $conn->error . "</div>");
    }
} else {
    // Handle missing or invalid 'id' parameter
    die("<div class='alert alert-danger'>No valid 'id' provided in the URL.</div>");
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
        <dd class='pl-4 fs-4 fw-bold'><?= isset($name) ? htmlspecialchars($name) : '' ?></dd>
        <!-- Display the package name -->

        <!-- Package description -->
        <dt class="text-muted">Description</dt>
        <dd class='pl-4'>
            <p class=""><small><?= isset($description) ? htmlspecialchars($description) : '' ?></small></p>
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