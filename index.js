
// document.oncontextmenu = function(){ return false; };
// document.body.oncontextmenu = "return false;"
// document.onselectstart = function(){ return false; };
// document.onmousedown = function(){ return false; };
// document.body.onselectstart = "return false;"
// document.body.onmousedown = "return false;"
$(function() {
  var img = $("img");
  img.css({"pointer-events":"none"});
});

//SVGアニメーションの描画
var stroke;
stroke = new Vivus('mask', {//アニメーションをするIDの指定
    start:'manual',//自動再生をせずスタートをマニュアルに
    type: 'scenario-sync',// アニメーションのタイプを設定
    duration: 10,//アニメーションの時間設定。数字が小さくなるほど速い
    forceRender: false,//パスが更新された場合に再レンダリングさせない
    animTimingFunction:Vivus.EASE,//動きの加速減速設定
},
function(){
       $(".mask").attr("class", "done");//描画が終わったらdoneというクラスを追加
}
);

$(window).on('load',function(){
  $(".splash").delay(2000).fadeOut('slow');//ローディング画面を3秒（3000ms）待機してからフェイドアウト
	$(".splash_logo").delay(2000).fadeOut('slow');//ロゴを3秒（3000ms）待機してからフェイドアウト
        stroke.play();//SVGアニメーションの実行
});

particlesJS("particles-js", {"particles":{"number":{"value":50,"density":{"enable":true,"value_area":800}},"color":{"value":"#43b3b5"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#43b3b5","opacity":0.5,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});

//
//
//
//
//
$(".openbtn").click(function () {//ボタンがクリックされたら
	$(this).toggleClass('active');//ボタン自身に activeクラスを付与し
    $(".g-nav").toggleClass('panelactive');//ナビゲーションにpanelactiveクラスを付与
    $(".circle-bg").toggleClass('circleactive');//丸背景にcircleactiveクラスを付与
});

$(".g-nav a").click(function () {//ナビゲーションのリンクがクリックされたら
    $(".openbtn").removeClass('active');//ボタンの activeクラスを除去し
    $(".g-nav").removeClass('panelactive');//ナビゲーションのpanelactiveクラスを除去
    $(".circle-bg").removeClass('circleactive');//丸背景のcircleactiveクラスを除去
});

//
//
//
function delayScrollAnime() {
	var time = 0.2;//遅延時間を増やす秒数の値
	var value = time;
	$('.delayScroll').each(function () {
		var parent = this;					//親要素を取得
		var elemPos = $(this).offset().top;//要素の位置まで来たら
		var scroll = $(window).scrollTop();//スクロール値を取得
		var windowHeight = $(window).height();//画面の高さを取得
		var childs = $(this).children();	//子要素を取得

		if (scroll >= elemPos - windowHeight && !$(parent).hasClass("play")) {//指定領域内にスクロールが入ったらまた親要素にクラスplayがなければ
			$(childs).each(function () {

				if (!$(this).hasClass("fadeUp")) {//アニメーションのクラス名が指定されているかどうかをチェック

					$(parent).addClass("play");	//親要素にクラス名playを追加
					$(this).css("animation-delay", value + "s");//アニメーション遅延のCSS animation-delayを追加し
					$(this).addClass("fadeUp");//アニメーションのクラス名を追加
					value = value + time;//delay時間を増加させる

					//全ての処理を終わったらplayを外す
					var index = $(childs).index(this);
					if((childs.length-1) == index){
						$(parent).removeClass("play");
					}
				}
			})
		}else {
			$(childs).removeClass("fadeUp");//アニメーションのクラス名を削除
			value = time;//delay初期値の数値に戻す
		}
	})
}

// 画面をスクロールをしたら動かしたい場合の記述
	$(window).scroll(function (){
		delayScrollAnime();/* アニメーション用の関数を呼ぶ*/
	});// ここまで画面をスクロールをしたら動かしたい場合の記述

// 画面が読み込まれたらすぐに動かしたい場合の記述
	$(window).on('load', function(){
		delayScrollAnime();/* アニメーション用の関数を呼ぶ*/
	});// ここまで画面が読み込まれたらすぐに動かしたい場合の記述
//
//
//
//
//
function fadeAnime(){

//ふわっと動くきっかけのクラス名と動きのクラス名の設定

$('.fadeInTrigger').each(function(){ //fadeInUpTriggerというクラス名が
　　var elemPos = $(this).offset().top - 50; //要素より、50px上の
　　var scroll = $(window).scrollTop();
　　var windowHeight = $(window).height();
　　if (scroll >= elemPos - windowHeight){
　　$(this).addClass('fadeIn');
　　// 画面内に入ったらfadeInというクラス名を追記
　　}else{
　　　$(this).removeClass('fadeIn');
　　// 画面外に出たらfadeInというクラス名を外す
　　}
　　});

$('.fadeInLeftTrigger').each(function(){ //fadeInUpTriggerというクラス名が
　　var elemPos = $(this).offset().top - 50; //要素より、50px上の
　　var scroll = $(window).scrollTop();
　　var windowHeight = $(window).height();
　　if (scroll >= elemPos - windowHeight){
　　$(this).addClass('fadeLeft');
　　// 画面内に入ったらfadeInというクラス名を追記
　　}else{
　　　$(this).removeClass('fadeLeft');
　　// 画面外に出たらfadeInというクラス名を外す
　　}
　　});

$('.fadeInRightTrigger').each(function(){ //fadeInUpTriggerというクラス名が
　　var elemPos = $(this).offset().top - 50; //要素より、50px上の
　　var scroll = $(window).scrollTop();
　　var windowHeight = $(window).height();
　　if (scroll >= elemPos - windowHeight){
　　$(this).addClass('fadeRight');
　　// 画面内に入ったらfadeInというクラス名を追記
　　}else{
　　　$(this).removeClass('fadeRight');
　　// 画面外に出たらfadeInというクラス名を外す
　　}
　　});

}//ここまでふわっと動くきっかけのクラス名と動きのクラス名の設定

// 画面をスクロールをしたら動かしたい場合の記述
  $(window).scroll(function (){
    fadeAnime();/* アニメーション用の関数を呼ぶ*/
  });// ここまで画面をスクロールをしたら動かしたい場合の記述

// 画面が読み込まれたらすぐに動かしたい場合の記述
  $(window).on('load', function(){
    fadeAnime();/* アニメーション用の関数を呼ぶ*/
  });// ここまで画面が読み込まれたらすぐに動かしたい場合の記述

//
// ３つのボックス　サービスの中
//
//

// $(function(){
//   //ボタンのイベント
//   var mainColor = "var(--main-color)",
//       accentColor = "var(--accent-color)",
//       big = 'scale(1.20)',
//       normal = 'scale(0.95)',
//       original = 'scale(1)';
//
//   $(document).click(function(event) {
//     if($(event.target).closest('.first-box').length) {
//     $('.first-box').css('transform', big);
//     $('.first-box').css('border-color', accentColor);
//     $(".second-box").css('transform', normal);
//     $(".second-box").css('border-color', "#999");
//     $(".third-box").css('transform', normal);
//     $(".third-box").css('border-color', "#999");
//     $(".text-space").html("<p><span>さまざまな業種、それぞれに</span><span>適したデザインで</span><span>コーポレートサイトを制作します。</span></p>");
//   } else if($(event.target).closest('.second-box').length) {
//     $('.second-box').css('transform', big);
//     $(".second-box").css('border-color', accentColor);
//     $(".first-box").css('transform', normal);
//     $('.first-box').css('border-color', "#999");
//     $(".third-box").css('transform', normal);
//     $(".third-box").css('border-color', "#999");
//     $(".text-space").html("<p><span>お客様のご希望に沿って</span><span>改善できるポイントを改善しつつ、</span><span>より良いサイトにリニューアルします。</span></p>");
//   } else if($(event.target).closest('.third-box').length) {
//     $('.third-box').css('transform', big);
//     $(".third-box").css('border-color', accentColor);
//     $(".second-box").css('transform', normal);
//     $(".second-box").css('border-color', "#999");
//     $(".first-box").css('transform', normal);
//     $('.first-box').css('border-color', "#999");
//     $(".text-space").html("<p><span>お客様のアピールしたい商品サイトの</span><span>コンバージョン率を最大化</span><span>できるデザインでサイト制作をします。</span></p>");
//   } else {
//     $(".first-box").css('transform', original);
//     $('.first-box').css('border-color', "#999");
//     $(".second-box").css('transform', original);
//     $(".second-box").css('border-color', "#999");
//     $(".third-box").css('transform', original);
//     $(".third-box").css('border-color', "#999");
//     $(".text-space").html("<p><span>Moweeb(モウィーブ)は、さまざまな種類の</span><span>ホームページ制作を行っております。</span><span>コーディング、サーバー設定、</span><span>ファイルのアップロードまで</span><span>WEB制作に関わること全て</span><span>をやらせていただいております。</span></p>");
//   }
// });
// });

//
//
//
// waveの形成
//
//


var unit = 100,
    canvasList, // キャンバスの配列
    info = {}, // 全キャンバス共通の描画情報
    colorList; // 各キャンバスの色情報

/**
 * Init function.
 *
 * Initialize variables and begin the animation.
 */
function init() {
    info.seconds = 0;
    info.t = 0;
		canvasList = [];
    colorList = [];
    // canvas1個めの色指定
    canvasList.push(document.getElementById("waveCanvas"));
    colorList.push(['#1f1f1f']);
	// 各キャンバスの初期化
		for(var canvasIndex in canvasList) {
        var canvas = canvasList[canvasIndex];
        canvas.width = document.documentElement.clientWidth; //Canvasのwidthをウィンドウの幅に合わせる
        canvas.height = 200;//波の高さ
        canvas.contextCache = canvas.getContext("2d");
    }
    // 共通の更新処理呼び出し
		update();
}

function update() {
		for(var canvasIndex in canvasList) {
        var canvas = canvasList[canvasIndex];
        // 各キャンバスの描画
        draw(canvas, colorList[canvasIndex]);
    }
    // 共通の描画情報の更新
    info.seconds = info.seconds + .014;
    info.t = info.seconds*Math.PI;
    // 自身の再起呼び出し
    setTimeout(update, 35);
}

/**
 * Draw animation function.
 *
 * This function draws one frame of the animation, waits 20ms, and then calls
 * itself again.
 */
function draw(canvas, color) {
		// 対象のcanvasのコンテキストを取得
    var context = canvas.contextCache;
    // キャンバスの描画をクリア
    context.clearRect(0, 0, canvas.width, canvas.height);

    //波を描画 drawWave(canvas, color[数字（波の数を0から数えて指定）], 透過, 波の幅のzoom,波の開始位置の遅れ )
    drawWave(canvas, color[0], 1, 3, 0);//drawWave(canvas, color[0],0.5, 3, 0);とすると透過50%の波が出来る
}

/**
* 波を描画
* drawWave(色, 不透明度, 波の幅のzoom, 波の開始位置の遅れ)
*/
function drawWave(canvas, color, alpha, zoom, delay) {
		var context = canvas.contextCache;
    context.fillStyle = color;//塗りの色
    context.globalAlpha = alpha;
    context.beginPath(); //パスの開始
    drawSine(canvas, info.t / 0.5, zoom, delay);
    context.lineTo(canvas.width + 10, canvas.height); //パスをCanvasの右下へ
    context.lineTo(0, canvas.height); //パスをCanvasの左下へ
    context.closePath() //パスを閉じる
    context.fill(); //波を塗りつぶす
}

/**
 * Function to draw sine
 *
 * The sine curve is drawn in 10px segments starting at the origin.
 * drawSine(時間, 波の幅のzoom, 波の開始位置の遅れ)
 */
function drawSine(canvas, t, zoom, delay) {
    var xAxis = Math.floor(canvas.height/6);
    var yAxis = 0;
    var context = canvas.contextCache;
    // Set the initial x and y, starting at 0,0 and translating to the origin on
    // the canvas.
    var x = t; //時間を横の位置とする
    var y = Math.sin(x)/zoom;
    context.moveTo(yAxis, unit*y+xAxis); //スタート位置にパスを置く

    // Loop to draw segments (横幅の分、波を描画)
    for (i = yAxis; i <= canvas.width + 10; i += 10) {
        x = t+(-yAxis+i)/unit/zoom;
        y = Math.sin(x - delay)/3;
        context.lineTo(i, unit*y+xAxis);
    }
}

init();


$.fn.clickToggle = function (a, b) {
  return this.each(function () {
    var clicked = false;
    $(this).on('click', function () {
      clicked = !clicked;
      if (clicked) {
        return a.apply(this, arguments);
      }
      return b.apply(this, arguments);
    });
  });
};

$(window).on('load resize', function(){
  var winW = $(window).width();
  var devW = 767;
  if (winW <= devW) {
    //767px以下の時の処理
    $('.laptop').attr('src',"image/iphone.png");

  } else {
    //768pxより大きい時の処理
    $('.laptop').attr('src',"image/laptop.png");

  }
});

$('#topBtn').clickToggle(function () {
  // １回目のクリック




}, function () {
  // ２回目のクリック



});


// TextTypingというクラス名がついている子要素（span）を表示から非表示にする定義
function TextTypingAnime() {
	$('.TextTyping').each(function () {
		var elemPos = $(this).offset().top - 50;
		var scroll = $(window).scrollTop();
		var windowHeight = $(window).height();
		var thisChild = "";
		if (scroll >= elemPos - windowHeight) {
			thisChild = $(this).children(); //spanタグを取得
			//spanタグの要素の１つ１つ処理を追加
			thisChild.each(function (i) {
				var time = 200;
				//時差で表示する為にdelayを指定しその時間後にfadeInで表示させる
				$(this).delay(time * i).fadeIn(time);
			});
		} else {
			thisChild = $(this).children();
			thisChild.each(function () {
				$(this).stop(); //delay処理を止める
				$(this).css("display", "none"); //spanタグ非表示
			});
		}
	});
}
// 画面をスクロールをしたら動かしたい場合の記述
$(window).scroll(function () {
	TextTypingAnime();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面をスクロールをしたら動かしたい場合の記述

// 画面が読み込まれたらすぐに動かしたい場合の記述
$(window).on('load', function () {
	//spanタグを追加する
	var element = $(".TextTyping");
	element.each(function () {
		var text = $(this).html();
		var textbox = "";
		text.split('').forEach(function (t) {
			if (t !== " ") {
				textbox += '<span>' + t + '</span>';
			} else {
				textbox += t;
			}
		});
		$(this).html(textbox);

	});

	TextTypingAnime();/* アニメーション用の関数を呼ぶ*/
});// ここまで画面が読み込まれたらすぐに動かしたい場合の記述
