<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_5-01</title>
</head>
<body>
<?php

    $dsn = 'データベース名';
	$user = 'ユーザー名';
	$password = 'パスワード';
	$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
	$sql = "CREATE TABLE IF NOT EXISTS gundam"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
	.");";
	$stmt = $pdo->query($sql);
	$time = date("Y/m/d H:i:s");



    if(isset($_POST['submit'])){
        $pass= $_POST['password'];
    $sql = $pdo -> prepare("INSERT INTO tbtest (name, comment) VALUES (:name, :comment)");
	$sql -> bindParam(':name',    $name,    PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	$name    = ($_POST['name']);
	$comment = ($_POST['comment']); //好きな名前、好きな言葉は自分で決めること
	if($name!="" && $comment!="" && $pass=="0611"){
	$sql -> execute();
   
    $sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $time. "<br>";
	    echo "<hr>";
	   }
    }
}
          
    if(isset($_POST['delete'])){
        $dpass=$_POST['dpassword'];
        if( $dpass=="0611")          {
        $id  = $_POST['del_num']; ;
	    $sql = 'delete from tbtest where id=:id';
     	$stmt = $pdo->prepare($sql);
	    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	    $stmt->execute();
	    
	    $sql = 'SELECT * FROM tbtest';
     	$stmt = $pdo->query($sql);
	    $results = $stmt->fetchAll();
	    foreach ($results as $row)         {	    //$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $time."<br>";
	    echo "<hr>";
	}
  }
}
        
                   
    if(isset($_POST['edit'])){
        $epass=$_POST['epassword'];
        if($epass=="0611")         {
    $id      = ($_POST['number']); //変更する投稿番号
	$name    = ($_POST['ename']);
	$comment = ($_POST['ecomment']); //変更したい名前、変更したいコメントは自分で決めること
	$sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
   
      $sql = 'SELECT * FROM tbtest';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['comment'].',';
		echo $time."<br>";
	echo "<hr>";
	      }    
        }
      }
?>
    <form action="" method="post">
        <!--投稿フォーム-->
        <input type="text" name="name" placeholder="名前">
         <input type="text" name="comment" placeholder="コメント"> 
         <input type="text" name="password" placeholder="パスワード"> 
        <input type="submit" name="submit">
        
    </form>
     
    <form action="" method="POST">  
        <!--削除ボタン-->
        <input type="text" name="del_num" placeholder="削除"> 
        <input type="text" name="dpassword" placeholder="パスワード"> 
        <input type="submit" name="delete"><br>
    </form>
     <form action="" method="POST">  
        <!--編集ボタン-->
        <input type="number" name="number" placeholder="編集番号">
        <input type="text" name="ename" placeholder="編集後の名前"> 
        <input type="text" name="ecomment" placeholder="編集後のコメント"> 
        <input type="text" name="epassword" placeholder="パスワード"> <br>
        <input type="submit" name="edit">
        
    </form>  
    </body>