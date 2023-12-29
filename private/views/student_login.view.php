<?php $this->view("includes/header");?>
<div class="background"></div>
<form method="POST" class="login">
	<h1>Student</h1>
	<div class="inputBox">
		<input type="text" name="student_number" value="<?=get_var('student_number');?>" id="username" required>
		<span>Student number</span>
	</div>
	<br>
	<div class="inputBox">
		<input type="password" name="password" id="password" required>
		<span>password</span>
	</div>
	<br>
	<div id="links">
		<a href="<?=ROOT;?>staff_login">I'm Not A Student</a>
		<a href="<?=ROOT;?>reset_password" style="margin-left: 3em;">Forgot Password</a>
	</div>
	<input type="submit" name="submits" id="submit" value="Login">
	<?php if(count($errors) > 0):?>
	<div id="errors">
		<?php foreach($errors as $error): ?>
		<ul>
			<li id="text" style="text-align: center;"><?=$error;?></li>
		</ul>
		<?php endforeach;?>
	</div>
	<?php endif;?>
<div class="container py-1">
	<div class="row" >
		<div class="col">
			<button type="button" class="btn btn-outline-secondary">
				Password is the same as the student no:
				 11141311 ,99744705, 10825592
			</button>
		</div>
	</div>
</div>
</form>