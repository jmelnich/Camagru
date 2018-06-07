import { draw, drawImg, save } from './canvas.js';
import { makeBtn, makeField } from './button.js';

const uploadHandler = document.getElementById('upload-btn');
const imgPreview = document.getElementById('upload-preview');

uploadHandler.addEventListener('change', preview);

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
        draw(frame);
    }
    if (!document.getElementById('save')) {
        let parent = document.getElementsByClassName('canvas-container')[0];
        makeField(parent);
        let saveBtn = makeBtn('save', parent);
        saveBtn.addEventListener('click', save);
    }
}
