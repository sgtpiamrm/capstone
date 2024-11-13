<style>
	/* Avatar image styling */
	.img-avatar {
		width: 45px;
		height: 45px;
		object-fit: cover;
		object-position: center center;
		border-radius: 100%;
	}
</style>

<!-- Card container for thesis archives list -->
<div class="card card-outline card-primary">
	<!-- Card header with title -->
	<div class="card-header">
		<h2 class="card-title"><b>List of Thesis Archives</b></h2>
	</div>

	<!-- Card body containing the table of thesis archives -->
	<div class="card-body">
		<div class="container-fluid">
			<div class="container-fluid">
				<!-- Table to display archive entries -->
				<table class="table table-hover table-striped">
					<colgroup>
						<!-- Define column widths for table -->
						<col width="5%">
						<col width="15%">
						<col width="15%">
						<col width="20%">
						<col width="20%">
						<col width="10%">
						<col width="10%">
					</colgroup>
					<thead>
						<!-- Table headers for archive attributes -->
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
					<tbody>
						<?php
						$i = 1; // Initialize row counter
						
						/* Fetch curriculum list related to archive entries */
						$curriculum = $conn->query("SELECT * FROM curriculum_list where id in (SELECT curriculum_id from `archive_list`)");
						$cur_arr = array_column($curriculum->fetch_all(MYSQLI_ASSOC), 'name', 'id');

						/* Query to fetch archive list ordered by year and title */
						$qry = $conn->query("SELECT * from `archive_list` order by `year` desc, `title` desc ");
						while ($row = $qry->fetch_assoc()): // Loop through each archive entry
							?>
							<!-- Table row for each archive entry -->
							<tr style="background-color: <?= ($i % 2 == 0) ? '#e6f7ff' : 'inherit' ?>;">
								<td class="text-center"><?php echo $i++; ?></td>
								<!-- Display formatted date of creation -->
								<td class=""><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
								<td><?php echo ($row['archive_code']) ?></td> <!-- Archive code -->
								<td><?php echo ucwords($row['title']) ?></td> <!-- Project title -->
								<td><?php echo $cur_arr[$row['curriculum_id']] ?></td> <!-- Curriculum name -->
								<td class="text-center">
									<?php
									/* Display archive status badge */
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
								<td align="center">
									<!-- Action button with dropdown menu -->
									<button type="button"
										class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
										data-toggle="dropdown">
										Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<!-- Link to view archive details -->
										<a class="dropdown-item"
											href="<?= base_url ?>/?page=view_archive&id=<?php echo $row['id'] ?>"
											target="_blank"><span class="fa fa-external-link-alt text-gray"></span> View</a>
										<div class="dropdown-divider"></div>
										<!-- Link to update archive status -->
										<a class="dropdown-item update_status" href="javascript:void(0)"
											data-id="<?php echo $row['id'] ?>"
											data-status="<?php echo $row['status'] ?>"><span
												class="fa fa-check text-dark"></span> Update Status</a>
										<div class="dropdown-divider"></div>
										<!-- Link to delete archive entry -->
										<a class="dropdown-item delete_data" href="javascript:void(0)"
											data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span>
											Delete</a>
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
		/* Confirm dialog for verifying enrollee request */
		$('.verified').click(function () {
			_conf("Are you sure to verify this enrollee Request?", "verified", [$(this).attr('data-id')])
		})

		/* Confirm dialog for deleting an archive entry */
		$('.delete_data').click(function () {
			_conf("Are you sure to delete this project permanently?", "delete_archive", [$(this).attr('data-id')])
		})

		/* Open modal to update archive status */
		$('.update_status').click(function () {
			uni_modal("Update Details", "archives/update_status.php?id=" + $(this).attr('data-id') + "&status=" + $(this).attr('data-status'))
		})

		/* Add padding and alignment to table cells and headers */
		$('.table td,.table th').addClass('py-1 px-2 align-middle')

		/* Initialize DataTable with sorting disabled on 'Action' column */
		$('.table').dataTable({
			columnDefs: [
				{ orderable: false, targets: 5 }
			],
		});
	})

	/* Function to delete an archive entry via AJAX */
	function delete_archive($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_archive",
			method: "POST",
			data: { id: $id }, // Send archive ID to delete
			dataType: "json",
			error: err => {
				console.log(err) // Log error in console
				alert_toast("An error occured.", 'error'); // Display error toast
				end_loader();
			},
			success: function (resp) {
				/* Reload page if delete successful, show error if failed */
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