<?php
session_start();
include('connect.php');

$votes = $_POST['gvotes'];
$total_votes = $votes + 1;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

$update_votes = mysqli_query($connect, "UPDATE user SET votes='$total_votes' WHERE id='$gid' ");

$update_user_status = mysqli_query($connect, "UPDATE user SET status=1 WHERE id='$uid' ");

if ($update_votes && $update_user_status) {
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role = 2");
    $groupdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupdata'] = $groupdata;
    echo '
    <script>
        alert("voting successful!!");
        window.location = "http://localhost/voting_appl/vote/dashbord.php?gvotes=0&votebtn=Vote#";
    </script>';
} else {
    echo '
        <script>
            alert("Some error occurred!!");
            window.location = "http://localhost/voting_appl/vote/dashbord.php?gvotes=0&votebtn=Vote#";
        </script>';
}
?>
