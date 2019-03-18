
<?php echo form_open($this->uri->uri_string(), array("class" => "form-signin","style"=>"padding:20px;background-color:#259dbb;border-radius:5px;"));?>
	<img class="rounded-circle mx-auto d-block" src="<?php echo base_url();?>assets/uploads/lock1.jpg" alt="" width="90" height="90">
	<h1 class="h3 mb-3 ml-5 font-weight-normal" ><?php echo  $title;?></h1>
	<label for="user_name" class="sr-only m">Username</label>
	<input type="text" style="margin-bottom:40px;" id="user_name" name="user_name" class="form-control" placeholder="Username">
	<label for="user_password" class="sr-only">Password</label>
	<input type="password" style="margin-bottom:40px;" id="user_password"  name="user_password" class="form-control" placeholder="Password">
	<button class="btn btn-lg btn-secondary btn-block" type="submit">Login</button>
<?php echo form_close();