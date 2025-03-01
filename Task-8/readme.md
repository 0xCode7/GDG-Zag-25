# E-Commerce Cart Management

## Task Description
This task involves implementing a shopping cart system in PHP using MySQL as the database. The system allows users to:

- Add products to the cart.
- Update product quantities in the cart.
- Remove products from the cart.
- View the cart with product details.
- Checkout and place an order.

## How to Run

### Prerequisites
- XAMPP or any local server with PHP and MySQL.
- A web browser.

### Steps to Run
1. Clone or copy the project files into your XAMPP `htdocs` folder.
2. Start Apache and MySQL in XAMPP.
3. Create the database in MySQL (see the database details below).
4. Import the provided SQL file to create tables and insert sample data.
5. Configure the database connection in `config.php`.
6. Open the project in a browser (e.g., `http://localhost/e-commerce/cart.php`).

## Database Details

### Database Name: `ecommerce_db`

### Tables
#### 1. `users`
| Column Name  | Data Type | Description        |
|-------------|----------|--------------------|
| id          | INT      | Primary Key       |
| username    | VARCHAR  | Unique username  |
| password    | VARCHAR  | Hashed password  |

#### 2. `products`
| Column Name | Data Type | Description      |
|------------|----------|------------------|
| id         | INT      | Primary Key      |
| name       | VARCHAR  | Product name     |
| price      | DECIMAL  | Product price    |
| image      | VARCHAR  | Image URL        |

#### 3. `cart`
| Column Name | Data Type | Description                   |
|------------|----------|-------------------------------|
| user_id    | INT      | Foreign Key (users.id)       |
| product_id | INT      | Foreign Key (products.id)    |
| quantity   | INT      | Number of items in the cart  |

#### 4. `orders`
| Column Name | Data Type | Description                 |
|------------|----------|-----------------------------|
| id         | INT      | Primary Key                 |
| user_id    | INT      | Foreign Key (users.id)     |
| total_price| DECIMAL  | Total order price           |
| created_at | TIMESTAMP| Order timestamp             |

#### 5. `order_items`
| Column Name | Data Type | Description                   |
|------------|----------|-------------------------------|
| order_id   | INT      | Foreign Key (orders.id)      |
| product_id | INT      | Foreign Key (products.id)    |
| quantity   | INT      | Number of items in order     |
| price      | DECIMAL  | Price at purchase time       |

### Checkout Process
1. User adds products to the cart.
2. On the cart page, they click the checkout button.
3. The cart items are moved to `orders` and `order_items`.
4. The cart is cleared.

Now, the user can view their past orders.

---
Developed for an e-commerce project using PHP & MySQL.

