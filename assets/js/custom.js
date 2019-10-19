(function ($) {
    $('.data-table').DataTable({
        lengthMenu: [
            [10, 20, 50, -1],
            [10, 20, 50, "All"]
        ],
    });
    $('[data-tooltip="tooltip"]').tooltip();

    $(".table tr").click(function () {
        $(this).find(".select").addClass("badge-dark").removeClass("badge-light").html("SELECTED");
        $(this).siblings().find(".select").addClass("badge-light").removeClass("badge-dark").html("SELECT");
        $('#room').val($(this).find('td:first').html());
    });
    $('.check-out-btn').click(function () {
        $('#check-out').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            weeks: true,
            minDate: 0
        });
        $('#check-out').datetimepicker('show');
    });
    $(".alert-success").delay(2000).slideUp(200, function () {
        $(this).alert('close');
    });

    var id = $('#booking').val();
    $.ajax({
        url: 'checker.php?booking_id=' + id,
        method: 'get',
        success: function (data) {
            $('#amount').val(data);
            var amount = $('#amount').val();
            $('#due').val(amount);
            $('#paid').val(0);
        }
    })
    $('#paid').keyup(function () {
        var amount = $('#amount').val();
        var paid = $(this).val();
        $('#due').val(amount - paid);
        if ($('#due').val() < 0) {
            $('.btn').attr('disabled', true);
            $('#error').text('Paid amount cannot be more than amount');
        } else {
            $('.btn').removeAttr('disabled')
            $('#error').text('');
        }
    });
    $('#check-paid').change(function () {
        if (this.checked) {
            $('#due').val(0);
            $('#paid').val($('#amount').val());
        } else {
            $('#paid').val(0);
            $('#due').val($('#amount').val());
        }
    });

    $('#edit-paid').keyup(function () {
        var amount = $('#edit-amount').val();
        var paid = $(this).val();
        $('#edit-due').val(amount - paid);
        if ($('#edit-due').val() < 0) {
            $('.btn').attr('disabled', true);
            $('#error').text('Paid amount cannot be more than amount');
        } else {
            $('.btn').removeAttr('disabled')
            $('#error').text('');
        }
    });
    $('#edit-check-paid').change(function () {
        if (this.checked) {
            $('#edit-due').val(0);
            $('#edit-paid').val($('#edit-amount').val());
        } else {
            $('#edit-paid').val(0);
            $('#edit-due').val($('#edit-amount').val());
        }
    });
    $('.solve').click(function () {
        var id = $(this).data('id');
        $('#solve-id').val(id);
    });
    $('.read').click(function () {
        var id = $(this).data('id');
        $('#read-id').val(id);
        $('#read-form').submit();
    });
    $('.from').click(function () {
        $('#from').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            weeks: true,
            minDate: 0
        });
        $('#from').datetimepicker('show');
    });
    $('.to').click(function () {
        $('#to').datetimepicker({
            format: 'Y-m-d',
            timepicker: false,
            weeks: true,
            onShow: function (ct) {
                this.setOptions({
                    minDate: $('#from').val() || false
                })
            }
        });
        $('#to').datetimepicker('show');
    });
    $('#add-type').keyup(function () {
        var type = $(this).val();
        $.get('checker.php?add-room-type=' + type, function (data) {
            $('#add-exists').html(data);
            var exists = $('#add-exists').text();
            if (exists.length > 0) {
                $('#add-button').prop('disabled', true);
            } else {
                $('#add-button').prop('disabled', false);
            }
        });
    });
    $('#update-type').keyup(function () {
        var typeId = $('#update-type-id').val();
        var type = $(this).val();
        $.get('checker.php?update-room-type=' + type + '&type-id=' + typeId, function (data) {
            $('#update-exists').html(data);
            var exists = $('#update-exists').text();
            if (exists.length > 0) {
                $('#update-button').prop('disabled', true);
            } else {
                $('#update-button').prop('disabled', false);
            }
        });
    });

    $('#add-room-no').keyup(function () {
        var roomNo = $(this).val();
        $.get('checker.php?add_room_no=' + roomNo, function (data) {
            $('#add-room-exists').html(data);
            var exists = $('#add-room-exists').text();
            if (exists.length > 0) {
                $('#add-button').prop('disabled', true);
            } else {
                $('#add-button').prop('disabled', false);
            }
        });
    });
    $('#update-room-no').keyup(function () {
        var id = $('#room-id').val();
        var roomNo = $(this).val();
        $.get('checker.php?update_room_no=' + roomNo + '&room_id=' + id, function (data) {
            $('#update-room-exists').html(data);
            var exists = $('#update-room-exists').text();
            if (exists.length > 0) {
                $('#update-button').prop('disabled', true);
            } else {
                $('#update-button').prop('disabled', false);
            }
        });
    });
})(jQuery);