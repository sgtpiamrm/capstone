<?php
// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    // Query to fetch the curriculum details based on the given ID
    $qry = $conn->query("SELECT * FROM curriculum_list where `status` = 1 and id = '{$_GET['id']}' ");

    // Check if any curriculum record is found
    if ($qry->num_rows > 0) {
        // Loop through the fetched data and assign it to an associative array
        foreach ($qry->fetch_assoc() as $k => $v) {
            if (!is_numeric($k)) { // Avoid numeric keys
                $curriculum[$k] = $v;
            }
        }
    } else {
        // If no curriculum is found, display an alert and redirect to the home page
        echo "<script> alert('Unknown Course ID'); location.replace('./') </script>";
    }
} else {
    // If 'id' is not set, display an alert and redirect to the home page
    echo "<script> alert('Course ID is required'); location.replace('./') </script>";
}
?>

<div class="content py-2">
    <div class="col-12">
        <div class="card card-outline card-primary shadow rounded-0">
            <div class="card-body rounded-0">
                <!-- Display the curriculum title and description -->
                <h2>Archive List of <?= isset($curriculum['name']) ? $curriculum['name'] : "" ?> </h2>
                <p><small><?= isset($curriculum['description']) ? $curriculum['description'] : "" ?></small></p>
                <hr class="bg-navy">

                <?php
                // Get the curriculum ID and set pagination parameters
                $id = isset($_GET['id']) ? $_GET['id'] : '';
                $limit = 10; // Number of records per page
                $page = isset($_GET['p']) ? $_GET['p'] : 1; // Current page number
                $offset = 10 * ($page - 1); // Offset for pagination
                $paginate = " limit {$limit} offset {$offset}"; // Pagination SQL clause
                $wherecid = " and curriculum_id = '{$id}' "; // Filter by curriculum ID
                
                // Query to get students who have archives in the selected curriculum
                $students = $conn->query("SELECT * FROM `student_list` where id in (SELECT student_id FROM archive_list where `status` = 1 {$wherecid})");
                // Create an array mapping student IDs to email addresses
                $student_arr = array_column($students->fetch_all(MYSQLI_ASSOC), 'email', 'id');

                // Count the total number of archives for the selected curriculum
                $count_all = $conn->query("SELECT * FROM archive_list where `status` = 1 {$wherecid}")->num_rows;
                // Calculate the number of pages for pagination
                $pages = ceil($count_all / $limit);

                // Query to fetch archive records with pagination
                $archives = $conn->query("SELECT * FROM archive_list where `status` = 1 {$wherecid} order by unix_timestamp(date_created) desc {$paginate}");
                ?>

                <!-- Display the archive list -->
                <div class="list-group">
                    <?php
                    // Loop through each archive record and display it
                    while ($row = $archives->fetch_assoc()):
                        // Clean up the abstract by removing HTML tags
                        $row['abstract'] = strip_tags(html_entity_decode($row['abstract']));
                        ?>
                        <!-- Display each archive item as a clickable list group item -->
                        <a href="./?page=view_archive&id=<?= $row['id'] ?>"
                            class="text-decoration-none text-dark list-group-item list-group-item-action">
                            <div class="row">
                                <div class="col-lg-4 col-md-5 col-sm-12 text-center">
                                    <!-- Display the archive banner image -->
                                    <img src="<?= validate_image($row['banner_path']) ?>"
                                        class="banner-img img-fluid bg-gradient-dark" alt="Banner Image">
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-12">
                                    <!-- Display the archive title -->
                                    <h3 class="text-navy"><b><?php echo $row['title'] ?></b></h3>
                                    <!-- Display the student's name who created the archive -->
                                    <small class="text-muted">By <b
                                            class="text-info"><?= isset($student_arr[$row['student_id']]) ? $student_arr[$row['student_id']] : "N/A" ?></b></small>
                                    <!-- Display the abstract of the archive -->
                                    <p class="truncate-5"><?= $row['abstract'] ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
            <!-- Pagination controls for navigating through archive pages -->
            <div class="card-footer clearfix rounded-0">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Display the number of records being displayed -->
                            <span class="text-muted">Display Items: <?= $archives->num_rows ?></span>
                        </div>
                        <div class="col-md-6">
                            <!-- Pagination links -->
                            <ul class="pagination pagination-sm m-0 float-right">
                                <!-- Previous page link, disabled if on the first page -->
                                <li class="page-item"><a class="page-link"
                                        href="./?page=projects_per_curriculum&id=<?= $id ?>&p=<?= $page - 1 ?>"
                                        <?= $page == 1 ? 'disabled' : '' ?>>«</a></li>
                                <!-- Pagination links for each page number -->
                                <?php for ($i = 1; $i <= $pages; $i++): ?>
                                    <li class="page-item"><a class="page-link <?= $page == $i ? 'active' : '' ?>"
                                            href="./?page=projects_per_curriculum&id=<?= $id ?>&p=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <!-- Next page link, disabled if on the last page -->
                                <li class="page-item"><a class="page-link"
                                        href="./?page=projects_per_curriculum&id=<?= $id ?>&p=<?= $page + 1 ?>"
                                        <?= $page == $pages || $pages <= 1 ? 'disabled' : '' ?>>»</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>