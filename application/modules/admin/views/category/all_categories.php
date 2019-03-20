<?php
if ($query->num_rows() > 0) {
    $count = 0;
    $counts = '';
    $cat_name = '';
    $cat_parent = '';
    $cat_status = '';
    foreach ($query->result() as $row) {
        $count++;
        $counts .= '<td> ' . $count . ' </td>';
        $cat_parent .= '<td> ' . $row->category_parent . ' </td>';
        $cat_name .= '<td> ' . $row->category_name . ' </td>';
        $cat_status .= '<td>'?><?php
if ($row->category_status == 1) {?>
<span class="badge badge-pill badge-success">Active</span>
<?php } else {?>
<span class="badge badge-pill badge-secondary">Inactive</span>
<?php
}
        '</td>';
    }}
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
                <tr>
                    <?php echo $counts; ?>
                    <?php echo $cat_parent; ?>
                    <?php echo $cat_name; ?>
                    <?php echo $cat_status; ?>
                </tr>
            </tbody>
        </table>
        <?php echo $links; ?>
    </div>
</div>