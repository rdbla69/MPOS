<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_name'])) {
    header('Location: login.php');
    exit();
}

$adminName = $_SESSION['admin_name'] ?? 'Admin';

// Sample report data
$salesData = [
    ['date' => '2024-01-23', 'transaction_id' => 'TXN-001', 'customer' => 'John Doe', 'items' => 3, 'subtotal' => 850.00, 'tax' => 85.00, 'total' => 935.00, 'payment_method' => 'Cash'],
    ['date' => '2024-01-23', 'transaction_id' => 'TXN-002', 'customer' => 'Jane Smith', 'items' => 2, 'subtotal' => 450.00, 'tax' => 45.00, 'total' => 495.00, 'payment_method' => 'Card'],
    ['date' => '2024-01-22', 'transaction_id' => 'TXN-003', 'customer' => 'Mike Johnson', 'items' => 5, 'subtotal' => 1250.00, 'tax' => 125.00, 'total' => 1375.00, 'payment_method' => 'Digital'],
    ['date' => '2024-01-22', 'transaction_id' => 'TXN-004', 'customer' => 'Sarah Williams', 'items' => 1, 'subtotal' => 125.00, 'tax' => 12.50, 'total' => 137.50, 'payment_method' => 'Cash'],
    ['date' => '2024-01-21', 'transaction_id' => 'TXN-005', 'customer' => 'David Brown', 'items' => 4, 'subtotal' => 980.00, 'tax' => 98.00, 'total' => 1078.00, 'payment_method' => 'Card'],
];

$servicesData = [
    ['date' => '2024-01-23', 'service_id' => 'SRV-001', 'service_name' => 'Engine Oil Change', 'technician' => 'Michael Chen', 'customer' => 'Robert Lee', 'duration' => '45 min', 'amount' => 450.00, 'status' => 'Completed'],
    ['date' => '2024-01-23', 'service_id' => 'SRV-002', 'service_name' => 'Wheel Alignment', 'technician' => 'Lisa Wong', 'customer' => 'Emily Davis', 'duration' => '60 min', 'amount' => 750.00, 'status' => 'Completed'],
    ['date' => '2024-01-22', 'service_id' => 'SRV-003', 'service_name' => 'Tire Rotation', 'technician' => 'Michael Chen', 'customer' => 'Chris Wilson', 'duration' => '30 min', 'amount' => 350.00, 'status' => 'Completed'],
    ['date' => '2024-01-22', 'service_id' => 'SRV-004', 'service_name' => 'Engine Oil Change', 'technician' => 'Lisa Wong', 'customer' => 'Anna Taylor', 'duration' => '45 min', 'amount' => 450.00, 'status' => 'Completed'],
];

$pageTitle = "Reports & Analytics - Machine System POS";
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
            <li class="menu-item active">
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
        <header class="reports-header">
            <div class="header-left">
                <div class="header-title">
                    <i class="fas fa-chart-line"></i>
                    <div>
                        <h1>Reports & Analytics</h1>
                        <p class="date-time" id="dateTime"></p>
                    </div>
                </div>
            </div>
            <div class="header-right">
                <div class="profile-info">
                    <i class="fas fa-user-circle"></i>
                    <span><?php echo htmlspecialchars($adminName); ?></span>
                </div>
            </div>
        </header>

        <!-- Reports Content -->
        <div class="reports-content">
            <!-- Date Range & Filters -->
            <div class="filters-section">
                <div class="date-range">
                    <label><i class="fas fa-calendar"></i> Date Range:</label>
                    <input type="date" id="startDate" class="date-input" value="2024-01-21">
                    <span>to</span>
                    <input type="date" id="endDate" class="date-input" value="2024-01-23">
                    <button class="apply-btn" id="applyFilter">
                        <i class="fas fa-check"></i> Apply
                    </button>
                </div>
                <div class="report-filters">
                    <select id="reportType" class="filter-select">
                        <option value="all">All Reports</option>
                        <option value="sales">Sales Only</option>
                        <option value="services">Services Only</option>
                    </select>
                    <select id="paymentMethod" class="filter-select">
                        <option value="all">All Payments</option>
                        <option value="Cash">Cash</option>
                        <option value="Card">Card</option>
                        <option value="Digital">Digital</option>
                    </select>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="summary-section">
                <div class="summary-card sales">
                    <div class="card-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="totalSales">₱4,020.50</h3>
                        <p>Total Sales</p>
                        <span class="trend positive">
                            <i class="fas fa-arrow-up"></i> +12.5%
                        </span>
                    </div>
                </div>
                <div class="summary-card customers">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="totalCustomers">9</h3>
                        <p>Total Customers</p>
                        <span class="trend positive">
                            <i class="fas fa-arrow-up"></i> +8.2%
                        </span>
                    </div>
                </div>
                <div class="summary-card services">
                    <div class="card-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="totalServices">4</h3>
                        <p>Services Rendered</p>
                        <span class="trend positive">
                            <i class="fas fa-arrow-up"></i> +15.0%
                        </span>
                    </div>
                </div>
                <div class="summary-card avg">
                    <div class="card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="card-content">
                        <h3 id="avgTransaction">₱446.72</h3>
                        <p>Avg Transaction</p>
                        <span class="trend neutral">
                            <i class="fas fa-minus"></i> 0%
                        </span>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <div class="chart-card">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-line"></i> Sales Trend</h3>
                        <select class="chart-filter">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                            <option>Last 3 Months</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="salesTrendChart"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-pie"></i> Payment Methods</h3>
                    </div>
                    <div class="chart-container">
                        <canvas id="paymentMethodChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Report Tables -->
            <div class="tables-section">
                <!-- Sales Report Table -->
                <div class="report-table-card">
                    <div class="table-header">
                        <h3><i class="fas fa-receipt"></i> Sales Report</h3>
                        <div class="export-buttons">
                            <button class="export-btn pdf" id="exportSalesPDF">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                            <button class="export-btn excel" id="exportSalesExcel">
                                <i class="fas fa-file-excel"></i> Excel
                            </button>
                            <button class="export-btn print" id="printSales">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="report-table" id="salesTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction ID</th>
                                    <th>Customer</th>
                                    <th>Items</th>
                                    <th>Subtotal</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($salesData as $sale): ?>
                                <tr>
                                    <td><?php echo date('M d, Y', strtotime($sale['date'])); ?></td>
                                    <td><span class="txn-badge"><?php echo $sale['transaction_id']; ?></span></td>
                                    <td><?php echo $sale['customer']; ?></td>
                                    <td><?php echo $sale['items']; ?></td>
                                    <td>₱<?php echo number_format($sale['subtotal'], 2); ?></td>
                                    <td>₱<?php echo number_format($sale['tax'], 2); ?></td>
                                    <td class="total">₱<?php echo number_format($sale['total'], 2); ?></td>
                                    <td><span class="payment-badge"><?php echo $sale['payment_method']; ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="total-row">
                                    <td colspan="6"><strong>TOTAL</strong></td>
                                    <td class="total"><strong>₱4,020.50</strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Services Report Table -->
                <div class="report-table-card">
                    <div class="table-header">
                        <h3><i class="fas fa-tools"></i> Services Report</h3>
                        <div class="export-buttons">
                            <button class="export-btn pdf" id="exportServicesPDF">
                                <i class="fas fa-file-pdf"></i> PDF
                            </button>
                            <button class="export-btn excel" id="exportServicesExcel">
                                <i class="fas fa-file-excel"></i> Excel
                            </button>
                            <button class="export-btn print" id="printServices">
                                <i class="fas fa-print"></i> Print
                            </button>
                        </div>
                    </div>
                    <div class="table-container">
                        <table class="report-table" id="servicesTable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Service ID</th>
                                    <th>Service Name</th>
                                    <th>Technician</th>
                                    <th>Customer</th>
                                    <th>Duration</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($servicesData as $service): ?>
                                <tr>
                                    <td><?php echo date('M d, Y', strtotime($service['date'])); ?></td>
                                    <td><span class="srv-badge"><?php echo $service['service_id']; ?></span></td>
                                    <td><?php echo $service['service_name']; ?></td>
                                    <td><?php echo $service['technician']; ?></td>
                                    <td><?php echo $service['customer']; ?></td>
                                    <td><?php echo $service['duration']; ?></td>
                                    <td class="amount">₱<?php echo number_format($service['amount'], 2); ?></td>
                                    <td><span class="status-badge completed"><?php echo $service['status']; ?></span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="total-row">
                                    <td colspan="6"><strong>TOTAL</strong></td>
                                    <td class="amount"><strong>₱2,000.00</strong></td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Predictive Insights -->
            <div class="insights-section">
                <div class="insights-card">
                    <div class="insights-header">
                        <h3><i class="fas fa-brain"></i> Predictive Insights & Recommendations</h3>
                        <span class="ai-badge">AI-Powered</span>
                    </div>
                    <div class="insights-content">
                        <div class="insight-item high">
                            <div class="insight-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="insight-info">
                                <h4>Peak Sales Period Detected</h4>
                                <p>Sales are 35% higher on weekends. Consider increasing staff during Fridays-Sundays.</p>
                                <span class="insight-confidence">Confidence: 92%</span>
                            </div>
                        </div>
                        <div class="insight-item medium">
                            <div class="insight-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="insight-info">
                                <h4>Customer Retention Opportunity</h4>
                                <p>25% of customers haven't returned in 30 days. Launch a loyalty program to boost retention.</p>
                                <span class="insight-confidence">Confidence: 85%</span>
                            </div>
                        </div>
                        <div class="insight-item low">
                            <div class="insight-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div class="insight-info">
                                <h4>Cross-Selling Potential</h4>
                                <p>Customers buying oil changes often add air filters. Recommend bundling these services.</p>
                                <span class="insight-confidence">Confidence: 78%</span>
                            </div>
                        </div>
                        <div class="insight-item forecast">
                            <div class="insight-icon">
                                <i class="fas fa-crystal-ball"></i>
                            </div>
                            <div class="insight-info">
                                <h4>Revenue Forecast</h4>
                                <p>Based on current trends, predicted revenue for next month: <strong>₱125,450</strong></p>
                                <span class="insight-confidence">Accuracy: 88%</span>
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

