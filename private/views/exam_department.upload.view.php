<?php $this->view("includes/header");?>
<?php $this->view("includes/nav");?>
<main class="shadow p-3 mb-5 bg-body rounded">
	<div class="container">
		<a href="<?=ROOT?>exam_department">
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
			<h3 style="text-align: center; text-transform: uppercase;">Upload Question Paper</h3>
			<form action="" method="POST" enctype="multipart/form-data">
				<select name="modulecode" class="my-2 form-control" id="modulecode">
					<option <?=get_select('modulecode', '');?> value=""><------------------------------Select A Module---------------------------------></option>
					<?php foreach($modules as $mod):?>
					<option <?=get_select('modulecode', $mod->ModuleCode);?> value="<?=$mod->ModuleCode;?>">
						<?=escape($mod->ModuleCode);?>
					</option>
					<?php endforeach;?>
				</select>
				<input class="form-control py-1" type="file" id="formFile" name="upload">
				<button class="btn btn-primary d-block my-1 float-end" name="upload_file">Upload Question Paper</button>
				<div class="clearfix"></div>
				<?php if($_SESSION['msg'] != "" && isset($_POST['upload_file'])):?>
					<span class="d-block p-2 bg-light">Submission Status : <div style="color: green; display: inline;"><?=$_SESSION['msg'];?></div> </span>
				<?php endif;?>
			</form>
			<?php if(!empty($errors)):?>
				<p style="color:red;"><?=$errors;?></p>
			<?php endif; ?>

			<?php if(!empty($_FILES['upload'])): ?>
				<p style="color:red;"><?=$_SESSION['error'];?></p>
			<?php else: ;?>
				<p><?=$_SESSION['error'] = "";?></p>
			<?php endif;?>
		</div>
	</div>
</main>
<?php $this->view("includes/footer");?>