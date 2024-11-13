<div class="col-12">
    <!-- Container for the entire section, spans full width (12 columns) -->

    <div class="row my-5">
        <!-- Creates a row with margin on top and bottom for spacing -->

        <div class="col-md-5">
            <!-- Left column with a width of 5/12 on medium-sized screens -->

            <div class="card card-outline card-navy rounded-0 shadow">
                <!-- A card component with navy outline, rounded corners, and a shadow effect -->

                <div class="card-header">
                    <h4 class="card-title">Contact</h4>
                    <!-- Header of the card displaying the title "Contact" -->
                </div>

                <div class="card-body rounded-0">
                    <!-- Card body section with no border radius -->

                    <dl>
                        <!-- Definition list for contact details -->

                        <dt class="text-muted"><i class="fa fa-envelope"></i> Email</dt>
                        <!-- Definition term for "Email" with an envelope icon -->

                        <dd class="pr-4"><?= $_settings->info('email') ?></dd>
                        <!-- Definition description showing the email address from settings -->

                        <dt class="text-muted"><i class="fa fa-phone"></i> Contact #</dt>
                        <!-- Definition term for "Contact #" with a phone icon -->

                        <dd class="pr-4"><?= $_settings->info('contact') ?></dd>
                        <!-- Definition description showing the contact number from settings -->

                        <dt class="text-muted"><i class="fa fa-map-marked-alt"></i> Location</dt>
                        <!-- Definition term for "Location" with a map marker icon -->

                        <dd class="pr-4"><?= $_settings->info('address') ?></dd>
                        <!-- Definition description showing the address from settings -->

                    </dl>
                </div>
                <!-- End of card body -->
            </div>
            <!-- End of card -->
        </div>

        <div class="col-md-7">
            <!-- Right column with a width of 7/12 on medium-sized screens -->

            <div class="card rounded-0 card-outline card-navy shadow">
                <!-- A card component with navy outline, rounded corners, and a shadow effect -->

                <div class="card-body rounded-0">
                    <!-- Card body section with no border radius -->

                    <h2 class="text-center">About</h2>
                    <!-- Displays a heading "About" centered on the page -->

                    <center>
                        <hr class="bg-navy border-navy w-25 border-2">
                    </center>
                    <!-- Horizontal rule with navy color and 25% width for a dividing line -->

                    <div>
                        <!-- A div to hold the content -->

                        <?= file_get_contents("about_us.html") ?>
                        <!-- Loads and displays the contents of "about_us.html" dynamically -->
                    </div>
                    <!-- End of content section -->
                </div>
                <!-- End of card body -->
            </div>
            <!-- End of card -->
        </div>
        <!-- End of right column -->
    </div>
    <!-- End of row -->
</div>
<!-- End of container -->