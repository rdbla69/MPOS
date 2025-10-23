<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Admin Login - POS System'; ?></title>
    <link rel="stylesheet" href="/pos-system/assets/css/login.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <div class="login-background">
            <div class="login-pattern"></div>
        </div>
        
        <div class="login-content">
            <div class="login-card">
                <div class="login-header">
                    <div class="logo-container">
                        <i class="fas fa-cogs"></i>
                        <h1>MACHINE SYSTEM</h1>
                    </div>
                    <p class="login-subtitle">Sign in to your account</p>
                </div>
                
                <div class="login-body">
                    <?php echo $content; ?>
                </div>
                
                <div class="login-footer">
                    <p>&copy; INNOVATIVE MACHINE POS SYSTEM. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/pos-system/assets/js/login.js?v=<?php echo time(); ?>"></script>
</body>
</html>
