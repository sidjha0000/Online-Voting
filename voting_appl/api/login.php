<?php
session_start();
include ('connect.php');

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

$check = mysqli_query($connect, "SELECT * FROM user WHERE mobile = '$mobile' AND password = '$password' AND role = '$role'");

if(mysqli_num_rows($check) > 0) {
    $userdata = mysqli_fetch_array($check);
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
    $groupdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    
    $_SESSION['userdata'] = $userdata;
    $_SESSION['groupdata'] = $groupdata; 

    echo '<script>
    window.location = "http://localhost/voting_appl/vote/dashbord.php";
</script>';



} else {
    echo '<script>
            alert("Invalid Credentials! User not found");
            window.location = "../";
        </script>';
}

?>