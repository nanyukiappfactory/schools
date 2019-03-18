<!Doctype html>
<html lang="en">

 <?php $this->load->view('schools/layouts/header');?>
<body>
    <div class="container-fluid">
        <div class="row">
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10">
                <?php
                $error = $this->session->flashdata('error');
                $success = $this->session->flashdata('success');
                if (!empty($error)) 
                {?>
                    <div class="alert alert-danger"><?php echo $error; ?></div> 
                        <?php
                }
                if (!empty($success)) 
                {?>
                <div class="alert alert-success"><?php echo $success; ?></div>
                        <?php
                }

                echo $content;?>
            </main>
        </div>
    </div>
        <?php $this->load->view('schools/layouts/footer');?>
</body>

</html>
    