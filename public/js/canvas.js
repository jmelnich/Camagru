const canvas = document.getElementById('canvas');
const context = canvas.getContext('2d');

export function makeBase(source){
    let baseImg = new Image();
    baseImg.src = source;
    baseImg.onload = function(){
        context.drawImage(baseImg, 0, 0, 400, 300);
    }
}