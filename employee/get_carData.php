<?php
$id = $_GET['id'];
if($id == '2') {
?>
<table width="34%" border="0" cellpadding="0" cellspacing="0" align="left">
<tr>
	<td width="18%" align="left">
	  <select name="vehicle" id="vehicle" class="dropdown" style="width:auto;">
	    <option value="" class="padding_2" selected="selected">Select</option>
	    <option value="Owned" class="padding_2">Owned</option>
	    <option value="Rented" class="padding_2">Rented</option>
      </select>
    </td>
    <td width="16%" align="left">
      <select name="carType" id="carType" class="dropdown" style="width:auto;">
        <option value="" class="padding_2" selected="selected">Select</option>
        <option value="Petrol" class="padding_2">Petrol</option>
        <option value="Diesel" class="padding_2">Diesel</option>
      </select></td>
    <td width="66%" align="left"><input id="carCost" name="availAmts[]" type="text" class="textbox width_60 textCenter" /></td>
</tr>
</table>
<?php } ?>