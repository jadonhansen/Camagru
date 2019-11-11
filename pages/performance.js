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
				document.getElementById("notification").value = "<div style='background: rgba(255,0,0, 0.7); border-radius:5px;'>Could not post comment!</div>"
				setTimeout(() => {
					document.getElementById("notification").innerHTML = "";
				 }, 3000);
			}
			else if (this.responseText === "False1") {
				//false return notif
				document.getElementById("notification").innerHTML = "<div style='background: rgba(255,0,0, 0.7); border-radius:5px;'>Please type in a valid comment less than 200 characters.</div>"
				setTimeout(() => {
					document.getElementById("notification").innerHTML = "";
				}, 3000);
			}
			else {
				//true return notif
				document.getElementById(`comment_box-${img_id}`).value = "";
				document.getElementById("notification").innerHTML = "<div style='background: rgba(0, 151, 19, 0.7); border-radius:5px;'>Comment Posted!</div>"
				setTimeout(() => {
					document.getElementById("notification").innerHTML = "";
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
				document.getElementById("notification").innerHTML = "<div style='background: rgba(255,0,0, 0.7); border-radius:5px;'>Action denied!</div>"
				setTimeout(() => {
					document.getElementById("notification").innerHTML = "";
				}, 3000);
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