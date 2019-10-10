<?php 
 session_start();
 require_once('dbconnect.php');

//ログイン処理から入ったユーザーへの実行
 if(isset($_SESSION['id']) && _SESSION['time'] + 3600 > time()) {
     $_SESSION['time'] = time();
     
     $members = $db->prepare('SELECT * FROM members WHERE id=?');
     $members->execute(array($_SESSION['id']));
     $member = $members->fetch();
 } else {
     header('Location: join/login.php');
     exit();
 }

 if (!empty($_POST['send_btn'])) {
     $word = $db->prepare('INSERT INTO eng_word SET word=?, created=time() , name=?');
     $word->execute(array(
      $_POST['word'],
      SESSION['name'],
      ));
     
     function PrintWord(){
         $post_word = $db->prepare('SELECT created FROM eng_word WHERE name=?');
         $post_word->execute(array(
          SESSION['name'];
         ));
         $time_word = $post_word->fetch();//入力した単語のタイムスタンプ1件
         $posttime_word = $time_word + 43200;
         $now_time = time();
         
         if($posttime_word < $now_time) {
            $word = $db->prepare('SELECT word FROM eng_word WHERE name=?');
             $word =->execute(array(
              SESSION['name']
             ));
             $words = $word->fetchAll();
         }
        
     }
 }
?>
<!DOCTYP html>
<html lang="ja">
 <head>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui" charset="utf-8">
     <title>ENGLISH+</title>
    </head>
    <body>
        <form action="" method="post">
         <input type="text" name="word" size="60" maxlength="100" placeholder="単語を入力">
            <input type="submit" name="send_btn" value="明日へ保存">
        </form>
        
        <span>
         <?php  PrintWord() ?>
        </span>
    </body>
</html>