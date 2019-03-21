<?php
$cat_arr = array();
foreach ($query->result() as $category) {
    if (!in_array($category->category_parent, $cat_arr)) {
        foreach ($query->result() as $cat) {
            if ($category->category_parent == $cat->category_id) {
                array_push($cat_arr, $category->category_parent);
                $select .= '<option value=' . $cat->category_id . '> ' . $category->category_parent == $category_parent . '? "selected" : "";>
    ' . $cat->category_name . '></option>';
            }
        }
    }
}
?>
<div class="container">
    <div class="card-header py-3">
        <h3 class="form-group row ml-5">Edit Categories</h3>
    </div>
    <div class="container">
        <?php echo form_open($this->uri->uri_string()); ?>
        <div class="form-group">
            <label for="category_parent">Parent</label>
            <?php echo $select; ?>
        </div>
        <div class="form-group">
            <label for="category_name">Name</label>
            <input type="category_name" class="form-control" name="category_name" id="category_name"
                placeholder="Enter Name" value=" <?php echo $category_name; ?>">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <?php echo form_close() ?>
    </div>
</div>