//全域參數
var stateTimeInterval = 1111; //顯示間格

//全域變數
var stateing = 0;  //0可顯示 1請求已經送出
var ableKeyIn = 1; //限制POST請求間格
var tryAgain = ""; //POST失敗儲存content再嘗試
var chatStateBar;  //短物件
var speakerInput;
var copyToDraw; //拷貝繼續創作按鈕

    $(function(){
        //將常用的物件存入全域參數
        chatStateBar = $("#chatStateBar"); //顯是板的div
        speakerInput = $("#speaker"); //輸入框的input

        //週期顯示聊天版設定
        stateAjaxChatRoom();
		setInterval("timedCount()",stateTimeInterval);

        //發送設定
        $("#chatSubmit").click(function(){
            inputAjaxChatRoom();
        });
        $("#chatContent").keydown(function(event){
            if (event.keyCode==13 & ableKeyIn){
                inputAjaxChatRoom();
            }
        });

        //初始化之後將捲軸捲到底
        var chatBottomTimer = setInterval(function(){
            var stateBar = chatStateBar;
            if (chatStateBar.text()){ 
                var chatStateBarBottom = chatStateBar[0].scrollHeight - chatStateBar.height();
                chatStateBar[0].scrollTop += (chatStateBarBottom-chatStateBar[0].scrollTop)/10;
                if (chatStateBar[0].scrollTop >= (chatStateBarBottom-20)){
                    clearInterval(chatBottomTimer);
                }
            }
        },15);

        //取消未輸入暱稱的背景提示
        speakerInput.keydown(function(){
            speakerInput.css('background-color','#FFFFFF');
            paintButton.innerHTML = "送出繪圖"; //這是繪圖js的參數
        });

        //隱藏在線人員面板
        var hideWord = $("#AmountBoardHideWord");
        var usersBoard = $("#SpeakerUsersBoard");
        $("#SpeakerAmountBoard").click(function(){
            if (hideWord.text()=="顯示"){
                usersBoard.slideDown(300);
                hideWord.text("隱藏");
            }
            else{
                usersBoard.slideUp(300);
                hideWord.text("顯示");
            }
        });
	});

    //週期顯示函數
    function timedCount(){
        stateAjaxChatRoom();
    }
    function stateAjaxChatRoom(){ 

        if (stateing ==0){ //未送出請求
            stateing = 1;
            
            var chatStateTime = $("#chatStateTime").val(); //最後顯示時間 (只會抓取此時間之後的聊天內容
            var newStateTime; //最新資訊時間

            $.ajax({ //ajax先取得時間旗標檔案參數
                type: "post",
                url: "public/files/chatTimeFlag",
                dataType: "json",
                success: function(res){ //成功時執行
                    newStateTime = res;

                    if (newStateTime>chatStateTime){  //時間旗標需要更新
                        //console.log(newStateTime+">"+chatStateTime+"，開始請求資料庫給予新資料顯示");

                        var _token = $("#_token").val();
                        var action = 'stateAjaxChatRoom';
                        var formData = {"chatStateTime":chatStateTime,"_token":_token,"action":action }; //JSON傳輸
                        $.ajax( //請求資料庫的顯示POST
                        {
                            type: 'post',
                            url:'',
                            data: formData,
                            success:function(data)
                            {
                                data = JSON.parse(data);
                                //console.log(data);
                                //console.log(data.chatData[0]);
                                //開始處理顯示的文字與樣式
                                var stateValue = "";
                                if(data.chatData&&(data.chatData!="")){
                                    //console.log(data.chatData);
                                    chatData = data.chatData;
                                    chatData.reverse(); //聊天陣列內容順時排序
                                    for (key in chatData){
                                        value = chatData[key]; 
                                        date = value.timeYmd;
                                        time = value.timeHis;
                                        time = '　<span style="color:#CCCCCC;font-size:80%;">('+time+')</span>'
                                        if ($("#stateDate").val() != date){
                                            $("#stateDate").val(date); //將目前顯示日期儲存，若日期有更改則輸出日期列
                                            stateValue+= '<center>'+date+'</center>';
                                        }
                                        //處理顯示字串
                                        stateValue+= '<div style="color:'+value.color+'">'
                                                     +'<b>'+value.speaker+'：</b>'
                                                     +value.content+time
                                                     +'</div>'; //完成文字樣式
                                        //處理其他參數
                                        lastStateTime = value.time; //最後顯示時間
                                    };
                                    if (lastStateTime){ //更新最新顯示時間
                                        $("#chatStateTime").val(lastStateTime);
                                    };
                                    chatStateBar[0].innerHTML += stateValue; //進行顯示

                                    //處理卷軸滾動
                                    var scrollFlag = 120;   //一般文字自動捲動判定 (貼底距離)
                                    if (stateValue.length > 300){
                                        scrollFlag = 120 + 40 + stateImgMaxSize;  //圖片自動捲動判定 (stateImgMaxSize是繪圖js的參數)
                                    }
                                    if (( chatStateBar[0].scrollTop + chatStateBar.height() + scrollFlag ) 
                                       >= chatStateBar[0].scrollHeight ) //人性化自動捲軸 (當位置貼底120時會自動捲動)
                                    {
                                        chatStateBar[0].scrollTop = chatStateBar[0].scrollHeight;
                                    }

                                    if ( ! tryAgain){
                                        //顯示聊天文字完成，移除(訊息發送中...)
                                        $(".chatTmp").remove();

                                        //毫秒後解除輸入限制
                                        setTimeout(function(){
                                            ableKeyIn = 1;
                                            $("#chatSubmit").removeAttr('disabled');
                                        },100);
                                    }

                                    //拷貝繼續創作按鈕物件
                                    copyToDraw = document.querySelectorAll('.copyToDraw');
                                    for (var i=0;i<copyToDraw.length;i++){
                                        copyToDraw[i].onclick = function(e){
                                            copyToDrawFunc(e);  //這是繪圖版js的函數
                                        };
                                    }
                                };
                            },
                            error:function()
                            {
                                console.log("顯示請求失敗，將自動重新請求");
                            },
                            complete: function(){
                                stateing = 0; //完成新資料資料顯示
                            }
                        });//ajax請求顯示
                    }//if (newStateTime>chatStateTime)
                    else{
                        stateing = 0; //
                    }
                },
                error: function(){
                    console.log("JSON時間旗標抓取失敗");
                    stateing = 0;
                },
            });//ajax時間旗標
        }//stateing ==0
    }
    //替換敏感字元函數
    function replaceSensitiveChar(repStr){
        repStr = repStr.replace(/(^\s*)/g, "").replace(/(\s*$)/g, ""); //去除左右空白
        repStr = repStr.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;"); //敏感字元替換 <>&
        repStr = repStr.replace(/'/g, "&#39;").replace(/"/g, "&quot;"); //敏感字元替換 " '
        return repStr;
    }


    //輸入文字請求
    function inputAjaxChatRoom(){
        var _token = $("#_token").val();
        var action = 'inputAjaxChatRoom';
        var speaker = speakerInput.val();
            speaker = replaceSensitiveChar(speaker); 
        var chatColor = $("#chatColor").val();

        //必須輸入暱稱才能發送資料        
        if (speaker == ""){
            speakerInput.css('background-color','#FFCCCC');
        }
        else {


            if (tryAgain){ //若是tryagain，則重複傳輸上次(失敗)內容
                var chatContent = tryAgain;
            }
            else{
                var chatContent = $("#chatContent").val();
                $("#chatContent").val("");
                chatContent = replaceSensitiveChar(chatContent);
            }
            var formData = {"speaker":speaker, "chatContent":chatContent, "chatColor":chatColor,
                            "_token":_token,"action":action }; //JSON傳輸

            //準備開始POST傳輸
            if (chatContent != ""){

                //傳輸前制工作 (若tryAgain情況下不需要，因為失敗那次做過了)
                if (tryAgain){ tryAgain = "";}
                else{
                    //將輸入窗口關閉 (防止過密集的POST)
                    ableKeyIn = 0;
                    $("#chatSubmit").attr('disabled','disabled');
                    //顯示(訊息傳輸中...)
                    chatStateBar[0].innerHTML += '<div class="chatTmp"><b>'
                                                        +speaker+'：</b>'+chatContent+' (訊息傳輸中...)</div>';
                    //捲軸至底
                    chatStateBar[0].scrollTop = chatStateBar[0].scrollHeight;
                }
                
                //開始傳輸
                $.ajax(
                {
                    type: 'post',
                    url:'',
                    data: formData,
                    success:function(data)
                    {
                        chatStateBar[0].scrollTop = chatStateBar[0].scrollHeight;
                        data = JSON.parse(data);
                    },
                    error:function()
                    {
                        setTimeout(function(){
                            tryAgain = chatContent; 
                            inputAjaxChatRoom(); //傳輸失敗後毫秒後重新嘗試
                        },600);
                        console.log("資料發送失敗，將自動重新發送");
                    }
                });// ajax
            }// chatContent != ""
        }//speaker != ""
    }