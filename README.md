# Portfolio Site Backend

![Laravel](https://img.shields.io/badge/Laravel-8.x-red) ![PHP](https://img.shields.io/badge/PHP-%3E=8.1-blue) ![License](https://img.shields.io/badge/License-MIT-green)

This is a **Laravel-based backend API** for a portfolio website, featuring JWT authentication and various portfolio management endpoints.

---

## 🚀 Features

✅ JWT Authentication  
✅ Project Management  
✅ CV/Resume Upload & Download  
✅ Contact Form Handling  
✅ Portfolio Statistics Tracking  
✅ Review Management  

---

## 🛠️ Requirements

- **PHP** >= 8.1
- **Composer**
- **MySQL/MariaDB**
- **Node.js** (for frontend assets)

---

## 📥 Installation

Follow these steps to set up the project locally!

```bash
# Clone the repository
git clone https://github.com/your-repo/portfolio-backend.git
cd portfolio-backend

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install

# Create and configure .env file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=root
DB_PASSWORD=

# Run migrations
php artisan migrate

# Link storage folder
php artisan storage:link

# Start development server
php artisan serve
```

👉 Your app should now be running on `http://localhost:8000`

---

## 📄 API Documentation

### 🔐 Authentication
- **POST** `/api/auth/login` - Login
- **POST** `/api/auth/register` - Register
- **POST** `/api/auth/logout` - Logout
- **POST** `/api/auth/refresh` - Token refresh

### 📁 Projects
- **GET** `/api/projects` - List projects
- **POST** `/api/projects` - Create project
- **GET** `/api/projects/{id}` - Get project details
- **PUT** `/api/projects/{id}` - Update project
- **DELETE** `/api/projects/{id}` - Delete project

### 📄 CV Management
- **POST** `/api/cv` - Upload CV
- **GET** `/api/cv` - Download CV

### 📬 Contact
- **POST** `/api/contact` - Send contact message

### 📊 Statistics
- **GET** `/api/stats` - Get portfolio statistics

### ⭐ Reviews
- **GET** `/api/reviews` - List reviews
- **POST** `/api/reviews` - Submit a review

---

## 🚀 Deployment

1. Set up your production environment variables in the `.env` file.
2. Run optimization commands:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

3. Configure your web server (Nginx/Apache).
4. Set up queue workers for email sending:

```bash
php artisan queue:work
```

---

## 📝 License

This project is licensed under the **MIT License**.

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

1. Fork the project.
2. Create your feature branch: `git checkout -b feature/new-feature`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature/new-feature`
5. Open a pull request.

---

✨ **Thank you for visiting!** If you like this project, give it a ⭐️ to show your support!

