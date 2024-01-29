<?php

$txt = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	# code...
	
	$adminPage = 'dashboard.php';
	
	$users = json_decode(file_get_contents('admin/data/admins.json'));
	$username = $_POST['login'];
	$password = $_POST['pwd'];
	
	$checks = [] ;
	
	$checks = array_filter($users,fn($x) => ($x->username == $username && $x->password == $password ));
	
	
	if (count($checks) > 0 ) {
		# code...
		session_start();
		$key = array_keys($checks)[0];
		$_SESSION['user'] = $checks[$key] ;
		
		header("location:$adminPage");
	}
	else {
		
		$txt = 'بيانات الدخول غير صحيحة';
	}
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>MailForm</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	
	<link rel="stylesheet" href="css/script/bootstrap.min.css">
	<link rel="stylesheet" href="css/script/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/script/bootstrap-rtl.css">
	
	<script src="js/script/jquery.min.js"></script>	
	<script src="js/script/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="css/script/custom.css">
	<script src="js/script/custom.js"></script>

<style>
.form-control{ margin-bottom:10px}
.wrong-info {
	text-align: center;
	padding: 10px;
	margin: 5px;
	color: rgb(150, 20, 20);

}
</style>
</head>
<body>
	<br /><br /><br />

    <div class="container">
	
	<form class="form-signin" role="form" method="POST" action="">
		<h2 class="form-signin-heading">الرجاء تسجيل الدخول</h2>
		<h3 class="wrong-info"><?=$txt ?></h3>
		<input type="text" class="form-control" placeholder="اسم المستخدم" required autofocus name="login">
		<input type="password" class="form-control" placeholder="كلمة المرور" required name="pwd">
		<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">تسجيل الدخول</button>
	</form>

    </div> <!-- /container -->

</body>
</html>







