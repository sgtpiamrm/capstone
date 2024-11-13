<?php if ($_settings->chk_flashdata('success')): ?>
	<!-- Display success message if there's a flashdata 'success' -->
	<script>alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')</script>
<?php endif; ?>

<style>
	/* Styling for the system logo image */
	img#cimg {
		height: 15vh;
		width: 15vh;
		object-fit: scale-down;
		border-radius: 100% 100%;
	}

	/* Styling for the system cover image */
	img#cimg2 {
		height: 50vh;
		width: 100%;
		object-fit: contain;
		/* border-radius: 100% 100%; */
	}
</style>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-header">
			<h2 class="card-title"><b>System Information</b></h2> <!-- Header of the section -->
		</div>
		<div class="card-body">
			<form action="" id="system-frm"> <!-- Form to update system info -->
				<div id="msg" class="form-group"></div> <!-- Message container -->

				<!-- System Name input field -->
				<div class="form-group">
					<label for="name" class="control-label">System Name</label>
					<input type="text" class="form-control form-control-sm" name="name" id="name"
						value="<?php echo $_settings->info('name') ?>">
				</div>

				<!-- System Short Name input field -->
				<div class="form-group">
					<label for="short_name" class="control-label">System Short Name</label>
					<input type="text" class="form-control form-control-sm" name="short_name" id="short_name"
						value="<?php echo $_settings->info('short_name') ?>">
				</div>

				<!-- Welcome content input field (textarea) -->
				<div class="form-group">
					<label for="content[about_us]" class="control-label">Welcome Content</label>
					<textarea type="text" class="form-control form-control-sm summernote" name="content[welcome]"
						id="welcome"><?php echo is_file(base_app . 'welcome.html') ? file_get_contents(base_app . 'welcome.html') : '' ?></textarea>
				</div>

				<!-- About Us content input field (textarea) -->
				<div class="form-group">
					<label for="content[about_us]" class="control-label">About Us</label>
					<textarea type="text" class="form-control form-control-sm summernote" name="content[about_us]"
						id="about_us"><?php echo is_file(base_app . 'about_us.html') ? file_get_contents(base_app . 'about_us.html') : '' ?></textarea>
				</div>

				<!-- System Logo upload input -->
				<div class="form-group">
					<label for="" class="control-label">System Logo</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img"
							onchange="displayImg(this)">
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
				</div>

				<!-- Display the system logo image -->
				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" id="cimg"
						class="img-fluid img-thumbnail">
				</div>

				<!-- Cover image upload input -->
				<div class="form-group">
					<label for="" class="control-label">Cover</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input rounded-circle" id="customFile" name="cover"
							onchange="displayImg2(this)">
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
				</div>

				<!-- Display the cover image -->
				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo validate_image($_settings->info('cover')) ?>" alt="" id="cimg2"
						class="img-fluid img-thumbnail bg-gradient-dark border-dark">
				</div>

				<!-- School information section -->
				<fieldset>
					<legend>School Information</legend>

					<!-- Email input field -->
					<div class="form-group">
						<label for="email" class="control-label">Email</label>
						<input type="email" class="form-control form-control-sm" name="email" id="email"
							value="<?php echo $_settings->info('email') ?>">
					</div>

					<!-- Contact number input field -->
					<div class="form-group">
						<label for="contact" class="control-label">Contact #</label>
						<input type="text" class="form-control form-control-sm" name="contact" id="contact"
							value="<?php echo $_settings->info('contact') ?>">
					</div>

					<!-- Address input field -->
					<div class="form-group">
						<label for="address" class="control-label">Address</label>
						<textarea rows="3" class="form-control form-control-sm" name="address" id="address"
							style="resize:none"><?php echo $_settings->info('address') ?></textarea>
					</div>
				</fieldset>
			</form>
		</div>

		<!-- Submit button to update system information -->
		<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary" form="system-frm">Update</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// Function to display the selected logo image preview
	function displayImg(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg').attr('src', e.target.result); // Update logo preview
				$(input).siblings('.custom-file-label').html(input.files[0].name); // Display filename
			}
			reader.readAsDataURL(input.files[0]); // Read the file as a data URL
		}
	}

	// Function to display the selected cover image preview
	function displayImg2(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#cimg2').attr('src', e.target.result); // Update cover preview
				$(input).siblings('.custom-file-label').html(input.files[0].name); // Display filename
			}
			reader.readAsDataURL(input.files[0]); // Read the file as a data URL
		}
	}

	// Initialize Summernote (rich text editor) for the text areas
	$(document).ready(function () {
		$('.summernote').summernote({
			height: 200, // Set editor height
			toolbar: [ // Toolbar configuration
				['style', ['style']],
				['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
				['fontname', ['fontname']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ol', 'ul', 'paragraph', 'height']],
				['table', ['table']],
				['insert', ['link', 'picture']],
				['view', ['undo', 'redo', 'fullscreen', 'codeview', 'help']]
			]
		});
	});
</script>