<h1>Our Training Packages</h1>
<hr class="border-navy bg-navy">
<!-- Container for displaying the training packages list -->
<div class="container-fluid">
    <!-- Search input field for filtering packages -->
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="input-group mb-2">
                <!-- Input field for package search -->
                <input type="search" id="search" class="form-control form-control-border"
                    placeholder="Search Package here...">
                <div class="input-group-append">
                    <!-- Search button with an icon -->
                    <button type="button" class="btn btn-sm border-0 border-bottom btn-default">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- List to display all training packages -->
    <div class="list-group" id="package-list">
        <?php
        // Fetch active packages from the database
        $package = $conn->query("SELECT * FROM `package_list` where `status` = 1 order by `name` asc");
        while ($row = $package->fetch_assoc()):
            ?>
            <!-- Each package listed with a collapsible section for more details -->
            <div class="text-decoration-none list-group-item rounded-0 package-item">
                <!-- Package name with a collapse toggle icon -->
                <a class="d-flex w-100 text-navy" href="#package_<?= $row['id'] ?>" data-toggle="collapse">
                    <div class="col-11">
                        <h3><b><?= ucwords($row['name']) ?></b></h3>
                    </div>
                    <div class="col-1 text-right">
                        <!-- Icon for toggling the collapse -->
                        <i class="fa fa-plus collapse-icon"></i>
                    </div>
                </a>
                <!-- Collapsible section for package details -->
                <div class="collapse" id="package_<?= $row['id'] ?>">
                    <hr class="border-navy">
                    <div class="mx-3">
                        <!-- Displaying training duration and cost of the package -->
                        <span class="mr-3 text-muted"><span class="fa fa-calendar"></span>
                            <?= $row['training_duration'] ?></span>
                        <span class="text-muted"><span class="fa fa-tags"></span>
                            <?= number_format($row['cost'], 2) ?></span>
                    </div>
                    <!-- Package description -->
                    <p class="mx-3"><?= $row['description'] ?></p>
                </div>
            </div>
        <?php endwhile; ?>
        <!-- Message when no packages are found -->
        <?php if ($package->num_rows < 1): ?>
            <center><span class="text-muted">No package Listed Yet.</span></center>
        <?php endif; ?>
        <!-- Hidden message when no search results are found -->
        <div id="no_result" style="display:none">
            <center><span class="text-muted">No package Listed Yet.</span></center>
        </div>
    </div>
</div>

<script>
    $(function () {
        // Toggle collapse behavior on package list items
        $('.collapse').on('show.bs.collapse', function () {
            // Close other open collapsible sections
            $(this).parent().siblings().find('.collapse').collapse('hide')
            // Update icons to indicate the collapse state
            $(this).parent().siblings().find('.collapse-icon').removeClass('fa-plus fa-minus')
            $(this).parent().siblings().find('.collapse-icon').addClass('fa-plus')
            $(this).parent().find('.collapse-icon').removeClass('fa-plus fa-minus')
            $(this).parent().find('.collapse-icon').addClass('fa-minus')
        })
        // Reset icon when collapsible section is closed
        $('.collapse').on('hidden.bs.collapse', function () {
            $(this).parent().find('.collapse-icon').removeClass('fa-plus fa-minus')
            $(this).parent().find('.collapse-icon').addClass('fa-plus')
        })

        // Filter training packages based on search input
        $('#search').on("input", function (e) {
            var _search = $(this).val().toLowerCase()
            $('#package-list .package-item').each(function () {
                var _txt = $(this).text().toLowerCase()
                if (_txt.includes(_search) === true) {
                    $(this).toggle(true) // Show the matching package
                } else {
                    $(this).toggle(false) // Hide the non-matching package
                }
                // Show the "No results" message if no package is visible
                if ($('#package-list .package-item:visible').length <= 0) {
                    $("#no_result").show('slow')
                } else {
                    $("#no_result").hide('slow')
                }
            })
        })
    })
</script>