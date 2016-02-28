<div class="formWrap">
    <h1>User Registration</h1>
    <form id="registerForm">
       <input type="hidden" name="register" value="register">
        <input type="text" name="first_name" value="" placeholder="First Name" required>
        <input type="text" name="last_name" value="" placeholder="Last Name" required>
        <input type="email" name="email" value="" placeholder="Email" required>
        <input id="password" type="password" name="password" value="" placeholder="Password" required>
        <input id="confirmPassword" type="password" name="" value="" placeholder="Confirm Password" required>
        <div id="info" class="error" style="display: none;"></div>
        <input type="button" class="button" id="doRegister" name="register" value="Register">
    </form>
    <a id="login" href="#">Return to Login</a>
</div>
