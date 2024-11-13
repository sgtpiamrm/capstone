<div class="container-fluid">
    <!-- Form for updating the status of an item -->
    <form action="" id="update_status_form">
        <!-- Hidden input to store the item ID -->
        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : "" ?>">

        <!-- Dropdown to select publish status -->
        <div class="form-group">
            <label for="status" class="control-label text-navy">Status</label>
            <select name="status" id="status" class="form-control form-control-border" required>
                <option value="0" <?= isset($_GET['status']) && $_GET['status'] == 0 ? "selected" : "" ?>>UnPublish
                </option>
                <option value="1" <?= isset($_GET['status']) && $_GET['status'] == 1 ? "selected" : "" ?>>Publish</option>
            </select>
        </div>
    </form>
</div>

<script>
    $(function () {
        // Handle form submission with AJAX
        $('#update_status_form').submit(function (e) {
            e.preventDefault(); // Prevent default form submission
            start_loader(); // Start loading animation

            var el = $('<div>'); // Element for displaying messages
            el.addClass("pop-msg alert"); // Add alert classes for styling
            el.hide(); // Hide element initially

            // AJAX request to update the status
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=update_status", // Target URL
                method: "POST", // Use POST method
                data: $(this).serialize(), // Serialize form data
                dataType: "json", // Expect JSON response
                error: err => { // Handle error response
                    console.log(err);
                    alert_toast("An error occurred while saving the data.", "error"); // Show error message
                    end_loader(); // End loading animation
                },
                success: function (resp) { // Handle successful response
                    if (resp.status == 'success') { // If status is success
                        location.reload(); // Reload page
                    } else if (!!resp.msg) { // If there's a specific error message
                        el.addClass("alert-danger"); // Add error styling
                        el.text(resp.msg); // Display error message
                        _this.prepend(el); // Prepend message to form
                    } else { // If there's an unknown error
                        el.addClass("alert-danger"); // Add error styling
                        el.text("An error occurred due to unknown reason."); // Display general error message
                        _this.prepend(el); // Prepend message to form
                    }
                    el.show('slow'); // Show message slowly
                    end_loader(); // End loading animation
                }
            });
        });
    });
</script>