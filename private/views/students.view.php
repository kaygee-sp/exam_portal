<?php $this->view("includes/header");?>
<?php $this->view("includes/nav");?>
<main class="shadow p-3 mb-5 bg-body rounded">
	<div class="container py-2">
		<div class="row" >
			<div class="col">
				<button type="button" class="btn btn-outline-secondary" id="date"></button>
			</div>
		</div>
	</div>
	<div class="container"><hr></div>
	<div class="container py-2">
			<?php if($data) :?>
			<div class="row">
				<?php foreach($data as $row): ?>
					<div class="col-4">
						<div class="card py-2 px-2 shadow-sm p-1 mb-2 bg-body" style="width: 18rem;">
							<div class="card-header">
								<h5><?=escape($row->ModuleCode);?></h5>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item">Date: <?=escape(get_date($row->DateExam));?></li>
								<li class="list-group-item">Time: <?=escape(get_time($row->ExamTime)." - ".duration($row->ExamTime));?></li>
								<li class="list-group-item">Lecture: <?=escape($row->StaffName);?></li>
								<li class="list-group-item">Email: <?=escape($row->StaffEmail);?></li>
								<a href="<?=ROOT;?>student/download?mod=<?=escape($row->ModuleCode);?>" class="btn btn-primary ">
									Download Question Paper
								</a>
								
							</ul>
						</div>
					</div>
				<?php endforeach;?>
			</div>
			<?php endif;?>
		</div>
</main>
<?php $this->view("includes/footer");?>