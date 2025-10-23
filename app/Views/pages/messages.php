<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_name'])) {
    header('Location: login.php');
    exit();
}

$adminName = $_SESSION['admin_name'] ?? 'Admin';

// Sample messages data
$messages = [
    ['id' => 1, 'category' => 'workers', 'sender' => 'Michael Chen', 'sender_role' => 'Technician', 'subject' => 'Job Order JO-2024-001 Update', 'preview' => 'The oil change has been completed. Customer can pick up the vehicle.', 'message' => 'Hi, I wanted to update you that Job Order JO-2024-001 for Juan Dela Cruz has been completed. The oil change and brake inspection are done. The vehicle is ready for pickup.', 'timestamp' => '2024-10-23 14:30:00', 'status' => 'unread', 'avatar' => 'https://ui-avatars.com/api/?name=Michael+Chen&background=22c55e&color=fff'],
    ['id' => 2, 'category' => 'clients', 'sender' => 'Maria Santos', 'sender_role' => 'Client', 'subject' => 'Inquiry about tire replacement', 'preview' => 'Hello, I would like to inquire about the cost of tire replacement for my Honda City.', 'message' => 'Hello, I would like to inquire about the cost of tire replacement for my Honda City 2021. Can you also let me know if you have stock available? Thank you!', 'timestamp' => '2024-10-23 13:15:00', 'status' => 'read', 'avatar' => 'https://ui-avatars.com/api/?name=Maria+Santos&background=ec4899&color=fff'],
    ['id' => 3, 'category' => 'system', 'sender' => 'System Alert', 'sender_role' => 'Automated', 'subject' => 'Low Stock Warning', 'preview' => 'Engine Oil (3L) stock is running low. Current quantity: 5 units.', 'message' => 'ALERT: Engine Oil (3L) stock is running low. Current quantity: 5 units. Please reorder soon to avoid stock-out.', 'timestamp' => '2024-10-23 12:00:00', 'status' => 'unread', 'avatar' => 'https://ui-avatars.com/api/?name=System&background=ef4444&color=fff'],
    ['id' => 4, 'category' => 'workers', 'sender' => 'Lisa Wong', 'sender_role' => 'Technician', 'subject' => 'Parts Request for JO-2024-005', 'preview' => 'Need to order transmission gasket for the Ford Ranger repair.', 'message' => 'Hi, for Job Order JO-2024-005 (Carlos Mendoza - Ford Ranger), we need to order a transmission gasket. The current one is damaged beyond repair. Can you process the order?', 'timestamp' => '2024-10-23 11:45:00', 'status' => 'read', 'avatar' => 'https://ui-avatars.com/api/?name=Lisa+Wong&background=a855f7&color=fff'],
    ['id' => 5, 'category' => 'clients', 'sender' => 'Roberto Lim', 'sender_role' => 'Client', 'subject' => 'When will my vehicle be ready?', 'preview' => 'Hi, I dropped off my Mitsubishi Montero yesterday for engine tune-up. Just checking on the status.', 'message' => 'Hi, I dropped off my Mitsubishi Montero yesterday for engine tune-up and AC repair. Just checking on the status. When can I expect my vehicle to be ready? Thanks!', 'timestamp' => '2024-10-23 10:20:00', 'status' => 'unread', 'avatar' => 'https://ui-avatars.com/api/?name=Roberto+Lim&background=3b82f6&color=fff'],
    ['id' => 6, 'category' => 'workers', 'sender' => 'John Smith', 'sender_role' => 'Cashier', 'subject' => 'Payment received for JO-2024-002', 'preview' => 'Maria Santos has paid ₱4,500 for the tire replacement service.', 'message' => 'Payment confirmation: Maria Santos has paid ₱4,500 for Job Order JO-2024-002 (tire replacement service). Payment method: Cash. Receipt issued.', 'timestamp' => '2024-10-23 09:30:00', 'status' => 'read', 'avatar' => 'https://ui-avatars.com/api/?name=John+Smith&background=3b82f6&color=fff'],
    ['id' => 7, 'category' => 'system', 'sender' => 'System Alert', 'sender_role' => 'Automated', 'subject' => 'Scheduled Maintenance Reminder', 'preview' => 'Database backup scheduled for tonight at 11:00 PM.', 'message' => 'REMINDER: Scheduled database backup will run tonight at 11:00 PM. Expected duration: 15-30 minutes. System will remain operational.', 'timestamp' => '2024-10-23 08:00:00', 'status' => 'read', 'avatar' => 'https://ui-avatars.com/api/?name=System&background=f59e0b&color=fff'],
    ['id' => 8, 'category' => 'clients', 'sender' => 'Sofia Reyes', 'sender_role' => 'Client', 'subject' => 'Thank you for the excellent service!', 'preview' => 'I just picked up my Suzuki Ertiga. The battery replacement was done perfectly.', 'message' => 'I just picked up my Suzuki Ertiga. The battery replacement was done perfectly and the electrical check found no issues. Thank you for the excellent and fast service! Will definitely recommend you to my friends.', 'timestamp' => '2024-10-22 16:45:00', 'status' => 'read', 'avatar' => 'https://ui-avatars.com/api/?name=Sofia+Reyes&background=fb923c&color=fff'],
];

// Calculate unread count
$unreadCount = count(array_filter($messages, function($msg) {
    return $msg['status'] === 'unread';
}));

$pageTitle = "Messaging Center - Machine System POS";
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
            <li class="menu-item active">
                <a href="messages.php" class="menu-link">
                    <i class="fas fa-comments"></i>
                    <span>Messages</span>
                    <?php if ($unreadCount > 0): ?>
                    <span class="badge-count"><?php echo $unreadCount; ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li class="menu-item">
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
        <header class="messages-header">
            <div class="header-left">
                <div class="header-title">
                    <i class="fas fa-comments"></i>
                    <div>
                        <h1>Messaging Center</h1>
                        <p class="date-time" id="dateTime"></p>
                    </div>
                </div>
            </div>
            <div class="header-right">
                <div class="notification-badge" id="notificationBadge">
                    <i class="fas fa-bell"></i>
                    <span class="badge-count" id="unreadBadge"><?php echo $unreadCount; ?></span>
                </div>
                <button class="compose-btn" id="composeBtn">
                    <i class="fas fa-pen"></i> Compose
                </button>
            </div>
        </header>

        <!-- Messaging Layout -->
        <div class="messaging-container">
            <!-- Left Sidebar - Categories -->
            <div class="message-categories">
                <h3><i class="fas fa-folder"></i> Categories</h3>
                <ul class="category-list">
                    <li class="category-item active" data-category="all">
                        <i class="fas fa-inbox"></i>
                        <span>All Messages</span>
                        <span class="count"><?php echo count($messages); ?></span>
                    </li>
                    <li class="category-item" data-category="workers">
                        <i class="fas fa-user-tie"></i>
                        <span>Workers</span>
                        <span class="count"><?php echo count(array_filter($messages, fn($m) => $m['category'] === 'workers')); ?></span>
                    </li>
                    <li class="category-item" data-category="clients">
                        <i class="fas fa-users"></i>
                        <span>Clients</span>
                        <span class="count"><?php echo count(array_filter($messages, fn($m) => $m['category'] === 'clients')); ?></span>
                    </li>
                    <li class="category-item" data-category="system">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>System Alerts</span>
                        <span class="count"><?php echo count(array_filter($messages, fn($m) => $m['category'] === 'system')); ?></span>
                    </li>
                </ul>

                <!-- Quick Actions -->
                <div class="quick-actions">
                    <h3><i class="fas fa-bolt"></i> Quick Actions</h3>
                    <button class="quick-action-btn" onclick="markAllAsRead()">
                        <i class="fas fa-check-double"></i> Mark All as Read
                    </button>
                    <button class="quick-action-btn" onclick="deleteAllRead()">
                        <i class="fas fa-trash"></i> Delete Read Messages
                    </button>
                </div>
            </div>

            <!-- Middle Panel - Message List -->
            <div class="message-list-panel">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="messageSearch" placeholder="Search messages...">
                </div>

                <div class="filter-tabs">
                    <button class="filter-tab active" data-filter="all">All</button>
                    <button class="filter-tab" data-filter="unread">Unread</button>
                    <button class="filter-tab" data-filter="read">Read</button>
                </div>

                <div class="message-list" id="messageList">
                    <?php foreach ($messages as $msg): ?>
                    <div class="message-item <?php echo $msg['status']; ?>" data-id="<?php echo $msg['id']; ?>" data-category="<?php echo $msg['category']; ?>" data-status="<?php echo $msg['status']; ?>">
                        <div class="message-avatar">
                            <img src="<?php echo $msg['avatar']; ?>" alt="<?php echo $msg['sender']; ?>">
                            <?php if ($msg['status'] === 'unread'): ?>
                            <span class="unread-dot"></span>
                            <?php endif; ?>
                        </div>
                        <div class="message-info">
                            <div class="message-header">
                                <span class="sender-name"><?php echo htmlspecialchars($msg['sender']); ?></span>
                                <span class="message-time"><?php echo date('M d, g:i A', strtotime($msg['timestamp'])); ?></span>
                            </div>
                            <div class="message-subject"><?php echo htmlspecialchars($msg['subject']); ?></div>
                            <div class="message-preview"><?php echo htmlspecialchars($msg['preview']); ?></div>
                            <div class="message-meta">
                                <span class="category-badge badge-<?php echo $msg['category']; ?>">
                                    <?php echo ucfirst($msg['category']); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Right Panel - Chat View -->
            <div class="chat-panel" id="chatPanel">
                <div class="chat-empty">
                    <i class="fas fa-comments"></i>
                    <h3>No message selected</h3>
                    <p>Select a message from the list to view the conversation</p>
                </div>
                
                <div class="chat-content" id="chatContent" style="display: none;">
                    <!-- Chat Header -->
                    <div class="chat-header">
                        <div class="chat-info">
                            <div class="chat-avatar" id="chatAvatar"></div>
                            <div>
                                <h3 id="chatSender"></h3>
                                <p id="chatRole"></p>
                            </div>
                        </div>
                        <div class="chat-actions">
                            <button class="chat-action-btn" onclick="toggleMessageStatus()" title="Mark as Read/Unread">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="chat-action-btn" onclick="deleteCurrentMessage()" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                            <button class="chat-action-btn" onclick="closeChat()" title="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Chat Messages -->
                    <div class="chat-messages" id="chatMessages">
                        <!-- Messages will be populated by JavaScript -->
                    </div>

                    <!-- Chat Input -->
                    <div class="chat-input-area">
                        <div class="attach-options">
                            <button class="attach-btn" onclick="attachFile()" title="Attach File">
                                <i class="fas fa-paperclip"></i>
                            </button>
                            <button class="attach-btn" onclick="linkJobOrder()" title="Link Job Order">
                                <i class="fas fa-link"></i> Job Order
                            </button>
                        </div>
                        <div class="input-wrapper">
                            <textarea id="messageInput" placeholder="Type your message..." rows="3"></textarea>
                            <button class="send-btn" onclick="sendMessage()">
                                <i class="fas fa-paper-plane"></i> Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Compose Message Modal -->
<div class="modal" id="composeModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2><i class="fas fa-pen"></i> Compose New Message</h2>
            <button class="close-modal" onclick="closeComposeModal()">&times;</button>
        </div>
        <form id="composeForm" class="modal-body">
            <div class="form-group">
                <label for="recipientType">Recipient Type</label>
                <select id="recipientType" required>
                    <option value="">Select Type</option>
                    <option value="worker">Worker</option>
                    <option value="client">Client</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="recipient">Recipient</label>
                <input type="text" id="recipient" placeholder="Enter recipient name" required>
            </div>
            
            <div class="form-group">
                <label for="messageSubject">Subject</label>
                <input type="text" id="messageSubject" placeholder="Enter subject" required>
            </div>
            
            <div class="form-group">
                <label for="messageBody">Message</label>
                <textarea id="messageBody" rows="6" placeholder="Type your message..." required></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeComposeModal()">Cancel</button>
                <button type="submit" class="btn-primary">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </div>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once '../layouts/dashboard-layout.php';
?>

