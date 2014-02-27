/* Extend localStorage Functionality */
Storage.prototype.setObject = function(key, value) { 
   this.setItem(key, JSON.stringify(value)); 
}
Storage.prototype.getObject = function(key) { 
   var value = this.getItem(key);
   return value && JSON.parse(value); 
}

var _localStorageData = localStorage.getObject('toBeSent') || [];

function weightSubmit() {

   /* Set function-wide variables and defaults */
   var _retryConnectionInterval = 1 * 60 * 1000,
       _ajaxTimeout = 30 * 1000;
   
//    $('#weightsForm').submit(function() {
//        var formData = {},
//            parent = $(this);
//
//        $('select, input[type=text]', parent).each(function(){
//            formData[$(this).attr('name')] = $(this).val();
//        });
//
//        /* Make sure to update data in case data has been added since the last page refresh
//           such as when submitting data in another tab */
//        _localStorageData = localStorage.getObject('toBeSent') || [];
//        _localStorageData.push(formData);
//        localStorage.setObject('toBeSent', _localStorageData);
//
//        // localStorage.setObject('toBeSent', []);
//        showPreviousWeight();
//        return false;
//
//    });

//    /* Show previous weight for selected user */
//    $('#user_id').change(function(){
//        showPreviousWeight();
//    });

   /* Hide A days when selecting Deadlift */
   $('#exDeadlift').change(function(){
       var aDays = $('tr.day-a:not(.day-b)');
       if($(this).val() > 0)
           aDays.hide();
       else
           aDays.show();
   });

   /* Hide B days when selecting Bench */
   $('#exBenchPress').change(function(){
       var bBays = $('tr.day-b:not(.day-a)');
       if($(this).val() > 0)
           bBays.hide();
       else
           bBays.show();
   });

   /* Attempt sending data via AJAX to MySQL db */
   function _sendAjaxData(data,i){
       var ajaxOptions = {
           type:'POST',
           url:'submit.php',
           data: { 'data' : escape(JSON.stringify(data))},
           timeout : _ajaxTimeout,
           success : function(response) {
               if(response.result == "success"){
                   _localStorageData.splice(0, 1);
                   localStorage.setObject('toBeSent',_localStorageData);
                   
                   _localStorageConnectionLoop();
               } else {
               }
           },
           error:function() {
               // Do nothing
           }
       };
       $.ajax(ajaxOptions);
   }

   /* Loop responsible for sending each entry in localStorage */
   function _localStorageConnectionLoop(){
       if(_localStorageData.length > 0){ 
           _sendAjaxData(_localStorageData[0]);  
       }
       setInterval(_localStorageConnectionLoop, _retryConnectionInterval);
   }
} //weightSubmit()
weightSubmit();

function showPreviousWeight(){
   var newMaxWeights = {},
       prevMaxWeights = {},
       currentUser = $('#user_id').val();
       // console.log("current: " + currentUser);

   $('td.previous-weight').html('0').removeClass('second-time');

   for(var i=0;i<_localStorageData.length;i++){
       var exerciseStats = _localStorageData[i];
       // console.log("exerciseStats: ");
       // console.log(exerciseStats);
       if(currentUser == exerciseStats.user_id){
           // console.log(exerciseStats.user_id);
           for(var propertyName in exerciseStats) {
               // console.log("Starting for loop-----------");
               // console.log(prevMaxWeights);
               // console.log(newMaxWeights);
               var weight = exerciseStats[propertyName];
               var prevWeightCell = $("#" + propertyName).parent().prev();

               // Add weight to list of most recent weights lifted 
               if((propertyName.indexOf("ex") == 0) && weight > 0){
                   newMaxWeights[propertyName] = weight;
                   prevWeightCell.html(weight);
               }

               // TODO: Highlight second time in a row
               // if(prevMaxWeights[propertyName] == newMaxWeights[propertyName]){
               //     prevWeightCell.addClass('second-time');
               // } else {
               //     prevWeightCell.removeClass('second-time');
               // }
               // prevMaxWeights = newMaxWeights;
           }
       } // else {
         //     $('td.previous-weight').html('0');
         // }
   }
   // console.log("newMaxWeights");
   // console.log(newMaxWeights);
   // localStorage.setObject('maxWeights', newMaxWeights);
} //showPreviousWeight()
showPreviousWeight();

//Show localStorage converted to SJON
$('#showJson').click(function(){
   $('#jsonOutput').html(JSON.stringify(_localStorageData)).toggle();
   return false;
});

(function(){

   /* Set date input field value using Javascript to reflect local date and time */
   var dateString = '',
       currentDate = new Date()
       currentDay = currentDate.getDate(),
       currentMonth = currentDate.getMonth() + 1,
       currentYear = currentDate.getFullYear();

   if(currentDay < 10)
       currentDay = "0" + currentDay;

   dateString = currentYear + "-" + currentMonth + "-" + currentDay;
   $('#date').val(dateString);

})();