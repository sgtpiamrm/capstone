<?php
// Fetch user data from the database
$user = $conn->query("SELECT s.*,d.name as department, c.name as curriculum,CONCAT(lastname,', ',firstname,' ',middlename) as fullname FROM student_list s inner join department_list d on s.department_id = d.id inner join curriculum_list c on s.curriculum_id = c.id where s.id ='{$_settings->userdata('id')}'");

// Loop through the fetched data and assign values to variables
foreach ($user->fetch_array() as $k => $v) {
    $$k = $v; // Dynamically create variables for each user property (e.g., $fullname, $department, etc.)
}
?>
<style>
    /* Styling for the student image */
    .student-img {
        object-fit: scale-down;
        /* Ensures the image scales proportionally within the container */
        object-position: center center;
        /* Centers the image within the container */
        height: 200px;
        /* Fixed height for the image */
        width: 200px;
        /* Fixed width for the image */
    }
</style>

<div class="content py-4">
    <!-- Card component for displaying user information -->
    <div class="card card-outline card-primary shadow rounded-0">
        <div class="card-header rounded-0">
            <!-- Card title and tools (links to other pages) -->
            <h5 class="card-title">Your Information:</h5>
            <div class="card-tools">
                <!-- Link to the user's archives page -->
                <a href="./?page=my_archives" class="btn btn-default bg-primary btn-flat">
                    <i class="fa fa-archive"></i> My Archives
                </a>
                <!-- Link to update the user's account information -->
                <a href="./?page=manage_account" class="btn btn-default bg-navy btn-flat">
                    <i class="fa fa-edit"></i> Update Account
                </a>
            </div>
        </div>
        <div class="card-body rounded-0">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="row">
                        <!-- Column for displaying student image -->
                        <div class="col-lg-4 col-sm-12">
                            <center>
                                <!-- Display the student image -->
                                <img src="<?= validate_image($avatar) ?>" alt="Student Image"
                                    class="img-fluid student-img bg-gradient-dark border">
                            </center>
                        </div>
                        <!-- Column for displaying student information -->
                        <div class="col-lg-8 col-sm-12">
                            <!-- Definition list to display student details -->
                            <dl>
                                <!-- Student Name -->
                                <dt class="text-navy">Student Name:</dt>
                                <dd class="pl-4"><?= ucwords($fullname) ?></dd>

                                <!-- Student Gender -->
                                <dt class="text-navy">Gender:</dt>
                                <dd class="pl-4"><?= ucwords($gender) ?></dd>

                                <!-- Student Email -->
                                <dt class="text-navy">Email:</dt>
                                <dd class="pl-4"><?= $email ?></dd>

                                <!-- Student Department -->
                                <dt class="text-navy">Department:</dt>
                                <dd class="pl-4"><?= ucwords($department) ?></dd>

                                <!-- Student Curriculum -->
                                <dt class="text-navy">Curriculum:</dt>
                                <dd class="pl-4"><?= ucwords($curriculum) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>