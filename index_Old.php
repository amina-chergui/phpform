<?php

$txt = '';
session_start();

if (empty( $_SESSION['user'])) {
  # code...
  header('location:login.php');
}

$wasel = count(json_decode(file_get_contents('admin/data/data.json')));

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['Submit']) {
  # code...
  
  $data_file_location = 'admin/data/data.json';
  $errors = [];
    

  if ($_FILES['photo']['error'] !== 0 ) {
    # code...
    $name = null;
  }
  else {
    
    $location = 'admin/data/photos/';
    $temp_name = $_FILES['photo']['tmp_name'];
    $name = $location.$_FILES['photo']['name'];
    

    $result = move_uploaded_file($temp_name,$name);

      if (!$result) {
        # code...
        array_push($errors,'فشل حفظ الصورة , تم الغاء العملية');
      }
  }
    


  if (count($errors) > 0 ) {
    # code...
    $txt = $errors[0];
  }
  else{
    
    unset($_POST['Submit']);
    $data = json_decode(file_get_contents('admin/data/data.json'));
    array_push($data,json_decode(json_encode(array_merge($_POST,[
      "photo" => $name ,
      "mandoob_name" => $_SESSION['user']->username,
      "cash_vat" => (intval($_POST['cash']) + (intval($_POST['cash']) * 5/100)),
      "wasel" => ($wasel + 300)
    ]))));
    file_put_contents('admin/data/data.json',json_encode($data));
    $txt = '<h2 style="color:white">تم الحفظ</h2>';

  }

  



}






?><!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <title>MailForm</title>
  <!--<meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=no">-->
  <meta name="author" content="Said Asebbane">
  <link rel="icon" href="favicon.ico" type="image/x-icon" />

  <!-- Cutom -->
<script type="text/javascript" src="js/main.js"></script>

<!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-------Animation apres selection-------------->
  <script src="js/jquery.min.js"></script>
  <script src="js/wow_animation.js"></script>
  <!-- Smoothscroll -->
  <script src="js/smoothscroll.js"></script>
  <script>
 	new WOW().init();
  </script>
  <!---------------------------------------------->

  </head>
  <body>
  <div class="global-content">
    <div id="text">
      <div class="container" >
        <div class="row">
          <div class="col-md-12 fadeInDown animated dy4">

          <img src="images/222222222.png" alt="" width="40%">
            <h1></h1>
            <h4><?=$txt ?></h4>
            <form name="form" method="post" onsubmit="submit(event)" id="mainForm" enctype="multipart/form-data">

          <p class="largeview">
          <label >اسم مندوب الارسال</label> 
          <input required type="text" name="mandoob_name" value="<?= $_SESSION['user']->name ?? $_SESSION['user']->username  ?>" disabled>
          </p>
          <p class="largeview">
          <label >MTCN (ان وجد)</label> 
          <input type="text" name="mtcn" >
          </p>
          <p class="largeview">
          <label >رقم الوصل</label> 
          <input  type="number" name="wasel" disabled value="<? echo ($wasel) + 300 ?>" >
          </p>
          
          <!-- ------------------------------- -->
          <!-- <hr style="width: 55%; padding : 0px 40px ; margin-top :20px ; margin-bottom: 20px;"> -->
           <!-- ------------------------------ --> 


          <p class="largeview">
          <label >اسم المرسل</label> 
          <input required type="text" name="s_name" >
          </p>
          <p class="largeview">
          <label >رقم المرسل</label> 
          <input required type="number" name="s_phone" >
          </p>
          <p class="largeview">
          <label >سبب التحويل</label> 
          <input type="text" name="reason" >
          </p>
          <p class="largeview">
          <label for="">نوع استلام النقود</label>
          <select name="cash_type" id="">
            <option>نقدي</option>
            <option>الكتروني</option>
          </select>
          </p>
          <p class="largeview">
                <label>ملاحظات (ان وجدت) :</label>
                <textarea class="" id="notes" name="notes" ></textarea>
              </p>
          

          <!-- ------------------------------ --> 
          
          <!-- <hr style="width: 55%; padding : 0px 40px ; margin-top :20px ; margin-bottom: 20px;"> -->
           <!-- ------------------------------ --> 
          
          <p class="largeview">
          <label >اسم المستلم</label> 
          <input required type="text" name="r_name" >
          </p>
          <p class="largeview">
          <label >رقم المستلم</label> 
          <input required type="number" name="r_phone" >
          </p>
          <p class="largeview">
          <label >رقم كارد المستلم (ان وجد)</label> 
          <input type="number" name="r_card" >
          </p>
          <p class="largeview">
          <label >المبلغ المراد تحويله</label> 
          <input required type="number" name="cash" onchange="vat(this)" >
          
          </p>
          <p class="largeview">
          <label >المبلغ مع الضريبة 5%</label> 
          <input required type="text" name="cash_vat" disabled >
          </p>
          
          <!-- --------------------------- -->
          
          <!-- <hr style="width: 55%; padding : 0px 40px ; margin-top :20px ; margin-bottom: 20px;"> -->
           <!-- ------------------------------ --> 

          <p class="largeview">
          <label >ارفاق صورة</label> 
          <input type="file" name="photo"  >
          </p>



          <br>
             
              <p style="color:white;">
              علما ان اقل عمولة هي 15$
              </p>
              <p class="largeview">
                
              <input class="button" type="submit"    name="Submit" value="انشاء وصل"> 
              </p>
              <p style="text-align: center; margin-bottom:30px;">
                <a href="dashboard.php">لوحة التحكم</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>