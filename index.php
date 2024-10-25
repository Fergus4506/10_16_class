<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
?><!DOCTYPE html>
<html>
  <head>
  <title>自我介紹</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
    <div class="container">

  	<div class="row">
  		<div class="col-md-12">

      <?php include('menu.php'); ?>
      <div class="jumbotron">
      <p>
      <?php include("get-index-meta-data.php"); ?>

      <hr />

      <?php include('get-cpu-load.php'); ?>
			</p>
      <p>
      </p>
    </div>
    </div>
    </div>
    </div>
    <div class="container">
        <header>
            <h1>我的自我介紹</h1>
        </header>

        <section class="introduction">
            <img src="myPh.jpg" alt="我的照片" class="profile-photo">
            <p>大家好，我是楊敦傑，一名充滿熱情的資工系學生。我很愛打電動和打牌，尤其是打牌，WS、PTCG、YGO、UA等等我都有。

                我喜愛挑戰自我，並樂於學習新事物，這讓我在工作中不斷進步，並且能夠靈活應對各種問題。

                我也喜歡與人交流，分享我的想法和經驗，並從他人的故事中學習更多。
                
                希望透過這個網站，讓你們更了解我，也期待有機會與你們進行更多的交流與合作！</p>
        </section>

        <section class="media">
            <div class="video-section">
                <h2>介紹影片</h2>
                <video controls>
                    <source src="myVideo.mp4" type="video/mp4">
                    您的瀏覽器不支援影片播放。
                </video>
            </div>

            <div class="audio-section">
                <h2>聲音介紹</h2>
                <audio controls>
                    <source src="myVoice.mp3" type="audio/mpeg">
                    您的瀏覽器不支援音頻播放。
                </audio>
            </div>
        </section>

        <footer>
            <p>&copy; 2024 楊敦傑. All rights reserved.</p>
            <div class="contact-info">
                <h2>聯絡方式</h2>
                <ul>
                    <li>Email: fergus45065211@gmail.com</li>
                    <li>電話: 0921821136</li>
                </ul>
            </div>
        </footer>
    </div>
    <script src="script.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>

  </body>
</html>
<?php include "../inc/dbinfo.inc"; ?>
<html>
<body>
<h1>Sample page</h1>
<?php

  /* Connect to MySQL and select the database. */
  $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

  if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

  $database = mysqli_select_db($connection, DB_DATABASE);

  /* Ensure that the EMPLOYEES table exists. */
  VerifyEmployeesTable($connection, DB_DATABASE);

  /* Handle form actions */
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['ACTION'];
    $employee_id = htmlentities($_POST['ID']);
    $employee_name = htmlentities($_POST['NAME']);
    $employee_address = htmlentities($_POST['ADDRESS']);

    switch($action) {
      case 'add':
        if (strlen($employee_name) || strlen($employee_address)) {
          AddEmployee($connection, $employee_name, $employee_address);
        }
        break;
      case 'edit':
        if (strlen($employee_id) && (strlen($employee_name) || strlen($employee_address))) {
          EditEmployee($connection, $employee_id, $employee_name, $employee_address);
        }
        break;
      case 'delete':
        if (strlen($employee_id)) {
          DeleteEmployee($connection, $employee_id);
        }
        break;
    }
  }
?>

<!-- Input form -->
<form action="<?PHP echo $_SERVER['SCRIPT_NAME'] ?>" method="POST">
  <input type="hidden" name="ACTION" value="add" />
  <table border="0">
    <tr>
      <td>NAME</td>
      <td>ADDRESS</td>
    </tr>
    <tr>
      <td>
        <input type="text" name="NAME" maxlength="45" size="30" />
      </td>
      <td>
        <input type="text" name="ADDRESS" maxlength="90" size="60" />
      </td>
      <td>
        <input type="submit" value="Add Data" />
      </td>
    </tr>
  </table>
</form>

<!-- Display and edit table data. -->
<table border="1" cellpadding="2" cellspacing="2">
  <tr>
    <td>ID</td>
    <td>NAME</td>
    <td>ADDRESS</td>
    <td>ACTION</td>
  </tr>

<?php

$result = mysqli_query($connection, "SELECT * FROM EMPLOYEES");

while($query_data = mysqli_fetch_row($result)) {
  echo "<tr>";
  echo "<td>", $query_data[0], "</td>";
  echo "<td>", $query_data[1], "</td>";
  echo "<td>", $query_data[2], "</td>";
  echo "<td>
        <form action=\"{$_SERVER['SCRIPT_NAME']}\" method=\"POST\" style=\"display:inline;\">
          <input type=\"hidden\" name=\"ID\" value=\"{$query_data[0]}\" />
          <input type=\"submit\" name=\"ACTION\" value=\"edit\" />
          <input type=\"text\" name=\"NAME\" placeholder=\"New Name\" />
          <input type=\"text\" name=\"ADDRESS\" placeholder=\"New Address\" />
        </form>
        <form action=\"{$_SERVER['SCRIPT_NAME']}\" method=\"POST\" style=\"display:inline;\">
          <input type=\"hidden\" name=\"ID\" value=\"{$query_data[0]}\" />
          <input type=\"submit\" name=\"ACTION\" value=\"delete\" />
        </form>
        </td>";
  echo "</tr>";
}

mysqli_free_result($result);
mysqli_close($connection);
?>

</table>

</body>
</html>


<?php

/* Add an employee to the table. */
function AddEmployee($connection, $name, $address) {
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $address);

   $query = "INSERT INTO EMPLOYEES (NAME, ADDRESS) VALUES ('$n', '$a');";

   if(!mysqli_query($connection, $query)) echo("<p>Error adding employee data.</p>");
}

/* Edit an employee in the table. */
function EditEmployee($connection, $id, $name, $address) {
   $i = mysqli_real_escape_string($connection, $id);
   $n = mysqli_real_escape_string($connection, $name);
   $a = mysqli_real_escape_string($connection, $address);

   $query = "UPDATE EMPLOYEES SET NAME='$n', ADDRESS='$a' WHERE ID=$i;";

   if(!mysqli_query($connection, $query)) echo("<p>Error editing employee data.</p>");
}

/* Delete an employee from the table. */
function DeleteEmployee($connection, $id) {
   $i = mysqli_real_escape_string($connection, $id);

   $query = "DELETE FROM EMPLOYEES WHERE ID=$i;";

   if(!mysqli_query($connection, $query)) echo("<p>Error deleting employee data.</p>");
}

/* Check whether the table exists and, if not, create it. */
function VerifyEmployeesTable($connection, $dbName) {
  if(!TableExists("EMPLOYEES", $connection, $dbName))
  {
     $query = "CREATE TABLE EMPLOYEES (
         ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
         NAME VARCHAR(45),
         ADDRESS VARCHAR(90)
       )";

     if(!mysqli_query($connection, $query)) echo("<p>Error creating table.</p>");
  }
}

/* Check for the existence of a table. */
function TableExists($tableName, $connection, $dbName) {
  $t = mysqli_real_escape_string($connection, $tableName);
  $d = mysqli_real_escape_string($connection, $dbName);

  $checktable = mysqli_query($connection,
      "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$t' AND TABLE_SCHEMA = '$d'");

  if(mysqli_num_rows($checktable) > 0) return true;

  return false;
}
?>