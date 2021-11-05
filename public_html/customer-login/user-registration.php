<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Phppot\Member;

if (!empty($_POST["signup-btn"])) {
	require_once './Model/Member.php';
	$member = new Member();
	$registrationResponse = $member->registerMember();
}
?>
<HTML>

<HEAD>
	<TITLE>User Registration</TITLE>
	<link href="assets/css/phppot-style.css" type="text/css" rel="stylesheet" />
	<link href="assets/css/user-registration.css" type="text/css" rel="stylesheet" />
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="
sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="vendor/jquery/jquery-3.3.1.js" type="text/javascript"></script>
</HEAD>

<BODY>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ffb19d">
		<div class="container">
			<a class="navbar-brand fw-bold" href="#" style="text-color: #555555">Daebak Supermarket &copy;</a>
			<ul class="nav justify-content-end">
				<li class="nav-item">
					<a class="nav-link" href="index.php" style="text-color: #555555">Login</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="https://projectpaw.000webhostapp.com//index.php">Home</a>
				</li>
			</ul>
		</div>
	</nav>

	<section class="container">
		<div class="container min-vh-100 d-flex align-items-center justify-content-center">
			<div class="card text-dark bg-light shadow " style="width: 400px">
				<div class="card-header fw-bold">...</div>
				<div class="card-body">

					<form name="sign-up" action="" method="post" onsubmit="return signupValidation()">
						<div class="signup-heading">Registration</div>
						<?php
						if (!empty($registrationResponse["status"])) {
						?>
							<?php
							if ($registrationResponse["status"] == "error") {
							?>
								<div class="server-response error-msg"><?php echo $registrationResponse["message"]; ?></div>
							<?php
							} else if ($registrationResponse["status"] == "success") {
								$token = hash('sha256', md5(date('Y-m-d')));


								include('phpmailer/Exception.php');
								include('phpmailer/PHPMailer.php');
								include('phpmailer/SMTP.php');
								$mail = new PHPMailer(true);
								$mail->SMTPDebug = 0;
								$mail->isSMTP();
								$mail->Host = 'smtp.gmail.com';
								$mail->SMTPAuth = true;
								//ganti dengan email dan password yang akan di gunakan sebagai email pengirim
								$mail->Username = 'universefactory07@gmail.com';
								$mail->Password = 'seventeen!';
								$mail->SMTPSecure = 'ssl';
								$mail->Port = 465;
								//ganti dengan email yg akan di gunakan sebagai email pengirim
								$mail->setFrom('universefactory07@gmail.com', 'Daebak Supermarket');
								$mail->addAddress($_POST['email'], $_POST['nama']);
								$mail->isHTML(true);
								$mail->Subject = "Aktivasi Pendaftaran Member";
								$mail->Body = "Selemat, anda berhasil membuat akun. Untuk mengaktifkan akun anda silahkan klik link dibawah ini.
			 <a href='https://projectpaw.000webhostapp.com/customer-login/aktivasi.php?t=" . $token . "'>https://projectpaw.000webhostapp.com/customer-login/aktivasi.php?t=" . $token . "</a>  ";
								$mail->send();
								echo "<script>alert('Pendaftaran Berhasil, Silahkan Cek Email dan Lakukan Aktivasi')</script>";
								echo "<script>location='user-registration.php';</script>";
							?>
								<div class="server-response success-msg"><?php echo $registrationResponse["message"]; ?></div>
							<?php
							}
							?>
						<?php
						}
						?>
						<div class="error-msg" id="error-msg"></div>
						<div class="row">
							<div class="inline-block">
								<div class="form-label">
									Username<span class="required error" id="username-info"></span>
								</div>
								<?php
								$tokenku = hash('sha256', md5(date('Y-m-d')));
								?>
								<input type="hidden" value="<?= $tokenku ?>" name="token" id="token">
								<input class="input-box-330" type="text" name="username" id="username">
							</div>
						</div>
						<div class="row">
							<div class="inline-block">
								<div class="form-label">
									Email<span class="required error" id="email-info"></span>
								</div>
								<input class="input-box-330" type="email" name="email" id="email">
							</div>
						</div>
						<div class="row">
							<div class="inline-block">
								<div class="form-label">
									Password<span class="required error" id="signup-password-info"></span>
								</div>
								<input class="input-box-330" type="password" name="signup-password" id="signup-password">
							</div>
						</div>
						<div class="row">
							<div class="inline-block">
								<div class="form-label">
									Confirm Password<span class="required error" id="confirm-password-info"></span>
								</div>
								<input class="input-box-330" type="password" name="confirm-password" id="confirm-password">
							</div>
						</div>
						<div class="row">
							<input class="btn" type="submit" name="signup-btn" id="signup-btn" value="Sign up">
						</div>
					</form>
				</div>
			</div>
		</div>
		</div>
	</section>
	<script>
		function signupValidation() {
			var valid = true;

			$("#username").removeClass("error-field");
			$("#email").removeClass("error-field");
			$("#password").removeClass("error-field");
			$("#confirm-password").removeClass("error-field");

			var UserName = $("#username").val();
			var email = $("#email").val();
			var Password = $('#signup-password').val();
			var ConfirmPassword = $('#confirm-password').val();
			var emailRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;

			$("#username-info").html("").hide();
			$("#email-info").html("").hide();

			if (UserName.trim() == "") {
				$("#username-info").html("required.").css("color", "#ee0000").show();
				$("#username").addClass("error-field");
				valid = false;
			}
			if (email == "") {
				$("#email-info").html("required").css("color", "#ee0000").show();
				$("#email").addClass("error-field");
				valid = false;
			} else if (email.trim() == "") {
				$("#email-info").html("Invalid email address.").css("color", "#ee0000").show();
				$("#email").addClass("error-field");
				valid = false;
			} else if (!emailRegex.test(email)) {
				$("#email-info").html("Invalid email address.").css("color", "#ee0000")
					.show();
				$("#email").addClass("error-field");
				valid = false;
			}
			if (Password.trim() == "") {
				$("#signup-password-info").html("required.").css("color", "#ee0000").show();
				$("#signup-password").addClass("error-field");
				valid = false;
			}
			if (ConfirmPassword.trim() == "") {
				$("#confirm-password-info").html("required.").css("color", "#ee0000").show();
				$("#confirm-password").addClass("error-field");
				valid = false;
			}
			if (Password != ConfirmPassword) {
				$("#error-msg").html("Both passwords must be same.").show();
				valid = false;
			}
			if (valid == false) {
				$('.error-field').first().focus();
				valid = false;
			}
			return valid;
		}
	</script>
</BODY>

</HTML>