<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'].'les/includes/common_functions.php');
include($_SERVER['DOCUMENT_ROOT'].'les/other_transaction/transaction/job_order_entry/access.php');
$csr_value= validate_input(strtoupper($_GET["csr_booking_charges"]));
include($_SERVER['DOCUMENT_ROOT'].'les/includes/postgres_connect.php'); 
$query=pg_query($con,"
select isnull(b.chg_grp,'') AS chg_grp,
isnull(b.charge_code,'') as oc_code,isnull(net_rate,0) AS net_rate,
isnull(net_currency,'') AS net_currency,
isnull(agent_rate,0) AS agent_rate,
isnull(selling_currency,'') AS selling_currency,
isnull(selling_rate,0) AS selling_rate,
isnull(c.aaigoc_code,'') AS aaigoc_code, 
isnull(company_name,'') AS company_name, charge_group_desc, 
isnull(e.charge_desc,b.charge_code) as oc_desc, other_charges_no, 
isnull(agent_currency,'') AS agent_currency, case prepaid when 'Y' then 'P' else 'C' end AS collect_tag,
isnull(f.vat_code,'VAT'), isnull(f.vat_rate,0.12)
from csr.service_record a join csr.other_charges b on
a.csr_no = b.csr_no join partners.customer c on
bill_to_aaigoc_code = c.aaigoc_code join charge_group d on
b.chg_grp = d.charge_group_code left join charge e on 
b.charge_code = e.charge_code left join vat_category f on
c.vat_code = f.vat_code
where a.csr_reference='$csr_value'");
$numrows=pg_num_rows($query);
?>		
		<tr>
<?php
	if($numrows > 0){
		while($row=pg_fetch_array($query)){
?>
		<td class="hidable_column <?php echo @$access_update; ?>"></td>
		<td class="hidable_column <?php echo @$access_delete; ?>"></td>
		<td><?php echo $row['chg_grp']; ?></td>
		<td><?php echo $row['charge_group_desc']; ?></td>
		<td><?php echo $row['oc_code']; ?></td>
		<td><?php echo $row['oc_desc']; ?></td>
		<td><?php echo number_format($row['selling_rate'],2); ?></td>
		<td><?php echo $row['selling_currency']; ?></td>
		<td><?php echo show_collect_tag($row['collect_tag']); ?></td>
		<td><?php echo $row['aaigoc_code']; ?></td>
		<td><?php echo $row['company_name']; ?></td>
		<td><?php //echo $row['prepared_by']; ?></td>
		<td><?php //echo date("m/d/Y H:i",strtotime($row['date_prepared'])); ?></td>
		<td><?php //echo $row['override_by']; ?></td>
		<td><?php //echo date("m/d/Y H:i",strtotime($row['date_override'])); ?></td>
		</tr>
<?php 
		}
	}else{
?>	
		<td class="hidable_column <?php echo @$access_update; ?>"><a href="#" class="hover_row">Override</a></td>
		<td class="hidable_column <?php echo @$access_delete; ?>"><input type="checkbox" value="" name="checkbox[]" class="highlight_row" /></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
<?php
	}	
pg_free_result($query);
pg_close($con);
?>
<?php
function show_collect_tag($collect_tag){
switch(pg_escape_string(trim($collect_tag))){
case 'C':
echo 'Collect';
break;
case 'P':
echo 'Prepaid';
break;
default: echo '';
	}
}

?>