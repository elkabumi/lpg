<script type="text/javascript">	
var oTableRoom;
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "coa/coa_form_action",
		backPage		: "coa/coa",
		nextPage		: "coa/coa"
	});
	
	
	
	
	
	
	$('input[name="i_cek_sub_account"]').change(function(){
		
		var i_coa_account_type =  $('input[name="i_coa_account_type"]').val();
		
		
		if(i_coa_account_type == ""){
			alert("Pilih Account Type terlebih dahulu");
		}
			var cek1 =  $('input[name="i_cek1"]').val();
			var lookup_sub_account = document.getElementById("lookup_sub_account");
			
			if(cek1 == 0){
				lookup_sub_account.style.display = 'inline';
				$('input[name="i_cek1"]').val("1");
			}else{
				lookup_sub_account.style.display = 'none';
				$('input[name="i_cek1"]').val("0");
			}
	});
	
	function load_sub_account(){
		 var coa_account_type = $('input[name="i_coa_account_type"]').val();
                            if(oTableRoom){
								if(coa_account_type.toString().length > 0)
								{	
									oTableRoom.fnSettings().sAjaxSource = site_url + "lookup/sub_account_table_control/"+ coa_account_type;
									oTableRoom.fnReloadAjax();
								}
							}
							
		var id 	= $('input[name="i_coa_account_type"]').val();
	
		if(id == ""){
			return;
		}
		var data ='id='+id; 
		
		if($('input[name="i_cek_sub_account"]').val() == 1){
		
			$.ajax({
				type: 'POST',
				url: '<?=site_url('coa/get_data_coa')?>',
				data: data,
				dataType: 'json',
				success: function(data){		
				
					$('input[name="i_coa_group"]').val(data.content['coa_group']);
					$('input[name="i_coa_hierarchy"]').val(data.content['coa_hierarchy']);
					$('input[name="i_coa_hierarchy2"]').val(data.content['coa_code']);
				}
				
			});
		}
	}
	
	function get_data_coa(){
		var id 	= $('input[name="i_sub_account"]').val();
	
		if(id == ""){
			return;
		}
		var data ='id='+id; 
		
		$.ajax({
			type: 'POST',
			url: '<?=site_url('coa/get_data_coa_sub_account')?>',
			data: data,
			dataType: 'json',
			success: function(data){		
				$('input[name="i_coa_hierarchy"]').val(data.content['coa_hierarchy']);
				$('input[name="i_coa_hierarchy2"]').val(data.content['coa_code']);
			}
			
		});
	}
	
	
	//updateAll(); // tambahkan ini disetiap form
});</script>
<form id="id_form_nya">
<!-- panel loader status -->
<div class="form_area">

<!-- panel input -->
<table class="form_layout">
  <tr>
    <td width="150">Account Type</td>
    <td><input type="hidden" id="row_id" name="row_id" value="<?=$row_id?>" />
      <input type="hidden" name="i_coa_hierarchy" value='<?=$coa_hierarchy?>' />
      <input type="hidden" name="i_coa_id" class="com_id" value="<?=$coa_id?>" />
      <input type="hidden" name="i_coa_level" value='<?=$coa_level?>' />
      <input type="hidden" name="i_coa_parent" value='<?=$parent_coa_id?>' />
      <input type="hidden" name="i_coa_group" value='<?=$coa_group?>' />
      <input type="hidden" id="i_coa_level" size="1" value="<?=$coa_level?>" readonly="readonly"/>
       <input type="text" name="i_account_type_name" size="50" value='<?=$account_type_name?>' readonly="readonly" />
      </td>
  </tr>
  <tr>
    <td width="150" valign="top">Sub Account of
    </td>
    <td valign="top"><input type="text" name="i_sub_account_name" size="50" value='<?=$sub_account_name?>' readonly="readonly" /></td>
  </tr>
   <tr>
     <td width="150">Normally</td>
     <td><?=form_dropdown('i_coa_normally', $cbo_normally, $coa_normally)?></td>
   </tr>
  <tr>
    <td width="150">No Account</td>
    <td><input name="i_coa_hierarchy" type="text" id="i_coa_hierarchy" value="<?=$coa_hierarchy?>" size="20"  />
      <input name="i_coa_hierarchy2" type="hidden" id="i_coa_hierarchy2" value="<?=$coa_code?>" size="10" maxlength=""  readonly="readonly"  /></td>
  </tr>
  <tr>
    <td width="150">Account Name</td>
    <td><input name="i_coa_name" type="text" id="i_coa_name" value="<?=$coa_name?>" size="50" maxlength="50" />
    </td>
  </tr>
</table>
<!-- panel control -->
<div class="command_bar">
		<input type="button" id="submit" value="Simpan"/>
		<input type="button" id="enable" value="Edit"/>
		<input type="button" id="cancel" value="Batal"/>
	</div>
</div>
</form>
