<?php
$alert = '';
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
if (!empty($error)) {
    $alert = '<div class="alert alert-danger">' . $error . '</div>';
}
if (!empty($success)) {
    $alert = '<div class="alert alert-success"> ' . $success . '</div>';
}
?>

<html>

<head>
    <?php $this->load->view('admin/layouts/header');?>
</head>

<body>
    
            <?php $this->load->view('admin/layouts/navigation');?>	
	
            <?php $this->load->view('admin/layouts/sidenav');?> 
             
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 mb-10"style="padding-top:600px;">

                <?php
                    echo $alert;
                    
                    echo $content;
                ?>
          

    <?php $this->load->view('admin/layouts/footer');?>
    </main>
    
</body>

</html>