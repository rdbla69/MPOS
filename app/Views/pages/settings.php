<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_name'])) {
    header('Location: login.php');
    exit();
}

$adminName = $_SESSION['admin_name'] ?? 'Admin';
$adminUsername = $_SESSION['admin_username'] ?? 'admin';

$pageTitle = "Settings - Machine System POS";
ob_start();
?>

<div class="dashboard-container">
    <!-- Sidebar -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <i class="fas fa-cogs"></i>
                <h3>MACHINE POS</h3>
            </div>
        </div>
        
        <ul class="sidebar-menu">
            <li class="menu-item">
                <a href="dashboard.php" class="menu-link">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="pos.php" class="menu-link">
                    <i class="fas fa-cash-register"></i>
                    <span>POS</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="inventory.php" class="menu-link">
                    <i class="fas fa-boxes"></i>
                    <span>Inventory</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="workers.php" class="menu-link">
                    <i class="fas fa-users"></i>
                    <span>Workers</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="job-orders.php" class="menu-link">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Job Orders</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="reports.php" class="menu-link">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </a>
            </li>
            <li class="menu-item">
                <a href="messages.php" class="menu-link">
                    <i class="fas fa-comments"></i>
                    <span>Messages</span>
                </a>
            </li>
            <li class="menu-item active">
                <a href="settings.php" class="menu-link">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </li>
            <li class="menu-item logout">
                <a href="logout.php" class="menu-link">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <header class="settings-header">
            <div class="header-content">
                <div class="header-title">
                    <i class="fas fa-cog"></i>
                    <div>
                        <h1>System Settings</h1>
                        <p class="header-description">Manage your system configuration and preferences</p>
                    </div>
                </div>
                <div class="profile-info">
                    <i class="fas fa-user-circle"></i>
                    <span><?php echo htmlspecialchars($adminName); ?></span>
                </div>
            </div>
        </header>

        <!-- Settings Content -->
        <div class="settings-content">
            <!-- Settings Navigation -->
            <div class="settings-nav">
                <button class="nav-item active" data-section="profile">
                    <i class="fas fa-user"></i> Profile
                </button>
                <button class="nav-item" data-section="shop">
                    <i class="fas fa-store"></i> Shop Info
                </button>
                <button class="nav-item" data-section="preferences">
                    <i class="fas fa-sliders-h"></i> Preferences
                </button>
                <button class="nav-item" data-section="ai">
                    <i class="fas fa-brain"></i> AI/ML
                </button>
                <button class="nav-item" data-section="security">
                    <i class="fas fa-shield-alt"></i> Security
                </button>
                <button class="nav-item" data-section="system">
                    <i class="fas fa-database"></i> System
                </button>
            </div>

            <!-- Settings Sections -->
            <div class="settings-sections">
                <!-- Admin Profile Settings -->
                <div class="settings-section active" id="profile">
                    <div class="section-header">
                        <h2><i class="fas fa-user"></i> Admin Profile Settings</h2>
                        <p>Manage your personal information and profile settings</p>
                    </div>
                    <div class="settings-card">
                        <div class="profile-photo-section">
                            <div class="current-photo">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($adminName); ?>&background=3b82f6&color=fff&size=120" alt="Profile" id="profilePhoto">
                            </div>
                            <div class="photo-actions">
                                <button class="btn-secondary" id="uploadPhoto">
                                    <i class="fas fa-upload"></i> Upload Photo
                                </button>
                                <button class="btn-text" id="removePhoto">
                                    <i class="fas fa-trash"></i> Remove
                                </button>
                            </div>
                        </div>
                        <form id="profileForm" class="settings-form">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" id="fullName" class="form-input" value="<?php echo htmlspecialchars($adminName); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" id="username" class="form-input" value="<?php echo htmlspecialchars($adminUsername); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" id="email" class="form-input" value="admin@machine.com">
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="tel" id="phone" class="form-input" value="+63 912 345 6789">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Shop Information -->
                <div class="settings-section" id="shop">
                    <div class="section-header">
                        <h2><i class="fas fa-store"></i> Shop Information</h2>
                        <p>Configure your shop details and business information</p>
                    </div>
                    <div class="settings-card">
                        <form id="shopForm" class="settings-form">
                            <div class="form-row">
                                <div class="form-group full">
                                    <label>Shop Name</label>
                                    <input type="text" id="shopName" class="form-input" value="Innovative Machine POS System">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group full">
                                    <label>Address</label>
                                    <textarea id="shopAddress" class="form-textarea" rows="3">123 Main Street, Makati City, Metro Manila, Philippines 1200</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="tel" id="shopPhone" class="form-input" value="+63 2 1234 5678">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="shopEmail" class="form-input" value="contact@machine.com">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label>TIN Number</label>
                                    <input type="text" id="shopTin" class="form-input" value="123-456-789-000">
                                </div>
                                <div class="form-group">
                                    <label>Business Permit</label>
                                    <input type="text" id="shopPermit" class="form-input" value="BP-2024-001">
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- System Preferences -->
                <div class="settings-section" id="preferences">
                    <div class="section-header">
                        <h2><i class="fas fa-sliders-h"></i> System Preferences</h2>
                        <p>Customize system appearance and behavior</p>
                    </div>
                    <div class="settings-card">
                        <form id="preferencesForm" class="settings-form">
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-palette"></i> Theme</h4>
                                    <p>Choose your preferred color scheme</p>
                                </div>
                                <select id="theme" class="form-select">
                                    <option value="dark" selected>Dark Mode</option>
                                    <option value="light">Light Mode</option>
                                    <option value="auto">Auto (System)</option>
                                </select>
                            </div>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-money-bill-wave"></i> Currency</h4>
                                    <p>Default currency for transactions</p>
                                </div>
                                <select id="currency" class="form-select">
                                    <option value="PHP" selected>Philippine Peso (₱)</option>
                                    <option value="USD">US Dollar ($)</option>
                                    <option value="EUR">Euro (€)</option>
                                </select>
                            </div>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-calendar"></i> Date Format</h4>
                                    <p>How dates are displayed</p>
                                </div>
                                <select id="dateFormat" class="form-select">
                                    <option value="MM/DD/YYYY" selected>MM/DD/YYYY</option>
                                    <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                                    <option value="YYYY-MM-DD">YYYY-MM-DD</option>
                                </select>
                            </div>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-clock"></i> Time Zone</h4>
                                    <p>Local time zone settings</p>
                                </div>
                                <select id="timezone" class="form-select">
                                    <option value="Asia/Manila" selected>Manila (GMT+8)</option>
                                    <option value="UTC">UTC (GMT+0)</option>
                                    <option value="America/New_York">New York (GMT-5)</option>
                                </select>
                            </div>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-receipt"></i> Auto-Print Receipt</h4>
                                    <p>Automatically print after transaction</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="autoPrint" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i> Save Preferences
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- AI/ML Settings -->
                <div class="settings-section" id="ai">
                    <div class="section-header">
                        <h2><i class="fas fa-brain"></i> AI & Machine Learning</h2>
                        <p>Configure intelligent features and predictive analytics</p>
                    </div>
                    <div class="settings-card">
                        <div class="ai-banner">
                            <i class="fas fa-robot"></i>
                            <div>
                                <h3>AI-Powered Features</h3>
                                <p>Enable smart recommendations and predictive insights</p>
                            </div>
                            <span class="beta-badge">BETA</span>
                        </div>
                        <form id="aiForm" class="settings-form">
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-chart-line"></i> Sales Prediction</h4>
                                    <p>Forecast future sales based on historical data</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="salesPrediction" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-boxes"></i> Smart Inventory</h4>
                                    <p>Auto-suggest reorder quantities</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="smartInventory" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-lightbulb"></i> Product Recommendations</h4>
                                    <p>Suggest products based on purchase patterns</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="productRecommend" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-users"></i> Customer Insights</h4>
                                    <p>Analyze customer behavior and trends</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="customerInsights">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4><i class="fas fa-bell"></i> Smart Notifications</h4>
                                    <p>Intelligent alerts and reminders</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="smartNotifications" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-save"></i> Save AI Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div class="settings-section" id="security">
                    <div class="section-header">
                        <h2><i class="fas fa-shield-alt"></i> Security Settings</h2>
                        <p>Protect your system with advanced security features</p>
                    </div>
                    <div class="settings-card">
                        <div class="security-section">
                            <h3><i class="fas fa-key"></i> Change Password</h3>
                            <form id="passwordForm" class="settings-form">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <input type="password" id="currentPassword" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" id="newPassword" class="form-input">
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input type="password" id="confirmPassword" class="form-input">
                                </div>
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-lock"></i> Update Password
                                </button>
                            </form>
                        </div>

                        <div class="security-section">
                            <h3><i class="fas fa-user-check"></i> Two-Factor Authentication</h3>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4>Enable 2FA</h4>
                                    <p>Add an extra layer of security to your account</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="enable2FA">
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>

                        <div class="security-section">
                            <h3><i class="fas fa-database"></i> Backup & Recovery</h3>
                            <div class="backup-actions">
                                <button class="action-btn backup">
                                    <i class="fas fa-download"></i>
                                    <span>Create Backup</span>
                                    <small>Last backup: Never</small>
                                </button>
                                <button class="action-btn restore">
                                    <i class="fas fa-upload"></i>
                                    <span>Restore Backup</span>
                                    <small>Upload backup file</small>
                                </button>
                            </div>
                            <div class="preference-item">
                                <div class="preference-info">
                                    <h4>Auto Backup</h4>
                                    <p>Automatically backup database daily</p>
                                </div>
                                <label class="toggle-switch">
                                    <input type="checkbox" id="autoBackup" checked>
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Management -->
                <div class="settings-section" id="system">
                    <div class="section-header">
                        <h2><i class="fas fa-database"></i> System Management</h2>
                        <p>Manage system data and perform maintenance tasks</p>
                    </div>
                    <div class="settings-card">
                        <div class="danger-zone">
                            <div class="danger-header">
                                <i class="fas fa-exclamation-triangle"></i>
                                <h3>Danger Zone</h3>
                            </div>
                            <p>These actions cannot be undone. Please proceed with caution.</p>
                        </div>

                        <div class="system-actions">
                            <div class="action-card">
                                <div class="action-info">
                                    <h4><i class="fas fa-users"></i> Reset Worker Data</h4>
                                    <p>Remove all worker records from the system</p>
                                </div>
                                <button class="btn-danger" id="resetWorkers">
                                    <i class="fas fa-trash-restore"></i> Reset Workers
                                </button>
                            </div>

                            <div class="action-card">
                                <div class="action-info">
                                    <h4><i class="fas fa-boxes"></i> Clear Inventory</h4>
                                    <p>Remove all inventory items and stock data</p>
                                </div>
                                <button class="btn-danger" id="clearInventory">
                                    <i class="fas fa-eraser"></i> Clear Inventory
                                </button>
                            </div>

                            <div class="action-card">
                                <div class="action-info">
                                    <h4><i class="fas fa-receipt"></i> Clear Sales History</h4>
                                    <p>Delete all transaction and sales records</p>
                                </div>
                                <button class="btn-danger" id="clearSales">
                                    <i class="fas fa-file-excel"></i> Clear Sales
                                </button>
                            </div>

                            <div class="action-card critical">
                                <div class="action-info">
                                    <h4><i class="fas fa-database"></i> Reset Entire Database</h4>
                                    <p>Completely wipe all data and start fresh</p>
                                </div>
                                <button class="btn-critical" id="resetDatabase">
                                    <i class="fas fa-exclamation-circle"></i> Reset Database
                                </button>
                            </div>
                        </div>

                        <div class="system-info">
                            <h3><i class="fas fa-info-circle"></i> System Information</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Version</span>
                                    <span class="info-value">v1.0.0</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Database</span>
                                    <span class="info-value">MySQL 8.0</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">PHP Version</span>
                                    <span class="info-value">8.2.0</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Server</span>
                                    <span class="info-value">Apache 2.4</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php
$content = ob_get_clean();
include '../layouts/dashboard-layout.php';
?>

