<html>
	<head>
		<title>ICON | Feed</title>
		<link rel="stylesheet" href="../css/dropdown.css">
		<link rel="stylesheet" href="../css/footer.css">
		<link rel="stylesheet" href="../css/body.css">
		<link rel="stylesheet" href="../css/head.css">
		<script src="./performance.js"></script>
	</head>

  <body class="bg">
    <div class="head">

<!-- the drop down button and username-->
<?php
	session_start();
	if(isset($_SESSION['username'])) {
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

		echo("<form class='search-bar' action='./user_search.php' method='post'>
				<input type='text' name='search_param' placeholder='username search'>
				<input type='submit' name='search' value='GO!'>
			</form>");
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


<!-- the feed stream coming from the DataBase -->
<?php
	require '../php/db.php';

	try {
		$stmt = $conn->query("SELECT * FROM feed ORDER BY upload_date DESC");
		$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch (PDOException $exception) {
		echo $sql . "<br>" . $exception->getMessage();      //dont need for final?
		echo "<script>alert('SQL ERROR: 1')</script>";
		exit();
	}
	if (!$posts) {
		echo "<div class='no-uploads'>No posts to view here yet!</div>";
	}
	else {
		foreach ($posts as $row) {
			echo "<div class='feed-white-space'>";
			echo "<div class='feed-work-space'>";
			echo "<div class='the-box'>";
			$encoded_image = $row['img'];
			$display = "<img onclick='displayComments({$row['image_id']})' src='data:image/*;base64,{$encoded_image}' width='80%' height='100%' >";
			session_start();
			if (isset($_SESSION['username'])) {

				// post owner
				echo "<div class='feed-usr' >@" . $row['username'] . "</div>";

				// delete button
				if ($_SESSION['username'] === $row['username']) {
				echo "<form class='feed-delete' action='../php/post_activity.php' method='post'>
				<input type='hidden' name='id' value='{$row['image_id']}'>
				<input  type='submit' name='delete' value='Delete post'>
					</form>";
				}

				// post image
				echo "<div class='feed-img'>" . $display . "</div>";

				// like button
				echo "<form class='feed-like' action='../php/post_activity.php' method='post'>
						<input type='hidden' name='id' value='{$row['image_id']}'>
						<input type='submit' name='like' value='Like'>
					</form>";

				// post likes
				echo "<div class='feed-likes'>Likes: " . $row['likes'] . "</div>";
			
				// posted date
				echo "<div class='feed-date' >Posted " . $row['upload_date'] . "</div>";

				// comments
				echo "<form action='../php/post_activity.php' method='post'>
						<input type='hidden' name='id' value='{$row['image_id']}'>
						<input style='position:relative; left:15%; width:40%; type='text' name='comment_box'>
						<input style='position:relative; left:15%;' type='submit' name='comment' value='Post Comment'>
					</form>";

				//VIEW COMMENTS maybe add a hint appearing by the cursor when you hover the post as well
				echo "<div id='comments_section-{$row['image_id']}'><b>Tap post to view comments...</b></div>";
				echo "<div style='width:100%; height:3%;'>  </div>";
			}
			else {
				echo "<h4>@" . $row['username'] . "</h4>";
				echo $display;
				echo "<h4>Likes " . $row['likes'] . "</h4>";
				echo "<i>Posted " . $row['upload_date'] . "</i>";
				echo '<hr />';
			}
			echo "<div class='feed-line' ><hr/ ></div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
	}
	$conn = NULL;
?>

	<!-- the foot -->
	<div class="foot">
		<div class="jadon">@jhansen jadongavhansen@gmail.com</div> 
		<div class="me">@gstrauss gstrauss18@gmail.com</div>
		<div class="copyright">Copyright© 2019</div>
	</div>

  </body>
</html>

<!-- ?php
      require '../php/db.php';

      try
      {
        $stmt = $conn->query("SELECT * FROM feed ORDER BY upload_date DESC");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } catch (PDOException $exception)
      {
        echo $sql . "<br>" . $exception->getMessage();      //dont need for final?
        echo "<script>alert('SQL ERROR: 1')</script>";
        exit();
      }
      if (!$posts)
      {
        echo "<h2>No posts to view here yet!</h2>";
        exit();
      }
      echo "<div class=white-border>";
      foreach ($posts as $row) {
        $encoded_image = $row['img'];
        $display = "<img src='data:image;base64,{$encoded_image}' width='85%' height='60%' >";
        session_start();
        if (isset($_SESSION['username']))
        {
          echo "<h4 style='position:relative; padding-left:15%; top:38px;'>@" . $row['username'] . "</h4>";
          echo "<i style='position:relative; float:right; right:70%; top:69%;'>Posted " . $row['upload_date'] . "</i>";
          echo "<div class='feed-img'>" . $display . "</div>";
          // echo "<h4 style='padding-left:20.5%'>Likes " . $row['likes'] . "</h4>";

          // like button
          echo "<form action='../php/post_activity.php' method='post'>
                  <input type='hidden' name='id' value='{$row['image_id']}'>
                  <input style='position:relative; top:-40px; float:right; right:80.5%;' type='submit' name='like' value='Like'>
                </form>";
        
          // comments
          echo "<form action='../php/post_activity.php' method='post'>
                  <input type='hidden' name='id' value='{$row['image_id']}'>
                  <input style='position:relative; left:15%; width:40%; type='text' name='comment_box'>
                  <input style='position:relative; left:15%;' type='submit' name='comment' value='Post Comment'>
                </form>";

          
          if ($_SESSION['username'] === $row['username']) {
            echo "<form action='../php/post_activity.php' method='post'>
            <input type='hidden' name='id' value='{$row['image_id']}'>
            <input style='position:relative; left:15%;' type='submit' name='delete' value='Delete post'>
              </form>";
          }

          echo "<div style='width:100%; height:3%;'>  </div>";
          echo "<hr />";
        }
        else
        {
          echo "<h4>@" . $row['username'] . "</h4>";
          echo $display;
          echo "<h4>Likes " . $row['likes'] . "</h4>";
          echo "<i>Posted " . $row['upload_date'] . "</i>";
          echo '<hr />';
        }
      }
      echo "</div>";
      $conn = NULL;
    ?> -->