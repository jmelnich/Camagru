import { WIDTH, HEIGTH, canvas, context } from './constants.js';

export class Canvas {
	constructor() {
		this.canv_container = document.getElementsByClassName('canvas-container')[0];
	}

	activate() {
		this.canv_container.style.display = 'block';
	}

	draw(origin, width = null, height = null) {
		if (origin.id == 'video') {
			canvas.width = WIDTH;
    		canvas.height = HEIGTH;
			context.drawImage(video, 0, 0, WIDTH, HEIGTH);
		} else {
		    let img = new Image();
		    img.src = origin.src;
		    img.onload = function() {
		        if (width === null) {
		            canvas.width = origin.width;
		            canvas.height = origin.height;
		            width = origin.width;
		            height = origin.height;
		        }
		        context.drawImage(img, 0, 0, width, height);
		    }
		}
	}
}