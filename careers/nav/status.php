<?php
    include '/Users/mac/Documents/ATS/general/db_connect.php';

    $aid = $_POST['aid'];
    $application= "SELECT * FROM applicant WHERE aid='$aid'";
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
        <title>Athios</title>
        <link rel="stylesheet" href="/careers/nav/nav.css">

    </head>


    <body> 
    <header>
            <div class="nav_container">            
                <div class="menu">
                    <img src="https://img1.wsimg.com/isteam/ip/c0c68920-e75d-4537-ba2e-968973ac6ffb/571f223e-3f59-44f4-b339-1fe51ac030d8.png" alt="logo" class="logo"> 
                    <nav style="float: left;">
                        <ul>
                            <li><a href="/careers/nav/home.php">Home</a></li>
                            <li><a href="/careers/nav/search.php">Application Status</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header><br><br><br><br><br><br>

        <div class="status">    
            <p style="position: relative; top:20%;">Status: </p>
        </div>

        <div>
            <?php
                    $row = $appResults->fetch_assoc();
                    echo "<div class='person'>";
                    echo "<legend style='font-size:250%;'>".$row['fname']." ".$row['mname']." ".$row['lname']."</legend>";
                    echo "<div id='applied' style='text-align:right; margin-top: 0;'>Applied: ".$row['date']." at ".$row['time']."</div><br>";                
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
                    echo "</div>";
                ?>
            </div>`
        </div> 
        
    </body>
    <div class="block" style="position: relative; top: 550px;">
        <footer>
            <p>Designed and Developed By: Mark Anthony Castillo</p>
            <p>Applicant Tracking System (Version: Beta)</p>
        </footer>
    </div>
</html>