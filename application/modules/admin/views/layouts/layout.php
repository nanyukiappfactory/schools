<!DOCTYPE html>
<html>
    
    <?php $this->load->view('admin/layouts/header'); ?>
<body>
    <?php 
        $success = $this->session->flashdata('success');
        if(!empty($success))
        {?>
            <div class="alert alert-success"><?php echo $success;?></div>
        <?php }
    ?>
    <?php echo $content ?>
</body>
</html>