import { WIDTH, HEIGTH, canvas, context } from './constants.js';
import { makeBtn, makeField } from './button.js';
import { save } from './post.js';
import { Frame } from './Frame.js';
import { Canvas } from './Canvas.js';

const uploadHandler = document.getElementById('upload-btn');
const imgPreview = document.getElementById('upload-preview');

uploadHandler.addEventListener('change', preview);
canvas.addEventListener('mousedown', moveIt);

function preview() {
    let oFReader = new FileReader();
    oFReader.readAsDataURL(uploadHandler.files[0]);
    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
    if (oFReader.readyState === 1) {
        if (!document.getElementById('upload')) {
           let label = document.getElementsByClassName('editor-uploader')[0];
          let uploadBtn = makeBtn('upload', label);
            uploadBtn.addEventListener('click', upload);
        }
    }
};
let cnv = new Canvas();

function upload(e) {
    e.preventDefault();
    cnv.activate();
    cnv.draw(imgPreview);
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

function moveIt(e) {
    let x = e.offsetX;
    let y = e.offsetY;
    if (imgPreview.src) {
        cnv.draw(imgPreview);
    }
    else if (video.srcObject){
        canvas.getContext('2d').drawImage(video, 0, 0, WIDTH, HEIGTH);
    }
    if (document.getElementsByClassName('chosen')[0]) {
        let frame = new Frame();
        frame.move(frame.src, frame.width, frame.height, x, y);
    }
}
