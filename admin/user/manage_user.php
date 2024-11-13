<?php
// Check if 'id' is set in the GET request and greater than 0
if (isset($_GET['id']) && $_GET['id'] > 0) {
	// Query the database for the user based on the provided id
	$user = $conn->query("SELECT * FROM users where id ='{$_GET['id']}'");
	// Fetch user data and store it in the $meta array
	foreach ($user->fetch_array() as $k => $v) {
		$meta[$k] = $v;
	}
}
?>
<?php if ($_settings->chk_flashdata('success')): ?>
	<!-- Display a success toast message if flash data for 'success' is set -->
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>

<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div> <!-- Display error or success messages here -->
			<form action="" id="manage-user">
				<!-- Hidden input for user ID (if editing an existing user) -->
				<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id'] : '' ?>">

				<!-- Input field for the user's first name -->
				<div class="form-group col-6">
					<label for="name">First Name</label>
					<input type="text" name="firstname" id="firstname" class="form-control"
						value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : '' ?>" required>
				</div>

				<!-- Input field for the user's last name -->
				<div class="form-group col-6">
					<label for="name">Last Name</label>
					<input type="text" name="lastname" id="lastname" class="form-control"
						value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : '' ?>" required>
				</div>

				<!-- Input field for the user's username -->
				<div class="form-group col-6">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control"
						value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required
						autocomplete="off">
				</div>

				<!-- Input field for the user's password (optional for existing users) -->
				<div class="form-group col-6">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" value=""
						autocomplete="off" <?php echo isset($meta['id']) ? "" : 'required' ?>>
					<?php if (isset($_GET['id'])): ?>
						<small class="text-info"><i>Leave this blank if you don't want to change the password.</i></small>
					<?php endif; ?>
				</div>

				<!-- Dropdown for selecting user type (Administrator or Staff) -->
				<div class="form-group col-6">
					<label for="type">User Type</label>
					<select name="type" id="type" class="custom-select" required>
						<option value="1" <?php echo isset($meta['type']) && $meta['type'] == 1 ? 'selected' : '' ?>>
							Administrator</option>
						<option value="2" <?php echo isset($meta['type']) && $meta['type'] == 2 ? 'selected' : '' ?>>Staff
						</option>
					</select>
				</div>

				<!-- Avatar upload section -->
				<div class="form-group col-6">
					<label for="" class="control-label">Avatar</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img"
							onchange="displayImg(this,$(this))">
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
				</div>

				<!-- Display selected avatar image -->
				<div class="form-group col-6 d-flex justify-content-center">
					<img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] : '') ?>" alt=""
						id="cimg" class="img-fluid img-thumbnail">
				</div>
			</form>
		</div>
	</div>

	<div class="card-footer">
		<div class="col-md-12">
			<div class="row">
				<!-- Save button that submits the form -->
				<button class="btn btn-sm btn-primary mr-2" form="manage-user">Save</button>
				<!-- Cancel button that redirects to the user list page -->
				<a class="btn btn-sm btn-secondary" href="./?page=user/list">Cancel</a>
			</div>
		</div>
	</div>
</div>

<style>
	/* Styling for the avatar image display */
	img#cimg {
		height: 15vh;
		/* Set the height of the image */
		width: 15vh;
		/* Set the width of the image */
		object-fit: cover;
		/* Ensure the image covers the container area */
		border-radius: 100%;
		/* Make the image circular */
	}
</style>

<script>
	$(function () {
		// Initialize the Select2 dropdown for user type selection (optional feature for select customization)
		$('.select2').select2({
			width: 'resolve' // Auto-resolve width for the select box
		})
	})

	// Function to display the selected avatar image
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				// Set the source of the avatar image to the selected file
				$('#cimg').attr('src', e.target.result);
			}

			// Read the selected file as a Data URL (base64)
			reader.readAsDataURL(input.files[0]);
		}
	}

	// Handle form submission via AJAX
	$('#manage-user').submit(function (e) {
		e.preventDefault(); // Prevent default form submission
		var _this = $(this)
		start_loader() // Start loading indicator

		$.ajax({
			url: _base_url_ + 'classes/Users.php?f=save', // URL for the save request
			data: new FormData($(this)[0]), // Send form data, including files
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function (resp) {
				if (resp == 1) {
					// If the user is successfully saved, redirect to the user list page
					location.href = './?page=user/list';
				} else {
					// Display error message if the username already exists
					$('#msg').html('<div class="alert alert-danger">Username already exists</div>')
					$("html, body").animate({ scrollTop: 0 }, "fast"); // Scroll to the top
				}
				end_loader() // End loading indicator
			}
		})
	})
</script>