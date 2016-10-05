//參數們
	//物件定義
	var whiteFog;	//主要底色物件

	//寬度參數
	var puzBigW;
	var puzBigH;
	var puzSmW;
	var puzSmH;

	//設定參數
	var round = 15; //自動吸引填滿寬度
	var puzXSlice = 5; //切塊
	var puzYSlice = 5;
	var zIndex; //拿起至頂
	var bgUrl = "public/images/index_img.jpg"; //圖片選擇

	window.onload = function(){
		//物件定義
		whiteFog = document.getElementById('whiteFog');
		var puzzBg = document.getElementById('puzzBg');
		puzzBg.src = bgUrl;

		window.onresize = function(){
			if($(whiteFog).width() >0){
				//重置設定
				whiteFog.innerHTML = "";
				puzBigW = $(whiteFog).width();
				puzBigH = $(whiteFog).height();
				puzSmW = puzBigW/puzXSlice;
				puzSmH = puzBigW/puzYSlice;

				//亂數陣列
				var rndArrX = randNumArray(puzXSlice);
				var rndArrY = randNumArray(puzYSlice);

				//拼圖產生
				var puzId = 0;
				for(var i=0;i<puzYSlice;i++){
					for(var n=0;n<puzXSlice;n++){

						//塊內圖片
						var smImg = $("<img>");
						smImg.attr('src',bgUrl);
						smImg.css("width",puzBigW+"px"); //寬度與位置
						smImg.css("height",puzBigH+"px");
						smImg.css("position","absolute");
						smImg.css("left",n*-puzSmW);
						smImg.css("top",i*-puzSmH);
						smImg.css("top",i*-puzSmH);
						smImg.css('cursor','pointer'); //手指游標

						//塊外Div
						var smallPuz = $("<div></div>");
						smallPuz.attr("id","sm"+puzId); //設定id
						smallPuz.css("width",puzSmW+"px"); //寬度與位置
						smallPuz.css("height",puzSmH+"px");
						smallPuz.css("position","absolute");
						smallPuz.css("overflow","hidden");
						smallPuz.css("top",rndArrY[i]*puzSmH + "px");
						smallPuz.css("left",rndArrX[n]*puzSmW + "px");
						smallPuz.css("zIndex",puzId); //垂直順序
						smallPuz.css("border","solid 1px");

						//生成
						smallPuz.addClass("puzz"); //Div加入拼圖
						smallPuz.append(smImg); //圖片加入Div
						$(whiteFog).append(smallPuz); //Div註冊

						//事件註冊
						$("#sm"+puzId).mousedown(function(e){ //拿起時垂直順序置頂
							e.target.parentElement.style.zIndex = zIndex++;
						});
						$("#sm"+puzId).mouseup(function(e){ //放下時自動吸引
							var pTop = parseFloat(e.target.parentElement.style.top);
							var pLef = parseFloat(e.target.parentElement.style.left);
							for(var r=0;r<puzYSlice;r++){
								for(var k=0;k<puzXSlice;k++){
									if (
									(pTop>(r*puzSmH-round))&&(pTop<(r*puzSmH+round))&&
									(pLef>(k*puzSmW-round))&&(pLef<(k*puzSmW+round))
									){
										e.target.parentElement.style.top = r*puzSmH + "px";
										e.target.parentElement.style.left = k*puzSmW + "px";
									}
								}
							}
						});
						puzId++;
					} //for n
				} //for i
				zIndex = puzId;

		        //將元素指派為可拖曳
		        $('.puzz').draggable({
		            //helper: 'clone',     
		            opacity: 0.5,
		            revert: 'invalid',
		            revertDuration: 200
		        });

		        //將元素指派為拖曳目標
		        $('body').droppable({
		            activeClass: 'active',  //拖行時新類別
		            drop: function(event, ui) {
		            }
		        });
			} //if $(whiteFog).width() >0
			else{
				setTimeout(window.onresize,500); //重新載入
			}
		}
		window.onresize();

		//重新產生矩陣
		$("#puzSetButton")[0].onclick = function(){
			//取得矩陣參數
			var puzSetX = parseInt($("#puzSetX").val());
			var puzSetY = parseInt($("#puzSetY").val());
			if(puzSetX.toString()=="NaN" || puzSetX<1){
				puzSetX = 1;
			}
			if(puzSetY.toString()=="NaN" || puzSetY<1){
				puzSetY = 1;
			}
			if(puzSetX >20){puzSetX = 20;}
			if(puzSetY >20){puzSetY = 20;}
			//設定
			puzXSlice = puzSetX; 
			puzYSlice = puzSetY;
			$("#puzSetX").val(puzSetX);
			$("#puzSetY").val(puzSetY);
			window.onresize();
		}



	};

	//隨機排序數字陣列
	function randNumArray(len){
		var arr = [];
		for (var i=0;i<len;i++){
			arr.push(i);
		}
		for (var i=0;i<len;i++){
			var rand1 = Math.random()*(len-1);
			rand1 = Math.round(rand1);
			var rand2 = Math.random()*(len-1);
			rand2 = Math.round(rand2);

			if (rand1 != rand2){
				var tmp;
				tmp = arr[rand1];
				arr[rand1] = arr[rand2];
				arr[rand2] = tmp;
			}
		}
		return arr;
	}









