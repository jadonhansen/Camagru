<html>
  <head>
    <title>ICON | Password Reset</title>
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/block.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/head.css">
  </head>
    <!-- background is the body id -->
    <body class="bgforgot">
    
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

<!-- this is the form box -->

<div class="box">
        <!-- the form -->
        <div class="header">
            Please enter your email address below. An email will be sent to your inbox with a password reset link.
        </div>
        <div class="info">
            <form action="../php/email_prompt.php" method="post">
                <input type="email" name="email" id="field" placeholder="Email" required>
                <input type="submit" name="submit" value="Send email" id="submit" required>
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