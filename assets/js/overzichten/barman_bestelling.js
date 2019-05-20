$('#bon_selector').on('change', function () {
    var date = $('option:selected').data('date');
    var time = $('option:selected').data('time')
    var table = $('option:selected').data('table')
    alert($('option:selected').data('date'));
});