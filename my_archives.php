<div class="content py-3">
    <!-- Container for displaying the submitted projects -->
    <div class="container-fluid">
        <!-- Card element for the "My Submitted Projects" section -->
        <div class="card card-outline card-primary shadow rounded-0">
            <div class="card-header rounded-0">
                <!-- Title of the card -->
                <h4 class="card-title">My Submitted Projects</h4>
            </div>
            <div class="card-body rounded-0">
                <!-- Table displaying the list of submitted projects -->
                <div class="container-fluid">
                    <table class="table table-hover table-striped">
                        <!-- Define table column sizes -->
                        <colgroup>
                            <col width="5%">
                            <col width="15%">
                            <col width="15%">
                            <col width="20%">
                            <col width="20%">
                            <col width="10%">
                            <col width="10%">
                        </colgroup>
                        <!-- Table header with column names -->
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date Created</th>
                                <th>Archive Code</th>
                                <th>Project Title</th>
                                <th>Curriculum</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- Table body populated with project data -->
                        <tbody>
                            <?php
                            $i = 1;
                            // Fetch curriculum names for projects
                            $curriculum = $conn->query("SELECT * FROM curriculum_list where id in (SELECT curriculum_id from `archive_list` where student_id = '{$_settings->userdata('id')}' )");
                            $cur_arr = array_column($curriculum->fetch_all(MYSQLI_ASSOC), 'name', 'id');
                            // Fetch the list of projects submitted by the student
                            $qry = $conn->query("SELECT * from `archive_list` where student_id = '{$_settings->userdata('id')}' order by unix_timestamp(`date_created`) asc ");
                            while ($row = $qry->fetch_assoc()):
                                ?>
                                <tr>
                                    <!-- Display project number -->
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <!-- Display the project creation date -->
                                    <td class=""><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                                    <!-- Display the project archive code -->
                                    <td><?php echo ($row['archive_code']) ?></td>
                                    <!-- Display the project title -->
                                    <td><?php echo ucwords($row['title']) ?></td>
                                    <!-- Display the associated curriculum -->
                                    <td><?php echo $cur_arr[$row['curriculum_id']] ?></td>
                                    <!-- Display the project status with badges -->
                                    <td class="text-center">
                                        <?php
                                        switch ($row['status']) {
                                            case '1':
                                                echo "<span class='badge badge-success badge-pill'>Published</span>";
                                                break;
                                            case '0':
                                                echo "<span class='badge badge-secondary badge-pill'>Not Published</span>";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <!-- Action buttons (View and Delete) -->
                                    <td align="center">
                                        <button type="button"
                                            class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">
                                            Action
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <!-- View project link -->
                                            <a class="dropdown-item"
                                                href="<?= base_url ?>/?page=view_archive&id=<?php echo $row['id'] ?>"
                                                target="_blank"><span class="fa fa-external-link-alt text-gray"></span>
                                                View</a>
                                            <div class="dropdown-divider"></div>
                                            <!-- Delete project action -->
                                            <a class="dropdown-item delete_data" href="javascript:void(0)"
                                                data-id="<?php echo $row['id'] ?>"><span
                                                    class="fa fa-trash text-danger"></span> Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        // Handle the click event for the delete action
        $('.delete_data').click(function () {
            _conf("Are you sure to delete this project permanently?", "delete_archive", [$(this).attr('data-id')])
        })

        // Add padding and alignment to table cells
        $('.table td,.table th').addClass('py-1 px-2 align-middle')

        // Initialize DataTable functionality for the table
        $('.table').dataTable({
            columnDefs: [
                // Disable sorting for the Action column (column index 5)
                { orderable: false, targets: 5 }
            ],
        });
    })

    // Function to handle project deletion
    function delete_archive($id) {
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=delete_archive",
            method: "POST",
            data: { id: $id },
            dataType: "json",
            error: err => {
                console.log(err)
                alert_toast("An error occured.", 'error');
                end_loader();
            },
            success: function (resp) {
                // If deletion is successful, reload the page
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.reload();
                } else {
                    alert_toast("An error occured.", 'error');
                    end_loader();
                }
            }
        })
    }
</script>