
<style type="text/css">
/*  ad-forms.php css code here */


/* Create 2 columns of equal width */
.columns {
    float: left;
    width: 100%;
    padding: 1%;
}

/* Style the list */
.price {
    list-style-type: none;
    border: 1px solid #eee;
    margin: 0;
    padding: 0;
    -webkit-transition: 0.3s;
    transition: 0.3s;
}

/* Add shadows on hover */
.price:hover {
    box-shadow: 0 8px 12px 0 rgba(0,0,0,0.2)
}

/* Pricing header */
.price .header {
    padding: 5px;
    background-color:#999999;
    text-align: left;

    /*background-color: #111;*/
    color: white;
    font-size: 18px;
}

/* List items */
.price li {
    border-bottom: 1px solid #eee;
    padding: 0px;
    text-align: left;
}

/* Grey list item */
.price .grey {
    background-color: #eee;
    font-size: 16px;
} 


#ad_box_banner{
    text-align: left;
    display: block;
    background-color: #999999;
    height: 25px;
    color: #fff;
    font-size: 18px;    
}

#ad_box_content{
    text-align: left;
    display: block;
    border: 2px #999999 solid;
    background-color: #EEEEEE;
    color: #000;
    height: 35px;"
}


</style>

<div class="row">
  <div class="col-md-6">
  		<h2><?= $item_title ?></h2>
  </div>
</div>

<div class="row">
      <div class="col-md-6">
      <div class="columns">
        <ul class="price" >
          <li class="header" >
             <?= ' ( $'.$item_price.' ) '.$ad_id ?>
          </li>
          <li ><?= nl2br($item_description) ?></li>
          <li class="grey">&nbsp;</li>      
        </ul>
      </div>
      </div>
</div>