<?php
// Variables
$relative_url = '../../';
$relative_path = '../';
$list_page = 'admin/timetable/list.php';

// Pagination
$total_items = count($timetables);

$page = ceil($total_items/$this->items_per_page);
if (isset($_SESSION['page'])) {
	if ($_SESSION['page'] > $page) {
		$_SESSION['page'] = 1;	
	}
	$cur_page = $_SESSION['page'];
	$offset = ($_SESSION['page'] - 1) * $this->items_per_page;
} else {
	$cur_page = 1;
	$offset = 0;
}
?>

<?php if (isset($_SESSION['save_success'])) { ?>
	<div class="alert alert-success">
		<button data-dismiss="alert" class="close close-sm" type="button">
			<i class="fa fa-times"></i>
		</button>
		Timetable successfully saved.
	</div>
	<?php unset($_SESSION['save_success']); ?>
<?php } ?>

<?php if (isset($_SESSION['delete_success'])) { ?>
	<div class="alert alert-success">
		<button data-dismiss="alert" class="close close-sm" type="button">
			<i class="fa fa-times"></i>
		</button>
		Timetable successfully deleted.
	</div>
	<?php unset($_SESSION['delete_success']); ?>
<?php } ?>

<div class="tiva-quiz-bar m-b-20">
	<form method="get" action="">
		<div class="input-group">
			<a class="btn btn-success pull-left" href="edit.php"><i class="fa fa-plus-circle"></i> New</a>
			<div class="search-group pull-right">
				<input type="text" name="keyword" class="form-control input-sm" style="width: 250px;" placeholder="Search" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
				<div class="input-group-btn">
					<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
				</div>	
			</div>
		</div>
	</form>
</div>

<div class="tiva-timetable-list table-responsive">
	<table class="table table-hover tiva-table">
		<tbody>
			<tr class="first-row">
				<th>Name</th>
				<th width="140" class="text-center">Image</th>
				<th width="100" class="text-center">Date</th>
				<th width="80" class="text-center">Day</th>
				<th width="110" class="text-center">Time</th>
				<th width="70" class="text-center">Status</th>
				<th width="170" class="text-center">Action</th>
			</tr>
		
			<?php if ($timetables) { ?>
				<?php $timetables = array_slice($timetables, $offset, $this->items_per_page); ?>
				<?php foreach ($timetables as $timetable) { ?>
					<tr>
						<td><a href="edit.php?id=<?php echo $timetable['id']; ?>"><?php echo $timetable['name']; ?></a></td>
						<td class="text-center">
							<?php if ($timetable['image']) { ?>
								<img src="../timetable/images/<?php echo $timetable['image']; ?>" alt="<?php echo $timetable['name']; ?>" width="110" />
							<?php } ?>
						</td>
						<td class="text-center"><?php echo $timetable['date']; ?></td>
						<td class="text-center"><?php echo $timetable['day']; ?></td>
						<td class="text-center"><?php echo $timetable['start_time'] . ' - ' . $timetable['end_time']; ?></td>
						<td class="text-center"><a href="status.php?id=<?php echo $timetable['id']; ?>"><img src="<?php echo $timetable['state'] == 1 ? '../../images/temp/tick.png' : '../../images/temp/close.png'; ?>" /></a></td>
						<td class="text-center">
							<a class="btn btn-primary" href="edit.php?id=<?php echo $timetable['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
							<a class="btn btn-danger btn-delete" href="delete.php?id=<?php echo $timetable['id']; ?>"><i class="fa fa-trash-o"></i> Delete</a>
						</td>
					</tr>
				<?php } ?>
			<?php } ?>
			
			<tr class="last-row"><td colspan="10"></td></tr>
		</tbody>
	</table>
</div>

<!-- Pagination -->
<?php include $relative_url . 'system/pagination.php'; ?>