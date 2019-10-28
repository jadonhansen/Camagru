<html>
    <head>
      <link rel="stylesheet" href="../css/dropdown.css">
      <link rel="stylesheet" href="../css/footer.css">
      <link rel="stylesheet" href="../css/body.css">
      <link rel="stylesheet" href="../css/head.css">
      <link rel="stylesheet" href="../css/block.css">
    </head>
    <!-- background is the body id -->
    <body class="bgcreate">
    
    <div class="head">

<!-- the drop down button -->
    
    <div class="dropdown">
      <button onclick="myFunction()" class="dropbtn">
      <div class="other_option"></div>
      <div class="options"></div>
      <div class="options"></div>
      <div class="options"></div>
    </button>
      <div id="myDropdown" class="dropdown-content">
      <a href="profile.php">Profile</a>
        <a href="gallery.php">Gallery</a>
        <a href="feed.php">Feed</a>
        <a href="upload.php">Upload</a>
      </div>
    </div>  

      <!-- Icon -->
    
      <div class="icon">
      ICON
    </div>



    <!-- the differing logins and outs -->
    <?php if($_SESSION["loggedIn"] == "yes") {                    
          // logout 
      session_start();    
      session_destroy();
      } else { ?>
      <!-- login -->
    <!-- <div class="line"></div> -->
    <div class="create">
      <a id="link" href="./login.php">Login</a>
    </div>
    <?php
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

<!-- this is the form box -->

    <div class="box">
        <!-- the form -->
        <div class="header">
            Create Account
        </div>
        <div class="info">
            <form action="../php/create.php" method="POST">
                <input type="text" name="name" id="field" placeholder="First Name" required>
                <input type="text" name="surname" id="field" placeholder="Surname" required>
                <input type="email" name="email" id="field" placeholder="Email" required>
                <input type="text" name="username" id="field" placeholder="Username" required>
                <input type="password" name="password" id="field" placeholder="Password" required>
                <input type="submit" name="submit" value="Create" id="submit">
            </form>
        </div>

        <!-- free browsing button -->
        <button class="free" onclick="window.location.href = 'feed.php';">
            Browse for Free
        </button>
    </div>

  <!-- the foot -->
        <div class="foot"></div>
    </body>
</html>