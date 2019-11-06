<html>
  <head>
    <title>ICON | Upload</title>
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

    <div class="pokemon">
      <div class="styles-box">
        <img class="filter" src="http://localhost:8080/Camagru/filters/coconut.png" height="125" width="125">
        <img class="filter" src="http://localhost:8080/Camagru/filters/island.png" height="125" width="125">
        <img class="filter" src="http://localhost:8080/Camagru/filters/sunbed.png" height="125" width="125">
        <img class="filter" src="http://localhost:8080/Camagru/filters/surf.png" height="125" width="125">
        <img class="filter" src="http://localhost:8080/Camagru/filters/wave.png" height="125" width="152">        
      </div>

      <div class="take-picture">
        <button id="snap">Take Photo</button>
      </div>

      <div>
        <button id="clear">Clear</button>
      </div>

      <div class="capture-box">
        <video id="video" width="400" height="300" autoplay></video>
      </div>

      <canvas id="canvas" width="400" height="300"></canvas>

      <!-- //check function in php referenced file -->
      <div class="post-img">
        <form method="post" action="../php/upload.php">
            <input type="hidden" name="image_data" id="image_data">
            <button type="submit" name="submit" id="uploadphoto">Submit Photo</button>
          </form>
      </div>

      <form action="../php/upload.php" method="post" enctype="multipart/form-data">
        Upload from device:
        <input type="file" name="uploadedFile" id="fileToUpload" accept="image/*">
        <input type="submit" name="uploadBtn" value="Upload Image">
      </form>

      <div class="notified">
        you've just been notified
      </div>
    </div>

    <script src="./edit.js"></script>
    <script src="./webcam.js"></script>

    <div class="foot"></div>
  </body>
</html>