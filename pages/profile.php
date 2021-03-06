<?php
  require '../php/db.php';
  session_start();

  if (!isset($_SESSION['username'])) {
		echo "<script>alert('Please login first before accessing this page!')</script>";
    echo "<script>window.open('./login.php','_self')</script>";
    exit();
  }

  $logged_on = $_SESSION['username'];
  try {
    $stmt = $conn->query("SELECT username, name_user, surname, email, user_img FROM users WHERE username = '$logged_on' AND verified=1");
    $info = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $exception) {
    echo $sql . "<br>" . $exception->getMessage();      //dont need for final?
    echo "<script>alert('SQL ERROR: 1')</script>";
    exit();
  }

  if (!$info) {
    echo "<h2>Oops! Your information could not be displayed :(</h2>";
  }
  $conn = NULL;
?>

<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="../icons/4.ico"/>
    <title>ICON | Profile</title>
    <link rel="stylesheet" href="../css/block.css">
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/head.css">
  </head>

  <body class="temp" id=bground>    
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

  <!-- drop script -->
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
      function drop1() {
        document.getElementById("dropper1").classList.toggle("show1");
      }
      
    </script>

    <script>
      function drop2() {
        document.getElementById("dropper2").classList.toggle("show2");
      }
    </script>

    <script>
      function drop3() {
        document.getElementById("dropper3").classList.toggle("show3");
      }
    </script>

    <script>
      function drop4() {
        document.getElementById("dropper4").classList.toggle("show4");
      }
    </script>

<script>
      function drop7() {
        document.getElementById("dropper7").classList.toggle("show7");
      }
    </script>

    <!-- user details -->
    <div class="details">
      <div class="top-stuff">      
        <?php
          if (!$info['user_img'])
            echo "<img src='../images/user_img.png' class='profile_pic'>";
          else {
            $encoded_image = $info['user_img'];
            $display = "<img src='data:image;base64,{$encoded_image}' class='profile_pic'>";
            echo "<span class='profile-pic'>" . $display . "</span>";
          }
        ?>
        <span class="profile-info">
          <div class="biography">
            <?php echo "<span>@" . $info['username'] . "</span>"; ?>
          </div>
          <div class="biography1">
            <?php echo "<h4>" . $info['name_user'] . " " . $info['surname'] . "</h4>"; ?>
          </div>
          <div class="biography1">
            <?php echo "<h6>" . $info['email'] . "</h6>"; ?>
          </div>
        </span>
        <form class="change-usr-img" action="../php/profile_modify.php" method="post" enctype="multipart/form-data">
          <input type="file" name="uploadedFile" id="fileToUpload">
          <input type="submit" name="pic_mod" value="Apply">
        </form>
      </div>
        <div class="options-blocks">
<div class="text-block">
          <div class="option_block_1">
            <button onclick='drop1()' class='dropsies' id="butsize"> Change Username</button>    
            <div id='dropper1' class='box_1'>
              <form action="../php/profile_modify.php" method="post" class="position-box">
                <div class="profile-forms">
                  <input class="profile-inputs" type="text" name="new_usr" placeholder="New username" onfocus="this.placeholder = ''" onfocusout="this.placeholder = 'New username'" required>
                  <input class="profile-inputs" type="text" name="rep_usr" placeholder="Repeat username" onfocus="this.placeholder = ''" onfocusout="this.placeholder = 'Repeat username'" required>
                  <input class="profile-submit" type="submit" name="usrnam_mod" value="Modify username">
                </div>
              </form>
        </div>
          </div>
</div>
<div class="text-block">
          <div class="option_block_2">
            <button onclick='drop2()' class='dropsies' id="butsize"> Change Password</button>
            <div id='dropper2' class='box_2'>
              <form action="../php/profile_modify.php" method="post" class="position-box">
                <div class="profile-forms" id="temp">
                  <input class="profile-inputs" type="password" name="new_pass" placeholder="New password"  onfocus="this.placeholder = ''" onfocusout="this.placeholder = 'New password'" required>
                  <input class="profile-inputs" type="password" name="rep_pass" placeholder="Repeat password"  onfocus="this.placeholder = ''" onfocusout="this.placeholder = 'Repeat password'" required>
                  <input class="profile-submit" type="submit" name="pass_mod" value="Modify password">
                </div>
              </form>
            </div>
          </div>
</div>
<div class="text-block">
          <div class="option_block_3">
            <button onclick='drop3()' class='dropsies' id="butsize"> Change Personal Details</button>
            <div id='dropper3' class='box_3'>
              <form action="../php/profile_modify.php" method="post" class="position-box">
                <div class="profile-forms">
                  <input class="profile-inputs" type="text" name="new_nam" placeholder="Name" onfocus="this.placeholder = ''" onfocusout="this.placeholder = 'Name'" required>
                  <input class="profile-inputs" type="text" name="new_surnam" placeholder="Surname" onfocus="this.placeholder = ''" onfocusout="this.placeholder = 'Surname'" required>
                  <input class="profile-submit" type="submit" name="nam_mod" value="Modify name and surname">
                </div>
              </form>
            </div>
          </div>
</div>
<div class="text-block">
          <div class='option_block_4'>
            <button onclick='drop4()' class='dropsies' id="butsize"> Change Email</button>
            <div id='dropper4' class='box_4'>
              <form action="../php/profile_modify.php" method="post" class="position-box">
                <div class="profile-forms">
                  <input class="profile-inputs" type="email" name="new_eml" placeholder="New email" onfocus="this.placeholder = ''" onfocusout="this.placeholder = 'New Email'" required>
                  <input class="profile-inputs" type="email" name="rep_eml" placeholder="Repeat email" onfocus="this.placeholder = ''" onfocusout="this.placeholder = 'Repeat Email'" required>
                  <input class="profile-submit" type="submit" name="eml_mod" value="Modify email">
                </div>
              </form>
            </div>
          </div>
</div>
<div class="text-block">
  <div class="option_block_7">
    <button onclick='drop7()' class='dropsies' id="butsize">Receive Notifications</button>
    <div id='dropper7' class='box_7'>
      <div class="position-box">
        <div class="profile-forms">
            <form action="../php/profile_modify.php" method="post">
              <input type="hidden" name="pref" value="1">
              <input type="submit" name="pref_mod" class="special-yes" class="profile-submit" class="special" value="YES">
            </form>
            <form action="../php/profile_modify.php" method="post">
              <input type="hidden" name="pref" value="0">
              <input type="submit" name="pref_mod" class="special-no" class="profile-submit" value="NO">
            </form>
        </div>
        </div>
    </div>
  </div>
</div>
          </div>
          <div class="profile-links">
          <div class="option_block_5">
            <form action="./gallery.php">
              <input type="submit" class="form-button" value="Go to Gallery" />
          </form>
        </div>


        <div class="option_block_6">
          <form action="./upload.php">
            <input type="submit" class="form-button" value="Upload Now"/>
          </form>
        </div>        
      </div>
    </div>
</div>


    <!-- the foot -->
    <div class="foot">
      <div class="jadon">@jhansen jadongavhansen@gmail.com</div> 
      <div class="me">@gstrauss gstrauss18@gmail.com</div>
      <div class="copyright">Copyright© 2019</div>
    </div>
  </body>
</html>