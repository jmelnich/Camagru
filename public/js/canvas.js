const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');

export function makeBase(source){
    let baseImg = new Image();
    baseImg.src = source;
    baseImg.onload = function(){
        context.drawImage(baseImg, 0, 0, 400, 300);
    }
}

export function getImgSrc(parent) {
	let src = canvas.toDataURL('image/png');
	let inp = document.createElement('input');
	inp.setAttribute('type', 'hidden');
	inp.setAttribute('name', 'image');
	inp.setAttribute('value', src);
	parent.appendChild(inp);

}