<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>WebDev - index</title>
    <link rel="icon" href="img/trasp.png">

    <meta name="description" content="Your Description Here">
    <meta name="keywords" content="bootstrap themes, portfolio, responsive theme">
    <meta name="author" content="ThemeForces.Com">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- Favicons
        ================================================== -->
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">

        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

        <!-- Stylesheet
        ================================================== -->
        <link rel="stylesheet" type="text/css"  href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/responsive.css">

        <script type="text/javascript" src="js/modernizr.custom.js"></script>
        <script type="text/javascript" src="./fbapp/fb.js"></script>

        <link href='http://fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,900,400,200,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body style="">
        <div id="tf-service" style="background-color: #d6d6c2" >
            <?php
            if (!empty($_POST["ready"])) {



                $servername = "localhost";
                $username = "root";
                $dbname = "webdev";

                $conn = new mysqli($servername, $username, '', $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $user = $_POST["username"];
                $pass = $_POST["pwd1"];
                $email = $_POST["email"];

                function generateRandomString($length = 10) {
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $charactersLength = strlen($characters);
                    $randomString = '';
                    for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
                    }
                    return $randomString;
                }
                $random = generateRandomString();

                $sql = "INSERT INTO users(username, password, email, confirm) VALUES('$user', '$pass', '$email','$random')";

                if (mysqli_query($conn, $sql)) {

                    echo "Record updated successfully";
                } else {
                    echo "Error updating record: " . mysqli_error($conn);
                }

                mysqli_close($conn);

                //KWDIKAS GIA MAIL 
                require '/PHPMailer-master/PHPMailerAutoload.php';
                $mail = new PHPMailer;     
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = TRUE; 
                $mail->Username = 'skpa3201@gmail.com';
                $mail->Password = '%Z57y0@3'; 
                $mail->Port = 25;

                $mail->setFrom('skpa3201@gmail.com', 'Mailer');
                $mail->addAddress($email, $user);
                $mail->addReplyTo('skpa3201@gmail.com', 'Information');

                $mail->Subject = 'Account Confirmation';
                $mail->Body = $user.' hello, enter this link to verify your account'.'  http://localhost/webdev/WebDev/confirm.php?confirm='.$random;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    $message = "Στάλθηκε email επιβεβαίωσης";
                    echo "<script type='text/javascript'>alert('$message'); window.location.href = '/webdev/WebDev/login.php';</script>";
                }


// KWDIKAS GIA MAIL
            }
            ?>

            <div class="container " style="text-align: center">
                <div class="content" style=" text-align: center">

                    <h3 style=" text-align: center; font-size:45px;">Register Page</h3>
                    <ul style="list-style-type:none; align-content:center; ">

                        <form method="post" onsubmit="return checkForm(this);">
                            <h3 style="font-size:20px; font:bold;">Username: </h3>                           
                            <input style="width:300px;" type="text" name="username">

                            <h3 style="font-size:20px; font:bold;">Password:  </h3> 
                            <input style="width:300px;" type="password" style="width:300px;" name="pwd1">

                            <h3 style="font-size:20px; font:bold;">Confirm Password:</h3>
                            <input style="width:300px;"  type="password" name="pwd2">

                            <h3 style="font-size:20px; font:bold;">Do the math: <?php $number1=rand(1,9);$number2=rand(1,9);echo $number1."+".$number2;$_SESSION["summ"]=$number1+$number2?></h3>
                            <input style="width:300px;" type="text" name="math">
                            <h3 style="font-size:20px; font:bold;">Email:</h3>
                            <input style="width:300px;" type="text"  name="email">

                            <br>
                            <br>
                            <input name="ready" class="button5" type="submit" value="Εισαγωγή Στοιχείων">
                            <br>
                            <br>
                            
                        </form>
                    </ul>
                </div>
            </div>
            <script type="text/javascript">

                function checkForm(form)
                {
                    if (form.username.value == "") {
                        alert("Error: Username cannot be blank!");
                        form.username.focus();
                        return false;
                    }
                    re = /^\w+$/;
                    if (!re.test(form.username.value)) {
                        alert("Error: Username must contain only letters, numbers and underscores!");
                        form.username.focus();
                        return false;
                    }

                    if (form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) {
                        if (form.pwd1.value.length < 6) {
                            alert("Error: Password must contain at least six characters!");
                            form.pwd1.focus();
                            return false;
                        }
                        if (form.pwd1.value == form.username.value) {
                            alert("Error: Password must be different from Username!");
                            form.pwd1.focus();
                            return false;
                        }
                        re = /[0-9]/;
                        if (!re.test(form.pwd1.value)) {
                            alert("Error: password must contain at least one number (0-9)!");
                            form.pwd1.focus();
                            return false;
                        }
                        re = /[a-z]/;
                        if (!re.test(form.pwd1.value)) {
                            alert("Error: password must contain at least one lowercase letter (a-z)!");
                            form.pwd1.focus();
                            return false;
                        }
                        re = /[A-Z]/;
                        if (!re.test(form.pwd1.value)) {
                            alert("Error: password must contain at least one uppercase letter (A-Z)!");
                            form.pwd1.focus();
                            return false;
                        }
                        if (form.math.value != "<?php echo $_SESSION["summ"];?>") {
                            alert("Error: den kanei toso oute me aitisi !!!");
                            form.math.focus();
                            return false;
                        }
                        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.email.value)))  
                        {  
                             alert("You have entered an invalid email address!")
                        }

                    } else {
                        alert("Error: Please check that you've entered and confirmed your password!");
                        form.pwd1.focus();
                        return false;
                    }

                    alert("You entered a valid password: " + form.pwd1.value);
                    return true;
                }
                function ValidateEmail(mail)   
                {  

                }  
            </script>
        </body>
        </html>