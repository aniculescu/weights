/* Extend localStorage Functionality */
Storage.prototype.setObject = function(key, value) { 
    this.setItem(key, JSON.stringify(value)); 
}
Storage.prototype.getObject = function(key) { 
    var value = this.getItem(key);
    return value && JSON.parse(value); 
}

var _localStorageData = localStorage.getObject('toBeSent') || [];
var _localStorageMaxWeights = localStorage.getObject('maxWeights') || [];

(function(){

    function weightSubmit() {

        /* Set function-wide variables and defaults */
        var _retryConnectionInterval = 1 * 60 * 1000,
            _ajaxTimeout = 30 * 1000;
        
        $('#weightsForm').submit(function() {
            var formData = {},
                parent = $(this);

            $('select, input[type=text]', parent).each(function(){
                formData[$(this).attr('name')] = $(this).val();
            });

            _localStorageData.push(formData);
            localStorage.setObject('toBeSent', _localStorageData);

            // localStorage.setObject('toBeSent', []);
            showPreviousWeight();
            return false;

        });

        /* Show previous weight for selected user */
        $('#user_id').change(function(){
            showPreviousWeight();
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

    var weightSubmit = new weightSubmit();

    function showPreviousWeight(){
        var newMaxWeights = {}
            currentUser = $('#user_id').val();
            console.log("current");
            console.log(currentUser);
        for(i=0;i<_localStorageData.length;i++){
            var exerciseStats = _localStorageData[i];
            // console.log(exerciseStats);
            if(currentUser == exerciseStats.user_id){
                console.log(exerciseStats.user_id);
                for(var propertyName in exerciseStats) {
                    var weight = exerciseStats[propertyName];
                    if((propertyName.indexOf("ex") == 0) && weight > 0){
                        newMaxWeights[propertyName] = weight;
                        $("#" + propertyName).parent().prev().html(weight);
                       // you can get the value like this: myObject[propertyName]
                    }
                }
            }
        }
        localStorage.setObject('maxWeights', newMaxWeights);
    } //showPreviousWeight()
    showPreviousWeight();

})();