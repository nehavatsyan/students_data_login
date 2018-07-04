<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/loggedin.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Guru Nanak Dev University</title>
    <link rel="icon" href="img/logo.png" type="image/x-icon"/>
</head>
<body>
    <!--navbar-->
    <nav class = "navbar navbar-inverse " style = "width: 100%;">
            <div class = "container" id = "headr">
                <div class = "navbar-header">
                    <button type = "button" class = "navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="background-color:yellow">
                      <span class = "icon-bar" style = "background-color:black"></span>
                      <span class = "icon-bar" style = "background-color:black"></span>
                      <span class = "icon-bar" style = "background-color:black"></span>                        
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href = "#" id="nav">Home</a></li>
                        <li><a href = "#" id="nav">About Us</a></li>
                        <li><a href = "#" id="nav">Courses</a></li>  
                        <li><a href = "#" id="nav">Contact Us</a></li>                                  
                        <li><a href = "#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href = "#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>          
                    </ul>
                </div>
             </div>
    </nav>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
$name = test_input($_POST["fname"]);
$pass = test_input($_POST["pass"]);
$roll_number = test_input($_POST["rollno"]);
$sql = "SELECT * FROM student_detail WHERE roll_number='".$roll_number."' and passwod='".$pass."'";
//echo $sql;die;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
       echo "<div class='sidenav'>";
       if($row["gender"]=="female"){
        echo "<img src='../img/avtare.png' width= '100%'><br><br>";
       }else{
        echo "<img src='../img/avtarboy.jpg' width= '100%'><br><br>";
       }
       echo "<strong>NAME</strong> :   ".$row["first_name"]." ".$row["last_name"]."<br>";
       echo "<strong>ROLL NUMBER</strong> : ".$row["roll_number"]."<br>";
       echo "<strong>PHONE NUMBER</strong> :    ".$row["phone_number"]."<br>";
       echo "<strong>ADDRESS</strong> : ".$row["homeaddress"]."<br>";
       echo "<strong>PIN CODE</strong> :    ".$row["pin_code"]."<br></div>";

    }
} 
else {
    echo '<script language="javascript">alert ("please check your roll number or you are not a part of our university");window.location.href = "../Homepage.html";</script>';
}

?>
<div class="main">
    <table  class="table table-bordered table-striped table-responsive">
        <h2>Marks Details</h2>
        <th>Semester 1</th>
        <th>Semester 2</th>
        <th>Semester 3</th>
        <th>Semester 4</th>
        <th>Total</th>
        <tbody>
            <tr>
                <?php 
                    $data = "SELECT *FROM academic_details WHERE roll_number='".$roll_number."'";
                    $res = $conn->query($data);
                    if ($res->num_rows > 0) {
                        // output data of each row
                        while($ro = $res->fetch_assoc()) {
                           echo "<td>".$ro["sem_one"]."</td>";
                           echo "<td>".$ro["sem_two"]."</td>";
                           echo"<td>".$ro["sem_third"]."</td>";
                           echo "<td>".$ro["sem_four"]."</td>";
                           echo "<td>".$ro["Total"]."</td>";
                          
                    
                        }
                    } 
                ?> 
            </tr>
        </tbody>
    </table>
</div>
<div class="main">
    <table class="table table-bordered table-striped table-responsive">
          <h2>Payement Details</h2>
          <th>Semester 1</th>
          <th>Semester 2</th>
          <th>Semester 3</th>
          <th>Semester 4</th>
          <th>Total</th>
          <tbody>
             <tr>
             <?php 
                    $fee = "SELECT * FROM fee_details WHERE roll_number = '".$roll_number."'";
                    $feeresult = $conn->query($fee);
                    if ($feeresult->num_rows > 0) {
                        // output data of each row
                        while($feedata = $feeresult->fetch_assoc()) {
                           echo "<td>".$feedata["sem_one"]."</td>";
                           echo "<td>".$feedata["sem_two"]."</td>";
                           echo"<td>".$feedata["sem_third"]."</td>";
                           echo "<td>".$feedata["sem_four"]."</td>";
                           echo "<td>".$feedata["total"]."</td>"; 
                        }
                    } 
                   
                ?> 
             </tr>
          </tbody>
    </table>
</div>
<div class="main">
    <h2>Achievements</h2>
    <table class="table table-bordered table-striped table-responsive">
        <th>Achievement</th>
        <th>Position</th>
        <tbody>
           <?php 
              echo "<tr>";
              $achiev="SELECT * FROM extra_activities WHERE roll_number='".$roll_number."'";
              $achiev_result=$conn->query($achiev);
              if ($achiev_result->num_rows > 0) {
                  // output data of each row
                  while($prize=$achiev_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$prize["activity"]."</td>";
                    echo "<td>".$prize["position"]."</td>";
                    echo "</tr>";
                  }
                }
              $conn->close();   
           ?>
        </tbody>

    </table>
   </div>
</body>
</html>
