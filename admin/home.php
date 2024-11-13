<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<!-- Displays the welcome message with the value of 'name' from the settings object -->

<hr class="border-info">
<!-- Horizontal rule with a blue border for separation -->

<div class="row">
    <!-- Start of the row container for displaying the boxes -->

    <!-- Department List Box -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-th-list"></i></span>
            <!-- Info box icon with blue background and a list icon -->

            <div class="info-box-content">
                <span class="info-box-text">Department List</span>
                <!-- Title of the info box -->

                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `department_list` where status = 1")->num_rows;
                    ?>
                    <!-- Displays the number of active departments (status = 1) from the database -->
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- End of Department List Box -->

    <!-- Curriculum List Box -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-gradient-dark elevation-1"><i class="fas fa-scroll"></i></span>
            <!-- Info box icon with a dark gradient background and scroll icon -->

            <div class="info-box-content">
                <span class="info-box-text">Curriculum List</span>
                <!-- Title of the info box -->

                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `curriculum_list` where `status` = 1")->num_rows;
                    ?>
                    <!-- Displays the number of active curriculums (status = 1) from the database -->
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- End of Curriculum List Box -->

    <!-- Verified Students Box -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
            <!-- Info box icon with a blue background and users icon -->

            <div class="info-box-content">
                <span class="info-box-text">Verified Students</span>
                <!-- Title of the info box -->

                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `student_list` where `status` = 1")->num_rows;
                    ?>
                    <!-- Displays the number of verified students (status = 1) from the database -->
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- End of Verified Students Box -->

    <!-- Not Verified Students Box -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <!-- Info box icon with a yellow background and users icon -->

            <div class="info-box-content">
                <span class="info-box-text">Not Verified Students</span>
                <!-- Title of the info box -->

                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `student_list` where `status` = 0")->num_rows;
                    ?>
                    <!-- Displays the number of not verified students (status = 0) from the database -->
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- End of Not Verified Students Box -->

    <!-- Verified Archives Box -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-archive"></i></span>
            <!-- Info box icon with a green background and archive icon -->

            <div class="info-box-content">
                <span class="info-box-text">Verified Archives</span>
                <!-- Title of the info box -->

                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `archive_list` where `status` = 1")->num_rows;
                    ?>
                    <!-- Displays the number of verified archives (status = 1) from the database -->
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- End of Verified Archives Box -->

    <!-- Not Verified Archives Box -->
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-archive"></i></span>
            <!-- Info box icon with a dark background and archive icon -->

            <div class="info-box-content">
                <span class="info-box-text">Not Verified Archives</span>
                <!-- Title of the info box -->

                <span class="info-box-number text-right">
                    <?php
                    echo $conn->query("SELECT * FROM `archive_list` where `status` = 0")->num_rows;
                    ?>
                    <!-- Displays the number of not verified archives (status = 0) from the database -->
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- End of Not Verified Archives Box -->

</div>
<!-- End of row container -->