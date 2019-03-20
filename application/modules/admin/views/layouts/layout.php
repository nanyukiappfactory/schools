<?php 
$alert = '';
$error = $this->session->flashdata('error');
$success = $this->session->flashdata('success');
if (!empty($error)) 
{
    $alert =  '<div class="alert alert-danger">'. $error . '</div>' ; 
}
if (!empty($success)) 
{
    $alert = '<div class="alert alert-success"> '.$success.'</div>';
}
$this->load->view('admin/layouts/header');

?>
 
<body>
    <div class="container-fluid">
        <div class="row">
            <?php $this->load->view('admin/layouts/navigation');?>	
	
            <?php $this->load->view('admin/layouts/sidenav');?> 
             
            <main role="main" style="margin-top:400px;" class="col-md-9 ml-sm-auto col-lg-10 mb-10">

                <?php
                    echo $alert;
                    
                    echo $content;
                ?>
            </main>
        </div>
    </div>

    <?php $this->load->view('admin/layouts/footer');?>
    
</body>
</html>