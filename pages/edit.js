// initialises all variables according to html elements
var image;
var videoflag = 0;
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var original;

// if a picture is selected from files it is drawn on the canvas and videoflag=TRUE
    document.getElementById('fileToUpload').onchange = function(e) {
        var img = new Image();
        img.onload = draw;
        img.onerror = failed;
        img.src = URL.createObjectURL(this.files[0]);
    };
    function draw() {
        context.drawImage(this, 0,0, 400, 300);
        original = context.getImageData(0, 0, 400 , 300);
        videoflag = 1;
    };
    function failed() {
        console.error("The provided file couldn't be loaded.");
    };

  // detects which filter was chosen
  function chooseimg(){
    var choose = document.querySelectorAll(".filter");

    choose.forEach(function(element){
        element.addEventListener("click",function(){
        image = element;
        if (image && videoflag === 1){
			if (image.src === "http://localhost:8080/Camagru/filters/21.png"){
				context.drawImage(image, 0, 0, 400, 300);
            }
			else if (image.src === "http://localhost:8080/Camagru/filters/27.png"){
				context.drawImage(image, 0, 0, 400, 300);
			}
            else if (image.src === "http://localhost:8080/Camagru/filters/28.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost:8080/Camagru/filters/24.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost:8080/Camagru/filters/26.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            var dataURL = canvas.toDataURL();
            document.getElementById("image_data").value = dataURL;
        }
    });
});}

chooseimg();

//clears filters
document.getElementById("clearfilters").addEventListener("click", function() {
    context.putImageData(original, 0, 0);
});

// clears canvas
document.getElementById("clear").addEventListener("click", function() {
    videoflag = 0;
    context.clearRect(0, 0, canvas.width, canvas.height);
    document.getElementById("image_data").value = "";
});

// if a picture has been uploaded from files and submit button has been pressed it saves the canvas image to the hidden input value
document.getElementById("uploadphoto").addEventListener("click", function() {
    if (videoflag === 1) {
        var dataURL = canvas.toDataURL();
        document.getElementById("image_data").value = dataURL;
    }
});
