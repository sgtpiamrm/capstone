<style>
	/* Style for the student avatar image */
	.img-avatar {
		width: 45px;
		/* Set image width */
		height: 45px;
		/* Set image height */
		object-fit: cover;
		/* Ensures the image covers the element without distortion */
		object-position: center center;
		/* Center the image within the container */
		border-radius: 100%;
		/* Round the corners to make a circle */
	}
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h2 class="card-title"><b>List of Students</b></h2>
	</div>
	<div class="card-body">
		<table class="table table-hover table-striped">
			<!-- Table Headers -->
			<thead>
				<tr>
					<th>#</th>
					<th>Avatar</th>
					<th>Name</th>
					<th>Email</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// Fetch student data from the database
				$i = 1;
				$qry = $conn->query("SELECT *, concat(lastname,', ',firstname,' ', middlename) as name FROM student_list ORDER BY name ASC");
				while ($row = $qry->fetch_assoc()):
					?>
					<tr style="background-color: <?= ($i % 2 == 0) ? '#e6f7ff' : 'inherit' ?>;">
						<!-- Student Row -->
						<td class="text-center"><?php echo $i++; ?></td>
						<td class="text-center">
							<!-- Avatar Image -->
							<img src="<?php echo validate_image($row['avatar']) ?>"
								class="img-avatar img-thumbnail p-0 border-2" alt="user_avatar">
						</td>
						<td><?php echo ucwords($row['name']) ?></td>
						<td>
							<p class="m-0 truncate-1"><?php echo $row['email'] ?></p>
						</td>
						<td class="text-center">
							<!-- Display Status -->
							<?php if ($row['status'] == 1): ?>
								<span class="badge badge-pill badge-success">Verified</span>
							<?php else: ?>
								<span class="badge badge-pill badge-primary">Not Verified</span>
							<?php endif; ?>
						</td>
						<td align="center">
							<!-- Action Dropdown Menu -->
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
								data-toggle="dropdown">
								Action
							</button>
							<div class="dropdown-menu" role="menu">
								<!-- View Action -->
								<a class="dropdown-item view_details" href="javascript:void(0)"
									data-id="<?php echo $row['id'] ?>">
									<span class="fa fa-eye text-dark"></span> View
								</a>
								<div class="dropdown-divider"></div>
								<!-- Verify Action (if not already verified) -->
								<?php if ($row['status'] != 1): ?>
									<a class="dropdown-item verify_user" href="javascript:void(0)" data-id="<?= $row['id'] ?>"
										data-name="<?= $row['email'] ?>">
										<span class="fa fa-check text-primary"></span> Verify
									</a>
									<div class="dropdown-divider"></div>
								<?php endif; ?>
								<!-- Delete Action -->
								<a class="dropdown-item delete_data" href="javascript:void(0)"
									data-id="<?php echo $row['id'] ?>" data-name="<?= $row['email'] ?>">
									<span class="fa fa-trash text-danger"></span> Delete
								</a>
							</div>
						</td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
	$(document).ready(function () {
		// Confirm delete action
		$('.delete_data').click(function () {
			_conf("Are you sure to delete <b>" + $(this).attr('data-name') + "</b> from Student List permanently?", "delete_user", [$(this).attr('data-id')])
		});

		// Add padding and alignment to table cells
		$('.table td,.table th').addClass('py-1 px-2 align-middle');

		// Confirm verify action
		$('.verify_user').click(function () {
			_conf("Are you sure to verify <b>" + $(this).attr('data-name') + "<b/>?", "verify_user", [$(this).attr('data-id')])
		});

		// View details modal
		$('.view_details').click(function () {
			uni_modal('Student Details', "students/view_details.php?id=" + $(this).attr('data-id'), 'mid-large')
		});

		// Initialize DataTable for pagination and sorting
		$('.table').dataTable();
	});

	// Function to delete student via AJAX
	function delete_user($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Users.php?f=delete_student", // The URL for the delete action
			method: "POST",
			data: { id: $id }, // Sending student ID to delete
			dataType: "json",
			error: err => {
				console.log(err);
				alert_toast("An error occurred.", 'error');
				end_loader();
			},
			success: function (resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload(); // Reload page if deletion is successful
				} else {
					alert_toast("An error occurred.", 'error');
					end_loader();
				}
			}
		});
	}

	// Function to verify student via AJAX
	function verify_user($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Users.php?f=verify_student", // The URL for the verify action
			method: "POST",
			data: { id: $id }, // Sending student ID to verify
			dataType: "json",
			error: err => {
				console.log(err);
				alert_toast("An error occurred.", 'error');
				end_loader();
			},
			success: function (resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload(); // Reload page if verification is successful
				} else {
					alert_toast("An error occurred.", 'error');
					end_loader();
				}
			}
		});
	}

</script>