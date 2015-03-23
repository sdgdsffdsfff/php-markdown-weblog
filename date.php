<!DOCTYPE html>
<?php 
	$date = isset($_GET['date']) ? strip_tags(mysql_escape_string($_GET['date'])) : '';
	$md_file_id = 'md/' . $date;
	$weblogs = array();
	if(is_dir($md_file_id)) {
		$fp = opendir($md_file_id);
		while(!false == ($fn = readdir($fp))) {
			if($fn == '.' || $fn =='..' || is_dir($md_file_id.DIRECTORY_SEPARATOR.$fn)) {
				continue;
			}
			$weblogs[] = array('url' => '/' . $date . '/' . substr($fn, 0, strpos($fn, '.')) . '.html', 'title' => $fn);
		}
	}
	else{
		//to 404;
		echo '404';
		return;
	}
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta charset="utf-8" />
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, minimal-ui" />

		<link rel="stylesheet" href="/res/css/typo.css" />
		<link rel="stylesheet" href="/res/css/style.css" />
		<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.6/jquery.min.js"></script>
		<title><?php echo $date;?> - 文章列表 | Markdown-Weblog</title>
		<style>
			
		</style>
	</head>

	<body>
		<div id="container" class="typo typo-selection">
			<div id="header">
				<div id="post-nav">
					<a href="/">首页</a>&nbsp;»&nbsp;<a href="/<?php echo $date;?>.html"><?php echo $date;?></a>&nbsp;»&nbsp;文章列表
				</div>
			</div>
			<div class="clearfix"></div>
			<div id="title"></div>
			
			<div id="content" class="typo typo-selection">
				<h1><?php echo $date; ?> - 文章列表</h1>
				<h2>列表如下</h2>
				<?php 
					echo "<ol>";
					foreach ($weblogs as $i => $weblog) {
						echo "<li><a href='".$weblog['url']."'>".$weblog['title']."</a></li>";
					}
					echo "</ol>";
				?>
			</div>
			<script type="text/javascript">
			//2 title
			$('head title').html($('h1:first').html() + "| Markdown-Weblog");
			$('#title').html($('h1:first').html());
			$('h1:first').remove();
			</script>
		</div>
		<div id="footer">
			<span>Copyright © 2015 Markdown-Weblog.</span>
		</div>
	</body>
</html>