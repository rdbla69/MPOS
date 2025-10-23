<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_name'])) {
    header('Location: login.php');
    exit();
}

$adminName = $_SESSION['admin_name'] ?? 'Admin';

// Sample workers data
$workers = [
    ['id' => 1, 'emp_id' => 'EMP-001', 'name' => 'John Smith', 'position' => 'Cashier', 'department' => 'Sales', 'email' => 'john.smith@machine.com', 'phone' => '+63 912 345 6789', 'hire_date' => '2023-01-15', 'salary' => 18000.00, 'status' => 'active', 'shift' => 'Morning', 'photo' => 'https://ui-avatars.com/api/?name=John+Smith&background=3b82f6&color=fff'],
    ['id' => 2, 'emp_id' => 'EMP-002', 'name' => 'Sarah Johnson', 'position' => 'Manager', 'department' => 'Management', 'email' => 'sarah.johnson@machine.com', 'phone' => '+63 923 456 7890', 'hire_date' => '2022-06-20', 'salary' => 35000.00, 'status' => 'active', 'shift' => 'Full Day', 'photo' => 'https://ui-avatars.com/api/?name=Sarah+Johnson&background=8b5cf6&color=fff'],
    ['id' => 3, 'emp_id' => 'EMP-003', 'name' => 'Michael Chen', 'position' => 'Technician', 'department' => 'Service', 'email' => 'michael.chen@machine.com', 'phone' => '+63 934 567 8901', 'hire_date' => '2023-03-10', 'salary' => 22000.00, 'status' => 'busy', 'shift' => 'Afternoon', 'photo' => 'https://ui-avatars.com/api/?name=Michael+Chen&background=22c55e&color=fff'],
    ['id' => 4, 'emp_id' => 'EMP-004', 'name' => 'Emily Rodriguez', 'position' => 'Cashier', 'department' => 'Sales', 'email' => 'emily.rodriguez@machine.com', 'phone' => '+63 945 678 9012', 'hire_date' => '2023-05-01', 'salary' => 18000.00, 'status' => 'active', 'shift' => 'Evening', 'photo' => 'https://ui-avatars.com/api/?name=Emily+Rodriguez&background=fb923c&color=fff'],
    ['id' => 5, 'emp_id' => 'EMP-005', 'name' => 'David Martinez', 'position' => 'Supervisor', 'department' => 'Management', 'email' => 'david.martinez@machine.com', 'phone' => '+63 956 789 0123', 'hire_date' => '2022-11-15', 'salary' => 28000.00, 'status' => 'on_leave', 'shift' => 'Morning', 'photo' => 'https://ui-avatars.com/api/?name=David+Martinez&background=ef4444&color=fff'],
    ['id' => 6, 'emp_id' => 'EMP-006', 'name' => 'Lisa Wong', 'position' => 'Technician', 'department' => 'Service', 'email' => 'lisa.wong@machine.com', 'phone' => '+63 967 890 1234', 'hire_date' => '2023-02-20', 'salary' => 22000.00, 'status' => 'busy', 'shift' => 'Afternoon', 'photo' => 'https://ui-avatars.com/api/?name=Lisa+Wong&background=a855f7&color=fff'],
    ['id' => 7, 'emp_id' => 'EMP-007', 'name' => 'James Taylor', 'position' => 'Sales Associate', 'department' => 'Sales', 'email' => 'james.taylor@machine.com', 'phone' => '+63 978 901 2345', 'hire_date' => '2023-07-01', 'salary' => 20000.00, 'status' => 'active', 'shift' => 'Morning', 'photo' => 'https://ui-avatars.com/api/?name=James+Taylor&background=06b6d4&color=fff'],
    ['id' => 8, 'emp_id' => 'EMP-008', 'name' => 'Maria Santos', 'position' => 'Inventory Clerk', 'department' => 'Operations', 'email' => 'maria.santos@machine.com', 'phone' => '+63 989 012 3456', 'hire_date' => '2022-09-10', 'salary' => 19000.00, 'status' => 'active', 'shift' => 'Full Day', 'photo' => 'https://ui-avatars.com/api/?name=Maria+Santos&background=ec4899&color=fff'],
];

$pageTitle = "Workers Management - Machine System POS";
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
            <li class="menu-item active">
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
        <header class="workers-header">
            <div class="header-left">
                <div class="header-title">
                    <i class="fas fa-users"></i>
                    <div>
                        <h1>Workers Management</h1>
                        <p class="date-time" id="dateTime"></p>
                    </div>
                </div>
            </div>
            <div class="header-right">
                <button class="add-worker-btn" id="addWorkerBtn">
                    <i class="fas fa-user-plus"></i> Add Worker
                </button>
                <div class="profile-info">
                    <i class="fas fa-user-circle"></i>
                    <span><?php echo htmlspecialchars($adminName); ?></span>
                </div>
            </div>
        </header>

        <!-- Workers Content -->
        <div class="workers-content">
            <!-- Summary Cards -->
            <div class="summary-cards">
                <div class="summary-card total">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-info">
                        <span class="card-value"><?php echo count($workers); ?></span>
                        <span class="card-label">Total Workers</span>
                    </div>
                </div>
                <div class="summary-card active">
                    <div class="card-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="card-info">
                        <span class="card-value"><?php echo count(array_filter($workers, fn($w) => $w['status'] === 'active')); ?></span>
                        <span class="card-label">Active</span>
                    </div>
                </div>
                <div class="summary-card busy">
                    <div class="card-icon">
                        <i class="fas fa-user-clock"></i>
                    </div>
                    <div class="card-info">
                        <span class="card-value"><?php echo count(array_filter($workers, fn($w) => $w['status'] === 'busy')); ?></span>
                        <span class="card-label">Busy</span>
                    </div>
                </div>
                <div class="summary-card leave">
                    <div class="card-icon">
                        <i class="fas fa-user-times"></i>
                    </div>
                    <div class="card-info">
                        <span class="card-value"><?php echo count(array_filter($workers, fn($w) => $w['status'] === 'on_leave')); ?></span>
                        <span class="card-label">On Leave</span>
                    </div>
                </div>
            </div>

            <!-- Search and Filters -->
            <div class="workers-controls">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="workerSearch" placeholder="Search by name, position, or department..." autocomplete="off">
                </div>
                <div class="filter-group">
                    <select id="departmentFilter" class="filter-select">
                        <option value="all">All Departments</option>
                        <option value="Sales">Sales</option>
                        <option value="Service">Service</option>
                        <option value="Management">Management</option>
                        <option value="Operations">Operations</option>
                    </select>
                    <select id="statusFilter" class="filter-select">
                        <option value="all">All Status</option>
                        <option value="active">Active</option>
                        <option value="busy">Busy</option>
                        <option value="on_leave">On Leave</option>
                    </select>
                    <button class="filter-btn" id="exportBtn">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>
            </div>

            <!-- Workers Table -->
            <div class="workers-table-section">
                <div class="table-container">
                    <table class="workers-table" id="workersTable">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Department</th>
                                <th>Contact</th>
                                <th>Hire Date</th>
                                <th>Salary</th>
                                <th>Shift</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($workers as $worker): ?>
                            <tr data-id="<?php echo $worker['id']; ?>" data-department="<?php echo $worker['department']; ?>" data-status="<?php echo $worker['status']; ?>">
                                <td>
                                    <div class="worker-photo">
                                        <img src="<?php echo $worker['photo']; ?>" alt="<?php echo $worker['name']; ?>">
                                    </div>
                                </td>
                                <td><span class="emp-id-badge"><?php echo $worker['emp_id']; ?></span></td>
                                <td class="worker-name"><?php echo htmlspecialchars($worker['name']); ?></td>
                                <td><?php echo $worker['position']; ?></td>
                                <td><span class="dept-badge"><?php echo $worker['department']; ?></span></td>
                                <td>
                                    <div class="contact-info">
                                        <span><i class="fas fa-envelope"></i> <?php echo $worker['email']; ?></span>
                                        <span><i class="fas fa-phone"></i> <?php echo $worker['phone']; ?></span>
                                    </div>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($worker['hire_date'])); ?></td>
                                <td class="salary">₱<?php echo number_format($worker['salary'], 2); ?></td>
                                <td><span class="shift-badge"><?php echo $worker['shift']; ?></span></td>
                                <td>
                                    <span class="status-badge <?php echo $worker['status']; ?>">
                                        <?php echo ucfirst(str_replace('_', ' ', $worker['status'])); ?>
                                    </span>
                                </td>
                                <td class="actions">
                                    <button class="action-icon view-btn" data-id="<?php echo $worker['id']; ?>" title="View Profile">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="action-icon edit-btn" data-id="<?php echo $worker['id']; ?>" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="action-icon delete-btn" data-id="<?php echo $worker['id']; ?>" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- Add/Edit Worker Modal -->
<div class="modal" id="workerModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle"><i class="fas fa-user-plus"></i> Add New Worker</h3>
            <button class="close-modal" id="closeModal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="workerForm">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Employee ID</label>
                        <input type="text" id="empId" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" id="workerName" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <input type="text" id="workerPosition" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Department</label>
                        <select id="workerDepartment" class="form-input" required>
                            <option value="Sales">Sales</option>
                            <option value="Service">Service</option>
                            <option value="Management">Management</option>
                            <option value="Operations">Operations</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="workerEmail" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" id="workerPhone" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Hire Date</label>
                        <input type="date" id="workerHireDate" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label>Salary (₱)</label>
                        <input type="number" id="workerSalary" class="form-input" required min="0" step="100">
                    </div>
                    <div class="form-group">
                        <label>Shift</label>
                        <select id="workerShift" class="form-input" required>
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                            <option value="Evening">Evening</option>
                            <option value="Full Day">Full Day</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select id="workerStatus" class="form-input" required>
                            <option value="active">Active</option>
                            <option value="busy">Busy</option>
                            <option value="on_leave">On Leave</option>
                        </select>
                    </div>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn-secondary" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn-primary">Save Worker</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Worker Profile Modal -->
<div class="modal" id="profileModal">
    <div class="modal-content profile-modal">
        <div class="modal-header">
            <h3><i class="fas fa-user"></i> Worker Profile</h3>
            <button class="close-modal" id="closeProfileModal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="profile-content" id="profileContent">
                <!-- Profile content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../layouts/dashboard-layout.php';
?>

