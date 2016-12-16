var oTable;

$(document).ready(function () {
    oTable = $('#author').dataTable({
        "oLanguage": {
            "sSearch": "Search all columns:"
        },
        "aoColumnDefs": [
            {
                'bSortable': false,
                'aTargets': [-1, 0]
            } //disables sorting for column one
        ],
        'iDisplayLength': 10,
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
                        url : 'author/destroy',
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
/***
 * Show preview thumbnails before submit
 */
function loadPreview(name){
    uploader = document.getElementsByName(name);
    if (typeof (FileReader) != "undefined") {
        var image_holder = $("#ImgPreview"+name);
        image_holder.empty();
        var reader = new FileReader();
        reader.onload = function (e) {
            $("<img />", {
                "src": e.target.result,
                "class": "articleImagePreview top10",
                "id": "ImagePreview"+name
            }).appendTo(image_holder);
        };
        image_holder.show();
        reader.readAsDataURL(uploader[0].files[0]);
    } else {
        alert("This browser does not support FileReader.");
    }
}