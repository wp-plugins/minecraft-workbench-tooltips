<?php

include('simple_html_dom.php');

$tag = $_GET['tag'];

$filename = getcwd() . "/cache/" . $tag;

if (file_exists($filename)) {
   $lastmoddate = filemtime($filename);
} else {
   $fh = fopen($filename, 'w') or die("can't open file");
   fclose($fh);
   $lastmoddate = time() - 172800;
}

if ($lastmoddate < (time() - 86400)) {
    $html = file_get_html('http://minecraftwb.com/index.php/game-database/'.str_replace("_","/", $tag));
    $htmlcode = str_replace("<h3>Description</h3>","<br clear='all'/><br/>",$htmlcode);

    foreach($html->find('div.floatbox') as $e) {
	$htmlcode = $e->innertext;
       	$snippet = "<div class='mcwbtooltip'><div class='mcwbpadder'>" . $htmlcode . "</div></div>";
    }

    $imgcount = 1;
    $htmlcode2 = str_get_html($snippet);
    foreach($htmlcode2->find('img') as $f) {
		$img = $f->src;
		$imgname = $tag . $imgcount . ".png";
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $img);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$contents = curl_exec ($ch);
		curl_close ($ch);

		$imgdiskname = getcwd() . "/cache/" . $imgname;

		$fh = fopen($imgdiskname, 'w') or die("can't open file");
		fwrite($fh, $contents);
		fclose($fh);
		
		$imgcount++;
		$snippet = str_replace($img, "/wp-content/plugins/minecraft-workbench-tooltips/cache/".$imgname, $snippet);
	}

    $fh = fopen($filename, 'w') or die("can't open file");
    fwrite($fh, $snippet);
    fclose($fh);

    $output = $snippet;
} else {
     
    $output = file_get_contents($filename) ;
 
}

echo($output);
?>
