<?php require_once('./config.php') ?> <!-- Include the configuration file for application settings -->
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;"> <!-- Start of the HTML document with English language set -->
<?php require_once('inc/header.php') ?> <!-- Include the header content -->

<body class="hold-transition "> <!-- Body of the page, with a "hold transition" class for visual effect -->
    <script>
        start_loader() <!-- Initialize loader script when the page starts -->
    </script>

    <style>
        /* Styling for HTML and body to make sure they take up the full viewport */
        html,
        body {
            height: 100% !important;
            width: 100% !important;
        }

        /* Background styling for the body */
        body {
            background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
            /* Dynamic background image from settings */
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* Styling for the login page title with a text shadow */
        .login-title {
            text-shadow: 2px 2px black;
            font-family: 'Poppins', sans-serif;
        }

        /* Styling for the login container to align the items vertically */
        #login {
            flex-direction: column !important;
        }

        /* Styling for the logo image */
        #logo-img {
            height: 150px;
            width: 150px;
            object-fit: scale-down;
            object-position: center center;
            border-radius: 100%;
            /* Make the logo circular */
        }

        /* Ensures the columns in the login section take up full width */
        #login .col-7,
        #login .col-5 {
            width: 100% !important;
            max-width: unset !important;
        }
    </style>

    <!-- Check if there is a success flash message and show it -->
    <?php if ($_settings->chk_flashdata('success')): ?>
        <script>
            alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success') <!-- Display a success toast -->
        </script>
    <?php endif; ?>

    <!-- Login Section -->
    <div class="h-100 d-flex align-items-center w-100" id="login">
        <!-- Left side: Logo and Title -->
        <div class="col-7 h-100 d-flex align-items-center justify-content-center">
            <div class="w-100">
                <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="" id="logo-img"></center>
                <!-- Display the logo image -->
                <h1 class="text-center py-5 login-title"><b><?php echo $_settings->info('short_name') ?> - Student</b>
                </h1>
                <!-- Site name and designation -->
            </div>
        </div>

        <!-- Right side: Login Form -->
        <div class="col-5 h-100 bg-gradient">
            <div class="d-flex w-100 h-100 justify-content-center align-items-center">
                <div class="card col-sm-12 col-md-6 col-lg-3 card-outline card-primary">
                    <div class="card-header">
                        <h4 class="text-navy text-center"><b>Login</b></h4> <!-- Login title -->
                    </div>
                    <div class="card-body">
                        <!-- Login form starts -->
                        <form id="slogin-form" action="" method="post">
                            <!-- Email input field -->
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" autofocus name="email" placeholder="Email">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span> <!-- Email icon -->
                                    </div>
                                </div>
                            </div>
                            <!-- Password input field -->
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span> <!-- Password icon -->
                                    </div>
                                </div>
                            </div>
                            <!-- Actions below the form -->
                            <div class="row">
                                <div class="col-8">
                                    <a href="<?php echo base_url ?>">Go to Website</a> <!-- Link to the homepage -->
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                    <!-- Submit button -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function () {
            end_loader();  // End the loader once page is loaded

            // Registration Form Submit Handler
            $('#slogin-form').submit(function (e) {
                e.preventDefault()  // Prevent default form submission
                var _this = $(this)
                $(".pop-msg").remove()  // Remove previous messages
                $('#password, #cpassword').removeClass("is-invalid")  // Remove invalid class from fields
                var el = $("<div>")  // Create a new element for error/success messages
                el.addClass("alert pop-msg my-2")
                el.hide()
                start_loader();  // Start the loader

                // AJAX call to send login data
                $.ajax({
                    url: _base_url_ + "classes/Login.php?f=student_login",  // PHP endpoint for login
                    method: 'POST',
                    data: _this.serialize(),  // Serialize form data
                    dataType: 'json',
                    error: err => {
                        console.log(err)  // Log errors in the console
                        el.text("An error occurred while saving the data")  // Error message
                        el.addClass("alert-danger")  // Error style
                        _this.prepend(el)  // Prepend the error message
                        el.show('slow')  // Display the error message slowly
                        end_loader();  // End the loader
                    },
                    success: function (resp) {
                        // Success handler
                        if (resp.status == 'success') {
                            location.href = "./"  // Redirect to the homepage if successful
                        } else if (!!resp.msg) {
                            el.text(resp.msg)  // Display the response message
                            el.addClass("alert-danger")
                            _this.prepend(el)
                            el.show('show')
                        } else {
                            el.text("An error occurred while saving the data")  // Default error message
                            el.addClass("alert-danger")
                            _this.prepend(el)
                            el.show('show')
                        }
                        end_loader();  // End the loader
                        $('html, body').animate({ scrollTop: 0 }, 'fast')  // Scroll to the top of the page
                    }
                })
            })
        })

    </script>
</body>

</html>