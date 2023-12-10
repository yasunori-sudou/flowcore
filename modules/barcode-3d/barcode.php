<?php
if (isset($_POST['qrtext'])) {
	$qrtext = $_POST['qrtext'];
}else{
	$qrtext = $_POST['qrtext'];
}

?>
<html>

  <head>
    <meta charset="UTF-8">
    <title>LINEテスト</title>
    <meta name="description" content="このページの概要を書く">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
	<p>URLやテキストなど</p>
	<form action="" method="POST">
		<input type="text" name="qrtext" value="<?php echo $qrtext; ?>"/>
		<input type="submit" value="送信" />
	</form>
	<?php
	if (!empty($qrtext)) {
		?><img src="php/qr_img.php?d=<?php echo $qrtext; ?>"><?php
	}
	?>
	<input type=button name=print value="印刷ボタン" onClick="javascript:window.print()">
  </body>
</html>