@extends('frame')
@section('main')
    <script src="public/js/library/Box2dWeb-2.1.a.3.min.js"></script>
    <script src="public/js/Services/box2d.js"></script>

    <div id="box2dArea">
        <h1>　BOX2D物理空間</h1>
        <canvas id="boxCreatCanvas"></canvas>
        <button id="boxCreatButton" class="boxButton">創造圖形</button>
        <button id="boxCancelButton" class="boxButton">重新創造</button>
        <div id="boxCreatCaption">[物理凸邊形創造器 (點擊上方區域)]</div>
        <div id="boxCreatCaption2">決定圖形形狀後，按下方的按鈕。</div>

        <p class="boxP">這個頁面是透過Box2D物理引擎所</p>
        <p class="boxP">生的空間效果，有興趣者可以拜訪</p>
        <p class="boxP">引擎關網：<a href="http://box2d.org/" target="_blank">http://box2d.org/</a>，</p>
        <p class="boxP">透過Javascript可控制物理效果，套</p>
        <p class="boxP">用一般原件或呈現於Canvas。</p>
    </div>
    <div id="keepAreaHeight"></div>
@stop