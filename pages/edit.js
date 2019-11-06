var image;
var videoflag = 0;
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');

document.getElementById('fileToUpload').onchange = function(e) {
    var img = new Image();
    img.onload = draw;
    img.onerror = failed;
    img.src = URL.createObjectURL(this.files[0]);
  };
  function draw() {
    context.drawImage(this, 0,0, 400, 300);
    videoflag = 1;
}
  function failed() {
    console.error("The provided file couldn't be loaded.");
  };

  function chooseimg(){
    var choose = document.querySelectorAll(".filter");

    choose.forEach(function(element){
        element.addEventListener("click",function(){
        image = element;
        if (image && videoflag === 1){
            if (image.src === "http://localhost:8080/Camagru/filters/coconut.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost:8080/Camagru/filters/island.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost:8080/Camagru/filters/sunbed.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost:8080/Camagru/filters/surf.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            else if (image.src === "http://localhost:8080/Camagru/filters/wave.png"){
                context.drawImage(image, 0, 0, 400, 300);
            }
            var dataURL = canvas.toDataURL();
            document.getElementById("image_data").value = dataURL;
        }
    });
});}

chooseimg();

document.getElementById('clear').addEventListener('click', function() {
        context.clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById("image_data").value = NULL;
        videoflag = 0;
  });

document.getElementById("submitphoto").addEventListener("click", function() {
    if (videoflag === 1) {
        var dataURL = canvas.toDataURL();
        document.getElementById("image_data").value = dataURL;
    }
});
