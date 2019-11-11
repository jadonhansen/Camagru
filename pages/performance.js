function displayComments(img_id) {
	if (window.XMLHttpRequest) {
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp = new XMLHttpRequest();
	} else {
		// code for IE6, IE5
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById(`comments_section-${img_id}`).innerHTML = this.responseText;
		}
	};
	xmlhttp.open("POST", "../php/post_activity.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("details="+img_id);
}

function comment_img(img_id) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText === "False") {
				//false return notif
				document.getElementById("notification").value = "Could not post comment!"
				document.getElementById("notification").classList.toggle("show");	
				setTimeout(function(){
					document.getElementById("notification").classList.toggle("show");
				 }, 3000);
			}
			else if (this.responseText === "False1") {
				//false return notif
				document.getElementById("notification").innerHTML = "Please type in a valid comment less than 200 characters."
				document.getElementById("notification").classList.toggle("show");
				setTimeout(function(){
					document.getElementById("notification").classList.toggle("show");
				}, 3000);
			}
			else {
				//true return notif
				document.getElementById(`comment_box-${img_id}`).value = "";
				document.getElementById("notification").innerHTML = "Comment Posted!"
				document.getElementById("notification").classList.toggle("show");
				setTimeout(function(){
					document.getElementById("notification").classList.toggle("show");
				}, 3000);
			}
		}
	};
	xmlhttp.open("POST", "../php/post_activity.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	let comm = document.getElementById(`comment_box-${img_id}`).value;
	xmlhttp.send("comment=submit&comment_box=" + comm + "&id=" + img_id);
}

function like_img(img_id) {
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if (this.responseText === "False") {
				//false return notif
			}
			else {
				document.getElementById(`like_section-${img_id}`).innerHTML = this.responseText;
			}
		}
	};
	xmlhttp.open("POST", "../php/post_activity.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send("like=submit&id=" + img_id);
}