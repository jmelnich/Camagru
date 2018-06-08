import { WIDTH, HEIGTH} from './constants.js';
import { save } from './post.js';
import { makeBtn, makeField } from './button.js';
import { Frame } from './Frame.js';
import { Canvas } from './Canvas.js';

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
    let cnv = new Canvas();
    cnv.activate();
    cnv.draw(video);
    if (document.getElementsByClassName('chosen')[0]) {
        let frame = new Frame();
        cnv.draw(frame, frame.width, frame.height);
    }
    if (!document.getElementById('save')) {
        let parent = document.getElementsByClassName('canvas-container')[0];
        makeField(parent);
        let saveBtn = makeBtn('save', parent);
        saveBtn.addEventListener('click', save);
    }
}
