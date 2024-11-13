<style>
	/* Avatar image styling */
	.img-avatar {
		width: 45px;
		height: 45px;
		object-fit: cover;
		object-position: center center;
		border-radius: 100%;
		/* Circular avatar */
	}
</style>

<div class="card card-outline card-primary">
	<!-- Card Header with Title and Add New Department button -->
	<div class="card-header">
		<h2 class="card-title"><b>List of Department</b></h2>
		<div class="card-tools">
			<!-- Button to trigger create new department modal -->
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"
				style="border-radius: 3px;">
				<span class="fas fa-plus"></span> Add New Department
			</a>
		</div>
	</div>

	<div class="card-body">
		<!-- Main content container -->
		<div class="container-fluid">
			<div class="container-fluid">
				<!-- Table for displaying department list -->
				<table class="table table-hover table-striped">
					<colgroup>
						<!-- Define column widths -->
						<col width="5%">
						<col width="20%">
						<col width="20%">
						<col width="30%">
						<col width="15%">
						<col width="10%">
					</colgroup>

					<thead>
						<!-- Table header -->
						<tr>
							<th>#</th>
							<th>Date Created</th>
							<th>Name</th>
							<th>Description</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody>
						<?php
						// Initialize counter variable
						$i = 1;

						// Query database to get department list ordered by name
						$qry = $conn->query("SELECT * from `department_list` order by `name` asc ");

						// Loop through each department record
						while ($row = $qry->fetch_assoc()):
							?>

							<!-- Table row for each department record -->
							<tr style="background-color: <?= ($i % 2 == 0) ? '#e6f7ff' : 'inherit' ?>;">
								<td class="text-center"><?php echo $i++; ?></td>
								<td class=""><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
								<td><?php echo ucwords($row['name']) ?></td>
								<td class="truncate-1"><?php echo $row['description'] ?></td>
								<td class="text-center">
									<?php
									// Display status as Active or Inactive based on the status value
									switch ($row['status']) {
										case '1':
											echo "<span class='badge badge-success badge-pill'>Active</span>";
											break;
										case '0':
											echo "<span class='badge badge-secondary badge-pill'>Inactive</span>";
											break;
									}
									?>
								</td>
								<td align="center">
									<!-- Dropdown menu for Action options (View, Edit, Delete) -->
									<button type="button"
										class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
										data-toggle="dropdown">
										Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<!-- View option -->
										<a class="dropdown-item view_data" href="javascript:void(0)"
											data-id="<?php echo $row['id'] ?>">
											<span class="fa fa-eye text-dark"></span> View
										</a>
										<div class="dropdown-divider"></div>
										<!-- Edit option -->
										<a class="dropdown-item edit_data" href="javascript:void(0)"
											data-id="<?php echo $row['id'] ?>">
											<span class="fa fa-edit text-primary"></span> Edit
										</a>
										<div class="dropdown-divider"></div>
										<!-- Delete option -->
										<a class="dropdown-item delete_data" href="javascript:void(0)"
											data-id="<?php echo $row['id'] ?>">
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
	</div>
</div>

<script>
	$(document).ready(function () {
		// Trigger create new department modal on button click
		$('#create_new').click(function () {
			uni_modal("Department Details", "departments/manage_department.php")
		});

		// Trigger edit department modal with department ID
		$('.edit_data').click(function () {
			uni_modal("Department Details", "departments/manage_department.php?id=" + $(this).attr('data-id'))
		});

		// Confirm deletion and call delete function with department ID
		$('.delete_data').click(function () {
			_conf("Are you sure to delete this Department permanently?", "delete_department", [$(this).attr('data-id')])
		});

		// Trigger view department modal with department ID
		$('.view_data').click(function () {
			uni_modal("Department Details", "departments/view_department.php?id=" + $(this).attr('data-id'))
		});

		// Add styling to table cells
		$('.table td,.table th').addClass('py-1 px-2 align-middle');

		// Initialize DataTables with non-sortable Action column
		$('.table').dataTable({
			columnDefs: [
				{ orderable: false, targets: 5 }
			],
		});
	});

	// Function to delete department record
	function delete_department($id) {
		start_loader(); // Start loading animation

		// Send AJAX request to delete department
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_department",
			method: "POST",
			data: { id: $id },
			dataType: "json",

			// Handle AJAX error
			error: err => {
				console.log(err);
				alert_toast("An error occurred.", 'error');
				end_loader(); // End loading animation
			},

			// Handle successful deletion response
			success: function (resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload(); // Reload page on successful deletion
				} else {
					alert_toast("An error occurred.", 'error');
					end_loader();
				}
			}
		});
	}
</script>