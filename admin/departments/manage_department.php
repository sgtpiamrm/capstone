<?php
// Include the configuration file to establish database connection
require_once('../../config.php');

// Check if the 'id' parameter is set in the URL query string
if (isset($_GET['id'])) {
    // Query the database to fetch department details based on the provided id
    $qry = $conn->query("SELECT * FROM `department_list` where id = '{$_GET['id']}'");

    // If a department record is found
    if ($qry->num_rows > 0) {
        // Fetch the department data as an associative array
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

<div class="container-fluid">
    <!-- Department Form -->
    <form action="" id="department-form">
        <!-- Hidden field to store department id -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

        <!-- Name input field -->
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <!-- Department name input -->
            <input type="text" name="name" id="name" class="form-control form-control-border"
                placeholder="Department Name" value="<?php echo isset($name) ? $name : '' ?>" required>
        </div>

        <!-- Description input field -->
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <!-- Department description input -->
            <textarea rows="3" name="description" id="description" class="form-control form-control-border"
                placeholder="Write the Department description here."
                required><?php echo isset($description) ? $description : '' ?></textarea>
        </div>

        <!-- Status selection field -->
        <div class="form-group">
            <label for="" class="control-label">Status</label>
            <!-- Department status dropdown -->
            <select name="status" id="status" class="form-control form-control-border" required>
                <!-- Active option -->
                <option value="1" <?= isset($status) && $status == 1 ? "selected" : "" ?>>Active</option>
                <!-- Inactive option -->
                <option value="0" <?= isset($status) && $status == 0 ? "selected" : "" ?>>Inactive</option>
            </select>
        </div>
    </form>
</div>

<script>
    $(function () {
        // Handle the form submission
        $('#uni_modal #department-form').submit(function (e) {
            e.preventDefault(); // Prevent default form submission
            var _this = $(this);
            $('.pop-msg').remove(); // Remove any existing message

            // Create a new div for displaying messages
            var el = $('<div>');
            el.addClass("pop-msg alert");
            el.hide(); // Hide the message initially

            start_loader(); // Start the loader animation

            // Perform AJAX request to save department data
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_department", // URL for saving department
                data: new FormData($(this)[0]), // Send form data
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST', // POST request method
                dataType: 'json', // Expect JSON response
                error: err => {
                    // Handle any errors during AJAX request
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader(); // Stop the loader
                },
                success: function (resp) {
                    // Check if the response status is 'success'
                    if (resp.status == 'success') {
                        location.reload(); // Reload the page to reflect changes
                    } else if (!!resp.msg) {
                        // Display error message if provided
                        el.addClass("alert-danger");
                        el.text(resp.msg);
                        _this.prepend(el);
                    } else {
                        // Display a generic error message
                        el.addClass("alert-danger");
                        el.text("An error occurred due to unknown reason.");
                        _this.prepend(el);
                    }
                    el.show('slow'); // Show the message with a slow fade-in effect
                    end_loader(); // Stop the loader animation
                }
            })
        });
    })
</script>