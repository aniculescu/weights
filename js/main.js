(function(){
    /* Hide A */
    $('body').on("change", "tr.day-B select", function(){
        var aDays = $('tr.day-A');
        if($(this).val() > 0){
            aDays.hide();
        } else {
            aDays.show();
        }
    });

    /* Hide B days */
    $('body').on("change", "tr.day-A select", function(){
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