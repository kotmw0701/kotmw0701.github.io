function header(rootDir) {
	contents(rootDir, "header");
}

function sidebar(rootDir) {
	contents(rootDir, "sidebar");
}

function footer(rootDir) {
	contents(rootDir, "footer");
}

function article(rootDir) {
	contents(rootDir, "articlelist");
}

function contents(rootDir, name) {
	if(rootDir == null) rootDir = "./";
	$.ajax({
		url: rootDir + name +".html",
		cache: false,
	    async: false,
	    dataType: 'html',
	}).done(function(html){
		html = html.replace(/\{\$root\}/g, rootDir);
		document.write(html);
	});
}