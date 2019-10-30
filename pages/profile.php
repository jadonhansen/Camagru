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
        <!-- <?php    echo $display; ?>  -->
      </div>
      <div class="biography">
        <!-- <?php echo "<h2>@" . $info['username'] . "</h2>"; ?>/ -->
      </div>
      <br/>
      <div class="biography1">
        <!-- <?php echo "<h4>" . $info['name_user'] . " " . $info['surname'] . "</h4>"; ?>  -->
      </div>

      <div class="option_block_1">
      <!-- <?php  echo "<i>" . $info['email'] . "</i>"; ?> -->
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