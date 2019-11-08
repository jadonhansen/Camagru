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
        if(isset($_SESSION['username'])) {
          echo("<a id='logout' href='../php/logout.php'>Logout</a>"); 
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

      <!-- <div class="capture-box"> -->
        <video class="capture-box" id="video" autoplay></video>
      <!-- </div> -->

      <div class="capture-box">
      <canvas id="canvas" class="canvas-inner" width="400" height="300" autoplay></canvas>
      </div>

      <div class="notified">
        you've just been notified
      </div>
    </div>

    <!-- side options panel-->
    <div class="upload-panel">
      <div class="take-picture"><button id="snap">CAPTURE</button></div>
      <div class="panel-clear"><button id="clear">Clear</button></div>
      <div class="panel-clear"><button id="clearfilters">Clear filters</button></div>
        <div class="post-img">
          <form method="post" action="../php/upload.php">
            <input type="hidden" name="image_data" id="image_data" value="">
            <button type="submit" name="submit" id="uploadphoto">POST</button>
          </form>
        </div>
      <div class="upload-form">
        <form action="../php/upload.php" method="post" enctype="multipart/form-data">
          Upload from device:  
          <hr />
          <input type="file" name="uploadedFile" id="fileToUpload" accept="image/*">
        </form>
      </div>

  
      <!-- DOWNLOAD BTN - STILL TESTING -->
      <div class="upload-form">
          <hr />
          <input type="button" id="dnjs" value="Download">
      </form>
      </div>


    </div>

    <script src="./edit.js"></script>
    <script src="./webcam.js"></script>

    <div class="foot">
      <div class="jadon">@jhansen jadongavhansen@gmail.com</div> 
      <div class="me">@gstrauss gstrauss18@gmail.com</div>
      <div class="copyright">Copyright© 2019</div>
    </div>
  </body>
</html>