function switchingStyles() {
	var date = new Date();
	var hour = date.getHours();
	
	var element = document.getElementById('toggle');
	var hrefparam = element.href;
	
	var css = (hour <= 6 || hour >= 19) ? hrefparam.replace("day", "night") : hrefparam;
	
	document.getElementById('toggle').href = css;
}