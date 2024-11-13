<?php
// Check if enrollee ID is provided
if (isset($_GET['id'])) {
    // Query to get enrollee details, join with package details
    $qry = $conn->query("SELECT e.*,CONCAT(lastname, ', ', firstname,' ',middlename) as fullname,p.name,p.description,p.training_duration from `enrollee_list` e inner join package_list p on e.package_id = p.id where e.id = '{$_GET['id']}'");

    // If enrollee record found, fetch the details
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();

        // Assign fetched values to variables
        foreach ($res as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    }
}

// Initialize balance variable
$balance = isset($cost) ? $cost : 0;
?>
<div class="container-fluid">
    <!-- Card displaying enrollee details -->
    <div class="card card-outline card-navy rounded-0 shadow">
        <div class="card-header rounded-0">
            <h5 class="card-title">Enrollee's Details</h5>
        </div>
        <div class="card-body rounded-0">
            <div id="outprint">
                <div class="row">
                    <!-- Left column with personal details -->
                    <div class="col-md-6">
                        <dl>
                            <dt class="text-muted">Full Name</dt>
                            <dd class='pl-4 fs-4 fw-bold'><?= isset($fullname) ? $fullname : '' ?></dd>
                            <dt class="text-muted">Gender</dt>
                            <dd class='pl-4 fs-4 fw-bold'><?= isset($gender) ? $gender : '' ?></dd>
                            <dt class="text-muted">Birthday</dt>
                            <dd class='pl-4 fs-4 fw-bold'><?= isset($dob) ? date("M d, Y", strtotime($dob)) : '' ?></dd>
                            <dt class="text-muted">Contact</dt>
                            <dd class='pl-4 fs-4 fw-bold'><?= isset($contact) ? $contact : '' ?></dd>
                            <dt class="text-muted">Email</dt>
                            <dd class='pl-4 fs-4 fw-bold'><?= isset($email) ? $email : '' ?></dd>
                            <dt class="text-muted">Address</dt>
                            <dd class='pl-4 fs-4 fw-bold'><?= isset($address) ? $address : '' ?></dd>
                        </dl>
                    </div>

                    <!-- Right column with package details -->
                    <div class="col-md-6">
                        <dl>
                            <dt class="text-muted">Training Package</dt>
                            <dd class='pl-4 text-dark'><?= isset($name) ? $name : '' ?></dd>
                            <dt class="text-muted">Description</dt>
                            <dd class='pl-4 text-dark'>
                                <p class="m-0"><small><?= isset($description) ? $description : '' ?></small></p>
                            </dd>
                            <dt class="text-muted">Cost</dt>
                            <dd class='pl-4 text-dark'><?= isset($cost) ? number_format($cost, 2) : '0.00' ?></dd>
                            <dt class="text-muted">Training Duration</dt>
                            <dd class='pl-4 text-dark'><?= isset($training_duration) ? $training_duration : '' ?></dd>
                            <dt class="text-muted">Status</dt>
                            <dd class='pl-4 text-dark'>
                                <!-- Display status with different badges based on enrollee status -->
                                <?php
                                if (isset($status)):
                                    switch ($status) {
                                        case '1':
                                            echo "<span class='badge badge-primary badge-pill'>Verified</span>";
                                            break;
                                        case '2':
                                            echo "<span class='badge badge-warning badge-pill'>In-Session</span>";
                                            break;
                                        case '3':
                                            echo "<span class='badge badge-success badge-pill'>Completed</span>";
                                            break;
                                        case '4':
                                            echo "<span class='badge badge-danger badge-pill'>Cancelled</span>";
                                            break;
                                        case '0':
                                            echo "<span class='badge badge-light badge-pill text-dark border'>Pending</span>";
                                            break;
                                    }
                                endif;
                                ?>
                            </dd>
                        </dl>
                    </div>
                </div>

                <!-- Display payment history if status is between 1 and 3 -->
                <?php if (in_array($status, range(1, 3))): ?>
                    <fieldset>
                        <legend class="text-navy">Payment History</legend>
                        <hr class="bg-navy border-navy">
                        <table class="table table-hover table-striped table-bordered" id="payment-list">
                            <colgroup>
                                <col width="20%">
                                <col width="30%">
                                <col width="20%">
                                <col width="20%">
                                <col width="10%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center py-1">DateTime</th>
                                    <th class="text-center py-1">Remarks</th>
                                    <th class="text-center py-1">Paid Amount</th>
                                    <th class="text-center py-1">Balance</th>
                                    <th class="text-center py-1">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through payments for the enrollee -->
                                <?php
                                $payments = $conn->query("SELECT * FROM `payment_list` where enrollee_id ='{$id}' order by unix_timestamp(date_created) asc ");
                                while ($row = $payments->fetch_assoc()):
                                    $balance -= $row['amount'];
                                    ?>
                                    <tr>
                                        <td class="py-1 px-2"><?= date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                        <td class="py-1 px-2"><?= ($row['remarks']) ?></td>
                                        <td class="py-1 px-2 text-right"><?= number_format($row['amount'], 2) ?></td>
                                        <td class="py-1 px-2 text-right"><?= number_format($balance, 2) ?></td>
                                        <td class="py-1 px-2 text-center">
                                            <button class="btn btn-sm btn-flat btn-danger delete_payment"
                                                data-id="<?= $row['id'] ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </fieldset>
                <?php endif; ?>
            </div>
        </div>
        <!-- Card footer with buttons for actions -->
        <div class="card-footer rounded-0 text-center">
            <button class="btn btn-sm btn-primary btn-flat" type="button" id="update_status"><i class="fa fa-save"></i>
                Update Status</button>
            <button class="btn btn-sm btn-light border btn-flat" type="button" id="payment"><i class="fa fa-plus"></i>
                Payment</button>
            <button class="btn btn-sm btn-success btn-flat" type="button" id="print"><i class="fa fa-print"></i>
                Print</button>
        </div>
    </div>
</div>

<script>
    $(function () {
        // Open modal for updating status
        $('#update_status').click(function () {
            uni_modal("Update Details", "enrollees/update_status.php?id=<?= $id ?>&status=<?= $status ?>");
        });

        // Open modal for new payment
        $('#payment').click(function () {
            uni_modal("New Payment", "enrollees/payment.php?id=<?= $id ?>&balance=<?= $balance ?>");
        });

        // Confirm delete action for payment
        $('.delete_payment').click(function () {
            _conf("Are you sure to delete this payment permanently?", "delete_payment", [$(this).attr('data-id')]);
        });

        // Print enrollee details
        $('#print').click(function () {
            var _h = $("head").clone(); // Clone head for print view
            var _p = $('#outprint').clone(); // Clone content to print
            var el = $("<div>"); // Container for print view
            start_loader(); // Start loading animation

            // Add required scripts to print view
            $('script').each(function () {
                if (_h.find('script[src="' + $(this).attr('src') + '"]').length <= 0) {
                    _h.append($(this).clone());
                }
            });

            // Set document title for print view
            _h.find('title').text("Enrollee's Details - Print View");

            // Add header content for print view
            _p.prepend("<hr class='border-navy bg-navy'>");
            _p.prepend("<div class='mx-5 py-4'><h1 class='text-center'><?= $_settings->info("name") ?></h1>"
                + "<h5 class='text-center'>Enrollee Details</h5></div>");
            _p.prepend("<img src='<?= validate_image($_settings->info('logo')) ?>' id='print-logo' />");
            _p.find("th:nth-child(5), td:nth-child(5)").remove(); // Remove action column

            // Append head and content to new window for printing
            el.append(_h);
            el.append(_p);

            var nw = window.open("", "_blank", "height=800,width=1200,left=200");
            nw.document.write(el.html());
            nw.document.close();
            setTimeout(() => {
                nw.print();
                setTimeout(() => {
                    nw.close();
                    end_loader(); // End loading animation
                }, 300);
            }, 300);
        });
    });

    // Function to delete payment entry
    function delete_payment($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_payment",
            method: "POST",
            data: { id: $id },
            dataType: "json",
            error: err => {
                console.log(err);
                alert_toast("An error occurred.", 'error');
                end_loader();
            },
            success: function (resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occurred.", 'error');
                    end_loader();
                }
            }
        });
    }
</script>