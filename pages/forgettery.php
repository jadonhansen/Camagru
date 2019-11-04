<!-- username email password repeat password -->
<!-- submit to forgetter.php -->

<html>
  <head>
    <title>ICON | Password Reset</title>
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/head.css">
    <link rel="stylesheet" href="../css/block.css">
  </head>
    <!-- background is the body id -->
    <body class="background">
    
    <div class="head">

      <!-- Icon -->
    
      <div class="icon">
      ICON
    </div>
    
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
                    Reset Password
                </div>
                <div class="info">
                    <form action="../php/create.php" method="POST">
                      <input type="text" name="login" class="field" placeholder="Username" required>
                      <input type="password" name="new_password" class="field" placeholder="New Password" required>
                      <input type="password" name="repeat" class="field" placeholder="Repeat Password" required>
                      <input type="submit" name="submit" value="Reset Password" class="form">
                    </form>
                </div>
                
                <!-- <hr class="the-line">   -->

                <!-- free browsing button -->
            </div>

  <!-- the foot -->
        <div class="foot"></div>
    </body>
</html>