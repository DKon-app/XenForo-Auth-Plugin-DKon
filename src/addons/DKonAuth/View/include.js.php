<script>
    document.addEventListener("DOMContentLoaded", function() {
        const loginForm = document.getElementById('login-form');

                loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(loginForm);

            fetch(loginForm.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error_code === 0) {
                    // Successful login
                    window.location.href = '/'; // Redirect to homepage or another page
                } else {
                    // Set the error message
                    document.getElementById('login-error').textContent = 'Login failed. Please check your credentials.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('login-error').textContent = 'An error occurred. Please try again later.';
            });
        });
    });
</script>

