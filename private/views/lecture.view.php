<?php $this->view("includes/header");?>
<?php $this->view("includes/nav");?>
<main class="shadow p-3 mb-5 bg-body rounded">
	<div class="container py-2" id="time_and_date">
		<div class="row" >
			<div class="col">
				<button type="button" class="btn btn-outline-secondary" id="date"></button>
			</div>
			<div class="col">
				<?php if($staff):?>
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
					<a href="<?=ROOT;?>lecture/set_date">
						<button class="btn btn-primary me-md-2" type="button">Set Exam Date</button>
					</a>
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="container"><hr></div>
	<div class="container">
		<?php if($staff):?>
		<div class="row">
		<?php foreach($staff as $row): ?>
			<div class="col-4">
				<div class="card shadow-sm p-1 mb-2 bg-body rounded" style="width: 18rem;">
					<div class="card-header">
						<h5><?=$row->ModuleCode;?></h5>
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">Date: <?=escape(get_date($row->DateExam));?></li>
						<li class="list-group-item">Time: <?=escape(get_time($row->ExamTime)." - ".duration($row->ExamTime));?></li>
						<?php if(empty(escape($row->ExamPaperPDF))):?>
							<li class="list-group-item">Paper: Not Available</li>
							<a href="<?=ROOT;?>lecture/upload_question_paper?mod=<?=escape($row->ModuleCode);?>" class="btn btn-primary">
								Upload
							</a>
						<?php else:?>
							<li class="list-group-item">Paper: <?=escape($row->ExamPaperPDF);?></li>
							<a href="<?=ROOT;?>lecture/upload_question_paper?mod=<?=escape($row->ModuleCode);?>" class="btn btn-primary">
								Change Uploaded Paper
							</a>
						<?php endif;?>
					</ul>
				</div>
			</div>
		<?php endforeach;?>
		</div>
		<?php endif;?>
		
	</div>
</main>
<?php $this->view("includes/footer");?>