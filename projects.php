<div class="content py-2">
    <div class="col-12">
        <div class="card card-outline card-primary shadow rounded-0">
            <div class="card-body rounded-0">
                <!-- Display the heading for the archive list -->
                <h2>Archive List</h2>
                <hr class="bg-navy">

                <?php
                // Pagination settings: 10 records per page
                $limit = 10;
                $page = isset($_GET['p']) ? $_GET['p'] : 1; // Current page, defaults to 1
                $offset = 10 * ($page - 1); // Offset calculation based on page number
                $paginate = " limit {$limit} offset {$offset}"; // SQL pagination clause
                
                // Check if there's a search query in the URL and build the search condition
                $isSearch = isset($_GET['q']) ? "&q={$_GET['q']}" : "";
                $search = "";
                if (isset($_GET['q'])) {
                    // Escape the keyword to prevent SQL injection
                    $keyword = $conn->real_escape_string($_GET['q']);
                    // Add search condition for title, abstract, members, curriculum name/description, and department name/description
                    $search = " and (title LIKE '%{$keyword}%' or abstract  LIKE '%{$keyword}%' or members LIKE '%{$keyword}%' or curriculum_id in (SELECT id from curriculum_list where name  LIKE '%{$keyword}%' or description  LIKE '%{$keyword}%') or curriculum_id in (SELECT id from curriculum_list where department_id in (SELECT id FROM department_list where name  LIKE '%{$keyword}%' or description  LIKE '%{$keyword}%'))) ";
                }

                // Query to get all students associated with archives, considering the search filter
                $students = $conn->query("SELECT * FROM `student_list` where id in (SELECT student_id FROM archive_list where `status` = 1 {$search})");
                // Map student IDs to email addresses for easier lookup
                $student_arr = array_column($students->fetch_all(MYSQLI_ASSOC), 'email', 'id');

                // Get the total number of archive records, considering search conditions
                $count_all = $conn->query("SELECT * FROM archive_list where `status` = 1 {$search}")->num_rows;
                // Calculate total number of pages for pagination
                $pages = ceil($count_all / $limit);

                // Query to fetch archives, ordered by creation date with pagination
                $archives = $conn->query("SELECT * FROM archive_list where `status` = 1 {$search} order by unix_timestamp(date_created) desc {$paginate}");
                ?>

                <!-- Display a search result message if there's a search query -->
                <?php if (!empty($isSearch)): ?>
                    <h3 class="text-center"><b>Search Result for "<?= $keyword ?>" keyword</b></h3>
                <?php endif ?>

                <!-- List of archives -->
                <div class="list-group">
                    <?php
                    // Loop through each archive record and display the details
                    while ($row = $archives->fetch_assoc()):
                        // Clean the abstract by stripping HTML tags
                        $row['abstract'] = strip_tags(html_entity_decode($row['abstract']));
                        ?>
                        <!-- Display each archive item as a clickable list group item -->
                        <a href="./?page=view_archive&id=<?= $row['id'] ?>"
                            class="text-decoration-none text-dark list-group-item list-group-item-action">
                            <div class="row">
                                <div class="col-lg-4 col-md-5 col-sm-12 text-center">
                                    <!-- Display the banner image for the archive -->
                                    <img src="<?= validate_image($row['banner_path']) ?>"
                                        class="banner-img img-fluid bg-gradient-dark" alt="Banner Image">
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-12">
                                    <!-- Display the title of the archive -->
                                    <h3 class="text-navy"><b><?php echo $row['title'] ?></b></h3>
                                    <!-- Display the student's email who submitted the archive -->
                                    <small class="text-muted">By <b
                                            class="text-info"><?= isset($student_arr[$row['student_id']]) ? $student_arr[$row['student_id']] : "N/A" ?></b></small>
                                    <!-- Display the abstract (brief description) of the archive -->
                                    <p class="truncate-5"><?= $row['abstract'] ?></p>
                                </div>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- Pagination section at the bottom of the archive list -->
            <div class="card-footer clearfix rounded-0">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Display the number of items currently displayed -->
                            <span class="text-muted">Display Items: <?= $archives->num_rows ?></span>
                        </div>
                        <div class="col-md-6">
                            <!-- Pagination controls (previous, page numbers, next) -->
                            <ul class="pagination pagination-sm m-0 float-right">
                                <!-- Previous page link (disabled if on the first page) -->
                                <li class="page-item"><a class="page-link"
                                        href="./?page=projects<?= $isSearch ?>&p=<?= $page - 1 ?>" <?= $page == 1 ? 'disabled' : '' ?>>«</a></li>
                                <!-- Loop through and display page numbers -->
                                <?php for ($i = 1; $i <= $pages; $i++): ?>
                                    <li class="page-item"><a class="page-link <?= $page == $i ? 'active' : '' ?>"
                                            href="./?page=projects<?= $isSearch ?>&p=<?= $i ?>"><?= $i ?></a></li>
                                <?php endfor; ?>
                                <!-- Next page link (disabled if on the last page) -->
                                <li class="page-item"><a class="page-link"
                                        href="./?page=projects<?= $isSearch ?>&p=<?= $page + 1 ?>" <?= $page == $pages ? 'disabled' : '' ?>>»</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>