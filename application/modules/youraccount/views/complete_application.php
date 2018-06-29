<?php
    $this->load->module('site_security');
    $this->site_security->_make_sure_logged_in();
?>

<style>
.error-template {padding: 20px 15px;text-align: center;}
.error-template{ background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);}

.error-actions {margin-top:15px;margin-bottom:15px;}
.error-actions .btn { margin-right:10px; }
</style>

<div  class="col-md-12">
    <div class="error-template"  style="height: 400px;">
    	<P>&nbsp;</P>
    	<P>&nbsp;</P>
    	<P>&nbsp;</P>    	    	    	
        <h4>
            Hi! You were directed to this page because our records show the membership application is incomplete.
		</h4>            
    	<P>&nbsp;</P>    	    	    	
    	<P>&nbsp;</P>    	    	    	    			
        <div class="error-actions">
            <a href="<?= base_url() ?>users_application" class="btn btn-primary btn-lg"> Proceed To Application</a>
       		<a  href="youraccount/logout" class="btn btn-primary btn-lg"> Cancel </a>
        </div>
    </div>
</div>


