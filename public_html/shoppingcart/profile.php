<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Phppot\Member;

?>
<HTML>

<HEAD>
	<TITLE>Ubah Profil</TITLE>
	<link href="../customer-login/assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
	<link href="../customer-login/assets/css/user-registration.css" type="text/css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="
sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="../customer-login/vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>

<BODY>
	<?= template_header('Cart') ?>

	<section class="container">
		<div class="container min-vh-100 d-flex align-items-center justify-content-center">
			<div class="card text-dark bg-light shadow " style="width: 400px">
				<div class="card-header fw-bold">...</div>
				<div class="card-body">

					<form name="sign-up" action="" method="post">
						<div class="signup-heading">Edit Profil</div>
						<?php
						$koneksi = new mysqli("localhost", "id17834325_pawprojectku", "Seventeenpawproject123_", "id17834325_pawproject");
						$username = $_SESSION["username"];
						$ambil = $koneksi->query("SELECT *FROM tbl_member WHERE username='$username'");
						$pecah = $ambil->fetch_assoc();
						?>
						<div class="error-msg" id="error-msg"></div>
						<div class="row">
							<div class="inline-block">
								<div class="form-label">
									Username<span class="required error" id="username-info"></span>
								</div>
								<input class="input-box-330" type="text" value="<?= $pecah['username'] ?>" name="username" id="username" readonly required>
							</div>
						</div>
						<div class="row">
							<div class="inline-block">
								<div class="form-label">
									Email<span class="required error" id="email-info"></span>
								</div>
								<input class="input-box-330" type="email" value="<?= $pecah['email'] ?>" name="email" id="email">
							</div>
						</div>
						<div class="row">
							<div class="inline-block">
								<div class="form-label">
									Password (Kosongkan Jika Tidak Di Ubah)<span class="required error" id="signup-password-info"></span>
								</div>
								<input class="input-box-330" type="password" name="password" id="signup-password">
							</div>
						</div>
						<div class="row">
							<input class="btn" type="submit" name="ubah" value="Simpan">
						</div>
					</form>
					<?php
					if (isset($_POST["ubah"])) {
						$username = $_POST["username"];
						$email = $_POST["email"];
						$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
						if (!empty($_POST["password"])) {
							$koneksi->query("UPDATE tbl_member SET email='$email', password ='$password' where username='$username'");
						} else {
							$koneksi->query("UPDATE tbl_member SET email='$email' where username='$username'");
						}
						echo "<script>alert('Profil Berhasil Diubah')</script>";
						echo "<script>location='index.php?page=profile';</script>";
					}
					?>
				</div>
			</div>
		</div>
		</div>
	</section>
</BODY>

</HTML>