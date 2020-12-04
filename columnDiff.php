<?php
include 'config.php';
$commonCT = count($common);
function getColumnsFromTable($database)
{
	global $common, $commonCT;
	$dbc = createDBInstance($database);
	for ($i=0; $i < $commonCT ; $i++)
	{
		$query = "SELECT COLUMN_NAME, TABLE_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$common[$i]' AND TABLE_SCHEMA = '$database';";
		$columnCN[] = $dbc -> query($query) -> fetchAll(PDO::FETCH_ASSOC);
	}
	foreach($columnCN as $key) {
		foreach($key as $tKey) {
			$tempColumn[$tKey['TABLE_NAME']][] = $tKey['COLUMN_NAME'];
		}
	}
	return $tempColumn;
}

$col1 = getColumnsFromTable($database1);
$col2 = getColumnsFromTable($database2);

function columnsIntersect()
{
	global $col1, $col2;
	foreach ($col1 as $tableKey => $tableValue)
	{
	  $intersect[$tableKey] = array_values(array_intersect($col1[$tableKey], $col2[$tableKey]));
	}	
	return $intersect;
}

function columnsDiff($col1, $col2)
{
	foreach ($col1 as $tableKey => $tableValue)
	{
	  $diff[$tableKey] = array_diff($col1[$tableKey], $col2[$tableKey]);
	}	
	return $diff;
}

$columnsIntersect = columnsIntersect();
$columnsDiff1 = columnsDiff($col1, $col2);
$columnsDiff2 = columnsDiff($col2, $col1);
function intersectList($columnsIntersect)
{
	foreach ($columnsIntersect as $key => $value)
	{
    echo "<h4><b><u>". $key ."</u></b></h4>";
    foreach($value as $cKey => $cValue)
    {
      echo "<br>" . $cKey ." => ". $cValue;
    }
    echo "<p>";
	}
}

function listDiff($columnsDiff)
{
	foreach ($columnsDiff as $key => $value)
	{
    echo "<h4><b><u>". $key ."</u></b></h4>";
    foreach($value as $dKey => $dValue)
    {
      echo "<br>" . $dKey ." => ". $dValue;
    }
    echo "<p>";
	}
}
// $array = intersectList($columnsIntersect);
// $file_name = "try.xls";
// header("Content-Disposition: attachment; filename=\"$file_name\"");
// header("Content-Type: application/vnd.ms-excel");
// header("Pragma: no-cache");
// header("Expires: 0");
// $out = fopen("php://output", 'w');
// function excel()
// {
// 	global $out,$array;
// 	foreach ($array as $data)
// 	{
// 	    fputcsv($out, $data,"\t");
// 	}
// 	return fclose($out);
// }
// echo "Excel indir" . excel();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class="container-fluid">
		<div class="row">
		  <div class="col-4">
				<br>
				<button class="accordion">ORTAK COLUMNLAR</button>
				<div class="panel">
				<br>
		    	<ul class="list-group">
	     		<?php
	      		intersectList($columnsIntersect);
	     		?>
	    		</ul>
	  	</div>
		</div>
		<div class="col-4">
			<br>
			<button class="accordion">DB1'de olup DB2'de OLMAYANLAR</button>
			<div class="panel">
			<br>
	    	<ul class="list-group">
      	<?php
      	  listDiff($columnsDiff1);
      	?>
	    	</ul>
	  	</div>
		</div>
		<div class="col-4">
			<br>
			<button class="accordion">DB2'de olup DB1'de OLMAYANLAR</button>
			<div class="panel">
			<br>
			  <ul class="list-group">
		    <?php
		      listDiff($columnsDiff2);
		    ?>
			  </ul>
			</div>
		</div>
		</div>
	</div>
<script>
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>
</body>
</html>



