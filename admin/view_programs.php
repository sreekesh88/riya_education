<?php include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); ?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Programs</h2>
<br />

<table width="60%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
<tr>
    <th width="10%">No</th>
    <td width="60%" align="left" bgcolor="#DDDDDD"><b>Name of the Program</b></td>
    <th width="30%">Actions</th>
</tr>
<?php	
$start = 0;
$limit = 15; 

if(isset($_GET['page'])) {
	$page = $_GET['page'];
	$counter = ((($page - 1) * $limit) + 1);
}
else {
	$page = 1;
	$counter = 1;
}
if ($page) 
	{
		$start = $limit *($page - 1);
		$end = $limit;
	}

$query = mysql_query("SELECT COUNT(*) FROM `programs` WHERE delStatus = '0'");
$total_pages = mysql_fetch_array($query);
$total_records = $total_pages[0];
$num_pages = ceil($total_records/$limit);
		
$qry = mysql_query("SELECT * FROM `programs` WHERE delStatus = '0' ORDER BY program ASC LIMIT $start, $limit");
while($rows = mysql_fetch_array($qry)) {
	$pgmID = $rows['pgmID'];
	$program = $rows['program'];
	
?>
    <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td><?php echo $program; ?></td>
    <td align="center">
    <a href="add_subprogram.php?id=<?php echo $pgmID; ?>">
    <img src="../images/add.png" alt="assign" title="Add Sub Programs" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="update_program.php?id=<?php echo $insID; ?>">
    <img src="../images/edit.png" alt="edit" title="edit" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="../images/delete.png" alt="delete" title="delete student" class="blank" width="16" height="16" onclick="return confirm_delete(<?php echo $insID; ?>)"/>    </td>
    </tr>
    <?php } ?>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td width="30%" height="80">&nbsp;</td>
    <td align="center">
    <?php
$i=1;
if($total_records > $limit)
{

echo '<ul class="pagination classC page-C-02">';
$page_no = 1;
if($page>1)  
  echo '<li><a href="view_programs.php?page='.($page-1).'" class="previous">Previous</a></li>';
while($i<$total_records)
{
  if($page == $page_no) { $current = 'class="current"'; } else { $current = ''; }
  echo '<li><a href="view_programs.php?page='.$page_no.'" '.$current.'>'.$page_no.'</a></li>';
  $page_no++;
  $i=$i+$limit;
}
  //<li><a href="#" class="current">4</a></li>
if($page>=1 && $page<$num_pages)
  echo '<li><a href="view_programs.php?page='.($page+1).'" class="next">Next</a></li>
</ul>';
}
?>
    </td>
  </tr>
</table>


</div> <!--end of main_col-->
</div> <!--end of wrapper-->

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>
