<style>
	/* Style for avatar image, setting width, height, and rounding to make it circular */
	.img-avatar {
		width: 45px;
		height: 45px;
		object-fit: cover;
		object-position: center center;
		border-radius: 100%;
	}
</style>

<div class="card card-outline card-primary">
	<!-- Card header with title and "Add New Curriculum" button -->
	<div class="card-header">
		<h2 class="card-title"><b> List of Curriculum</b></h2>
		<div class="card-tools">
			<!-- Button to open form for creating new curriculum -->
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"
				style="border-radius: 3px;"><span class="fas fa-plus"></span> Add New Curriculum</a>
		</div>
	</div>

	<!-- Card body containing curriculum list table -->
	<div class="card-body">
		<div class="container-fluid">
			<div class="container-fluid">
				<!-- Table to display curriculum details -->
				<table class="table table-hover table-striped">
					<colgroup>
						<!-- Column width settings for table -->
						<col width="5%">
						<col width="20%">
						<col width="25%">
						<col width="25%">
						<col width="15%">
						<col width="10%">
					</colgroup>
					<thead>
						<!-- Table headers for curriculum information -->
						<tr>
							<th>#</th>
							<th>Date Created</th>
							<th>Curriculum</th>
							<th>Name</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						/* SQL query to get curriculum data, joining with department data */
						$qry = $conn->query("SELECT c.*, d.name as department from `curriculum_list` c inner join `department_list` d on c.department_id = d.id order by c.`name` asc");
						while ($row = $qry->fetch_assoc()):
							?>
							<!-- Table row for each curriculum, alternating background color based on row number -->
							<tr style="background-color: <?= ($i % 2 == 0) ? '#e6f7ff' : 'inherit' ?>;">
								<td class="text-center"><?php echo $i++; ?></td>
								<!-- Display formatted creation date -->
								<td class=""><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
								<td class=""><?php echo $row['department'] ?></td>
								<td><?php echo ucwords($row['name']) ?></td>
								<td class="text-center">
									<?php
									/* Display status badge based on the status value */
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
									<!-- Action button with dropdown for view, edit, and delete options -->
									<button type="button"
										class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon"
										data-toggle="dropdown">
										Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<!-- Option to view curriculum details -->
										<a class="dropdown-item view_data" href="javascript:void(0)"
											data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span>
											View</a>
										<div class="dropdown-divider"></div>
										<!-- Option to edit curriculum details -->
										<a class="dropdown-item edit_data" href="javascript:void(0)"
											data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span>
											Edit</a>
										<div class="dropdown-divider"></div>
										<!-- Option to delete curriculum -->
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
		/* Opens modal for creating a new curriculum */
		$('#create_new').click(function () {
			uni_modal("Curriculum Details", "curriculum/manage_curriculum.php")
		})

		/* Opens edit modal for selected curriculum based on data-id */
		$('.edit_data').click(function () {
			uni_modal("Curriculum Details", "curriculum/manage_curriculum.php?id=" + $(this).attr('data-id'))
		})

		/* Confirms deletion of selected curriculum based on data-id */
		$('.delete_data').click(function () {
			_conf("Are you sure to delete this Curriculum permanently?", "delete_curriculum", [$(this).attr('data-id')])
		})

		/* Opens view modal for selected curriculum based on data-id */
		$('.view_data').click(function () {
			uni_modal("curriculum Details", "curriculum/view_curriculum.php?id=" + $(this).attr('data-id'))
		})

		/* Adds padding and alignment classes to table cells and headers */
		$('.table td,.table th').addClass('py-1 px-2 align-middle')

		/* Initializes DataTable with settings to disable sorting on the 'Action' column */
		$('.table').dataTable({
			columnDefs: [
				{ orderable: false, targets: 5 }
			],
		});
	})

	/* Function to delete curriculum via AJAX and reload page on success */
	function delete_curriculum($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_curriculum",
			method: "POST",
			data: { id: $id },
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function (resp) {
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