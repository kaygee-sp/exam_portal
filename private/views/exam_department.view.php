<?php $this->view("includes/header");?>
<?php $this->view("includes/nav");?>
<main class="shadow p-3 mb-5 bg-body rounded">
	<div class="container py-2" id="time_and_date">
		<div class="row" >
			<div class="col">
				<button type="button" class="btn btn-outline-secondary" id="date"></button>
			</div>
			<div class="col">
				<div class="d-grid gap-2 d-md-flex justify-content-md-end">
					<a href="<?=ROOT;?>exam_department/set_date">
						<button class="btn btn-primary me-md-2" type="button">Set Exam Dates</button>
					</a>
					<a href="<?=ROOT;?>exam_department/upload_question_paper">
						<button class="btn btn-primary" type="button">Upload Question Paper</button>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container "><hr></div>
	<div class="container">
		<!--*************************************************DAILY REPORT****************************************************-->
		<div class="row">
			<div class="col shadow-sm p-3 mb-5 bg-body border border-secondery rounded">
				<h2 class="text-center">Modules written each day</h2>
				<?php if($data) :?>
				<table class="table table-striped">
					<tr>
						<th>Module Code</th>
						<th>Exam Date</th>
						<th>Time</th>
					</tr>
					<?php foreach($data as $row): ?>
					<tr>
						<td><?=escape($row->ModuleCode);?></td>
						<td><?=escape($row->DateExam);?></td>
						<td><?=escape(get_time($row->ExamTime)." - ".duration($row->ExamTime));?></td>
					</tr>
					<?php endforeach;?>
				</table>
				<?php else: ;?>
				<p>There are no exams today</p>
				<?php endif;?>
				<form method="POST">
					<div class="input-group mb-3">
						<label for="inputGroupSelect02" class="input-group-text">Date</label>
						<select name="exam_dates" id="inputGroupSelect02" class="form-select">
							<option value=""><----Select a date----></option>
							<?php foreach($exam_dates as $exam):?>
							<option <?=get_select('exam_dates', $exam->DateExam );?> value="<?=$exam->DateExam;?>">
								<?=escape($exam->DateExam);?>
							</option>
							<?php endforeach;?>
						</select>
						<input type="submit" class="btn btn-primary" name="select_date" value="Select">
					</div>
				</form>
			</div>
			<!--************************************************************MIS 2******************************************************-->
			<div class="col shadow-sm p-3 mb-5 bg-body border border-secondery rounded">
				<h2 class="text-center">Contact details of module leaders</h2>
				<?php if($mis_1): ?>
				<table class="table table-striped">
					<tr>
						<th>Module Code</th>
						<th>Staff Name</th>
						<th>Email</th>
					</tr>
					<?php foreach($mis_1 as $mis_1):?>
					<tr>
						<td><?=escape($mis_1->ModuleCode);?></td>
						<td><?=escape($mis_1->StaffName);?></td>
						<td><?=escape($mis_1->StaffEmail);?></td>
					</tr>
					<?php endforeach;?>
				</table>
				<?php else: ;?>
				<p>No information is selected in the daily report MIS</p>
				<?php endif;?>
				<form action="" method="POST" class="form mx-auto">
					<div class="input-group mb-3">
					<input class="form-control" value="<?=get_var('name');?>" autofocus type="text" name="name" placeholder="Search by Module Code">
					<button class="btn btn-primary float-end" name="search">Search</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--********************************************************MIS 1******************************************************-->
	<div id="MIS_1" class="container-fluid main-container position-relative">
		<div class="col col-md-12 col-lg-12 col-xs-12">
			<div class="row my-4">
				<div class="col-md-9 col-xs-12 offset-md-1 id0">
					<div class="card-default shadow">
						<div class="card-body bgcolor">
							<span class="d-flex justify-content-center mx-2 font-color">Number of Student Writing Exams for Each Module</span>
							<?php echo $graph;?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--*************************************************************WEEKLY MIS***************************************************-->
	<div class="container">
		<div class="row shadow-sm  bg-body border border-secondery rounded">
			<div class="col">
				<h2 class="text-center">Weekly report of submitted files from the start of the week</h2>
				<?php if($weekly_mis): ?>
				<table class="table table-striped">
					
					<tr>
						<th>No of Files Submitted</th>
						<th>Module Code</th>
						<th>Start of The Week</th>
						<th>Current Day</th>
						<th>Last Day of The Week</th>
					</tr>
					<?php foreach($weekly_mis as $wmis):?>
					<tr>
						<td><?=$wmis->count;?></td>
						<td><?=$wmis->ModuleCode;?></td>
						<td><?=$wmis->first_day;?></td>
						<td><?=$wmis->today;?></td>
						<td><?=$wmis->last_day;?></td>
					</tr>
					<?php endforeach;?>
				</table>
				<?php else: ;?>
				<p>There are no files submitted yet</p>
				<?php endif;?>
				<form method="POST">
					<div class="input-group mb-3">
					<input type="date" class="form-control" name="weekly_mis" value=<?=get_var('weekly_mis');?>>
					<input type="submit" class="btn btn-primary" name="weekly_btn" value="Submit">
					</dib>
				</form>
			</div>
		</div>
	</div>
</main>
<?php $this->view("includes/footer");?>