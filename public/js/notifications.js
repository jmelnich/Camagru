import { unnotify, notify } from './post.js';
let notifyBtn = document.getElementById('notifications');
notifyBtn.addEventListener('click', toggleNotify);
let uid = document.getElementById('uid').innerHTML;

function toggleNotify() {
	if (!notifyBtn.checked) {
		unnotify(uid);
	} else {
		notify(uid);
	}
}