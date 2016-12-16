$(document).ready(function () {

});

/*
* add new element
* */
function add(id) { // format id : number_number
    var tmp_id = genarateId(id, 1);
    var setting = $('#setting-html-row');
    $.ajax({
        type : 'POST',
        data: {
          'id' : tmp_id
        },
        url : SITE_ROOT + 'add-form-setting',
        success : function(data) {
            var firstChild = $('#' + id).children().first();
            $(data).insertAfter($(firstChild));
        }
    }).done(function() {
        orderID(id);
    });
}

/*
* genarate id
* auto generate id, if id is exist, back ro generate
* */
function genarateId(id, ownOrder) {
    var tmpID = id + '_' + ownOrder;
    var count = $('#' + tmpID).length;
    if(count > 0) {
        ownOrder = ownOrder + 1;
        return genarateId(id, ownOrder);
    } else {
        return id + '_' + ownOrder;
    }
}

/*
* orderID
* sort element by id
* */
function orderID(parentID) {
    $("#"+ parentID).children().slice(1).sort(function(a, b) {
        var aID = a.id;
        var aOrderArray = aID.split('_');
        var aOrder = aOrderArray[aOrderArray.length - 1];
        var bID = b.id;
        var bOrderArray = bID.split('_');
        var bOrder = bOrderArray[bOrderArray.length - 1];
        return parseInt(aOrder) - parseInt(bOrder);
    }).each(function() {
        var elem = $(this);
        elem.remove();
        $(elem).appendTo("#" + parentID);
    });
}

/*
* remove item
* */
function remove(id) {
    $('#' + id).remove();
}

/*
* get table field append to select box
* */
$('#selectTable').on('change', function() {
    var table_name = $(this).val();
    //set table name to modal.
    $('#myModalLabel').html('Table : ' + table_name);

    //set field to select box
    $.ajax({
        type : 'POST',
        data: {
            'tableName' : table_name
        },
        url : SITE_ROOT + 'get-table-field',
        success : function(data) {
            $('#selectFieldBox').empty().append(data);
        }
    });
});

/*
* select field
* */
function selectField(id) {
    $('#modalSelectField').modal('show');
    $('#hidID').val(id);
}

function selectedField() {
    var id = $('#hidID').val();
    var field = $('#selectField').val();
    $('#field-' + id).html(field);
    $('#hid-field-' + id).html(field);
    $('#modalSelectField').modal('toggle');
}