function accordion(index) {
	var collapse = document.getElementsByClassName('collapse');
	var collapseLength = collapse.length;

	for (i = 0; i < collapseLength ; i++) {
		//collapse[i].style.display = 'none';
		if (i == index) {
			if (collapse[index].style.display == 'none') {
				collapse[index].style.display = 'block';
			}
			else {
				collapse[index].style.display = 'none';
			}		
		}
		else {
			collapse[i].style.display = 'none';
		}
	}
}