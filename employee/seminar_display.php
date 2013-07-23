<?php 
include ("../include/header.php"); 
include ("../include/validate.php"); 
include ("../include/menu.php"); 
$empCode = $info['empCode'];
?>

<div id="wrapper_top"></div>
<div id="wrapper">
<?php include("../include/left.php"); ?>
<div class="main_col dotted_border">
<h2>Seminars</h2>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablegeneral">
  <tr>
    <th width="5%">No</th>
    <th width="40%" align="left" class="padding_2">Title of the Seminar</th>
    <th width="12%">Seminar Date</th>
    <th width="15%">Requested by</th>
    <th width="12%">Branch</th>
    <th width="15%">Actions</th>
  </tr>
	<?php
    $counter = 1;
    $seminars = mysql_query("SELECT * FROM `seminars` WHERE delStatus = '0'");
    while($rows = mysql_fetch_array($seminars)) {
        $title = $rows['title'];
        $date = date("d-m-Y", strtotime($rows['eventDate']));
        $empCode = $rows['empCode'];
            $emps = mysql_query("SELECT fname,lname FROM `employees` WHERE empCode = '$empCode'");
            $row = mysql_fetch_array($emps);
            $requestedBy = $row['fname']." ".$row['lname'];
            
        $branchID = $rows['branchID'];
            $branches = mysql_query("SELECT * FROM `branches` WHERE branchID = '$branchID'");
            $row = mysql_fetch_array($branches);
            $branch = $row['branch'];
    ?>
  <tr>
    <td align="center"><?php echo $counter++; ?></td>
    <td align="left"><a href="seminar_view.php?id=<?php echo $rows['semID']; ?>"><?php echo $title; ?></a></td>
    <td align="center"><?php echo $date; ?></td>
    <td align="center"><?php echo $requestedBy; ?></td>
    <td align="center"><?php echo $branch; ?></td>
    <td align="center">
    <a href="seminar_feedback.php?id=<?php echo $rows['semID']; ?>">
    <img src="../images/feedback.png" alt="edit" title="feedback" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="seminar_edit.php?id=<?php echo $rows['semID']; ?>">
    <img src="../images/edit.png" alt="edit" title="edit seminar" class="blank" width="16" height="16" /></a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <img src="../images/delete.png" alt="delete" title="delete seminar" class="blank" width="16" height="16" onclick="return confirm_delete(<?php echo $rows['semID']; ?>)"/>
    </td>
  </tr>
	<?php
    }
    ?>
</table>


</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>