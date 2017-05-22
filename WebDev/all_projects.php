<?php session_start(); ?>
<html lang="en">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WebDev</title>
        <link rel="icon" href="img/trasp.png">
        <meta name="description" content="Your Description Here">
        <meta name="keywords" content="bootstrap themes, portfolio, responsive theme">
        <meta name="author" content="ThemeForces.Com">

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

        <link href='http://fonts.googleapis.com/css?family=Raleway:500,600,700,100,800,900,400,200,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>

    </head>
    <?php
            if (!empty($_POST["epelekse"]) && $_SESSION["type"]=="student") {
                    $servername = "localhost";
                    $username = "root";
                    $dbname = "webdev";
                    $conn = new mysqli($servername, $username, '', $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    function test_input($data) {
                      $data = trim($data);
                      $data = stripslashes($data);
                      $data = htmlspecialchars($data);
                      return $data;
                    }

                    $id = test_input($_POST["id"]);
                    $teacher = test_input($_POST["teacher"]);
                    $pro_name = test_input($_POST["pro_name"]);
                    $summ = test_input($_POST["summ"]);
                    $conn = new mysqli($servername, $username,'', $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $user=$_SESSION["username"];
                    $sql1 = "INSERT INTO applications(projectID, studentID, status) VALUES ('$id','$user','applied')";
                    if(mysqli_query($conn, $sql1)){
                        header('Location: /webdev/WebDev/students_menu.php');  
                    }
                    mysqli_close($conn);
                }
            ?>
    <body>
        <div class="container">
            <br></br>
            <?php
            /*if (!empty($_POST["search"])) {

            }*/
            $servername = "localhost";
            $username = "root";
            $dbname = "webdev";
            $conn = new mysqli($servername, $username, '', $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            if (!empty($_POST["ready"])) {
                $search = $_POST["search"];
                $sql = "SELECT * FROM projects WHERE teacher='$search'";
                $result = $conn->query($sql);
                $choice=0;
            }else if(!empty($_POST["showall"])){
                $sql = "SELECT * FROM projects";
                $result = $conn->query($sql);
                $choice=0;
            }else if(!empty($_POST["showapplications"])){
                $user=$_SESSION["username"];
                $sql = "SELECT * FROM applications,projects WHERE projects.projectID=applications.projectID AND studentID='$user'";
                $result = $conn->query($sql);
                $choice=1;
            }

            
            ?>

            <div id="tf-service" style="zoom:90%;" >


                <div class="hidden-xs container" style=" padding:1%; text-align:center;" >
                    <div class="col-md-4" >
                        <h3 style="font-size:18px; font:bold;">Teacher</h3>
                    </div>

                    <div class="col-md-4 "   >
                        <h3 style="font-size:18px; font:bold;">Project Name</h3>
                    </div>

                    <div class="col-md-4 " >
                    <?php if($choice==0){ ?>
                        <h3 style="font-size:18px; font:bold;">Summary</h3>
                        <?php }else {?>
                        <h3 style="font-size:18px; font:bold;">Status</h3>
                        <?php }?>
                    </div>

                    <div class="col-md-4"   >
                       
                    </div>
                </div>

                <?php
                $counter = 0;

                if ($result->num_rows > 0 && $choice==0) {
                    // output data of   each row
                    while ($row = $result->fetch_assoc()) {
                        if ($counter % 2 == 0) {
                            ?>
                            <div class="container" style=" border-radius: 4px;  border: 1px solid #ccccb3; background-color:white; padding:2%; text-align:center;" >
                                <div class="row" style="min-height: 100px;" >
                                    <form id="1" action="" method="post">
                                        <div class="col-md-4">
                                            <h3 style="font-size:20px;"><?php echo $row["teacher"] ?></h3>  
                                        </div>    
                                        <div class="col-md-4" >
                                            <h3 style="font-size: 14px;">  <?php echo $row["projectname"] ?></h3>
                                        </div>
                                        <div class="col-md-4 ">
                                            <h3 style="font-size: 14px;"> <?php echo $row["summary"] ?></h3>
                                        </div>
                                        <div class="col-md-4 ">
                                            <input name="epelekse" type="submit" class="button button4" style="align-content:center; border-color:#ffa31a;color:black; background-color:#ffa31a; font-color:black;" value="Επέλεξε">
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $row["projectID"] ?>">
                                        <input type="hidden" name="teacher" value="<?php echo $row["teacher"] ?>">
                                        <input type="hidden" name="pro_name" value="<?php echo $row["projectname"] ?>">
                                        <input type="hidden" name="summ" value="<?php echo $row["summary"] ?>">
                                    </form>
                                </div>
                            </div>
                            <br>
                            <?php
                        } else {
                            ?>
                            <div class="container" style="  border-radius: 4px; border: 1px solid #ccccb3; background-color:#eaeae1; padding:2%; text-align:center;" >
                                <div class="row" style="min-height: 100px; " >

                                    <form id="2" action="" method="post">
                                        <div class="col-md-4">
                                            <h3 style="font-size:20px;"><?php echo $row["teacher"] ?></h3>  
                                        </div>    
                                        <div class="col-md-4" >
                                            <h3 style="font-size: 14px;">  <?php echo $row["projectname"] ?></h3>
                                        </div>
                                        <div class="col-md-4 ">
                                            <h3 style="font-size: 14px;"> <?php echo $row["summary"] ?></h3>
                                        </div>
                                        <div class="col-md-4 ">
                                            <input name="epelekse" type="submit" class="button button4" style="align-content:center; border-color:#ffa31a;color:black; background-color:#ffa31a; font-color:black;" value="Επέλεξε">
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $row["projectID"] ?>">
                                        <input type="hidden" name="teacher" value="<?php echo $row["teacher"] ?>">
                                        <input type="hidden" name="pro_name" value="<?php echo $row["projectname"] ?>">
                                        <input type="hidden" name="summ" value="<?php echo $row["summary"] ?>">
                                    </form>
                                </div>
                            </div>  
                            <br>

                            <?php
                        }
                        $counter++;
                    }
                }
                else if ($result->num_rows > 0 && $choice==1) {
                    // output data of   each row
                    while ($row = $result->fetch_assoc()) {
                        if ($counter % 2 == 0) {
                            ?>
                            <div class="container" style=" border-radius: 4px;  border: 1px solid #ccccb3; background-color:white; padding:2%; text-align:center;" >
                                <div class="row" style="min-height: 100px;" >
                                    <form id="1" action="" method="post">
                                        <div class="col-md-4">
                                            <h3 style="font-size:20px;"><?php echo $row["teacher"] ?></h3>  
                                        </div>    
                                        <div class="col-md-4" >
                                            <h3 style="font-size: 14px;">  <?php echo $row["projectname"] ?></h3>
                                        </div>
                                        <div class="col-md-4 ">
                                            <h3 style="font-size: 14px;"> <?php echo $row["status"] ?></h3>
                                        </div>
                                        <div class="col-md-4 ">
                                            <input name="epelekse" type="submit" class="button button4" style="align-content:center; border-color:#ffa31a;color:black; background-color:#ffa31a; font-color:black;" value="Επέλεξε">
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $row["projectID"] ?>">
                                        <input type="hidden" name="teacher" value="<?php echo $row["teacher"] ?>">
                                        <input type="hidden" name="pro_name" value="<?php echo $row["projectname"] ?>">
                                        <input type="hidden" name="summ" value="<?php echo $row["summary"] ?>">
                                    </form>
                                </div>
                            </div>
                            <br>
                            <?php
                        } else {
                            ?>
                            <div class="container" style="  border-radius: 4px; border: 1px solid #ccccb3; background-color:#eaeae1; padding:2%; text-align:center;" >
                                <div class="row" style="min-height: 100px; " >

                                    <form id="2" action="" method="post">
                                        <div class="col-md-4">
                                            <h3 style="font-size:20px;"><?php echo $row["teacher"] ?></h3>  
                                        </div>    
                                        <div class="col-md-4" >
                                            <h3 style="font-size: 14px;">  <?php echo $row["projectname"] ?></h3>
                                        </div>
                                        <div class="col-md-4 ">
                                            <h3 style="font-size: 14px;"> <?php echo $row["status"] ?></h3>
                                        </div>
                                        <div class="col-md-4 ">
                                            <input name="epelekse" type="submit" class="button button4" style="align-content:center; border-color:#ffa31a;color:black; background-color:#ffa31a; font-color:black;" value="Επέλεξε">
                                        </div>

                                        <input type="hidden" name="id" value="<?php echo $row["projectID"] ?>">
                                        <input type="hidden" name="teacher" value="<?php echo $row["teacher"] ?>">
                                        <input type="hidden" name="pro_name" value="<?php echo $row["projectname"] ?>">
                                        <input type="hidden" name="summ" value="<?php echo $row["summary"] ?>">
                                    </form>
                                </div>
                            </div>  
                            <br>

                            <?php
                        }
                        $counter++;
                    }
                } else {
                    ?>
                    <h3 style="color:red;">Δεν βρέθηκαν αποτελέσματα.</h3>
                    <?php
                }
                $conn->close();
                ?>


            </div>
        </div>
    </body>
</html>