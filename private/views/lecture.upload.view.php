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
	<div class="container">
		<?php if($info):?>
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" aria-current="page">
					<?=escape($info->ModuleCode);?>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" aria-current="page">
					<?=escape($info->DateExam);?>
				</a>
			</li>
		</ul>
		<span class="d-block p-2 ">Only PDF documents allowed</span>
		<?php endif;?>
		<form method="POST" enctype="multipart/form-data">
			<div class="">
				<label for="formFile" class="form-label"></label>
				<input class="form-control py-1" type="file" id="formFile" name="upload">
				<button class="btn btn-primary my-1 float-end" name="upload">Upload Question Paper</button>
				<div class="clearfix"></div>
			</div>
			<?php if($_SESSION['msg'] != "" && isset($_POST['upload'])):?>
				<span class="d-block p-2 bg-light">Submission Status : <div style="color: green; display: inline;"><?=$_SESSION['msg'];?></div> </span>
			<?php endif;?>
		</form>
		<?php if(!empty($_FILES['upload'])): ?>
		<p style="color: red"><?=$_SESSION['error'];?></p>
		<?php else: ;?>
		<p><?=$_SESSION['error'] = "";?></p>
		<?php endif;?>
	</div>
</main>
<?php $this->view("includes/footer");?>