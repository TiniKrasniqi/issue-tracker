# Mini Issue Tracker

A Laravel 11 application built as part of the **PRITECH LLC Technical Task**.  
It allows a small team to manage projects, issues, tags, comments, and user roles with permissions.

---

## ✨ Features Roadmap

### ✅ Authentication & User Management
- [x] Authentication (login, register, password reset, profile update)
- [x] Role & Permission system (Spatie) with seeded Admin & User roles
- [x] User profile editing with avatars
- [x] Application & mail settings with validation

### 🚧 Core Features
- [ ] Projects – list, create, edit, delete, show with issues
- [ ] Issues – list (with filters), create, edit, delete, detail view
- [ ] Tags – create, list, attach/detach via AJAX
- [ ] Comments – AJAX load & add with validation

### 🚧 UI / UX
- [ ] Kanban board 
- [ ] AJAX validation feedback on forms
- [ ] Blade components for reusable UI parts (breadcrumbs, modals, etc.)

### 🚧 Bonus Features
- [ ] Assign users to issues (many-to-many via AJAX)
- [ ] Authorization (only project owners can edit/delete)
- [ ] Text search with debounce (AJAX)

### 🚧 Extra Enhancements
- [ ] Real-time updates with Laravel Echo & Pusher (comments, status changes)
- [ ] Export issues as PDF/CSV
- [ ] Activity log for auditing actions
- [ ] Global search bar integration
- [ ] Dark mode (already part of template)

---

## 🛠 Tech Stack

- **Laravel 11** (PHP 8.2+)  
- **Blade** templating  
- **Spatie Roles & Permissions**  
- **MySQL / MariaDB**  
- **AJAX (vanilla JS + Blade)**  
- **Laravel Echo & Pusher** (planned for realtime)  
- **Laravel Pint** for code style  

---

## 👤 Seeded Users

After running migrations & seeding, you’ll have:

- **Admin**  
  - Email: `admin@admin.com`  
  - Password: `admin12345`  

- **User**  
  - Email: `user@user.com`  
  - Password: `user12345`  

---

## 🚀 Getting Started

1. Clone the repository and navigate into the project directory:  
   git clone https://github.com/tinikrasniqi/issue-tracker.git && cd issue-tracker  

2. Install PHP dependencies:  
   composer install  

3. Copy the environment file and generate the application key and create storage link:  
   cp .env.example .env && php artisan key:generate  && php artisan storage:link

4. Configure your database in the `.env` file, then run migrations with seeders to create demo data:  
   php artisan migrate --seed  

5. Start the local development server:  
   php artisan serve  

