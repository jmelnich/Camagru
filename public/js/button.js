export function makeBtn(text, parent) {
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

export function makeField(parent) {
	let field = document.createElement('textarea');
	field.setAttribute('id', 'caption');
	field.setAttribute('placeholder', 'Write caption...');
	parent.appendChild(field);
}


