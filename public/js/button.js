export function makeBtn(text, parent){
	let btn = document.createElement('button');
	btn.classList.add('btn', 'btn-primary');
	btn.appendChild(document.createTextNode(text));
	btn.setAttribute('id', text);
	parent.appendChild(btn);
	btn = document.getElementById(text);
	return btn;
}