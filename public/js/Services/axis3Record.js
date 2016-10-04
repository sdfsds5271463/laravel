	//按鈕物件
	var accToJson;
	var downloadAccJson;

	//參數
	var accDrawWidth; //波形面板
	var preBlockTime; //每格時間

	//儲存駐列
	var saveX=[];
	var saveY=[];
	var saveZ=[];
	var saveRss=[];
	var saveMaxAmount = 200;

	//其他
	var errMsg = '<div class="alert alert-danger" role="alert">※目前裝置不支援三軸加速度感測器※</div>'

	$(function(){
	//物件定義
		//畫布定義
		var canvas = document.getElementById("accDraw");
		var canvasWord = document.getElementById("accDrawWord");
		var ctx = canvas.getContext("2d");
		var ctxWord = canvasWord.getContext("2d");
		//按鈕定義
		accToJson = document.getElementById("accToJson");
		downloadAccJson = document.getElementById("downloadAccJson");

		//每格時間抓取參數
		var putFont;
		var putTimes;

		//隱藏下載連結
		downloadAccJson.style.display = "none";

	//畫面寬度調整事件
		$(window).resize(function(){
			if(accDrawWidth != $(".col-sm-9").eq(0).width()){//寬度改變
				accDrawWidth = $(".col-sm-9").eq(0).width();
				canvas.width = canvasWord.width = accDrawWidth; //調整
				canvas.height = canvasWord.height = Math.min(accDrawWidth,300);

				canvas.style.backgroundPositionY = ((accDrawWidth%50)/2+25) + 'px'; //方格位置 (每格50px)

				ctxWord.clearRect(0,0,999,999); //清除文字顯示
				ctxWord.textAlign="center";  //設新的文字
				ctxWord.fillStyle="#666666";
				ctxWord.font="100 20px Arial";
				ctxWord.rotate((Math.PI/2)*3); //操作繪製的角度
				ctxWord.fillText("Acceleration(m/s^2)",-canvas.height/2,20);
				ctxWord.rotate((Math.PI/2)*-3);
				putFont = false; //重置旗標
				putTimes = 0;
			}
		});
		$(window).resize();

	//簡單中值律波
		var lastDraw = [];
		var medRatePoint = 5;
		for (var i=0;i<medRatePoint;i++){ //平均點數值陣列
			lastDraw.push(accDrawWidth/2);
		}


	//若支援方向事件, 即註冊事件處理函式
		if(window.DeviceMotionEvent){
			window.addEventListener('devicemotion', function(e){

			//抓取每格方塊時間
				putTimes++;
				if (!putFont){
					putFont = true;
					setTimeout(function(){
						preBlockTime = (50/putTimes);
						preBlockTime = preBlockTime.toFixed(2);
						ctxWord.fillText("time("+preBlockTime+"s)",canvas.width/2,canvas.height);
					},1000);
				}

			//繪製波形
				ctx.beginPath();
				ctx.lineWidth=1;
				ctx.strokeStyle="black";

				if(e.accelerationIncludingGravity.x == null) {
					$('#msg')[0].innerHTML = errMsg;
				}
				else {
					//讀取三軸加速度器
					x = e.accelerationIncludingGravity.x;
					y = e.accelerationIncludingGravity.y;
					z = e.accelerationIncludingGravity.z;
					rss = (Math.sqrt(x*x+y*y+z*z));
					saveX.push(x.toFixed(3));	//存入輸出駐列
					saveY.push(y.toFixed(3));
					saveZ.push(z.toFixed(3));
					saveRss.push(rss.toFixed(3));
					if(saveRss.length>saveMaxAmount){	//超出駐列要刪除
						saveX.shift();
						saveY.shift();
						saveZ.shift();
						saveRss.shift();
					}
					//顯示文字
					$('#x').text(x.toFixed(2));
					$('#y').text(y.toFixed(2));
					$('#z').text(z.toFixed(2));
					$('#rss').text(rss.toFixed(2));

					//顯示波形
					rss-=9.8;
					var imgData=ctx.getImageData(0,0,999,999);
					ctx.putImageData(imgData,-1,0); //移動

					ctx.moveTo(accDrawWidth,avgArray(lastDraw));
					lastDraw.pop();
					lastDraw.push(rss*50 + accDrawWidth/2); 
					ctx.lineTo(accDrawWidth,avgArray(lastDraw)); //簡單中值濾波直線繪製
					ctx.stroke();
				}
			});
		}
		else  {  //不支援註冊事件
			$('#msg')[0].innerHTML = errMsg;
		}

	//按鈕事件
		//產生json
		accToJson.onclick = function(){
		    var _token = $("#_token").val();
		    var action = 'accToJsonDownload';
       	 	var onlineUserId = $("#onlineUserId").val(); 
       	 	//POST資料
       	 	var preDataMillisecond = preBlockTime*1000/50;
       	 	var accX = saveX;
       	 	var accY = saveY;
       	 	var accZ = saveZ;
       	 	var rss = saveRss;
		    var formData = {"preDataMillisecond":preDataMillisecond,"_token":_token,"action":action,
		    					"accX":accX,"accY":accY,"accZ":accZ,"rss":rss,"onlineUserId":onlineUserId}; //JSON傳輸
	        $.ajax(
	        {
	            type: 'post',
	            url:'',
	            data: formData,
	            success:function(data)
	            {
	            	data = JSON.parse(data);
	            	accToJson.style.display = "none";
	            	downloadAccJson.style.display = ""; //隱藏按鈕，顯示下載
	            	downloadAccJson.href = data.jsonUrl; //更新下載連結
	                window.open(data.jsonUrl); //自動彈跳
	            },
	            error:function()
	            {
	                console.log("產生accJson失敗");
	            }
	        });
		};
		//重置按鈕
		$("#reAccRecord").click(function(){
			accToJson.style.display = "";
			downloadAccJson.style.display = "none";
			ctx.clearRect(0,0,999,999);
			saveX=[];
			saveY=[];
			saveZ=[];
			saveRss=[];
		});

	});

	//平均陣列值函數
	function avgArray(arr) {
	    var sum = 0;
	    for (var i = 0, j = arr.length; i < j; i++) {
	        sum += arr[i];
	    }
	    return sum / arr.length;
	}
