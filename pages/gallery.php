<html>
  <head>
    <title>ICON | Gallery</title>
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
        else {
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
        session_start();
        if(isset($_SESSION['username']))
          echo("<a id='logout' href='../php/logout.php'>Logout</a>");
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


<?php
function paginate() {
    session_start();
    require '../php/db.php';
    $logged_on = $_SESSION['username'];
    try {
        $stmt = $conn->query("SELECT * FROM feed WHERE username= '$logged_on' ORDER BY upload_date DESC LIMIT 2");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $exception) {
        echo $sql . "<br>" . $exception->getMessage();      //dont need for final?
        echo "<script>alert('SQL ERROR: 1')</script>";
    }
    if (!$posts) {
        echo "<h2>No posts to view here yet!</h2>";
        exit();
    }
    foreach ($posts as $row) {
        $decoded_image = $row['img'];
        $display = "<img src='data:image/*;base64,{$decoded_image}' width='40%' height='40%' >";
        echo "<h4>@" . $row['username'] . "</h4>";
        echo $display;
        echo "<h4>Likes " . $row['likes'] . "</h4>";
        echo "<i>Posted " . $row['upload_date'] . "</i>";
        echo '<hr />';
    }
    $conn = NULL;    
}

paginate();
?>

<script type="text/javascript">
    window.addEventListener('scroll', function() {
        if (window.scrollY + window.innerHeight + 100 >= document.documentElement.scrollHeight) {
            <?php paginate(); ?>
        }
    })
</script>


    <div class="foot"></div>
  </body>
</html>