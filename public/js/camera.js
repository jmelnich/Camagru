window.onload = function() {
    const video = document.getElementById('video'),
        vendorUrl = window.URL || window.webkitURL;

    navigator.getMedia = navigator.getUserMedia ||
                        navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia ||
                        navigator.msGetUserMedia;

    const constraints = {
        video: {width: 400, height: 300},
        audio: false
    };
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const form = document.getElementById('add-img');
    const captureBtn = document.getElementById('capture');

    //TODO: write class that chose images
    let imgSrc = document.getElementsByClassName('chosen')[0].src;
    console.log(imgSrc);

    navigator.mediaDevices.getUserMedia(constraints).then(function(mediaStream) {
        video.src = vendorUrl.createObjectURL(mediaStream);
        video.onloadedmetadata = function(e) {
            video.play();
            form.style.display = 'none';
            let cameraDiv = document.getElementsByClassName('camera-container')[0];
            cameraDiv.style.display = 'block';
        };
    }).catch(function(err) {
        console.log(err.name + ": " + err.message);
    });

    captureBtn.addEventListener('click', capture);

    function capture () {
        console.log('im capture');
        context.drawImage(video, 0, 0, 400, 300);
        make_base();
    }

    function make_base()
    {
        base_image = new Image();
        base_image.src = imgSrc;
        base_image.onload = function(){
            context.drawImage(base_image, 0, 0);
        }
    }
};