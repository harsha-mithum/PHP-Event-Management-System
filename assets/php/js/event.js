// progress
function fetchProgress() {
    id = $('#event_id').val();
    var value = 0;
    $.ajax({
        url: 'assets/php/admin-action.php',
        method: 'post',
        data: { progress: id },
        success: function(response) {
            data = JSON.parse(response)
            value = parseInt(data.progress);
            checkValue(value);
        }
    });
}

$("#progressSubmit").on('click', function() {
    id = $('#event_id').val();
    var value = $('.progress-bar').attr('aria-valuenow');
    $.ajax({
        type: "POST",
        url: "assets/php/admin-action.php",
        data: {
            progress_submit: value,
            event_id: id
        },
        success: function(response) {
            $("#progressAlert").html(response);
            // fetchProgress();
            location.reload();
        }
    });
});

function checkValue(value) {
    //     var current = $('.progress-bar').attr('aria-valuenow');
    valeur = parseInt(value, 10);
    switch (valeur) {
        case 20:

            $('#c1').bootstrapToggle('on');
            break;
        case 40:
            $('#c1').bootstrapToggle('on');
            $('#c2').bootstrapToggle('on');
            break;
        case 60:
            $('#c1').bootstrapToggle('on');
            $('#c2').bootstrapToggle('on');
            $('#c3').bootstrapToggle('on');
            break;
        case 80:
            $('#c1').bootstrapToggle('on');
            $('#c2').bootstrapToggle('on');
            $('#c3').bootstrapToggle('on');
            $('#c4').bootstrapToggle('on');
            break;
        case 100:
            $('#c1').bootstrapToggle('on');
            $('#c2').bootstrapToggle('on');
            $('#c3').bootstrapToggle('on');
            $('#c4').bootstrapToggle('on');
            $('#c5').bootstrapToggle('on');
            break;
        default:
            $('#c1').bootstrapToggle('off');
            $('#c2').bootstrapToggle('off');
            $('#c3').bootstrapToggle('off');
            $('#c4').bootstrapToggle('off');
            $('#c5').bootstrapToggle('off');
            break;
    }

}

function disableButton() {
    var current = $('.progress-bar').attr('aria-valuenow');
    val = parseInt(current, 10);
    switch (val) {
        case 20:
            $('#c1').bootstrapToggle('enable');
            $('#c2').bootstrapToggle('enable');
            $('#c3').bootstrapToggle('disable');
            $('#c4').bootstrapToggle('disable');
            $('#c5').bootstrapToggle('disable');
            break;
        case 40:
            $('#c1').bootstrapToggle('disable');
            $('#c2').bootstrapToggle('enable');
            $('#c3').bootstrapToggle('enable');
            $('#c4').bootstrapToggle('disable');
            $('#c5').bootstrapToggle('disable');
            break;
        case 60:
            $('#c1').bootstrapToggle('disable');
            $('#c2').bootstrapToggle('disable');
            $('#c3').bootstrapToggle('enable');
            $('#c4').bootstrapToggle('enable');
            $('#c5').bootstrapToggle('disable');
            break;
        case 80:
            $('#c1').bootstrapToggle('disable');
            $('#c2').bootstrapToggle('disable');
            $('#c3').bootstrapToggle('disable');
            $('#c4').bootstrapToggle('enable');
            $('#c5').bootstrapToggle('enable');
            break;
        case 100:
            $('#c1').bootstrapToggle('disable');
            $('#c2').bootstrapToggle('disable');
            $('#c3').bootstrapToggle('disable');
            $('#c4').bootstrapToggle('disable');
            $('#c5').bootstrapToggle('enable');
            break;
        default:
            $('#c1').bootstrapToggle('enable');
            $('#c2').bootstrapToggle('disable');
            $('#c3').bootstrapToggle('disable');
            $('#c4').bootstrapToggle('disable');
            $('#c5').bootstrapToggle('disable');
            break;
    }
}