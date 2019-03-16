<!doctype html>
<html lang="en">

<head>
	
</head>
 
<body class="text-center">
    <?php 
    $error = $this->session->flashdata('error');
    if(!empty($error))
    {
        ?>
        <div class="alert alert-danger">
            <?php echo $error;?>
        </div>
        <?php
    }
    echo $content;
    ?>
</body>

</html>
