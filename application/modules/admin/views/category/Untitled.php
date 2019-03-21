<td>
    <?php foreach ($query->result() as $row) {
    if ($row->category_status == 1) {?>

    <a href="" class="btn btn-dark btn-sm" data-toggle="modal"
        data-target="#modalLoginAvatar<?php echo $row->category_id; ?>"><i class="fas fa-eye"></i></a>
    <?php }?>
    <!--Modal: Login with Avatar Form-->
    <div class="modal fade" id="modalLoginAvatar<?php echo $row->category_id; ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
            <!--Content-->
            <div class="modal-content" style="margin-left:0px;">
                <!--Body-->
                <div class="modal-body ">

                    <h5 class="pl-3 pb-3" style="font-size:20px;list-style-type:none;margin-left:10px;">
                        <b>Retrieved:</b> <?php echo $row->category_name; ?></h5>

                    <div class=" pl-3 pb-3" style="font-size:20px;list-style-type:none;margin-left:10px;">
                        <li><b>Parent:</b>
                            <?php if ($row->category_parent == 0) {
    echo "";
} else {
    foreach ($categories->result() as $category) {
        if ($category->category_id == $row->category_parent) {
            echo $category->category_name;
        }

    }
}

?>
                        </li>
                    </div>
                    <div class="pl-3" style="font-size:20px;list-style-type:none;margin-left:10px;">
                        <li><b>Name:</b> <?php echo $row->category_name; ?></li>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>

            </div>
            <!--/.Content-->
        </div>
    </div>
    <?php echo anchor("administration/edit_category/" . $row->category_id, "<i class='fas fa-edit'></i>", "class='btn btn-warning btn-sm p-left-10'", "style='padding-left:10px;'"); ?>

    <?php if ($row->category_status == 1) {
    echo anchor("administration/deactivate-category/" . $row->category_id . "/" . $row->category_status, "<i class='far fa-thumbs-down'></i>", array("class" => "btn btn-info btn-sm p-left-10", "onclick" => "return confirm('Are you sure you want to deactivate?')"));
} else {
    echo anchor("administration/deactivate-category/" . $row->category_id . "/" . $row->category_status, "<i class='far fa-thumbs-up'></i>", array("class" => "btn btn-info btn-sm", "onclick" => "return confirm('Are you sure you want to activate?')"));
}?>
    <?php echo anchor("administration/delete-category/" . $row->category_id, "<i class='fas fa-trash-alt'></i>", array("class" => "btn btn-danger btn-sm", "onclick" => "return confirm('Are you sure you want to Delete?')")); ?>

</td>
<? }