<style>
	.ad_prem li{
		padding: 0px;
		color: #000;
		background-color: #fff;
	}

    .ad-blocks{
		color: #fff;
		font-size:12pt;
		font-weight:bold;
		text-align: left;
		background-color: red;
		width: 100%;
		height: 16px;
		float: left;
		padding: 6px 0px;

    }

    .ad-blocks2L{
		color: #000;
		font-size:10pt;
		text-align: left;
		background-color: #fff;
		width: 50%;
		min-height: 125px;
		max-height: 150px;
		float: left;
	}


	ul{
		margin-top: 5px;
	}

	li{
		color: #000;
		padding: 0px;
		margin-left: 35px;
		font-size: 12px;
	}

	.add_border{
		border: 1px #000 solid;
	}

</style>

<?php
	$ad_class = "ad-blocks2L";
	foreach($item_details as $ad_block) {
		foreach($ad_block as $ad) {
			?>

 			<div class="<?= $ad_class ?>" >
				<div class="ad-blocks" >
					<span>
						<input name="<?= $ad['chkBox'] ?>"
							     id="<?= $ad['page_order'] ?>"
							     value="<?= $ad['page_ad'] ?>"
							     type="checkbox"
				           onClick="Javascript: chkBox( <?= $ad['item_price'] ?>, <?=$ad['page_order'] ?>);">
				           <?= $ad['display'].$ad['page_ad'] ?>
					</span>
					
					<div class='ad_prem'>
						<?= $ad['ad_prem'] ?>
					</div>
				</div>
			</div>

			<?php

		} // end foreach 2
	} // end foreach 1

?>




<div class="row">
	<div class="col-md-6">
	<div class="columns">
	  <ul class="price" >
	    <li class="header" style="background-color:#999999;">Platinum Sponsor</li>
	    <li class="grey">$ 125.00</li>
	    <li>1 New Jersey Law Enforcement POB Driving Safety card</li>
	    <li>1-Insurance Card Holder</li>
	    <li>1-Decal / Sticker</li>
	    <li>1-Community Supporter Card & 1-Mini Supporter - Badge</li>
	  </ul>
	</div>
	</div>

	<div class="col-md-6">
	<div class="columns">
	  <ul class="price" >
	    <li class="header" style="background-color:#999999;">Platinum Sponsor</li>
	    <li class="grey">$ 125.00</li>
	    <li>1 New Jersey Law Enforcement POB Driving Safety card</li>
	    <li>1-Insurance Card Holder</li>
	    <li>1-Decal / Sticker</li>
	    <li>1-Community Supporter Card & 1-Mini Supporter - Badge</li>
	  </ul>
	</div>
	</div>
	<div class="col-md-6">
	<div class="columns">
	  <ul class="price" >
	    <li class="header" style="background-color:#999999;">Platinum Sponsor</li>
	    <li class="grey">$ 125.00</li>
	    <li>1 New Jersey Law Enforcement POB Driving Safety card</li>
	    <li>1-Insurance Card Holder</li>
	    <li>1-Decal / Sticker</li>
	    <li>1-Community Supporter Card & 1-Mini Supporter - Badge</li>
	  </ul>
	</div>
	</div>

</div>

