function sendRequest(url, data) {
	let post = new XMLHttpRequest();
	post.open("POST", url, true);
	post.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	post.send(data);
	post.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			let return_data = post.responseText;
			console.log(return_data);
			//window.location.href = 'index';
		}
	}
}

function sendRequestNorefresh(url, data) {
	let post = new XMLHttpRequest();
	post.open("POST", url, true);
	post.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	console.log('passing data = ' + data);
	post.send(data);
	post.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			let return_data = post.responseText;
			//console.log(return_data);
		}
	}
}

function convert_64() {
    let src = canvas.toDataURL('image/png');
    return src;
}

function getUID() {
    let uid = document.getElementById('uid').innerHTML;
    return uid;
}

export function save(e){
    e.preventDefault();
    let caption = document.getElementById('caption').value.trim();
    let src = convert_64();
    let uid = getUID();
    addPost(src, uid, caption);
}

export function addPost(src, uid, caption = null) {
	let url = "/add";
	let data;
	if (caption) {
		data = "src=" + src + "&uid=" + uid + "&caption=" + caption + "&request=add";
	} else {
		data = "src=" + src + "&uid=" + uid + "&request=add";
	}
	//console.log(data);
	sendRequest(url, data);
}

export function delPost(pid) {
	let url = "/index";
	let data = "pid=" + pid + "&request=delete";
	sendRequest(url, data);
}

export function addComment(pid, uid, comment) {
	let url = "/index";
	let data = "pid=" + pid + "&uid=" + uid + "&comment=" + comment + "&request=addcomment";
	sendRequest(url, data);
}

export function like(pid, uid) {
	let url = "/index";
	let data = "pid=" + pid + "&uid=" + uid + "&request=addlike";
	sendRequestNorefresh(url, data);
}

export function dislike(pid, uid) {
	let url = "/index";
	let data = "pid=" + pid + "&uid=" + uid + "&request=dislike";
	sendRequestNorefresh(url, data);
}

export function unnotify(uid) {
	let url = "/profile";
	let data = "uid=" + uid + "&request=unnotify";
	console.log('forming data' + data);
	sendRequestNorefresh(url, data);
}

export function notify(uid) {
	let url = "/profile";
	let data = "uid=" + uid + "&request=notify";
	console.log('forming data' + data);
	sendRequestNorefresh(url, data);
}