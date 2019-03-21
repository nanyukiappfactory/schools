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
    <div class="container-fluid">
        <div class="row">
            <?php $this->load->view('admin/layouts/sidenav');?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 mb-10">
                <?php echo $alert; ?>
                <?php echo $content; ?>
            </main>
        </div>
    </div>
    <?php $this->load->view('admin/layouts/footer');?>
</body>

</html>