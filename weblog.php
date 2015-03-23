<!DOCTYPE html>
<?php 
	$md_file_id = isset($_GET['fid']) ? strip_tags(mysql_escape_string($_GET['fid'])) : '';
	$pos = strpos($md_file_id, '_');
	if ($md_file_id == '' || $pos === false ) {
		//to 404 TODO
		echo '404';
		return;
	}
	$md_file_id = 'md/' . substr_replace($md_file_id, '/', $pos, 1);
	
	//file is exist or not
	if (! file_exists($md_file_id)) {
		//to 404 TODO
		echo '404';
		return;
	}
	$md_file = file_get_contents($md_file_id);
	include_once ('inc/Parsedown.php');
	$Parsedown = new Parsedown();
	$md_file = $Parsedown->text($md_file);
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
		<title></title>
	</head>
	<body>
		<div id="container" class="typo typo-selection">
			<div id="header">
				<div id="post-nav">
					<a href="/">首页</a>&nbsp;»&nbsp;<a href="/201503.html">201503</a>&nbsp;»&nbsp;<?php echo $md_file_id;?>
				</div>
			</div>
			<div class="clearfix"></div>
			<div id="title"><?php echo $md_file_id;?></div>
			
			<div id="content" class="typo typo-selection">
				<?php echo $md_file; ?>
			</div>
			<script type="text/javascript">
			//1.generate toc
			$('#title').after('<ol id="toc_table" class="toc"></div>');
			var toc_table = $('#toc_table');
			var head2 = $('h2');
			if (head2 && head2.length >= 2) {
				for (var i = 0; i < head2.length; i++) {
					$(head2[i]).attr('id', 'section-' + (i + 1));
					toc_table.append('<li><a href="#section-'+ (i + 1) +'">' + $(head2[i]).html() + '</a>');
				};
			}
			else {
				toc_table.remove();
			}
			//2. title
			$('head title').html($('h1:first').html() + "| Markdown-Weblog");
			$('#title').html($('h1:first').html());
			$('h1:first').remove();
			</script>
		</div>
		<div id="footer">
			<span>Copyright © 2015 Markdown-Weblog.</span>
		</div>
			<!--<ol id="toc_table">
				<li><a href="http://typo.sofi.sh/#section1">关于 <i class="serif">Typo.css</i></a></li>
				<li><a href="http://typo.sofi.sh/#section2">排版实例</a>
					<ul>
						<li><a href="http://typo.sofi.sh/#section2-1">例1：论语学而篇第一</a></li>
						<li><a href="http://typo.sofi.sh/#section2-2">例2：英文排版</a></li>
					</ul>
				</li>
				<li><a href="http://typo.sofi.sh/#section3">附录</a>
					<ul>
						<li><a href="./Typo.css - 中文网页重设与排版_files/Typo.css - 中文网页重设与排版.html"><i class="serif">Typo.css</i> 排版偏重点</a></li>
						<li><a href="http://typo.sofi.sh/#appendix2">开源许可</a></li>
					</ul>
				</li>
			</ol>-->
	</body>
</html>