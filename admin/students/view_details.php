<?php
require_once('../../config.php');
if (isset($_GET['id']) && $_GET['id'] > 0) {
	$user = $conn->query("SELECT s.*, d.name as department, c.name as curriculum, CONCAT(lastname,', ',firstname,' ',middlename) as fullname 
	                      FROM student_list s 
	                      INNER JOIN department_list d ON s.department_id = d.id 
	                      INNER JOIN curriculum_list c ON s.curriculum_id = c.id 
	                      WHERE s.id ='{$_GET['id']}'");

	foreach ($user->fetch_array() as $k => $v) {
		$$k = $v; // Dynamically setting variables based on database keys
	}
}

?>
<style>
	#uni_modal .modal-footer {
		display: none;
		/* Hides the modal footer */
	}

	.student-img {
		object-fit: scale-down;
		/* Ensures the image scales down without distortion */
		object-position: center center;
		/* Centers the image in the container */
	}
</style>
<div class="container-fluid">
	<div class="col-md-12">
		<div class="row">
			<!-- Student Image Section -->
			<div class="col-6">
				<center>
					<img src="<?= validate_image($avatar) ?>" alt="Student Image"
						class="img-fluid student-img bg-gradient-dark border">
				</center>
			</div>
			<!-- Student Info Section -->
			<div class="col-6">
				<dl>
					<dt class="text-navy">Student Name:</dt>
					<dd class="pl-4"><?= ucwords($fullname) ?></dd>
					<dt class="text-navy">Gender:</dt>
					<dd class="pl-4"><?= ucwords($gender) ?></dd>
					<dt class="text-navy">Email:</dt>
					<dd class="pl-4"><?= $email ?></dd>
					<dt class="text-navy">Department:</dt>
					<dd class="pl-4"><?= ucwords($department) ?></dd>
					<dt class="text-navy">Curriculum:</dt>
					<dd class="pl-4"><?= ucwords($curriculum) ?></dd>
					<dt class="text-navy">System Account Status:</dt>
					<dd class="pl-4">
						<?php if ($status == 1): ?>
							<span class="badge badge-pill"
								style="background-color: green; color: white; padding: 5px 10px;">Verified</span>
						<?php else: ?>
							<span class="badge badge-pill"
								style="background-color: blue; color: white; padding: 5px 10px;">Not Verified</span>
						<?php endif; ?>
					</dd>
				</dl>
			</div>
		</div>
		<!-- Close Button -->
		<div class="row">
			<div class="col-12 text-right">
				<button class="btn btn-dark btn-sm" style="border-radius: 3px;" data-dismiss="modal" type="button">
					<i class="fa fa-times"></i> Close
				</button>
			</div>
		</div>
	</div>
</div>