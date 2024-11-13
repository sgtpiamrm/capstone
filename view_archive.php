<?php
// Check if 'id' is passed in the URL and it's greater than 0
if (isset($_GET['id']) && $_GET['id'] > 0) {
    // Query the archive_list table for the specific archive ID
    $qry = $conn->query("SELECT a.* FROM `archive_list` a where a.id = '{$_GET['id']}'");
    if ($qry->num_rows) {
        // If a record is found, dynamically assign its values to variables
        foreach ($qry->fetch_array() as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;  // Assign variables dynamically
        }
    }

    // Default value for 'submitted' is "N/A"
    $submitted = "N/A";

    // Check if student_id is set
    if (isset($student_id)) {
        // Query the student_list table to get the student's email
        $student = $conn->query("SELECT * FROM student_list where id = '{$student_id}'");
        if ($student->num_rows > 0) {
            // Fetch student data and set the submitted email
            $res = $student->fetch_array();
            $submitted = $res['email'];
        }
    }
}
?>

<!-- Inline CSS for document iframe styling -->
<style>
    #document_field {
        min-height: 80vh;
        /* Set a minimum height for the document display area */
    }
</style>

<!-- Main Content Section -->
<div class="content py-4">
    <div class="col-12">
        <!-- Card Component for Archive View -->
        <div class="card card-outline card-primary shadow rounded-0">
            <div class="card-header">
                <h3 class="card-title">
                    <!-- Display Archive Title -->
                    Archive - <?= isset($archive_code) ? $archive_code : "" ?>
                </h3>
            </div>
            <div class="card-body rounded-0">
                <div class="container-fluid">
                    <!-- Display Project Title -->
                    <h2><b><?= isset($title) ? $title : "" ?></b></h2>
                    <!-- Display Submission Information -->
                    <small class="text-muted">Submitted by <b class="text-info"><?= $submitted ?></b> on
                        <?= date("F d, Y h:i A", strtotime($date_created)) ?></small>

                    <!-- Display Edit and Delete buttons for specific user -->
                    <?php if (isset($student_id) && $_settings->userdata('login_type') == "2" && $student_id == $_settings->userdata('id')): ?>
                        <div class="form-group">
                            <!-- Edit Button to Redirect to Submission Page -->
                            <a href="./?page=submit-archive&id=<?= isset($id) ? $id : "" ?>"
                                class="btn btn-flat btn-default bg-navy btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <!-- Delete Button to Trigger Deletion -->
                            <button type="button" data-id="<?= isset($id) ? $id : "" ?>"
                                class="btn btn-flat btn-danger btn-sm delete-data">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>
                    <?php endif; ?>
                    <hr>
                    <!-- Display Banner Image -->
                    <center>
                        <img src="<?= validate_image(isset($banner_path) ? $banner_path : "") ?>" alt="Banner Image"
                            id="banner-img" class="img-fluid border bg-gradient-dark">
                    </center>

                    <!-- Display Project Year -->
                    <fieldset>
                        <legend class="text-navy">Project Year:</legend>
                        <div class="pl-4">
                            <large><?= isset($year) ? $year : "----" ?></large>
                        </div>
                    </fieldset>

                    <!-- Display Project Abstract -->
                    <fieldset>
                        <legend class="text-navy">Abstract:</legend>
                        <div class="pl-4">
                            <large><?= isset($abstract) ? html_entity_decode($abstract) : "" ?></large>
                        </div>
                    </fieldset>

                    <!-- Display Project Members -->
                    <fieldset>
                        <legend class="text-navy">Members:</legend>
                        <div class="pl-4">
                            <large><?= isset($members) ? html_entity_decode($members) : "" ?></large>
                        </div>
                    </fieldset>

                    <!-- Display Project Document (PDF) -->
                    <fieldset>
                        <legend class="text-navy">Project Document:</legend>
                        <div class="pl-4">
                            <!-- Embed PDF document in iframe -->
                            <iframe src="<?= isset($document_path) ? base_url . $document_path : "" ?>" frameborder="0"
                                id="document_field" class="text-center w-100">Loading Document ...</iframe>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Handle Delete Confirmation and Archive Deletion -->
<script>
    $(function () {
        // When Delete Button is clicked
        $('.delete-data').click(function () {
            // Confirm deletion action
            _conf("Are you sure to delete <b>Archive-<?= isset($archive_code) ? $archive_code : "" ?></b>", "delete_archive")
        })
    })

    // Function to Delete Archive
    function delete_archive() {
        start_loader();  // Show loading animation
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_archive",  // Send request to delete archive
            method: "POST",
            data: { id: "<?= isset($id) ? $id : "" ?>" },  // Pass archive ID for deletion
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');  // Show error toast message
                end_loader();  // Hide loading animation
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    // If successful, redirect to the homepage
                    location.replace("./");
                } else {
                    alert_toast("An error occured.", 'error');  // Show error toast message
                    end_loader();
                }
            }
        })
    }
</script>