import { delPost, addComment, like, dislike } from './post.js';

let feed = document.getElementById('feed');
feed.addEventListener('click', checkEvent);

function checkEvent(e){
	e.preventDefault();
	let target = e.target;
	let pid = target.getAttribute('value');
	let uid = document.getElementById('uid').innerHTML;
	switch (target.className) {
		case 'fa fa-trash-o':
			deleteConfirm(pid);
			break;
		case 'fa fa-heart-o':
			like(pid, uid);
			break;
		case 'fa fa-heart':
			dislike(pid, uid);
		case 'btn btn-primary':
			let comment = (target.parentNode.childNodes[1].value).trim();
			if (comment === 'f004') {
				error(target);
			} else {
				addComment(pid, uid, comment);
			}
		default:
			break;
	}

}

function error(target) {
	if (target.parentNode.childNodes[4].innerHTML == 'This field cannot be empty'){
		return;
	}
	let p = document.createElement("p");
	let node = document.createTextNode('This field cannot be empty');
	p.appendChild(node);
	target.parentNode.insertBefore(p, target.nextSibling);
}

function deleteConfirm(id) {
	let delModal = document.getElementById('delete-modal');
	let yesBtn = document.getElementById('yes');
	let noBtn = document.getElementById('no');
    delModal.style.display = "block";
	let closeModal = document.getElementsByClassName("close")[0];
	closeModal.onclick = function() {
	    delModal.style.display = "none";
	}
	noBtn.onclick = function() {
		delModal.style.display = "none";
	}
	yesBtn.onclick = function() {
		delModal.style.display = "none";
		delPost(id);
	}
}
