function accordion(index) {
	var collapse = document.getElementsByClassName('collapse');
	var collapseRev = new Array(100);
	var collapseLength = collapse.length;

	for (i = 0, j = collapseLength - 1; i < collapseLength; i++, j--) {
		collapseRev[j] = collapse[i];
	}

	for (i = 0; i < collapseLength ; i++) {
		//collapse[i].style.display = 'none';
		if (i == index) {
			if (collapseRev[index].style.display == 'none') {
				collapseRev[index].style.display = 'block';
			}
			else {
				collapseRev[index].style.display = 'none';
			}		
		}
		else {
			collapseRev[i].style.display = 'none';
		}
	}

	
}