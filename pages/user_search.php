<?php

session_start();
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.open('./login.php','_self')</script>";
    exit();
}
if (isset($_POST['search'])) {
    if (empty($_POST['search_param'])) {
        echo "<script>alert('Please enter a search parameter first!')</script>";
        echo "<script>window.open('./feed.php','_self')</script>";
        exit();
    }
    else {
        require '../php/db.php';
        $param = $_POST['search_param'];
        try {
            $sql = "SELECT username, name_user, surname, user_img, email FROM users WHERE username= :usrparam";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':usrparam', $param);
            if (!$stmt->execute()) {
                echo "<script>alert('SQL ERROR: 1')</script>";
                echo "<script>window.open('../pages/login.php?error=sql','_self')</script>";
                exit();
            }
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$result) {
                echo "<h2>No results for the user '$param'</h2>";       //STYLING NEEDED
                echo "<h3>Try another search..?</h3>";
                echo "<form action='./user_search.php' method='post'><input type='text' name='search_param' placeholder='username search'></input><input type='submit' name='search' value='GO!'></input></form>";
                exit();
            }
            $info = $result;
            //fetch their posts
		} catch (PDOException $exception) {
			echo $sql . "<br>" . $exception->getMessage(); //dont need for final?
			echo "<script>alert('SQL ERROR: 2')</script>";
			echo "<script>window.open('../pages/login.php','_self')</script>";
			exit();
        }
    }
    $conn = NULL;
}
else {
    echo "<script>window.open('./feed.php','_self')</script>";
}

?>

<html>
  <head>
    <title>ICON | Profile</title>
    <link rel="stylesheet" href="../css/block.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/head.css">
  </head>

  <body id=bground>    
    <div class="head">

    <!-- the drop down button -->    
    <?php
    session_start();
    if(isset($_SESSION['username'])){
        echo("<div class='dropdown'>
                <button onclick='myFunction()' class='dropbtn'>
                <div class='other_option'></div>
                <div class='options'></div>
                <div class='options'></div>
                <div class='options'></div>
                </button>
                <div id='myDropdown' class='dropdown-content'>
                <a href='profile.php'>Profile</a>
                <a href='gallery.php'>Gallery</a>
                <a href='feed.php'>Feed</a>
                <a href='upload.php'>Upload</a>
                </div>
            </div>");
        echo("<div class='loggedin-user'>@"
                .$_SESSION['username']. 
            "</div>");
    }
    else{
        echo "<script>alert('Please login first!')</script>";
        echo "<script>window.open('./login.php','_self')</script>";
    }
    ?>
    
    <!-- Icon -->    
    <div class="icon">
    ICON
    </div>

    <!-- the differing logins and outs -->
    <?php
    session_start();
    if(isset($_SESSION['username'])){
        echo("<a id='logout' href='../php/logout.php'>Logout</a>"); 
    }
    ?>
</div>

    <!-- drop scriptsssss -->
    <script>
        function myFunction(){
        document.getElementById("myDropdown").classList.toggle("show");
        }

        window.onclick = function(event){
        if (!event.target.matches('.dropbtn')){
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++){
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')){
                openDropdown.classList.remove('show');
            }
            }
        }
        }
    </script>

    <script>
        function drop4() {
        document.getElementById("dropper4").classList.toggle("show4");
        }
    </script>

    <script>
        function drop3() {
        document.getElementById("dropper3").classList.toggle("show3");
        }
    </script>

    <script>
        function drop2() {
        document.getElementById("dropper2").classList.toggle("show2");
        }
    </script>

    <script>
        function drop1() {
        document.getElementById("dropper1").classList.toggle("show1");
        }  
    </script>

    <!-- searched user details -->
    <div class="details">
      <div class="top-stuff">      
        <?php
          if (!$info['user_img'])
            echo "<img src='../images/user_img.png' class='profile_pic'>";
          else {
            $encoded_image = $info['user_img'];
            $display = "<img src='data:image;base64,{$encoded_image}' class='profile_pic'>";
            echo "<div class='profile-pic'>" . $display . "</div>";
          }
        ?>
        <div class="biography">
          <?php echo "<h2>@" . $info['username'] . "</h2>"; ?>
        </div>
        <br/>
        <div class="biography1">
          <?php echo "<h4>" . $info['name_user'] . " " . $info['surname'] . "</h4>"; ?>
      </div>
      <br/>
        <div class="biography1">
          <?php echo "<h4>" . $info['email'] . "</h4>"; ?>
      </div>


    <!-- the foot -->
    <div class="foot">
      <div class="jadon">@jhansen jadongavhansen@gmail.com</div> 
      <div class="me">@gstrauss gstrauss18@gmail.com</div>
      <div class="copyright">Copyright© 2019</div>
    </div>
  </body>
</html>