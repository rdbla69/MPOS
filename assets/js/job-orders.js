// Job Orders Management JavaScript

// Sample data (will be loaded from PHP/database in production)
let jobOrders = [
    {id: 1, job_id: 'JO-2024-001', customer_name: 'Juan Dela Cruz', contact: '+63 912 345 6789', vehicle_plate: 'ABC 1234', vehicle_model: 'Toyota Vios 2020', vehicle_type: 'Sedan', services: 'Oil Change, Brake Inspection', parts: 'Engine Oil (3L), Brake Pads', workers: 'Michael Chen, Lisa Wong', status: 'ongoing', date_created: '2024-10-20', notes: 'Customer requested full inspection'},
    {id: 2, job_id: 'JO-2024-002', customer_name: 'Maria Santos', contact: '+63 923 456 7890', vehicle_plate: 'XYZ 5678', vehicle_model: 'Honda City 2021', vehicle_type: 'Sedan', services: 'Tire Replacement, Wheel Alignment', parts: 'Tires (4pcs), Wheel Weights', workers: 'Michael Chen', status: 'completed', date_created: '2024-10-19', notes: 'All tires replaced successfully'},
    {id: 3, job_id: 'JO-2024-003', customer_name: 'Roberto Lim', contact: '+63 934 567 8901', vehicle_plate: 'DEF 9012', vehicle_model: 'Mitsubishi Montero 2019', vehicle_type: 'SUV', services: 'Engine Tune-up, AC Repair', parts: 'Spark Plugs, AC Compressor', workers: 'Lisa Wong', status: 'pending', date_created: '2024-10-23', notes: 'Waiting for parts delivery'},
    {id: 4, job_id: 'JO-2024-004', customer_name: 'Sofia Reyes', contact: '+63 945 678 9012', vehicle_plate: 'GHI 3456', vehicle_model: 'Suzuki Ertiga 2022', vehicle_type: 'MPV', services: 'Battery Replacement, Electrical Check', parts: 'Battery 12V', workers: 'Michael Chen', status: 'ongoing', date_created: '2024-10-22', notes: 'Customer will pick up tomorrow'},
    {id: 5, job_id: 'JO-2024-005', customer_name: 'Carlos Mendoza', contact: '+63 956 789 0123', vehicle_plate: 'JKL 7890', vehicle_model: 'Ford Ranger 2020', vehicle_type: 'Pickup', services: 'Transmission Repair', parts: 'Transmission Fluid, Gasket', workers: 'Michael Chen, Lisa Wong', status: 'ongoing', date_created: '2024-10-21', notes: 'Major repair in progress'},
    {id: 6, job_id: 'JO-2024-006', customer_name: 'Anna Garcia', contact: '+63 967 890 1234', vehicle_plate: 'MNO 2345', vehicle_model: 'Hyundai Tucson 2021', vehicle_type: 'SUV', services: 'General Checkup', parts: 'None', workers: 'Lisa Wong', status: 'completed', date_created: '2024-10-18', notes: 'No issues found'},
];

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateDateTime();
    setInterval(updateDateTime, 1000);
    updateSummaryCards();
    setupEventListeners();
});

// Update date and time
function updateDateTime() {
    const now = new Date();
    const options = { 
        weekday: 'long', 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit'
    };
    document.getElementById('dateTime').textContent = now.toLocaleDateString('en-US', options);
}

// Setup event listeners
function setupEventListeners() {
    // Add job button
    document.getElementById('addJobBtn').addEventListener('click', openAddJobModal);
    
    // Search functionality
    document.getElementById('searchInput').addEventListener('input', filterJobs);
    
    // Status filter
    document.getElementById('statusFilter').addEventListener('change', filterJobs);
    
    // Form submission
    document.getElementById('jobForm').addEventListener('submit', handleFormSubmit);
}

// Open Add Job Modal
function openAddJobModal() {
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-plus-circle"></i> Add New Job Order';
    document.getElementById('jobForm').reset();
    document.getElementById('jobId').value = '';
    document.getElementById('statusSection').style.display = 'none';
    document.getElementById('jobModal').classList.add('active');
}

// Close Job Modal
function closeJobModal() {
    document.getElementById('jobModal').classList.remove('active');
    document.getElementById('jobForm').reset();
}

// View Job Details
function viewJob(id) {
    const job = jobOrders.find(j => j.id === id);
    if (!job) return;
    
    const content = `
        <div class="detail-section">
            <h3><i class="fas fa-clipboard-list"></i> Job Information</h3>
            <div class="detail-row">
                <div class="detail-label">Job Order ID:</div>
                <div class="detail-value"><strong>${job.job_id}</strong></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Status:</div>
                <div class="detail-value">
                    <span class="status-badge status-${job.status}">${job.status.charAt(0).toUpperCase() + job.status.slice(1)}</span>
                </div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Date Created:</div>
                <div class="detail-value">${formatDate(job.date_created)}</div>
            </div>
        </div>
        
        <div class="detail-section">
            <h3><i class="fas fa-user"></i> Customer Information</h3>
            <div class="detail-row">
                <div class="detail-label">Name:</div>
                <div class="detail-value">${job.customer_name}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Contact:</div>
                <div class="detail-value">${job.contact}</div>
            </div>
        </div>
        
        <div class="detail-section">
            <h3><i class="fas fa-car"></i> Vehicle Information</h3>
            <div class="detail-row">
                <div class="detail-label">Plate Number:</div>
                <div class="detail-value"><strong>${job.vehicle_plate}</strong></div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Model:</div>
                <div class="detail-value">${job.vehicle_model}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Type:</div>
                <div class="detail-value">${job.vehicle_type}</div>
            </div>
        </div>
        
        <div class="detail-section">
            <h3><i class="fas fa-wrench"></i> Services & Parts</h3>
            <div class="detail-row">
                <div class="detail-label">Services:</div>
                <div class="detail-value">${job.services}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Parts Used:</div>
                <div class="detail-value">${job.parts}</div>
            </div>
        </div>
        
        <div class="detail-section">
            <h3><i class="fas fa-user-tie"></i> Assigned Workers</h3>
            <div class="detail-row">
                <div class="detail-label">Workers:</div>
                <div class="detail-value">${job.workers}</div>
            </div>
        </div>
        
        <div class="detail-section">
            <h3><i class="fas fa-sticky-note"></i> Notes & Remarks</h3>
            <div class="detail-row">
                <div class="detail-value">${job.notes || 'No notes available'}</div>
            </div>
        </div>
    `;
    
    document.getElementById('jobDetailsContent').innerHTML = content;
    document.getElementById('viewJobModal').classList.add('active');
}

// Close View Modal
function closeViewModal() {
    document.getElementById('viewJobModal').classList.remove('active');
}

// Edit Job
function editJob(id) {
    const job = jobOrders.find(j => j.id === id);
    if (!job) return;
    
    document.getElementById('modalTitle').innerHTML = '<i class="fas fa-edit"></i> Edit Job Order';
    document.getElementById('jobId').value = job.id;
    document.getElementById('customerName').value = job.customer_name;
    document.getElementById('customerContact').value = job.contact;
    document.getElementById('vehiclePlate').value = job.vehicle_plate;
    document.getElementById('vehicleModel').value = job.vehicle_model;
    document.getElementById('vehicleType').value = job.vehicle_type;
    document.getElementById('partsUsed').value = job.parts;
    document.getElementById('jobNotes').value = job.notes;
    document.getElementById('jobStatus').value = job.status;
    
    // Check services
    const services = job.services.split(', ');
    document.querySelectorAll('input[name="service"]').forEach(checkbox => {
        checkbox.checked = services.includes(checkbox.value);
    });
    
    // Check workers
    const workers = job.workers.split(', ');
    document.querySelectorAll('input[name="worker"]').forEach(checkbox => {
        checkbox.checked = workers.includes(checkbox.value);
    });
    
    document.getElementById('statusSection').style.display = 'block';
    document.getElementById('jobModal').classList.add('active');
}

// Delete Job
function deleteJob(id) {
    if (confirm('Are you sure you want to delete this job order?')) {
        const index = jobOrders.findIndex(j => j.id === id);
        if (index > -1) {
            jobOrders.splice(index, 1);
            renderJobsTable();
            updateSummaryCards();
            showNotification('Job order deleted successfully!', 'success');
        }
    }
}

// Handle Form Submit
function handleFormSubmit(e) {
    e.preventDefault();
    
    const jobId = document.getElementById('jobId').value;
    const selectedServices = Array.from(document.querySelectorAll('input[name="service"]:checked'))
        .map(cb => cb.value).join(', ');
    const selectedWorkers = Array.from(document.querySelectorAll('input[name="worker"]:checked'))
        .map(cb => cb.value).join(', ');
    
    const jobData = {
        customer_name: document.getElementById('customerName').value,
        contact: document.getElementById('customerContact').value,
        vehicle_plate: document.getElementById('vehiclePlate').value,
        vehicle_model: document.getElementById('vehicleModel').value,
        vehicle_type: document.getElementById('vehicleType').value,
        services: selectedServices,
        parts: document.getElementById('partsUsed').value || 'None',
        workers: selectedWorkers || 'Unassigned',
        notes: document.getElementById('jobNotes').value,
        status: document.getElementById('jobStatus').value || 'pending',
        date_created: new Date().toISOString().split('T')[0]
    };
    
    if (jobId) {
        // Update existing job
        const index = jobOrders.findIndex(j => j.id == jobId);
        if (index > -1) {
            jobOrders[index] = { ...jobOrders[index], ...jobData };
            showNotification('Job order updated successfully!', 'success');
        }
    } else {
        // Add new job
        const newId = Math.max(...jobOrders.map(j => j.id)) + 1;
        const newJobId = `JO-2024-${String(newId).padStart(3, '0')}`;
        jobOrders.push({
            id: newId,
            job_id: newJobId,
            ...jobData
        });
        showNotification('Job order created successfully!', 'success');
    }
    
    renderJobsTable();
    updateSummaryCards();
    closeJobModal();
}

// Filter Jobs
function filterJobs() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;
    
    const rows = document.querySelectorAll('#jobOrdersTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        const status = row.dataset.status;
        
        const matchesSearch = text.includes(searchTerm);
        const matchesStatus = statusFilter === 'all' || status === statusFilter;
        
        if (matchesSearch && matchesStatus) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

// Render Jobs Table
function renderJobsTable() {
    const tbody = document.getElementById('jobOrdersTableBody');
    tbody.innerHTML = '';
    
    jobOrders.forEach(job => {
        const tr = document.createElement('tr');
        tr.dataset.jobId = job.id;
        tr.dataset.status = job.status;
        
        tr.innerHTML = `
            <td><strong>${job.job_id}</strong></td>
            <td>
                <div class="customer-info">
                    <div class="customer-name">${job.customer_name}</div>
                    <div class="customer-contact">${job.contact}</div>
                </div>
            </td>
            <td>
                <div class="vehicle-info">
                    <div class="vehicle-plate">${job.vehicle_plate}</div>
                    <div class="vehicle-model">${job.vehicle_model}</div>
                </div>
            </td>
            <td>${job.workers}</td>
            <td>
                <span class="status-badge status-${job.status}">
                    ${job.status.charAt(0).toUpperCase() + job.status.slice(1)}
                </span>
            </td>
            <td>${formatDate(job.date_created)}</td>
            <td>
                <div class="action-buttons">
                    <button class="btn-action btn-view" onclick="viewJob(${job.id})" title="View">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn-action btn-edit" onclick="editJob(${job.id})" title="Edit">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn-action btn-delete" onclick="deleteJob(${job.id})" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        
        tbody.appendChild(tr);
    });
}

// Update Summary Cards
function updateSummaryCards() {
    const total = jobOrders.length;
    const pending = jobOrders.filter(j => j.status === 'pending').length;
    const ongoing = jobOrders.filter(j => j.status === 'ongoing').length;
    const completed = jobOrders.filter(j => j.status === 'completed').length;
    
    document.getElementById('totalJobs').textContent = total;
    document.getElementById('pendingJobs').textContent = pending;
    document.getElementById('ongoingJobs').textContent = ongoing;
    document.getElementById('completedJobs').textContent = completed;
}

// Print Job Order
function printJobOrder() {
    window.print();
}

// Send Job Summary
function sendJobSummary() {
    showNotification('Job summary will be sent via email/SMS', 'info');
    // In production, this would integrate with email/SMS API
}

// Format Date
function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'short', day: 'numeric' };
    return date.toLocaleDateString('en-US', options);
}

// Show Notification
function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
        <span>${message}</span>
    `;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Trigger animation
    setTimeout(() => notification.classList.add('show'), 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add notification styles dynamically
const style = document.createElement('style');
style.textContent = `
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #1e293b;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        transform: translateX(400px);
        transition: transform 0.3s ease;
        z-index: 10000;
    }
    
    .notification.show {
        transform: translateX(0);
    }
    
    .notification-success {
        border-left: 4px solid #22c55e;
    }
    
    .notification-info {
        border-left: 4px solid #3b82f6;
    }
    
    .notification i {
        font-size: 1.5rem;
    }
    
    .notification-success i {
        color: #22c55e;
    }
    
    .notification-info i {
        color: #3b82f6;
    }
`;
document.head.appendChild(style);

