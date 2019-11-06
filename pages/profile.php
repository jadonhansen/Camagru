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
        if(isset($_SESSION['username']))
        {
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
        else
        {
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
        if(isset($_SESSION['username']))
        {
          echo("<a id='logout' href='../php/logout.php'>Logout</a>"); 
        }
        else
        { 
          echo("<div class='create'>
                  <a id='link' href='create.php'>create account</a>
                </div>
                <div class='create'>
                  <a id='link' href='login.php'>Login</a>
                </div>");
        }
      ?>
    </div>

    <!-- drop scriptsssss -->
    <script>
      function myFunction()
      {
        document.getElementById("myDropdown").classList.toggle("show");
      }
  
      window.onclick = function(event)
      {
        if (!event.target.matches('.dropbtn'))
        {
          var dropdowns = document.getElementsByClassName("dropdown-content");
          var i;
          for (i = 0; i < dropdowns.length; i++)
          {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show'))
            {
              openDropdown.classList.remove('show');
            }
          }
        }
      }
    </script>

    <script>
      function drop4()
      {
        document.getElementById("dropper4").classList.toggle("show4");
      }
    </script>

    <script>
      function drop3()
      {
        document.getElementById("dropper3").classList.toggle("show3");
      }
    </script>

    <script>
      function drop2()
      {
        document.getElementById("dropper2").classList.toggle("show2");
      }
    </script>

    <script>
      function drop1()
      {
        document.getElementById("dropper1").classList.toggle("show1");
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
            echo "<div class='feed-img'>" . $display . "</div>";
          }
        ?>
        <div class="biography">
          <?php echo "<h2>@" . $info['username'] . "</h2>"; ?>
        </div>
        <br/>
        <div class="biography1">
          <?php echo "<h4>" . $info['name_user'] . " " . $info['surname'] . "</h4>"; ?>
      </div>
      <form class="change-usr-img" action="../php/profile_modify.php" method="post" enctype="multipart/form-data">
        <input type="file" name="uploadedFile" id="fileToUpload">
        <input type="submit" name="pic_mod" value="Apply">
      </form>
    </div>
      <div class="options-blocks">    
        <div class="option_block_1">
          <button onclick='drop1()' class='dropsies' id="butsize"> modify username</button>    
          <div id='dropper1' class='box_1'>
            <form action="../php/profile_modify.php" method="post" class="position-box">
              <input class="box-location1" type="text" name="new_usr" placeholder="New username">
              <input class="box-location2" type="text" name="rep_usr" placeholder="Repeat username">
              <input class="box-location3" type="submit" name="usrnam_mod" value="Modify username">
            </form>
          </div>
        </div>

        <div class="option_block_2">
          <button onclick='drop2()' class='dropsies' id="butsize"> modify password</button>
          <div id='dropper2' class='box_2'>
            <form action="../php/profile_modify.php" method="post" class="position-box">
              <input class="box-location1" type="password" name="new_pass" placeholder="New password">
              <input class="box-location2" type="password" name="rep_pass" placeholder="Repeat password">
              <input class="box-location3" type="submit" name="pass_mod" value="Modify password">
            </form>
          </div>
        </div>

        <div class="option_block_3">
          <button onclick='drop3()' class='dropsies' id="butsize"> modify personal details</button>
          <div id='dropper3' class='box_3'>
            <form action="../php/profile_modify.php" method="post" class="position-box">
              <input class="box-location1" type="text" name="new_nam" placeholder="Name">
              <input class="box-location2" type="text" name="new_surnam" placeholder="Surname">
              <input class="box-location3" type="submit" name="nam_mod" value="Modify name and surname">
            </form>
          </div>
        </div>

        <div class='option_block_4'>
          <button onclick='drop4()' class='dropsies' id="butsize"> change email</button>
          <div id='dropper4' class='box_4'>
            <form action="../php/profile_modify.php" method="post" class="position-box">
              <input class="box-location1" type="email" name="new_eml" placeholder="New email">
              <input class="box-location2" type="email" name="rep_eml" placeholder="Repeat email">
              <input class="box-location3" type="submit" name="eml_mod" value="Modify email">
            </form>
          </div>
        </div>        
      </div>
    </div>
    <!-- the foot -->
    <div class="foot"></div>
  </body>
</html>