<?php
include 'config.php';
$cn1 = $dbd1 -> query("SHOW TABLES;")-> fetchAll(PDO::FETCH_ASSOC);
$count1 = count($cn1);
$cn2 = $dbd2 -> query("SHOW TABLES;") -> fetchAll(PDO::FETCH_ASSOC);
$count2 = count($cn2);

function dbDiff($db1, $db2)
{
  foreach ($db1 as $value)
  {
    $diff[$value] = 1;
  }
  foreach ($db2 as $value)
  {
    unset($diff[$value]);
  }
  return array_keys($diff);
}

$dbDiff1 = dbDiff($db1, $db2);
$dbDiff2 = dbDiff($db2, $db1);
?>
<div class="container-md">
  <div class="row">
    <div class="col-4">
      <h4 class="list-title">
        <br>
        <u>ORTAK TABLOLAR</u>
      </h4>
      <ul class="list-group">
        <?php
        foreach ($common as $key => $value)
        {
          echo '<li class="list-group-item list-group-item-success">' . $value . '</li>';
        }
        ?>
      </ul>
    </div>
    <div class="col-4">
      <h4 class="list-title">
        <br>
        <u>DB1 de olup DB2 de olmayanlar</u>
      </h4>
      <ul class="list-group">
        <?php
        foreach ($dbDiff1 as $key => $value)
        {
          echo '<li class="list-group-item list-group-item-dark">' . $value . '</li>';
        }
        ?>
      </ul>
    </div>
    <div class="col-4">
      <h4 class="list-title">
        <br>
        <u>DB2 de olup DB1 de olmayanlar</u>
      </h4>
      <ul class="list-group">
        <?php
        foreach ($dbDiff2 as $key => $value)
        {
          echo '<li class="list-group-item">' . $value . '</li>';
        }
        ?>
      </ul>
    </div>
  </div>
</div>

