<?php
session_start();
$mode = 'input';
$errmessage = array();
if( isset($_POST['back']) && $_POST['back'] ){
	// 何もしない
} else if( isset($_POST['confirm']) && $_POST['confirm'] ){
	// 確認画面
	if( !$_POST['fullname'] ) {
		$errmessage[] = "お名前を入力してください";
	} else if( mb_strlen($_POST['fullname']) > 100 ){
		$errmessage[] = "お名前は100文字以内にしてください";
	}
	$_SESSION['fullname']	= htmlspecialchars($_POST['fullname'], ENT_QUOTES);

	if( !$_POST['email'] ) {
		$errmessage[] = "メールアドレスを入力してください";
	} else if( mb_strlen($_POST['email']) > 200 ){
		$errmessage[] = "メールアドレスは200文字以内にしてください";
	} else if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){
		$errmessage[] = "メールアドレスが不正です";
	}
	$_SESSION['email']	= htmlspecialchars($_POST['email'], ENT_QUOTES);

	if( !$_POST['message'] ){
		$errmessage[] = "お問い合わせ内容を入力してください";
	} else if( mb_strlen($_POST['message']) > 500 ){
		$errmessage[] = "お問い合わせ内容は500文字以内にしてください";
	}
	$_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

	if( $errmessage ){
		$mode = 'input';
	} else {
	  $token = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)); // php5のとき
	  //$token = bin2hex(random_bytes(32));                                   // php7以降
	  $_SESSION['token']  = $token;
		$mode = 'confirm';
	}
} else if( isset($_POST['send']) && $_POST['send'] ){
	// 送信ボタンを押したとき
  if( !$_POST['token'] || !$_SESSION['token'] || !$_SESSION['email'] ){
	  $errmessage[] = '不正な処理が行われました';
	  $_SESSION     = array();
	  $mode         = 'input';
  } else if( $_POST['token'] != $_SESSION['token'] ){
    $errmessage[] = '不正な処理が行われました';
    $_SESSION     = array();
    $mode         = 'input';
  } else {
	  $message = "お問い合わせを受け付けました \r\n"
	             . "名前: " . $_SESSION['fullname'] . "\r\n"
	             . "email: " . $_SESSION['email'] . "\r\n"
	             . "お問い合わせ内容:\r\n"
	             . preg_replace( "/\r\n|\r|\n/", "\r\n", $_SESSION['message'] );

							 mb_language("japanese");
							 mb_internal_encoding("UTF-8");
		$header = "From: " .mb_encode_mimeheader("Moweeb") ."<info@moweeb.com>";

	  mail( $_SESSION['email'], 'お問い合わせありがとうございます', $message ,$header);

	  mail( 'tkmt518@gmail.com', 'Moweeb問い合わせ', $message);
	  $_SESSION = array();
	  $mode     = 'send';
  }
} else {
	$_SESSION['fullname'] = "";
	$_SESSION['email']    = "";
	$_SESSION['message']  = "";
}
?>

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="MoweebはあらゆるジャンルのサイトをMotion(動き)を利用して、制作いたします。" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="../image/favicon.ico" type="" />
    <link rel="apple-touch-icon-precomposed" href="../image/icon.png" />
    <title>Moweeb(モウィーブ)</title>
    <link rel="stylesheet" type="text/css" href="../common.css">
    <link rel="stylesheet" type="text/css" href="../reset.css">
    <link rel="stylesheet" type="text/css" href="../index.css">
    <link rel="stylesheet" type="text/css" href="../NotFound/sub-index.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
  </head>
  <body>

    <div class="splash">
    <div class="splash_logo">
  <svg id="maskNotfound" class="mask" data-name="レイヤー 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1773.42 353.15"><defs><style>.cls-1{fill:#231815;}</style></defs><path class="cls-1" d="M764.55,685.14H698V446.76a31.91,31.91,0,0,0-2.67-13,34.71,34.71,0,0,0-7.22-10.6,33.27,33.27,0,0,0-56.92,23.63V685.14H564.35V446.76a33.29,33.29,0,1,0-66.58,0V685.14H431V446.76a98.3,98.3,0,0,1,7.8-39,99.67,99.67,0,0,1,53.31-53.31,100.75,100.75,0,0,1,74.84-1.16,97.17,97.17,0,0,1,31,19.2,99.62,99.62,0,0,1,105.58-18,99.61,99.61,0,0,1,53.3,53.31,98.3,98.3,0,0,1,7.8,39Z" transform="translate(-430.96 -336.65)"/><path class="cls-1" d="M1058.34,558.27a134.32,134.32,0,0,1-10,52A130.41,130.41,0,0,1,1021.09,652a127.44,127.44,0,0,1-40.39,27.7,126.42,126.42,0,0,1-99.17,0,127.65,127.65,0,0,1-67.86-69.37,134.32,134.32,0,0,1-10-52,136.41,136.41,0,0,1,10-52.61A128.74,128.74,0,0,1,841,463.87a127.11,127.11,0,0,1,40.5-27.58,123.4,123.4,0,0,1,49.47-10,130.65,130.65,0,0,1,49.7,9.42,120.29,120.29,0,0,1,40.39,26.78,127,127,0,0,1,27.24,41.67Q1058.34,528.48,1058.34,558.27Zm-64,0a74,74,0,0,0-5-27.82A66.08,66.08,0,0,0,975.7,509a59,59,0,0,0-20.14-13.73,65.61,65.61,0,0,0-49.12,0,57.69,57.69,0,0,0-20,13.73A65.57,65.57,0,0,0,873,530.45a75.8,75.8,0,0,0-4.88,27.82A72.19,72.19,0,0,0,873,585a67.07,67.07,0,0,0,13.39,21.42,62.76,62.76,0,0,0,20,14.32A58.68,58.68,0,0,0,931,626a62.21,62.21,0,0,0,24.56-4.89,61.05,61.05,0,0,0,20.14-13.73A64.41,64.41,0,0,0,989.31,586,74.17,74.17,0,0,0,994.32,558.27Z" transform="translate(-430.96 -336.65)"/><path class="cls-1" d="M1408.23,595.05a92.6,92.6,0,0,1-7.45,36.9,94.64,94.64,0,0,1-20.37,30.15,97.1,97.1,0,0,1-30.27,20.25A93.18,93.18,0,0,1,1313,689.8a95.22,95.22,0,0,1-34-6.17,93.9,93.9,0,0,1-29.57-18,91.52,91.52,0,0,1-29.21,18,95,95,0,0,1-34.11,6.17,92.32,92.32,0,0,1-37-7.45A97.25,97.25,0,0,1,1119,662.1,94.64,94.64,0,0,1,1098.61,632a92.42,92.42,0,0,1-7.45-36.9V436.29h63.55V595.05a30.66,30.66,0,0,0,2.45,12.22A31.62,31.62,0,0,0,1173.92,624a30.66,30.66,0,0,0,12.22,2.45,31.56,31.56,0,0,0,12.34-2.45,32.35,32.35,0,0,0,10.24-6.75,30.63,30.63,0,0,0,9.31-22.23V436.29h63.32V595.05a29.58,29.58,0,0,0,2.56,12.22,33.29,33.29,0,0,0,6.87,10,31.35,31.35,0,0,0,10,6.75,30.69,30.69,0,0,0,12.22,2.45,31.53,31.53,0,0,0,12.34-2.45,31.11,31.11,0,0,0,10.13-6.75,33.29,33.29,0,0,0,6.87-10,29.58,29.58,0,0,0,2.56-12.22V436.29h63.32Z" transform="translate(-430.96 -336.65)"/><path class="cls-1" d="M1553.49,624.15a35.7,35.7,0,0,0,7.45,1.51c2.48.24,5,.35,7.45.35a62.46,62.46,0,0,0,17.92-2.56,64.56,64.56,0,0,0,16.18-7.33,60.1,60.1,0,0,0,13.5-11.64,61,61,0,0,0,9.66-15.25L1672.21,636a125,125,0,0,1-20.37,22.58,128.2,128.2,0,0,1-24.91,17,124.45,124.45,0,0,1-28.16,10.59,128,128,0,0,1-30.38,3.61,125.88,125.88,0,0,1-90-37,127.8,127.8,0,0,1-27.35-41.55q-10-24.09-10-53,0-29.57,10-54a122,122,0,0,1,67.86-68.44,128.6,128.6,0,0,1,49.47-9.54,125.4,125.4,0,0,1,30.49,3.72,127.58,127.58,0,0,1,53.31,27.82,126.51,126.51,0,0,1,20.49,22.7Zm32.59-131.06a36.94,36.94,0,0,0-8.73-2.1,83.52,83.52,0,0,0-9-.46,63.53,63.53,0,0,0-24.56,4.77,58.37,58.37,0,0,0-20,13.62,64.19,64.19,0,0,0-13.39,21.3,76.24,76.24,0,0,0-4.89,28q0,3.5.35,7.92c.24,2.94.62,5.93,1.17,9s1.2,5.93,2,8.73a32.3,32.3,0,0,0,3,7.45Z" transform="translate(-430.96 -336.65)"/><path class="cls-1" d="M1803.74,624.15a35.83,35.83,0,0,0,7.45,1.51c2.48.24,5,.35,7.45.35a62.53,62.53,0,0,0,17.93-2.56,64.49,64.49,0,0,0,16.17-7.33,60.15,60.15,0,0,0,13.51-11.64,61.57,61.57,0,0,0,9.66-15.25L1922.47,636a125.41,125.41,0,0,1-20.37,22.58,128.5,128.5,0,0,1-24.91,17A124.7,124.7,0,0,1,1849,686.19a128,128,0,0,1-30.38,3.61,125.83,125.83,0,0,1-90-37,127.66,127.66,0,0,1-27.36-41.55q-10-24.09-10-53,0-29.57,10-54a122.09,122.09,0,0,1,67.86-68.44,128.6,128.6,0,0,1,49.47-9.54,125.48,125.48,0,0,1,30.5,3.72,127.74,127.74,0,0,1,53.31,27.82,126.84,126.84,0,0,1,20.48,22.7Zm32.59-131.06a36.94,36.94,0,0,0-8.73-2.1,83.52,83.52,0,0,0-9-.46,63.57,63.57,0,0,0-24.56,4.77,58.37,58.37,0,0,0-20,13.62,64.19,64.19,0,0,0-13.39,21.3,76.45,76.45,0,0,0-4.88,28c0,2.33.11,5,.35,7.92a89,89,0,0,0,1.16,9q.81,4.53,2,8.73a32.3,32.3,0,0,0,3,7.45Z" transform="translate(-430.96 -336.65)"/><path class="cls-1" d="M2204.38,558.27q0,29.34-10,53.54a127.06,127.06,0,0,1-27.24,41.56,121.51,121.51,0,0,1-40.39,26.88,129,129,0,0,1-49.7,9.55,125.83,125.83,0,0,1-90-37,127.66,127.66,0,0,1-27.36-41.55q-10-24.09-10-53V336.65h63.79v116.4a57.59,57.59,0,0,1,12.45-11.64,73.71,73.71,0,0,1,15.83-8.38,104.7,104.7,0,0,1,17.58-5,93.88,93.88,0,0,1,17.69-1.74,125.28,125.28,0,0,1,49.7,9.89,123.4,123.4,0,0,1,40.39,27.59,131.52,131.52,0,0,1,27.24,41.78Q2204.38,529.65,2204.38,558.27Zm-64,0a71.61,71.61,0,0,0-5-26.89,67.54,67.54,0,0,0-13.62-21.53,62.52,62.52,0,0,0-20.14-14.2,59.85,59.85,0,0,0-24.56-5.12,54.65,54.65,0,0,0-24.56,5.7,68,68,0,0,0-20.14,15.13,70.83,70.83,0,0,0-13.5,21.65,67.42,67.42,0,0,0-4.89,25.26,72,72,0,0,0,4.89,26.77,66.14,66.14,0,0,0,13.5,21.42,64.16,64.16,0,0,0,20.14,14.32,60.28,60.28,0,0,0,49.12,0,64.28,64.28,0,0,0,20.14-14.32A67.8,67.8,0,0,0,2135.36,585,70.65,70.65,0,0,0,2140.36,558.27Z" transform="translate(-430.96 -336.65)"/></svg>
    </div>
    </div>

  <div class="container">
    <div class="openbtn"><span></span><span></span><span></span></div>
    <nav id="g-nav" class="g-nav">
    <div id="g-nav-list" class="g-nav-list"><!--ナビの数が増えた場合縦スクロールするためのdiv※不要なら削除-->
    <ul>
    <li><a href="../index.html" class="menu-item"><span>Top</span></a></li>
    <!-- <li><a href="../NotFound/index.html" class="menu-item"><span>About</span></a></li> -->
    <li><a href="../Service/index.html" class="menu-item"><span>Service</span></a></li>
    <li><a href="../Menu/index.html" class="menu-item"><span>Menu</span></a></li>
    <li><a href="../Works/index.html" class="menu-item"><span>Works</span></a></li>
    <li><a href="index.php" class="menu-item currentPage"><span>Contact</span></a></li>
    </ul>
    </div>
    </nav>
    <div class="circle-bg"></div>

    <div class="sub-top">
      <div class="top-bar">
        <div class="logo-div">
        <a href="../index.html">
          <img src="../image/logo-yoko.png" alt="" class="logo">
          <p>Motion × Web</p>
        </a>
      </div>

      <div class="menu">
        <ul class="menu-ul">
          <a href="../index.html">
          <div class="menu-item">
            <li class="menu-item-l"><span>TOP</span></li>
            <li class="menu-item-s"><span>トップ</span></li>
          </div>
          </a>
          <!-- <a href="../NotFound/index.html">
          <div class="menu-item">
            <li class="menu-item-l"><span>ABOUT</span></li>
            <li class="menu-item-s"><span>Moweebについて</span></li>
          </div>
          </a> -->
          <a href="../Service/index.html">
          <div class="menu-item">
            <li class="menu-item-l"><span>SERVICE</span></li>
            <li class="menu-item-s"><span>サービス内容</span></li>
          </div>
          </a>
          <a href="../Menu/index.html">
          <div class="menu-item">
            <li class="menu-item-l"><span>MENU</span></li>
            <li class="menu-item-s"><span>価格表</span></li>
          </div>
          </a>
          <a href="../Works/index.html">
          <div class="menu-item">
            <li class="menu-item-l"><span>WORKS</span></li>
            <li class="menu-item-s"><span>制作事例</span></li>
          </div>
          </a>
          <a href="index.php">
          <div class="menu-item currentPage">
            <li class="menu-item-l"><span>CONTACT</span></li>
            <li class="menu-item-s"><span>連絡先</span></li>
          </div>
          </a>
       </ul>
      </div>
      </div>

      <div class="sub-top-text">
        <h1>Contact</h1>
        <p>連絡先</p>
      </div>
    </div>
    <div class="wave">
      <canvas id="waveCanvas" class="canvas"></canvas>
    </div>

    <div class="sub-body">
      <div class="contact-body">

        <?php if( $mode == 'input' ){ ?>
    		  <!-- 入力画面 -->

        <form action="./index.php" method="post">

        <div class="input-name contact-contents">
          <h2 class="required-h2">お名前</h2>
          <input type="text" name="fullname" value="<?php echo $_SESSION['fullname'] ?>" class="m-form-text"  />
        </div>

        <div class="input-mail contact-contents">
          <h2 class="required-h2">メールアドレス</h2>
          <input type="text" name="email" value="<?php echo $_SESSION['email'] ?>" class="m-form-text" />
        </div>
        <!-- <div class="input-name contact-contents">
          <h2>御社様名</h2>
          <input type="text" name="incName" value="" class="m-form-text" />
        </div> -->
        <div class="textarea contact-contents">
          <h2 class="required-h2">お問い合わせ内容</h2>
          <textarea name="message" class="m-form-textarea"><?php echo $_SESSION['message'] ?></textarea>
        </div>

          <?php
          if( $errmessage ){
            echo '<div class="alert alert-danger" role="alert">';
            echo implode('<br>', $errmessage );
            echo '</div>';
          }
          ?>


        <input type="submit" name="confirm" value="確認" class="form-submit-button">

        </form>

      <?php } else if( $mode == 'confirm' ){ ?>
        <!-- 確認画面 -->
        <form action="./index.php" method="post">
          <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
          <h2 class="form-confirm-h2">名前</h2> <br>
          <h2><?php echo $_SESSION['fullname'] ?></h2> <br>
          <h2 class="form-confirm-h2">Eメール</h2><br>
          <h2><?php echo $_SESSION['email'] ?></h2> <br>
          <h2 class="form-confirm-h2">お問い合わせ内容</h2><br>
          <h2><?php echo nl2br($_SESSION['message']) ?></h2><br>
          <input type="submit" name="back" value="戻る" class="form-submit-button form-submit-button-second"/>
          <input type="submit" name="send" value="送信" class="form-submit-button form-submit-button-second"/>
        </form>
      <?php } else { ?>
        <!-- 完了画面 -->
        <h2 class="form-complete-h">送信しました。お問い合わせありがとうございました。</h2><br>
      <?php } ?>

      </div>


    </div>

    <footer>
    <div class="footer">

    <div class="footer-svg">
      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <defs>
      <filter id="top-function-wave-top" x="0" y="0" width="1978.503" height="255" filterUnits="userSpaceOnUse">
        <feOffset dy="-10" input="SourceAlpha"/>
        <feGaussianBlur stdDeviation="1" result="blur"/>
        <feFlood flood-opacity="0.161"/>
        <feComposite operator="in" in2="blur"/>
        <feComposite in="SourceGraphic"/>
      </filter>
      </defs>
      <g id="グループ_2" data-name="グループ 2">
      <g id="top-function-wave-top-2" data-name="top-function-wave-top" transform="translate(-0.497)">
        <g transform="matrix(1, 0, 0, 1, -3, -13)" >
          <path id="top-function-wave-top-3" data-name="top-function-wave-top" d="M0,275.75l109.583-25.24C219.167,225.648,438.334,174.6,657.5,159.76c219.167-15.409,438.334,5.388,657.5-5.01s438.334-50.1,547.917-70.615L1972.5,64V306H0Z" transform="translate(3 -51)" fill="var(--main-color)"/>
        </g>
      </g>
      </g>
      <rect id="長方形_6" data-name="長方形 6" width="1973" height="325" transform="translate(0 239)" fill="var(--main-color)"/>
      </svg>
    </div>

    <div class="F-content">

    <div class="F-leftside">
      <div class="en-row">
        <a href="../index.html"><div class="en-row-content">TOP</div></a>
        <!-- <a href="../NotFound/index.html"><div class="en-row-content">ABOUT</div></a> -->
        <a href="../Service/index.html"><div class="en-row-content">SERVICE</div></a>
        <a href="../Menu/index.html"><div class="en-row-content">WORKS</div></a>
        <a href="../Works/index.html"><div class="en-row-content">MENU</div></a>
        <a href="index.php"><div class="en-row-content currentPage">CONTACT</div></a>
      </div>
      <div class="ja-row">
        <a href="../index.html"><div class="ja-row-content">トップ</div></a>
        <!-- <a href="../NotFound/index.html"><div class="ja-row-content">Moweebについて</div></a> -->
        <a href="../Service/index.html"><div class="ja-row-content">サービス</div></a>
        <a href="../Menu/index.html"><div class="ja-row-content">制作事例</div></a>
        <a href="../Works/index.html"><div class="ja-row-content">価格表</div></a>
        <a href="index.php"><div class="ja-row-content currentPage">連絡先</div></a>
      </div>
    </div>

    <div class="F-rightside">
      <div class="F-logo">
        <a href="../index.html">
          <!-- <img src="../image/logo-white.png" alt=""> -->
          <img src="../image/logo-yoko-white.png" alt="" class="logo-white">
        </a>
      </div>
      <div class="F-mail">
        <p>info@moweeb.com</p>
      </div>
      <div class="F-copyright">
        <p>2021 Moweeb.com</p>
      </div>
    </div>

  </div>

  </div>
</footer>
</div>
<script src="https://cdn.jsdelivr.net/npm/focus-visible@5.2.0/dist/focus-visible.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vivus/0.4.4/vivus.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
    <script src="../index.js"></script>
    <script src="index.js"></script>
  </body>
</html>
