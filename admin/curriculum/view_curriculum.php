<?php
require_once('../../config.php');
if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT c.*, d.name as department from `curriculum_list` c inner join `department_list` d on c.department_id = d.id where c.id = '{$_GET['id']}'");
    if ($qry->num_rows > 0) {
        $res = $qry->fetch_array();
        foreach ($res as $k => $v) {
            if (!is_numeric($k))
                $$k = $v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer {
        display: none !important;
    }
</style>
<div class="container-fluid">
    <dl>
        <dt class="text-muted">Department</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($department) ? $department : '' ?></dd>
        <dt class="text-muted">Name</dt>
        <dd class='pl-4 fs-4 fw-bold'><?= isset($name) ? $name : '' ?></dd>
        <dt class="text-muted">Description</dt>
        <dd class='pl-4'>
            <p class=""><small><?= isset($description) ? $description : '' ?></small></p>
        </dd>
        <dt class="text-muted">Status</dt>
        <dd class='pl-4'>
            <?php
            if (isset($status)):
                switch ($status):
                    case '1':
                        // Apply padding for Active status (Green)
                        echo "<span class='badge badge-pill' style='background-color: #28a745; color: white; padding: 5px 10px;'>Active</span>";
                        break;
                    case '0':
                        // Apply padding for Inactive status (Gray)
                        echo "<span class='badge badge-pill' style='background-color: #6c757d; color: white; padding: 5px 10px;'>Inactive</span>";
                        break;
                endswitch;
            endif;
            ?>

        </dd>
    </dl>
    <div class="col-12 text-right">
        <button class="btn btn-dark btn-sm" style="border-radius: 3px;" data-dismiss="modal" type="button">
            <i class="fa fa-times"></i> Close
        </button>
    </div>
</div>