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

// function comment_img(img_id) {
// 	if (window.XMLHttpRequest) {
// 		// code for IE7+, Firefox, Chrome, Opera, Safari
// 		xmlhttp = new XMLHttpRequest();
// 	} else {
// 		// code for IE6, IE5
// 		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
// 	}
	// xmlhttp.onreadystatechange = function() {
	// 	if (this.readyState == 4 && this.status == 200) {
	// 		document.getElementById(`comment_box-${img_id}`).innerHTML = "";
	// 		}
	// 	};
// 	xmlhttp.open("POST", "../php/post_activity.php", true);
// 	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// let comm = document.getElementById(`comment_box-${img_id}`).value;
	// xmlhttp.send("comment=submit&comment_box=" + comm + "&id=" + img_id);
	// // document.getElementById(`comment_box-${img_id}`).value = "";
// }

// function like_img(img_id) {
// 	if (window.XMLHttpRequest) {
// 		// code for IE7+, Firefox, Chrome, Opera, Safari
// 		xmlhttp = new XMLHttpRequest();
// 	} else {
// 		// code for IE6, IE5
// 		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
// 	}
	// xmlhttp.onreadystatechange = function() {
	// 	if (this.readyState == 4 && this.status == 200) {
	// 		document.getElementById(`like_section-${img_id}`).innerHTML = this.responseText;
	// 		}
	// 	};
// 	xmlhttp.open("POST", "../php/post_activity.php", true);
// 	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// xmlhttp.send("like=submit&id=" + img_id);
// }