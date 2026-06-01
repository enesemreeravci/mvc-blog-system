# MVC Blog System

MVC Blog System is a web application developed as an academic project to demonstrate the implementation of the **Model-View-Controller (MVC)** architectural pattern using **PHP**, **MySQL**, **Bootstrap 5**, and **PDO**.

The system allows users to register, authenticate, create blog posts, comment on articles, search content, and enables administrators to manage categories and moderate content through an administration panel.

---

# Features

## Authentication

* User Registration
* User Login
* User Logout
* Password Hashing using `password_hash()`
* Password Verification using `password_verify()`
* Session-based Authentication

## Authorization

* User Roles (User / Admin)
* Protected Routes
* Admin-only Features
* Middleware-based Access Control

## Blog Posts

* Create Post
* Edit Post
* Delete Post
* View Posts
* Draft / Published Status
* Slug-based URLs

## Categories

* Create Categories
* Edit Categories
* Delete Categories
* Assign Categories to Posts
* Category Statistics

## Comments

* Add Comments
* Delete Own Comments
* Admin Comment Moderation

## Search & Pagination

* Search Blog Posts
* Paginated Results
* Keyword-based Filtering

## Security

* CSRF Protection
* Prepared Statements (PDO)
* Password Hashing
* Session Security
* Input Validation
* Role-based Authorization

## Frontend

* Bootstrap 5
* Responsive Layout
* Flash Messages
* Navigation System
* Admin Dashboard

---

# Technologies Used

* PHP 8+
* MySQL
* Apache
* Bootstrap 5
* HTML5
* CSS3
* PDO
* MVC Architecture
* Git
* GitHub

---

# Project Structure

```text
mvc_blog_system/
│
├── app/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── PostController.php
│   │   ├── AdminController.php
│   │   └── AdminCategoryController.php
│   │
│   ├── Core/
│   │   ├── Controller.php
│   │   ├── Router.php
│   │   ├── Middleware.php
│   │   ├── Session.php
│   │   └── Csrf.php
│   │
│   ├── Models/
│   │   ├── User.php
│   │   ├── Post.php
│   │   ├── Comment.php
│   │   └── Category.php
│   │
│   └── Views/
│       ├── auth/
│       ├── home/
│       ├── posts/
│       ├── admin/
│       └── layouts/
│
├── config/
│   └── database.php
│
├── public/
│   └── index.php
│
├── database.sql
├── routes.php
└── README.md
```

---

# MVC Architecture

This project follows the MVC (Model-View-Controller) design pattern.

## Model

Responsible for communicating with the database.

Examples:

* User.php
* Post.php
* Comment.php
* Category.php

## View

Responsible for displaying data to users.

Examples:

* Login Page
* Registration Page
* Post Pages
* Admin Pages

## Controller

Responsible for business logic and request handling.

Examples:

* AuthController
* PostController
* AdminController
* AdminCategoryController

This separation improves maintainability, readability, and scalability.

---

# Database Structure

## users

Stores:

* id
* username
* email
* password
* role

## posts

Stores:

* id
* title
* slug
* content
* excerpt
* status
* category_id
* user_id
* created_at

## comments

Stores:

* id
* content
* user_id
* post_id
* created_at

## categories

Stores:

* id
* name
* slug

---

# Installation

## 1. Clone Repository

```bash
git clone https://github.com/enesemreeravci/mvc_blog_system.git
```

## 2. Move Project

Place the project inside:

```bash
/var/www/html/
```

Example:

```bash
/var/www/html/mvc_blog_system
```

## 3. Create Database

Login to MySQL:

```bash
mysql -u root -p
```

Create database:

```sql
CREATE DATABASE mvc_blog_system;
```

Import database:

```bash
mysql -u root -p mvc_blog_system < database.sql
```

## 4. Configure Database

Edit:

```bash
config/database.php
```

Update database credentials:

```php
private string $host = "localhost";
private string $db_name = "mvc_blog_system";
private string $username = "your_username";
private string $password = "your_password";
```

## 5. Start Services

```bash
sudo systemctl start apache2
sudo systemctl start mysql
```

## 6. Open Application

```text
http://localhost/mvc_blog_system/public/
```

---

# Administrator Account

Administrator privileges can be assigned directly from MySQL.

Example:

```sql
UPDATE users
SET role = 'admin'
WHERE email = 'admin@example.com';
```

---

# Security Features

## Password Hashing

Passwords are securely stored using:

```php
password_hash()
```

Verification uses:

```php
password_verify()
```

## CSRF Protection

All important forms include CSRF tokens.

Tokens are generated and validated before processing requests.

## Prepared Statements

All database operations use PDO prepared statements to protect against SQL injection attacks.

## Session Authentication

User authentication is maintained through PHP sessions.

## Role-Based Authorization

Administrative functionality is protected using middleware.

Only authorized users can access administrative routes.

---

# Learning Outcomes

Through this project I learned:

* MVC Architecture
* Object-Oriented Programming in PHP
* Database Design and Relationships
* Authentication and Authorization
* Session Management
* CSRF Protection
* SQL Query Optimization
* Bootstrap Frontend Development
* Git and GitHub Version Control
* Secure Web Application Development

---

# Future Improvements

* Image Uploads
* Rich Text Editor
* User Profiles
* Category Filtering
* Email Verification
* Password Reset
* REST API
* AJAX Comments
* Dark Mode
* Dashboard Analytics

---

# Author

**Enes Emre Eravcı**

Computer Science Student

VIZJA University

GitHub:
https://github.com/enesemreeravci


---

# Acknowledgements

This project was developed as part of my Computer Science studies and was inspired by modern PHP MVC web application practices.

---

# License

This project is intended for educational and learning purposes.
