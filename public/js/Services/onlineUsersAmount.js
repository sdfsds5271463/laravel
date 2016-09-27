	$(function(){
        onlineUserIdRegister();
		setInterval(function(){
            onlineUserIdRegister();
        },10000); //秒自動更新人數
	});


    function onlineUserIdRegister(){
        var _token = $("#_token").val();
        var onlineUserId = $("#onlineUserId").val(); //註冊者id
        var action = 'onlineUserIdRegister';
        var chatSpeakerName = $("#speaker").val()+""; //註冊者聊天室名稱
            if (chatSpeakerName == "undefined"){ //是否在聊天室中
                chatSpeakerName = ""; 
            }
            else{
                chatSpeakerName = chatSpeakerName.replace(/(^\s*)/g, "").replace(/(\s*$)/g, "") //去除左右空白
                                                 .replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;"); //去除敏感字元
            }


        var formData = {"onlineUserId":onlineUserId,"_token":_token,"action":action,
                        "chatSpeakerName":chatSpeakerName }; //JSON傳輸
                        

        $.ajax(
        {
            type: 'post',
            url:'',
            data: formData,
            success:function(data)
            {
                data = JSON.parse(data);
                //console.log(data);
                $("#onlineUserId").val(data.onlineUserId); //註冊線上id

                //以下是更新視圖顯示

                //總人數更新
                $(".onlineUserId").text(data.onlineUserId);
                $(".OnlineAmount").text(data.OnlineAmount);

                //聊天室更新
                if (data.OnlineChatUserCount!=undefined) //當有收到聊天室名單
                {
                    $("#SpeakerAmountBoardSpan").text(data.OnlineChatUserCount);
                    $("#SpeakerUsersBoard")[0].innerHTML = "";
                    UserLogo = '<span class="glyphicon glyphicon-user"></span> ';
                    UsersBoard = data.OnlineChatUsers;
                    for(key in UsersBoard){
                        value = UsersBoard[key];
                        $("#SpeakerUsersBoard")[0].innerHTML += UserLogo+value.chatSpeakerName+"<br>";
                    };
                }

            },
            error:function()
            {
                console.log("在線名單請求失敗，將自動重新請求");
            }
        });
    }

