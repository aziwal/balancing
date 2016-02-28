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
        $.post({
            data: $('#registerForm').serializeArray(),
            url: "./process_registration.php",             
            dataType: "html",                
            success: function(data){   
               $('.mainContent').html(data);
            }
        });
    }).on('click', '#doLogin', function(){        
        $.post({
            data: $('#loginForm').serializeArray(),
            url: "./process_login.php",             
            dataType: "html",                
            success: function(data){ 
                data ? $('.mainContent').html(data) : window.location = './';
            }
        });
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
