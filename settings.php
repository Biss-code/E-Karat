<?php
//ver_3.7.0
include $_SERVER['DOCUMENT_ROOT'] . '/settdata.php';
$title = 'Налаштування';
include $_SERVER ['DOCUMENT_ROOT'] . '/header.php';
include $_SERVER ['DOCUMENT_ROOT'] . '/karat/stock/functions.php';
$all_store = get_stor();
$all_menu  = get_menu();
//отримати хеш та юзера
if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) {
	//Дати доступ вказаним користувачм
	if ($access == "super_admin") {
?>
<!-- Modal EXPORT -->
<div class="modal fade" id="inventory" tabindex="-1" aria-labelledby="inventory" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="/karat/stock/prod_export.php" id="export_excel_form">
				<div class="modal-header">
					<h5 class="modal-title" id="inventory">
						Інвентаризація
					</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
					</button>
				</div>
				<div class="modal-body">
					<span id="message"></span>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon3">
						Формат
						</span>
						<select name="file_type" class="form-select">
							<option value="Csv">
								CSV
							</option>
							<option value="Xls">
								XLS
							</option>
							<option value="Xlsx">
								XLSX
							</option>
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						&#10005;
					</button>
					<input type="submit" name="inventory" class="btn main-color" value="Експорт" />
				</div>
			</form>
		</div>
	</div>
</div>
<div class='row str'>
	<div class='col-12'>
		<h2>
			Налаштування
		</h2>
	</div>
</div>
<ul class="nav nav-pills justify-content-center my-3" id="pills-tab" role="tablist">
	<li class="nav-item" role="presentation">
	<button class="nav-link me-1 active" id="pills-backup-tab" data-bs-toggle="pill" data-bs-target="#pills-backup" type="button" role="tab" aria-controls="pills-backup" aria-selected="false">
	<i class="bi bi-server"></i></button>
	</li>
	<li class="nav-item" role="presentation">
	<button class="nav-link me-1" id="pills-limit-tab" data-bs-toggle="pill" data-bs-target="#pills-limit" type="button" role="tab" aria-controls="pills-limit" aria-selected="true">
	<i class="bi bi-wrench-adjustable"></i></button>
	</li>
	<li class="nav-item" role="presentation">
	<button class="nav-link me-1" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
	<i class="bi bi-people-fill"></i></button>
	</li>
	<li class="nav-item" role="presentation">
	<button class="nav-link me-1" id="pills-time-tab" data-bs-toggle="pill" data-bs-target="#pills-time" type="button" role="tab" aria-controls="pills-time" aria-selected="false">
	<i class="bi bi-smartwatch"></i></button>
	</li>
	<li class="nav-item" role="presentation">
	<button class="nav-link me-1" id="pills-null-tab" data-bs-toggle="pill" data-bs-target="#pills-null" type="button" role="tab" aria-controls="pills-null" aria-selected="false">
	<i class="bi bi-bucket-fill"></i></button>
	</li>
	<li class="nav-item" role="presentation">
	<button class="nav-link me-1" id="pills-menu-tab" data-bs-toggle="pill" data-bs-target="#pills-menu" type="button" role="tab" aria-controls="pills-menu" aria-selected="false">
	<i class="bi bi-menu-button-wide"></i></button>
	</li>
</ul>
<div class="tab-content" id="pills-tabContent">
	<div class="tab-pane fade show active" id="pills-backup" role="tabpanel" aria-labelledby="pills-backup-tab" tabindex="0">
		<div class="ramka_full <?php echo $bg_time; ?>">
			<div class="form p-4">
				<div class="form_drop">
					<div class="row justify-content-center">
						<div class="d-grid gap-2 mb-2">
							<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#inventory">Інвентаризація складу</button>
						</div>
						<form method="POST" action="sett_update.php">
							<div class="d-grid gap-2">
								<input  data-bs-toggle="modal" data-bs-target="#backup" type='submit' name='create' class='btn btn-success btn-sm' value='Створити резервну копію'/>
								<input type='submit' name='download_source' class='btn btn-success btn-sm' value='Завантажити архів'/>
								<input type='submit' name='download_db' class='btn btn-success btn-sm' value='Завантажити базу даних'/>
								<input type='submit' name='dell_backup' class='btn btn-dark btn-sm mb-3' value='Видалити копії'/>
							</div>
						</form>
						<!-- Modal -->
						<div class="modal fade modal-sm" id="backup" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="backup" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-body">
										<div class="bg-danger bg-opacity-25 p-3">
											<div class="row justify-content-center">
												<center>
													<p class="string drop p-2">
														<b>Зачекай доки сторінка не завантажиться!</b>
													</p>
													<div class="spinner-border text-danger" role="status">
														<span class="visually-hidden">Loading...</span>
													</div>
												</center>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<hr />
						<div class="d-grid gap-2">
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#d_time">
								Видалити усі записи з годинами
							</button>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#d_pr">
								Видалити усі записи з товарами
							</button>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#d_cat">
								Видалити усі записи з категорій
							</button>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#d_st">
								Видалити усі записи з складами
							</button>
							<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#assoc_prod_st">
								Видалити усі товари з комірок
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<form method="POST" action="sett_update.php">
			<input type="hidden" name="drop_time" />
			<!-- Modal -->
			<div class="modal fade modal-sm" id="d_time" tabindex="-1" aria-labelledby="d_time" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="d_time">
								Видалити години
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							</button>
						</div>
						<div class="modal-body">
							<div class="bg-danger bg-opacity-25 p-3">
								<div class="row justify-content-center">
									<center>
										<div class="mb-3">
											<b>Впевнені ???</b>
										</div>
										<input class="btn btn-danger" type="submit" value="OK">
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<form method="POST" action="sett_update.php">
			<input type="hidden" name="drop_prod" />
			<!-- Modal -->
			<div class="modal fade modal-sm" id="d_pr" tabindex="-1" aria-labelledby="d_pr" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="d_pr">
								Видалити товари
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							</button>
						</div>
						<div class="modal-body">
							<div class="bg-danger bg-opacity-25 p-3">
								<div class="row justify-content-center">
									<center>
										<div class="mb-3">
											<b>Впевнені ???</b>
										</div>
										<input class="btn btn-danger" type="submit" value="OK">
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<form method="POST" action="sett_update.php">
			<input type="hidden" name="drop_cats" />
			<!-- Modal -->
			<div class="modal fade modal-sm" id="d_cat" tabindex="-1" aria-labelledby="d_cat" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="d_cat">
								Видалити категорії
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							</button>
						</div>
						<div class="modal-body">
							<div class="bg-danger bg-opacity-25 p-3">
								<div class="row justify-content-center">
									<center>
										<div class="mb-3">
											<b>Впевнені ???</b>
										</div>
										<input class="btn btn-danger" type="submit" value="OK">
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<form method="POST" action="sett_update.php">
			<input type="hidden" name="drop_store" />
			<!-- Modal -->
			<div class="modal fade modal-sm" id="d_st" tabindex="-1" aria-labelledby="d_st" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="d_st">
								Видалити склади
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							</button>
						</div>
						<div class="modal-body">
							<div class="bg-danger bg-opacity-25 p-3">
								<div class="row justify-content-center">
									<center>
										<div class="mb-3">
											<b>Впевнені ???</b>
										</div>
										<input class="btn btn-danger" type="submit" value="OK">
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<form method="POST" action="sett_update.php">
			<input type="hidden" name="drop_assoc_prod_st" />
			<!-- Modal -->
			<div class="modal fade modal-sm" id="assoc_prod_st" tabindex="-1" aria-labelledby="assoc_prod_st" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="assoc_prod_st">
								Очистити комірки
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							</button>
						</div>
						<div class="modal-body">
							<div class="bg-danger bg-opacity-25 p-3">
								<div class="row justify-content-center">
									<center>
										<div class="mb-3">
											<b>Впевнені ???</b>
										</div>
										<input class="btn btn-danger" type="submit" value="OK">
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
		<div class="ramka_full">
			<div class="form p-4">
				<div class="form_drop">
					<div class="card">
						<div class="card-body">
							<div class="result">
								<div class="row justify-content-md-center px-1">
									<div class="col-9 p-1">
										Категорій:
									</div>
									<div class="col-3 p-1">
										<?php
										$log_cat = $pdo->query("SELECT COUNT(1) FROM `e_sub_cat`");
										foreach ($log_cat as $val) {
											$cats = $val['COUNT(1)'];
											echo $cats;
										}
										?>
									</div>
								</div>
								<div class="row justify-content-md-center px-1">
									<div class="col-9 p-1">
										Найменувань:
									</div>
									<div class="col-3 p-1">
										<?php
										$log_prod = $pdo->query("SELECT COUNT(1) FROM `e_products`");
										foreach ($log_prod as $val) {
											$prods = $val['COUNT(1)'];
											echo $prods;
										}
										?>
									</div>
								</div>
								<div class="row justify-content-md-center px-1">
									<div class="col-9 p-1">
										Всього товарів:
									</div>
									<div class="col-3 p-1">
										<?php
										$log = $pdo->query("SELECT SUM(pcs) FROM `e_prod_to_stor`");
										foreach ($log as $val) {
											$pcs = $val['SUM(pcs)'];
											if ($pcs == '') {
												echo '0';
											} else {
												echo $pcs;
											}
										}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tab-pane fade" id="pills-limit" role="tabpanel" aria-labelledby="pills-limit-tab" tabindex="0">
		<form method="POST" action="sett_update.php">
			<input type="hidden" name="sett" />
			<div class="ramka_full <?php echo $bg_time; ?>">
				<div class="form p-4">
					<div class="form_time">
						<div class="row justify-content-center">
							<div class="input-group mb-3">
								<span class="input-group-text">Назва</span>
								<input class="form-control" name="system_name" required placeholder="Назва системи"
								value="<?php echo $system_name; ?>" />
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Лого</span>
								<input class="form-control" name="system_logo" required placeholder="bi bi-xbox"
								value="<?php echo $system_logo; ?>" />
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Ліміт год.</span>
								<input class="form-control" name="limit_watch" required placeholder="Ліміт годин"
								value="<?php echo $limit_watch; ?>" />
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Ставка</span>
								<input class="form-control" name="stavka_grn" required placeholder="Ставка"
								value="<?php echo $stavka_grn; ?>" />
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Комірка</span>
								<select class="form-select" name="stock_default">
									<?php
									if ($stock_default == '0') { ?>
									<option value="0">Доступні усі</option>
									<?php
								} else { ?>
									<?php
									foreach ($all_store as $val) {
										$stock_def_id = $val['id'];
										$stock_def_name = $val['stor_name'];
										if ($stock_default == $stock_def_id) { ?>
									<option value="<?php echo $stock_default; ?>">
										Лише: <?php echo $stock_def_name; ?>
									</option>
									<?php
								} ?>
									<?php
								} ?>
									<option value="0">Доступні усі</option>
									<?php
								} ?>
									<?php
									foreach ($all_store as $val) { ?>
									<option value="<?php echo $stock_def_id = $val['id']; ?>">
										<?php echo $stock_def_name = $val['stor_name']; ?>
									</option>
									<?php
								} ?>
								</select>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Колір</span>
								<input name="main_color" value="<?php echo $main_color; ?>" type="color" class="form-control form-control-color" id="color" title="Choose your color">
							</div>
							<div class="input-group mb-3">
								<div class="form-check form-switch">
									<input value="1" name="bg_color" <?php echo $status; ?> class="form-check-input" type="checkbox" role="switch" id="night">
									<label class="form-check-label" for="night">Стиль (ніч/день)</label>
								</div>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Ніч (з/до)</span>
								<input type="text" id="time_pm" name="time_pm" value="<?php echo $time_pm; ?>" class="form-control" inputmode="numeric">
								<input type="text" id="time_am" name="time_am" value="<?php echo $time_am; ?>" class="form-control" inputmode="numeric">
							</div>
							<div class="input-group mb-3">
								<div class="form-check form-switch">
									<input value="1" name="gads" <?php echo $ga_status; ?> class="form-check-input" type="checkbox" role="switch" id="ga">
									<label class="form-check-label" for="ga">Реклама</label>
								</div>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text" id="basic-addon3">
								G-ads
								</span>
								<textarea name="text_gads" placeholder="Код реклами" class="form-control" id="text_gads" rows="4"><?php echo $text_gads; ?></textarea>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Версія</span>
								<input class="form-control" name="ver" required placeholder="1.0"
								value="<?php echo $ver; ?>" />
							</div>
							<button class="btn main-color button" name="login_send" type="submit">ОК</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
		<form method="POST" action="sett_update.php">
			<input type="hidden" name="sett_user" />
			<div class="ramka_full <?php echo $bg_time; ?>">
				<div class="form p-4">
					<div class="form_access">
						<div class="row justify-content-center">
							<div class="input-group mb-3">
								<span class="input-group-text">Юзер</span>
								<select class="form-select" required name="user">
									<option selected="selected">
									</option>
									<?php
									$query     = $pdo->query ( "SELECT * FROM `users` ORDER BY user_id" );
									$data_user = $query->fetchAll(PDO::FETCH_ASSOC);
									foreach ($data_user as $row) {
										$user_login = $row ['user_login'];
										$user_f_name = $row ['f_name'];
										$user_l_name = $row ['l_name'];
										if ($user != $user_login) {
											echo "<option value=".$user_login.">$user_f_name $user_l_name [$user_login]</option>";
										}
									}
									?>
								</select>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Права</span>
								<select class="form-select" required name="access">
									<option selected="selected">
									</option>
									<option value="public">
										Користувач
									</option>
									<option value="admin">
										Адмін
									</option>
									<option value="super_admin">
										Суперадмін
									</option>
								</select>
							</div>
							<button class="btn main-color button" type="submit">
								OK
							</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<form class="mb-5" method="POST" action="sett_update.php">
			<div class='row my-3 str'></div>
			<div class='row str'>
				<div class='col-5 col-md-9'>
					<h2>Користувачі</h2>
				</div>
				<div class='col-7 col-md-3'>
					<!-- Button trigger modal -->
					<div class="float-end">
						<span data-bs-toggle="tooltip" data-bs-title="Створити">
						<button type="button" class="btn main-color btn-sm" data-bs-toggle="modal" data-bs-target="#add_user">
						<i class="bi bi-plus-lg"></i>
						</button>
						</span>
						<span data-bs-toggle="tooltip" data-bs-title="Видалити">
						<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete">
						<i class="bi bi-x-lg"></i>
						</button>
						</span>
					</div>
				</div>
			</div>
			<div class="row str main-color">
				<div class="col-3 p-2">
					<input id="check_all_users" class="form-check-input" type="checkbox" onClick="toggle(this)" />
					Фото
				</div>
				<div class="col-3 pt-2 p-2">Ім'я</div>
				<div class="col-3 p-2">Логін</div>
				<div class="col-3 p-2">Права</div>
			</div>
			<?php
			foreach ($data_user as $row) {
				$id     = $row ['user_id'];
				$l_name = $row ['l_name'];
				$f_name = $row ['f_name'];
				$login  = $row ['user_login'];
				$access = $row ['access'];
				$avatar = $row ['user_avatar'];
			?>
			<div class="row str">
				<div class="col-3 p-2 ava_tabel">
					<input class="form-check-input" type="checkbox" name="checkbox[]" value="<?php echo $id; ?>">
					<?php
					if ($avatar != '') { ?>
					<img class="prof-pic" src="<?php echo $dom.'/karat/avatars/'.$avatar; ?>?<?php echo time(); ?>" alt="Profile">
					<?php
				} else { ?>
					<img class="prof-pic" src="<?php echo $dom.'/karat/avatars/default_ava.png'; ?>" alt="Profile">
					<?php
				} ?>
				</div>
				<div class="col-3 p-2">
					<?php echo $f_name; ?> <?php echo $l_name; ?>
				</div>
				<div class="col-3 p-2"><?php echo $login; ?></div>
				<div class="col-3 p-2"><?php echo $access; ?></div>
				<!-- Modal -->
				<div class="modal fade modal-sm" id="delete" tabindex="-1" aria-labelledby="del_item" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="del_item">
									Видалити
								</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								</button>
							</div>
							<div class="modal-body">
								<p class="string drop">
									<div class="bg-danger bg-opacity-25 p-3">
										<center>
											<div class="mb-3">
												<p class="string drop">
													<b>Видалити вибране ?</b>
												</p>
											</div>
											<input class="btn btn-danger" type="submit" name="del_users" id="delete" value="OK">
										</center>
									</div>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		} ?>
		</form>
		<!--add_user -->
		<div class="modal fade" id="add_user" tabindex="-1" aria-labelledby="add_user" aria-hidden="true">
			<div class="modal-dialog modal-dialog-scrollable">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="add_user">
							Створити
						</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						</button>
					</div>
					<form method="POST" action="sett_update.php">
						<input type="hidden" name="add_new_user" />
						<div class="modal-body">
							<div class="form_register">
								<div class="row justify-content-center">
									<div class="input-group mb-3">
										<span class="input-group-text">Прізвище</span>
										<input type="text" name="f_name" class="form-control" placeholder="Прізвище" required autocomplete="family-name">
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text">Ім'я</span>
										<input type="text" name="l_name" class="form-control" placeholder="Ім'я" required autocomplete="given-name">
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text">Дата нар.</span>
										<input name="user_date" id="date" required type="text" class="form-control" inputmode="numeric">
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text">Логін</span>
										<input type="text" name="login" class="form-control input_secur" placeholder="Логін" required>
									</div>
									<div class="input-group mb-3">
										<span class="input-group-text">Пароль</span>
										<input type="text" name="password" class="form-control input_secur" placeholder="Пароль" required>
									</div>
									<input type="hidden" name="access" value="public">
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
								Закрити
							</button>
							<button class="btn main-color" type="submit">
								OK
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!--add_user -->
	</div>
	<div class="tab-pane fade" id="pills-time" role="tabpanel" aria-labelledby="pills-time-tab" tabindex="0">
		<form class="mb-5" method="POST" action="sett_update.php">
			<input type="hidden" name="del_time" />
			<div class='row my-3 str'></div>
			<div class='row str'>
				<div class='col-5 col-md-9'>
					<h2>Години</h2>
				</div>
				<div class='col-7 col-md-3'>
					<!-- Button trigger modal -->
					<div class="float-end">
						<span data-bs-toggle="tooltip" data-bs-title="Видалити">
						<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#del_time">
						<i class="bi bi-x-lg"></i>
						</button>
						</span>
					</div>
				</div>
			</div>
			<div class="row str main-color">
				<div class="col-6 p-2">
					<input id="check_all_times" class="form-check-input" type="checkbox" onClick="toggle(this)" />
					Ім'я
				</div>
				<div class="col-3 p-2">Дата</div>
				<div class="col-3 p-2">Години</div>
			</div>
			<?php
			$query     = $pdo->query ( "SELECT * FROM `e_time`,`users` WHERE e_time.name = users.user_login ORDER BY id DESC LIMIT 10" );
			$data_time = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($data_time as $row) {
				$id     = $row ['id'];
				$name = $row ['name'];
				$f_name = $row ['f_name'];
				$l_name = $row ['l_name'];
				$date = date("d.m.Y", strtotime($row['date']));
				$time  = $row ['time'];
			?>
			<div class="row str">
				<div class="col-6 p-2">
					<input class="form-check-input" type="checkbox" name="checkbox[]" value="<?php echo $id; ?>">
					<?php echo $f_name; ?> <?php echo $l_name; ?> (<?php echo $name; ?>)
				</div>
				<div class="col-3 p-2"><?php echo $date; ?></div>
				<div class="col-3 p-2"><?php echo $time; ?></div>
				<!-- Modal -->
				<div class="modal fade modal-sm" id="del_time" tabindex="-1" aria-labelledby="del_time" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="del_time">
									Видалити
								</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
								</button>
							</div>
							<div class="modal-body">
								<p class="string drop">
									<div class="bg-danger bg-opacity-25 p-3">
										<center>
											<div class="mb-3">
												<p class="string drop">
													<b>Видалити вибране ?</b>
												</p>
											</div>
											<input class="btn btn-danger"  type="submit" value="OK">
										</center>
									</div>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		} ?>
		</form>
	</div>
	<div class="tab-pane fade" id="pills-null" role="tabpanel" aria-labelledby="pills-null-tab" tabindex="0">
		<form class="mb-5" method="POST" action="sett_update.php">
			<input type="hidden" name="del_null_pcs" />
			<div class='row my-3 str'></div>
			<div class='row str'>
				<div class='col-5 col-md-9'>
					<h2>Позиції (0)</h2>
				</div>
				<div class='col-7 col-md-3'>
					<!-- Button trigger modal -->
					<div class="float-end">
						<span data-bs-toggle="tooltip" data-bs-title="Видалити">
						<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#del_null">
						<i class="bi bi-x-lg"></i>
						</button>
						</span>
					</div>
				</div>
			</div>
			<div class="row str main-color">
				<div class="col-3 p-2">
					<input id="check_all_prod" class="form-check-input" type="checkbox" onClick="toggle(this)" />
					ID
				</div>
				<div class="col-5 p-2">Назва</div>
				<div class="col-3 p-2">Позиція</div>
				<div class="col-1 p-2">Шт.</div>
			</div>
			<?php
			$query = $pdo->query ("SELECT * FROM e_store, e_prod_to_stor, e_products
			WHERE e_prod_to_stor.product_id = e_products.id
			AND e_store.id = e_prod_to_stor.store_id
			AND pcs = 0 LIMIT 50");
			$data_pcs = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($data_pcs as $row) {
				$prod_name = $row ['prod_name'];
				$stor_name = $row ['stor_name'];
				$product_id = $row ['product_id'];
				$store_id = $row ['store_id'];
				$pcs = $row ['pcs'];
			?>
			<div class="row str">
				<div class="col-3 p-2">
					<input class="form-check-input" type="checkbox" name="checkbox[]" value="<?php echo $product_id; ?>">
					ID: <?php echo $product_id; ?>
				</div>
				<div class="col-5 p-2"><?php echo $prod_name; ?></div>
				<div class="col-3 p-2"><?php echo $stor_name; ?></div>
				<div class="col-1 p-2"><?php echo $pcs; ?></div>
			</div>
			<?php
		} ?>
			<!-- Modal -->
			<div class="modal fade modal-sm" id="del_null" tabindex="-1" aria-labelledby="del_null" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="del_null">
								Видалити
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							</button>
						</div>
						<div class="modal-body">
							<p class="string drop">
								<div class="bg-danger bg-opacity-25 p-3">
									<center>
										<div class="mb-3">
											<p class="string drop">
												<b>Видалити вибране ?</b>
											</p>
										</div>
										<input class="btn btn-danger"  type="submit" value="OK">
									</center>
								</div>
							</p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="tab-pane fade" id="pills-menu" role="tabpanel" aria-labelledby="pills-menu-tab" tabindex="0">
		<!--add_menu -->
		<form method="POST" action="sett_update.php">
			<input type="hidden" name="add_menu" />
			<div class="ramka_full <?php echo $bg_time; ?>">
				<div class="form p-4">
					<div class="row justify-content-center">
						<div class="input-group mb-3">
							<span class="input-group-text">Назва</span>
							<input class="form-control" type="text" name="menu_name" required=""/>
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text">Аліас</span>
							<input class="form-control" type="text" name="menu_alias" required=""/>
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text">Меню</span>
							<select class="form-select" required name="menu_file">
								<option selected="selected">
								</option>
								<?php
								$log_directory = $dir_abs.'/karat/menu';
								$results_array = array();
								if (is_dir($log_directory)) {
									if ($handle = opendir($log_directory)) {
										//Notice the parentheses I added:
										while (($file = readdir($handle)) !== FALSE) {
											$results_array[] = $file;
										}
										closedir($handle);
									}
								}
								foreach ($results_array as $value) {
									if ($value != '.' && $value != '..') {
								?>
								<option value="<?php echo $value; ?>">
									Karat: <?php echo $value; ?>
								</option>
								<?php
							}
						}
								?>
							</select>
						</div>
						<div class="input-group mb-3">
							<span class="input-group-text">Іконка</span>
							<input class="form-control" type="text" name="menu_icon" placeholder="bi bi-house"/>
						</div>
						<button class="btn main-color button" type="submit">
							OK
						</button>
					</div>
				</div>
			</div>
		</form>
		<!--add_menu -->
		<form method="POST" action="sett_update.php">
			<div class='row my-3 str'></div>
			<div class='row str'>
				<div class='col-5 col-md-9'>
					<h2>Меню</h2>
				</div>
				<div class='col-7 col-md-3'>
					<!-- Button trigger modal -->
					<div class="float-end">
						<span data-bs-toggle="tooltip" data-bs-title="Видалити">
						<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#del_menu">
						<i class="bi bi-x-lg"></i>
						</button>
						</span>
					</div>
				</div>
			</div>
			<div class="row str main-color">
				<div class="col-2 p-2">
					<input id="check_all_menu" class="form-check-input" type="checkbox" onClick="toggle(this)" />
					ID
				</div>
				<div class="col-3 p-2">Назва</div>
				<div class="col-2 p-2">Аліас</div>
				<div class="col-3 p-2">Файл</div>
				<div class="col-2 p-2">Іконка</div>
			</div>
			<?php
			foreach ($all_menu as $row) {
				$id     = $row ['id'];
				$menu_name = $row ['menu_name'];
				$menu_alias = $row ['menu_alias'];
				$menu_file  = $row ['menu_file'];
				$menu_icon  = $row ['menu_icon'];
			?>
			<div class="row str">
				<div class="col-2 p-2">
					<input class="form-check-input" type="checkbox" name="checkbox[]" value="<?php echo $id; ?>">
					<?php echo $id; ?>
				</div>
				<div class="col-3 p-2">
					<?php echo $menu_name; ?>
				</div>
				<div class="col-2 p-2">
					<?php echo $menu_alias; ?>
				</div>
				<div class="col-3 p-2">
					<?php echo $menu_file; ?>
				</div>
				<div class="col-2 p-2">
					<?php echo $menu_icon; ?>
				</div>
			</div>
			<?php
		} ?>
		<!-- Modal -->
			<div class="modal fade modal-sm" id="del_menu" tabindex="-1" aria-labelledby="del_menu" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="del_menu">
								Видалити
							</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
							</button>
						</div>
						<div class="modal-body">
							<p class="string drop">
								<div class="bg-danger bg-opacity-25 p-3">
									<center>
										<div class="mb-3">
											<p class="string drop">
												<b>Видалити вибране ?</b>
											</p>
										</div>
										<input class="btn btn-danger" name="del_menu" type="submit" value="OK">
									</center>
								</div>
							</p>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
} else {
	echo "<div class='alert alert-danger my-3' role='alert'>Ви не маєте прав доступу!</div>";
?>
<div class='desc_err'>
	<img class="img_emo" src="<?php echo $dom; ?>/karat/img/emoji-err.png">
</div>
<?php
}
} else {
	echo "<div class='alert alert-danger' role='alert'>Ви не авторизовані!</div>";
	include $_SERVER ['DOCUMENT_ROOT'] . '/karat/users/mod_login.php';
}
include $_SERVER ['DOCUMENT_ROOT'] . '/footer.php';
?>