<?php
if ($query->num_rows() > 0) {
    $count = 0;
    $tr_categories = '';

    foreach ($query->result() as $row) {
        $count++;
        if ($row->category_status == 1) {
            $status = 'Active';

            $status_anchor = anchor("categories/deactivate-category/" . $row->category_id . "/" . $row->category_status, "<i class='far fa-thumbs-down'>Activate</i>", array("class" => "btn btn-info btn-sm p-left-10", "onclick" => "return confirm('Are you sure you want to deactivate?')"));
        } else {
            $status = 'Inactive';

            $status_anchor = anchor("categories/activate-category/" . $row->category_id . "/" . $row->category_status, "<i class='far fa-thumbs-up'>Deactivate</i>", array("class" => "btn btn-info btn-sm", "onclick" => "return confirm('Are you sure you want to activate?')"));
        }

        $tr_categories .= '<tr>
            <td> ' . $count . ' </td>
            <td> ' . $row->category_parent . ' </td>
            <td> ' . $row->category_name . ' </td>
            <td><span class="badge badge-pill badge-success">' . $status . '</span></td>
            <td>' . anchor("categories/edit-category/" . $row->category_id, "<i class='fas fa-edit'>Edit</i>", "class='btn btn-warning btn-sm p-left-10'", "style='padding-left:10px;'") .
        $status_anchor .
        anchor("categories/delete-category/" . $row->category_id, "<i class='fas fa-trash-alt'>Delete</i>", array("class" => "btn btn-danger btn-sm", "onclick" => "return confirm('Are you sure you want to Delete?')")) .
            '</td>
        </tr>';
    }
}
?>


<div class="shadow-lg p-3 mb-5 bg-white rounded" id="ads">
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php echo anchor("category/add-category/", "<i class='fas fa-edit'></i> Add Categoty", "class='btn btn-info btn-sm p-left-10'", "style='padding-left:10px;'"); ?>
            </div>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Parent</th>
                        <th>Name</th>
                        <th>Category Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Parent</th>
                        <th>Name</th>
                        <th>Category Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php echo $tr_categories; ?>

                </tbody>
            </table>
            <?php echo $links; ?>
        </div>
    </div>
</div>