
//參數定義
	//物件參數
	var canvas;
	var ctx;
	var ctxShowPencel;
	var showPencel;

	//控制參數
	var mx,my; //滑鼠位置
	var draw=0; //繪畫旗標

	//繪圖參數
	var hsl="#000000";
	var grd;
	var lineWidth=5;
	var alpha=1;

//ready函數
    $(function(){
    //物件與參數
    	//抓取物件 (querySelectorAll比jQuery還好用真的)
    	var canvas = document.querySelectorAll('#drawCanvas')[0];
    	var drawArea = document.querySelectorAll('#drawArea')[0];
    	var toolBlock = document.querySelectorAll('.toolBlock');
    	showPencel = document.querySelectorAll('#showPencel')[0];
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
				$("#showPencelDiv").fadeIn(200);
			};

			//工具區功能點擊
	    	toolBlock[i].onclick = function(e){
	    		(tool=e.target.dataset['tool']) || (tool=e.target.parentNode.dataset['tool']);
	    		switch(tool){
	    			case 'pencel':
	    				ctx.globalCompositeOperation = "source-over";
	    				break;
	    			case 'eraser':
	    				ctx.globalCompositeOperation = "destination-out";
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
	    			default:
	    				ctx.globalCompositeOperation = "source-over";
	    				hsl = tool;
    					grd = HSL2RGBA(hsl);
	    		}
	    		ctxShowPencelFunc(); //顯示筆跡預覽
	    	};
    	}
    	//隱藏筆跡框事件
    	canvas.onmouseover = function(e){
    		$("#showPencelDiv").fadeOut(200);
    	};


    //主畫布繪畫
		//繪畫預備參數
    	canvas.onmousemove = function(e){
    		mx = e.offsetX;
    		my = e.offsetY;
    		ctx.lineTo(mx,my);
    	};
    	//開始繪畫
    	canvas.onmousedown = function(e){
    		drawInit();
    		draw = 1;
    		ctx.beginPath();
    	};
    	//停止繪畫
    	canvas.onmouseup = function(e){draw = 0;};
    	canvas.onmouseout = function(e){draw = 0;};
    	//繪畫迴圈
    	setInterval(function(){
    		if (draw){
		    	ctx.stroke();
				ctx.beginPath();
				ctx.moveTo(mx,my);
			}
    	},10);
    	//視窗大小調整
    	setInterval(function(){
    		if((canvas.width != $("#drawCanvas").width())||
			(canvas.height != $("#drawCanvas").height())){
	    		imgData=ctx.getImageData(0,0,canvas.width,canvas.height); //複製畫布
				canvas.height = $("#drawCanvas").height();
				canvas.width = $("#drawCanvas").width();
				ctx.putImageData(imgData,0,0);
			}
    	},200);


    });

//其他函數
	//主畫布筆跡設定
    function drawInit(){
		ctx.lineWidth=lineWidth;
		ctx.lineCap="round"; //末端 (butt平預設、round加圓帽、square加方帽)
		ctx.lineJoin="round"; //轉折處 (miter尖預設、round變圓角、bevel變方角)
		ctx.miterLimit=5; //轉折交疊長度上限
		ctx.strokeStyle=grd;
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
    }
