<html>
	<head>
    <link rel="shortcut icon" type="image/png" href="../icon/4.ico"/>
		<title>ICON | Create Account</title>
		<link rel="stylesheet" href="../css/dropdown.css">
		<link rel="stylesheet" href="../css/footer.css">
		<link rel="stylesheet" href="../css/body.css">
		<link rel="stylesheet" href="../css/head.css">
		<link rel="stylesheet" href="../css/block.css">
	</head>

  <body class="bgcreate">
    <div class="head">
      <!-- Icon -->
      <div class="icon">
        ICON
      </div>
      <!-- the differing logins and outs -->
      <?php
        session_start();
        if(isset($_SESSION['username']))
          echo("<a id='logout' href='../php/logout.php'>Logout</a>"); 
        else {
          echo("<div class='create'>
                  <a id='link' href='login.php'>Login</a>
                </div>");
        }
      ?>

    </div>

    <!-- drop script -->
    <script>
      function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
      }
      window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
          var dropdowns = document.getElementsByClassName("dropdown-content");
          var i;
          for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
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
		Create Account
	</div>
	<div class="info">
		<form action="../php/create.php" method="POST">
			<input type="text" name="name" class="field" placeholder="Name" required>
			<input type="text" name="surname" class="field" placeholder="Surname" required>
			<input type="text" name="username" class="field" placeholder="Username" required>
			<input type="email" name="email" class="field" placeholder="Email" required>
			<input type="password" name="password" class="field" placeholder="Password" required>
			<input type="submit" name="submit" value="Create" class="form">
		</form>
	</div>
                
      <!-- <hr class="the-line">   -->

	<!-- free browsing button -->
	<button class="free" onclick="window.location.href = 'feed.php';">Guest Browse</button>
	</div>

	<!-- the foot -->
	<div class="foot">
		<div class="jadon">@jhansen jadongavhansen@gmail.com</div> 
		<div class="me">@gstrauss gstrauss18@gmail.com</div>
		<div class="copyright">Copyright© 2019</div>
	</div>

  </body>
</html>