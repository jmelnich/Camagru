import { WIDTH, HEIGTH } from './constants.js';
import { addPost } from './post.js';

const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');

export function draw(source){
    let baseImg = new Image();
    baseImg.src = source;
    baseImg.onload = function(){
        context.drawImage(baseImg, 0, 0, WIDTH, HEIGTH);
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