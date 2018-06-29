
/* Site Search ajax / mysql  */


const dir_path = set_CI3_path();

function _(el){
  return document.getElementById(el);
}

function set_CI3_path() {
  if( _('base_url') && _('base_url').value !== undefined )
      return _('base_url').value;  
}

$(document).ready(function() {
    $('input.typeahead').typeahead({
        source:  function (query, process) {
        return $.get('../search', { query: query }, function (data) {
               console.log(data);
               data = $.parseJSON(data);
               return process(data);
            });
        }
    });

} );
