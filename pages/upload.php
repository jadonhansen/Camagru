<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="../icons/4.ico"/>
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

<div class="upload-content">

    <!-- side options panel-->
    <div class="big-one">
    <div class="upload-panel">
      <button class="take-picture" id="snap"></button>
      <div class="panel-clear">
        <button id="clear">Clear</button>
      </div>
      <div class="panel-clear">
        <button id="clearfilters">Clear filters</button>
      </div>
      <form method="post" action="../php/upload.php">
        <input type="hidden" name="image_data" id="image_data" value="">
        <button class="post-img" type="submit" name="submit" id="uploadphoto">POST</button>
      </form>
      <div class="upload-form">
        <form action="../php/upload.php" method="post" enctype="multipart/form-data">
          Upload from device:  
          <hr />
          <input class="upload-upload" type="file" name="uploadedFile" id="fileToUpload" accept="image/*">
        </form>
      </div>

      <!-- DOWNLOAD BTN -->
      <div class="upload-form">
          <hr />
          <input type="button" id="dnjs" value="Download">
      </form>
      </div>

    </div>
 
    <div class="old-images">
      <?php require '../php/upload_history.php'; ?>
    </div>

    </div>

    <!-- web cam feed -->
      <div class="upload-capture">

      <div class="capture-box">
        <video class="capture-box" id="video" autoplay></video>
       </div>

      <div class="capture-box">
        <canvas id="canvas" class="canvas-inner" width="400" height="300" autoplay></canvas>
      </div>

    </div>

      <!-- styles box -->
    <div class="styles-box">
        <img class="filter" src="http://localhost:8888/Camagru/filters/21.png" height="125" width="160">
        <img class="filter" src="http://localhost:8888/Camagru/filters/27.png" height="125" width="160">
        <img
         class="filter" src="http://localhost:8888/Camagru/filters/28.png" height="125" width="160">
		<img class="filter" src="http://localhost:8888/Camagru/filters/26.png" height="125" width="160">
		<img class="filter" src="http://localhost:8888/Camagru/filters/24.png" height="125" width="160">
      </div>
    <script src="../js/edit.js"></script>
    <script src="../js/webcam.js"></script>
    <span class="stretch"></span>
</div>

    <div class="foot">
      <div class="jadon">@jhansen jadongavhansen@gmail.com</div> 
      <div class="me">@gstrauss gstrauss18@gmail.com</div>
      <div class="copyright">Copyright© 2019</div>
    </div>
  </body>
</html>