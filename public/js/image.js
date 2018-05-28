import { makeBase, getImgSrc } from './canvas.js';
import { makeBtn } from './button.js';

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
    	let label = document.getElementsByClassName('editor-uploader')[0];
		let uploadBtn = makeBtn('upload', label);
		uploadBtn.addEventListener('click', upload);
    }
};

function upload(e) {
	e.preventDefault();
	makeBase(imgPreview.src);
	if (document.getElementsByClassName('chosen')[0]) {
        const frame = document.getElementsByClassName('chosen')[0].src;
        makeBase(frame);
    }
    if (!document.getElementById('save')) {
    	let parent = document.getElementsByClassName('canvas-container')[0];
    	let saveBtn = makeBtn('save', parent);
    	getImgSrc(parent);
    }
}
