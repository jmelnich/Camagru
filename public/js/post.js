export function post(src, uid) {
	let post = new XMLHttpRequest();
	let url = "/add";
	let data = "src=" + src + "&uid=" + uid;
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

export function comment() {

}