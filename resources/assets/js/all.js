//delete file in form edit document
$(document).on('click', '.deleteDocBtn', function (event) {
    var btn = $(event.currentTarget);
    var fileId = btn.attr('fileId');
    var documentId = btn.attr('documentId');
    var cnf = confirm('Xóa tài liệu này ?');
    var token = $('meta[name="csrf-token"]').attr('content');
    var path = "{!! json_encode(url('/')) !!}";
    console.log(path);

    if (cnf) {
        $.ajax({
            url: '/documents-file/' + fileId,
            type: 'post',
            data: {
                _token: token
            },
            success: function(result) {
                window.location = '/documents/' + documentId + '/edit?';
            }
        });
    }

});
//datatable search and search date
$(document).ready(function() {
    $('dataTables-example.display').DataTable();
    var table = $('#dataTables-example').DataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,
        "oLanguage": {
            "sSearch": "Tìm Kiếm: "
            },
        "dom": '<"toolbar">frtip'
    });

    $("div#dataTables-example_filter").append('<label class = "search-date">Tìm Kiếm Theo Ngày:&nbsp; </label><input id="date_range" type="text">');
    //END of the data table

    // Date range script - Start of the sscript
    $("#date_range").daterangepicker({
        autoUpdateInput: false,
        locale: {
            "cancelLabel": "Clear",
        }
    });

    $("#date_range").on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
          table.draw();
    });

    $("#date_range").on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
          table.draw();
    });
    // Date range script - END of the script

    $.fn.dataTableExt.afnFiltering.push(
    function( oSettings, aData, iDataIndex ) {

        var grab_daterange = $("#date_range").val();
        var give_results_daterange = grab_daterange.split(" to ");
        var filterstart = give_results_daterange[0];
        var filterend = give_results_daterange[1];
        var iStartDateCol = 5;
        var iEndDateCol = 5;
        var tabledatestart = aData[iStartDateCol];
        var tabledateend= aData[iEndDateCol];

        if ( !filterstart && !filterend )
        {
            return true;
        }
        else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && filterend === "")
        {
            return true;
        }
        else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isAfter(tabledatestart)) && filterstart === "")
        {
            return true;
        }
        else if ((moment(filterstart).isSame(tabledatestart) || moment(filterstart).isBefore(tabledatestart)) && (moment(filterend).isSame(tabledateend) || moment(filterend).isAfter(tabledateend)))
        {
            return true;
        }
        return false;
    });

    //End of the datable
});

//end datatable
$(document).ready(function () {
    // scripts for menu
    $("span.menu").click(function() {
        $("ul.nav1").slideToggle( 300, function() {
        // Animation complete.
        });
    });

    $(window).on("resize", function() {
        if ($(window).width() > 640) {
            $("ul.nav1").css('display', 'block');
        }
    }).resize();

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image-url').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function () {
        $('#image_hidden').val('');
        readURL(this);
    });

    // show form modal edit department
    var edit_id = null;
    $('a[name="department_edit"]').on('click', function(){
        var id = $('td:first', $(this).parents('tr')).text();

        edit_id = id;
        $.get('/admin/departments/'+ id + '/edit', function(response){
            for (var i in response) {
                $('input[name="'+i+'"]').val(response[i]);
            }
        },'json');
    });

    // update department
    $('#updateDepartment').click(function(){
        var name = $('#edit_form').find('input[name=name]').val();
        var alias = $('#edit_form').find('input[name=alias]').val();
        var address = $('#edit_form').find('input[name=address]').val();
        var token = $('meta[name="csrf-token"]').attr('content');
        var id = edit_id;
        var URL = '/admin/departments/'+id;
        var formdata = {
            'name' : name,
            'alias' : alias,
            'address' : address,
            '_token' : token
        };

        $.ajax({
            url: URL,
            type: 'PUT',
            data: formdata,
            dataType: 'json',
            success: function(result) {
                window.location = '/departments';
            },
            error: function(data) {
                if( data.status === 422 ) {
                    var errors = data.responseJSON;
                    errorHtml='<div class="alert alert-danger"><ul>';
                    $.each( errors, function( key, value ) {
                       errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $( '#formerrors' ).html( errorHtml );
                }
            }
        });
    });

    //edit form typedocument
    $('a[name="typedocument_edit"]').on('click', function(){
        // var id = $('td:first', $(this).parents('tr')).text();
        var btn = event.currentTarget;
        var td = $(btn).parent().parent().children('td')[0];
        var id = $(td).children('input.typedocId').val();
        edit_id = id;
        $.get('/typedocuments/'+ id + '/edit', function(response){
            for (var i in response) {
                $('input[name="'+i+'"]').val(response[i]);
                $('textarea[name="'+i+'"]').val(response[i]);
            }
        },'json');
    });

    //update typedocument
    $('#updateTypeDocument').click(function(){
        var name =$('input[name=name]').val();
        var description = $('textarea[name=description]').val();
        var token = $('meta[name="csrf-token"]').attr('content');
        var id = edit_id;
        console.log(id);
        var URL = '/typedocuments/'+id;
        var formdata = {
            'name' : name,
            'description' : description,
            '_token' : token
        };

        $.ajax({
            url: URL,
            type: 'PUT',
            data: formdata,
            dataType: 'json',
            success: function(result) {
                window.location = '/typedocuments';
            },
            error: function(data) {
                if( data.status === 422 ) {
                    var errors = data.responseJSON;
                    errorHtml='<div class="alert alert-danger"><ul>';
                    $.each( errors, function( key, value ) {
                       errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $( '#formerrors' ).html( errorHtml );
                }
            }
        });
    });

    // show department
    $('a[name="showDepartment"]').click(function(event) {
        var btn = event.currentTarget;
        var td = $(btn).parent().parent().children('td')[0];
        var id = $(td).children('input.departmentId').val();

        $.get('/departments/'+ id, function(response) {
            for (var i in response) {
                $('#' + i).val(response[i]);
            }
        },'json');
    });

});
