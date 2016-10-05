//行動裝置參數
	//裝置參數
	var isMobile;


$(function(){
	//TOP按鈕效果
	$(window).load(function(){ 
		$(window).bind('scroll resize', function(){
			var $this = $(this);
			var $this_Top=$this.scrollTop();
			if($this_Top < 100){//當高度小於100時，關閉區塊 
				$('#top-bar').stop().animate({bottom:"-65px"});
			}
			if($this_Top > 100){
				$('#top-bar').stop().animate({bottom:"5px"});
			}
		}).scroll();
	});
	$('#top-bar').click(function(){
    	toTop();
	});


	//原碼AJAX請求
	$(".menu span").click(function(menuA){
		$('#dialog').dialog('open');    //開啟原碼交談視窗
		toTop(); //置頂
		$("#dialogCodeMain").text("post請求資源中..");

        var _token = $("#_token").val();
        var action = 'stateCode';
       	var codeTitle = menuA.target.innerHTML;

        var formData = {"codeTitle":codeTitle,"_token":_token,"action":action }; //JSON傳輸

	    $.ajax(
	    {
	        type: 'post',
	        url:'',
	        data: formData,
	        success:function(data)
	        {
	            data = JSON.parse(data);
	            //console.log(data);

	            //以下輸出至視圖
	            $("#ui-id-1").text(data.codeTitle);
	            $("#dialogCodeMain").text(data.Code);
	        },
	        error:function()
	        {
	        	$("#dialogCodeMain").text("post請求資源失敗，請關閉再重新開啟一次。");
	            console.log("ERROR");
	        }
	    });
	});


	//原碼交談窗
    $('#dialog').dialog({
        autoOpen: false,  //自動彈出 預設f
        title: "原碼",  
        closeOnEscape: true, //按esc關閉 預設t
        modal: true, //鎖住背景 預設f
        resizable: false, //可調大小 預設t
        width: '90%', //寬度 預設300
        height: 'auto', //高度 預設auto自適應
        draggable: false, //不能移動
        position: '',
        //show: 'fade', 
        hide: 'fade'
    });
    $('#closedialog').click(function(){
        $('#dialog').dialog('close');    //專門開啟交談視窗呼叫法
    });

    //行動裝置專區
		//行動裝置滑鼠事件註冊
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
		//行動裝置判斷
		if ( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		    isMobile = true;
		}
		else {
		    isMobile = false;
		}

});//$(function()

//讓IE6 7 8看懂Html5標籤
var tag = ['section', 'article', 'nav', 'header', 'footer', 'aside', 'main'];
for (key in tag) {
    document.createElement(tag[key]);
}

//提醒過舊瀏覽器
var isIE6 = navigator.userAgent.search("MSIE 6") > -1;
var isIE7 = navigator.userAgent.search("MSIE 7") > -1;
var isIE8 = navigator.userAgent.search("MSIE 8") > -1;
if (isIE6 | isIE7 | isIE8) {
    alert('您的瀏覽器過舊，無法正常顯示部分Html5或Css3特效，\n請將瀏覽器更新至IE9以上版本。');
}

//至頂的滑動效果
function toTop(){
	if (! toTopTimer){
		var toTopTimer = setInterval(function(){
		        $("body")[0].scrollTop -= $("body")[0].scrollTop/10;
		        if ($("body")[0].scrollTop <= 0){
		            clearInterval(toTopTimer);
		        }
		},15);
	}
}

//物件絕對做標函數
    function realPosX (oTarget) {  
        try {  
            var realX = oTarget.offsetLeft;  
            if (oTarget.offsetParent.tagName != "BODY") {  
            realX += realPosX(oTarget.offsetParent);   
            }   
            return realX;  
        }   
        catch (e) {  
            alert("realPosX: "+e);  
        }  
    }   
    function realPosY (oTarget) {  
        try {  
            var realY = oTarget.offsetTop;  
            if (oTarget.offsetParent.tagName != "BODY") {  
                realY += realPosY(oTarget.offsetParent);  
            }  
            return realY;  
        }   
        catch (e) {   
            alert("realPosY: "+e);  
        }  
    }  

//FB API
	//按讚https://developers.facebook.com/apps/180360789072178/add/
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '965388553566794',
			xfbml      : true,
			version    : 'v2.7'
		});
	};
	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/zh_TW/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
        
	//留言https://developers.facebook.com/docs/plugins/comments#moderation
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.7&appId=180360789072178";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));