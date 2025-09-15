# 🚀 Short Url Generator

A clean and well-structured **Short Url Generator** with authentication and a default **Super Admin** generated via seeder.  
This project can be extended into any application such as an admin panel, SaaS platform, or API backend.

---

## 📌 Features
- Laravel 10+ (latest stable version)
- Authentication ready
- Super Admin generated automatically via seeder
- web routes
- Well-structured, extendable codebase

---

## ⚙️ Requirements
Make sure your system has the following installed:

- PHP >= 8.1
- Composer >= 2
- MySQL
- Git

---

## 🛠️ Installation

### 1. Clone the Repository
```bash
git clone https://github.com/Yashkumarprasad/short-url-generator
cd your-project
composer install
cp .env.example .env


APP_NAME="Short Url Generator"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=short_url_generator
DB_USERNAME=root
DB_PASSWORD=

php artisan db:seed

Email: superadmin@sembark.com
Password: #sembark@superadmin1234

http://localhost/your-project

To access admin go on 

http://localhost/your-project/admin
