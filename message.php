<style>
    /* Hide the modal footer in the modal with id 'uni_modal' */
    #uni_modal .modal-footer {
        display: none;
    }
</style>

<div class="container">
    <!-- Message to confirm successful enrollment submission -->
    <p>Your Driving School Enrollment has successfully submitted and will confirm you as soon as we sees your
        application.
        <?php if (isset($_GET['reg_no'])): ?>
            <!-- Display registration number if available in the URL -->
            Your registration # is <b><?= $_GET['reg_no'] ?></b>.
        <?php endif; ?>
        Thank you!
    </p>

    <div class="text-right">
        <!-- Close button to dismiss the modal -->
        <button class="btn btn-sm btn-flat btn-dark" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
    </div>
</div>