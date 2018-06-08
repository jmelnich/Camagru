import { WIDTH, HEIGTH, canvas, context } from './constants.js';

export class Frame {
    constructor() {
        this.frame = document.getElementsByClassName('chosen')[0];
        this.src = this.frame.src;
        this.width = this.frame.naturalWidth;
        this.height = this.frame.naturalHeight;
    }

    move(source, width, height, x, y) {
    	let img = new Image();
    	img.src = source;
    	img.onload = function(){
        	context.drawImage(img, x - 100, y - 100, width, height);
    	}
    }
}