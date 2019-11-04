<html>
  <head>
    <title>ICON | Login</title>
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
    <?php
      session_start();
      if(isset($_SESSION['username']))
      {
        echo "<form method='post' action='../php/logout.php' >";
        echo"<button type='submit' id='logout' >Logout</button>";
        echo "</form>";
      }
      else
      { 
        echo("
        <div class='create'>
          <h1><a id='link' href='create.php'>create account</a></h1>
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
                    Login
                </div>
                <div class="info">
                    <form action="../php/login.php" method="POST">
                        <input type="text" name="username" class="field" placeholder="Username" required>
                        <input type="password" name="password" class="field" placeholder="Password" required>
                        <input type="submit" name="submit" value="Create" class="form">
                    </form>
                </div>
                
                <!-- <hr class="the-line">   -->

                <!-- free browsing button -->
                <button class="free" onclick="window.location.href = 'feed.php';">
                    Guest Browse
                </button>
            </div>

 <!-- the foot -->
        <div class="foot"></div>
    </body>
</html>