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
      <div class="capture-box">
        words
      </div>
      <form class="upload-box" action="../php/upload.php" method="post" enctype="multipart/form-data">
        Upload from device:
        <input class="upload-file" type="file" name="uploadedFile" id="fileToUpload">
        <input class="upload-button" type="submit" name="uploadBtn" value="Upload Image">
      </form>
      <div class="styles-box">

      </div>

      <div class="take-picture">
      </div>
    </div>

    <div class="foot"></div>
  </body>
</html>