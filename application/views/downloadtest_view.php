<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>Gallery Testing</title>
</head>
<body>
<div id="wrap">

<div id="gallery">

<?php
echo "<ul";

$filearray = array();
if ($fil = opendir("images/attendance/")) {
    while (($file = readdir($fil)) !== false) {
        if ($file != "." && $file != ".."){
            $filearray[] = $file;
            $page = empty($_GET['page']) ? 1 : $_GET['page'];
            $num_per_page = 10;
            $total_pages = ceil(count($filearray)/$num_per_page);

        }
    }
for($i = ($page - 1) * $num_per_page; $i < $page * $num_per_page; $i++)
{?>
><li><a href="images/attendance/<?php echo $filearray[$i]; ?>"><img src="images/attendance/<?php echo $filearray[$i]; ?>" width="150" height="113" alt="<?php echo $filearray[$i]; ?>" /></a></li
<?php }
closedir($fil);
echo "></ul>";
    $pages = array();
        for($i = 1; $i <= $total_pages; $i++) {
            $pages[] = "<a href=\"".$_SERVER['PHP_SELF']."?page=".$i."\">".$i."</a>";
        }
    echo "Page: ".implode(" ", $pages);
    }
?>
<br />
</div>
</div>
</body>
</html>