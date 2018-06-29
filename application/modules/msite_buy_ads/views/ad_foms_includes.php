
<div class="row">
	<?php foreach($item_details as $ad_block) {
		foreach($ad_block as $ad) { ?>
			<div class="col-md-6">
			<div class="columns">
			  <ul class="price" >
			    <li class="header" >
				<input name="chkBoxes[]"
				   id="<?= $ad['page_order'] ?>"
				   value="<?= $ad['page_ad'] ?>"
				   type="checkbox"
				   onClick="Javascript: chkBox( <?= $ad['item_price'] ?>, <?=$ad['page_order'] ?>);">
					   <?= $ad['display'].$ad['page_ad'] ?>
			    </li>
			    <li><?= $ad['ad_prem'] ?></li>
			    <li class="grey">&nbsp;</li>	    
			  </ul>
			</div>
			</div>
	<?php
		} // end foreach 2
	} // end foreach 1
		if (($item_counts % 2) == 1) { // 1 is odd , 0 even
			?>
			<div class="col-md-6">
			<div class="columns">
			  <ul class="price" >
			    <li class="header">
				<input name="<?= $ad['chkBox'] ?>"
						     id="<?= $ad['page_order'] ?>"
							 value="<?= $ad['page_ad'] ?>"
							 type="checkbox" ?>
			    </li>
			    <li>&nbsp;</li>
			    <li class="grey">&nbsp;</li>	    
			  </ul>
			</div>
			</div>
			<?php
		}	
	?>
</div>