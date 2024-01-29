<?php

session_start();

if (empty($_SESSION['user']) ) {
    # code...
    // die('hi');
    header('location:login.php');
}

$inputs = json_decode(file_get_contents('admin/data/data.json'));


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

<!-- Cutom -->
<script type="text/javascript" src="js/main.js"></script>
<!------------Table Sort-------------->
<script type="text/javascript" src="js/script/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/script/dataTables.bootstrap.min.js"></script>  
    <!-- <script>
    $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 3, "desc" ]]
    } );
} );
  </script> -->
  

<!------------Export Excel-------------->  


    <!-- pdf   -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

  <!-- excel  -->
  <script type="text/javascript" src="js/tableToExcel.js"></script>



<script type="text/javascript" src="js/script/xlsx.core.min.js"></script>
<script type="text/javascript" src="js/script/Blob.js"></script>
<script type="text/javascript" src="js/script/FileSaver.js"></script>
<script type="text/javascript" src="js/script/tableexport.min.js"></script>
<script type="text/javascript" src="js/script/main.min.js"></script>




</head>
<body>


<div class="navbar navbar-default" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Nav</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#">الرئيسية</a> </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      <li><a href="admins.php" >المشرفين</a></li>
        <li><a href="#" onclick="excel()" >التفريع إلى Excel</a></li>
        <li><a href="index.php" >صفحة الفورم</a></li>
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
        <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
        <a href="#" class="btn btn-danger danger">حذف</a> </div>
    </div>
  </div>
</div>

        <div class="container" id="table">
        <?php
              if (count($inputs) > 0 ) {

                ?>
		<table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>اسم المتسابق</th>
                    <th>المحافظة</th>
                    <th>نوع السيارة</th>
                    <th>فئة السيارة</th>
                    <th>موديل السيارة</th>
                </tr>
            </thead>
			<tbody>
        
            
             <?php
                # code...
              foreach ($inputs as $index => $input) {
                # code...

                ?>
                
                <tr>
                
                <td><?=$input->mandoob_name ?></td>
                <td><?=$input->almuhafaza ?></td>
                <td><?=$input->type_car ?></td>
                <td><?=$input->class_car ?></td>
                <td><?=$input->model ?></td>

                <td><a style="padding:  10px 20px margin : 5px ; background: rgba(20,20,230,0.8; color : white ;)" href="report.php?i=<?=$index ?>">طباعة</a></td>
                
                
            </tr>
                <?php
              }
            }
            else {
              echo '<h1 style="text-align:center;">لا يوجد بيانات</h1>';
            }
              
              ?>
					<!-- <td>	
						<a href='admin.php?edit=1'>
						<span class="glyphicon glyphicon-edit"></span></a>
					</td> -->
					
            </tbody>
			</table>
		</div>
	
  
  
  

  
  
  
  
  
  
  </body>



  
  <script>
    function generatePDF() {
        
        // Choose the element id which you want to export.
        var element = document.getElementById('table');
        element.style.width = '700px';
        element.style.height = '900px';
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


<script>
    function excel() {
       TableToExcel.convert(document.getElementById('table'))
    }
  </script>
</html>