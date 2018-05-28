let filtersList = document.getElementById('filter-list');
filtersList.addEventListener('click', toggleFilter);

function toggleFilter(e) {
	let kids =document.getElementById('filter-list').children;
	for (let i = 0; i < kids.length; i++) {
		kids[i].querySelector('img').classList.remove('chosen');
		kids[i].querySelector('img').classList.add('faded');
	}
	let target = e.target;
	target.classList.remove('faded');
	target.classList.add('chosen');
}