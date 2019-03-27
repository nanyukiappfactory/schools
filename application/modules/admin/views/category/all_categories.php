<?php
 $tr_categories = '';
if ($query->num_rows() > 0) 
{
    $count = 0;
   
    $select = "";

    foreach ($query->result() as $row) 
    {
        $count++;
        if ($row->category_status == 1) 
        {
            $status = '<i class="badge badge-pill badge-success">Active</i>';
            
            $status_anchor = anchor("categories/deactivate-category/" . $row->category_id . "/" . $row->category_status, "<i class='far fa-thumbs-down'></i>", array("class" => "btn btn-default btn-sm p-left-10", "onclick" => "return confirm('Are you sure you want to deactivate?')"));
        } 
        else 
        {
            $status = '<i  class="badge badge-pill badge-warning">Inactive</i>';

            $status_anchor = anchor("categories/deactivate-category/" . $row->category_id . "/" . $row->category_status, "<i class='far fa-thumbs-up'></i>", array("class" => "btn btn-info btn-sm", "onclick" => "return confirm('Are you sure you want to activate?')"));
        }
        
        $tr_categories .= '<tr>
            <td> ' . $count . ' </td>
            <td> ' . $row->category_parent . ' </td>
            <td> ' . $row->category_name . ' </td>
            <td>' . $status . '</span></td>
            <td>' .
            anchor("admin/categories/view_category/" . $row->category_id, "<i class='fas fa-eye'></i>", "class='btn btn-success btn-sm p-left-10'", "style='padding-left:10px;'","data-toggle='modal'","data-target='#modalQuickView'","data-toggle='modal'") . " " . 
            anchor("categories/edit-category/" . $row->category_id, "<i class='fas fa-edit'></i>", "class='btn btn-warning btn-sm p-left-10'", "style='padding-left:10px;'") . 
            $status_anchor .
            anchor("categories/delete-category/" . $row->category_id, "<i class='fas fa-trash-alt'></i>", array("class" => "btn btn-danger btn-sm", "onclick" => "return confirm('Are you sure you want to Delete?')")) .
                '</td>
            </tr>';
            $select .= '<option value= ' . $row->category_id . '> ' . $row->category_name . '
            </option>';
    }
}
?>
<!-- Search -->
<div class="shadow-lg p-3 mb-5 bg-white rounded" id="ads">
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class = "row"> 
                    <div>
                    <?php echo anchor("categories/add-category/", "<i class='fas fa-edit'></i> Add Categoty", "class='btn btn-info btn-sm p-left-10 m-2'", "style='padding-left:10px;'"); ?>
                    &nbsp;&nbsp;
                    </div>
                    
                </div> 
            </div>
        </div>
    
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Parent
                            &nbsp;<?php echo anchor("categories/all-categories/" . $order . "/" . $order_method, "<i class='fas fa-sort'></i>"); ?>
                        </th>
                        <th>Category
                            Name
                            &nbsp;<?php echo anchor("categories/all-categories/" . $order . "/" . $order_method, "<i class='fas fa-sort'></i>"); ?>
                        </th>
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
            <!-- <?php echo $links; ?> -->
        </div>
</div>