<?php
$id = 0;
$name = '';
$username = '';
$email = '';
$role = 0;

if (isset($user)) {
	if ($user) {
		$id = $user['id'];
		$name = $user['name'];
		$username = $user['username'];
		$email = $user['email'];
		$role = $user['role'];
	}
}

if (isset($_POST) && $_POST) {
	$name = $_POST['name'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$role = $_POST['role'];	
}
?>

<?php if (isset($_SESSION['save_success'])) { ?>
	<div class="alert alert-success">
		<button data-dismiss="alert" class="close close-sm" type="button">
			<i class="fa fa-times"></i>
		</button>
		User successfully saved.
	</div>
	<?php unset($_SESSION['save_success']); ?>
<?php } ?>

<form class="form-horizontal" action="edit.php<?php echo $id ? ('?id=' . $id) : ''; ?>" method="post">
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Name<span class="star">&nbsp;*</span></label>
		<div class="col-sm-8">
			<input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required >
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Username<span class="star">&nbsp;*</span></label>
		<div class="col-sm-8">
			<input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required >
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Password<?php echo !isset($user) ? '<span class="star">&nbsp;*</span>' : ''; ?></label>
		<div class="col-sm-8">
			<input type="password" autocomplete="off" name="password" class="form-control" <?php echo (!isset($user)) ? 'required' : ''; ?> >
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Confirm Password<?php echo !isset($user) ? '<span class="star">&nbsp;*</span>' : ''; ?></label>
		<div class="col-sm-8">
			<input type="password" autocomplete="off" name="password2" class="form-control" <?php echo (!isset($user)) ? 'required' : ''; ?> >
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Email<span class="star">&nbsp;*</span></label>
		<div class="col-sm-8">
			<input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required >
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-lg-2 col-sm-2 control-label">Role<span class="star">&nbsp;*</span></label>
		<div class="col-sm-8">
			<select <?php if ($id == 1) { echo 'disabled'; } ?> name="role" class="form-control" required>
				<option value="">-- Select --</option>
				<option <?php echo ($role == 1) ? 'selected' : ''; ?> value="1">Admin</option>
				<option <?php echo ($role == 2) ? 'selected' : ''; ?> value="2">User</option>
			</select>
		</div>
	</div>

	<div class="form-group">
		<div class="col-lg-offset-2 col-lg-8">
			<button name="save" type="submit" class="btn btn-info"><i class="fa fa-edit"></i> Save</button>
			<button name="save-close" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> Save & Close</button>
			<button name="save-new" type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Save & New</button>
			<a class="btn btn-default" href="list.php"><i class="fa fa-times"></i> Cancel</a>
		</div>
	</div>
	
	<input type="hidden" id="relative_url" value="../../" />
	<?php if ($id == 1) { ?>
		<input type="hidden" name="role" value="1" />
	<?php } ?>
</form>