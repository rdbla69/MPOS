// Settings Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize navigation
    initNavigation();

    // Initialize forms
    initForms();

    // Initialize actions
    initActions();
});

// Initialize navigation
function initNavigation() {
    const navItems = document.querySelectorAll('.nav-item');
    const sections = document.querySelectorAll('.settings-section');

    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const sectionId = this.dataset.section;

            // Update active nav item
            navItems.forEach(nav => nav.classList.remove('active'));
            this.classList.add('active');

            // Update active section
            sections.forEach(section => section.classList.remove('active'));
            document.getElementById(sectionId).classList.add('active');
        });
    });
}

// Initialize forms
function initForms() {
    // Profile form
    const profileForm = document.getElementById('profileForm');
    if (profileForm) {
        profileForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const fullName = document.getElementById('fullName').value;
            showNotification(`Profile updated for ${fullName}!`, 'success');
        });
    }

    // Shop form
    const shopForm = document.getElementById('shopForm');
    if (shopForm) {
        shopForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const shopName = document.getElementById('shopName').value;
            showNotification(`Shop information updated for ${shopName}!`, 'success');
        });
    }

    // Preferences form
    const preferencesForm = document.getElementById('preferencesForm');
    if (preferencesForm) {
        preferencesForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const theme = document.getElementById('theme').value;
            const currency = document.getElementById('currency').value;
            showNotification(`Preferences saved! Theme: ${theme}, Currency: ${currency}`, 'success');
        });
    }

    // AI form
    const aiForm = document.getElementById('aiForm');
    if (aiForm) {
        aiForm.addEventListener('submit', function(e) {
            e.preventDefault();
            showNotification('AI/ML settings saved successfully!', 'success');
        });
    }

    // Password form
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const currentPassword = document.getElementById('currentPassword').value;
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (!currentPassword || !newPassword || !confirmPassword) {
                showNotification('Please fill in all password fields', 'error');
                return;
            }

            if (newPassword !== confirmPassword) {
                showNotification('New passwords do not match!', 'error');
                return;
            }

            if (newPassword.length < 6) {
                showNotification('Password must be at least 6 characters', 'error');
                return;
            }

            showNotification('Password updated successfully!', 'success');
            passwordForm.reset();
        });
    }
}

// Initialize actions
function initActions() {
    // Upload photo
    const uploadPhoto = document.getElementById('uploadPhoto');
    if (uploadPhoto) {
        uploadPhoto.addEventListener('click', function() {
            showNotification('Photo upload feature coming soon!', 'info');
        });
    }

    // Remove photo
    const removePhoto = document.getElementById('removePhoto');
    if (removePhoto) {
        removePhoto.addEventListener('click', function() {
            if (confirm('Are you sure you want to remove your profile photo?')) {
                showNotification('Profile photo removed!', 'success');
            }
        });
    }

    // 2FA toggle
    const enable2FA = document.getElementById('enable2FA');
    if (enable2FA) {
        enable2FA.addEventListener('change', function() {
            if (this.checked) {
                showNotification('Two-Factor Authentication enabled!', 'success');
            } else {
                showNotification('Two-Factor Authentication disabled!', 'info');
            }
        });
    }

    // Auto backup toggle
    const autoBackup = document.getElementById('autoBackup');
    if (autoBackup) {
        autoBackup.addEventListener('change', function() {
            if (this.checked) {
                showNotification('Auto backup enabled!', 'success');
            } else {
                showNotification('Auto backup disabled!', 'info');
            }
        });
    }

    // Backup actions
    const backupBtn = document.querySelector('.action-btn.backup');
    if (backupBtn) {
        backupBtn.addEventListener('click', function() {
            showNotification('Creating database backup...', 'info');
            setTimeout(() => {
                showNotification('Backup created successfully!', 'success');
            }, 2000);
        });
    }

    const restoreBtn = document.querySelector('.action-btn.restore');
    if (restoreBtn) {
        restoreBtn.addEventListener('click', function() {
            showNotification('Restore backup feature coming soon!', 'info');
        });
    }

    // Danger zone actions
    const resetWorkers = document.getElementById('resetWorkers');
    if (resetWorkers) {
        resetWorkers.addEventListener('click', function() {
            if (confirm('⚠️ WARNING: This will delete ALL worker data!\n\nAre you sure you want to continue?')) {
                if (confirm('This action CANNOT be undone!\n\nType "CONFIRM" to proceed.')) {
                    showNotification('Worker data has been reset!', 'success');
                }
            }
        });
    }

    const clearInventory = document.getElementById('clearInventory');
    if (clearInventory) {
        clearInventory.addEventListener('click', function() {
            if (confirm('⚠️ WARNING: This will delete ALL inventory data!\n\nAre you sure you want to continue?')) {
                if (confirm('This action CANNOT be undone!\n\nType "CONFIRM" to proceed.')) {
                    showNotification('Inventory data has been cleared!', 'success');
                }
            }
        });
    }

    const clearSales = document.getElementById('clearSales');
    if (clearSales) {
        clearSales.addEventListener('click', function() {
            if (confirm('⚠️ WARNING: This will delete ALL sales history!\n\nAre you sure you want to continue?')) {
                if (confirm('This action CANNOT be undone!\n\nType "CONFIRM" to proceed.')) {
                    showNotification('Sales history has been cleared!', 'success');
                }
            }
        });
    }

    const resetDatabase = document.getElementById('resetDatabase');
    if (resetDatabase) {
        resetDatabase.addEventListener('click', function() {
            if (confirm('🚨 CRITICAL WARNING 🚨\n\nThis will COMPLETELY WIPE the entire database!\n\nALL DATA will be PERMANENTLY DELETED!\n\nAre you ABSOLUTELY sure?')) {
                const verification = prompt('Type "RESET DATABASE" in ALL CAPS to confirm:');
                if (verification === 'RESET DATABASE') {
                    showNotification('Database reset initiated...', 'info');
                    setTimeout(() => {
                        showNotification('Database has been completely reset!', 'success');
                    }, 3000);
                } else {
                    showNotification('Database reset cancelled', 'info');
                }
            }
        });
    }

    // AI toggle listeners
    const aiToggles = ['salesPrediction', 'smartInventory', 'productRecommend', 'customerInsights', 'smartNotifications'];
    aiToggles.forEach(id => {
        const toggle = document.getElementById(id);
        if (toggle) {
            toggle.addEventListener('change', function() {
                const feature = this.id.replace(/([A-Z])/g, ' $1').trim();
                const status = this.checked ? 'enabled' : 'disabled';
                showNotification(`${feature} ${status}!`, 'info');
            });
        }
    });

    // Preferences change listeners
    const theme = document.getElementById('theme');
    if (theme) {
        theme.addEventListener('change', function() {
            showNotification(`Theme changed to ${this.value} mode`, 'info');
        });
    }

    const currency = document.getElementById('currency');
    if (currency) {
        currency.addEventListener('change', function() {
            const currencyName = this.options[this.selectedIndex].text;
            showNotification(`Currency changed to ${currencyName}`, 'info');
        });
    }

    const autoPrint = document.getElementById('autoPrint');
    if (autoPrint) {
        autoPrint.addEventListener('change', function() {
            const status = this.checked ? 'enabled' : 'disabled';
            showNotification(`Auto-print receipt ${status}!`, 'info');
        });
    }
}

// Show notification
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 2rem;
        right: 2rem;
        padding: 1rem 1.5rem;
        background: #1e293b;
        border: 1px solid ${type === 'success' ? 'rgba(34, 197, 94, 0.5)' : type === 'error' ? 'rgba(239, 68, 68, 0.5)' : 'rgba(59, 130, 246, 0.5)'};
        border-radius: 8px;
        color: ${type === 'success' ? '#22c55e' : type === 'error' ? '#ef4444' : '#3b82f6'};
        z-index: 10001;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        animation: slideIn 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        max-width: 400px;
    `;
    
    const icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
    notification.innerHTML = `<span style="font-size: 1.2rem;">${icon}</span> ${message}`;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

