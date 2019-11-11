<html>
  <head>
  	<link rel="shortcut icon" type="image/png" href="../icon/4.ico"/>
    <title>ICON | Gallery</title>
    <link rel="stylesheet" href="../css/dropdown.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/body.css">
    <link rel="stylesheet" href="../css/head.css">
	<script src="./performance.js"></script>
  </head>

  <body class=bg>    
    <div class="head">

      <!-- the drop down button -->
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


<?php
	session_start();
	require '../php/db.php';
	$logged_on = $_SESSION['username'];
	try {
		$stmt = $conn->query("SELECT * FROM feed WHERE username= '$logged_on' ORDER BY upload_date DESC");
		$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
	catch (PDOException $exception) {
		echo $sql . "<br>" . $exception->getMessage();      
		echo "<script>alert('SQL ERROR: 1')</script>";
	}
	if (!$posts) {
	echo "<div class='no-uploads'>No posts to view here yet!</div>";
	}
	else {
		foreach ($posts as $row) {
			echo "<div class='feed-white-space'>";
			echo "<div class='feed-work-space'>";
			// echo "<div class='the-box'>";
			$encoded_image = $row['img'];
			$display = "<img onclick='displayComments({$row['image_id']})' src='data:image/*;base64,{$encoded_image}' width='100%' height='100%' >";
			session_start();
			if (isset($_SESSION['username'])) {

				// post owner
				echo "<div class='feed-usr' >@" . $row['username'] . "</div>";

				// post image
				echo "<div class='feed-img'>" . $display . "</div>";

				// like button
				echo"<div class='some-space'></div>";
				echo "<button class='feed-like' onclick='like_img({$row['image_id']})'>Like</button>";

				// post likes
				echo "<div class='feed-likes' id='like_section-{$row['image_id']}'>
						<p class='feed-likes'>{$row['likes']}</p>
					</div>";
			
				// post comment
				echo"<div class='comment-post'>";
				echo "<input type='text' id='comment_box-{$row['image_id']}' required>";
				echo "<button onclick='comment_img({$row['image_id']})'>Post</button>";
				echo"</div>";

				// view comments section: add a hint appearing by the cursor when you hover the post as well
				echo "<div id='comments_section-{$row['image_id']}'>
						<b class='feed-comment'></b>
					</div>";
				// echo "<div style='width:100%; height:3%;'>  </div>";

				// posted date
				echo "<div class='feed-date' >Posted " . $row['upload_date'] . "</div>";

				// delete button
				if ($_SESSION['username'] === $row['username']) 
				{
					echo "<div class='feed-delete'>
							<form class='feed-delete' action='../php/post_activity.php' method='post'>
								<input type='hidden' name='id' value='{$row['image_id']}'>
								<input  type='submit' name='delete' value='Delete post'>
							</form>
							</div>";
				}
				echo "<div class='feed-line' ><hr/ ></div>";

			}
			else {
				echo "<h4>@" . $row['username'] . "</h4>";
				echo $display;
				echo "<h4>Likes " . $row['likes'] . "</h4>";
				echo "<i>Posted " . $row['upload_date'] . "</i>";
				echo '<hr />';
			}
			// echo "</div>";
			echo "</div>";
			echo "</div>";
		}		  
	}
	$conn = NULL;
?>
	<div class="foot">
		<div class="jadon">@jhansen jadongavhansen@gmail.com</div> 
		<div class="me">@gstrauss gstrauss18@gmail.com</div>
		<div class="copyright">Copyright© 2019</div>
	</div>

  </body>
</html>