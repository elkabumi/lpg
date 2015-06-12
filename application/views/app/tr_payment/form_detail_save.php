
    </td>
        </tr>
 </table>
     </div>
	<div class="command_bar">
     <? 
		if($tr_plan_detail_shipment_status_id == 0){
		?>
		<input type="button" id="submit" value="Simpan"/>
		<input type="button" id="enable" value="Edit"/>
        <a href="<?=site_url('tr_payment/index/'.$tr_plan_detail_shipment_realization_date.'')?>" style="text-align: center;font-size: 12px;
          font-weight:bold;
        width: 70px;
        background: #1CBB9B;
        padding: 12px 20px;
        line-height: 18px !important;
        line-height: 16px;
        height:80px;
        border-radius:3px;
        margin: 1px;
        cursor:pointer;
        border:1px solid #1CBB9B;
        color:#fff;
        text-shadow:0 -1px 0 rgba(0, 0, 0, 0.2);">Close</a>
        <? }else{?>
		<a href="<?=site_url('tr_payment/index/'.$tr_plan_detail_shipment_realization_date.'')?>" style="text-align: center;font-size: 12px;
          font-weight:bold;
        width: 70px;
        background: #1CBB9B;
        padding: 12px 20px;
        line-height: 18px !important;
        line-height: 16px;
        height:80px;
        border-radius:3px;
        margin: 1px;
        cursor:pointer;
        border:1px solid #1CBB9B;
        color:#fff;
        text-shadow:0 -1px 0 rgba(0, 0, 0, 0.2);">Close</a>
        <? }?>
	</div>
</div>
<!-- table contact -->

</form>