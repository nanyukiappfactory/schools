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
echo anchor("categories/add-category/", "<i class='fas fa-edit'></i> Add Categoty", "class='btn btn-info btn-sm p-left-10'", "style='padding-left:10px;'");
?>
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
                    <a href="" class="btn btn-dark btn-sm" data-toggle="modal"
                        data-target="#modalLoginAvatar<?php echo $id ?>"><i class="fas fa-eye">View</i></a>
                    <div class="modal fade" id="modalLoginAvatar<?php echo $id ?>" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
                            <!--Content-->
                            <div class="modal-content" style="margin-left:0px;">
                                <!--Body-->
                                <div class="modal-body ">
                                    <h5 class="pl-3 pb-3" style="font-size:20px;list-style-type:none;margin-left:10px;">
                                        <b>Retrieved:</b> <?php echo $category_name; ?></h5>
                                    <div class=" pl-3 pb-3"
                                        style="font-size:20px;list-style-type:none;margin-left:10px;">
                                        <li><b>Parent:</b>
                                            <?php echo $cat_parent; ?>
                                        </li>
                                    </div>
                                    <div class="pl-3" style="font-size:20px;list-style-type:none;margin-left:10px;">
                                        <li><b>Name:</b> <?php echo $category_name; ?></li>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!--/.Content-->
                        </div>
                    </div>
                    <?php echo anchor("categories/edit-category/" . $id, "<i class='fas fa-edit'>Edit</i>", "class='btn btn-warning btn-sm p-left-10'", "style='padding-left:10px;'"); ?>
                    <?php if ($category_status == 1) {
    echo anchor("categories/deactivate-category/" . $id . "/" . $category_status, "<i class='far fa-thumbs-down'>Activate</i>", array("class" => "btn btn-info btn-sm p-left-10", "onclick" => "return confirm('Are you sure you want to deactivate?')"));
} else {
    echo anchor("categories/deactivate-category/" . $id . "/" . $category_status, "<i class='far fa-thumbs-up'>Deactivate</i>", array("class" => "btn btn-info btn-sm", "onclick" => "return confirm('Are you sure you want to activate?')"));
}?>
                    <?php echo anchor("categories/delete-category/" . $id, "<i class='fas fa-trash-alt'>Delete</i>", array("class" => "btn btn-danger btn-sm", "onclick" => "return confirm('Are you sure you want to Delete?')")); ?>
                </td>
            </tbody>
        </table>
        <?php echo $links; ?>
    </div>
</div>