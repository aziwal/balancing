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
    });
});
