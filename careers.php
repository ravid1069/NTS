<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST["name"];
    $phone = $_POST['phone'];
    $email = $_POST["email"];
    $applyfor = $_POST["status"];
    $experience = $_POST["experience"];
    $otherdetails = $_POST["details"];

      // Connecting to the Database
      $servername = "localhost";
      $username = "root";
      $password = "";
      $database = "nts";

      // Create a connection
      $conn = mysqli_connect($servername, $username, $password, $database);
      // Die if connection was not successful
      if (!$conn){
          die("Sorry we failed to connect: ". mysqli_connect_error());
      }

      $targetDir="uploads/";

      if(isset($_FILES['file']) && $_FILES['file']['error'] == 0)
      { 
        // Submit these to a database
        // Sql query to be executed 
        $fileName = basename($_FILES["file"]["name"]);
    $targetPath = $targetDir.$fileName;


    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetPath)) 
    {


        $sql = "INSERT INTO `career` (`name`, `phone`, `email`, `status`, `experience`, `details`, filename, filepath) 
        VALUES ('$name', '$phone', '$email', '$applyfor', '$experience', '$otherdetails', '$fileName', '$targetPath');";
        $result = mysqli_query($conn, $sql);
 
        if($result){
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> Your entry has been submitted successfully!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }
        else{
            // echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> We are facing some technical issue and your entry ws not submitted successfully! We regret the inconvinience caused!
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>';
        }
      }
    }} 
?>