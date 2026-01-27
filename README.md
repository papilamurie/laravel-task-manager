# Laravel Task Manager

A modern task management application built with Laravel 12, featuring user authentication, CRUD operations, and advanced filtering capabilities.

![Laravel](https://img.shields.io/badge/Laravel-12.x-red)
![PHP](https://img.shields.io/badge/PHP-8.3-blue)
![License](https://img.shields.io/badge/License-MIT-green)

## 🚀 Features

- ✅ User Authentication (Register, Login, Logout)
- ✅ Create, Read, Update, Delete Tasks
- ✅ Task Categories with Color Coding
- ✅ Priority Levels (Low, Medium, High)
- ✅ Task Status (Pending, In Progress, Completed)
- ✅ Due Dates with Overdue Detection
- ✅ Advanced Filtering (Status, Priority, Category)
- ✅ Responsive Design with Tailwind CSS
- ✅ User-specific Tasks (Security Enforced)

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Authentication:** Laravel Breeze
- **Database:** MySQL
- **Frontend:** Blade Templates + Tailwind CSS
- **PHP Version:** 8.3+

## 📸 Screenshots

### Task List
![Task List](screenshots/task-list.png)

### Create Task
![Create Task](screenshots/create-task.png)

### Task Details
![Task Details](screenshots/task-details.png)

## 📦 Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- MySQL or PostgreSQL
- Node.js & NPM

### Setup Instructions

1. **Clone the repository**
```bash
   git clone https://github.com/papilamurie/laravel-task-manager.git
   cd laravel-task-manager
```

2. **Install dependencies**
```bash
   composer install
   npm install
```

3. **Environment setup**
```bash
   cp .env.example .env
   php artisan key:generate
```

4. **Configure database**
   
   Edit `.env` file:
```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_manager
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
```

5. **Run migrations and seeders**
```bash
   php artisan migrate
   php artisan db:seed --class=CategorySeeder
```

6. **Build assets**
```bash
   npm run build
```

7. **Start the application**
```bash
   php artisan serve
```

   Visit: http://localhost:8000

## 🎯 Usage

1. **Register** a new account or **login**
2. Click **"Create New Task"** to add a task
3. Fill in task details (title, description, category, priority, status, due date)
4. Use **filters** to find specific tasks
5. **View**, **Edit**, or **Delete** tasks as needed
6. Track overdue tasks (shown in red)

## 📁 Project Structure
```
laravel-task-manager/
├── app/
│   ├── Http/Controllers/
│   │   └── TaskController.php
│   └── Models/
│       ├── Task.php
│       ├── Category.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── CategorySeeder.php
├── resources/
│   └── views/
│       └── tasks/
│           ├── index.blade.php
│           ├── create.blade.php
│           ├── edit.blade.php
│           └── show.blade.php
└── routes/
    └── web.php
```

## 🔒 Security Features

- CSRF protection on all forms
- User authentication required for all task routes
- Authorization checks (users can only access their own tasks)
- Password hashing with bcrypt
- SQL injection protection via Eloquent ORM

## 🚧 Future Enhancements

- [ ] Task search functionality
- [ ] Email notifications for due tasks
- [ ] Task sharing between users
- [ ] File attachments
- [ ] Task comments
- [ ] Dashboard with statistics

## 📄 License

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 👤 Author

**Your Name**
- GitHub: [@papilamurie](https://github.com/papilamurie)


## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Laravel Breeze](https://laravel.com/docs/starter-kits) - Authentication scaffolding

---

⭐ If you found this project helpful, please give it a star!
