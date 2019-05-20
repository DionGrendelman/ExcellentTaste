$('#loadReserveringen').load('/controllers/tables/reserveringen/loadReservering.php', function () {
});

$('#newReservering').on('click',function () {
    window.location.href = '/reserveringen/nieuw';
});