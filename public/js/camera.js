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
        context.drawImage(video, 1, 1);
    }
};