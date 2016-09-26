<?php
//此文件是高級的php語法整理
	
	//array_reduce([陣列]，雙變數函數，初始值);  //將初始值與陣列[0]丟入函數，得結果成新的初始值，再往下序陣列丟光

	//extract(組合陣列);  //拆解組合陣列，產生數個變數，變數名為鍵
	//compact('變數名','變數名'...);  //回傳組合陣列
	//getClass(); 回傳類別名稱 (限類別內呼叫)
	/*反射：     (ReflectionClass::newInstanceArgs創造class)
		$reflector = new ReflectionClass('car');
		$Benz = $reflector->newInstanceArgs(['Benz','purple',180]);
		上函式同：$Benz = new car('Benz','purple',180);


		$reflector->isInstantiable(); 回傳是否可以實例化
		$reflector->getConstructor(); 回傳反射物件的結構
		$reflector->getConstructor()->getParameters(); 回傳目標類別__construct結構*/

	/*
	抽象類別就是有無內容的abstract function，函數內容由繼承之子類別給予。

	接口是抽項類別的一種，接口一律為public權限，可以給予調用的類別強制的規範。
	接口又稱介面interface，調用參數為implements，可以用const定義給調用者參數。

	特徵trait類別也是抽像類別的一種，可解決代碼複用的問題。
	trait通過use函數引入，優先級大於父類別小於當類別，可用insteadof決定數個trait的優先級，

	IOC(Inversion of Control)控制反轉 = DI依賴注入(Dependency Injection)
	依賴關係是指類別引用類別，假設類別A之中有類別B的變數，則A依賴於B。
	依賴注入則是把依賴關係從內部拉到外部，不明確的指出A依賴B，而是在建構時將實例物件B注入。

	實例表示類別變數，實例化(instance)就是使用類別進行定義。
	
	閉包函數又稱調回函數，是只變數遇上return function而成為函數的函數，透過use函數包裝參數。

	namespace命名空間定義了實例化物件時導入的空間路徑，可用use引入其他命名空間。
	*/