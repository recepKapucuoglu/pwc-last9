<?php
// Variables
$relative_url = '../../';
$relative_path = '../';
$list_page = 'admin/timetable/users.php';

?>
<div class="col-md-4 col-xs-12 alert alert-info" role="alert">
  Toplam katılımcı sayısı <b class="alert-link"><?php echo count($timetables); ?></b>
</div>
<table id="table_id" class="display">
								<thead>
									<tr style="font-size: 12px !important;">
										<th>İsim</th>
										<th style="width: 20px !important;">Firma</th>
										<th style="width: 20px !important;">Mail</th>
										<th>Ünvan</th>
										<th>GSM</th>
										<th>Alumni Mi?</th>
										<th>09:00 - 09:45 Workshop1</th>
										<th>10:00 - 10:45 Workshop2</th>
										<th>16:15 - 17:00 Workshop3</th>
										<th>11:00 - 12:45</th>
										<th>14:00 - 16:00</th>
										<th>Fatura Tipi</th>
										<th>Firma Ünvanı</th>
										<th>Vergi Dairesi</th>
										<th>Vergi No</th>
										<th>Adres</th>
										<th>Kayıt Zamanı</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($timetables as $timetable) {
										?>
									<tr style="font-size: 12px !important;">
										<td><?php echo $timetable['isim']; ?></td>
										<td><?php echo $timetable['firma']; ?></td>
										<td><?php echo $timetable['sirketmail']; ?></td>
										<td><?php echo $timetable['unvan']; ?></td>
										<td><?php echo $timetable['ceptelefon']; ?></td>
										<td><?php echo $timetable['alumni']; ?></td>
										<td><?php echo $timetable['09:00']; ?></td>
										<td><?php echo $timetable['10:00']; ?></td>
										<td><?php echo $timetable['16:15']; ?></td>
										<td><?php echo $timetable['11:00']; ?></td>
										<td><?php echo $timetable['14:00']; ?></td>
										<td><?php echo $timetable['fatura_tipi']; ?></td>
										<td><?php echo $timetable['fatura_adi']; ?></td>
										<td><?php echo $timetable['vergi_dairesi']; ?></td>
										<td><?php echo $timetable['vergi_no']; ?></td>
										<td><?php echo $timetable['adres']; ?></td>
										<td><?php echo date("d/m/Y H:i:s", strtotime($timetable['regdate'])); ?></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>