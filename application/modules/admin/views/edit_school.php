<?php
if ($query->num_rows() > 0) {
    $count = 0;
    foreach ($query->result() as $row) {
        $id = $row->school_id;
        $count++;
        $image = $row->school_image_name;
        // $image = 'school_default.jpeg';
        ?>
<div class="modal-content">
    <div class="card-header">
        <h5 class="modal-title" id="exampleModalLabel">
            Update School
            Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <h5 class="card-title">Enter school Details to
            update</h5>
        <?php echo form_open($this->uri->uri_string()); ?>
        <div class="form-group row">
            <label for="school_name" class="col-sm-2 col-form-label">School
                Name</label>
            <div class="col-md-10">
                <?php echo form_input(['name' => 'school_name', 'placeholder' => 'School Name', 'class' => 'form-control', 'value' => set_value('school_name', $row->school_name)]) ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="school_zone" class="col-sm-2 col-form-label">School
                Zone</label>
            <div class="col-md-10">
                <select id="inputState" class="form-control" name="school_zone"
                    value="<?php echo set_value('school_zone', $this->session->flashdata('form_inputs')['school_zone']); ?>"
                    required>
                    <option <?php echo $row->school_zone ? 'selected' : ''; ?>>
                        <?php echo $row->school_zone ?></option>
                    <option value="Daiga">Daiga </option>
                    <option value="Gituamba"> Gituamba </option>
                    <option value="Igwamiti"> Igwamiti </option>
                    <option value="Kinamba"> Kinamba </option>
                    <option value="Marmanet"> Marmanet </option>
                    <option value="Muhotetu"> Muhotetu </option>
                    <option value="Mukogodo East "> Mukogodo East </option>
                    <option value="Mutara"> Mutara </option>
                    <option value="Nanyuki North "> Nanyuki North </option>
                    <option value="Nanyuki South "> Nanyuki South </option>
                    <option value="Ngobit"> Ngobit </option>
                    <option value="Nyahururu "> Nyahururu </option>
                    <option value="Ol Moran"> Ol Moran </option>’
                    <option value="Rumuruti "> Rumuruti </option>
                    <option value="Salama"> Salama </option>
                    <option value="Sipili"> Sipili </option>
                    <option value="Sirima"> Sirima </option>
                    <option value="Tigithi"> Tigithi </option>
                </select>
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="school_boys_number" class="col-sm-2 col-form-label">Number
                of
                Boys</label>
            <div class="col-md-10">
                <?php echo form_input(['name' => 'school_boys_number', 'placeholder' => 'Number of boys, eg. 10', 'class' => 'form-control', 'value' => set_value('school_boys_number', $row->school_boys_number)]) ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="school_girls_number" class="col-sm-2 col-form-label">Number
                of
                Girls</label>
            <div class="col-md-10">
                <?php echo form_input(['name' => 'school_girls_number', 'placeholder' => 'Enter First Name', 'class' => 'form-control', 'value' => set_value('firstname', $row->school_girls_number)]) ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="school_girls_number" class="col-sm-2 col-form-label">School Image</label>
            <div class="col-md-10">
                <img src="<?php echo base_url() . 'assets/uploads/' . $image; ?>" height="205" width="205">
            </div>

            <label for="school_girls_number" class="col-sm-2 col-form-label">Upload New
                Image</label>
            <div class="col-md-10">
                <input type="file" name="school_image" />
            </div>

        </div>
        <div class="form-group row">
            <label for="school_latitude" class="col-sm-2 col-form-label">Latitude</label>
            <div class="col-md-10">
                <?php echo form_input(['name' => 'school_latitude', 'placeholder' => 'Enter Latitude', 'class' => 'form-control', 'value' => set_value('school_latitude', $row->school_latitude)]) ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="school_longitude" class="col-sm-2 col-form-label">Longitude</label>
            <div class="col-md-10">
                <?php echo form_input(['name' => 'school_longitude', 'placeholder' => 'Longitude', 'class' => 'form-control', 'value' => set_value('school_longitude', $row->school_longitude), 'required']) ?>
            </div>
        </div>
        <div class="form-group row">
            <label for="school_location_name" class="col-sm-2 col-form-label">Location
                Name</label>
            <div class="col-md-10">
                <?php echo form_input(['name' => 'school_location_name', 'placeholder' => 'Location Name', 'class' => 'form-control', 'value' => set_value('school_location_name', $row->school_location_name)]) ?>
            </div>
        </div>
        <div class="form-group">
            <label for="school_status">School Status</label>
            <div class="col-md-10">
                <input type="radio" name="school_status" value="1" <?php
echo set_value('school_status', $row->school_status) == 1 ? "checked" : "";
        ?> />Active

                <input type="radio" name="school_status" value="0" <?php
echo set_value('school_status', $row->school_status) == 0 ? "checked" : "";
        ?> />Inactive
            </div>
            <small id="emailHelp" class="form-text text-muted"></small>
        </div>

        <div class=" form-group">
            <label for="school_write_up">School Write Up</label>
            <textarea id="editable" class="editable"
                name="school_write_up"><?php echo set_value('school_write_up', $row->school_write_up); ?></textarea>
            <div class="form-group">
                <!-- <small id="emailHelp" class="form-text text-muted"></small> -->
            </div>
            <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
                <div class="modal-footer">
                    <div class="modal-footer">
                        <?php echo anchor('laikipiaschools/schools', '<i class="fas fa-times"></i>Cancel', ['class' => 'btn btn-secondary']); ?>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>Save
                        School</button>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php
}
}
?>