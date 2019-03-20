
    <?php echo form_open_multipart(base_url() . 'school/add-school'); ?>
        <div class="form-group">
            <label for="school_name">School Name</label>
            <input type="text" class="form-control" id="school_name" aria-describedby="emailHelp" name="school_name"
                placeholder="School Name" value="<?php echo set_value('school_name', $this->session->flashdata('form_inputs')['school_name']); ?>">
        </div>

        <div class="form-group">
            <label for="school_zone">Zone</label>
            <select id="inputState" class="form-control" name="school_zone"
                value="<?php echo set_value('school_zone', $this->session->flashdata('form_inputs')['school_zone']); ?>"
                >
                <option selected>Choose your zone...</option>
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
            <!-- <small id="emailHelp" class="form-text text-muted"></small> -->
</div>

        <div class="form-group">
            <label for="school_boys_number">Number of boys</label>
            <input type="number" class="form-control" id="school_boys_number" aria-describedby="emailHelp"
                name="school_boys_number"
                value="<?php echo set_value('school_boys_number', $this->session->flashdata('form_inputs')['school_boys_number']); ?>"
                placeholder="Number of Boys">
        </div>
        <div class="form-group">
            <label for="school_girls_number">Number of Girls</label>
            <input type="number" class="form-control" id="school_girls_number" aria-describedby="emailHelp"
                name="school_girls_number" placeholder="Number of Girls"
                value="<?php echo set_value('school_girls_number', $this->session->flashdata('form_inputs')['school_girls_number']); ?>"
                >
        </div>

        <div class="form-group">
            <label for="school_status">Status</label>
            <div class="col-sm-10 row">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="school_status" id="school_status" value="1"
                        checked>
                    <Legend class="form-check-label" for="gridRadios1">
                        Active
                    </Legend>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="school_status" id="school_status" value="0">
                    <Legend class="form-check-label" for="gridRadios2">
                        Inactive
                    </Legend>
                </div>
            </div>
            <small id="emailHelp" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
            <label for="school_location_name">Location Description</label>
            <input type="text" class="form-control" id="school_location_name" aria-describedby="emailHelp"
                name="school_location_name" placeholder="Location Description"
                value="<?php echo set_value('school_location_name', $this->session->flashdata('form_inputs')['school_location_name']); ?>"
                >
            <small id="emailHelp" class="form-text text-muted"></small>
        </div>

        <div class="form-group">
            <label for="school_latitude">Latitude</label>
            <input type="numeric" class="form-control" id="school_latitude" aria-describedby="emailHelp"
                name="school_latitude" placeholder="Latitude"
                value="<?php echo set_value('school_latitude', $this->session->flashdata('form_inputs')['school_latitude']); ?>"
                d>
            <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
            <label for="school_longitude">Longitude</label>
            <input type="numeric" class="form-control" id="school_longitude" aria-describedby="emailHelp"
                name="school_longitude" placeholder="Longitude"
                value="<?php echo set_value('school_longitude', $this->session->flashdata('form_inputs')['school_longitude']); ?>"
             >
            <small id="emailHelp" class="form-text text-muted"></small>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-12">
                <label for="school_image">Profile
                    Image</label>
                <input type="file" id="school_image" name="school_image">
            </div>
        </div>



        <div class="form-group">
            <label for="school_write_up">School Write Up:</label>
            <textarea class="editable" name="school_write_up"rows="5" id="editable" class="editable"
                value="<?php echo set_value('school_write_up', $this->session->flashdata('form_inputs')['school_write_up']); ?>"></textarea>
        </div>

        <div class="modal-footer">
            <div class="modal-footer">
                <?php echo anchor('school/schools', '<i class="fas fa-times"></i>Cancel', ['class' => 'btn btn-secondary']); ?>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>Save</button>
        </div>
        <?php echo form_close(); ?>

    
