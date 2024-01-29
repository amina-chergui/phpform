<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>MailForm</title>
        <!--<meta name="viewport" content="width=device-width initial-scale=1.0 user-scalable=no">-->
        <meta name="author" content="Said Asebbane">
        <link rel="icon" href="favicon.ico" type="image/x-icon" />

        <!-- Cutom -->
        <script type="text/javascript" src="js/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

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

        <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-storage.js"></script>


    <!---------------------------------------------->
    </head>
    <body>
        <div class="global-content">
            <div id="text">
                <div class="container" >
                    <div class="row">
                        <div class="col-md-12 fadeInDown animated dy4">

                        <img class="header_img" src="images/5.png" alt="">
                        <p class="txt" style="color:white;color:white;font-size:5vh">تم الارسال</p>
                        <div class="form-container">
                            <form name="form" method="post" onsubmit="submitForm(event)" id="mainForm" enctype="multipart/form-data" hidden>
                            
                                <p class="largeview">
                                    <label >الاسم الثنائي و اللقب</label> 
                                    <input   type="text" name="mandoob_name" >
                                </p>

                                <p class="largeview">
                                    <label>صورة المتاسبق</label>
                                    <input type="file" name="PhotosCoureur"  >
                                </p>

                                <p class="largeview">
                                    <label >المحافظة</label> 
                                    <input   type="text" name="almuhafaza" >
                                </p>

                                <p class="largeview">
                                    <label >نوع السيارة</label> 
                                    <input   type="text" name="type_car" >
                                </p>

                                <p class="largeview">
                                    <label >الموديل</label> 
                                    <input  type="text" name="model" >
                                </p>
                                <p class="largeview">
                                    <label >اللون</label> 
                                    <input  type="text" name="color" >
                                </p>
                                <p class="largeview">
                                    <label >رقم السيارة</label> 
                                    <input   type="text" name="matricule_car" >
                                </p>

                                <p class="largeview">

                                    <label for="">فئة السيارة</label>
                                    <select name="class_car" id="class_car">
                                        <option value="6 سلندر na">6 سلندر na</option>
                                        <option value="8 سلندر na">8 سلندر na</option>
                                        <option value="بوستد تو ويل">بوستد تو ويل</option>
                                        <option value="بوستد فور ويل">بوستد فور ويل</option>
                                    </select>

                                </p>
                                <p class="largeview">
                                    <label>صور سنوية</label>
                                    <input type="file" name="PhotosAnnual"  >
                                </p>
                                
                                <p class="largeview">
                                    <label >صور الهوية او البطاقة الموحدة</label> 
                                    <input type="file" name="PhotosIDorCard"  >
                                </p>
                                <p class="largeview">
                                    <label >رقم الهاتف</label> 
                                    <input  type="number" name="r_phone" >
                                </p>

                                <br>
                                <a style="color:white;text-decoration: underline;"  target="_blank" href="https://www.youtube.com/watch?v=vTk2OIvxyAA">
                                شرح كيف دفع الاشتراك عن طريق زين كاش   
                                </a> 
                                <br>
                                <br>

                                <p class="largeview">
                                    <label >تأكيد دفع رسوم الإشتراك</label> 
                                    <input  type="file" name="PhotosMontantAbonnement" >
                                </p>
                                <br>

                                <p class="largeview">
                                    <input class="button" type="submit" name="Submit" value="إرسال المعلومات"> 
                                </p>
                                
                                <p style="color:white;">
                                    هذا البرنامج برعاية
                                </p>

                                <br>
                                <img src="images/s.png" alt="" width="40%">
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

 
<script>
    
    const firebaseConfig = {
        apiKey: "AIzaSyAqE15Fo9mbWGGtnw-_5itf4erIlTn19P0",
        authDomain: "multiplefilesupload-a08af.firebaseapp.com",
        projectId: "multiplefilesupload-a08af",
        storageBucket: "multiplefilesupload-a08af.appspot.com",
        messagingSenderId: "807119165750",
        appId: "1:807119165750:web:c8e7c1d42ae9953adf3b97"
    };

    firebase.initializeApp(firebaseConfig);
    const storage = firebase.storage();
    var arrayPhotos = [];

    function submitForm(event) {
    event.preventDefault();

    // Check if all form fields are filled
    const isFormValid = checkFormValidity();

    if (!isFormValid) {
        alert('Please fill in all fields.');
        return;
    }

    const form = document.getElementById('mainForm');
    const formData = new FormData(form);

    // Create an array to store promises
    const uploadPromises = [];
    const timestamp = Date.now();

    // Iterate over each file input and upload the files to Firebase Storage
    formData.forEach((value, key) => {
        if (key.startsWith('Photos')) {
            const storageRef = storage.ref(`images/${timestamp}_${value.name}`);
            const uploadPromise = storageRef.put(value)
                .then(snapshot => {
                    // Push the uploaded file to arrayPhotos 
                    return snapshot.ref.getDownloadURL();
                })
                .then(downloadURL => {
                // Add the download URL to your form data or use it as needed
                    formData.append(key, downloadURL);
                })
                .catch(error => {
                    console.error(`Error uploading ${key}:`, error);
                });
                

            uploadPromises.push(uploadPromise);
        }
    });

    // Wait for all promises to resolve before proceeding
    Promise.all(uploadPromises)
        .then(() => {
            // Make the AJAX request using jQuery
            return $.ajax({
                url: 'process.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
            });
        })
        .then(response => {
            // Clear arrayPhotos after successful upload
            arrayPhotos.length = 0;
            $(document).ready(function() {
                $(".txt").html('تم الارسال');
                $("#mainForm").attr("hidden", true);
            });
            // Handle success response as needed
            console.log(response);
        })
        .catch(error => {
            console.error(error);
            // Handle error as needed
        });
}

function checkFormValidity() {
    const form = document.getElementById('mainForm');
    for (const input of form.elements) {
        if (input.tagName === 'INPUT' && input.type !== 'submit' && !input.value.trim()) {
            // If any input is empty, return false
            return false;
        }
    }
    // If all inputs are filled, return true
    return true;
}



</script>