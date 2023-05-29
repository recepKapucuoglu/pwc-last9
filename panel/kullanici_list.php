<?php include('_header.php'); ?>	
<section role="main" class="content-body">
	<header class="page-header">
		<h2>Kullanıcı Ayarları</h2>
		<div class="right-wrapper pull-right">
			<ol class="breadcrumbs">
				<li>
					<a href="index.php">
						<i class="fa fa-home"></i>
					</a>
				</li>
				<li><span>Kullanıcı Ayarları Listesi</span></li>
			</ol>
		</div>
	</header>
	<div class="row">
		<div class="col-md-12">
			<section class="card">
				<form name="slideForm" action="kullanici_list.php" method="post">
				<header class="card-header">
					<div class="card-actions">
						<a rel="tooltip" data-placement="bottom" data-original-title="Yeni Kullanıcı Ekle"  href="kullanici_ekle.php" class="fa fa-plus"></a>
						<a href="#" class="fa fa-caret-down"></a>
						<a href="#" class="fa fa-times"></a>
					</div>
					<h2 class="card-title">Kullanıcı Listesi</h2>
					
				</header>
				<div class="card-body">
					<div id="islemList">
						<div class="table-responsive">
							<table class="table table-striped mb-none">
								<thead>
									<tr>
										<th>#</th>
										<th>Ad Soyad</th>
										<th>Title</th>
										<th>E-mail</th>
										<th>Durum</th>
										<th width="5px"></th>
										<th width="5px"></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$i=0;
										$db->orderBy("id","desc");
										$results = $db->get('netia_admin');
										foreach ($results as $value) {
											$i++;
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $value['name']." ".$value['surname']; ?> </td>
										<td><?php echo $value['title']; ?> </td>
										<td><?php echo $value['email']; ?> </td>
										<td><span class="label label-<?php echo ($value['status']==0 ? 'danger' : 'success');?>"><?php echo ($value['status']==0 ? 'Pasif' : 'Aktif');?></span></td>
										<td align="right">
											<a  href="kullanici_edit.php?id=<?php echo $value['id']; ?>" class="mb-1 mt-1 mr-1 btn btn-info"><i class="fa fa-edit"></i></a>
										</td>
										<td align="right">
											<a onclick="return confirm('Silmek istediğinize emin misiniz?')" class="mb-1 mt-1 mr-1 btn btn-danger" href="kullanici_del.php?id=<?php echo $value['id']; ?>"><i class="fa fa-trash-o"></i></a>
										</td>	
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				</form>
			</section>
		</div>
	</div>
</section>
			

<?php include('_footer.php'); ?>		