	
window.onload = function(){

	//註冊行動裝置的滑鼠事件
	var mouseEventTypes = {
		touchstart : "mousedown",
		touchmove : "mousemove",
		touchend : "mouseup"
	};
	for (originalType in mouseEventTypes) {
		document.addEventListener(originalType, function(originalEvent) {
			event = document.createEvent("MouseEvents");
			touch = originalEvent.changedTouches[0];
			event.initMouseEvent(mouseEventTypes[originalEvent.type], true, true,
			window, 0, touch.screenX, touch.screenY, touch.clientX,
			touch.clientY, touch.ctrlKey, touch.altKey, touch.shiftKey,
			touch.metaKey, 0, null);
			originalEvent.target.dispatchEvent(event);
		});
	}
}