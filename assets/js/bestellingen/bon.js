$('#bon_selector').on('change',function () {
    var date = $('option:selected').data('date');
    var time = $('option:selected').data('time');
    var table = $('option:selected').data('table')
    window.location.href = '/bestellingen/bon/inzien?time='+time+'&date='+date+'&table='+table;
});