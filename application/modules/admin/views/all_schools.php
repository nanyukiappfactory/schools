
<div class="shadow-lg p-3 mb-5 bg-white rounded" id="ads">
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php echo anchor("school/add-school", "<i class='fas fa-edit'></i> Add School", "class='btn btn-info btn-sm p-left-10'", "style='padding-left:10px;'"); ?>
                <!-- <input type="file" class="btn btn-default pull-right" placeholder="Import" /> -->
                
            </div>
        </div>
    </div>

    <div class=" table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th> School Picture</th>
                    <th>School Name</th>
                    <th>Number of Boys</th>
                    <th>Number of Girls</th>
                    <th>Status</th>
                    <th colspan="4">Actions</th>
                </tr>
            </thead>
    
            <?php
if ($query->num_rows() > 0)
 {
    $count = 0;
    foreach ($query->result() as $row) {
        $id = $row->school_id;
        $count++;
        $image = $row->school_image_name;
        // $image = 'school_default.jpeg';
        ?>

<tr>
    <td>
        <?php echo $count; ?>
    </td>
    <td>
        <img src="<?php echo base_url() . 'assets/uploads/' . $row->school_thumb_name; ?>" width="70px">
    </td>
    <td>
        <?php echo strtoupper($row->school_name); ?>
    </td>
    <td>
        <?php echo $row->school_boys_number; ?>
    </td>
    <td>
        <?php echo $row->school_girls_number; ?>
    </td>
    <td>
        <?php if ($row->school_status == 1) {?>
        <span class="badge badge-pill badge-success">Active</span>
        <?php } else {?>
        <span class="badge badge-pill badge-secondary">Inactive</span>
        <?php }?>
    </td>
    <td>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
            data-target="#modalQuickView<?php echo $row->school_id; ?>">
            <i class="fas fa-eye"></i>
        </button>
<!-- statr of view school -->
       
        <!-- end of view school -->
    </td>
    <td>
        <?php echo anchor("school/edit-school/" . $row->school_id, "<i class='fas fa-edit'></i>", "class='btn btn-warning btn-sm p-left-10'", "style='padding-left:10px;'"); ?>
    </td>
    <td>
        <?php if ($row->school_status == 1) {
            echo anchor("school/deactivate-school/" . $row->school_id . "/" . $row->school_status, "<i class='far fa-thumbs-down'></i>", array("class" => "btn btn-info btn-sm p-left-10", "onclick" => "return confirm('Are you sure you want to deactivate?')"));
        } else {
            echo anchor("school/deactivate-school/" . $row->school_id . "/" . $row->school_status, "<i class='far fa-thumbs-up'></i>", array("class" => "btn btn-info btn-sm", "onclick" => "return confirm('Are you sure you want to activate?')"));
        }?>
    </td>
    <td>
        <?php echo anchor("school/delete-school/" . $row->school_id, '<i class="fas fa-trash-alt"></i>', array("class" => "btn btn-danger btn-sm", "onclick" => "return confirm('Are you sure you want to Delete?')")); ?>
    </td>
    
</tr>
<?php }}?>

          <tfoot>
                <tr>
                    <th>#</th>
                    <th>School Picture</th>
                    <th>School Name</th>
                    <th>Number of Boys</th>
                    <th>Number of Girls</th>
                    <th>Status</th>
                    <th colspan="4">Actions</th>
                </tr>
            </tfoot>
            
        </table>
    </div>
</div>
