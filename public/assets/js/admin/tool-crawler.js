$(document).ready(function () {
    //add('0_0');
});

function add(id) { // format id : number_number
    tmp_id = genarateId(id);
    var setting = $('#setting-html-row');
    $.ajax({
        type : 'POST',
        data: {
          'id' : tmp_id
        },
        url : SITE_ROOT + 'add-form-setting',
        success : function(data) {
            //$('#'+ id).insertAfter(data);
            $(data).insertAfter('#'+ id);
        }
    });
}

function genarateId(id) {
    var order = id.split("_");
    var parent = parseInt(order[0]);
    var own = parseInt(order[1]) + 1;
    id = parent + '_' + own;

    var count = $('#' + id).length;
    if(count > 0) {
        return genarateId(id);
    } else {
        return id;
    }
}