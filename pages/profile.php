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


<!-- user details -->
    <div class="details">
      <div class="profile_pic">
        <img class="qazplm" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQpmLbYqzTEg3Pl5Vw_8k1O4UtUHPlIgZ4qK-8PGRNahxqauPbj&s" alt="Profile Picture">
      </div>
      <div class="biography">
      Username
      </div>
      <br/>
      <div class="biography1">
      Text
      </div>

      <div class="option_block_1">
      option block1
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