
//物件定義
    var videoImg; //影片訊號圖
    var video; //影片
    var videoLine; //時間紅線
    var body; 
    var videoInfo; //影片資訊欄
    var videoSpeed; //影片速度range拉軸

//位置定義
    var imgHeadPer = 4; //影片開始對應圖片位置
    var imgEndPer = 102;
    var img100Per = (imgEndPer - imgHeadPer);
    var imgPgogress = 0; //對應圖片進度

//旗標
    var videoDrop = false;
    var pause = 0; //0播放中 1暫停中 2播放中被拖曳

    $(function(){
        //物件定義
        body = document.querySelectorAll("body")[0];  
        videoImg = document.getElementById("videoImg");  
        videoLine = document.getElementById("videoLine");  
        videoInfo = document.getElementById("videoInfo");  
        videoSpeed = document.getElementById("videoSpeed");  
        video = document.getElementById("Video1");  

        var playButton = document.getElementById("play"); //播放按鈕
        var mute = document.getElementById("mute"); //音量按鈕

        var fileURL = "public/files/v1.mp4";
        var voice = "1"; //0靜音 1小聲 2大聲

        if (video.canPlayType) { 
        //基本影片設定
            //播放
            function vidplay() {
                if (video.src == "") { 
                    getVideo();
                }                                 
                if (video.paused) { 
                    video.play();
                } else { 
                    video.pause();
                }
            }
            //讀取
            function getVideo() {
                video.src = fileURL;
                video.load();
                playButton.click();
            }
            //設定時間
            function setTime(tValue) {
                if (tValue == 0) {
                    video.currentTime = tValue;
                }
                else {
                    video.currentTime += tValue;
                }
            }
            //音量按鈕功能
            mute.onclick = function () {
                if (voice == 1) {
                    mute.firstChild.classList.remove("glyphicon-volume-down");
                    mute.firstChild.classList.add("glyphicon-volume-up");
                    video.volume = 1.0;
                    voice = 2;
                } else if(voice == 2) {
                    mute.firstChild.classList.remove("glyphicon-volume-up");
                    mute.firstChild.classList.add("glyphicon-volume-off");
                    video.muted = true;
                    voice = 0;
                } else {
                    video.volume = 0.5;
                    video.muted = false;
                    mute.firstChild.classList.remove("glyphicon-volume-off");
                    mute.firstChild.classList.add("glyphicon-volume-down");
                    voice = 1;
                }
            };
            video.muted = true; //初始靜音
            voice = 0;

            //播放按鈕功能
            playButton.onclick = vidplay;

            //時間按鈕功能
            document.querySelectorAll("#repeat")[0].onclick = function(){
                setTime(0);
            }
            document.querySelectorAll("#backward")[0].onclick = function(){
                setTime(-(0.01)*2);
            }
            document.querySelectorAll("#foward")[0].onclick = function(){
                setTime(+(0.01)*2);
            }
        } 
        //影片速率range
        videoSpeed.onmousemove = function(){
            video.playbackRate = (100-videoSpeed.value)/50;
        };
        //基本功能完成，讀取影片
        getVideo();


    //進階功能
        //點選圖片修改進度功能
        videoImg.onmousemove = function(e){ //取得點位
            if(e.target.id == "videoImg"){ //防止取到紅線做標
                var pPer = e.offsetX*100/($(videoImg).width());
                imgPgogress = (pPer-imgHeadPer)/ img100Per; //總長換算
            }
        };
        body.onmousedown = function(e){
            if(e.target.id == "videoImg"){
                videoDrop = true; //開始拖曳
                var pPer = e.offsetX*100/($(videoImg).width());
                imgPgogress = (pPer-imgHeadPer)/ img100Per;
            }
        };
        body.onmouseup = function(e){
            videoDrop = false;
        };

        //即時更新狀態
        setInterval(function(){
            //拖曳功能狀態
            if(videoDrop){
                var setTime = video.duration * imgPgogress;
                video.currentTime = setTime; //調整進度
                if (pause == 0){
                    pause += 2;
                    video.pause(); //拖曳時暫停影片
                }
            }
            else{
                imgPgogress = video.currentTime/video.duration; //紅線進度資訊
                if (pause>=2) { 
                    pause -= 2;
                    if (pause ==0){
                        video.play();
                    }
                }
            }
            //暫停狀態 0播放中 1暫停中 2播放中被拖曳
            if (pause<2){
                if (! video.paused) { 
                    pause = 0;
                    playButton.firstChild.classList.remove("glyphicon-play");
                    playButton.firstChild.classList.add("glyphicon-pause");
                }
                if (video.paused) { 
                    pause = 1;
                    playButton.firstChild.classList.remove("glyphicon-pause");
                    playButton.firstChild.classList.add("glyphicon-play");
                }
            }


            //紅線進度更新
            var videoW = $(videoImg).width(); //影片長度
            var img100PerW = $(videoImg).width()*img100Per/100; //圖片訊號長度
            var imgpPre = img100PerW * imgPgogress; //換算總實驗對應圖片座標的長度
            imgpPre += ($(videoImg).width()*imgHeadPer/100); //換算點位

            videoLine.style.left = imgpPre + 'px';

            if((imgpPre < 0)||(imgpPre > videoW)){ //隱藏超出範圍的紅線
                if (videoLine.style.display!='none'){
                    videoLine.style.display = 'none';
                }
            }   
            else{
                if (videoLine.style.display=='none'){
                    videoLine.style.display = '';
                }
            }

            //資訊欄位更新
            videoInfo.innerHTML = "[時間軸：" + formatFloat((video.currentTime/2),2)+
                                    " / " + formatFloat((video.duration/2),2) + " 秒] [影片速率 "+
                                    formatFloat(video.playbackRate/2,2) + " 倍]";
        },10);
    });

    //小數點顯示修正函數
    function formatFloat(num, pos){
        //小數點限制
        var size = Math.pow(10, pos);
        var returnNum = Math.round(num * size) / size;

        //尾數0補償
        returnNum = returnNum.toString();
        var pFind = returnNum.match(/.*\.(.*)/);
        var add0 = 0;
        if (pFind==null){
            returnNum += ".";
            add0 = pos;
        }
        else{
            var afterP = pFind[1].toString();
            afterP = afterP.length;
            add0 = pos - afterP;
        }
        for (var i=0;i<add0;i++){ //迴圈補0
            returnNum += "0";
        }
        return returnNum;
    }
