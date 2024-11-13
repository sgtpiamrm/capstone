<?php
require_once('../../config.php'); // Include configuration file for database connection and other settings

// Check if 'id' is passed via the URL query parameter
if (isset($_GET['id'])) {
    // Query the database for the curriculum with the given 'id'
    $qry = $conn->query("SELECT * FROM `curriculum_list` where id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {  // If the curriculum is found
        $res = $qry->fetch_array();  // Fetch the data as an associative array
        // Iterate through the results and assign each value to a variable
        foreach ($res as $k => $v) {
            if (!is_numeric($k))  // Skip numeric keys
                $$k = $v;  // Dynamically assign the value to a variable with the same name as the key
        }
    }
}
?>

<div class="container-fluid">
    <!-- Curriculum form for creating/updating curriculum -->
    <form action="" id="curriculum-form">
        <!-- Hidden input to store the curriculum ID -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

        <!-- Department selection dropdown -->
        <div class="form-group">
            <label for="department_id" class="control-label">Department</label>
            <select name="department_id" id="department_id" class="form-control form-control-border" required
                data-placeholder="Select Department Here">
                <option <?= !isset($department_id) == 1 ? "selected" : "" ?>></option>
                <?php
                // Query the department list to populate the dropdown
                $department = $conn->query("SELECT * FROM `department_list` where `status` = 1 " . (isset($department_id) ? "OR id = '{$department_id}'" : "") . " order by `name` asc");
                // Loop through the departments and create options
                while ($row = $department->fetch_assoc()):
                    ?>
                    <option value="<?= $row['id'] ?>" <?= isset($department_id) && $department_id == $row['id'] ? "selected" : "" ?>><?= ucwords($row['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>

        <!-- Name input field -->
        <div class="form-group">
            <label for="name" class="control-label">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-border"
                placeholder="Curriculum Name" value="<?php echo isset($name) ? $name : '' ?>" required>
        </div>

        <!-- Description textarea field -->
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <textarea rows="3" name="description" id="description" class="form-control form-control-border"
                placeholder="Write the Curriculum description here."
                required><?php echo isset($description) ? $description : '' ?></textarea>
        </div>

        <!-- Status selection dropdown -->
        <div class="form-group">
            <label for="" class="control-label">Status</label>
            <select name="status" id="status" class="form-control form-control-border" required>
                <option value="1" <?= isset($status) && $status == 1 ? "selected" : "" ?>>Active</option>
                <option value="0" <?= isset($status) && $status == 0 ? "selected" : "" ?>>Inactive</option>
            </select>
        </div>
    </form>
</div>

<script>
    $(function () {
        // Initialize the department dropdown with select2 for enhanced functionality
        $('#department_id').select2({
            width: "100%",
            dropdownParent: $("#uni_modal")  // Attach the dropdown to a specific modal container
        });

        // Handle form submission
        $('#uni_modal #curriculum-form').submit(function (e) {
            e.preventDefault();  // Prevent the default form submission
            var _this = $(this);  // Reference to the current form
            $('.pop-msg').remove();  // Remove any previous messages
            var el = $('<div>');  // Create a new div for displaying messages
            el.addClass("pop-msg alert");  // Add necessary classes for the alert
            el.hide();  // Hide the message initially

            start_loader();  // Start the loading animation

            // Make an AJAX request to save the curriculum
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_curriculum",  // URL to send the request
                data: new FormData($(this)[0]),  // Send form data using FormData (including file uploads)
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {  // Handle errors
                    console.log(err);
                    alert_toast("An error occurred", 'error');
                    end_loader();  // End the loading animation
                },
                success: function (resp) {  // Handle success response
                    if (resp.status == 'success') {  // If the operation was successful
                        location.reload();  // Reload the page
                    } else if (!!resp.msg) {  // If there is a specific message in the response
                        el.addClass("alert-danger");  // Add error styling
                        el.text(resp.msg);  // Set the message
                        _this.prepend(el);  // Prepend the message to the form
                    } else {  // If no specific message, show a generic error message
                        el.addClass("alert-danger");
                        el.text("An error occurred due to unknown reason.");
                        _this.prepend(el);
                    }
                    el.show('slow');  // Show the message with a slow animation
                    end_loader();  // End the loading animation
                }
            });
        });
    });
</script>