<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<!-- Displays the welcome message with the value of 'name' from the settings object -->

<hr class="border-info">
<!-- Horizontal rule with a blue border for separation -->

<div class="row">
    <!-- Department List -->
    <div class="col">
        <a href="department.php" class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-th-list"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Department List</span>
                <span class="info-box-number">
                    <?php echo $conn->query("SELECT * FROM `department_list` WHERE status = 1")->num_rows; ?>
                </span>
            </div>
        </a>
    </div>

    <!-- Curriculum List -->
    <div class="col">
        <a href="curriculum.php" class="info-box">
            <span class="info-box-icon bg-gradient-dark"><i class="fas fa-scroll"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Curriculum List</span>
                <span class="info-box-number">
                    <?php echo $conn->query("SELECT * FROM `curriculum_list` WHERE status = 1")->num_rows; ?>
                </span>
            </div>
        </a>
    </div>

    <!-- Verified Students -->
    <div class="col">
        <a href="students.php" class="info-box">
            <span class="info-box-icon bg-primary"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Verified Students</span>
                <span class="info-box-number">
                    <?php echo $conn->query("SELECT * FROM `student_list` WHERE status = 1")->num_rows; ?>
                </span>
            </div>
        </a>
    </div>

    <!-- Not Verified Students -->
    <div class="col">
        <a href="not_verified_students.php" class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Not Verified Students</span>
                <span class="info-box-number">
                    <?php echo $conn->query("SELECT * FROM `student_list` WHERE status = 0")->num_rows; ?>
                </span>
            </div>
        </a>
    </div>

    <!-- Verified Archives -->
    <div class="col">
        <a href="verified_archives.php" class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-archive"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Verified Archives</span>
                <span class="info-box-number">
                    <?php echo $conn->query("SELECT * FROM `archive_list` WHERE status = 1")->num_rows; ?>
                </span>
            </div>
        </a>
    </div>

    <!-- Not Verified Archives -->
    <div class="col">
        <a href="not_verified_archives.php" class="info-box">
            <span class="info-box-icon bg-dark"><i class="fas fa-archive"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Not Verified Archives</span>
                <span class="info-box-number">
                    <?php echo $conn->query("SELECT * FROM `archive_list` WHERE status = 0")->num_rows; ?>
                </span>
            </div>
        </a>
    </div>
</div>
</body>

</html>