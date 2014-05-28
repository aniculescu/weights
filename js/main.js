(function(){
    /* Hide A */
    $('tr.day-B select').on("change", function(){
        var aDays = $('tr.day-A');
        if($(this).val() > 0){
            aDays.hide();
        } else {
            aDays.show();
        }
    });

    /* Hide B days */
    $('tr.day-A select').on("change", function(){
        var bDays = $('tr.day-B');
        if($(this).val() > 0){
            bDays.hide();
        } else {
            bDays.show();
        }
    });

    /* Hide Chart on click */
    $('#chartContainer svg').on("click", function(){
        alert('close');
        $('body').removeClass('show-chart');
    });

})();