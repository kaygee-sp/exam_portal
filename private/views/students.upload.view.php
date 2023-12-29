<?php $this->view("includes/header");?>
<?php $this->view("includes/nav");?>
<main class="shadow p-3 mb-5 bg-body rounded">
	<div class="container">
		<a href="<?=ROOT?>student">
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
	<div class="container" id="download_paper">
		<?php if($staff_details):?>
			<h3>For exam queries, contact the lecture: </h3>
			<span class="d-block p-2 bg-info bg-opacity-25">Lecture Name : <?=escape($staff_details[0]->StaffName);?></span>
			<span class="d-block p-2 bg-light">Lecture Email : <?=escape($staff_details[0]->StaffEmail);?></span>
			<span class="d-block p-2 bg-info bg-opacity-25">Staff Number : <?=escape($staff_details[0]->StaffNumber);?></span>
		<?php endif;?>
		<br>
		<?php if($exam) :?>
		<form method="POST" enctype="multipart/form-data" action="">
			<table class="table table-striped" style="max-width: 80%;">
				<tr>
					<th>Module code</th>
					<th>Date</th>
					<th>Time</th>
					<th>Question Paper</th>
				</tr>
				<?php foreach($exam as $row): ?>
				<tr>
					<input type="hidden" name="mod" value="<?=escape($row->ModuleCode);?>">
					<td><?=escape($row->ModuleCode);?></td>
					<td><?=escape(get_date($row->DateExam));?></td>
					<td id="time_exam"> <?=escape(get_time($row->ExamTime)." - ".duration($row->ExamTime));?></td><td>
						<?php if(!empty($row->ExamPaperPDF)):?>
						<?=escape($row->ExamPaperPDF);?>
						<input type="hidden" name="code" value="<?=urlencode($row->ExamPaperPDF);?>">
					</td>
					<td>
						<?php $exam_time = time_remaining(date('Y'), date('m'), date('j'), escape(get_time($row->ExamTime)));?>
							<?php if(!$exam_time === "00"){ ?>
								Not uploaded.
							<?php }else{?>
								<button class="btn btn-primary" name="download" >Download</button>	
							<?php };?>
						<?php else:?>
							Not uploaded yet.
						<?php endif;?>
					</td>
					<input type="hidden" id="js_date" value="<?=escape(js_date($row->DateExam));?>">
				</tr>
				<?php endforeach;?>
			</table>
		</form>
		<?php else: ;?>
		<p>No module was selected</p>
		<?php endif;?>
	</div>

		<div class="container">
		<?php foreach($exam as $row): ;?>
			<?php $exam_time = time_remaining(date('Y'), date('m'), date('j'), escape(get_time($row->ExamTime)));?>
		<?php if(!$exam_time === "00"){ ?>
		<ul class="nav nav-tabs">
			<li class="nav-item">
				<a class="nav-link active" aria-current="page">Upload</a>
			</li>
			<li class="nav-item fw-bolder">
			<?php if(isset($_POST['download'])):?>
				<?php '<script src="<?=ASSETS;?>js/validation.js">
					countdown_Timer()
				</script>' ;?>
			<?php endif;?>
					<a class="nav-link text-danger" aria-current="page">
						<input type="text" disabled id="time_remaining" name="time_remaining" value="">
					</a>
			</li>
		</ul>
		<span class="d-block p-2 ">Only PDF documents allowed</span>
		
		<form method="POST" enctype="multipart/form-data" action="">
			<div class="mb-3 py-2" id="collapseExample">
				<label for="formFile" class="form-label"></label>
				<input class="form-control py-1" type="file" id="formFile" name="upload">
				<button class="btn btn-primary my-1 float-end" name="upload">Upload Exam Paper</button>
				<div class="clearfix"></div>
				<?php if(!empty($_FILES['upload'])): ?>
					<p><?=$_SESSION['error'];?></p>
				<?php else: ;?>
					<p><?=$_SESSION['error'] = "";?></p>
				<?php endif;?>
			</div>

		<?php } ;?>
		<br>
		<br>
		<hr>
			<?php endforeach;?>

			<?php if(!empty($output)):?>
				
					<?php if(!empty($_FILES['upload']['name'])):?>
						<span class="d-block p-2 bg-light">Submission Status : <div style="color: green; display: inline;"><?=$sub;?></div> </span>
						<span class="d-block p-2 bg-light">Email Status : <div style="color: green; display: inline;"><?=$msg;?></div> </span>
					<?php elseif(!empty($_SESSION['error'])):?>
						<span class="d-block p-2 bg-light">Submission Status : <div style="color: red; display: inline;">Failed</div> </span>
					<?php else:?>
					<?php endif;?>
					<span class="d-block p-2 bg-success bg-opacity-25">Reference Number : <?=escape($output[0]->TransactionID);?></span>
					<span class="d-block p-2 bg-light">Student Number : <?=escape($output[0]->StudentNumber);?></span>
					<span class="d-block p-2 bg-success bg-opacity-25">Module Code : <?=escape($output[0]->ModuleCode);?> </span>
					<span class="d-block p-2 bg-light">File Submitted (Renamed) : <?=escape($output[0]->AnswerPaperPDF);?> </span>
					<span class="d-block p-2 bg-success bg-opacity-25">Upload Time : <?=escape($output[0]->UploadTime);?> </span>
				
			<?php else:?>
				<br>
					<p>No file submission record found.</p>
			<?php endif;?>
		</form>
		</div>

</main>
<?php $this->view("includes/footer");?>