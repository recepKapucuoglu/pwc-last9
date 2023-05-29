<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="index.php" class="logo">
						<img src="assets/images/logo.png" height="30" alt="<?php echo $customer_name; ?>" />
					</a>
					<div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="pages-search-results.html" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Eğitim ara...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
					<?php
						$i=0;
						$db->where('durum', 1);
						$db->where('egitim_tarih',$dateToday,'>=');
						$db->orderBy("egitim_tarih","asc");
						$results = $db->get('education_calender_list',array(0,10));
						$toplam_kritik_katilim = 0;
						foreach ($results as $value) {
							$i++;
							
							
							$db->where('edu_cal_id', $value['id']);
							$egitimKatilimSayisi = $db->getValue ('education_order_person_list', "count(id)");
							$egitimKatilimOran = $egitimKatilimSayisi / $value['katilimci_sayisi'] * 100;
							
							if($egitimKatilimOran<11){
								$toplam_kritik_katilim++;
							} 
						}
					?>
					<ul class="notifications">
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-tasks"></i>
								<span class="badge"><?php echo $toplam_kritik_katilim; ?></span>
							</a>
			
							<div class="dropdown-menu notification-menu large">
								<div class="notification-title">
									<span class="float-right badge badge-default"><?php echo $toplam_kritik_katilim; ?></span>
									Kritik Katılım
								</div>
			
								<div class="content">
									<ul>
										<?php 
										foreach ($results as $value) {
											$i++;
											
											
											$db->where('edu_cal_id', $value['id']);
											$egitimKatilimSayisi = $db->getValue ('education_order_person_list', "count(id)");
											$egitimKatilimOran = $egitimKatilimSayisi / $value['katilimci_sayisi'] * 100;
											
											if($egitimKatilimOran<11){
												
											
											
										?>
										<li>
											<p class="clearfix mb-1">
												<span class="message float-left"><a href="egitim_edit.php?id=<?php echo $value['edu_id']; ?>" target="_blank"><?php echo $value['egitim_adi']; ?></a></span>
												<span class="message float-right text-dark"><?php echo round($egitimKatilimOran,2); ?>%</span>
											</p>
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round($egitimKatilimOran,2); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($egitimKatilimOran,2); ?>%;"></div>
											</div>
										</li>
										<?php }  } ?>
			
									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-life-ring"></i>
								<span class="badge"><?php echo $totalBilgi['today']; ?></span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="float-right badge badge-default"><?php echo $totalBilgi['today']; ?></span>
									Bilgi Talebi
								</div>
			
								<div class="content">
									<ul>
										<?php 
											$db->where('kayit_tarihi',$dateToday,'>=');
											$db->orderBy("id","desc");
											$results = $db->get('education_info_form_list',array(0,50));
											foreach ($results as $value) {
										
										?>
										<li>
											<a href="talep_detay.php?id=<?php echo $value['id']; ?>" class="clearfix">
												<div class="image">
													<i class="fa fa-lock bg-warning text-light"></i>
												</div>
												<span class="title"><?php echo $value['adsoyad']; ?></span>
												<span class="message"><?php echo $value['egitim_adi']; ?></span>
											</a>
										</li>
										<?php } ?>
										
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="talep_list.php" class="view-more">Tümünü Göster</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<span class="badge"><?php echo $totalSatinAlma['today']; ?></span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="float-right badge badge-default"><?php echo $totalSatinAlma['today']; ?></span>
									Satın Alma Talebi
								</div>
			
								<div class="content">
									<ul>
										<?php
											$i=0;
											$db->where('kayit_tarihi',$dateToday,'>=');
											$db->orderBy("id","desc");
											$results = $db->get('education_order_form_list',array(0,2000));
											foreach ($results as $value) {
												$i++;
										?>
										<li>
											<a href="siparis_detay.php?id=<?php echo $value['id']; ?>" class="clearfix">
												<span class="title"><?php echo $value['fatura_adi']; ?> (<?php echo number_format($value['tutar'], 2, ',', '.'); ?> TL / <?php echo $value['katilimci_sayisi']; ?> Kişi)</span>
												<span class="message"><?php echo $value['egitim_adi']; ?></span>
											</a>
										</li>
										<?php } ?>
										
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="siparis_list.php" class="view-more">Tümünü Göster</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="assets/images/user-logo.png" alt="<?php echo $usr_name." ".$usr_surname; ?>" class="rounded-circle" data-lock-picture="assets/images/user-logo.png" />
							</figure>
							<div class="profile-info" data-lock-name="<?php echo $usr_name." ".$usr_surname; ?>" data-lock-email="<?php echo $usr_email; ?>">
								<span class="name"><?php echo $usr_name." ".$usr_surname; ?></span>
								<span class="role"><?php echo $usr_title; ?></span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled mb-2">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="kullanici_edit.php?id=<?php echo $usr_id; ?>"><i class="fa fa-user"></i> Bilgilerimi Güncelle</a>
								</li>
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Çıkış Yap</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->
			
<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include('_menu.php'); ?>
				<!-- end: sidebar -->
				<div class="loaderWrapper">
					<div class="loader"></div>
				</div>