<html>
    <head>
      <link rel="stylesheet" href="../css/dropdown.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/body.css">
        <link rel="stylesheet" href="../css/head.css">
        <link rel="stylesheet" href="../css/block.css">
    </head>
    <!-- background is the body id -->
    <body class="bglogin">
    
    <div class="head">

      <!-- Icon -->
    
      <div class="icon">
      ICON
    </div>

    <!-- forgot password -->

    <a href="pass_reset.php" class="forgot">forgot password</a>

    <!-- the differing logins and outs -->
    <?php if($_SESSION["loggedIn"] == "yes") {                    
          // logout 
      session_start();    
      session_destroy();
      } else { ?>
      <!-- login -->
    <div class="create">
      <a id="link" href="./create.php">create account</a>
    </div>
    <!-- <div class="line"></div> -->
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
            Login
        </div>
        <div class="info">
            <form action="" method="post">
                <input type="text" name="Name" id="field" placeholder="Username">
                <input type="text" name="Email" id="field" placeholder="Password">
                <input type="submit" value="Done?" id="submit">
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