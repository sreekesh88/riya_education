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
<h2>Seminar Feedback Form</h2>
<br />
<div class="fullWidth">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="33%" height="40">Seminar</td>
    <td width="2%">:</td>
    <td width="65%"><strong>Title of the Seminar</strong></td>
  </tr>
  <tr>
    <td height="40">No. of Participants attended</td>
    <td>:</td>
    <td><input type="text" name="textfield" id="textfield" class="textbox width_95" /></td>
  </tr>
  <tr>
    <td height="40">Arrangement of the room/hall adequate</td>
    <td>:</td>
    <td><table width="41%" height="20" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><input type="radio" name="radio" id="radio" value="radio" /> 
          Good</td>
        <td><input type="radio" name="radio2" id="radio2" value="radio2" /> 
          Average</td>
        <td><input type="radio" name="radio3" id="radio3" value="radio3" /> 
          Poor</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="40">Did your Seminar program meet your expectation?</td>
    <td>:</td>
    <td><input type="radio" name="radio4" id="radio4" value="radio4" /> 
      Yes&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio5" id="radio5" value="radio5" /> 
      No</td>
  </tr>
  <tr>
    <td height="40">How many database collected?</td>
    <td>:</td>
    <td><input type="text" name="textfield2" id="textfield2" class="textbox width_95" /></td>
  </tr>
  <tr>
    <td colspan="3">What is your overall comments?</td>
    </tr>
  <tr>
    <td colspan="3"><textarea name="textarea" id="textarea" class="textarea width_440"></textarea></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><h6>Expenses</h6></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Seminar Cost</td>
    <td>:</td>
    <td><input type="text" name="textfield3" id="textfield3" class="textbox width_95 textCenter" value="5000"/> 
      INR</td>
  </tr>
  <tr>
    <td height="40"><h6>Expense Details</h6></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="40">Travel
      <span style="float:right;">
      <select name="select" id="select" class="dropdown" style="width:150px;">
      <option value="" selected="selected">Select</option>
      <option value="1">Bus</option>
      <option value="2">Car</option>
      <option value="3">Auto</option>
      <option value="4">2 Wheeler</option>
      <option value="5">Train</option>
      <option value="6">Flight</option>
      </select>
      </span>
      </td>
    <td>:</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Accomodation
    <span style="float:right;">
      <select name="select" id="select" class="dropdown" style="width:150px;">
      <option value="" selected="selected">Select</option>
      <option value="1">Single Room</option>
      <option value="2">Double Room</option>
      <option value="3">Twin Sharing</option>
      <option value="4">Suite Room</option>
      </select>
      </span>
    </td>
    <td>:</td>
    <td><input type="checkbox" name="checkbox" id="checkbox" /> 
      Including Food&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="text" name="textfield4" id="textfield4" class="textbox width_95 textCenter"/> 
      INR</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="red"><strong>Grant Total for the Seminar</strong></td>
    <td>:</td>
    <td><input type="text" name="textfield5" id="textfield5" class="textbox width_95 textCenter"/> 
      INR</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


</div>

</div>
</div>

<?php include("../include/footer.php"); ?>

</div> <!--end of container-->
</body>
</html>