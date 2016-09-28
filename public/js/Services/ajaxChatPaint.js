
//參數定義
	//物件參數
	var canvas;
	var ctx;
	var ctxShowPencel;
	var showPencel;
	var compressCanvas;	//壓縮影像用物件
	var compressCtx;
	var paintButton; //送出影像按鈕
	var selectPaintColor; //自訂顏色框

	//控制參數
	var mx,my; //滑鼠位置
	var draw=0; //繪畫旗標
	var selectEnableWait=0; //鎖住框選功能時間參數

	//繪圖參數
	var hsl="#000000";
	var grd;
	var lineWidth=5;
	var pencelWidth=5;
	var eraserWidth=30;
	var alpha=1;
	var compressScale = 1.6; //壓縮參數 (壓縮後大小為參數平方分之一倍)
	var stateImgMaxSize = 348; //顯示的圖片最大px (寬或高)
	var restoreSave = []; //複原用陣列
	var restoreMaxStep = 20; //最大複原次數
	var restoreFlag = 0; //複原旗標
	var keyControl = 0;
	var copySave; //拷貝用陣列

//ready函數
    $(function(){
    //物件與參數
    	//抓取物件 (querySelectorAll比jQuery還好用真的)
    		//主功能物件
	    	var body = document.querySelectorAll('body')[0];
	    	var drawArea = document.querySelectorAll('#drawArea')[0];
	    	var toolBlock = document.querySelectorAll('.toolBlock');
	    	canvas = document.querySelectorAll('#drawCanvas')[0];
	    	showPencel = document.querySelectorAll('#showPencel')[0];
	    	//進階繪畫功能
	    	paintAdvanceFunc = document.querySelectorAll('#paintAdvanceFunc')[0];
	    	selectPaintColor = document.querySelectorAll('#selectPaintColor')[0];
    		//壓縮影像專用物件
			compressCanvas = document.querySelectorAll('#compressCanvas')[0];
			compressCtx = compressCanvas.getContext("2d"); //compressScale壓縮參數
			//發送按鈕
    		paintButton = document.querySelectorAll('#postPaintButton')[0];
	    	//產生2D畫布
			ctx = canvas.getContext("2d");
			ctxShowPencel = showPencel.getContext("2d");
	    	ctxShowPencelFunc();	//顯示筆跡預覽

    //toolBlock右方工具區功能
    	for (var i=0;i<toolBlock.length;i++){

    		tool = toolBlock[i].dataset['tool']; //取得data-tool參數
    		if (tool.match(/#[a-f0-9]{1,6}/i)){
    			toolBlock[i].style.background = tool;	//調色盤背景初始化
    		}

    		//顯示筆跡框事件
    		toolBlock[i].onmouseover = function(e){
				$("#showPencelDiv").fadeIn(111);
			};

			//工具區功能點擊
	    	toolBlock[i].onclick = function(e){
	    		(tool=e.target.dataset['tool']) || (tool=e.target.parentNode.dataset['tool']);
	    		switch(tool){
	    			case 'pencel':
	    				chooisePencel();
	    				break;
	    			case 'eraser':
	    				chooiseEraser();
	    				break;
	    			case 'sizeUp':
	    				lineWidth *= 1.5;
	    				lineWidth = Math.min(lineWidth,200);
	    				break;
	    			case 'sizeDown':
	    				lineWidth /= 1.5;
	    				lineWidth = Math.max(lineWidth,1);
	    				break;
	    			case 'alphaUp':
	    				alpha /= 1.5;
	    				alpha = Math.max(alpha,0.02);
	    				grd = HSL2RGBA(hsl);
	    				break;
	    			case 'alphaDown':
	    				alpha *= 1.5;
	    				alpha = Math.min(alpha,1);
	    				grd = HSL2RGBA(hsl);
	    				break;
	    			default: //直接換色
						chooisePencel();
	    				hsl = tool;
    					grd = HSL2RGBA(hsl);
	    		}
	    		ctxShowPencelFunc(); //顯示筆跡預覽
	    	};
    	}
    	//隱藏筆跡框事件
    	canvas.onmouseover = function(e){
    		body.classList.add("noScroll");
    		draw = 1;
    	};


    //主畫布繪畫
		//繪畫預備參數
    	canvas.onmousemove = function(e){
    		//取消框選功能
			body.onselectstart = body.ondragstart = body.oncontextmenu = function(){return false;}; //取消框選功能
			selectEnableWait = 600; //鎖住框選功能秒
    		//取得滑鼠參數
    		mx = e.offsetX;
    		my = e.offsetY;
    		//隱藏筆跡預覽
    		$("#showPencelDiv").fadeOut(111);
    		//繪畫參數 (0=不畫，1=預備，2=開畫)
    		if(!draw){draw = 1};
    		if(draw==2){ctx.lineTo(mx,my);};
    	};	
    	//開始繪畫
    	canvas.onmousedown = function(e){
    		//取得滑鼠參數
    		mx = e.offsetX;
    		my = e.offsetY;
    		//預備
    		body.classList.add("noScroll"); //行動裝置隱藏拉軸
    		drawInit();
    		//點
			ctx.beginPath();
			ctx.fillStyle=grd;
			ctx.arc(mx,my,lineWidth/2,0,2*Math.PI,true);
			ctx.fill();
			//線
    		draw = 2;
    		ctx.beginPath();
    		ctx.moveTo(mx,my);
    	};
    	//停止繪畫
    	canvas.onmouseup = function(e){
    		saveInRecover(); //存入複原
    		draw = 0;
    	};
    	canvas.onmouseout = function(e){draw = 0;};
    	//繪畫迴圈
    	setInterval(function(){
    		if (draw==2){
		    	ctx.stroke();
				ctx.beginPath();
				ctx.moveTo(mx,my);
			}
    	},10);
    	//複原拷貝初始
		var imgData=ctx.getImageData(0,0,999,999);
		restoreSave.push(imgData);
		var imgData= new Image();
		imgData.src=canvas.toDataURL();
		copySave = imgData;

    //視窗控制函數
    	setInterval(function(){
    		//視窗大小調整
    		if((canvas.width != $("#drawCanvas").width())||
			(canvas.height != $("#drawCanvas").height())){
	    		var imgData=ctx.getImageData(0,0,canvas.width,canvas.height); //複製畫布
				canvas.height = $("#drawCanvas").height(); //調整大小
				canvas.width = $("#drawCanvas").width();
				ctx.putImageData(imgData,0,0);
			}
			//行動裝置釋放拉軸
			if(!draw){
    			body.classList.remove("noScroll"); 
			}
			//繪畫秒後灰複框選功能
			if(selectEnableWait <= 0){
				body.onselectstart = body.ondragstart = body.oncontextmenu = "";
			}
			else{
				selectEnableWait-=200;
			}
    	},200);


    //功能控制函數
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

		//貼圖按鈕
		paintButton.onclick = function(e){
			//壓縮進行中
			var cw = canvas.width;
			var ch = canvas.height;
			compressCanvas.width = cw/compressScale;
			compressCanvas.height = ch/compressScale;
			compressCtx.clearRect(0,0,999,999);
			compressCtx.drawImage(canvas,0,0,cw,ch,0,0,cw/compressScale,ch/compressScale);

			var imgContent;	//貼出內容
			var limitSize;
			if (canvas.width > canvas.height){ //限制大小屬性
				limitSize = 'width'; 
			}
			else  {limitSize = 'height';}
			imgContent = '<div class="copyToDraw">'; //二次創作用DIV
			imgContent = imgContent+'<a href="#copyToDraw"> [點此將圖拷貝至下方畫版，可繼續創作。] </a>';
			imgContent = imgContent+'<img class="img-responsive" style="' + limitSize 
						+ ':'+stateImgMaxSize+'px;" src="'+compressCanvas.toDataURL("image/png", 0.5)+'">';
			imgContent = imgContent+'</div>';
			tryAgain = imgContent; //以聊天室的tryAgain參數傳送資料

			$("#chatSubmit").click();

			var speaker = speakerInput.val(); //聊天室的參數

        	if (speaker != ""){//必須輸入暱稱才能發送資料     
				//送出成功鎖住按鈕秒
				paintButton.disabled = "disabled";
				paintButton.innerHTML = "Success!";
				var waitSecond = 10;
				lockPaintPost();
				function lockPaintPost(){
					if (waitSecond > 0){
						setTimeout(function(){
							paintButton.innerHTML = "wait:" + (-1+waitSecond--);
							lockPaintPost();
						},1000);
					}
					else{
						paintButton.innerHTML = "送出繪圖";
						paintButton.disabled = "";
					}
				}
			}
			else{
				tryAgain = "";
				paintButton.innerHTML = "輸入暱稱";
			}
		};

	//進階繪畫函數功能
		//手動點進階功能
		paintAdvanceFunc.onclick = function(e){
			//console.log(e.target.dataset.func);
			var func = e.target.dataset.func;
			advanceFunc(func);
		};
		//顏色選擇器
		selectPaintColor.onchange = function(){
			chooisePencel();
			hsl = selectPaintColor.value;
			grd = HSL2RGBA(hsl);
			ctxShowPencelFunc();
			keyControl = 0;
		};
		//快節鍵
		body.onkeydown = function(e){
			//console.log(e.key);
			if(e.key == 'Control'){
				keyControl = 1;
			}
			if(keyControl==1){	//ctrl組和鍵
				switch(e.key){
					case "Delete":	advanceFunc("clearAll");
						break;
					case "q": 		advanceFunc("selectColor");
						break;
					case "z": 		advanceFunc("restore");
						break;
					case "y": 		advanceFunc("rrestore");
						break;
					case "x":		advanceFunc("cut");
						break;
					case "c":		advanceFunc("copy");
						break;
					case "v":		advanceFunc("paste");
				};
			}
			else{
				switch(e.key){
					case "Tab":		
						changePencelEraser();
						ctxShowPencelFunc();
						break;
					case "1": 
						lineWidth *= 1.5;
	    				lineWidth = Math.min(lineWidth,200);
	    				ctxShowPencelFunc();
						break;
					case "2": 
						lineWidth /= 1.5;
	    				lineWidth = Math.max(lineWidth,1);
	    				ctxShowPencelFunc();
						break;
					case "3": 
	    				alpha /= 1.5;
	    				alpha = Math.max(alpha,0.02);
	    				grd = HSL2RGBA(hsl);
	    				ctxShowPencelFunc(); //顯示筆跡預覽
						break;
					case "4": 
	    				alpha *= 1.5;
	    				alpha = Math.min(alpha,1);
	    				grd = HSL2RGBA(hsl);
	    				ctxShowPencelFunc();
						break;
				};
			}
		};
		body.onkeyup = function(e){
			if(e.key == 'Control'){
				keyControl = 0;
			}
		};



    });//$(function)
	function copyToDrawFunc(e) { //二次創作被點擊
		//e.target.parentElement.lastChild.currentSrc 拷貝畫版DATAURL
		ctx.globalCompositeOperation = "source-over";
		var imgData=new Image();
		imgData.src=e.target.parentElement.lastChild.currentSrc; //原始影像(未解壓)
		var cw = canvas.width;
		var ch = canvas.height;
		compressCanvas.width = cw;
		compressCanvas.height = ch;
		compressCtx.clearRect(0,0,999,999);
		compressCtx.drawImage(imgData,0,0); //貼上未解壓dataURL
		imgData=new Image();
		imgData.src=compressCanvas.toDataURL(); //產生dataURL
		//console.log(imgData);
		ctx.drawImage(imgData,0,0,cw*compressScale,ch*compressScale); //貼上解壓dataURL
	}



//其他函數
	//主畫布筆跡設定
    function drawInit(){
		ctx.lineWidth=lineWidth;
		ctx.lineCap="round"; //末端 (butt平預設、round加圓帽、square加方帽)
		ctx.lineJoin="round"; //轉折處 (miter尖預設、round變圓角、bevel變方角)
		ctx.miterLimit=5; //轉折交疊長度上限
		ctx.strokeStyle=grd;
    }
    //切換工具
    function chooisePencel(){
		if (ctx.globalCompositeOperation == "destination-out"){//切換筆
			ctx.globalCompositeOperation = "source-over";
			eraserWidth = lineWidth;
			lineWidth = pencelWidth;
		}
    }
    function chooiseEraser(){
		if (ctx.globalCompositeOperation == "source-over"){//切換擦子
			ctx.globalCompositeOperation = "destination-out";
			pencelWidth = lineWidth;
			lineWidth = eraserWidth;
		}
    }
    function changePencelEraser(){
		if (ctx.globalCompositeOperation == "source-over"){//反向切換
			chooiseEraser();
		}
		else{
			chooisePencel();
		}
    }

    //色碼解碼
    function HSL2RGBA(HLS){ //HSL TO RGBA
    	HLS = HLS.toUpperCase();
    	var tmpChar = [];	//16進制轉10進制暫存字元
    	var RGB = [];
    	for(var i=1;i<=6;i+=1)
    	{
    		var char = HLS.substring(i,i+1).charCodeAt();
    		if (char >=65){char-=55;}
    		else{char-=48;}
    		tmpChar.push(char)
    	}
    	for(var i=0;i<=5;i+=2)
    	{
    		RGB.push(tmpChar[i]*16 + tmpChar[i+1]);
    	}
    	var RGBA='rgba('+RGB[0]+','+RGB[1]+','+RGB[2]+','+alpha+')';
    	//console.log(RGBA);
    	return RGBA;
    }

	//顯示筆跡預覽
    function ctxShowPencelFunc(){
    	//筆跡框大小調整
		showPencel.width = showPencel.height = 40; 
		if ((lineWidth+5) >= showPencel.width){
			showPencel.width = showPencel.height = (lineWidth+5);
		}
		//清除上次的筆跡
		ctxShowPencel.clearRect(0,0,999,999);
		//擦子事件
		if (ctx.globalCompositeOperation == "destination-out"){
			ctxShowPencel.fillStyle="#333333"
			ctxShowPencel.fillRect(0, 0, 999, 999);
			ctxShowPencel.globalCompositeOperation = "destination-out";
		}
		//繪製預覽筆跡
		var W = showPencel.width;
		ctxShowPencel.beginPath();
		ctxShowPencel.arc(W/2,W/2,lineWidth/2,0,2*Math.PI,true);
		ctxShowPencel.fillStyle=grd;
		ctxShowPencel.fill();

		$("#showPencelDiv").fadeIn(111);
    }

    //進階功能函數
	function advanceFunc(func){
		switch(func){
			case "clearAll":
				ctx.clearRect(0, 0, 999, 999);
				saveInRecover();
			break;
			case "selectColor":
				selectPaintColor.value = hsl;
				selectPaintColor.click();
			break;
			case "restore":
				if(restoreFlag > 0){
					restoreFlag--;
    				var imgData = restoreSave[restoreFlag];
					ctx.fillRect(0, 0, 999, 999);
					ctx.putImageData(imgData,0,0);
				}
			break;
			case "rrestore":
				if(restoreFlag < (restoreSave.length-1)){
					restoreFlag++;
    				var imgData = restoreSave[restoreFlag];
					ctx.fillRect(0, 0, 999, 999);
					ctx.putImageData(imgData,0,0);
				}
			break;
			case "cut":
				var imgData= new Image();
				imgData.src=canvas.toDataURL();
				copySave = imgData;
				ctx.clearRect(0, 0, 999, 999);
				saveInRecover();
			break;
			case "copy":
				var imgData= new Image();
				imgData.src=canvas.toDataURL();
				copySave = imgData;
			break;
			case "paste":
				ctx.globalCompositeOperation = "source-over";
				ctx.drawImage(copySave,0,0); //貼上未解壓dataURL
				saveInRecover();
			break;
			default:
		};
	}

	function saveInRecover(){
	//存入複原區
		//複原旗標修正
		restoreSave = restoreSave.slice(0, restoreFlag+1);
		//複製畫布存入
		var imgData=ctx.getImageData(0,0,canvas.width,canvas.height);
		restoreSave.push(imgData);
		if (restoreSave.length > restoreMaxStep){
			restoreSave = restoreSave.slice(1); //砍頭
		}
		//更新複原旗標
		restoreFlag = restoreSave.length -1;
	}