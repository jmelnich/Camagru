import { draw, convert_64 } from './canvas.js';
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
	draw(imgPreview.src);
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

function save(e){
	e.preventDefault();
	let src = convert_64();
	/* call to POST method */
	post(src);
}

function post(src) {
	let post = new XMLHttpRequest();
	let url = "/add";
	let data = "src=" + src;
	post.open("POST", url, true);
	post.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	post.send(data);
	post.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			let return_data = post.responseText;
			console.log(return_data);
		}
	}
}
