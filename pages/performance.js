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
		document.getElementById("comments_section").innerHTML = this.responseText;
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
// 	xmlhttp.open("POST", "../php/post_activity.php", true);
// 	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
// 	xmlhttp.send("comment=submit&comment_box=hithere&id=6");
// 	//pass js var ^^^^^^
// }

// document.getElementById("comment").addEventListener("click", function() {
//     document.getElementById("comment_box").value = "";
// });