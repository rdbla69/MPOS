// Login Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const passwordToggle = document.getElementById('passwordToggle');
    const passwordInput = document.getElementById('password');
    const loginButton = document.getElementById('loginButton');
    const loginAlert = document.getElementById('loginAlert');
    const alertMessage = document.getElementById('alertMessage');

    // Password toggle functionality
    passwordToggle.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });

    // Form validation
    function validateForm() {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();

        if (!username) {
            showAlert('Please enter your username', 'error');
            return false;
        }

        if (!password) {
            showAlert('Please enter your password', 'error');
            return false;
        }

        if (username.length < 3) {
            showAlert('Username must be at least 3 characters long', 'error');
            return false;
        }

        if (password.length < 6) {
            showAlert('Password must be at least 6 characters long', 'error');
            return false;
        }

        return true;
    }

    // Show alert message
    function showAlert(message, type = 'error') {
        alertMessage.textContent = message;
        loginAlert.style.display = 'flex';
        loginAlert.className = `login-alert ${type}`;
        
        // Auto hide after 5 seconds
        setTimeout(() => {
            hideAlert();
        }, 5000);
    }

    // Hide alert message
    function hideAlert() {
        loginAlert.style.display = 'none';
    }

    // Set loading state
    function setLoadingState(loading) {
        if (loading) {
            loginButton.classList.add('loading');
            loginButton.disabled = true;
            loginButton.querySelector('.button-icon').className = 'fas fa-spinner button-icon';
        } else {
            loginButton.classList.remove('loading');
            loginButton.disabled = false;
            loginButton.querySelector('.button-icon').className = 'fas fa-arrow-right button-icon';
        }
    }

    // Form submission
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Hide any existing alerts
        hideAlert();
        
        // Validate form
        if (!validateForm()) {
            return;
        }

        // Set loading state
        setLoadingState(true);

        // Get form data
        const formData = new FormData(loginForm);
        
        // Simulate API call (replace with actual endpoint)
        fetch('auth/login', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            setLoadingState(false);
            
            if (data.success) {
                // Show success message
                showAlert('Login successful! Redirecting...', 'success');
                
                // Redirect to dashboard
                setTimeout(() => {
                    window.location.href = data.redirect || 'dashboard';
                }, 1500);
            } else {
                // Show error message
                showAlert(data.message || 'Invalid username or password', 'error');
            }
        })
        .catch(error => {
            setLoadingState(false);
            console.error('Login error:', error);
            showAlert('An error occurred. Please try again.', 'error');
        });
    });

    // Input focus effects
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('focused');
        });
    });

    // Enter key handling
    document.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const activeElement = document.activeElement;
            if (activeElement.classList.contains('form-input')) {
                loginForm.dispatchEvent(new Event('submit'));
            }
        }
    });

    // Auto-focus username field
    document.getElementById('username').focus();

    // Add some visual feedback for form interactions
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach(group => {
        const input = group.querySelector('.form-input');
        const label = group.querySelector('.form-label');
        
        input.addEventListener('input', function() {
            if (this.value.length > 0) {
                label.classList.add('active');
            } else {
                label.classList.remove('active');
            }
        });
    });

    // Add smooth transitions for better UX
    const style = document.createElement('style');
    style.textContent = `
        .form-group.focused .form-label {
            color: #3b82f6;
        }
        
        .form-group.focused .input-icon {
            color: #3b82f6;
        }
        
        .form-label.active {
            color: #3b82f6;
        }
        
        .login-alert.success {
            background: rgba(34, 197, 94, 0.1);
            border-color: rgba(34, 197, 94, 0.3);
            color: #86efac;
        }
        
        .login-alert.success i {
            color: #22c55e;
        }
    `;
    document.head.appendChild(style);
});
