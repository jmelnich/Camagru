import { makeBase } from './canvas.js';
import { makeBtn } from './button.js';

const form = document.getElementById('add-img');
const captureBtn = document.getElementById('capture');
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
    canvas.getContext('2d').drawImage(video, 0, 0, 400, 300);
    if (document.getElementsByClassName('chosen')[0]) {
        const frame = document.getElementsByClassName('chosen')[0].src;
        makeBase(frame);
    }
    if (!document.getElementById('save')) {
        let parent = document.getElementsByClassName('canvas-container')[0];
        makeBtn('save', parent);
    }
}

