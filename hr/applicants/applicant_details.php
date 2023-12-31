<?php
    include '/Users/mac/Documents/ATS/general/db_connect.php';
    session_start();
    $hrid = $_SESSION['hrid'];

    $pid = $_SESSION['pid'];

    $userSQL = "SELECT fname FROM rep WHERE hrid = '$hrid'";
    $userResult = $conn->query($userSQL);

    while($row = $userResult->fetch_assoc()){
        $name = $row['fname'];
    }

    $aid = $_POST['aid'];
    $application= "SELECT * FROM applicant WHERE aid='$aid' AND pid='$pid' ";
    $appResults = $conn->query($application);

    $eduSQL = "SELECT * FROM education WHERE aid='$aid'";
    $eduResult = $conn->query($eduSQL);

    $expSQL = "SELECT * FROM experience WHERE aid='$aid'";
    $expResult = $conn->query($expSQL);

    $wSQL = "SELECT * FROM website WHERE aid='$aid'";
    $wResult = $conn->query($wSQL);


?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/hr/nav/css/home.css">
        <title>Athios</title>
        <link rel="stylesheet" href="/hr/position/css/position.css">

    </head>


    <body> 
        <header>
            <div class="nav_container">
                <img src="/athios_logo.jpg" alt="logo" class="logo">
                <nav style="float: left;">
                    <ul>
                        <li><a href="/hr/nav/home.php">Home</a></li>
                        <li><a href="/hr/position/position.html">Create Position</a></li>
                    </ul>
                </nav>
                <!--- nav for home, new position, user creation--->
                <div class="dropdown" style="float:right;margin-right:1%;">
                    <button class="dropbtn"><?php echo $name ?></button>
                    <div class="content" style="margin-right: 1.52%;">
                        <a href="/hr/user/new_user.php">New User</a>
                        <a href="/hr/user/user.php">Account</a>
                        <a href="/hr/login/signout.php">Sign Out</a>
                    </div>
                </div>
            </div>
        </header><br><br>  

        <div class="container"><br>
        <form action="http://localhost:3000/hr/applicants/display_applicants.php" method="post">
            <input type="hidden" id="pid" name="pid" value="<?php echo $pid ?>">
            <input type="submit" value="Return to Applicants" class="applicants">
        </form><br><br>
            <?php
                $row = $appResults->fetch_assoc();
                echo "<fieldset class='person'>";
                echo "<legend style='font-size:250%;'>".$row['fname']." ".$row['mname']." ".$row['lname']."</legend>";
                echo "<div id='applied' style='text-align:right;'>Applied: ".$row['date']." at ".$row['time']."</div><br>";                
                $resume = "/applicant/application/".$row['resume'];
                echo "<a href='".$resume."' target='_blank' rel='noopener noreferrer' class='resume'>View Resume</a><br><br>";
                echo "<div id='details' style='float:left;left:5%;position:relative;'>";
                echo "Email: ".$row['email']."<br>";
                echo "Phone Type: ". $row['ptype']."<br>Number: ".$row['pnumber'];
                echo "<br><br>LinkedIn: <a href='".$row['linkedin']."' target='_blank' rel='noopener noreferrer'>".$row['linkedin']."</a><br>";
                if($wResult->num_rows > 0){
                    while($wrow = $wResult->fetch_assoc()){
                        echo "<br>Website: <a href='".$wrow['site']."' target='_blank' rel='noopener noreferrer'>".$wrow['site']."</a>";   
                    }
                }
                echo "<br><br><b>Education:</b>";
                if($eduResult->num_rows >0){
                    while($edurow = $eduResult->fetch_assoc()){
                       echo "<p style='margin-left: 5%;'>Institution Name: ".$edurow['ename']."<br>";  
                       echo "Degree: ".$edurow['degree']."<br>"; 
                       echo "Field of Study: ".$edurow['fos']."<br>";     
                       echo "Start Year: ".$edurow['syear']."<br>"; 
                       echo "Graduation Year (expected): ".$edurow['gyear']."</p>";              
                    }
                }
                else{
                    echo "None";
                }
                echo "<br><b>Experience: </b>";
                if($expResult->num_rows >0){
                    while($exprow = $expResult->fetch_assoc()){
                       echo "<p style='margin-left: 5%;'>Company Name: ".$exprow['cname']."<br>";  
                       echo "Title: ".$exprow['title']."<br>"; 
                       echo "Start Date: ".$exprow['sdate']."<br>";     
                       echo "End Date: ".$exprow['edate']."<br>"; 
                       echo "Description: ".$exprow['description']."</p>";              
                    }
                }else{
                echo "None";
                }

                echo "</div><br>";
                echo "</fieldset>";
            ?>
        </div> 
        
    </body>
</html>