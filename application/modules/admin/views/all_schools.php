
<div class="shadow-lg p-3 mb-5 bg-white rounded" id="ads" style="margin-top:500px;">
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
        <?php echo anchor("schools/delete-school/" . $row->school_id, '<i class="fas fa-trash-alt"></i>', array("class" => "btn btn-danger btn-sm", "onclick" => "return confirm('Are you sure you want to Delete?')")); ?>
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
<script type="text/javascript">
function initialize() {
    var position = new google.maps.LatLng('<?php echo $row->school_latitude; ?>',
        '<?php echo $row->school_longitude; ?>');
    var myOptions = {
        zoom: 15,
        center: position,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(
        document.getElementById("map_canvas<?php echo $row->school_id; ?>"),
        myOptions);

    var marker = new google.maps.Marker({
        position: position,
        map: map,
        title: "This is the place."
    });
    var infowincontent = document.createElement("div");
    var strong = document.createElement("strong");
    strong.textContent = "<?php echo $row->school_name; ?>";
    infowincontent.appendChild(strong);
    infowincontent.appendChild(document.createElement("br"));

    var text = document.createElement("text");
    text.textContent = "<?php echo $row->school_location_name; ?>";
    infowincontent.appendChild(text);

    var infowindow = new google.maps.InfoWindow({
        content: infowincontent
    });
    infowindow.open(map, marker);

}
google.maps.event.addDomListener(window, "load", initialize);
</script>


