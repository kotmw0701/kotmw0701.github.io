function writedate() {
	var date = new Date();
	
	var hour = date.getHours();
	var minute = date.getMinutes();
	var second = date.getSeconds();
	
	document.write(hour+"時"+minute+"分"+second+"秒");
}