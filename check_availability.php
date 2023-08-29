<?php

include 'config.php';

if(!empty($_POST["username"])) {
    $query = "SELECT * FROM users WHERE username='" . $_POST["username"] . "'";
    $result = mysqli_query($conn,$query);
    $count = mysqli_num_rows($result);
    if($count>0) {
      echo "<span style='color:red'> Sorry User already exists in the database.</span>";
      echo "<script>$('#submit').prop('disabled',true);</script>";
    }else{
      echo "<span style='color:green'> User available for Registration .</span>";
      echo "<script>$('#submit').prop('disabled',false);</script>";
    }
  }

  if(!empty($_POST["password"])) {
    $query = "SELECT * FROM users WHERE password='" . md5($_POST['password']) . "'";
    $result = mysqli_query($conn,$query);
    $count = mysqli_num_rows($result);
    if($count>0) {
      echo "<span style='color:red'> Sorry password already exists .</span>";
      echo "<script>$('#submit').prop('disabled',true);</script>";
    }else{
      echo "<span style='color:green'> Password available for Registration .</span>";
      echo "<script>$('#submit').prop('disabled',false);</script>";
    }
  }
  ?>