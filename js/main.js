(function(){
    /* Hide A */
    $('tr.day-B select').live("change", function(){
        var aDays = $('tr.day-A');
        if($(this).val() > 0){
            aDays.hide();
        } else {
            aDays.show();
        }
    });

    /* Hide B days */
    $('tr.day-A select').live("change", function(){
        var bDays = $('tr.day-B');
        if($(this).val() > 0){
            bDays.hide();
        } else {
            bDays.show();
        }
    });
})();