<?php
if ($query->num_rows() > 0) {
    $count = 0;
    $counts = '';
    $cat_parent = '';
    $id = '';
    $tr_categories = '';
    $category_name = '';
    $category_status = '';

    foreach ($query->result() as $row) {
        $count++;
        if ($row->category_status == 1) {
            $status = 'Active';
        } else {
            $status = 'Inactive';
        }
        $tr_categories .= '<tr>
            <td> ' . $count . ' </td>
            <td> ' . $row->category_parent . ' </td>
            <td> ' . $row->category_name . ' </td>
            <td><span class="badge badge-pill badge-success">' . $status . '</span></td>
        </tr>';

        $id .= $row->category_id;
        $category_name .= $row->category_name;
        $category_status .= $row->category_status;
        if ($row->category_parent == 0) {
        }
        if ($id == $row->category_parent) {
            $cat_parent = $row->category_name;
        }
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
                    <td>

                </tbody>
            </table>
            <?php echo $links; ?>
        </div>
    </div>
</div>