function header(rootDir){
	if(rootDir == null) rootDir = "./";
	$.ajax({
		url: rootDir + "header.html",
		cache: false,
	        async: false,
	        dataType: 'html',
		success: function(html){
            		document.write(html);
		}
	});
}

function sidebar(rootDir){
	if(rootDir == null) rootDir = "./";
	$.ajax({
		url: rootDir + "sidebar.html",
		cache: false,
	        async: false,
	        dataType: 'html',
		success: function(html){
			html = html.replace(/\{\$root\}/g, rootDir); //footer.htmlの{$root}を置換
            		document.write(html);
		}
	});
}

function footer(rootDir){
	if(rootDir == null) rootDir = "./";
	$.ajax({
		url: rootDir + "footer.html",
		cache: false,
	        async: false,
	        dataType: 'html',
		success: function(html){
            		document.write(html);
		}
	});
}