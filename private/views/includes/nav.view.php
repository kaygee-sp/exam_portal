
<nav>
	<span>
		<?php if(isset($_SESSION['USER']->StaffName)):?>
			<?=$_SESSION['USER']->StaffName;?>
		<?php else:?>
			<?=$_SESSION['USER']->StudentName;?>
		<?php endif;?>
	</span>
	<?php if($_SESSION['page_title'] === "Student Home" || $_SESSION['page_title'] === "Staff Home" || $_SESSION['page_title'] === "Exam Department Home"){;?>
		<a href="<?=ROOT;?>logout">Logout</a>
	<?php } ;?>
</nav>