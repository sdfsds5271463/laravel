    
//參數
    //物件
    var body;
    var weatherXmlTitle; //抬頭顯示區
    var mapDiv; //地圖區域
    var allWeathersDiv; //天氣div存放區
    var movBg; //移動背景

    //主要參數
    var mapWidth;
    var mymap; //地圖
    var markData; //地圖標記
    var weatherText = []; //各地區天氣文字記錄參數

    //顯示天氣DIV參數
    var zoomSave = 0; //尺度
    var showId = -1;
    var showIdOld = -1;


    $(function(){
    //基礎設置
        //物件定義
    	allWeathersDiv = document.getElementById("allWeathersDiv");
    	weatherXmlTitle = document.getElementById("weatherXmlTitle");
        mapDiv = document.querySelectorAll("#mapDiv")[0];
        body = document.querySelectorAll("body")[0];

        //yql跨域存取中央氣象局xml
        var yURL="http://opendata.cwb.gov.tw/opendataapi?dataid=F-C0032-003&authorizationkey=CWB-FA703882-745C-4CC3-B1AD-369524C3464C";
        var yql = 'http://query.yahooapis.com/v1/public/yql?q=' + 
                encodeURIComponent('select * from xml where url="' + 
                yURL + '"') + '&format=xml&callback=?'; //使用YQL抓取中央氣象局天器XML
        var xmlData; //資料存取變數
        $.getJSON(yql, function (data) {
        	xmlData = data;
        });

    //顯示資料與地圖
        stateWeathersDiv();
        function stateWeathersDiv(){
        	weatherXmlTitle.innerHTML = "<center><img src='public/images/loading.gif'>xml資料讀取中...</center>";
            //嘗試顯示(若尚未讀取完成500毫秒會再嘗試)
        	if (xmlData){
            //天氣相關設置
        		allWeathersDiv.innerHTML = "";
                //將天氣資料存入Div
                for(k=0;k<=9;k++){
                	var weathersDiv = $("<div></div>").attr('id','weathersDiv'+k);
                	showWeather(k,weathersDiv);
                	$(allWeathersDiv).append(weathersDiv);
                }
                //標題顯示
                weatherXmlTitle.innerHTML=
                	"<center>資料來源：<b>交通部中央氣象局-開放資料平臺</b><br>("+ 
                    $(xmlData.results[0]).find("sent").text()	//時間版本
                    +")</center>";

            //地圖相關設置
                //地圖大小設定
                $(window).resize(function(){
                    mapWidth = $(".col-sm-9").eq(0).width();
                    mapDiv.style.width = mapWidth + 'px';
                    mapDiv.style.height = mapWidth + 'px';
                });
                $(window).resize();
                //顯示尺度預設
                var mapZoom;
                if      (mapWidth >= 650){
                    mapZoom = 8;
                }
                else{
                    mapZoom = 7;
                }
                //繪製地圖
                $(mapDiv).addClass("normalImg");
                var mapSetting = {
                    zoom: mapZoom,                 
                    center: {lat:23.60, lng:121.0},
                    mapTypeId: 'hybrid',      
                    mapTypeControl: true,      
                    draggable: true,       
                    scaleControl: true,
                    scrollwheel: true,
                    navigationControl: false,
                    streetViewControl: false,
                    zoomControl: true
                };
                mymap = new google.maps.Map(mapDiv,mapSetting);
                //繪製標記
                function areaInfo(){ //標記資訊
                    this.title = [
                        '台北市',
                        '北部地區',
                        '中部地區',
                        '南部地區',
                        '東北部地區',
                        '東部地區',
                        '東南部地區',
                        '澎湖地區',
                        '金門地區',
                        '馬祖地區'
                    ];
                    this.position = [
                        {lat:25.05, lng:121.52},
                        {lat:24.74, lng:121.25},
                        {lat:23.89, lng:120.74},
                        {lat:22.90, lng:120.50},
                        {lat:24.58, lng:121.69},
                        {lat:23.80, lng:121.46},
                        {lat:22.91, lng:121.08},
                        {lat:23.63, lng:119.56},
                        {lat:24.46, lng:118.41},
                        {lat:26.15, lng:119.93},
                    ];
                }
                markData = new areaInfo();
                for (var i=0;i<=9;i++){ //繪製
                    new google.maps.Marker({
                        map: mymap, 
                        position: markData.position[i],
                        title: markData.title[i] + "天氣", //滑過顯示文字
                        label: "", 
                        icon: 'public/images/space100x100.png' //自訂圖示(100x100透明空間)
                    });
                }
                //取得標記物件
                getMarkObj();
                function getMarkObj(){
                    var mark = $(".gmnoprint");
                    if (mark[0]){ //嘗試取得
                        updateBgImg();
                    }
                    else{
                        setTimeout(getMarkObj,500); //尚未完成標記，500毫秒再嘗試
                    }
                }
            }
            else{//嘗試顯示
            	setTimeout(stateWeathersDiv,500);
            }
        }
    
    //其他函數
        //更新動態背景
        function updateBgImg(){
            var bgX = 0; //背景位置
            var firstErr = -3; //初始化失敗用旗標
            setInterval(function(){
                //取得參數
                if ((zoomSave!= mymap.zoom)||(!movBg)){ //尺度修改需要重新取得參數
                    var mark = $(".gmnoprint");
                    zoomSave = mymap.zoom;
                    for (var n=0;n<=9;n++){
                        var areaId=-1;
                        try{
                            for(var u=0;u<=9;u++){
                                if ((markData.title[u]+'天氣') == mark[n].title){ //判斷區域ID
                                    areaId = u;
                                }
                            }
                            if(areaId >=0){ //取得背景
                                var s="0",c="0",r="0",l="0",j="0"; //晴雲雨雷暫 文字搜查
                                if(weatherText[areaId].match(/晴/)){s = "1";}
                                if(weatherText[areaId].match(/雲/)){c = "1";}
                                if(weatherText[areaId].match(/雨/)){r = "1";}
                                if(weatherText[areaId].match(/雷/)){l = "1";}
                                if(weatherText[areaId].match(/暫/)){j = "1";}
                                mark[n].firstChild.style.background = 'url(public/images/weathers/'+s+c+r+l+j+'.png)';
                                mark[n].firstChild.classList.add("sweatherPng"); 
                                mark[n].firstChild.dataset.areaId = areaId;
                                var topDis = parseInt(mark[n].style.top);
                                mark[n].style.top = (topDis+40) +'px'; //微調位置
                                $(mark[n]).css('opacity','1');
                            }
                        }
                        catch(err){
                            //console.log('有超出範圍的物件被map給釋放了，ID為' + n);
                            if(firstErr < 0){
                                zoomSave = -1;
                                firstErr += 1;
                                //console.log('初始讀取失敗，重新讀取');
                            }
                        }
                    }
                    movBg = document.querySelectorAll(".sweatherPng");
                    $(".sweatherPng").mousedown(showWeatherDiv); //更新按下事件
                }
                //更新背景
                else{
                    for (var n=0;n<movBg.length;n++){
                        movBg[n].style.backgroundPosition = bgX + 'px';
                    }
                }
                bgX+= 100;
                if (bgX >1000){
                    bgX -= 1000;
                }
            },60);
        }


        //顯示表格
        function showWeatherDiv(e){
            showId = e.target.dataset.areaId;
            var posTarget = $(".col-sm-9").eq(0)[0]; //位置依據
            var mx = e.clientX - realPosX(posTarget) + body.scrollLeft;
            var my = e.clientY - realPosY(posTarget) + body.scrollTop; //計算絕對座標
            var weathersDiv = $("#weathersDiv" + showId); //資料DIV取得
            if ((mx+300) > mapWidth){ //超出螢幕
                mx = (mapWidth-280);
            }
            weathersDiv.css('position','absolute');
            weathersDiv.css('top',(my)+'px');
            weathersDiv.css('left',(mx)+'px');
            weathersDiv.fadeIn(500); //顯示

            body.onmousemove(e); //判斷是否有需要隱藏的
        }
        //隱藏表格
        body.onmousemove = function(e){
            if (showId>-1){
                if (showId != showIdOld){ //如果更換顯示目標
                    var weathersDiv = $("#weathersDiv" + showIdOld);
                    weathersDiv.fadeOut(200);
                }
                showIdOld = showId;
                var mObj=e.target.toString(); //如果滑鼠不是在圖片或表格上
                if ((mObj!='[object HTMLImageElement]') && (mObj!='[object HTMLTableCellElement]')){
                    var weathersDiv = $("#weathersDiv" + showId);
                    weathersDiv.fadeOut(500);
                    showId = -1;
                    showIdOld = -1;
                }
            }
        };

        /*顯示表格函數*/
        function showWeather(id,stateDiv) 
        {
            stateDiv.addClass("weathersDiv").addClass("table");//初始化
            //表格設定
            stateDiv.append("<table></table>"); //創造表格
            var Wtable=$(stateDiv[0].children[0]); //定義表格
            Wtable.attr('border',1).width("100%").css('border-collapse','collapse'); //設定框線

            //開始輸出表格內容
                //地區物件抓取
                var DoRow = id; 
                var location = $(xmlData.results[0]).find("location").eq(DoRow); //地區物件
                var locationName = $(location).find("locationName").text(); //地區名稱
                var parameter = $(location).find("parameterName"); //地區天氣內容

                 //顯示地區名
                var th=$("<th></th>").text(locationName).attr('colspan','3');
                var row=$("<tr></tr>").append(th); 
                Wtable.append(row);

                //顯示地區天氣
                var D = new Date(); //時間物件
                var weekday = ["星期日","星期一","星期二","星期三","星期四","星期五","星期六"];

                Wtable.append("<tr><th>時間</th><th>天氣</th><th>溫度</th></tr>");
                for (i=0;i<=6;i++)
                {
                    row=$("<tr></tr>");  //直列定義
                    var th=$("<th></th>"); //橫格定義
                    var td1=$("<td></td>"); 
                    var td2=$("<td></td>"); 

                    var D2 = new Date(D.getTime()+24*60*60*1000*i); //定義未來時間物件
                    var Dshow = weekday[(D2.getDay())%7]; //抓取星期幾
                    Dshow += '(' + (D2.getMonth()+1) +'/'+ D2.getDate() + ')'; //抓取日期
                    th.text(Dshow);
                    td1.text(parameter.eq(i).text()); //抓取天氣
                    td2.text(parameter.eq(i+14).text()+"~"+parameter.eq(i+7).text()+"℃"); //抓取溫度

                    row.append(th).append(td1).append(td2);
                    Wtable.append(row);
                }
                weatherText[id] = parameter.eq(0).text();//記錄天氣
            //結束輸出表格內容 	*/
    	}//showWeather
        
        $("#weatherS").change();//呼叫顯示
        
    });//$(function)

