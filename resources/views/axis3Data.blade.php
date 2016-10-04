@extends('frame')
@section('main')
    <h1>三軸步態研究資料</h1>
    	<p>此頁資料與網頁設計無關，主要節錄我碩論內容，敘述三軸加速度感測器對於人體步態特徵辨識與定義的研究。</p>
    <h2>序論</h2>
	    <p>步態在最近幾年已經成為研究領域中相當重要的生物特徵，人類的步態會反映出一個人的身體狀況，因此步態分析的技術被廣泛的運用在醫療與老人照護中。步態訊號收集技術，主要分為三類：視覺設備、地面傳感器與穿戴式感測器，其中使用三軸加速度器之穿戴式感測器具有最低耗能與最低成本等優點，且不同於另外兩種的訊號收集技術需要在特定的地點安裝器材設備，因此活動空間與種類也不會受到限制，但是透過穿戴式感測裝置所分割之步態階段較為粗糙。</p>
	    <p>本研究的目的是希望藉由對三軸步態訊號特徵進行定義，透過定義能夠標示出精準的步態事件並切割出精細的步態階段，補足穿戴式感測裝置收集步態訊號之缺點。</p>
	<h2>研究依據</h2>
		<p>步態行為中有七個主要的事件(Events)，分別是：接觸初期(Initial contact)、另一側腳尖離地(Opposite toe off)、腳跟離地(Heel rise)、另一側接觸初期(Opposite initial contact)、腳尖離地(Toe off)、雙腳相鄰(Feet adjacent)與脛骨垂直(Tibia Vertical)，所有事件依序會成週期性的發生，通常會把接觸初期(Initial contact)作為一個步態週期的起始。步態事件接觸初期與腳尖離地會將一個步態週期分割成兩個主要時期(Phase)，分別是：站立時期(Stance phase)與擺盪時期(swing phase)，正常步態的站立時期為整個步態周期的60%、擺盪時期為整個步態週期的40%。而七個步態事件會將整個步態週期切成七個階段(Periods)，分別是：負重響應期(Loading response)、站立中期(Mid stance)、站立末期(Terminal stance)、擺盪前期(Pre swing)、擺盪初期(Initial swing)、擺盪中期(Mid swing)與擺盪末期(Terminal swing)。</p>
		<img src="public/images/axis3data/gaitCycle.jpg" class="normalImg img-responsive">
		<center>圖、步態週期與主要的七個事件</center><br>
	<h2>訊號採集</h2>
		<p>我們使用穿戴式三軸加速度感測模組，收集人體的步態訊號。而我們感測模組的微處理器是TI的MSP430系列，並使用ST的三軸加速度計收集訊號，所得之資料會儲存在MicroSD之中。我們加速度感測器的量測範圍是±16G，採樣頻率為120Hz。三軸加速度感測模組配戴在雙腳的外踝(Malleolus lateralis)上方2~3公分處，而理想的佩戴位置，是當使用者立正時，感測模組的板子底邊需與地面平行、側邊與地面垂直，且兩塊感測模組板面平行。</p>
		<p>實驗時我們也會使用運動攝影機作為影像紀錄，攝影機我們選用Sony AS100V Action Cam，實驗時我們設定它的fps (frames per second)為120，每秒紀錄120個影像，影像紀錄有助於我們定義與分析人體步態特徵。</p>
		<img src="public/images/axis3data/equipment.jpg" class="normalImg img-responsive">
		<center>圖、實驗之訊號採集設備安裝說明圖</center><br>
	<h2>訊號採用</h2>
		<p>由穿戴式三軸加速度感測模組所收集之人體步態訊號，會以前後、左右、上下的方向，分別記錄其加速度值於X軸、Y軸、Z軸。而我們研究採用X軸的訊號，X軸記錄了受測者腳踝的前後加速度資訊，使用X軸主要是由於此軸所顯現的人體步態週期特徵最為明顯，因為往前移動就是我們走路的目的。而Z軸訊號所記錄之值為腳步的上下資訊，此訊號的特徵會由於個人走路習慣而有著極大的差異，所以此軸在有關分群的研究中有顯著的優勢，但並沒有辦法如X軸一樣，找出每個人都有的明顯走路特徵。至於Y軸，左右位移之加速度，此軸所能觀察到的走路特徵相當不明顯，而且更容易紀錄到感測器晃動所造成的雜訊，或是感測器安裝歪斜所產生的誤差。另外，與震動幅度相關的研究通常會使用三軸之方和根值(Root-sum-square value)作為訊號依據，此值是走路時加速度的動量改變，並沒有角度或是方向性，較常使用於跌倒偵測。方和根值的優點是能單純化實驗步驟，由於僅記錄加速度動量，因此安裝感測器時的角度誤差幾乎不會對研究造成影響。缺點也很明顯，由於取的值皆是平方後的計算，因此記錄之值不僅沒有方向性，更會忽略一些重要的走路特徵。</p>
	<h2>分析前處理</h2>
		<p>訊號分析前處理，我們會先使用傅立葉(Fourie)進行頻譜分析(Spectrum analysis)，找出人類正常步態之頻率能量集中帶，由此為依據設計濾波器除去非人體動作的頻帶，例如穿戴式三軸加速感測模組於行走時硬體搖晃所造成的雜訊。濾波器我們選擇使用巴特沃斯IIR數位濾波器(Butterworth IIR digital filter)。巴特沃斯濾波器特別適用於低頻應用，對於步態訊號處理有很大的優勢，巴特沃斯濾波器提供了最大通帶幅度響應的平坦度，操作主要取決於截止頻率的設計，具有良好的綜合性能其脈衝響應優於切比雪夫濾波器(Chebyshev filter)，衰減速度優於貝塞爾濾波器(Bessel filter)。數位濾波器(Digital filter)我們選擇無限脈衝濾波器IIR (Infinite impulse response)，其優點為設計簡單、計算效率較高，且僅需較低階的數就能滿足濾波條件。</p>
		<img src="public/images/axis3data/pretreatment.jpg" class="normalImg img-responsive">
		<center>圖、穿戴式三軸加速感測模組之原始訊號</center><br>
	<h2>透過影像定義步態特徵</h2>
		<p>實驗時，影像設備與三軸訊號同步記錄<a href="axis3Video">(步態實驗影片)</a>，透過影像觀察，我們將穿戴式三軸加速感測模組所收集到的X軸訊號定義出十二個特徵點：A、B、C、D、E、F、G、H、I、J、K、L。</p>
		<img src="public/images/axis3data/feature.jpg" class="normalImg img-responsive">
		<center>圖、步態三軸訊號特徵定義</center><br>
		<p>A.	Knee flexion水平加速波
		膝蓋關節收縮時，腳尖同時也會踮起，腳踝會被膝蓋關節往前牽引，水平速度會有第一次加速。
		Toe off發生於特徵點A，Toe off後加速度會有明顯的減少。
		B.	AC複合波
		此波為膝關節收縮與腳踝抬升垂直減速之複合波，波形不一定是明顯的凸波，特徵變化較大。
		C.	Toe off後垂直減速波
		腳踝從Heel rise開始會往上抬起，直到Toe off後腳踝高度會抵達Initial swing最高點。抵達Initial swing最高點的時候，腳踝從向上移動到停止會有一個垂直減速波，此減速波會乘以一個 –cosθ影響到感測器的X軸收集資訊 (θ為感測器角度)。
		Feet adjacent發生於特徵點C，此時膝蓋最為彎曲，Feet adjacent後膝關節會開始打直。
		D.	CE複合波
		此波為腳踝的垂直減速與膝蓋打直踢出之複合波，此波特徵通常比E波更為明顯。
		E.	Knee extension加速波
		膝蓋伸展時，從Mid swing到Terminal swing之間，水平速度會有第二次加速。此加速波曲線較為平滑，特徵相對不明顯。
		Tibia vertical發生於特徵點E。
		F.	Terminal swing減速波
		Terminal swing至最高點的時候，水平速度會急遽減速。
		Initial contact發生於特徵F與G之間，加速度為0的位置。
		G.	Initial contact至Foot flat加速波
		 Initial contact後，腳板踩下時，會有一個速度回升的加速波G。
		H.	Foot flat波
		腳板踩下時會有一個小幅度的回升速度，接著腳踝速度會繼續減速至特徵點H。
		 Foot flat發生於特徵點H。
		I、J、K、L.  Opposite影響波
			Foot flat後，進入Midstance，重心腳的腳踝加速度，會受到擺盪腳的牽連影響。重心腳的I、J、K波，會與擺盪腳的B、C、D波時間點一致，而重心腳的L波，則是受擺盪腳於Terminal swing的牽連影響。
			Heel rise發生於特徵點K，此時擺盪腳的時間點介於Feet adjacent與Tibia vertical之間。
		</p>
		<img src="public/images/axis3data/gaitOppsite.jpg" class="normalImg img-responsive">
		<center>圖、雙腳步態訊號的比對圖</center><br>
	<h2>濾波器設計</h2>
		<p>濾波前我們先進行頻譜分析，由三軸加速度感測模組所收集之資料，先進行傅立葉(Fourier)分析，觀察人類步態行走頻率之能量波譜(Power spectrum)集中帶，可得知三軸加速度感測模組所收集之人類步態行走頻率，主要集中在15Hz前後，而25Hz~45Hz又有較次要之頻率集中帶。三軸加速感測模組的取樣速率(120Hz)對於正常步態訊號的有效取樣頻率，參照信號取樣奈奎斯特取樣定理 (Nyquist Sampling Theorem)，取樣速率確實大於受測訊號的最高頻率部份兩倍(>90Hz)，因此我們的取樣速率可以有效避免訊號取樣時引起交疊 (Aliasing) 現象導致信號失真。<p>
		<p>另外我們使用離散之方波短時距傅立葉變換(Short-time Fourier transform, STFT) 模型觀察之，此模型不同於傅立葉轉換，它還包含了時間與頻率和能量波譜的關係。我們可以看到主要頻率 (15Hz)與次要頻率 (25Hz~45Hz) 出現的時間點幾乎相同，表示受測者的每一步皆同時有一個主要頻率與次要頻率的能量波譜。</p>
		<img src="public/images/axis3data/signalF.jpg" class="normalImg img-responsive">
		<center>圖、正常步態訊號之頻譜分析</center><br>
		<p>我們設計了一個巴特沃斯低通IIR數位濾波器，進行主能量波譜(15Hz)的濾波。我們試做了4~20的濾波器階次，我們發現numStages = 4時，部分特徵不夠明顯 (Inconspicuous)，而numStage≧12之後，A、B、C波峰會開始有明顯變形 (Distortion)的現象發生(，因此我們選用八階次的巴特沃斯低通IIR數位濾波器。</p>
		<img src="public/images/axis3data/butterworth.jpg" class="normalImg img-responsive">
		<center>圖、巴特沃斯低通IIR數位濾波器濾波階次比較</center><br>
	<h2>小波重構</h2>
		<p>濾波後，我們首要標示出步態最明顯的特徵點F，才能進行訊號的分割(Segmentation)。由於F波是由擺盪到末端時的水平減速波與往上抬起的垂直減速波所組成，複合波的特性會讓F波容易變形，所以我們無法直接標示出特徵點F。為了消除F特徵點波谷的變形，我們選用小波重構(Wavelet reconstruction)的方式，目的是透過小波重構改變訊號的解析度及繼承母小波的特性，找出我們要的特徵點F。</p>
		<p>母小波選擇上，我們選擇多貝西(Daubechies)小波族作為母小波，主要是因為多貝西小波族與我們的步態訊號有相對其他小波族較高的相關性。透過相關係數的分析，我們發現多貝西小波族在db4以上的母小波與步態訊號皆有很大的相關性，並且經由相關係數的分析找出了相關性最高的母小波Daubechies db5 ，其相關係數達-0.66。</p>
		表、正常步態訊號與多貝西小波族之相關係數分析
        <table class="table table-hover">
            <tr><th>Daubechies</th>
            	<td>db2</td><td>db3</td><td>db4</td><th>db5</th><td>db6</td><td>db7</td><td>db8</td>
            </tr>
            <tr><th>Correlation<br>coefficient</th>
            	<td>-0.34</td><td>-0.48</td><td>-0.57</td><th>-0.66</th><td>0.59</td><td>0.64</td><td>0.57</td>
            </tr>
        </table>
        <p>選定母小波後，我們選用Daubechies db5的第三階(Scale 3)進行小波重構，選定第三階是因為此階層訊號長度會是原始訊號的1/8，頻率解析度也會隨著訊號長度而改變，第三階層的訊號頻率為15Hz，恰好是人體步態最明顯的頻率能量集中帶。小波重構後，改變了頻率的解析度並使重構波形繼承母小波的特性，便能消除F特徵點因複合波所產生之歪斜。</p>
        <img src="public/images/axis3data/distortion.jpg" class="normalImg img-responsive">
		<center>圖、特徵點F由於複合波的影響產生變形或是歪斜</center><br>
	<h2>訊號分割</h2>
		<p>訊號切割演算法，主要有三個步驟：步驟一，進行模極大值(Modulus maxima)的分析，將閥值設定為重構後訊號的低標，抓取低於此閥值的所有相對極小值。步驟二，設定底標作為掃描閥值，並且將閥值不斷調整移動至低標，找出規律連續性區間(相鄰區間長度差異度小於等於10%)。步驟三，掃描閥值向上移動，找出其他連續區間，並移除連續區間周圍且差異度大於連續性區間10%之波峰點，直到低標。</p>
        <img src="public/images/axis3data/segmentation.jpg" class="normalImg img-responsive">
		<center>圖、訊號切割演算法分析</center><br>
		<p>最後我們將所有切割後之步態訊號進行標準化(Normalize)，取樣每位受測者中段之步態訊號，算出步態的平均時間長度(1.11步/秒)，並以此為依據進行訊號的標準化。</p>
		<img src="public/images/axis3data/normalize.jpg" class="normalImg img-responsive">
		<center>圖、所有受測者的標準化後訊號</center><br>
	<h2>步態事件特徵抓取</h2>
		<p>我們希望能夠藉由訊號之特徵點取得步態的七個事件(Event)時間點，兩者對應其特徵關係依序為：
		1.	Initial contact 發生於特徵點F至G的過零點。
		2.	Opposite Toe off 發生於另一側的特徵點A。
		3.	Heel rise 發生於另一側的特徵點D，同時也是特徵點K(我們選擇抓取較明顯的特徵點Opp-D)。
		4.	Opposite Initial contact 發生於另一側特徵點F至G的過零點
		5.	Toe off即為特徵點A。
		6.	Feet adjacent 即為特徵點C。
		7.	Tibia vertical 即為特徵點E。</p>
		<img src="public/images/axis3data/gaitAndFeatures.jpg" class="normalImg img-responsive">
		<center>圖、步態訊號特徵點與步態週期之比較</center><br>
		<p>所以我們要先抓出F至G的過零點，將Initial contact做為步態周期的開端，並找出特徵點A、C、D、E就能定義出完整的步態事件。首要抓取的Initial contact為特徵點F至G的過零點，抓取方法相當容易，挑選特徵點F之後第一個最接近零的訊號即為Initial contact，我們將此步態事件設定為步態週期的起始點。</p>
		<p>接著進行特徵點A~E的抓取。由於特徵點B與E在原始訊號上，相對不明顯且容易歪斜，所以我們透過小波分析進行觀察，找出容易標示出特徵點的尺度階層(Scale)。母小波我們選用相關係數最高的多貝西小波族db5，經小波各個階層分析後，觀察發現我們要的特徵點對應於階層4有最明顯的振幅，且此階層在原始訊號的特徵點B與E並不明顯時，也能清楚找到特徵B與特徵E。此方法夠使我們更容易標記出特徵點A~E。</p>
		<img src="public/images/axis3data/crawl.jpg" class="normalImg img-responsive">
		<center>圖、原始訊號特徵與小波分析訊號之時間點比較</center><br>
		<img src="public/images/axis3data/crawlAndOrginal.jpg" class="normalImg img-responsive">
		<center>圖、原始訊號的不明顯特徵對應至小波分析後訊號</center><br>
		<p>特徵點抓取演算法的設計上，我們會先對小波分析後的訊號進行模極大值(Modulus maxima)的分析，將閥值設定為重構後訊號的高標，取得高於此閥值的所有相對極大值。模極大值分析後，我們會設定合理的抓取區段，特徵點A~E會發生於Opposite Initial contact至特徵點F之間。在抓取小波分析後的訊號於合理區段的波峰時，會判定第一個波峰於原始訊號的左右兩側，斜率是否分別為正斜率與負斜率，若符合則往下連續抓五個波峰，若不符合則不抓取並判斷下一個波峰。</p>
		<img src="public/images/axis3data/featureGet.jpg" class="normalImg img-responsive">
		<center>圖、特徵點抓取演算法</center><br>
		<img src="public/images/axis3data/featureGetResult.jpg" class="normalImg img-responsive">
		<center>圖、特徵點抓取演算法取得連續步態特徵之結果</center><br>
	<h2>實驗結果</h2>
		<p>我們將Initial contact定義為每個步態周期的起始，並透過特徵點A、C、D、E，找出所有步態事件(Events)的時間點。統計分析時，每位受測者步態事件發生的時間點為他們每一步的平均值，受測者會統計出本側腳的五個事件的時間點Initial contact、Heel rise、Toe off、Feet adjacent、Tibia Vertical，與另一側腳的兩個時間點Opposite toe off、Opposite initial contact。統計的單位為百分比，相對於整個步態周期的比例發生的時間點，Initial contact皆為0%(起始點)。</p>
		<p>所有受測者本側腳五個步態事件發生之時間點，於步態週期分布長條圖如下，各個步態事件的統計結果與精確值(定義與可靠性於下個章節討論)驗證如表，其中與精確值差異(Differences with the exact value)所表示的意思，代表我們所判斷分析的特徵時間點與精確值所標示的時間點，在整個步態週期(100% Gait cycle)中有多少百分比的差異。所有步態事件結果與精確值差異統計分析如表，其結果顯示我們的研究方法標記單一步態事件時間點時，與精確值差異平均僅-0.37%，準確度為99.63%。</p>
		<img src="public/images/axis3data/gaitEventResult.jpg" class="normalImg img-responsive">
		<center>圖、本側腳五個事件時間點統計長條圖</center><br>		
		<p>依據步態事件Toe off與Initial contact發生的時間點，我們可以將步態周期分割為兩個主要時期：站立時期與擺盪時期，其統計佔整個步態周期的百分比，男性受試者為58.52%與41.48%，女性受試者為59.32%與40.68%，所有受試者之站立時期與擺盪時期平均值為58.92%與41.09%。另外我們透過所有的步態事件，可以分割出七個步態時期，依序分別為站立時期的Loading response、Mid stance、Terminal stance、Pre swing與擺盪時期的Initial swing、Mid swing、Terminal swing，統計結果如表 10，七個階段與精確值的誤差平均值為2.88%，分析步態階段的準確率達97.12%。</p>
		<img src="public/images/axis3data/resultTable.jpg" class="normalImg img-responsive">
		<center>圖、步態階段統計與精確值驗證</center><br>		

@stop