<html>
<head>

<?php
	function page_title($url) {
        		$fp = file_get_contents($url);
        		if (!$fp) 
            			return null;

        		$res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
        			
			if (!$res) 
            			return null; 

        		// Clean up title: remove EOL's and excessive whitespace.
        		$title = preg_replace('/\s+/', ' ', $title_matches[1]);
        		$title = trim($title);
        		return $title;
    			}
	
	
	$q = $_GET['q'];
	$tp = $_GET['topk'];

	
    echo "<title>".$q." | PerluCARI</title>";

?>

        <title>PerluCARI.com</title>
        <link href="./style.css" rel="stylesheet" type="text/css">
        <link href="/~mshuha/font/font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
        <script src="js/jquery-git2.js"></script>

        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">

        <!-- Custom Theme files -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
        <!-- Custom Theme files -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <!--Google Fonts-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        
        <link href="/style/css/bootstrap.css" rel="stylesheet">
        <link href="/style/css/customhasil.css" rel="stylesheet">
        <link href="/style/css/coderay.css" rel="stylesheet">
        <!--<link href="/css/grid.css" rel="stylesheet">-->

        <script type="text/javascript" src="/style/js/jquery.js"></script>
        <script type="text/javascript" src="/style/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/style/js/modernizr-latest.js"></script>

    </head>

<body>
<header>
    <div id="logo-header">
        <a href="localhost/ProjekPI/"><img src="./images/logo3.png" class="img-reponsive"></a>
    </div>
    <div id="search">
        <form action="./exec.php" method="GET">
            <input type="text" name="q" id="q" class="input-search" value="<?php echo $q?>" onFocus="blank(this)" onBlur="unblank(this)"/>
            <select class="select" name="topk">
            <option value="10" selected="selected">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option></select>
            <button type="submit" class="tombol-search"><i class="fa fa-search" style="font-size:20px"></i></button>

            <div class="clear"></div>
      </form>
    </div>
<div class="clear"></div>
</header>

<div class="isi">

<?php

if($q==''){
    header( "Location: http://cs.unsyiah.ac.id/~mchsan/PI/" );
}
?>

<?php
  
  $q=strtolower($q);
  $start1=microtime(true);
  exec("./querydb '$q' '$tp'", $data);
  $stop1=microtime(true);
  $time1 = (round(($stop1-$start1)*100,5)/100);
  $jumlah = count($data);
  $a = $data[0];
  $b = (explode(".",$a));


  echo "<h3>Hasil Pencarian</h3><br> ".$b[0]." hasil ditemukan (".$time1." detik)<br><br>";
  for($i = 1; $i < $jumlah-1 && $i<=$b[0] && $i<=$tp; $i++) {
    $temp = (explode("\t", $data[$i]));
    $myfile = fopen("./data/".$temp[1], "r") or die("");
        $isi = fread($myfile,500);
        fclose($myfile);
    $judul = page_title("./data/".$temp[1]);
                echo "<a style='font-size:18;color:#0B1DA0;' href=data/".$temp[1].">".$judul."</a>";
                echo "<p style='font-size:14;color:#1da750;'>data/".$temp[1]."</p>";
    echo $isi."...";
    echo "<br><br>";
   }
  
?>


</div>


</body>
</html>
