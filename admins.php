<?php

$txt = '';

session_start();
if (empty($_SESSION['user'])) {
    # code...
    header('location:login.php');    
}

$admins = json_decode(file_get_contents('admin/data/admins.json'));

if (isset($_POST['delete'])) {
  # code...
  $index = $_POST['index'];
  unset($admins[$index]);

  $txt = '<span style="color:rgba(180,20,20,0.8)" >تم الحذف</span>';

}

if (isset($_POST['add'])) {
  # code...
  array_push($admins,json_decode(json_encode([
    "name"     => $_POST['name'],
    "username" => $_POST['username'],
    "password" => $_POST['password']
  ])));

  $txt = '<span style="color:rgba(20,180,20,0.8)" >تمت الاضافة</span>';

}

file_put_contents('admin/data/admins.json',json_encode($admins));

?>
<!DOCTYPE html>
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



</head>
<body>
<div class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Nav</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="dashboard.php">الرئيسية</a> </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      <li><a href="#" >المشرفين</a></li>
        <li><a href="../index.php" target="_blank">صفحة الفورم</a></li>
        <li><a href="logout.php">خروج</a></li>
      </ul>
    </div>
    <!--/.nav-collapse --> 
  </div>
</div>
<div class="container"> </div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">تأكيد الحذف</h4>
      </div>
      <div class="modal-body">
        <p>أنت على وشك حذف بيانات, هذا الإجراء لا رجعة فيه. هل تريد تفعيله؟</p>
        <p class="debug-url"></p>
      </div>
      <div class="modal-footer">
      <form action="" method="POST">
        <input type="hidden" name="index" id="index" >
        <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>

        <input type="submit" class="btn btn-danger danger" name="delete" value="حذف"> </div>
      </form>  
      
    </div>
  </div>
</div>

<h4 style="text-align: center;"><?=$txt ?></h4>
<div class="container myform">
<h3>تعديل البيانات</h3>

<form method="POST" action="" class="form-horizontal" role="form">
	<input type='hidden' name='id' value='1'/>
	

	<div class="form-group">	
		<label for="input" class="col-sm-2 control-label">الإسم</label>
		<div class="col-sm-5">
			<input class="form-control" type='text' name='name' />
		</div>
	</div>
	
	<div class="form-group">	
		<label for="input" class="col-sm-2 control-label">اسم المستخدم</label>
		<div class="col-sm-5">
			<input class="form-control" type='text' name='username'  />
		</div>
	</div>
	
    <div class="form-group">	
		<label for="input" class="col-sm-2 control-label">كلمةالمرور</label>
		<div class="col-sm-5">
			<input class="form-control" type='password' name='password' value='' />
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10 " >
			<button class="btn btn-primary" name="add" >اضافة</button>
		</div>
	</div>
</form>
</div>	


<div class="container" id="table">
		<table id="example" class="table table-striped">
            <thead>
                <tr>
                  <th>الاسم الكامل</th>
                  <th>اسم المستخدم</th>
                  <th>كلمةالمرور</th>
                </tr>
            </thead>
			<tbody>
        
            
              <?php
              if (count($admins) > 0 ) {
                # code...
              foreach ($admins as $index => $admin) {
                # code...

                ?>
                
                <tr>
                
                <td><?=$admin->name ?? "فارغ" ?></td>
                <td><?=$admin->username ?></td>
                <td><?=$admin->password ?></td>

                
                <td onclick="remove(<?=$index ?>)">	
						<a data-href='' data-toggle='modal' data-target='#confirm-delete' >
						<span class="glyphicon glyphicon-trash"></span></a><br>
                    </td>
            </tr>
                <?php
              }
            }
              
              ?>
					
            </tbody>
			</table>
		</div>
</body>
<script>
  function remove(i) {
    document.querySelector('#index').value =  i
    
  }
</script>
</html>