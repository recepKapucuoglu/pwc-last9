<?php
include_once("../../config/config.php");
include_once("models/timetable_model.php");

class TimetableController {
    public $model;
	public $items_per_page;
	
	public function __construct() {  
        $this->model = new TimetableModel();
		$this->items_per_page = Config::ITEMS_PER_PAGE;
    }
	
	public function displayTimetableList() {
		// Show the timetable list
		$timetables = $this->model->getTimetableList();
		include 'views/list.php';
	}
	
	public function editTimetable() {
		if (isset($_GET['id']) && $_GET['id']) { // Edit Timetable
			if (!empty($_POST)) {
				$msg = 'success';
				if ($_FILES['image']['name']) { // Have image upload
					$msg = $this->model->uploadImage();
				}
				if ($msg == 'success') {
					// Update timetable
					$this->model->updateTimetable($_GET['id']);
					
					// Set success flag
					$_SESSION['save_success'] = 1;
							
					if (isset($_POST['save-close'])) {
						header('Location: list.php');
						EXIT;
					} elseif (isset($_POST['save-new'])) {
						header('Location: edit.php');
						EXIT;
					}
				} else {
					echo '<div class="alert alert-block alert-danger">' . $msg . '</div>';
				}
			}
			
			// Show timetable detail
			$timetable = $this->model->getTimetableDetail($_GET['id']);
		} else { // New Timetable
			if (!empty($_POST)) {
				// Upload image
				$msg = $this->model->uploadImage();
				if ($msg == 'success') {
					// Create new timetable
					$id = $this->model->newTimetable();
					
					// Set success flag
					$_SESSION['save_success'] = 1;
					
					ob_end_clean();
					if (isset($_POST['save-close'])) {
						header("Location: list.php");
						EXIT;
					} elseif (isset($_POST['save-new'])) {
						header('Location: edit.php');
						EXIT;
					} else {
						header('Location: edit.php?id=' . $id);
						EXIT;
					}
				} else {
					echo '<div class="alert alert-block alert-danger">' . $msg . '</div>';
				}
			}
		}
		
		include 'views/edit.php';
	}
	
	public function deleteTimetable($id) {
		if (isset($_GET['id'])) {
			// Delete timetable
			$this->model->deleteTimetable($id);
			
			// Set success flag
			$_SESSION['delete_success'] = 1;
		}
		
		header('Location: list.php');
		EXIT;
	}
	
	public function statusTimetable($id) {
		if (isset($_GET['id'])) {
			// Delete timetable
			$this->model->statusTimetable($id);
		}
		
		ob_end_clean();
		header('Location: list.php');
		EXIT;
	}
}