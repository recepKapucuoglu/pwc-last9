<?php
$id = 0;
$name = '';
$image = '';
$date = '';
$day = '';
$start_time = '';
$end_time = '';
$color = 1;
$description = '';

if (isset($timetable)) {
	if ($timetable) {
		$id = $timetable['id'];
		$name = $timetable['name'];
		$image = $timetable['image'];
		$date = $timetable['date'];
		$day = $timetable['day'];
		$start_time = $timetable['start_time'];
		$end_time = $timetable['end_time'];
		$color = $timetable['color'];
		$description = $timetable['description'];
		$expection = $timetable['expection'];
		$who = $timetable['who'];
		$webex = $timetable['webex'];
		$pdf = $timetable['pdf'];
		$video = $timetable['video'];
		$saloon = $timetable['saloon'];
	}
}

if (isset($_POST) && $_POST) {
	$name = $_POST['name'];
	if ($_FILES['image']['name']) {
		$image = $_FILES['image']['name'];
	}
	$date = $_POST['date'];
	$day = $timetable['day'];
	$start_time = $timetable['start_time'];
	$end_time = $timetable['end_time'];
	$color = $timetable['color'];
	$description = $timetable['description'];
	$expection = $timetable['expection'];
	$who = $timetable['who'];
	$webex = $timetable['webex'];
	$pdf = $timetable['pdf'];
	$video = $timetable['video'];
	$saloon = $timetable['saloon'];
}
if(empty($pdf)){
	$pdf = "http://www.okul.pwc.com.tr/platform/pdf/";
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

<form class="form-horizontal" action="edit.php<?php echo $id ? ('?id=' . $id) : ''; ?>" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Name<span class="star">&nbsp;*</span></label>
		<div class="col-sm-8">
			<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Konusmacılar<span class="star">&nbsp;*</span></label>
		<div class="col-sm-8">
			<input type="text" name="who" class="form-control" value="<?php echo $who; ?>" required />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Webex Linki<span class="star">&nbsp;*</span></label>
		<div class="col-sm-8">
			<input type="text" name="webex" class="form-control" value="<?php echo $webex; ?>" required />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">PDF<span class="star">&nbsp;*</span></label>
		<div class="col-sm-8">
			<input type="text" name="pdf" class="form-control" value="<?php echo mb_strlen($pdf) > 10 ? $pdf : 'https://www.okul.pwc.com.tr/platform/pdf/' ; ?>" required />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Video<span class="star">&nbsp;*</span></label>
		<div class="col-sm-8">
			<input type="text" name="video" class="form-control" value="<?php echo $video; ?>" required />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Image</label>
		<div class="col-sm-8">
			<input type="file" name="image" class="filestyle" data-placeholder="<?php echo $image ? $image : 'No image'; ?>">
		</div>
	</div>
	
	<div class="form-group date-picker-wrap">
		<label class="col-lg-2 col-sm-2 control-label">Date</label>
		<div class="col-sm-8">
			<div class="input-group date">
				<input type="text" name="date" class="form-control date-picker" placeholder="Select Date" value="<?php echo $date; ?>">
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Day</label>
		<div class="col-sm-8">
			<select name="day" class="form-control">
				<option value="">-- Select --</option>
				<option value="monday" <?php echo ($day == 'monday') ? 'selected' : ''; ?> >Monday</option>
				<option value="tuesday" <?php echo ($day == 'tuesday') ? 'selected' : ''; ?> >Tuesday</option>
				<option value="wednesday" <?php echo ($day == 'wednesday') ? 'selected' : ''; ?> >Wednesday</option>
				<option value="thursday" <?php echo ($day == 'thursday') ? 'selected' : ''; ?> >Thursday</option>
				<option value="friday" <?php echo ($day == 'friday') ? 'selected' : ''; ?> >Friday</option>
				<option value="saturday" <?php echo ($day == 'saturday') ? 'selected' : ''; ?> >Saturday</option>
				<option value="sunday" <?php echo ($day == 'sunday') ? 'selected' : ''; ?> >Sunday</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Salon</label>
		<div class="col-sm-8">
			<select name="saloon" class="form-control">
				<option value="">-- Select --</option>
				<option value="Bern" <?php echo ($saloon == 'Bern') ? 'selected' : ''; ?> >Bern</option>
				<option value="Lausanne" <?php echo ($saloon == 'Lausanne') ? 'selected' : ''; ?> >Lausanne</option>
				<option value="Montreux" <?php echo ($saloon == 'Montreux') ? 'selected' : ''; ?> >Montreux</option>
				<option value="Zurich" <?php echo ($saloon == 'Zurich') ? 'selected' : ''; ?> >Zurich</option>
				<option value="Neuchatel" <?php echo ($saloon == 'Neuchatel') ? 'selected' : ''; ?> >Neuchatel</option>
				<option value="Geneve" <?php echo ($saloon == 'Geneve') ? 'selected' : ''; ?> >Geneve</option>
				<option value="Digit'hall" <?php echo ($saloon == 'Digithall') ? 'selected' : ''; ?> >Digit'hall</option>
			</select>
		</div>
	</div>
	
	<div class="form-group date-picker-wrap">
		<label class="col-lg-2 col-sm-2 control-label">Start Time</label>
		<div class="col-sm-8">
			<div class="input-group date">
				<input type="text" name="start_time" class="form-control time-picker" placeholder="Select Time" value="<?php echo $start_time; ?>">
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-time"></span>
				</span>
			</div>
		</div>
	</div>
	
	<div class="form-group date-picker-wrap">
		<label class="col-lg-2 col-sm-2 control-label">End Time</label>
		<div class="col-sm-8">
			<div class="input-group date">
				<input type="text" name="end_time" class="form-control time-picker" placeholder="Select Time" value="<?php echo $end_time; ?>">
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-time"></span>
				</span>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Color</label>
		<div class="col-sm-8">
			<select name="color" class="form-control">
				<option value="1" <?php echo ($color == '1') ? 'selected' : ''; ?> >1</option>
				<option value="2" <?php echo ($color == '2') ? 'selected' : ''; ?> >2</option>
				<option value="3" <?php echo ($color == '3') ? 'selected' : ''; ?> >3</option>
				<option value="4" <?php echo ($color == '4') ? 'selected' : ''; ?> >4</option>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Kimler Katılmalı</label>
		<div class="col-sm-8">
			<textarea name="description" class="description-field"><?php echo $description; ?></textarea>
		</div>
	</div>	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Katılımcıları Neler Bekliyor</label>
		<div class="col-sm-8">
			<textarea name="expection" class="description-field"><?php echo $expection; ?></textarea>
		</div>
	</div>
	
	<div class="form-group m-t-20">
		<div class="col-lg-offset-2 col-lg-8">
			<button name="save" type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Save</button>
			<button name="save-close" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save & Close</button>
			<button name="save-new" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Save & New</button>
			<a class="btn btn-default" href="list.php"><i class="fa fa-times"></i> Cancel</a>
		</div>
	</div>
	
	<input type="hidden" class="type-value" value="<?php echo $type; ?>">
	<input type="hidden" class="time-value" value="<?php echo $time; ?>">
</form>