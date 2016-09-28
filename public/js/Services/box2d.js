//參數
    //物件參數
    var worldDiv;   //世界空間
    var body; //頁面主體
    var boxCreatCanvas; //創造坊塊繪圖
    var ctx;

    //世界參數
    var worldWidth;
    var worldHeight;
    var selectEnableWait = 0; //鎖住框選功能時間參數

    //拖行功能參數
    var dragID = -1; //拖行者ID
    var mxAbsDif = 0; //相對座標
    var myAbsDif = 0;
    var mx; //絕對座標
    var my;
    var mvX = 0; //移動速度
    var mvY = 0;

    //創造功能參數
    var polygonPiontSet = []; //圖形打點陣列
    var polygonPiontFlag = "";

    //顯示內容參數
    var contentW; //內容寬度
    var cols; 
    var rows;
    var contentR; //當前框
    var dx; //自適應調整位置
    var dy;

    //取得屬性transform名稱 (瀏覽器不同有不同名稱) 
        var style = document.createElement('div').style,
            prefix = ['transform','webkitTransform','mozTransform','msTransform'];
        for (key in prefix) {
            if (prefix[key] in style) {
                transformProp = prefix[key];
            }
        }

    //匯入為捷徑用
        var b2Vec2          = Box2D.Common.Math.b2Vec2,
            b2BodyDef       = Box2D.Dynamics.b2BodyDef,
            b2Body          = Box2D.Dynamics.b2Body,
            b2FixtureDef    = Box2D.Dynamics.b2FixtureDef,
            b2World         = Box2D.Dynamics.b2World,
            b2PolygonShape  = Box2D.Collision.Shapes.b2PolygonShape, //凸多邊形
            b2CircleShape   = Box2D.Collision.Shapes.b2CircleShape; //圓形

    //世界參數
        var meterPerPixel = 100;
        var allowSleep = false;  //靜止物件睡眠
        var gravity = new b2Vec2(0, 9.8);   //重力
        var world = new b2World(gravity, allowSleep);   //世界產生
        var rigidBodies = []; //剛體陣列

    function RigidBody(world, data) {   //Rigidbody（剛體）處理函數
        //1.參數設置
            //預設值
            defaults = {
                //相關物件
                    target: worldDiv,   //世界物件
                    el: document.createElement('canvas'),  //處理物件
                //物理係數
                    density: 1.0,   //密度
                    friction: 0.5,  //摩擦係數
                    restitution: 0.2,   //彈性係數
                    linearDamping: 0.01,    //線性運動衰減
                    angularDamping: 0.01,   //角速度衰減
                //形狀種類
                    shapeType: 'box',   //'box'矩 'circle'圓 'polygon'多邊
                    type: 2,     //2動態物件 1靜態物件
                //位置大小
                    x:0,
                    y:0,
                    width: 50,
                    height: 50,
                    radius: 20, //圓形專屬 (圓不用設定寬高)
                    polygonPiont: [0,0,1,0,1,1,0,1], //多邊專屬
                //顏色與線條
                    color: 'none',   //可設定'none'，多邊沒有顏色
                    borderWidth: 1,
                    borderColor: '#666666',  
            }

            //設定
            for (key in defaults) {
                (!data[key] && (data[key]!=0)) && (data[key] = defaults[key]);
            }
            if (data.shapeType == 'circle') {
                data.width = data.height = data.radius * 2;
            }

            //記錄
            this.width  = data.width;
            this.height = data.height;
            this.halfWidth  = data.width * 0.5;
            this.halfHeight = data.height * 0.5;
            this.target = data.target;

        //2.套用剛體Box2D資訊物件
            // 產生剛體的「性質」資訊
            var fixDef  = new b2FixtureDef();   //性質物件產生
            fixDef.density = data.density;
            fixDef.friction = data.friction;
            fixDef.restitution = data.restitution;
            //產生形狀碰撞區域
            if (data.shapeType == 'polygon') {
                data.x -= (data.width/2);
                data.y -= (data.height/2);
                fixDef.shape = new b2PolygonShape();
                    var scaleH = data.height/meterPerPixel;
                    var scaleW = data.width/meterPerPixel;
                    var P = data.polygonPiont;
                    var shape = [];
                    for (i=0;i<P.length;i+=2){
                        shape.push(new b2Vec2(scaleW*P[i] , scaleH*P[i+1]));
                    }
                    fixDef.shape.SetAsArray(shape); //校準位置
                    for (i=0;i<fixDef.shape.m_vertices.length;i+=1){
                        fixDef.shape.m_vertices[i].x -= scaleW/2;
                        fixDef.shape.m_vertices[i].y -= scaleH/2;
                    }
            }
            if (data.shapeType == 'box') {
                fixDef.shape = new b2PolygonShape();
                fixDef.shape.SetAsBox(this.halfWidth/meterPerPixel, this.halfHeight/meterPerPixel);
            }
            if (data.shapeType == 'circle') {
                fixDef.shape = new b2CircleShape();
                fixDef.shape.SetRadius(data.radius/meterPerPixel);
            }
            // 產生剛體的「狀態」資訊
            var bodyDef = new b2BodyDef();   //狀態物件產生
            bodyDef.type = data.type;
            bodyDef.position.x = data.x/meterPerPixel;
            bodyDef.position.y = data.y/meterPerPixel;
            bodyDef.linearDamping = data.linearDamping;
            bodyDef.angularDamping = data.angularDamping;
            this.el = data.el;

        //3.將剛體的引數設定為DOM的引數
            //DOM物件style設置
            var style = this.el.style;
            style.position = 'absolute';
            style.display = 'block'
            style.left = 0;
            style.top = 0;
            //多邊形畫線
            if (data.shapeType == 'polygon') {
                scaleW*=meterPerPixel;
                scaleH*=meterPerPixel;
                this.el.width  = scaleW;
                this.el.height = scaleH;
                var polygonCtx = this.el.getContext("2d"); //定義canvas的2d繪製物件
                polygonCtx.beginPath();
                polygonCtx.lineWidth= data.borderWidth*2;
                    polygonCtx.lineCap="round"; //線樣式
                    polygonCtx.lineJoin="round"; 
                    polygonCtx.miterLimit=0;
                polygonCtx.moveTo(scaleW*P[0] , scaleH*P[1]); //起始點
                for (i=2;i<P.length;i+=2){
                    polygonCtx.lineTo(scaleW*P[i] , scaleH*P[i+1]); //畫線
                }
                polygonCtx.closePath(); //直線繪製回moveTo的點
                polygonCtx.strokeStyle=data.borderColor;
                polygonCtx.stroke();
            }
            //圓方形畫線+上色
            if(data.shapeType != 'polygon'){
                (data.color != 'none') && (style.background = data.color);
                if(data.borderWidth > 0){
                    style.border = data.borderColor+' solid '+data.borderWidth+'px';
                }
            }
            if (data.shapeType == 'box') {
                style.width  = this.width  + 'px';
                style.height = this.height + 'px';
            }
            else if (data.shapeType == 'circle') {
                style.height = this.el.style.width = (data.radius * 2) + 'px';
                style.borderRadius = '50%';
            }
            //新增DOM物件至世界區
            this.el.classList.add("moveAbleBlock"); //可拖行設置
            this.el.dataset['rigidID'] = rigidBodies.length; //拖行ID
            this.target && this.target.appendChild(this.el);

        //4.產生Box2D世界
            this.body = world.CreateBody(bodyDef);
            this.body.CreateFixture(fixDef);


    }
    RigidBody.prototype = {
        //世界時間進行
        applyToDOM: function () {
            //取得世界資訊
            var position = this.body.GetPosition();
            //修正世界資訊
            var x = position.x * meterPerPixel - this.halfWidth;
            var y = position.y * meterPerPixel - this.halfHeight;
            var r = this.body.GetAngle() * 180 / Math.PI;
            //將世界資訊套用至DOM物件
            this.el.style[transformProp] = 'translate(' + x + 'px, ' + y + 'px) rotate(' + r + 'deg)';
        }
    };

    window.onload = function(){
    //顯示容器設置
        //頁面主體
        body = document.querySelectorAll("body")[0];
        //世界區域
        worldDiv = document.querySelectorAll('#box2dArea')[0];
        worldWidth = $(".row").eq(0).width(); //世界高
        worldHeight = $(".col-sm-3").eq(0).height(); //世界高
        worldDiv.style.height = worldHeight + 'px';
        worldDiv.style.width = worldWidth + 'px';
        $("#keepAreaHeight").css('height',worldHeight); //保持頁面高度
        //創造物件框
        boxCreatCanvas = document.querySelectorAll('#boxCreatCanvas')[0];
        boxCreatCanvas.width = 300;
        boxCreatCanvas.height = 300;
        boxCreatCanvas.style.background = "#FAFAFA";
        ctx = boxCreatCanvas.getContext("2d");
        ctx.lineWidth=1;

    //初始化產生剛體物件
        init();


    //剛體拖行設置
        //啟動釋放拖行ID
        $(".moveAbleBlock").mousedown(function(e){
            dragID = e.currentTarget.dataset.rigidID;
        });
        $("#box2dArea").mousedown(function(e){
            selectEnableWait = 1000; //鎖住選取功能
            body.onselectstart = body.ondragstart = body.oncontextmenu = function(){return false;};
        });
        body.onmouseup = function(e){
            dragID = -1;
        };
        //更新滑鼠座標
        $("#box2dArea").mousemove(function(e){
            if (e.target.id == "box2dArea"){
                mxAbsDif = e.clientX - e.offsetX;
                myAbsDif = e.clientY - e.offsetY; //取得相對座標
            }
        });
        body.onmousemove = function(e){
            mx = e.clientX - mxAbsDif;
            my = e.clientY - myAbsDif; //計算絕對座標
        };
        //更新剛體位置
        setInterval(function(){
            if ((dragID>=0) && (rigidBodies[dragID].body.m_type==2)){ //拖行啟動
                //鎖住選取功能
                selectEnableWait = 1000;
                //取得物體寬高
                var rigidW = rigidBodies[dragID].el.style.width.match(/(.*)px/);
                var rigidH = rigidBodies[dragID].el.style.height.match(/(.*)px/);
                if (rigidW == null){
                    rigidW = [];
                    rigidH = [];
                    rigidW[1] = rigidBodies[dragID].el.width;
                    rigidH[1] = rigidBodies[dragID].el.height;
                }
                //取得物體位置
                var transform = rigidBodies[dragID].el.style.transform;
                var findPos = transform.match(/\((.*)px, (.*)px\)/);
                var currentX = findPos[1];
                var currentY = findPos[2];
                //計算相對位移
                var moveSpeed = 5; //拖行速度
                mvX = (mx - rigidW[1]/2 - currentX)/meterPerPixel*moveSpeed;
                mvY = (my - rigidH[1]/2 - currentY)/meterPerPixel*moveSpeed;
                //更新物體參數
                rigidBodies[dragID].body.m_linearVelocity.x = mvX;
                rigidBodies[dragID].body.m_linearVelocity.y = mvY;
                //rigidBodies[dragID].body.m_angularVelocity += (mvX - mvY)/meterPerPixel*2;
                rigidBodies[dragID].body.m_angularVelocity *= 0.99;
            }
        },25);

        //刪除飛出去的剛體
        setInterval(function(){
            for(var i=0;i<rigidBodies.length;i++){
                //取得位置資訊
                var transform = rigidBodies[i].el.style.transform;
                var findPos = transform.match(/\((.*)px, (.*)px\)/);
                var currentX = findPos[1];
                var currentY = findPos[2];
                if ((currentY > worldHeight*2)||
                (currentX < worldWidth*-2)||
                (currentX > worldWidth*2))
                {
                    rigidBodies[i].el.style.display = "none";
                    //rigidBodies.splice(i, 1);
                }
            }
        },1000);

        //鎖住框選功能
        setInterval(function(){
            if (selectEnableWait > 0){
                selectEnableWait -= 200;
                body.onselectstart = body.ondragstart = body.oncontextmenu = function(){return false;}; //取消框選功能
            }
            else{
                body.onselectstart = body.ondragstart = body.oncontextmenu = "";
            }
        },200);

    //產生剛體功能
        boxCreatCanvas.onclick = function(e){
            var niceP = false;

            //繪製剛體點位
            polygonPiontSet.push(e.offsetX);
            polygonPiontSet.push(e.offsetY);
            var ppsl = polygonPiontSet.length; 

            if (ppsl <= 6){ //前三點
                niceP = true;
            }

            if (ppsl >= 6){ //第四點開始判斷繪製角度(凸邊形)
                var pArg = polygonPiontSet.slice(ppsl-6);
                pArg = agrCompute(pArg); //當下點的角度
                var pArg2 = polygonPiontSet.slice(ppsl-4);
                pArg2 = pArg2.concat(polygonPiontSet.slice(0,2));
                pArg2 = agrCompute(pArg2); //當下點與第一點的角度
                var pArg3 = polygonPiontSet.slice(ppsl-2);
                pArg3 = pArg3.concat(polygonPiontSet.slice(0,4));
                pArg3 = agrCompute(pArg3); //當下點與第一 二點的角度

                (polygonPiontFlag=="")&&(polygonPiontFlag = pArg); //記錄下角度
                    //角度必須全大於180或小於180，才是凸邊形
                if ((polygonPiontFlag >= 180) && (pArg>180) && (pArg2>180) && (pArg3>180)){
                    niceP = true;
                }
                if ((polygonPiontFlag <= 180) && (pArg<180) && (pArg2<180) && (pArg3<180)){
                    niceP = true;
                } 
            }
            
            if (niceP){ //符合
                drawCross(e.offsetX,e.offsetY,10,"green");
                //連線
                ctx.beginPath();
                var drawPx = polygonPiontSet[polygonPiontSet.length-4];
                var drawPy = polygonPiontSet[polygonPiontSet.length-3];
                ctx.moveTo(e.offsetX,e.offsetY); //起始點
                ctx.lineTo(drawPx,drawPy); //直線繪製
                ctx.strokeStyle='black';
                ctx.stroke();

            }
            else{ //不正確的點 (非凸邊形)
                drawCross(e.offsetX,e.offsetY,3,"red");
                polygonPiontSet = polygonPiontSet.slice(0,-2);
            }
        };

        //創造圖形
        $("#boxCreatButton").click(function(){
            if(polygonPiontFlag!=""){
                //多邊凸形接受逆時針繪圖
                if(polygonPiontFlag > 180){
                    var reverseList = [];
                    for (var i=polygonPiontSet.length-1; i>=0; i-=2){
                        reverseList.push(polygonPiontSet[i-1]);
                        reverseList.push(polygonPiontSet[i]);
                    }
                    polygonPiontSet = reverseList;
                }
                //產生0~1之間的向量
                for(var i =0;i<=polygonPiontSet.length-2;i+=2){
                    polygonPiontSet[i] /= boxCreatCanvas.width;
                    polygonPiontSet[i+1] /= boxCreatCanvas.height;
                }
                //產生多邊形
                var shape = new RigidBody(world, {
                    type: 2,
                    width: boxCreatCanvas.width,
                    height: boxCreatCanvas.height,
                    shapeType: 'polygon',
                    polygonPiont: polygonPiontSet,
                    x: boxCreatCanvas.width+9,
                    y: boxCreatCanvas.height+56,
                    borderWidth: 1,
                });
                rigidBodies.push(shape);
                //重置mouseDown工作
                $(".moveAbleBlock").mousedown(function(e){
                    dragID = e.currentTarget.dataset.rigidID;
                });
                //清除
                $("#boxCancelButton").click();
            }
        });
        //清除創造
        $("#boxCancelButton").click(function(){
            ctx.clearRect(0,0,999,999);
            polygonPiontSet = [];
            polygonPiontFlag = "";
        });


//世界運行函數
        update();
        function update(){
            requestAnimationFrame(update); //使物理運算世界的時間前進
            world.Step(0.016,1,1); //重複間格(s)、每間格運算速度次數、每間格運算位置次數
            for (key in rigidBodies) {
                rigidBodies[key].applyToDOM();  //所有物件更新DOM狀態
            }
            world.ClearForces();
        }
    }//onload

//自定創造函數
    //繪製十字架
    function drawCross(x,y,crossW,color){
        ctx.beginPath();
        ctx.moveTo(x-crossW,y+crossW); //起始點
        ctx.lineTo(x+crossW,y-crossW); //直線繪製
        ctx.moveTo(x-crossW,y-crossW); //起始點
        ctx.lineTo(x+crossW,y+crossW); //直線繪製
        ctx.strokeStyle=color;
        ctx.stroke();
    }
    //計算點位角度
    function agrCompute(p){
        var arg1 = Math.atan2(p[2]-p[0],p[3]-p[1]) *180 / Math.PI;
        var arg2 = Math.atan2(p[4]-p[2],p[5]-p[3]) *180 / Math.PI;
        var deg = 180 - arg1 + arg2;
        (deg < 0) && (deg += 360);
        (deg > 360) && (deg -= 360);
        //console.log(arg1 + " " + arg2 + " " + deg);
        return deg;
    }

//初始物件產生
    function init() {

        //產生地面
        var ground = new RigidBody(world, {
            type: 1,
            width: worldWidth,
            height: 6,
            x: worldWidth/2,
            y: worldHeight-3,
            color: '#CCCCCC',
            borderWidth: 0,
        });
        rigidBodies.push(ground);

        //產生左壁
        var leftWall = new RigidBody(world, {
            type: 1,
            width: 6,
            height: worldHeight,
            x: 3,
            y: worldHeight/2,
            color: '#CCCCCC',
            borderWidth: 0,
        });
        rigidBodies.push(leftWall);

        //產生右壁
        var rightWall = new RigidBody(world, {
            type: 1,
            width: 6,
            height: worldHeight,
            x: worldWidth-3,
            y: worldHeight/2,
            color: '#CCCCCC',
            borderWidth: 0,
        });
        rigidBodies.push(rightWall);

        //將存在物件li套入
        var tagItems = document.querySelectorAll('li');

        var overFlowY = 0; //超出寬度自動延展的高
        for (var i=0; i<tagItems.length; i++){

            var logoW = 280;  //左側logo預留空間
            var solidW = 150; //方塊寬
            var solidH = 50; //方塊高
            var margin = 4; //預留外徑

            var listSel = [4,7]; //list摺疊選單的位置

            var x = logoW + (solidW+margin)*i; //預設 x
            var y = -(solidH/2); //預設 y

            if ((i>=listSel[0])&&(i<=listSel[1])){
                x = logoW + (solidW+margin)*(listSel[0]-1); //清單子列適應
                y = (i-(listSel[0]-1)) * (solidH+margin)-(solidH/2);
            }
            if (i>listSel[1]){ //清單子列外適應
                x = logoW + (solidW+margin)*(i-listSel[0]);
            }

            if ((x+solidW) > worldWidth){ //超過寬度時
                x = worldWidth - solidW;
                overFlowY += (solidH+margin);
                y += overFlowY;
            }

            var bit = new RigidBody(world, {
                el: tagItems[i],
                shapeType: 'box',
                color: '#f2f0eb',
                width: solidW,
                height: solidH,
                borderWidth: 0,
                x: x,
                y: y,
            });
            tagItems[i].classList.add("topSelector");
            bit.body.SetAngularVelocity((Math.random()-0.5) * 10); //初始角速度
            rigidBodies.push(bit);
        }



    //內容顯示框300 * 300 自適應區域
        contentW = (worldWidth - 270);
        cols = 1;
        rows = 2;
        contentR = 0;
        if      (contentW>=900){cols = 3;}
        else if (contentW>=600){cols = 2;}

        //第一格顯示框
        newContentSpace();
        for (var i=0;i<=8;i++){ //圓球平台
            var ball = new RigidBody(world, {
                type: 1,
                shapeType: 'circle',
                radius: 6,
                x: dx + 100 * (i%3),
                y: dy + 100 * (i-(i%3))/3,
                color: '#CCCCCC',
                borderWidth: 0,
            });
            rigidBodies.push(ball);
        }
        var tagItems = document.querySelectorAll('.boxButton');
        for (var i=0; i<tagItems.length; i++){ //創造功能按鈕
            var bit = new RigidBody(world, {
                el: tagItems[i],
                color: '#f2f0eb',
                width: 130,
                height: 40,
                borderWidth: 0,
                x: dx +49,
                y: dy +70 + i*100,
            });
            rigidBodies.push(bit);
        }
        var tagItems = document.querySelectorAll('#boxCreatCaption')[0];
        var bit = new RigidBody(world, { //創造按鈕說明
            el: tagItems,
            width: 230,
            height: 20,
            borderWidth: 0,
            x: dx + 100,
            y: dy - 20,
        });
        rigidBodies.push(bit);
        var tagItems = document.querySelectorAll('#boxCreatCaption2')[0];
        var bit = new RigidBody(world, {
            el: tagItems,
            width: 230,
            height: 20,
            borderWidth: 0,
            x: dx + 100,
            y: dy + 30,
        });
        rigidBodies.push(bit);
        


        //第二格顯示框
        newContentSpace();
        for (var i=0;i<=8;i++){//圓球平台
            var ball = new RigidBody(world, {
                type: 1,
                shapeType: 'circle',
                radius: 6,
                x: dx + 100 * (i%3),
                y: dy + 100 * (i-(i%3))/3,
                color: '#CCCCCC',
                borderWidth: 0,
            });
            rigidBodies.push(ball);
        }
        var tagItems = document.querySelectorAll('.boxP');
        for (var i=0; i<tagItems.length; i++){ //頁面說明段落
            var bit = new RigidBody(world, {
                el: tagItems[i],
                width: 260,
                height: 20,
                borderWidth: 0,
                x: dx + 95,
                y: dy - 20 + i*50,
            });
            rigidBodies.push(bit);
        }


        //第三格顯示框
        newContentSpace();
        for (var i=0;i<=8;i++){//圓球平台
            var ball = new RigidBody(world, {
                type: 1,
                shapeType: 'circle',
                radius: 6,
                x: dx + 100 * (i%3),
                y: dy + 100 * (i-(i%3))/3,
                color: '#CCCCCC',
                borderWidth: 0,
            });
            rigidBodies.push(ball);
        }
        for (var i=0;i<=8;i++){
            var ball2 = new RigidBody(world, { //隨機球體
                shapeType: 'circle',
                width: Math.random()*20,
                radius: Math.random()*30 + 10,
                x: dx + 100 * (i%3) ,
                y: dy + 100 * (i-(i%3))/3-50,
                color: 'rgb(' + parseInt(Math.random()*155+100) + ',' 
                              + parseInt(Math.random()*155+100) + ','
                              + parseInt(Math.random()*155+100) + ')',
                borderWidth: 1,
            });
            rigidBodies.push(ball2);
        }


    }

    //新的顯示空間
    function newContentSpace(){ //RDW自適應位置
        contentR++;
        if (contentR > cols) {
            contentR = 1;
            rows++;
        }
        dx = ((contentR-1)*300+ 50);
        dy = ((rows-1)*300+ 100);
    }