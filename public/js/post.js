function sendRequest(url, data) {
	let post = new XMLHttpRequest();
	post.open("POST", url, true);
	post.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	post.send(data);
	post.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			let return_data = post.responseText;
			window.location.href = 'index';
		}
	}
}

export function addPost(src, uid) {
	let url = "/add";
	let data = "src=" + src + "&uid=" + uid + "&request=add";
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
