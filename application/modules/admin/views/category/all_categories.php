<?php
if ($query->num_rows() > 0) 
{
    $count = 0;
    $tr_categories = '';

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
            <td>' . anchor("categories/edit-category/" . $row->category_id, "<i class='fas fa-edit'></i>", "class='btn btn-warning btn-sm p-left-10'", "style='padding-left:10px;'") .
        $status_anchor .
        anchor("categories/delete-category/" . $row->category_id, "<i class='fas fa-trash-alt'></i>", array("class" => "btn btn-danger btn-sm", "onclick" => "return confirm('Are you sure you want to Delete?')")) .
            '</td>
        </tr>';
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
                <div>
                    <label class="sr-only" for="search">Search</label>
                        <div class="input-group">
                            <?php echo form_open(base_url() . 'categories/search-categories', array("class" => "form-inline  my-lg-0")) ?>
                            <select class="custom-select2 form-control mr-2 m-1" name="search">
                                <option value="">Choose ..</option>
                                <option value="<?php echo $row->category_name; ?>"><?php echo $row->category_name; ?></option>
                            </select>&nbsp;&nbsp;
                        </div>
                </div>
                <div class="active-cyan-3 active-cyan-4 m-1">
                    <input class="form-control" type="text" placeholder="Search" name="search" aria-label="Search">
                </div>
                &nbsp;&nbsp;&nbsp;
                <div>
                <button class="btn btn-outline-primary mt-2" type="submit"><i class="fas fa-search"></i></button>
                </div> 
                <div>
                    <?php echo form_close();
                        // Close search
                        if ($this->session->userdata('categories_search')) 
                            { 
                            ?>
                            <a class="btn btn-outline-primary btn-sm m-1" href="<?php echo base_url() . 'categories/' . '/close-search'; ?>">Close Search</a>     
                    <?php   }?>
                </div>
                <div>
                <a href="<?php echo site_url() . "categories/export-categories" ?>" target="_blank"
                    class="btn btn-default pull-right m-1"><i class="fas fa-file-export"></i> Export</a></div>
                 <div>
                 <?php echo form_open_multipart(base_url() . 'categories/import-categories');?>
                    <input type='file' name='file'>
                    <input type='submit' name='upload'>
                <?php form_close();?>
               </div>
                    </div> 
                </div> 
            </div>
        </div>
    </div>
    
    <div class="card-body">
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
            <?php echo $links; ?>
        </div>
    </div>
</div>