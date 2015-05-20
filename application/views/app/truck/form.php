<script type="text/javascript">	
$(function(){
	createForm({
		id 				: "#id_form_nya", 
		actionTarget	: "truck/form_action",
		backPage		: "truck",
		nextPage		: "truck"
	});
	
	createLookUp({
		table_id		: "#lookup_table_employee",
		table_width		: 400,
		listSource 		: "lookup/employee_table_control/",
		dataSource		: "lookup/employee_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_employee",
		filter_by		: [{id : "p1", label : "Kode"},{id : "p2", label : "Nama"},{id : "p3", label : "posisi"}]
	});
	createLookUp({
		table_id		: "#lookup_table_employee_2",
		table_width		: 400,
		listSource 		: "lookup/employee_table_control/",
		dataSource		: "lookup/employee_lookup_id",
		column_id 		: 0,
		component_id	: "#lookup_employee_2",
		filter_by		: [{id : "p1", label : "Kode"},{id : "p2", label : "Nama"},{id : "p3", label : "posisi"}]
	});

	createDatePicker();
});

</script>

<form id="id_form_nya">
<div class="form_area">
<div class="form_area_frame">
<table  width="100%" cellpadding="4" class="form_layout">
	<tr>
     <td width="196">Nopol</td>
     <td width="651"><input name="i_nopol" type="text" id="i_nopol" value="<?=$truck_nopol ?>" />
     <input type="hidden" name="row_id" value="<?=$row_id?>" /></td>
   </tr>
   
    <tr>
     <td width="196">No. STNK</td>
     <td width="651"><input name="i_stnk" type="text" id="i_stnk" value="<?=$truck_stnk ?>" size="10"/></td>
    </tr>
    <tr>
     <td width="196">Pemilik Kendaraan</td>
     <td width="651"><input name="i_owner" type="text" id="i_owner" value="<?=$truck_owner ?>" size="10"/></td>
    </tr>
    <tr>
     <td width="196">Warna</td>
     <td width="651"><input name="i_color" type="text" id="i_color" value="<?=$truck_color ?>" size="10"/></td>
    </tr>
   	<tr>
     <td width="196">Tahun Pembuatan</td>
     <td width="651"><input name="i_manufacture_year" type="text" id="i_manufacture_year" value="<?=$truck_manufacture_date	 ?>" size="10"/></td>
    </tr>
   	<tr>
     <td width="196">Merk</td>
     <td width="651"><input name="i_merk" type="text" id="i_merk" value="<?=$truck_merk ?>" size="10"/></td>
    </tr>
     <tr>
     <td req= "req">Jenis Armada</td>
        <td><?php echo  form_dropdown('i_truck_type_id',$truck_type, $truck_type_id)  ?>
       </td>
     </tr>
     <tr>
     <td req= "req">Sopir</td>
        <td><span class="lookup" id="lookup_employee">
				<input type="hidden" name="i_driver_id" class="com_id" value="<?=$driver_id?>" />
				<input type="text" class="com_input">
				<div class="iconic_base iconic_search com_popup"></div>
                 <span class="com_desc"></span>
								</span>	
       </td>
     </tr>
     <tr>
     <td req= "req">Kernet</td>
        <td><span class="lookup" id="lookup_employee_2">
				<input type="hidden" name="i_co_driver_id" class="com_id" value="<?=$co_driver_id?>" />
				<input type="text" class="com_input"/>
				<div class="iconic_base iconic_search com_popup"></div>
                 <span class="com_desc"></span>
				
				</span>	
       </td>
     </tr>
 </table>
<div class="form_category">Keterangan Tambahan</div>
	<table width="100%" cellpadding="4" class="form_layout">
	<tr>
     <td width="196">CC</td>
     <td width="651"><input name="i_cc" type="text" id="i_phone" value="<?=$truck_cc ?>" size="10"/></td>
     </tr>
   <tr>
     <td width="196">NO Rangka</td>
     <td width="651"><input name="i_rangka" type="text" id="i_rangka" value="<?=$truck_no_rangka ?>" size="10"/></td>
     </tr>
   
     <td width="196">No Mesin</td>
     <td width="651"><input name="i_mesin" type="text" id="i_mesin" value="<?=$truck_no_mesin ?>" size="10"/></td>
     </tr>
  <tr>
    <td width="196">No BPKB</td>
    <td width="651"><input name="i_bpkb" type="text" id="i_bpkb" value="<?=$truck_no_bpkb ?>" size="10"/></td>
     </tr>
   <tr>
    <td width="196">Jatuh Tempo</td>
    <td width="651"><input type="text" name="i_tempo" class="date_input" size="15" value="<?=$truck_jatuh_tempo?>" /></td>
    </tr>
   <tr>
    <td width="196">Jatuh Kiur</td>
    <td width="651"><input type="text" name="i_kiur" class="date_input" size="15" value="<?=$truck_jatuh_tempo_kiur?>" /></td>
    </tr>
   <tr>
    <td width="196">Rekom</td>
    <td width="651"><input type="text" name="i_rekom" class="date_input" size="15" value="<?=$truck_rekom?>" /></td>
    </tr>

	

</table>
</div>
<div class="command_bar">
	<input type="button" id="submit" value="Simpan"/>
	<input type="button" id="enable" value="Edit"/>
	<input type="button" id="cancel" value="Batal" /> 
</div>
</div>
</form>

<div id="">
	<table id="lookup_table_employee" cellpadding="0" cellspacing="0" border="0" class="display" > 
		<thead>
			<tr>
			<th>ID</th>
				<th>NIK </th>
				<th>Nama</th>
            	<th>Posisi</th>
			</tr> 
		</thead> 
		<tbody> 	
		</tbody>
	</table>
	<div id="panel">
		<input type="button" id="choose" value="Pilih Data"/>
		<input type="button" id="refresh" value="Refresh"/>
		<input type="button" id="cancel" value="Cancel" />
	</div>	
</div>
<div id="">
	<table id="lookup_table_employee_2" cellpadding="0" cellspacing="0" border="0" class="display" > 
		<thead>
			<tr>
			<th>ID</th>
				<th>NIK </th>
				<th>Nama</th>
            	<th>Posisi</th>
			</tr> 
		</thead> 
		<tbody> 	
		</tbody>
	</table>
	<div id="panel">
		<input type="button" id="choose" value="Pilih Data"/>
		<input type="button" id="refresh" value="Refresh"/>
		<input type="button" id="cancel" value="Cancel" />
	</div>	
</div>