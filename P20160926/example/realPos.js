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