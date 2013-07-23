<?php include("../include/config.php"); ?>
<script type="text/javascript" src="../js/validate.js"></script>
<script>
function activateFileUpload(domObj) {
	if(domObj.checked==true){
		domObj.parentNode.parentNode.children[1].children[0].style.display='';
		var numberOfChecked = $('input:checkbox:checked').length;
		$('input#totalChecked').val(numberOfChecked);
	} else {
		domObj.parentNode.parentNode.children[1].children[0].style.display='none';
		var numberOfChecked = $('input:checkbox:checked').length;
		$('input#totalChecked').val(numberOfChecked);
	}
}
		/*var numberOfChecked = $('input:checkbox:checked').length;
		var totalCheckboxes = $('input:checkbox').length;
		var numberNotChecked = totalCheckboxes - numberOfChecked;
		console.log(numberOfChecked);*/
		//alert(numberNotChecked+' = '+totalCheckboxes+' + '+numberOfChecked);
//var num = $('#form input[type=checkbox]:checked').length; alert(num);
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="23%" align="left" valign="top">Documents</td>
    <td width="2%" align="left" valign="top">:</td>
    <td width="75%" align="left" valign="top">
    <input type="hidden" id="totalChecked" name="totalChecked" value="0"/>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="pad">
    <?php
	$id = $_GET['id'];
	$visa_checklist = mysql_query("SELECT * FROM `visa_checklist` WHERE mode = '$id'");
	while($row = mysql_fetch_array($visa_checklist)) {
		$chkID = $row['chkID'];
		$document = $row['document'];
		$name = $row['name'];
		if (strpos($name, 'others') === FALSE) {
	?>
      <tr>
        <td width="46%" height="30"><input name="<?php echo $name; ?>" id="<?php echo $name; ?>" type="checkbox" value="<?php echo $chkID; ?>" onclick="activateFileUpload(this)" class="chkbox"/>
<?php echo $document; ?></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="<?php echo $name; ?>_attach" id="<?php echo $name; ?>_attach"/>
     <span class="button">Choose the file</span>
    </div></td>
      </tr>
<?php } if($name == "loan_others") { ?>
      <tr>
        <td width="46%"><input name="loan_others" id="loan_others" type="checkbox" value="3" onclick="disableFin(this);activateFileUpload(this)" class="chkbox"/>
Any other
  <input type="text" name="other_loan_doc" id="other_loan_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="other_loan_doc_attach" id="other_loan_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>
<?php } else if($name == "fd_others") { ?>
	  <tr>
        <td width="46%"><input name="fd_others" id="fd_others" type="checkbox" value="6" onclick="disableFin(this);activateFileUpload(this)"/>
Any other
  <input type="text" name="other_fd_doc" id="other_fd_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="other_fd_doc_attach" id="other_fd_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>	
<?php } else if($name == "sav_others") { ?>
	  <tr>
        <td width="46%"><input name="sav_others" id="sav_others" type="checkbox" value="9" onclick="disableFin(this);activateFileUpload(this)"/>
Any other
  <input type="text" name="other_sav_doc" id="other_sav_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="other_sav_doc_attach" id="other_sav_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>	 
<?php } else if($name == "finance_others") { ?>
	  <tr>
        <td width="46%"><input name="other_finance" id="other_finance" type="checkbox" value="13" onclick="disableFin(this);activateFileUpload(this)"/>
Other Finance
  <input type="text" name="other_fin_doc" id="other_fin_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="other_fin_doc_attach" id="other_fin_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>
<?php } else if($name == "doc_lic_others") { ?>
	  <tr>
        <td width="46%"><input name="doc_lic_others" id="doc_lic_others" type="checkbox" value="13" onclick="disableFin(this);activateFileUpload(this)"/>
Name
  <input type="text" name="lic_doc" id="lic_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="lic_doc_attach" id="lic_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>	 
<?php } else if($name == "doc_pf_others") { ?>
	  <tr>
        <td width="46%"><input name="doc_pf_others" id="doc_pf_others" type="checkbox" value="13" onclick="disableFin(this);activateFileUpload(this)"/>
Name
  <input type="text" name="pf_doc" id="pf_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="pf_doc_attach" id="pf_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>	 
<?php } else if($name == "doc_gl_others") { ?>
	  <tr>
        <td width="46%"><input name="doc_gl_others" id="doc_gl_others" type="checkbox" value="13" onclick="disableFin(this);activateFileUpload(this)"/>
Name
  <input type="text" name="gl_doc" id="gl_doc" class="textbox" disabled="disabled"/></td>
        <td width="54%"><div class="file-wrapper" style="display:none;">
     <input type="file" class="fileSize" onchange="checkUpload(this);" name="gl_doc_attach" id="gl_doc_attach"/><span class="button">Choose the file</span>
    </div></td>
      </tr>            
<?php }} ?>       
    </table></td>
  </tr> 
</table>



