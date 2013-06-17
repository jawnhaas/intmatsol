function updatePage(pageName) {
	var page = pageName + '.php';
	new Ajax.Updater('content', page, {	
		
	});
}

function mouseOver(pageName) {
	$(pageName).addClassName('selected');
}

function mouseOut(pageName) {
	$(pageName).removeClassName('selected');
}