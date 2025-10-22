<?php
$pageTitle = "Machine System POS - Admin Login";
ob_start();
?>

<form class="login-form" id="loginForm" method="POST" action="auth/login">
    <div class="form-group">
        <label for="username" class="form-label">
            <i class="fas fa-user"></i>
            Username
        </label>
        <div class="input-container">
            <input 
                type="text" 
                id="username" 
                name="username" 
                class="form-input" 
                placeholder="Enter your username"
                required
                autocomplete="username"
            >
            <i class="fas fa-user input-icon"></i>
        </div>
    </div>

    <div class="form-group">
        <label for="password" class="form-label">
            <i class="fas fa-lock"></i>
            Password
        </label>
        <div class="input-container">
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-input" 
                placeholder="Enter your password"
                required
                autocomplete="current-password"
            >
            <i class="fas fa-lock input-icon"></i>
            <button type="button" class="password-toggle" id="passwordToggle">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>

    <div class="form-options">
        <label class="checkbox-container">
            <input type="checkbox" id="remember" name="remember">
            <span class="checkmark"></span>
            Remember me
        </label>
        <a href="#" class="forgot-password">Forgot password?</a>
    </div>

    <button type="submit" class="login-button" id="loginButton">
        <span class="button-text">Sign In</span>
        <i class="fas fa-arrow-right button-icon"></i>
    </button>

    <div class="login-alert" id="loginAlert" style="display: none;">
        <i class="fas fa-exclamation-triangle"></i>
        <span id="alertMessage"></span>
    </div>
</form>

<?php
$content = ob_get_clean();
include 'app/Views/layouts/login-layout.php';
?>
