
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
            data-target="#modalQuickView<?php echo $row->school_id; ?>">
            <i class="fas fa-eye"></i>
        </button>
<!-- statr of view school -->
<div class="modal fade" id="modalQuickView<?php echo $row->school_id; ?>" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <?php echo strtoupper($row->school_name); ?>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-5 col-sm-12">
                                    <img style="max-width:100%;"
                                        src="<?php echo base_url() . 'assets/uploads/' . $image; ?>"
                                        class="d-block w-100" alt="No Image" />
                                </div>
                                <div class="col-md-7 col-sm-12 " style="border:0px solid gray">
                                    <div class="form-group">
                                        <h6 class="title-price"><small>School</small></h6>
                                        <label><b>
                                                <?php echo strtoupper($row->school_name); ?></b></label>
                                        <h6 class="title-price"><small>Zone</small></h6>
                                        <label><b>
                                                <?php echo strtoupper($row->school_zone); ?></b></label>
                                        <h6 class="title-price"><small>Number Of Boys</small></h6>
                                        <label><b>
                                                <?php echo $row->school_boys_number; ?></b></label>
                                        <h6 class="title-price"><small>Number Of Girls</small></h6>
                                        <label><b>
                                                <?php echo $row->school_girls_number; ?></b></label>
                                        <h6 class="title-price"><small>School Status</small></h6>
                                        <label><b>
                                                <?php if ($row->school_status == 1) {?>
                                                <span class="badge badge-pill badge-success">Active</span>
                                                <?php } else {?>
                                                <span class="badge badge-pill badge-secondary">Inactive</span>
                                                <?php }?>
                                            </b></label>
                                    </div>
                                </div>
                            </div>

                            <h3>Gallery</h3>

                            <div class="owl-carousel schoolGalleryCarousel ">
                                <?php
$count = 0;
        foreach ($pictures->result() as $row1) {
            if ($row->school_id == $row1->school_id) {
                $count++
                ?>
                                <div>
                                    <a href="<?php echo base_url() . 'assets/uploads/' . $row1->school_image_name; ?>"><img
                                            src="<?php echo base_url() . 'assets/uploads/' . $row1->school_image_name; ?> "
                                            alt="..."><?php echo anchor("administration/delete-school-image/" . $row1->school_image_id, "<i class='fas fa-trash-alt'></i>", array("class" => "btn btn-danger btn-sm p-left-10", "onclick" => "return confirm('Are you sure you want to delete image?')")); ?>
                                    </a>

                                </div>
                                <?php }}?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <h6 class="title-price mt-4"><small>Write Up</small></h6>
                            <div style="width:100%;border-top:1px solid silver">
                                <p class="mt-3">
                                    <small>
                                        <?php echo $row->school_write_up; ?>
                                    </small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="map_canvas<?php echo $row->school_id; ?>" style="width:100%; height:500px"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <!-- end of view school -->
    