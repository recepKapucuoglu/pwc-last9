<?php
 include('_header.php');	

if(isset($_POST['type_id'])) {
  $db->where('type_id', $_POST['type_id']);
  $results = $db->get('type_categories');
  
  $output = '';
  foreach ($results as $value) {
    $output .= '<option value="'.$value['id'].'">'.$value['categoryname'].'</option>';
  }
  
  echo $output;
}
?>
