import { WIDTH, HEIGTH } from './constants.js';
import { addPost } from './post.js';

const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');
const imgPreview = document.getElementById('upload-preview');



export function draw(source){
    let baseImg = new Image();
    baseImg.src = source;
    baseImg.onload = function(){
        context.drawImage(baseImg, 0, 0, WIDTH, HEIGTH);
    }
}

export function drawImg(source){
    let baseImg = new Image();
    baseImg.src = source;
    baseImg.onload = function(){
        let width = imgPreview.width;
    	let height = imgPreview.height;
    	canvas.width = width;
    	canvas.height = height;
        context.drawImage(baseImg, 0, 0, width, height);
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