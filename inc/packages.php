<!-- Tour Packages Section: A section to display the tour packages in a dark background -->
<section class="page-section bg-dark" id="home">
	<div class="container">
		<!-- Section Title: Heading for the "Tour Packages" section -->
		<h2 class="text-center">Tour Packages</h2>

		<!-- Separator Line: A horizontal line with a warning color for visual separation -->
		<div class="d-flex w-100 justify-content-center">
			<hr class="border-warning" style="border:3px solid" width="15%">
		</div>

		<!-- Tour Packages Grid: A flex container to display packages in a row -->
		<div class="d-flex w-100">
			<?php
			// Fetching tour packages from the database, ordering them randomly
			$packages = $conn->query("SELECT * FROM `packages` order by rand() ");
			// Loop through each package record
			while ($row = $packages->fetch_assoc()):
				$cover = ''; // Variable to hold package cover image path
			
				// Check if the package directory exists and fetch the first image from the folder
				if (is_dir(base_app . 'uploads/package_' . $row['id'])) {
					$img = scandir(base_app . 'uploads/package_' . $row['id']);

					// Remove '.' and '..' from the image array
					$k = array_search('.', $img);
					if ($k !== false)
						unset($img[$k]);
					$k = array_search('..', $img);
					if ($k !== false)
						unset($img[$k]);

					// Set the cover image if it exists
					$cover = isset($img[2]) ? 'uploads/package_' . $row['id'] . '/' . $img[2] : "";
				}

				// Clean up the package description (remove HTML tags and decode entities)
				$row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
				?>

				<!-- Package Card: Display each package in a card format with image, title, and description -->
				<div class="card w-100 rounded-0">
					<!-- Package Image: Display the cover image of the package -->
					<img class="card-img-top" src="<?php echo validate_image($cover) ?>" alt="<?php echo $row['title'] ?>"
						height="200rem" style="object-fit:cover">

					<div class="card-body">
						<!-- Package Title: Display the title of the package -->
						<h5 class="card-title truncate-1"><?php echo $row['title'] ?></h5>

						<!-- Package Description: Display a truncated version of the package description -->
						<p class="card-text truncate"><?php echo $row['description'] ?></p>

						<!-- View Package Button: Link to the package detail page -->
						<div class="w-100 d-flex justify-content-end">
							<a href="./?page=packages&id=<?php echo md5($row['id']) ?>"
								class="btn btn-sm btn-flat btn-warning">View Package <i class="fa fa-arrow-right"></i></a>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>

		<!-- Explore Package Button: A button to explore more packages -->
		<div class="d-flex w-100 justify-content-end">
			<a href="./?page=packages" class="btn btn-flat btn-warning mr-4">Explore Package <i
					class="fa fa-arrow-right"></i></a>
		</div>
	</div>
</section>