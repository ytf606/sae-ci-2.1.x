<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>微博接口测试</title>
</head>

<body>
	<?=$user_message['screen_name']?>,您好！
	<h2 align = "left">发送微博</h2>
	<form action ="">
		<input type="text" name="text" style="width:300px">
		<input type="submit">
	</form>
	<?php if(is_array($ms['statuses'])):?>
		<?php foreach($ms['statuses'] as $item):?>
			<div style="padding:10px;margin:5px;border:1px solid #ccc">
				<?=$item['text']?>
			</div>
		<?php endforeach;?>
	<?php endif;?>
</body>
</html>
