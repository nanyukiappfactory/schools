<?php
$tr_schools = '';
if ($query->num_rows() > 0)
{
    $count = 0;

    foreach ($query->result() as $row) 
    {
        $id = $row->school_id; 
        $count++;
        $image = $row->school_image_name;
        if ($row->school_status == 1)
         {
            $status = 'Active';

            $status_anchor = anchor("schools/deactivate-school/" . $row->school_id . "/" . $row->school_status, "<i class='far fa-thumbs-down'></i>", array("class" => "btn btn-info btn-sm p-left-10", "onclick" => "return confirm('Are you sure you want to deactivate?')"));
         } else 
         {
            $status = 'Inactive';

            $status_anchor = anchor("schools/deactivate-school/" . $row->school_id . "/" . $row->school_status, "<i class='far fa-thumbs-up'></i>", array("class" => "btn btn-info btn-sm", "onclick" => "return confirm('Are you sure you want to activate?')"));
         }

        $tr_schools .= 
        '<tr>
            <td> ' . $count . ' </td>
            <td><img src="' . base_url() . 'assets/uploads/' . $row->school_thumb_name . '" width="70px"></td>
            <td> ' . strtoupper($row->school_name) . ' </td>
            <td> ' . $row->school_boys_number . ' </td>
            <td> ' . $row->school_girls_number . ' </td>
            <td>
                <span class="badge badge-pill badge-success">' . $status . '</span>
            </td>
            <td>' .
                anchor("schools/view-school/" . $row->school_id, "<i class='fas fa-eye'></i>", "class='btn btn-success btn-sm p-left-10'", "style='padding-left:10px;'","data-toggle='modal'","data-target='#modalQuickView'","data-toggle='modal'") . " " .
                anchor("schools/edit-school/" . $row->school_id, "<i class='fas fa-edit'></i>", "class='btn btn-warning btn-sm p-left-10'", "style='padding-left:10px;'") . " " .
                $status_anchor . " " .
                anchor("schools/delete-school/" . $row->school_id, "<i class='fas fa-trash-alt'></i>", array("class" => "btn btn-danger btn-sm", "onclick" => "return confirm('Are you sure you want to Delete?')")) . " " .
            '</td>
        </tr>';
    }
}
?>
<div class="shadow-lg p-3 mb-5 bg-white rounded" id="ads" style="margin-top:500px;">
	<div class="card-body">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<?php echo anchor("schools/add-school", "Add School", "class='btn btn-info btn-sm p-left-10'", "style='padding-left:10px;'"); ?>
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
			<tbody>
				<?php echo $tr_schools; ?>
			</tbody>
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
		<tbody>
			<?php echo $tr_schools; ?>
		</tbody>
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

