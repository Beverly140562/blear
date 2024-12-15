document.getElementById('show_hide_password').addEventListener('click', function() {
    var passwordField = document.querySelector('input[name="password"]');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        this.textContent = 'Hide';
    } else {
        passwordField.type = 'password';
        this.textContent = 'Show';
    }
});