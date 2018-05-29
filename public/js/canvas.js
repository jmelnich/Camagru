import { WIDTH, HEIGTH } from './constants.js';

const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');

export function draw(source){
    let baseImg = new Image();
    baseImg.src = source;
    baseImg.onload = function(){
        context.drawImage(baseImg, 0, 0, WIDTH, HEIGTH);
    }
}

export function convert_64() {
	let src = canvas.toDataURL('image/png');
	return src;
}