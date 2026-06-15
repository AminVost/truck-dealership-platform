# Heavy-Duty Truck Dealership Platform

A high-performance, dynamic corporate website developed for a commercial vehicle and 18-wheeler dealership. This platform is designed to showcase heavy machinery inventory, build corporate trust, and generate secure business leads.

## 🎯 Project Overview
In the commercial vehicle industry, a corporate website needs to be fast, visually engaging, and highly secure to handle B2B inquiries. This project was built without relying on heavy frontend frameworks, utilizing a custom PHP architecture and optimized JavaScript libraries to deliver a blazing-fast user experience with smooth scrolling and animations.

## 🏛 Architecture & Tech Stack

### Frontend (UI/UX & Interactions)
The frontend is built for maximum browser compatibility, responsive design, and engaging animations.
* **Core:** HTML5, CSS3, JavaScript (ES6+)
* **Framework:** Bootstrap
* **DOM Manipulation & Logic:** jQuery
* **UI/UX Libraries:** * *Slick Slider / CSS Slider* (for vehicle showcases)
    * *Magnific Popup / Fancybox* (for high-res image galleries)
    * *WOW.js & Waypoints* (for scroll-triggered animations)
    * *Filterizr* (for dynamic inventory sorting)
    * *iziToast* (for elegant user notifications)

### Backend (Server-Side Logic)
A custom, lightweight PHP architecture designed for security and dynamic content management.
* **Language:** PHP
* **Database:** MySQL (Relational data management for inventory and posts)
* **Security:** Custom PHP-Firewall, Google reCAPTCHA v3 integration to prevent spam in business inquiries.
* **Communication:** PHPMailer for secure, reliable lead generation and email routing.
* **Optimization:** Custom Minify integration to compress assets on the fly and reduce load times.
* **Localization:** Built-in Jalali date parsing (`jdf.php`, `jdatetime`) for regional market support.

## 💼 Business Value
* **Lead Generation Engine:** Secure contact forms integrated with reCAPTCHA v3 ensure the sales team only receives high-quality, spam-free inquiries.
* **Optimized Performance:** The use of asset minification and lightweight jQuery plugins ensures the site loads quickly even on slower mobile networks, a critical factor for B2B clients on the go.
* **Dynamic Inventory Management:** The backend architecture allows administrators to easily update truck listings, specifications, and availability.

## 🚀 Getting Started

To run this project locally, you will need a local web server environment like XAMPP, WAMP, or MAMP.

### Prerequisites
* PHP (v7.4 or higher)
* MySQL / MariaDB
* Apache / Nginx

### Installation
1. Clone the repository to your local server's root directory (e.g., `htdocs` or `www`).
2. Import the provided `.sql` database file (if available in the repository) into your MySQL server via phpMyAdmin or CLI.
3. Rename the configuration file (e.g., `config.sample.php` to `config.php`) and update the database credentials:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'truck_dealership_db');
   ```
4. Access the project via your local browser at `http://localhost/truck-dealership-platform`.

## 📄 License
This project is for demonstration and portfolio purposes.
