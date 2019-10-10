<?php
 session_start();
  require('../dbconnect.php');

 if ($_COOKIE['email'] !== '') {
     $email = $_COOKIE['email'];
 }
  
 if (!empty($_POST)) { //なんらかのＰＯＳＴ送信を受け取った時
     $email = $_POST['email'];
     
     if ($_POST['name'] !== "" && $_POST['email'] !== "" && $_POST['password'] !== "") {//フォームのメルアド欄とパスワード欄が空ではない時
         $login = $db->prepare('SELECT * FROM lolmembers WHERE name=? AND email=? AND password=?');
         $login->execute(array( //フォームに入力されPOST送信されたメルアド、パスワードに一致するものをSELECTする
         $_POST['name'],
         $_POST['email'],
         sha1($_POST['password'])
         ));
       $member = $login->fetch();//抽出結果
         
      if ($member) { //変数$memberに何らかの値が格納されていると
          $_SESSION['id'] = $member['id']; //セッション[id]と[time]に値を与える
          $_SESSION['time'] = time();
          $_SESSION['name'] = $member['name'];
          
          if ($_POST['save'] === 'on') {
              setcookie('email', $_POST['email'], time()+60*60*24*14);//14日後まで$_POST[email]の値をcookie[email]にセット 
          }
          
          header('Location: home.php');
          exit();
      } else {
          $error['login'] = 'failed';
       }
      }else {
         $error['login'] = 'blank';
     }
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>ＥＮＧＬＩＳＨ　＋</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<title>ログインする</title>
</head>

<body>
<div id="wrap">
  <div id="head">
    <h1>ログインする</h1>
  </div>
  <div id="content">
    <div id="lead">
      <p>名前とパスワードを記入してログインしてください。</p>
      <p>入会手続きがまだの方はこちらからどうぞ。</p>
      <p>&raquo;<a href="join/">入会手続きをする</a></p>
    </div>
    <form action="" method="post">
      <dl>
          <dt>名前</dt>
        <dd>
          <input type="text" name="name" size="35" maxlength="255" value="<?php  print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>" />
            <?php if ($error['login'] === 'blank'): ?>
             <p class="error">* 名前とメールアドレスとパスワードをご記入ください</p>
            <?php  endif; ?>
            <?php if ($error['login'] === 'failed'): ?>
              <p class="error">ログインに失敗しました。正しくご記入ください</p>
             <?php endif ?>
        </dd>
          
        <dt>パスワード</dt>
        <dd>
          <input type="password" name="password" size="35" maxlength="255" value="<?php print (htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>" />
        </dd>
        <dt>ログイン情報の記録</dt>
        <dd>
          <input id="save" type="checkbox" name="save" value="on">
          <label for="save">次回からは自動的にログインする</label>
        </dd>
      </dl>
      <div>
        <input type="submit" value="ログインする" />
      </div>
    </form>
  </div>
</div>
</body>
</html>
