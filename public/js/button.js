export function makeBtn(text, parent){
	let btn = document.createElement('button');
	btn.classList.add('btn', 'btn-primary');
	btn.appendChild(document.createTextNode(text));
	btn.setAttribute('id', text);
	btn.setAttribute('type', 'submit');
	btn.setAttribute('name', 'submit');
	parent.appendChild(btn);
	btn = document.getElementById(text);
	return btn;
}