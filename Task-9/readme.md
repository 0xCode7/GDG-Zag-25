# User Authentication and Product Management System

## Description
This project is a PHP-based User Authentication and Product Management System that follows Object-Oriented Programming (OOP) principles. The system allows users to:
- Register, log in, and log out.
- Manage products with Create, Read, Update, and Delete (CRUD) operations.

## How to Run the Project

### 1. Database Setup
1. Create a MySQL database named `e_commerce_task_8`.
2. Create the following tables:
   
#### Users Table
```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### Products Table
```sql
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### 2. Project Setup
1. Clone or download the project.
2. Import the database structure into MySQL.
3. Configure database connection in `db.php`.
4. Start a local server using XAMPP or another tool.
5. Open `index.php` in the browser.

## Endpoints

### Authentication Routes
- `POST /register.php` → Register a new user.
- `POST /login.php` → Log in a user.
- `GET /logout.php` → Log out the user.

### Product Management Routes
- `POST /product/create.php` → Create a new product.
- `GET /product/index.php` → Retrieve all products.
- `POST /product/update.php?id={id}` → Update product details.
- `GET /product/delete.php?id={id}` → Delete a product.

## Notes
- Users must be logged in to manage products.
- Passwords are hashed for security.

Enjoy coding! 🚀

