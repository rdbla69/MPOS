<img width="1879" height="833" alt="image" src="https://github.com/user-attachments/assets/654971c4-e904-4b2b-b835-75001f636488" />

# 🔧 Machine System POS

A comprehensive Point of Sale (POS) system designed for machine repair shops and automotive service centers. Built with PHP, JavaScript, and modern web technologies.

![Version](https://img.shields.io/badge/version-1.0.0-blue)
![PHP](https://img.shields.io/badge/PHP-7.4+-purple)
![License](https://img.shields.io/badge/license-MIT-green)

---

## 📋 Table of Contents

- [Features](#features)
- [Screenshots](#screenshots)
- [Requirements](#requirements)
- [Installation](#installation)
- [Project Structure](#project-structure)
- [Usage](#usage)
- [Modules](#modules)
- [Configuration](#configuration)
- [Contributing](#contributing)
- [License](#license)
- [Support](#support)

---

## ✨ Features

### 🔐 Authentication
- Secure login system with session management
- No authentication required mode (for testing/development)
- Automatic logout with success notifications

### 📊 Dashboard
- Real-time statistics and analytics
- Interactive charts (daily sales, revenue trends)
- Recent activity feed
- Quick access to all modules
- Live date/time display

### 💰 Point of Sale (POS)
- Product/service search with real-time filtering
- Shopping cart management
- Customer information capture
- Multiple payment methods (Cash, Card, Digital)
- Discount application
- Receipt generation and printing
- Transaction history
- Philippine Peso (₱) currency support

### 📦 Inventory Management
- Complete product/parts catalog
- Stock level tracking with alerts
- Low-stock warnings
- Add, edit, and delete items
- Category-based filtering
- Stock adjustment history
- Barcode/SKU support
- Export reports (CSV, PDF, Print)

### 👥 Workers Management
- Employee database
- Role and department assignment
- Shift scheduling
- Contact information management
- Status tracking (Active, Busy, On Leave)
- Worker profiles with photos
- Search and filter capabilities

### 📋 Job Orders
- Create and manage service job orders
- Customer and vehicle information
- Service checklist
- Parts tracking linked to inventory
- Worker assignment
- Status tracking (Pending → Ongoing → Completed)
- Job order history
- Print job summaries
- Send summaries via email/SMS

### 📈 Reports & Analytics
- Sales reports with date range filtering
- Service performance metrics
- Payment method breakdown
- Interactive charts and graphs
- Export functionality (PDF, Excel, Print)
- Predictive insights (ML ready)

### 💬 Messaging Center
- Organized inbox (Workers, Clients, System Alerts)
- Real-time message notifications
- Unread message counter
- Conversation threads
- Quick actions (Mark as Read, Delete)
- Compose new messages
- File attachment support
- Job order linking
- Search and filter messages

### ⚙️ Settings
- Admin profile management
- Shop information configuration
- System preferences (theme, currency, date format)
- AI/ML settings (placeholder for future integration)
- Security settings (password, backup, verification)
- Database management
- Worker permissions

---

## 📸 Screenshots

### Login Page
Modern and secure login interface with logo support.

### Dashboard
Comprehensive overview with real-time statistics and charts.

### POS System
User-friendly point of sale interface for quick transactions.

### Inventory Management
Complete inventory tracking and management.

### Job Orders
Streamlined job order creation and tracking.

---

## 🔧 Requirements

- **PHP:** 7.4 or higher
- **Web Server:** Apache (XAMPP, WAMP, LAMP) or Nginx
- **Database:** MySQL 5.7+ or MariaDB 10.3+ (for production)
- **Browser:** Modern browser (Chrome, Firefox, Safari, Edge)
- **Optional:** Node.js for ML features (future implementation)

---

## 🚀 Installation

### 1. Clone or Download the Repository

```bash
git clone https://github.com/yourusername/machine-pos-system.git
cd machine-pos-system
```

Or download and extract the ZIP file to your web server directory.

### 2. XAMPP Installation

1. Install [XAMPP](https://www.apachefriends.org/)
2. Copy the project folder to `C:\xampp\htdocs\`
3. Start Apache from XAMPP Control Panel

### 3. Access the Application

Open your browser and navigate to:
```
http://localhost/pos-system/app/Views/pages/login.php
```

### 4. Default Login

- **Username:** Any username (authentication disabled for testing)
- **Password:** Any password

### 5. Configure Your Logo

Replace the logo file at:
```
assets/images/logo.png
```

**Recommended specifications:**
- Size: 128px × 128px or larger
- Format: PNG with transparent background
- Aspect ratio: Square (1:1)

---

## 📁 Project Structure

```
pos-system/
├── app/
│   └── Views/
│       ├── layouts/
│       │   ├── dashboard-layout.php    # Dashboard layout template
│       │   └── login-layout.php        # Login layout template
│       └── pages/
│           ├── dashboard.php           # Main dashboard
│           ├── login.php               # Login page
│           ├── pos.php                 # Point of Sale
│           ├── inventory.php           # Inventory management
│           ├── workers.php             # Workers management
│           ├── job-orders.php          # Job orders management
│           ├── reports.php             # Reports & Analytics
│           ├── messages.php            # Messaging center
│           ├── settings.php            # System settings
│           └── logout.php              # Logout handler
├── assets/
│   ├── css/
│   │   ├── dashboard.css              # Dashboard styles
│   │   ├── login.css                  # Login page styles
│   │   ├── pos.css                    # POS styles
│   │   ├── inventory.css              # Inventory styles
│   │   ├── workers.css                # Workers styles
│   │   ├── job-orders.css             # Job orders styles
│   │   ├── reports.css                # Reports styles
│   │   ├── messages.css               # Messages styles
│   │   └── settings.css               # Settings styles
│   ├── js/
│   │   ├── dashboard.js               # Dashboard functionality
│   │   ├── login.js                   # Login functionality
│   │   ├── pos.js                     # POS functionality
│   │   ├── inventory.js               # Inventory functionality
│   │   ├── workers.js                 # Workers functionality
│   │   ├── job-orders.js              # Job orders functionality
│   │   ├── reports.js                 # Reports functionality
│   │   ├── messages.js                # Messages functionality
│   │   └── settings.js                # Settings functionality
│   └── images/
│       └── logo.png                   # Your company logo
├── auth/
│   └── login.php                      # Authentication handler
├── index.php                          # Entry point
└── README.md                          # This file
```

---

## 📖 Usage

### Navigating the System

1. **Login:** Start at the login page
2. **Dashboard:** View overview and statistics
3. **Sidebar Navigation:** Access all modules via the left sidebar
4. **Search:** Use search bars to find items, workers, or messages
5. **Filters:** Apply filters to narrow down results
6. **Actions:** Use action buttons (View, Edit, Delete) on each item

### Creating a Transaction (POS)

1. Navigate to **POS** from sidebar
2. Search for products/services
3. Click to add items to cart
4. Adjust quantities as needed
5. Apply discounts if applicable
6. Enter customer information
7. Select payment method
8. Complete transaction
9. Print or send receipt

### Managing Job Orders

1. Navigate to **Job Orders** from sidebar
2. Click **Add New Job Order**
3. Fill in customer details
4. Enter vehicle information
5. Select services from checklist
6. Add parts used
7. Assign workers
8. Add notes if needed
9. Save job order
10. Update status as work progresses

### Checking Messages

1. Navigate to **Messages** from sidebar
2. View notification badge for unread count
3. Select category (Workers, Clients, System)
4. Click a message to view conversation
5. Reply to messages
6. Attach files or link job orders
7. Mark as read/unread as needed

---

## 🔌 Modules

### Dashboard Module
- **File:** `dashboard.php`
- **Features:** Statistics, charts, recent activity
- **Dependencies:** Chart.js

### POS Module
- **File:** `pos.php`
- **Features:** Product selection, cart, payment processing
- **Currency:** Philippine Peso (₱)

### Inventory Module
- **File:** `inventory.php`
- **Features:** CRUD operations, stock tracking, reports

### Workers Module
- **File:** `workers.php`
- **Features:** Employee management, profiles, scheduling

### Job Orders Module
- **File:** `job-orders.php`
- **Features:** Service tracking, customer management, status updates

### Reports Module
- **File:** `reports.php`
- **Features:** Analytics, charts, export functionality

### Messages Module
- **File:** `messages.php`
- **Features:** Inbox, compose, notifications, categories

### Settings Module
- **File:** `settings.php`
- **Features:** Configuration, preferences, security

---

## ⚙️ Configuration

### Currency Settings

The system is configured for Philippine Peso (₱). To change:

1. Open relevant JS files (pos.js, dashboard.js, etc.)
2. Update currency formatting:
```javascript
// Current
const formatted = new Intl.NumberFormat('en-PH', { 
    style: 'currency', 
    currency: 'PHP' 
}).format(amount);

// Change to USD example
const formatted = new Intl.NumberFormat('en-US', { 
    style: 'currency', 
    currency: 'USD' 
}).format(amount);
```

### Session Configuration

Edit `auth/login.php` to configure session behavior:
```php
$_SESSION['admin_name'] = $username;
$_SESSION['admin_role'] = 'admin';
$_SESSION['login_time'] = time();
```

### Database Integration (Future)

Currently uses client-side data storage. To integrate with MySQL:

1. Create database and tables
2. Update PHP files to use PDO or MySQLi
3. Replace static data arrays with database queries
4. Implement CRUD operations

---

## 🤖 Machine Learning Features (Coming Soon)

The system is designed to integrate ML features:

### POS & Sales
- Sales prediction and forecasting
- Customer behavior analysis
- Dynamic pricing suggestions

### Inventory
- Stock level prediction
- Reorder point optimization
- Demand forecasting

### Job Orders
- Service time estimation
- Parts requirement prediction
- Worker assignment optimization

### Messages
- Smart auto-reply suggestions
- Keyword detection (urgent, delayed, parts needed)
- Sentiment analysis
- Message classification

---

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

## 💼 Credits

**Developed by:** Innovative Machine POS System  
**Version:** 1.0.0  
**Year:** 2025  
**Framework:** Custom PHP/JavaScript  
**UI Libraries:** Bootstrap 5, Font Awesome, Chart.js

---

## 🆘 Support

For support, email support@machinepos.com or open an issue in the GitHub repository.

---

## 🗺️ Roadmap

### Version 1.1 (Planned)
- [ ] MySQL database integration
- [ ] User authentication with permissions
- [ ] Email/SMS notifications
- [ ] Backup and restore functionality
- [ ] Multi-language support

### Version 2.0 (Future)
- [ ] Mobile app (iOS/Android)
- [ ] Cloud synchronization
- [ ] Advanced ML features
- [ ] API for third-party integrations
- [ ] Multi-branch support

---

## 📊 System Status

- ✅ Login System
- ✅ Dashboard
- ✅ POS Module
- ✅ Inventory Management
- ✅ Workers Management
- ✅ Job Orders Management
- ✅ Reports & Analytics
- ✅ Messaging Center
- ✅ Settings
- ✅ Logout Functionality
- ⏳ Database Integration (In Progress)
- ⏳ Email Notifications (Planned)
- ⏳ ML Features (Planned)

---

## 🙏 Acknowledgments

- Bootstrap team for the UI framework
- Font Awesome for icons
- Chart.js for data visualization
- XAMPP team for the development environment
- All contributors and testers

---

**© 2025 INNOVATIVE MACHINE POS SYSTEM v1.0.0 - All Rights Reserved**

---

*Built with ❤️ for machine repair shops and automotive service centers*

