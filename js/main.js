$(function(){

    $('body').on('click', '#register', function(e){
       e.preventDefault();
       $.get({
           url: './register.php',           
            dataType: "html",     
           success: function(data) {
               $('.mainContent').html(data);
           }
       });
   }).on('click', '#login', function(e){
       e.preventDefault();
       $.get({
           url: './login.php',           
            dataType: "html",     
           success: function(data) {
               $('.mainContent').html(data);
           }
       });
   }).on('click', '#doRegister', function(){  
        var $info = $("#info");
        if ($("#password").val() !== $("#confirmPassword").val()) {
            $("#info").html('Passwords do not match.').show();
            return;
        } else {
            var checkPass = passwordStrength($("#password").val());
            if (checkPass) {
                $info.html(checkPass).show();
                return;
            }
        } 
        $info.html('').hide();
        var empty = $('#registerForm').find("input").filter(function() {
            return this.value === "";
        });
        if(!empty.length) {
            $.post({
                data: $('#registerForm').serializeArray(),
                url: "./process_registration.php",             
                dataType: "html",                
                success: function(data){   
                   $('.mainContent').html(data);
                }
            });
        }
    }).on('click', '#doLogin', function(){  
        var empty = $('#loginForm').find("input").filter(function() {
            return this.value === "";
        });
        if(!empty.length) {   
            $.post({
                data: $('#loginForm').serializeArray(),
                url: "./process_login.php",             
                dataType: "html",                
                success: function(data){ 
                    data ? $('.mainContent').html(data) : window.location = './';
                }
            });
        }
    }).on('click', '#profile', function(e){
        e.preventDefault();
        $.get({
            url: "./profile.php",             
            dataType: "html",                
            success: function(data){ 
                $('.mainContent').html(data);
            }
        });
    }).on('click', '#allUsers', function(e){
        e.preventDefault();
        $.get({
            url: "./users.php",             
            dataType: "html",                
            success: function(data){ 
                $('.mainContent').html(data);
            }
        });
    }).on('click', '.transfer', function(e){
        e.preventDefault();
        var $row = $(this).closest('li.row');
        $.post({
            url: "./transfer_balance.php",
            data: {
                'transferTo_ID': $row.attr('data-id'),
                'amount': $(this).prev().val()
            },
            dataType: "html",                
            success: function(data){ 
                data = JSON.parse(data);
                for (var i = 0; i < data.length; i++) {
                    var $rowToUpdate = $('#users').find('li[data-id="' + data[i].user_id + '"]');
                    $rowToUpdate.find('.balance').html(data[i].balance);
                }
            }
        });
    });
});

function passwordStrength(password) {   
    var result = '';
    if ( password && password.length < 6 ) {
        result = 'Password must be at least 6 character long.<br>';
    } 
    if ( !/[a-z]/.test(password) ) {
        result += 'Password must container at least one lower letter.<br>';
    }
    if ( !/[A-Z]/.test(password) ) {
        result += 'Password must container at least one capital letter.';
    }
    if ( !/\d/.test(password) ) {
        result += '<br>Password must contain one digit.';
    }
    return result;
}
