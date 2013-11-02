function weightSubmit() {

    var _myScroll;
    var _success = false;
    var _retryConnectionInterval = 1 * 60 * 1000;
    var _ajaxTimeout = 30 * 1000;
    
    this.init = function() {
        $('#weightsForm').submit(function() {
            alert('yes');
            var data = {};
            var parent = $(this);
            var email = '';
            $('select', parent).each(function(){
                if($(this).val().length == 0) {
                    valid = false;
                } else {
                    data[$(this).attr('name')] = $(this).val();
                    if($(this).attr('name') == 'email') 
                        email = $(this).val();
                }
            });
            return false;
        });
        
        $('#weightsForm')
    };

    function _sendAjaxData(data,i){
        var ajaxOptions = {
            type:'POST',
            url:'../wildstar_comiccon/global/includes/php/event_signup.php',
            data:{'data':escape(JSON.stringify(data[0]))},
            timeout: _ajaxTimeout,
            success:function(response) {
                if(response.result == "success"){
                    //console.log(response);
                    //console.log(data);
                    //console.log('Data sent; item removed from localStorage');
                    var toBeSent = localStorage.getObject('toBeSent');
                    toBeSent.splice(0, 1);
                    localStorage.setObject('toBeSent',toBeSent);
                    
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
        var toBeSent = localStorage.getObject('toBeSent') || [];
        if(toBeSent.length > 0){ 
            //console.log('localStorage has content. ' + toBeSent.length + ' entries.');  
            _sendAjaxData(toBeSent);  
        } else {
            //console.log('localStorage has NO content');  
        }
    }

    /* Extend localStorage Functionality */
    Storage.prototype.setObject = function(key, value) { 
        this.setItem(key, JSON.stringify(value)); 
    }
    Storage.prototype.getObject = function(key) { 
        var value = this.getItem(key);
        return value && JSON.parse(value); 
    }

    setInterval(_localStorageConnectionLoop, _retryConnectionInterval);

    this.storageArray = localStorage.getObject('toBeSent') || [];

} //ipadSignup()

var weightSubmit = new weightSubmit();