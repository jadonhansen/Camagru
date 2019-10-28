<html>
    <head>
        <link rel="stylesheet" href="../css/dropdown.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/body.css">
        <link rel="stylesheet" href="../css/head.css">
    </head>
    <!-- background is the body id -->
    <body id=bground>
    
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
        <a href="#home">Profile</a>
        <a href="#about">Gallery</a>
        <a href="#contact">Feed</a>
        <a href="#contact">Gallery</a>
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
    <div class="create">
      <a id="link" href="../reference(bootstrap)/create.html">create account</a>
    </div>
    <!-- <div class="line"></div> -->
    <div class="create">
      <a id="link" href="../reference(bootstrap)/create.html">Login</a>
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
        <div class="foot"></div>
    </body>
</html>