import { WIDTH, HEIGTH } from './constants.js';
import { makeBtn, makeField } from './button.js';
import { addPost } from './post.js';

const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
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

function upload(e) {
    e.preventDefault();
    let canvasCont = document.getElementsByClassName('canvas-container')[0];
    canvasCont.style.display = 'block';
    drawImg(imgPreview.src);
    if (document.getElementsByClassName('chosen')[0]) {
        const frame = document.getElementsByClassName('chosen')[0].src;
        drawImg(frame, 200, 200);
    }
    if (!document.getElementById('save')) {
        let parent = document.getElementsByClassName('canvas-container')[0];
        makeField(parent);
        let saveBtn = makeBtn('save', parent);
        saveBtn.addEventListener('click', save);
    }
}

/* function that draw image preserving its proportions */
export function drawImg(source, width = null, height = null){
    let baseImg = new Image();
    baseImg.src = source;
    baseImg.onload = function(){
        if (width === null){
            width = imgPreview.width;
            height = imgPreview.height;
            canvas.width = width;
            canvas.height = height;
        }
        context.drawImage(baseImg, 0, 0, width, height);
    }
}

function moveIt(e) {
    let x = e.offsetX;
    let y = e.offsetY;
    const frame = document.getElementsByClassName('chosen')[0].src;
    drawImg(imgPreview.src);
    moveImg(frame, x, y);
}

function moveImg(source, x, y){
    let baseImg = new Image();
    baseImg.src = source;
    baseImg.onload = function(){
        context.drawImage(baseImg, x-100, y-100, 200, 200);
    }
}


function convert_64() {
    let src = canvas.toDataURL('image/png');
    return src;
}

function getUID() {
    let uid = document.getElementById('uid').innerHTML;
    return uid;
}

export function save(e){
    e.preventDefault();
    let caption = document.getElementById('caption').value.trim();
    let src = convert_64();
    let uid = getUID();
    addPost(src, uid, caption);
}

