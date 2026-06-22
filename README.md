# 🚀 SwiftFileLink (PHP)

<p align="center">
  <img src="logo2.png" alt="SwiftFileLink Logo" width="200"/>
</p>

<p align="center">
  <strong>A secure, high-speed file sharing and management platform.</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-7.4%2B-blue.svg" alt="PHP Version"/>
  <img src="https://img.shields.io/badge/MySQL-Database-orange.svg" alt="MySQL"/>
  <img src="https://img.shields.io/badge/License-MIT-green.svg" alt="License"/>
  <img src="https://img.shields.io/badge/Frontend-HTML5%20%2F%20CSS3%20%2F%20JS-blueviolet.svg" alt="Frontend Tech"/>
</p>

---

## 📖 Overview

**SwiftFileLink** is a sleek, web-based file sharing utility built with PHP, MySQL, and modern Vanilla CSS/JS. It allows users and guests to upload files and generate a temporary **4-digit PIN**. Anyone with the PIN can securely download the files before their designated expiration date or download limit is reached.

---

## ✨ Key Features

### 👤 User Features
* 📤 **Multi-File Upload**: Upload multiple files simultaneously with ease.
* 🔑 **PIN-Protected Access**: Secure your files with unique, custom-generated 4-digit PINs.
* ⏳ **Custom Expiry**: Define exactly when files should expire and be automatically deleted from the server.
* 📉 **Download Limits**: Set a maximum download count to automatically restrict access after a specific number of downloads.
* 🔐 **Secure Accounts**: Complete registration and login system with active session tracking.
* 📨 **OTP Verification**: Email-based OTP system for account verification and password resets using PHPMailer.

### 🛡️ Admin Features
* 📊 **Admin Dashboard**: Real-time stats and control over the platform.
* 📂 **File Management**: View, track, and force delete files stored on the server.
* 👥 **User Management**: Active list of users, ban/unban controls, and privilege adjustments.

### 🎨 Design & Experience
* 🌌 **Modern Atmospheric UI**: Dark-themed aesthetic featuring glowing gradients, glassmorphic cards, and a canvas-based particle background.
* 🔄 **AJAX Uploads**: Real-time progress bars showing upload speeds and completion percentages.
* 📱 **Fully Responsive**: Mobile-ready drawer menus and responsive grids designed for devices of all sizes.

---

## 🛠️ Tech Stack

* **Backend**: PHP (MySQLi for database operations)
* **Database**: MySQL
* **Frontend**: HTML5, Vanilla CSS3 (Custom animations & CSS custom properties), JavaScript (ES6+, Canvas Particles, AJAX)
* **Mail Service**: PHPMailer (SMTP support)

---

## 📂 Project Structure

```text
├── components/          # Reusable PHP blocks (header, footer, nav, sessions)
│   ├── config.php       # Database configuration (credentials template)
│   └── secretKey.php    # Recaptcha or system secret keys
├── scripts/             # Client-side JavaScript (animations, theme logic, menus)
├── styles/              # Vanilla CSS stylesheets (modular components & layouts)
├── u/                   # Directory where uploaded files are stored (ignored in git)
├── index.php            # Homepage
├── upload.php           # File upload page
├── download.php         # File download page
└── admin.php            # Admin control dashboard
```

---

## 🚀 Getting Started

### 📋 Prerequisites
* **Web Server**: Apache / Nginx with PHP 7.4 or higher installed.
* **Database**: MySQL / MariaDB.
* **SMTP Server**: For sending registration/verification OTP emails (e.g., Gmail SMTP).

### ⚙️ Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/pasindu8/swiftfilelink_php.git
   cd swiftfilelink_php
   ```

2. **Configure Database**:
   - Locate the configuration files:
     - [config.php](config.php) (root folder)
     - [components/config.php](components/config.php)
   - Update the database credentials in both files:
     ```php
     $servername = "localhost";
     $username   = "your_db_username";
     $password   = "your_db_password";
     $dbname     = "your_db_name";
     ```

3. **Import Database Schema**:
   - Create a new MySQL database.
   - Import your project's database table schema (users, files, notification, otp tables).

4. **SMTP Configuration (For Emails)**:
   - Open [register.php](register.php), [forgotpassword.php](forgotpassword.php), and [verificationr.php](verificationr.php).
   - Locate the SMTP setup blocks and set your email & app password:
     ```php
     $mail->Host       = 'smtp.gmail.com';
     $mail->Username   = 'your-email@gmail.com';
     $mail->Password   = 'your-app-password';
     $mail->Port       = 587;
     ```

5. **Start Sharing**:
   - Run the project on your local environment (e.g., `http://localhost/swiftfilelink_php`).

---

## 🔒 Security Notice

Please ensure that **production database credentials and SMTP app passwords are never committed to your public Git repository**. Always replace production values with placeholders (like `your_db_password` and `your-app-password`) before pushing to GitHub.

---

## 📄 License

This project is licensed under the MIT License - see the `LICENSE` file for details.
