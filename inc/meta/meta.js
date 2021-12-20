
$("#jdate").persianDatepicker({
    showGregorianDate: true,
    onSelect: function () {
        $("#gdate").text("data-gdate");
    }
});
