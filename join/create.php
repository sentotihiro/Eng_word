<?php
    session_start();
    require_once('../dbconnect.php');

  if(!empty($_POST)) {
      if ($_POST['name'] === '') {
          $error['name'] = 'blank';
      }
      
      if (strlen($_POST['pass']) < 5) {
          $error['pass'] = 'length';
      }
      
      if ($_POST['pass'] = '') {
          $error['pass'] = 'blank';
      }
  
    
      //ユーザー情報のinsert
      if (empty($error)) {
          //$_SESSION['join'] = $_POST;仮想配列となって各dataが渡される
          header('Location: ../main.php');
          exit;
      }
  }
?>
<!DOCTYPE html>
<html lang="ja">
 <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" charset="utf-8">
     <title>アカウント登録</title>
    </head>
    <body>
     <div id="wrap">
     <p>次のフォームにて名前とパスワードを設定しましょう。</p>
         <!----d definition 定義  dl list  dt title   dd description ---->
      
     <form action="../main.php" id="user_data" method="post" enctype="multipart/form-data">
         <input type="hidden" name="action" value="sub" />
      <dl>
          
         <dt>名前<span class="required">※必須</span></dt>
          <dd>
           <input type="text" name="name" size="49" maxlength="255" value="<?php print(htmlspecialchars($_POST['name'], ENT_QUOTES)); ?>">
              <?php if ($error['name'] === 'blank'): ?>
            <p class="error">* 名前を入力してください</p>
            <?php endif; ?>
          </dd>
          
          <dt>パスワードを設定してください<span class="required">※必須</span></dt>
          <dd>
           <input type="password" name="pass" size="49" maxlength="255" value="<?php print(htmlspecialchars($_POST['password'], ENT_QUOTES)); ?>">
              
              <?php if ($error['password'] === 'length'): ?>
          <p class="error">* パスワードは4文字以上で入力してください</p>
            <?php endif; ?>
            
            <?php if ($error['password'] === 'blank'): ?>
          <p class="error">* パスワードを入力してください</p>
            <?php endif; ?>
          </dd>
         </dl>
         
         <input type="submit" value="登録内容を送信する" />
        </form>
        </div>
    </body>
</html>