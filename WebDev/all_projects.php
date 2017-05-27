<?php session_start(); ?>
<html lang="en">
    <head>
        <!-- Basic Page Needs
        ================================================== -->
        <meta charset="utf-8">
        <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>WebDev - Projects</title>
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
    $valid = 0;
    $choice = 0;
    if (!empty($_POST["epelekse"]) && $_SESSION["type"] == "student") {
        echo $_POST["student2"];
        /*$servername = "localhost";
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
        $add_students = test_input($_POST[""]);
        $conn = new mysqli($servername, $username, '', $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $user = $_SESSION["username"];



        $sql1 = "SELECT COUNT(*) as count FROM applications WHERE studentID='$user' AND projectID='$id'";
        $result1 = $conn->query($sql1);


        while ($row1 = $result1->fetch_assoc()) {
            if ($row1["count"] == 1) {
                $valid = 1;
            }
        }

        if ($valid == 0) {
            $sql = "INSERT INTO applications(projectID, studentID, status) VALUES ('$id','$user','applied')";
            if (mysqli_query($conn, $sql)) {
                //header('Location: /webdev/WebDev/students_menu.php');
                $message = "Η αίτηση σου καταχωρήθηκε.";
                echo "<script type='text/javascript'>alert('$message'); window.location.href = '/webdev/WebDev/students_menu.php';</script>";
            }
            $sql = "UPDATE projects SET status='applied' WHERE projectID='$id'";
            mysqli_query($conn, $sql);
        }
        mysqli_close($conn);*/
    }

    ?>
    <body>
        <div class="container">
            <br></br>
            <?php
            /* if (!empty($_POST["search"])) {

              } */

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
                $choice = 1;
            } else if (!empty($_POST["showall"])) {
                $sql = "SELECT * FROM projects WHERE status='applied' OR projects.status='not applied'";
                $result = $conn->query($sql);
                $choice = 1;
            } else if (!empty($_POST["showapplications"])) {
                $user = $_SESSION["username"];
                $sql = "SELECT teacher,projectname,applications.status as status FROM applications,projects WHERE projects.projectID=applications.projectID AND studentID='$user'";
                $result = $conn->query($sql);
                $choice = 2;
            } else {
                
            }
            ?>

            <div id="tf-service" style="zoom:90%;" >


                <div class="hidden-xs container" style=" padding:1%; text-align:center;" >

                    <?php if ($choice == 1) { ?>
                        <h3 style="color:black; font-weight:bold; font-size:40px; "> Όλες οι διπλωματικές.</h3>
                    <?php } else if ($choice == 2) { ?>    
                        <h3 style="color:black; font-weight:bold; font-size:40px; ">Όλες οι αιτήσεις μου.</h3>
                        <?php
                    }
                    if ($valid == 0) {
                        ?>    
                        <div class="col-md-4" >
                            <h3 style="font-size:18px; font:bold;">Teacher</h3>
                        </div>

                        <div class="col-md-4 "   >
                            <h3 style="font-size:18px; font:bold;">Project Name</h3>
                        </div>

                        <div class="col-md-4 " >
                        <?php } if ($choice == 1) { ?>
                            <h3 style="font-size:18px; font:bold;">Add Students</h3>
                        <?php } else if ($choice == 2) { ?>
                            <h3 style="font-size:18px; font:bold;">Status</h3>
                        <?php } ?>
                    </div>

                    <div class="col-md-4"   >

                    </div>
                </div>

                <?php
                $counter = 0;
                if ($valid == 0) {
                    if ($result->num_rows > 0 && $choice == 1) {
                        // output data of   each row
                        while ($row = $result->fetch_assoc()) {
                            if ($counter % 2 == 0) {
                                ?>

                                <div class="container" style=" border-radius: 4px;  border: 1px solid #ccccb3; background-color:white; padding:2%; text-align:center;" >
                                    <div class="row" style="min-height: 100px;" >
                                        
                                        <form id="users" action="" method="post">
                                            <div class="col-md-4">
                                                <h3 style="font-size:20px;"><?php echo $row["teacher"] ?></h3>  
                                            </div>    
                                            <div class="col-md-4" >
                                                <h3 style="font-size: 14px;">  <?php echo $row["projectname"] ?></h3>
                                                <h3 style="font-size: 14px;"> <?php echo $row["summary"] ?></h3>
                                            </div>

                                            <div class="col-md-4 ">
                                                <div class="dropdmenu" class="nav navbar-left" style="font-size:17px; font-weight:bold; color: #C5C5C5; " >
                                                    <select form="users" autocomplete="off" name="add_students" class="dropdm">  
                                                        <?php
                                                        $servername = "localhost";
                                                        $username = "root";
                                                        $dbname = "webdev";
                                                        $conn = new mysqli($servername, $username, '', $dbname);
                                                        if ($conn->connect_error) {
                                                            die("Connection failed: " . $conn->connect_error);
                                                        }


                                                        $sql1 = "SELECT * FROM users WHERE type='student' OR type='empty'";
                                                        $result1 = $conn->query($sql1);

                                                        if ($result1->num_rows > 0) {
                                                            // output data of   each row
                                                            while ($row1 = $result1->fetch_assoc()) {
                                                                if ($user != $row1["username"]) {
                                                                    ?>
                                                                    <option value="<?php echo $row1["username"]; ?>"><?php echo $row1["username"]; ?></option>                
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                
                                            </div>

                                            <div class="col-md-4 ">
                                                <input name="epelekse" type="submit" class="button button4" style="align-content:center; border-color:#ffa31a;color:black; background-color:#ffa31a; font-color:black;" value="Επέλεξε">
                                            </div>


                                            <input type="hidden" name="id" value="<?php echo $row["projectID"] ?>">
                                            <input type="hidden" name="teacher" value="<?php echo $row["teacher"] ?>">
                                            <input type="hidden" name="pro_name" value="<?php echo $row["projectname"] ?>">
                                            <input type="hidden" name="summ" value="<?php echo $row["summary"] ?>">
                                            <input type="hidden" name="student2" value="<?php echo $row1["username"] ?>">
                                        </form>
                                    </div>
                                </div>
                                <br>
                                <?php
                            } else {
                                ?>
                                <div class="container" style="  border-radius: 4px; border: 1px solid #ccccb3; background-color:#eaeae1; padding:2%; text-align:center;" >
                                    <div class="row" style="min-height: 100px; " >

                                        <form id="users1" action="" method="post">
                                            <div class="col-md-4">
                                                <h3 style="font-size:20px;"><?php echo $row["teacher"] ?></h3>  
                                            </div>    
                                            <div class="col-md-4" >
                                                <h3 style="font-size: 14px;">  <?php echo $row["projectname"] ?></h3>
                                                <h3 style="font-size: 14px;"> <?php echo $row["summary"] ?></h3>
                                            </div>

                                            <div class="col-md-4 ">
                                                <div class="dropdmenu" class="nav navbar-left" style="font-size:17px; font-weight:bold; color: #C5C5C5; " >
                                                    <select form="users1" autocomplete="off" name="add_students" class="dropdm">  
                                                        <?php
                                                        $servername = "localhost";
                                                        $username = "root";
                                                        $dbname = "webdev";
                                                        $conn = new mysqli($servername, $username, '', $dbname);
                                                        if ($conn->connect_error) {
                                                            die("Connection failed: " . $conn->connect_error);
                                                        }


                                                        $sql1 = "SELECT * FROM users WHERE type='student' OR type='empty'";
                                                        $result1 = $conn->query($sql1);

                                                        if ($result1->num_rows > 0) {
                                                            // output data of   each row
                                                            while ($row1 = $result1->fetch_assoc()) {
                                                                if ($user != $row1["username"]) {
                                                                    ?>
                                                                    <option value="<?php echo $row1["username"]; ?>"><?php echo $row1["username"]; ?></option>                
                                                                    <?php
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
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
                    } else if ($result->num_rows > 0 && $choice == 2) {
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
                } else if ($valid == 1) {
                    ?>
                    <h3 style="color:red;">Έχεις ξανακάνει αίτηση.</h3>
                    <?php
                }

                $conn->close();
                ?>


            </div>
        </div>
        <div class="container">
            <div class="col-md-12" style="padding:3%">

                <form id="pp" action="students_menu.php" method="post">
                    <input name="log" type="submit" class="button5" style="align-content:center; border-color:#ffa31a;color:black; background-color:orange;" value="Back Menu">
                </form>


            </div>
        </div>
    </body>
</html>