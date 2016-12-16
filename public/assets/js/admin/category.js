var oTable;

$(document).ready(function () {
        oTable = $('#category').dataTable({
        "oLanguage": {
            "sSearch": "Search all columns:"
        },
        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [-1, 0]
            } //disables sorting for column one
        ],
        'iDisplayLength': 12,
        "sPaginationType": "full_numbers"
    });
});

/*
 * tmp save winner
 * */
function doAction( message, id){
    bootbox.dialog({
        message: message,
        title: 'Warning',
        buttons: {
            success: {
                label: "OK",
                className: "btn-success",
                callback: function() {
                    //delete record
                    $.ajax({
                        type : 'POST',
                        url : 'category/destroy',
                        data : {
                            'id' : id
                        },
                        success : function(data) {
                            window.location.reload();
                        }
                    });
                }
            },
            danger: {
                label: "Cancel",
                className: "btn-danger",
                callback: function() {

                }
            }
        }
    });
}
