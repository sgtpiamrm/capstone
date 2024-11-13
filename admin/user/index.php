<?php
// Fetch user data from the database where the user ID matches the logged-in user's ID
$user = $conn->query("SELECT * FROM users where id ='" . $_settings->userdata('id') . "'");
foreach ($user->fetch_array() as $k => $v) {
	$meta[$k] = $v; // Store user data into an array
}
?>

<?php if ($_settings->chk_flashdata('success')): ?>
	<!-- Display success message if 'success' flashdata is set -->
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>

<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<!-- Display any messages -->
			<div id="msg"></div>

			<!-- User management form -->
			<form action="" id="manage-user">
				<!-- Hidden field to pass user ID -->
				<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">

				<!-- First Name input field -->
				<div class="form-group">
					<label for="firstname">First Name</label>
					<input type="text" name="firstname" id="firstname" class="form-control"
						value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : '' ?>" required>
				</div>

				<!-- Last Name input field -->
				<div class="form-group">
					<label for="lastname">Last Name</label>
					<input type="text" name="lastname" id="lastname" class="form-control"
						value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : '' ?>" required>
				</div>

				<!-- Username input field -->
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control"
						value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required
						autocomplete="off">
				</div>

				<!-- Password input field (with optional blank entry) -->
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" value=""
						autocomplete="off">
					<small><i>Leave this blank if you don't want to change the password.</i></small>
				</div>

				<!-- Avatar (Profile Image) upload input -->
				<div class="form-group">
					<label for="" class="control-label">Avatar</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img"
							onchange="displayImg(this,$(this))">
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
				</div>

				<!-- Avatar image preview -->
				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] : '') ?>" alt=""
						id="cimg" class="img-fluid img-thumbnail">
				</div>
			</form>
		</div>
	</div>

	<!-- Update button to submit the form -->
	<div class="card-footer">
		<div class="col-md-12">
			<div class="row">
				<button class="btn btn-sm btn-primary" form="manage-user">Update</button>
			</div>
		</div>
	</div>
</div>

<style>
	/* Styling for the Avatar image */
	img#cimg {
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		/* Ensure the image covers the container */
		border-radius: 100% 100%;
		/* Circular border radius */
	}
</style>

<script>
	// Function to display selected image as avatar
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg').attr('src', e.target.result); // Update image preview
			}

			reader.readAsDataURL(input.files[0]); // Read the selected file as a data URL
		}
	}

	// Form submission handler
	$('#manage-user').submit(function (e) {
		e.preventDefault(); // Prevent default form submission
		var _this = $(this); // Store reference to the form
		start_loader(); // Start the loader animation

		// AJAX request to save user details
		$.ajax({
			url: _base_url_ + 'classes/Users.php?f=save', // Request URL
			data: new FormData($(this)[0]), // Send form data including file inputs
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function (resp) {
				if (resp == 1) { // If save is successful
					location.reload(); // Reload the page
				} else { // If there is an error
					$('#msg').html('<div class="alert alert-danger">Username already exists</div>'); // Display error message
					end_loader(); // End the loader animation
				}
			}
		});
	});
</script>