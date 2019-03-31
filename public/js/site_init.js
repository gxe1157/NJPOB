/* Site default setup */


/* sitewide functions */
function _(el){
  return document.getElementById(el);
}


function jsUcfirst(string) {
	// upperFirstletter
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function set_CI3_path() {
  if( _('base_url') && _('base_url').value !== undefined )
      return _('base_url').value;  
}

const dir_path = set_CI3_path();
