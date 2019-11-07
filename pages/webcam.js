(function() {
    // initialises all variables according to html elements
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video');
    var image;
    var videoflag = 0;

    // activates webcam if a device is found
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({
            video: true 
        }).then(function(stream) {
            video.srcObject = stream;
            video.play();
        });
    }

    // detects which filter was chosen
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

    // once a picture is taken it is drawn onto the canvas and videoflag=TRUE
    document.getElementById("snap").addEventListener("click", function() {
        context.drawImage(video, 0, 0, 400, 300);
        var original = context.getImageData(0,0,400,300);       //FOR TESTING
        videoflag = 1;
    });

    // clears canvas
    document.getElementById('clear').addEventListener('click', function() {
        videoflag = 0;
        context.putImageData(original, 400, 300);       //FOR TESTING
        // context.clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById("image_data").value = NULL;
    });

    // if a picture has been taken and submit button has been pressed it saves the cnavas image to the hidden input value
    document.getElementById("uploadphoto").addEventListener("click", function() {
        if (videoflag === 1) {
            var dataURL = canvas.toDataURL();
            document.getElementById("image_data").value = dataURL;
        }
    });
    
})();