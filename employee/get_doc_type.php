<?php include("../include/config.php"); ?>
<script type="text/javascript" src="../js/validate.js"></script>

<script>
function activateFileUpload(domObj) {
	if(domObj.checked==true){
		domObj.parentNode.parentNode.children[1].children[0].style.display='';
	}else{
		domObj.parentNode.parentNode.children[1].children[0].style.display='none';
	}
}
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="23%" valign="top">Documents</td>
    <td width="2%" valign="top">:</td>
    <td width="75%" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
<?php
$id = $_GET['id'];
$visa_checklist = mysql_query("SELECT * FROM `visa_checklist` WHERE mode = '$id'");
while($row = mysql_fetch_array($visa_checklist)) {
	$chkID = $row['chkID'];
	$document = $row['document'];
	$name = $row['name'];
	if (strpos($name, 'others') === FALSE) { //income_proof
?>
      <tr>
        <td width="46%" height="30"><input name="<?php echo $name; ?>" id="<?php echo $name; ?>" type="checkbox" onclick="activateFileUpload(this)" value="<?php echo $chkID; ?>"/> <?php echo $document; ?></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="<?php echo $name; ?>_attach" id="<?php echo $name; ?>_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>
      <?php 
	  	if($name == 'income_proof') {
		?>
          <tr>
    <td><input type="radio" name="sponsor" id="sp1" value="1" /> Sponsor
    &nbsp;&nbsp;&nbsp;
    <input type="radio" name="sponsor" id="sp2" value="2" /> Gaurdian </td>
    <td>
    <div id="sponsorDetails" style="display:none;">
    <input type="text" name="spName" id="spName" class="textbox width_120" placeholder="sponsor name"/>
    <input type="text" name="spRelation" id="spRelation" class="textbox width_120" placeholder="relationship"/>
    </div>
    <div id="gaurdianDetails" style="display:none;">
    <input type="text" name="gdName" id="gdName" class="textbox width_120" placeholder="guardian name"/>
    <input type="text" name="gdRelation" id="gdRelation" class="textbox width_120" placeholder="relationship"/>
    </div>
    </td>
  </tr>
		<?php
		}
	  ?>
<?php } else if($name == "inc_others") { ?>
	  <tr>
        <td width="46%"><input name="inc_others" id="inc_others" type="checkbox" value="13" onclick="disableFin(this);activateFileUpload(this)"/> Other Income document
  <input type="text" name="other_inc_doc" id="other_inc_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="other_inc_doc_attach" id="other_inc_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>
<?php } else if($name == "bus_others") { ?>
	  <tr>
        <td width="46%"><input name="bus_others" id="bus_others" type="checkbox" value="13" onclick="disableFin(this);activateFileUpload(this)"/> Other Business document
  <input type="text" name="other_bus_doc" id="other_bus_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="other_bus_doc_attach" id="other_bus_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>    
<?php } else if($name == "ren_others") { ?>
	  <tr>
        <td width="46%"><input name="ren_others" id="ren_others" type="checkbox" value="13" onclick="disableFin(this);activateFileUpload(this)"/> Other Rental document
  <input type="text" name="other_ren_doc" id="other_ren_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="other_ren_doc_attach" id="other_ren_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>    
<?php } else if($name == "spr_others") { ?>
	  <tr>
        <td width="46%"><input name="spr_others" id="spr_others" type="checkbox" value="13" onclick="disableFin(this);activateFileUpload(this)"/> Any other
  <input type="text" name="other_spr_doc" id="other_spr_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="other_spr_doc_attach" id="other_spr_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>             
<?php }} ?>
    </table></td>
  </tr>
</table>





