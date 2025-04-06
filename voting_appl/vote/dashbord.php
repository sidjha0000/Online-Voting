<?php
    session_start();
    if(!isset($_SESSION['userdata'])) {
        header('Location: ../');
    }
    $userdata = $_SESSION['userdata'];
    $groupdata = $_SESSION['groupdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">Not Voted</b>';
    }
    else{
        $status = '<b style="color:green">Voted</b>';
    }

?>



<html>
    <head>
        <title>Online Voting System - Dashboard</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
    </head>

    <body>

    <style>
#backbtn, #logoutbtn {
    padding: 12px 24px;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
}
#backbtn {
    background: linear-gradient(to right, #4CAF50, #2E7D32);
    color: white;
    float: left;
}
#logoutbtn {
    background: linear-gradient(to right, #f44336, #D32F2F);
    color: white;
    float: right;
}
#backbtn:hover {
    background: #388E3C;
    transform: scale(1.05);
}
#logoutbtn:hover {
    background: #C62828;
    transform: scale(1.05);
}
#Profile {
    background-color: white;
    width: 35%;
    padding: 20px;
    float: left;
    transition: 0.3s ease-in-out;
    border-radius: 15px; 
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
}
#Profile:hover {
    transform: translateY(-5px);
    box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.2);
}
#Profile img {
    display: block;
    width: 100px; 
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    margin: 10px auto; 
    padding: 5px;
    border: 3px solid rgb(38, 108, 188);
    transition: 0.3s;
}

#Profile img:hover {
    transform: scale(1.1);
    border-color:rgb(10, 84, 195);
}
#Group {
    background-color: white;
    width: 55%;
    padding: 20px;
    float: right;
    border-radius: 12px;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    transition: 0.3s ease-in-out;
}

#Group h2 {
    color: #1565C0;
    font-weight: bold;
    margin-bottom: 15px;
}

#Group ul {
    list-style-type: none;
    padding: 0;
}

#Group li {
    background: #f9f9f9;
    margin: 8px 0;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.1);
    transition: 0.3s;
}

#Group li:hover {
    background: #e3f2fd;
    transform: translateX(5px);
}
#votebtn {
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    background: linear-gradient(to right, rgb(32, 60, 205), #0D47A1);
    color: white;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: 0.3s ease-in-out;
    box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
}

#votebtn:hover {
    background: #0D47A1;
    transform: scale(1.05);
}
#mainpanel {
    padding: 15px;
    
}
#voted{
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    background: linear-gradient(to right, rgb(15, 232, 84),rgb(46, 159, 27));
    color: white;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: 0.3s ease-in-out;
}



@media screen and (max-width: 768px) {
    #backbtn, #logoutbtn {
        width: 100%;
        float: none;
        margin-bottom: 10px;
    }
    
    #Profile, #Group {
        width: 100%;
        float: none;
        margin-bottom: 20px;
        padding: 15px;
        box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
    }
    
    #Profile img {
        width: 80px;
        height: 80px;
        margin-bottom: 10px;
    }
    
    #Group h2 {
        font-size: 20px;
        text-align: center;
    }
    
    #Group li {
        padding: 8px;
        font-size: 14px;
        text-align: center;
    }
    
    #votebtn, #voted {
        width: 100%;
        font-size: 18px;
    }
}
    </style>
    <div id = "mainSection">
        <center>
        <div id="headerSection">
        <a href="../">
            <button id="backbtn">Back</button>
        </a>
        <a href="logout.php"><button id = "logoutbtn">  Logout</button></a>
                <h1>Online Voting System</h1>
        </div>
        </center>
        <hr>

        <div id="mainpanel">
        <div id = "Profile">
            <center><img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"></center><br><br>
            <b>Name:</b> <?php echo $userdata['name'] ?><br><br>
            <b>Mobile:</b><?php echo $userdata['mobile'] ?><br><br>
            <b>Address:</b><?php echo $userdata['address'] ?><br><br>
            <b>Status:</b><?php echo $status?><br><br>
        </div>
        <div id = Group>
            <?php
            if($_SESSION['groupdata']){
                for($i=0; $i<count($groupdata);$i++){
                    ?>
                    <div>
                        <img style="float:right" src="../uploads/<?php echo $groupdata[$i]['photo'] ?>" height="100" width="100"><br><br>
                        <b>Group Name :</b><?php echo $groupdata[$i]['name'] ?><br><br>
                        <b>Votes :</b><?php echo $groupdata[$i]['votes'] ?><br><br>
                        <form action="../api/vote.php" method="POST">
                            <input type="hidden" name="gvotes" value="<?php echo $groupdata[$i]['votes']?>">
                            <input type="hidden" name="gid" value="<?php echo $groupdata[$i]['id']?>">
                            <?php
                                if($_SESSION['userdata']['status']==0){
                                    ?>
                                    <input type="submit" name="votebtn" value="Vote" id="votebtn">
                                    <?php
                                }
                                else{
                                    ?>      
                                    <button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>                              <?php
                                }
                            ?>
                        </form>
                    </div>
                    <hr>
                    <?php
                }
            }
            else{

            }
            ?>
        </div>
        </div>
        
    </div>
        
        
        

    </body>
</html>