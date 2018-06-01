import { WIDTH, HEIGTH } from './constants.js';
import { draw, save } from './canvas.js';
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
    video: {width: WIDTH, height: HEIGTH},
    audio: false
};

navigator.mediaDevices.getUserMedia(constraints).then(function(mediaStream) {
    video.srcObject = mediaStream;
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
    canvas.getContext('2d').drawImage(video, 0, 0, WIDTH, HEIGTH);
    if (document.getElementsByClassName('chosen')[0]) {
        const frame = document.getElementsByClassName('chosen')[0].src;
        draw(frame);
    }
    if (!document.getElementById('save')) {
        let parent = document.getElementsByClassName('canvas-container')[0];
        let saveBtn = makeBtn('save', parent);
        saveBtn.addEventListener('click', save);
    }
}

