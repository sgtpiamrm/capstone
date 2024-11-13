<style>
    /* Styling for car cover image */
    .car-cover {
        width: 10em;
        /* Set the width of the car cover image to 10em */
    }

    /* Styling for car items with auto columns */
    .car-item .col-auto {
        max-width: calc(100% - 12em) !important;
        /* Set max width of car item to 100% minus 12em */
    }

    /* Styling for hover effect on car item */
    .car-item:hover {
        transform: translate(0, -4px);
        /* Move the car item slightly upward when hovered */
        background: #a5a5a521;
        /* Add a semi-transparent background color */
    }

    /* Styling for banner image holder */
    .banner-img-holder {
        height: 25vh !important;
        /* Set the height of the banner image holder to 25% of the viewport height */
        width: calc(100%);
        /* Set the width to 100% of the container */
        overflow: hidden;
        /* Hide any overflowing content */
    }

    /* Styling for the actual banner image */
    .banner-img {
        object-fit: scale-down;
        /* Ensure the image scales down to fit within the container */
        height: calc(100%);
        /* Set the height to fill the container */
        width: calc(100%);
        /* Set the width to fill the container */
        transition: transform .3s ease-in;
        /* Add smooth transition effect for transformations */
    }

    /* Styling for banner image when car item is hovered */
    .car-item:hover .banner-img {
        transform: scale(1.3);
        /* Scale up the banner image when the car item is hovered */
    }

    /* Styling for images inside welcome content */
    .welcome-content img {
        margin: .5em;
        /* Add 0.5em margin around images in the welcome content */
    }
</style>

<!-- Main container for the welcome section -->
<div class="col-lg-12 py-5">
    <!-- Fluid container for layout responsiveness -->
    <div class="contain-fluid">
        <!-- Card component for the welcome section -->
        <div class="card card-outline card-navy shadow rounded-0">
            <!-- Card body where content goes -->
            <div class="card-body rounded-0">
                <!-- Inner container for aligning content -->
                <div class="container-fluid">
                    <!-- Heading for the welcome section -->
                    <h3 class="text-center">Welcome</h3>
                    <hr> <!-- Horizontal line for separating sections -->
                    <!-- Div for the welcome content -->
                    <div class="welcome-content">
                        <?php include("welcome.html") ?> <!-- Include the external 'welcome.html' file -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>