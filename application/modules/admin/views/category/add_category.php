<?php if (is_array($query->result())) {
    $select = "";
    foreach ($query->result() as $cat) {
        $select .= '<option value= ' . $cat->category_id . '> ' . $cat->category_name . '
</option>';

    }
}?>

<div class="shadow-lg p-3 mb-5 bg-white rounded" id="ads">
    <div class="card-body">
        <div class="card shadow mb-4">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new Category</h5>
            </div>
        </div>
    </div>
    <div class="modal-body">
        <?php echo form_open_multipart(base_url() . 'categories/all-categories'); ?>
        <div class="form-group">
            <label for="category_Parent">Parent</label>
            <select id="inputState" class="form-control" name="category_parent">
                <option value="">Choose a parent...</option>
                <?php echo $select; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="category_name"> Name</label>
            <input type="name" class="form-control" name="category_name" id="category_name"
                naria-describedby="emailHelp" placeholder="Enter category Name">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <?php echo form_close() ?>
    </div>