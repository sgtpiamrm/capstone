<div class="container-fluid">
    <!-- Form for saving payment details -->
    <form action="" id="save_payment">
        <!-- Hidden input to store enrollee ID -->
        <input type="hidden" name="enrollee_id" value="<?= isset($_GET['id']) ? $_GET['id'] : "" ?>">

        <!-- Display balance information -->
        <div class="form-group">
            <center><span class="text-center">Balance</span></center>
            <h3 class="text-center"><b><?= isset($_GET["balance"]) ? number_format($_GET["balance"], 2) : "0.00" ?></b>
            </h3>
        </div>

        <!-- Input field for amount -->
        <div class="form-group">
            <label for="amount" class="control-label text-navy">Amount</label>
            <input type="number" name="amount" max="<?= isset($_GET["balance"]) ? ($_GET["balance"]) : 0 ?>" id="amount"
                class="form-control form-control-border border-navy text-right" required>
        </div>

        <!-- Textarea for remarks -->
        <div class="form-group">
            <label for="remarks" class="control-label text-navy">Remarks</label>
            <textarea rows="2" name="remarks" id="remarks"
                class="form-control form-control-border border-navy text-right" required></textarea>
        </div>
    </form>
</div>

<script>
    $(function () {
        // Handle form submission with AJAX
        $('#save_payment').submit(function (e) {
            e.preventDefault(); // Prevent default form submission
            start_loader(); // Start loading animation

            var el = $('<div>'); // Element for displaying messages
            el.addClass("pop-msg alert"); // Add alert classes for styling
            el.hide(); // Hide element initially

            // AJAX request to save payment
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_payment", // Target URL
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