<?php $this->view("includes/header");?>
<?php $this->view("includes/nav");?>
<main class="shadow p-3 mb-5 bg-body rounded">
	<div class="container">
		<a href="<?=ROOT?>lecture">
			<button class="btn btn-danger" type="button">Previous Page</button>
		</a>
	</div>
	<div class="container py-2" id="time_and_date">
		<div class="row" >
			<div class="col">
				<button type="button" class="btn btn-outline-secondary" id="date"></button>
			</div>
		</div>
	</div>
	<div class="container"><hr></div>
	<div class="container-fluid">
		<div class="p-3 mx-auto shadow rounded" style="width:100%; max-width: 50%; margin-top: 20px;">
			<h3 style="text-align: center; text-transform: uppercase;">Set Exam Date</h3>
			<form action="" method="POST">
				<input class=" my-2 form-control" value="<?=get_var('DateExam');?>" type="date" name="DateExam">
				<select name="Examtime"  value="<?=get_var('Examtime');?>" class="my-2 form-control" id="">
					<option value=""><------------------Select A Time For The Exam--------------------></option>
					<option <?=get_select('Examtime', '09:00');?> value="09:00">09:00 - 11:00</option>
					<option <?=get_select('Examtime', '09:30');?> value="09:30">09:30 - 11:30</option>
					<option <?=get_select('Examtime', '10:00');?> value="10:00">10:00 - 12:00</option>
					<option <?=get_select('Examtime', '10:30');?> value="10:30">10:30 - 12:30</option>
					<option <?=get_select('Examtime', '11:00');?> value="11:00">11:00 - 13:00</option>
					<option <?=get_select('Examtime', '11:30');?> value="11:30">11:30 - 13:30</option>
					<option <?=get_select('Examtime', '12:00');?> value="12:00">12:00 - 14:00</option>
				</select>
				<?php if($modulecode):?>
				<select name="modulecode" class="my-2 form-control" id="">
					<?php foreach($modulecode as $m):?>
					<?=display($m);?>
					<option <?=get_select('modulecode', $m->ModuleCode);?> value="<?=$m->ModuleCode;?>">
						<?=$m->ModuleCode;?>
					</option>
					<?php endforeach;?>
					<?php endif;?>
				</select>
				<button class="btn btn-primary d-block float-end" name="set_exam">Set Date</button>
				<div class="clearfix"></div>
			</form>
				<?php if(empty($_FILES['upload']) && count($errors) > 0): ?>
					<?php foreach($errors as $error): ?>
						<ul style="color:red;">
							<li><?=$error;?></li>
						</ul>
					<?php endforeach; ?>
				<?php elseif(empty($_FILES['upload'])): ;?>
					<p style="color:green">
						<?=$_SESSION['msg'];?>
					</p>
				<?php else: ;?>
					<?=$_SESSION['msg'] = "";?>
				<?php endif;?>
		</div>
	</div>
</main>
<?php $this->view("includes/footer");?>