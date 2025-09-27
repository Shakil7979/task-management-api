# Task Manager (Laravel API + Vue SPA)

## 1️⃣ Project Overview
Task Manager is a web application that allows users to add multiple tasks dynamically without reloading the page.  

- Backend: Laravel REST API  
- Frontend: Vue 3 SPA with TailwindCSS  
- Notifications: Toastr for success/error messages  

This project demonstrates:  
- Multi-task insertion  
- Validation  
- Optimized execution using chunked database inserts  
- SPA frontend

---

## 2️⃣ Table of Contents
- Setup
- Architecture
- API Documentation 
- Scalability & Optimization

---

## 3️⃣ Setup

### Backend (Laravel)
1. Clone repository:
   git clone <backend-repo-url>
   cd task-management-api

2. Install dependencies:
   composer install

3. Create `.env` file:
   cp .env.example .env

4. Configure database in `.env`:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_manager
   DB_USERNAME=root
   DB_PASSWORD=

5. Run migrations:
   php artisan migrate

6. Start backend server:
   php artisan serve
 

## 4️⃣ Architecture

Backend (Laravel)
- REST API with /api/tasks endpoint
- Validation via StoreMultipleTasksRequest
- Bulk insert with chunking (500 rows per chunk)
- Transaction ensures atomic insert

Frontend (Vue SPA + Tailwind)
- Dynamic repeater form to add multiple tasks
- Add/remove tasks without page reload
- Axios for API calls
- Toastr for notifications
- Responsive UI using TailwindCSS

---

## 5️⃣ API Documentation

POST /api/tasks

Request Body (JSON):
{
  "tasks": [
    { "title": "Task 1", "description": "Description 1", "due_date": "2025-09-30" },
    { "title": "Task 2", "description": "Description 2", "due_date": "2025-10-01" }
  ]
}

Success Response:
{
  "status": "success",
  "message": "2 tasks created successfully"
}

Validation Error Response:
{
  "message": "The tasks.1.title field is required.",
  "errors": {
    "tasks.1.title": ["Each task must have a title."]
  }
}

--- 

## 6️⃣ Scalability & Optimization

Database Optimization
- Bulk insert in chunks
- Transaction ensures atomic insertion
- Fewer queries for large datasets
 
Extensibility
- Add task categories, priorities
- Backend handles large datasets efficiently
- Frontend can easily extend to more SPA components

---

## Author
- Name: Sadbin Rabbi
- Role: Laravel & Vue Developer  
- Contact: shakilcoding@gmail.com
