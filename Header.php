<?php
session_start();
error_reporting(0);
date_default_timezone_set('Asia/Shanghai');

include "get_mysql_credentials.php";
$con = mysqli_connect("localhost", $mysql_username, $mysql_password, "lrr");

// Check database connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

?>

<!DOCTYPE html>

<html>

<head>

  <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="./font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css" />

  <script src="./css/jquery.min.js" type="text/javascript"></script>
  <script src="./css/bootsrap.min.js" type="text/javascript"></script>
  <script src="./css/jquery.datetimepicker.min.js" type="text/javascript"></script>

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="padding-left:150px;padding-right:150px;margin:auto;">
    <a class="navbar-brand" href="~\..\index.php"> <img src="logo.png" style="width:30px;height:30px;"> LRR </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor02">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">

        <li class="nav-item active">
          <!-- <a class='nav-link' href='~\..\Visitors.php'>     <i class='fa fa-globe'></i>  Visitor Portal <span class='sr-only'>(current)</span></a> -->
        </li>
        <?php
        if (isset($_SESSION["user_fullname"])) {

          echo "       <a class='nav-link' href='~\..\Courses.php'><i class='fa fa-book'></i> Courses <span class='sr-only'>(current)</span></a>";
        ?>
          </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" style="color:#fff;">
        Welcome &nbsp; <b> <?php echo $_SESSION['user_fullname']; ?> </b> &nbsp;

        <?php
          $c_date =  date("Y-m-d H:i");
          if (isset($_SESSION['user_student_id']))
            echo "(" . $_SESSION['user_type'] . " - " . $_SESSION['user_student_id'] . ")   ";
          else
            echo "(" . $_SESSION['user_type'] . ")   ";
        ?>

        <?php
          if ($_SESSION['user_type'] == "Lecturer") {
            echo  "&nbsp;&nbsp;&nbsp;  <i class=\"fa fa-cog\" style=\"color:#fff;\"> </i> &nbsp;<a style='color:#fff !important' href=\"~\..\Admin.php\">Admin </a>";
          }
        ?>

        &nbsp;&nbsp;&nbsp; <i class="fa fa-user" style="color:#fff;"> </i>
        &nbsp;<a href="#" style='color:#fff !important' onclick="updatePass(<?php echo $_SESSION['user_id']; ?>)">Update password</a>
        &nbsp;&nbsp;&nbsp; <i class="fa fa-lock" style="color:#fff;"> </i> &nbsp;<a style='color:#fff !important' href="~\..\logout.php">Logout </a>

      <?php
        }
      ?>
      </form>
    </div>
  </nav>

  <style>
    .nav-item {
      border-color: #00ff66;
    }

    .nav-tabs {
      border-color: #00ff66;
    }

    .btn-default {
      border: 2px solid #00ff66;
      width: 100%;
      text-align: left;
      margin: 3px auto;
      font-weight: bold;
      font-size: 13pt;
    }

    .table-bordered {
      padding: 5px !important;
    }

    .alert {
      font-weight: bold;
    }

    h1,
    h2,
    h3,
    h4 {
      color: #03407B;
    }

    a {
      color: #03407B;
    }

    .break-word {
      word-wrap: break-word;
      white-space: -moz-pre-wrap !important;
      /* Mozilla, since 1999 */
      white-space: -pre-wrap;
      /* Opera 4-6 */
      white-space: -o-pre-wrap;
      /* Opera 7 */
      white-space: pre-wrap;
      /* css-3 */
      word-wrap: break-word;
      /* Internet Explorer 5.5+ */
      white-space: -webkit-pre-wrap;
      /* Newer versions of Chrome/Safari*/
      word-break: break-all;
      white-space: normal;
    }

    .ui-widget-content.ui-dialog {
      border: 2px solid #03488B;

    }

    .ui-dialog>.ui-widget-header {
      background: #03488B;
      color: white
    }

    .ui-button {
      background: #03488B;
      color: white
    }
  </style>

  <script>
    function updatePass(id) {

      var pass = prompt("Enter your new password : ", "Enter a strong password");

      if (!confirm('Are you sure you want to reset your password?')) {
        return;
      }

      window.location.href = "\Script.php\?action=passchange&uid=" + id + "&pass=" + pass;
    }

    function blockUser(id, status) {
      if (!confirm('Are you sure you want to change user status?')) {
        return;
      }
      window.location.href = "\Script.php\?action=statuschange&uid=" + id + "&status=" + status;
    }
  </script>