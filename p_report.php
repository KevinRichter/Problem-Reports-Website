<?php session_start(); ?>
<?php
  $_SESSION['my_user'] = "recursion";
  $_SESSION['my_pass'] = "recursion_db";
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style type="text/css">
body {
    background: #FFFFFF;
    color: #004080;
    font-family: Arial;
    font-size: 12pt;
}
A:link { color: #FF0000 }
A:visited { color: #800080 }
A:active { color: #0000FF }
.ThRows {
    background-color: #336699;
    color: #FFFFFF;
    font-weight: bold; text-align: center;
    font-family: Arial;
    font-size: 12pt;
}
.TrRows {
    background-color: #FFFFFF;
    color: #000000;
    font-family: Arial;
    font-size: 12pt;
}
.TrOdd  {
    background-color: #FFFFCF;
    color: #000000;
    font-family: Arial;
    font-size: 12pt;
}
.TrBC { background-color: #000000 }
</style>
</head>
<body>
<table width="100%"><tr><td class="ThRows">
Header text
</td></tr></table>

<?php
  $conn = connect();
  $showrecs = 200;
  $pagerange = 10;
  $a = @$_GET["a"];
  $recid = @$_GET["recid"];
  $page = @$_GET["page"];
  if (!isset($page)) $page = 1;

  $sql = @$_POST["sql"];

  switch ($sql) {
    case "insert":
      sql_insert();
      break;
    case "update":
      sql_update();
      break;
    case "delete":
      sql_delete();
      break;
  }

  switch ($a) {
    case "add":
      addrec();
      break;
    case "view":
      viewrec($recid);
      break;
    case "edit":
      editrec($recid);
      break;
    case "del":
      deleterec($recid);
      break;
    default:
      select();
      break;
  }
  mysql_close($conn);
?>
<table width="100%"><tr><td class="ThRows">
Footer text
</td></tr></table>

</body>
</html>
<?php
function connect()
{
  $c = mysql_connect("athena.ecs.csus.edu:3306", $_SESSION['my_user'], $_SESSION['my_pass']);
  mysql_select_db("recursion");
  return $c;
}
?>
<?php
function sql_getrecordcount()
{
  global $conn;
  $sql = "select count(*) from `p_report`";
  $res = mysql_query($sql, $conn) or die(mysql_error());
  $row = mysql_fetch_assoc($res);
  reset($row);
  return current($row);
}
?>
<?php
function sql_select()
{
  global $conn;
  $sql = "SELECT * FROM `p_report`;";
  $res = mysql_query($sql, $conn) or die(mysql_error());
  return $res;
}

function select(){
  global $showrecs;
  global $pagerange;
  global $page;
  global $conn;
  $res = sql_select();
  $count = sql_getrecordcount();
  if ($count % $showrecs != 0) {
    $pagecount = intval($count / $showrecs) + 1;
  }
  else {
    $pagecount = intval($count / $showrecs);
  }
  $startrec = $showrecs * ($page - 1);
  if ($startrec < $count) {mysql_data_seek($res, $startrec);}
  $reccount = min($showrecs * $page, $count);
?>
<?php showpagenav($page, $pagecount); ?>
<table width="100%" border="0" cellpadding="4" cellspacing="1">
  <tr>
    <td class="ThRows">&nbsp;</td>
    <td class="ThRows">&nbsp;</td>
    <td class="ThRows">&nbsp;</td>
    <td class="ThRows">ID</td>
    <td class="ThRows">subject</td>
    <td class="ThRows">prob_desc</td>
    <td class="ThRows">category</td>
    <td class="ThRows">priority</td>
    <td class="ThRows">escalation</td>
    <td class="ThRows">date_entered</td>
    <td class="ThRows">date_complete</td>
    <td class="ThRows">hours</td>
    <td class="ThRows">system_type</td>
    <td class="ThRows">room_building</td>
    <td class="ThRows">room_number</td>
    <td class="ThRows">position_room</td>
    <td class="ThRows">problem_type</td>
    <td class="ThRows">computer_name</td>
    <td class="ThRows">reporter_name</td>
    <td class="ThRows">reporter_email</td>
    <td class="ThRows">reporter_phone</td>
    <td class="ThRows">prob_resolution</td>
    <td class="ThRows">status</td>
    <td class="ThRows">completed_by</td>
    <td class="ThRows">indexNum</td>
    <td class="ThRows">personel</td>
    <td class="ThRows">facIndexNum</td>
    <td class="ThRows">month_due</td>
    <td class="ThRows">day_due</td>
    <td class="ThRows">year_due</td>
  </tr>
<?php
if(mysql_num_rows($res)) {
  for ($i = $startrec; $i < $reccount; $i++)
  {
    $row = mysql_fetch_assoc($res);
    $s = "TrOdd";
    if ($i % 2 == 0) {
      $s = "TrRows";
    }
?>
  <tr>
    <td class="<?php echo $s?>" width = "16"><a href="p_report.php?a=view&recid=<?php echo $i ?>" ><img src="ems_php_images\phpview.jpg" title="View record" border="0"></a></td>
    <td class="<?php echo $s?>" width = "16"><a href="p_report.php?a=edit&recid=<?php echo $i ?>" ><img src="ems_php_images\phpedit.jpg" title="Edit record" border="0"></a></td>
    <td class="<?php echo $s?>" width = "16"><a href="p_report.php?a=del&recid=<?php echo $i ?>" onclick="return confirm('Do you really want to delete row?')"><img src="ems_php_images\phpdrop.jpg" title="Delete record" border="0"></a></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['ID'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['subject'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['prob_desc'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['category'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['priority'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['escalation'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['date_entered'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['date_complete'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['hours'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['system_type'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['room_building'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['room_number'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['position_room'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['problem_type'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['computer_name'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['reporter_name'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['reporter_email'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['reporter_phone'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['prob_resolution'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['status'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['completed_by'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['indexNum'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['personel'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['facIndexNum'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['month_due'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['day_due'])?></td>
    <td class="<?php echo $s?>"><?php echo htmlspecialchars($row['year_due'])?></td>
  </tr>
<?php }mysql_free_result($res);}?>
</table>
<?php showpagenav($page, $pagecount); ?>
<?php }?>
<?php function showpagenav($page, $pagecount){ ?>
<table border="0" width="100%"
<tr>
<td><a href="p_report.php?a=add">Add record<br></a>
<?php if ($page > 1) { ?>
<a href="p_report.php?page=<?php echo $page - 1 ?>">&lt;&lt;&nbsp;Prev</a>&nbsp;
<?php } ?>
<?php
global $pagerange;
if ($pagecount > 1) {
  if ($pagecount % $pagerange != 0)
    $rangecount = intval($pagecount / $pagerange) + 1;
  else
    $rangecount = intval($pagecount / $pagerange);
  for ($i = 1; $i < $rangecount + 1; $i++) {
    $startpage = (($i - 1) * $pagerange) + 1;
    $count = min($i * $pagerange, $pagecount);
    if ((($page >= $startpage) && ($page <= ($i * $pagerange)))) {
      for ($j = $startpage; $j < $count + 1; $j++) {
        if ($j == $page) {
?>
<b><?php echo $j ?></b>
<?php } else { ?>
<a href="p_report.php?page=<?php echo $j ?>"><?php echo $j ?></a>
<?php } } } else { ?>
<a href="p_report.php?page=<?php echo $startpage ?>"><?php echo $startpage ."..." .$count ?></a>
<?php } } } ?>
<?php if ($page < $pagecount) { ?>
&nbsp;<a href="p_report.php?page=<?php echo $page + 1 ?>">Next&nbsp;&gt;&gt;</a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>

<?php function showrecnav($a, $recid, $count)
{
?>
<table border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="p_report.php">Index Page</a></td>
<?php if ($recid > 0) { ?>
<td><a href="p_report.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Prior Record</a></td>
<?php } if ($recid < $count - 1) { ?>
<td><a href="p_report.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Next Record</a></td>
<?php } ?>
</tr>
</table>
<hr size="1" noshade>
<?php } ?>

<?php function showrow($row, $recid)
  {
?> 
<table border="0" cellspacing="1" cellpadding="5" width="50%">
<tr>
<td class="ThRows"><?php echo htmlspecialchars("ID")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["ID"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("subject")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["subject"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("prob_desc")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["prob_desc"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("category")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["category"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("priority")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["priority"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("escalation")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["escalation"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("date_entered")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["date_entered"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("date_complete")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["date_complete"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("hours")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["hours"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("system_type")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["system_type"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("room_building")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["room_building"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("room_number")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["room_number"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("position_room")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["position_room"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("problem_type")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["problem_type"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("computer_name")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["computer_name"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("reporter_name")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["reporter_name"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("reporter_email")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["reporter_email"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("reporter_phone")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["reporter_phone"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("prob_resolution")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["prob_resolution"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("status")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["status"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("completed_by")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["completed_by"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("indexNum")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["indexNum"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("personel")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["personel"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("facIndexNum")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["facIndexNum"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("month_due")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["month_due"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("day_due")."&nbsp;" ?></td>
<td class="TrOdd"><?php echo htmlspecialchars($row["day_due"]) ?></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("year_due")."&nbsp;" ?></td>
<td class="TrRows"><?php echo htmlspecialchars($row["year_due"]) ?></td>
</tr>
</table>
<?php } ?>

<?php
function select_fk_keys($tablename, $fieldname){
  global $conn;
  $sql = "SELECT $fieldname FROM $tablename;";
  $res = mysql_query($sql, $conn) or die(mysql_error());
  return $res;
}
?>
<?php function showroweditor($row, $iseditmode)
  {
?>
<table border="0" cellspacing="1" cellpadding="5"width="50%">
<tr>
<td class="ThRows"><?php echo htmlspecialchars("ID")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="ID" value="<?php echo str_replace('"', '&quot;', trim($row["ID"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("subject")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="subject" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["subject"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("prob_desc")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="prob_desc" value="<?php echo str_replace('"', '&quot;', trim($row["prob_desc"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("category")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="category" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["category"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("priority")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="priority" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["priority"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("escalation")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="escalation" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["escalation"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("date_entered")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="date_entered" value="<?php echo str_replace('"', '&quot;', trim($row["date_entered"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("date_complete")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="date_complete" value="<?php echo str_replace('"', '&quot;', trim($row["date_complete"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("hours")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="hours" value="<?php echo str_replace('"', '&quot;', trim($row["hours"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("system_type")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="system_type" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["system_type"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("room_building")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="room_building" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["room_building"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("room_number")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="room_number" value="<?php echo str_replace('"', '&quot;', trim($row["room_number"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("position_room")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="position_room" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["position_room"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("problem_type")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="problem_type" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["problem_type"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("computer_name")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="computer_name" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["computer_name"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("reporter_name")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="reporter_name" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["reporter_name"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("reporter_email")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="reporter_email" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["reporter_email"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("reporter_phone")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="reporter_phone" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["reporter_phone"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("prob_resolution")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="prob_resolution" value="<?php echo str_replace('"', '&quot;', trim($row["prob_resolution"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("status")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="status" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["status"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("completed_by")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="completed_by" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["completed_by"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("indexNum")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="indexNum" value="<?php echo str_replace('"', '&quot;', trim($row["indexNum"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("personel")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="personel" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["personel"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("facIndexNum")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="facIndexNum" value="<?php echo str_replace('"', '&quot;', trim($row["facIndexNum"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("month_due")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="month_due" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["month_due"]))?></textarea></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("day_due")."&nbsp;" ?></td>
<td class="TrRows">
<input type="text" name="day_due" value="<?php echo str_replace('"', '&quot;', trim($row["day_due"])) ?>"></td>
</tr>
<tr>
<td class="ThRows"><?php echo htmlspecialchars("year_due")."&nbsp;" ?></td>
<td class="TrRows">
<textarea name="year_due" cols="36" rows="4"><?php echo str_replace('"', '&quot;', trim($row["year_due"]))?></textarea></td>
</tr>
</tr>
</table>
<?php } ?>

<?php function addrec()
{
?>
<table border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="p_report.php">Index Page</a></td>
</tr>
</table>
<hr size="1" noshade>
<form enctype="multipart/form-data" action="p_report.php" method="post">
<p><input type="hidden" name="sql" value="insert"></p>
<?php
$row = array(
  "ID" => "",
  "subject" => "",
  "prob_desc" => "",
  "category" => "",
  "priority" => "",
  "escalation" => "",
  "date_entered" => "",
  "date_complete" => "",
  "hours" => "",
  "system_type" => "",
  "room_building" => "",
  "room_number" => "",
  "position_room" => "",
  "problem_type" => "",
  "computer_name" => "",
  "reporter_name" => "",
  "reporter_email" => "",
  "reporter_phone" => "",
  "prob_resolution" => "",
  "status" => "",
  "completed_by" => "",
  "indexNum" => "",
  "personel" => "",
  "facIndexNum" => "",
  "month_due" => "",
  "day_due" => "",
  "year_due" => "");
showroweditor($row, false);
?>
<p><input type="submit" name="action" value="Post"></p>
</form>
<?php } ?>

<?php function viewrec($recid)
{
$res = sql_select();
  $count = sql_getrecordcount();
  mysql_data_seek($res, $recid);
  $row = mysql_fetch_assoc($res);
  showrecnav("view", $recid, $count);
?>
<br>
<?php showrow($row, $recid) ?>
<br>
<hr size="1" noshade>
<table border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="p_report.php?a=add">Add record</a></td>
<td><a href="p_report.php?a=edit&recid=<?php echo $recid ?>">Edit record</a></td>
<td><a href="p_report.php?a=del&recid=<?php echo $recid ?>">Delete record</a></td>
</tr>
</table>
<?php
  mysql_free_result($res);
} ?>

<?php function editrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysql_data_seek($res, $recid);
  $row = mysql_fetch_assoc($res);
  showrecnav("edit", $recid, $count);
?>
<br>
<form enctype="multipart/form-data" action="p_report.php" method="post">
<input type="hidden" name="sql" value="update">
<input type="hidden" name="xID" value="<?php echo $row["ID"] ?>">
<?php showroweditor($row, true); ?>
<p><input type="submit" name="action" value="Post"></p>
</form>
<?php
  mysql_free_result($res);
} ?>
<?php function deleterec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysql_data_seek($res, $recid);
  $row = mysql_fetch_assoc($res);
?>
<br>
<form name="delete_form" action="p_report.php" method="post">
<input type="hidden" name="sql" value="delete">
<input type="hidden" name="xID" value="<?php echo $row["ID"] ?>">
<script type="text/javascript">
  document.getElementById("delete_form").submit();
</script>
</form>
<?php
  mysql_free_result($res);
} ?>
<?php
function sqlvalue($val, $quote)
{
  if ($quote)
    $tmp = sqlstr($val);
  else
    $tmp = $val;
  if ($tmp == "")
    $tmp = "NULL";
  elseif ($quote)
    $tmp = "'".$tmp."'";
  return $tmp;
}

function sqlstr($val)
{
  return str_replace("'", "''", $val);
}

function primarykeycondition()
{
  global $_POST;
  $pk = "";
  $pk .= "(`ID`";
  if (@$_POST["xID"] == "") {
    $pk .= " IS NULL";
  } else {
  $pk .= " = " .sqlvalue(@$_POST["xID"], false);
  };
  $pk .= ")";
  return $pk;
}

function sql_insert()
{
  global $conn;
  global $_POST;
  $sql = "insert into `p_report` (`ID`, `subject`, `prob_desc`, `category`, `priority`, `escalation`, `date_entered`, `date_complete`, `hours`, `system_type`, `room_building`, `room_number`, `position_room`, `problem_type`, `computer_name`, `reporter_name`, `reporter_email`, `reporter_phone`, `prob_resolution`, `status`, `completed_by`, `indexNum`, `personel`, `facIndexNum`, `month_due`, `day_due`, `year_due`) values (".sqlvalue(@$_POST["ID"], false).", ".sqlvalue(@$_POST["subject"], true).", ".sqlvalue(@$_POST["prob_desc"], true).", ".sqlvalue(@$_POST["category"], true).", ".sqlvalue(@$_POST["priority"], true).", ".sqlvalue(@$_POST["escalation"], true).", ".sqlvalue(@$_POST["date_entered"], true).", ".sqlvalue(@$_POST["date_complete"], true).", ".sqlvalue(@$_POST["hours"], false).", ".sqlvalue(@$_POST["system_type"], true).", ".sqlvalue(@$_POST["room_building"], true).", ".sqlvalue(@$_POST["room_number"], false).", ".sqlvalue(@$_POST["position_room"], true).", ".sqlvalue(@$_POST["problem_type"], true).", ".sqlvalue(@$_POST["computer_name"], true).", ".sqlvalue(@$_POST["reporter_name"], true).", ".sqlvalue(@$_POST["reporter_email"], true).", ".sqlvalue(@$_POST["reporter_phone"], true).", ".sqlvalue(@$_POST["prob_resolution"], true).", ".sqlvalue(@$_POST["status"], true).", ".sqlvalue(@$_POST["completed_by"], true).", ".sqlvalue(@$_POST["indexNum"], false).", ".sqlvalue(@$_POST["personel"], true).", ".sqlvalue(@$_POST["facIndexNum"], false).", ".sqlvalue(@$_POST["month_due"], true).", ".sqlvalue(@$_POST["day_due"], false).", ".sqlvalue(@$_POST["year_due"], true).")";
  mysql_query($sql, $conn) or die(mysql_error());
}
?>
<?php
function sql_update()
{
  global $conn;
  global $_POST;
  $sql = "update `p_report` set `ID`=".sqlvalue(@$_POST["ID"], false).", `subject`=".sqlvalue(@$_POST["subject"], true).", `prob_desc`=".sqlvalue(@$_POST["prob_desc"], true).", `category`=".sqlvalue(@$_POST["category"], true).", `priority`=".sqlvalue(@$_POST["priority"], true).", `escalation`=".sqlvalue(@$_POST["escalation"], true).", `date_entered`=".sqlvalue(@$_POST["date_entered"], true).", `date_complete`=".sqlvalue(@$_POST["date_complete"], true).", `hours`=".sqlvalue(@$_POST["hours"], false).", `system_type`=".sqlvalue(@$_POST["system_type"], true).", `room_building`=".sqlvalue(@$_POST["room_building"], true).", `room_number`=".sqlvalue(@$_POST["room_number"], false).", `position_room`=".sqlvalue(@$_POST["position_room"], true).", `problem_type`=".sqlvalue(@$_POST["problem_type"], true).", `computer_name`=".sqlvalue(@$_POST["computer_name"], true).", `reporter_name`=".sqlvalue(@$_POST["reporter_name"], true).", `reporter_email`=".sqlvalue(@$_POST["reporter_email"], true).", `reporter_phone`=".sqlvalue(@$_POST["reporter_phone"], true).", `prob_resolution`=".sqlvalue(@$_POST["prob_resolution"], true).", `status`=".sqlvalue(@$_POST["status"], true).", `completed_by`=".sqlvalue(@$_POST["completed_by"], true).", `indexNum`=".sqlvalue(@$_POST["indexNum"], false).", `personel`=".sqlvalue(@$_POST["personel"], true).", `facIndexNum`=".sqlvalue(@$_POST["facIndexNum"], false).", `month_due`=".sqlvalue(@$_POST["month_due"], true).", `day_due`=".sqlvalue(@$_POST["day_due"], false).", `year_due`=".sqlvalue(@$_POST["year_due"], true)." where " .primarykeycondition();
  mysql_query($sql, $conn) or die(mysql_error());
}
?>
<?php
function sql_delete()
{
  global $conn;
  $sql = "delete from `p_report` where " .primarykeycondition();
  mysql_query($sql, $conn) or die(mysql_error());
}
?>
