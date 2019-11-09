<?php
$file = fopen('data.csv', 'a+b');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    fputcsv($file, [$_POST['name'], $_POST['comment']]);
    rewind($file);
}

while ($row = fgetcsv($file)) {
    $rows[] = $row;
}

fclose($file);
?>

<!DOCTYPE html>

<html lang="ja">
<head>
<meta charset="utf-8">
<title>掲示板</title>
<link rel="stylesheet" href="stylesheet.css">
<h1>取り消し不可能掲示板</h1>
</head>

<body>
<h1>一度投稿したら取り消せないのでよく考えて投稿しましょう</h1>

<section>
    <h2>新規投稿</h2>
    <form action="" method="post">

		<div class="name"><span class="label">名前:</span><input type="text" name="name" value=""></div>
		
		<div class="text"><span class="label">本文:</span><textarea name="comment" cols="30" rows="4" maxlength="80" wrap="hard" placeholder="投稿してみましょう"></textarea></div>
		
        <input type="submit" value="投稿">
    </form>
</section>

<section class="post">
    <h2>投稿表</h2>
 <?php if (!empty($rows)): ?>
<ul>
<?php foreach ($rows as $row): ?>

  <li><?=$row[1]?> (<?=$row[0]?>)</li>

<?php endforeach; 

?>
</ul>

<?php
 else: 
 ?>
    <p>投稿はまだありません</p>
<?php 

endif;

?>
</section>

</body>
</html>