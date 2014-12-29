<?php
/*
Template Name: Thoi khoa bieu
*/
?>
<html>
<head>
<meta charset="utf-8">
<title>Thời khoá biểu</title>
<link media="screen" rel="stylesheet" type="text/css" href="mystyle.css"/>
</head>
<body>

<div id="primary">
<div id="content" role="main">

    <div id="content" class="clearfix">

        <div id="main" class="col620 clearfix" role="main"> <div id="viencach">
<?php
require("config.php");
$BUOI = ["","BU&#7892;I S&#193;NG","BU&#7892;I CHI&#7872;U","BU&#7892;I T&#7888;I"];
$tuan=0;
if (isset($_GET['tuan'])) {
	$tuan=intval($_GET['tuan']);
} 
else {
	$sql="select * from ngayapdung order by tuan desc ;";
	$ret = mysqli_query($link,$sql);
	if ($ret) {
		echo "<div id='dstkb'>";
		while ($row=mysqli_fetch_array($ret)) {
			echo "<div><a href='?tuan=".$row['tuan']."'>Thời khoá biểu tuần ".$row['tuan']." (Áp dụng từ ngày ".$row['ngay'].")</a></div>";
		}
		echo "</div>";
	}
	exit();
}
$sql="select * from ngayapdung where tuan=$tuan;";
$ret = mysqli_query($link,$sql);
if ($ret) {
	echo "<div id='apdung'>";
	if ($row=mysqli_fetch_array($ret)) {
		echo "<h2>Thời khoá biểu tuần ".$row['tuan']." (Áp dụng từ ngày ".$row['ngay'].")</h2>";
	}
	echo "</div>";
}
if (isset($_GET['lop'])) {
	$lop=$_GET['lop'];
	echo "<h3>Lớp: <u>$lop</u></h3>";
	$sql="select * from chinhkhoa where tuan=$tuan and lop='$lop' order by cahoc,tiet,thu";
//echo $sql;	
$ret = mysqli_query($link,$sql) or die(mysqli_errno().mysqli_error());
	$ca=0;
	$tiet=0;
	$thu=0;
	$vong=1;
	while ($row=mysqli_fetch_array($ret)) {
		if ($row['cahoc']>$ca) {
			$ca=$row['cahoc'];
			if ($vong>1) {
				while ($thu<=8) {
					echo "<td>-</td>";
					$thu++;
				}
				echo "</tr></table>";
			}
			$tiet=1;
			$thu=2;
			echo "<br/><br/>TKB ".$BUOI[$ca]."<br/>";
			echo "<table border='1'><tr align='center'><td>Ti&#7871;t/Th&#7913;</td><td>Th&#7913; 2</td><td>Th&#7913; 3</td><td>Th&#7913; 4</td><td>Th&#7913; 5</td><td>Th&#7913; 6</td><td>Th&#7913; 7</td><td>CN</td></tr>";
			echo "<tr align='center'><td>$tiet</td>";
		}
		while ($row['tiet']>$tiet) {
			while ($thu<=8) {
				echo "<td>-</td>";
				$thu++;
			}
			$tiet++;
			echo "</tr><tr align='center'><td>$tiet</td>";
			$thu=2;
		}
		while ($row['thu']>$thu) {
			echo "<td>-</td>";
			$thu++;
		}
		echo "<td><a href='?tuan=$tuan&gv=".$row['gvbm']."' title='GVBM: ".$row['gvbm']."'>".$row['mon']."</a></td>";
		$thu++;
		$vong++;
	}
	while ($thu<=8) {
		echo "<td>-</td>";
		$thu++;
	}
	echo "</table>";
}

if (isset($_GET['gv'])) {
	$gv=$_GET['gv'];
	echo "<h3>GVBM: <u>$gv</u></h3>";
	$sql="select * from chinhkhoa where tuan=$tuan and gvbm='$gv' order by cahoc,tiet,thu";
	$ret = mysqli_query($link,$sql) or die(mysql_error());
	$ca=0;
	$tiet=0;
	$thu=0;
	$vong=1;
	while ($row=mysqli_fetch_array($ret)) {
		if ($row['cahoc']>$ca) {
			$ca=$row['cahoc'];
			if ($vong>1) {
				while ($thu<=8) {
					echo "<td>-</td>";
					$thu++;
				}
				echo "</tr></table>";
			}
			$tiet=1;
			$thu=2;
			echo "<br/><br/>TKB ".$BUOI[$ca]."<br/>";
			echo "<table border='1'><tr align='center'><td>Ti&#7871;t/Th&#7913;</td><td>Th&#7913; 2</td><td>Th&#7913; 3</td><td>Th&#7913; 4</td><td>Th&#7913; 5</td><td>Th&#7913; 6</td><td>Th&#7913; 7</td><td>CN</td></tr>";
			echo "<tr align='center'><td>$tiet</td>";
		}
		while ($row['tiet']>$tiet) {
			while ($thu<=8) {
				echo "<td>-</td>";
				$thu++;
			}
			$tiet++;
			echo "</tr><tr align='center'><td>$tiet</td>";
			$thu=2;
		}
		while ($row['thu']>$thu) {
			echo "<td>-</td>";
			$thu++;
		}
		echo "<td>".$row['mon']." <a href='?tuan=$tuan&lop=".$row['lop']."'>".$row['lop']."</a></td>";
		$thu++;
		$vong++;
	}
	while ($thu<=8) {
		echo "<td>-</td>";
		$thu++;
	}
	echo "</table>";
}
echo "<div class='xemlop'>TKB L&#7899;p: ";
$ret=mysqli_query($link,"select distinct lop from chinhkhoa where tuan=$tuan");
while ($row=mysqli_fetch_array($ret)) {
	echo "<a class='tkblop' href='?tuan=$tuan&lop=".$row['lop']."'>".$row['lop']."</a> ";
}
echo "</div>";
echo "<div class='xemlop'> TKB GV: ";
$ret=mysqli_query($link,"select distinct gvbm from chinhkhoa where tuan=$tuan order by gvbm");
while ($row=mysqli_fetch_array($ret)) {
	echo "<a class='tkblop' href='?tuan=$tuan&gv=".$row['gvbm']."'>".$row['gvbm']."</a> ";
}
echo "</div>";
?>
<div class='xemlop'><a href="?">Trang chủ</a></div>
        </div>
        </div> <!-- end #main -->


    </div> <!-- end #content -->

</body>
</html>