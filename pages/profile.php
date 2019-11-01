<?php

require '../php/db.php';
session_start();

try {
    $logged_on = $_SESSION['username'];
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
else {
    if ($info['user_img']) {
        $encoded_image = base64_encode($info['user_img']);
        $display = "<img src='data:image/jpeg;base64,{$encoded_image}' width='25%' height='25%'>";        
    }
    else {
        $display = "<img src='../images/user_img.png'>";
    }

    // echo $display;
    // echo "<h2>@" . $info['username'] . "</h2>";
    // echo "<h4>" . $info['name_user'] . " " . $info['surname'] . "</h4>";
    // echo "<i>" . $info['email'] . "</i>";
}

$conn = NULL;
?>



<html>
    <head>
    <link rel="stylesheet" href="../css/dropdown.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/body.css">
        <link rel="stylesheet" href="../css/head.css">
    </head>
    <!-- background is the body id -->
    <body id=bground>

    <!-- php script -->





    <div class="head">

<!-- the drop down button -->
    
<?php
          session_start();
          if(isset($_SESSION['username']))
          echo("
    <div class='dropdown'>
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
    </div> 
    "); 
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
        echo("
        <div class='create'>
          <a id='link' href='create.php'>create account</a>
        </div>
        <div class='create'>
          <a id='link' href='login.php'>Login</a>
        </div>
        ");
      }
    ?>
    </div>



    <!-- drop script -->
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


<!-- user details -->
    <div class="details">
      <div class="profile_pic">
        <?php    echo "<img src='../images/user_img.png'>"; ?>  
      </div>
      <div class="biography">
        <?php echo "<h2>@" . $info['username'] . "</h2>"; ?>
      </div>
      <br/>
      <div class="biography1">
        <?php echo "<h4>" . $info['name_user'] . " " . $info['surname'] . "</h4>"; ?>
      </div>
      <div class="option_block_1">
      <?php  echo "<i>" . $info['email'] . "</i>"; ?>
      </div>
      <div class="option_block_2">
      option block2
      </div>
      <div class="option_block_3">
      option block3
      </div>
    </div>

    
<!-- the foot -->

    <div class="foot"></div>
    </body>
</html>



THE FORMS FOR MODIFYING ALL DETAILS. A BUTTON FOR EACH MUST THEN DISPLAY THE RESPECTIVE FORM BELOW IT. DON'T EDIT.

  <!-- <form action="../php/profile_modify.php" method="post">
    <input type="text" name="new_usr" placeholder="New username">
    <input type="text" name="rep_usr" placeholder="Repeat username">
    <input type="submit" name="usrnam_mod" value="Modify username">
  </form>

  <form action="../php/profile_modify.php" method="post">
    <input type="password" name="new_pass" placeholder="New password">
    <input type="password" name="rep_pass" placeholder="Repeat password">
    <input type="submit" name="pass_mod" value="Modify password">
  </form>

  <form action="../php/profile_modify.php" method="post">
    <input type="text" name="new_nam" placeholder="Name">
    <input type="text" name="new_surnam" placeholder="Surname">
    <input type="submit" name="nam_mod" value="Modify name and surname">
  </form>

  <form action="../php/profile_modify.php" method="post">
    <input type="email" name="new_eml" placeholder="New email">
    <input type="email" name="rep_eml" placeholder="Repeat email">
    <input type="submit" name="eml_mod" value="Modify email">
  </form> -->