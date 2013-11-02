function weightSubmit() {

    /* Extend localStorage Functionality */
    Storage.prototype.setObject = function(key, value) { 
        this.setItem(key, JSON.stringify(value)); 
    }
    Storage.prototype.getObject = function(key) { 
        var value = this.getItem(key);
        return value && JSON.parse(value); 
    }

    var _retryConnectionInterval = 1 * 60 * 1000,
        _ajaxTimeout = 30 * 1000;
    this.toBeSent = localStorage.getObject('toBeSent') || [];
    // this.toBeSent = [];

    // console.log(this);
    // console.log(this.russell);
    
    $('#weightsForm').submit(function() {
        var data = {},
            parent = $(this);

        $('select, input[type=text]', parent).each(function(){
            data[$(this).attr('name')] = $(this).val();
        });

        // console.log('Submit clicked');
        // console.log(data);

        // console.log('this.teBeSent');
        // console.log(weightSubmit.toBeSent);

        weightSubmit.toBeSent.push(data);
        localStorage.setObject('toBeSent', weightSubmit.toBeSent);

        console.log('localStorage');
        console.log(localStorage);
        // console.log(localStorage.toBeSent);

        // localStorage.setObject('toBeSent', []);
        return false;

    });

    function _sendAjaxData(data,i){
        var ajaxOptions = {
            type:'POST',
            url:'submit.php',
            data:{'data':escape(JSON.stringify(data[0]))},
            timeout : _ajaxTimeout,
            success : function(response) {
                if(response.result == "success"){
                    //console.log(response);
                    //console.log(data);
                    //console.log('Data sent; item removed from localStorage');
                    weightSubmit.toBeSent.splice(0, 1);
                    localStorage.setObject('toBeSent',weightSubmit.toBeSent);
                    
                    //console.log('Success: Data sent; localStorage HAS been modified')
                    _localStorageConnectionLoop();
                } else {
                    //console.log('PHP Error: Data NOT sent; localStorage NOT modified')
                }
            },
            error:function() {
                // Do nothing
                //console.log('Error: Data NOT sent; localStorage NOT cleared')
            }
        };
        $.ajax(ajaxOptions);
    }

    function _localStorageConnectionLoop(){
        //console.log('Trying to send data');
        if(weightSubmit.toBeSent.length > 0){ 
            //console.log('localStorage has content. ' + toBeSent.length + ' entries.');  
            _sendAjaxData(weightSubmit.toBeSent);  
        } else {
            //console.log('localStorage has NO content');  
        }
    }

    setInterval(_localStorageConnectionLoop, _retryConnectionInterval);

    this.storageArray = localStorage.getObject('toBeSent') || [];

} //ipadSignup()

var weightSubmit = new weightSubmit();