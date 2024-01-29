<?php

session_start();
if ($_GET['i'] == null) {
  # code...
  header('location:dashboard.php');
}
if ($_SESSION['user'] == null ) {
	# code...
	header('location:login.php');
}

$index = $_GET['i'];

$inputs  = json_decode(file_get_contents('admin/data/data.json'));

if (empty($inputs[$index])) {
	# code...
	header('location:dashboard.php');
	
}

$data = $inputs[$index];

?><!DOCTYPE html>
<html lang="fr">
<head>
<title>MailForm</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="css/script/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/script/bootstrap-rtl.css">
<link rel="stylesheet" type="text/css" href="css/script/dataTables.bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="css/script/bootstrap-theme.min.css">
<link rel="stylesheet" type="text/css" href="css/script/custom.css">
<link rel="stylesheet" type="text/css" href="css/script/btn-xlsx.css">
<link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet"> 


<script type="text/javascript" src="js/script/jquery.min.js"></script>
<script type="text/javascript" src="js/script/bootstrap.min.js"></script>
<script type="text/javascript" src="js/script/custom.js"></script>


<!-- pdf  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>


</head>
<body>
<div class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Nav</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="dashboard.php">الرئيسية</a> </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
       
        <li><a href="index.php" target="_blank">صفحة الفورم</a></li>
		<li><a href="admins.php" >المشرفين</a></li>
        <li><a href="logout.php">خروج</a></li>
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
</div>


<div class="container myform" id="pdf">
<h3>التفاصيل</h3>

<table class="table" >
    <tbody>
        <tr>
            <td style="width: 35%;"><strong>رقم الوصل</strong></td>
            <td><?=$data->wasel ?? 'بلا' ?></td>
        </tr>
        <tr>
            <td ><strong>الاسم الثنائي و اللقب</strong></td>
            <td><?=$data->mandoob_name ?? 'بلا' ?></td>
        </tr>
		<tr>
            <td><strong>صورة المتسابق</strong></td>
            <td><img src="<?=$data->PhotosCoureur ?? '' ?>" style="width: 250px; height: 130px; border: 1px solid #000;" alt="صورة المتسابق "></td>
        </tr>
        <tr>
            <td><strong>المحافظة</strong></td>
            <td><?=$data->almuhafaza ?? 'بلا' ?></td>
        </tr>
        <tr>
            <td><strong>نوع السيارة</strong></td>
            <td><?=$data->type_car ?? 'بلا' ?></td>
        </tr>
        <tr>
            <td><strong>الموديل</strong></td>
            <td><?=$data->model ?? 'بلا' ?></td>
        </tr>
        <tr>
            <td><strong>اللون</strong></td>
            <td><?=$data->color ?? 'بلا' ?></td>
        </tr>
        <tr>
            <td><strong>رقم السيارة</strong></td>
            <td><?=$data->matricule_car ?? 'بلا' ?></td>
        </tr>
        <tr>
            <td><strong>فئة السيارة</strong></td>
            <td><?=$data->class_car ?? 'بلا' ?></td>
        </tr>
        <tr>
            <td><strong>صور سنوية</strong></td>
            <td><img src="<?=$data->PhotosAnnual ?? '' ?>" style="width: 250px; height: 130px; border: 1px solid #000;" alt="صور سنوية" ></td>
        </tr>
        <tr>
            <td><strong>صور الهوية او البطاقة الموحدة</strong></td>
            <td><img src="<?=$data->PhotosIDorCard ?? '' ?>" style="width: 250px; height: 130px; border: 1px solid #000;" alt="صور الهوية او البطاقة الموحدة" ></td>
        </tr>
        <tr>
            <td><strong>رقم الهاتف</strong></td>
            <td><?=$data->r_phone ?? 'بلا' ?></td>
        </tr>
        <tr>
            <td><strong>تأكيد دفع رسوم الإشتراك</strong></td>
            <td><img src="<?=$data->PhotosMontantAbonnement ?? '' ?>" style="width: 250px; height: 130px; border: 1px solid #000;" alt="تأكيد دفع رسوم الإشتراك" ></td>
        </tr>
    </tbody>
</table>


<p class="">	
  <button style="padding: 10px 20px; background:rgba(20,20,230,0.8); color:white ; border : 2px solid white ;" type="button"  style="background:none;" onclick="pdf()" >طباعة الوصل</button>
</p>
</div>	
</body>

<script>
	function pdf() {
        
        // Choose the element id which you want to export.
        var element = document.getElementById('pdf');
        // element.style.width = '700px';
        // element.style.height = '900px';
        var opt = {
            margin:       0.5,
            filename:     'myfile.pdf',
            image:        { type: 'jpeg', quality: 1 },
            html2canvas:  { scale: 1 },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait',precision: '12' }
          };
        
        // choose the element and pass it to html2pdf() function and call the save() on it to save as pdf.
        html2pdf().set(opt).from(element).save();
    }
</script>

</html>