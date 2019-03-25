<?php
foreach ($query->result() as $row)
 {
    $count = 0;
    $id = $row->school_id;
    $count++;
    $image = $row->school_image_name;
    if ($row->school_status == 1) {
        $status = 'Active';

        $status_anchor = anchor("schools/deactivate-school/" . $row->school_id . "/" . $row->school_status, "<i class='far fa-thumbs-down'></i>", array("class" => "btn btn-info btn-sm p-left-10", "onclick" => "return confirm('Are you sure you want to deactivate?')"));
    } else 
    {
        $status = 'Inactive';
        $status_anchor = anchor("schools/deactivate-school/" . $row->school_id . "/" . $row->school_status, "<i class='far fa-thumbs-up'></i>", array("class" => "btn btn-info btn-sm", "onclick" => "return confirm('Are you sure you want to activate?')"));
    }
    $school_name = strtoupper($row->school_name);
    $boys_number = strtoupper($row->school_boys_number);
    $girls_number = strtoupper($row->school_girls_number);
    $school_zone = strtoupper($row->school_zone);
    $school_write_up = $row->school_write_up;
    $count = 0;
    foreach ($pictures->result() as $row1) 
    {
        if ($row->school_id == $row1->school_id)
         {
            $count++;
        }
    }
}
?>
<h3><?php echo $row->school_name; ?></h3>
<div class="row" style ="margin-left:200px;">
    <div class="col-sm-4 col-md-3 col-lg-3">
        <div class="owl-carousel schoolGalleryCarousel"><img src="<?php echo base_url() . 'assets/uploads/' . $image; ?>" alt="...">
        </div>
        <div  style="border:0px solid grey">
                <div class="form-group">
                    <h6 class="title-price">School</h6>
                    <label><b><?php echo $school_name ?></b></label>
                    <h6 class="title-price">Zone</h6>
                    <label><b><?php echo $school_zone ?></b></label>
                    <h6 class="title-price">Number Of Boys</h6>
                    <label><b> <?php echo $boys_number ?></b></label>
                    <h6 class="title-price">Number Of Girls</h6>
                    <label><b><?php echo $girls_number; ?></b></label>
                    <h6 class="title-price">School Status</h6>
                    <label><b> <?php echo $status_anchor ?></b></label>
                </div>
        </div>
    </div>
    <div class="col-sm-8 col-md-9 col-lg-9">
        <div id="map_canvas<?php echo $row->school_id; ?>" style="width:200%; height:500px;margin-left:400px;"></div>
    </div>
</div>

 <div class="row mt-4" style ="margin-left:300px;">
     <div class="col-md-12 col-sm-12">
        <h6 class="title-price mt-4"><small>Write Up</small></h6>
        <div style="width:100%;border-top:1px solid silver">
            <p class="mt-3"><?php echo $school_write_up; ?> </p>
        </div>
     </div>
 </div>
    <h3 style ="margin-left:300px;">Gallery</h3>
        <div class="owl-carousel schoolGalleryCarousel" style ="margin-left:300px;">
            <div>
                <a href="<?php echo base_url() . 'assets/uploads/' . $row1->school_image_name; ?>"><img src="<?php echo base_url() . 'assets/uploads/' . $row1->school_image_name; ?> " alt="..."><?php echo anchor("administration/delete-school-image/" . $row1->school_image_id, "<i class='fas fa-trash-alt'></i>", array("class" => "btn btn-danger btn-sm p-left-10", "onclick" => "return confirm('Are you sure you want to delete image?')")); ?>
                </a>
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

