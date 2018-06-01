import { delPost } from './post.js';

let feed = document.getElementById('feed');
feed.addEventListener('click', checkEvent);

function checkEvent(e){
	let target = e.target;
	switch (target.className) {
		case 'fa fa-trash-o':
			deleteConfirm(target.getAttribute('value'));
			break;
		case 'fa fa-heart-o':
			like();
			break;
		default:
			break;
	}

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

function like() {
	console.log('like');
}

