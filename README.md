# Mini Issue Tracker

A Laravel 11 application built as part of the **PRITECH LLC Technical Task**.  
It allows a small team to manage projects, issues, tags, comments, and user roles with permissions.

---

## ✨ Features

### ✅ Authentication & User Management
- [x] Authentication (login, register, password reset, profile update)
- [x] Role & Permission system (Spatie) with seeded Admin & User roles
- [x] User profile editing with avatars
- [x] Application & mail settings with validation

### ✅ Core Features
- [x] Projects – list, create, edit, delete, show with issues
- [x] Issues – list (with filters), create, edit, delete, detail view
- [x] Tags – create, list, attach/detach via AJAX
- [x] Comments – AJAX load & add with validation

### ✅ UI / UX
- [x] SweetAlert flash messages for success/error
- [x] Reusable Blade partials for breadcrumbs, modals, datatable styles
- [x] Responsive design with dark mode
- [ ] Kanban board (planned)

### ✅ Bonus Features
- [x] Assign users to issues (many-to-many via AJAX)
- [x] Authorization (only project owners can edit/delete)
- [x] Text search with debounce (AJAX, global overlay for issues/projects/tags)


---

## 🛠 Tech Stack

- **Laravel 11** (PHP 8.2+)  
- **Blade** templating  
- **Spatie Roles & Permissions**  
- **MySQL / MariaDB**  
- **AJAX (vanilla JS + Blade)**  
- **DataTables** for listing pages  
- **SweetAlert2** for feedback 
 

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
   git clone https://github.com/tinikrasniqi/issue-tracker.git 
   cd issue-tracker  

2. Install PHP dependencies:  
   composer install  

3. Copy the environment file and generate the application key and create storage link:  
   cp .env.example .env 
   php artisan key:generate  
   php artisan storage:link

4. Configure your database in the `.env` file, then run migrations with seeders to create demo data:  
   php artisan migrate --seed  

5. Start the local development server:  
   php artisan run (it runs the server on port 80)  

