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
                }?>
 <?php $this->load->view('admin/layouts/header');?>
<body>
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10">
             <?php
                echo $alert;?>
            <?php $this->load->view('admin/layouts/navigation');?>	
	
		     <?php $this->load->view('admin/layouts/sidenav');?> 
                <?php
                echo $content;?>
                <?php $this->load->view('admin/layouts/footer');?>

            </main>
        </div>
    </div>
        <?php $this->load->view('admin/layouts/footer');?>
</body>
</html>