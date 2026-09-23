#  Money Management App

A simple and secure **Money Management Application** built with **PHP, MySQL, HTML, CSS, and JavaScript** to help users track their income, expenses, and overall financial balance.

The project provides a clean foundation for managing personal finances through a structured API-based backend.

##  Features

*  User Registration
*  User Login
*  Add Income
*  Add Expenses
*  Transaction Categories
*  Financial Dashboard
*  Total Income Calculation
*  Total Expense Calculation
*  Current Balance Calculation
*  Transaction History
*  Transaction Data API
*  Password Hashing
*  MySQL Database Integration
*  REST-style PHP APIs

##  Technologies Used

| Technology   | Purpose                |
| ------------ | ---------------------- |
| PHP          | Backend & API          |
| MySQL        | Database               |
| HTML5        | Frontend Structure     |
| CSS3         | Styling                |
| JavaScript   | Frontend Logic         |
| PDO          | Secure Database Access |
| Git & GitHub | Version Control        |

## 📁 Project Structure

```text
Money Management App/
│
├── api/
│   ├── add_transaction.php
│   ├── dashboard.php
│   ├── login.php
│   ├── register.php
│   └── transactions.php
│
├── config/
│   └── database.php
│
├── assets/
│   ├── css/
│   └── js/
│
├── index.php
├── README.md
└── .gitignore
```

## 🔌 API Endpoints

### Authentication

#### Register

```http
POST /api/register.php
```

Example request:

```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
```

#### Login

```http
POST /api/login.php
```

Example request:

```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

### Transactions

#### Add Transaction

```http
POST /api/add_transaction.php
```

Example:

```json
{
    "user_id": 1,
    "type": "expense",
    "category": "Food",
    "amount": 250,
    "description": "Lunch",
    "transaction_date": "2026-09-23"
}
```

`type` can be:

```text
income
expense
```

#### Get Transactions

```http
GET /api/transactions.php?user_id=1
```

#### Dashboard

```http
GET /api/dashboard.php?user_id=1
```

Dashboard response includes:

```text
Total Income
Total Expense
Balance
```

##  Database

The application uses **MySQL**.

Create the database:

```sql
CREATE DATABASE money_management;
```

Then create the required tables for users and transactions.

The database connection is configured in:

```text
config/database.php
```

Default XAMPP configuration:

```text
Host: localhost
Database: money_management
Username: root
Password: ""
```

> Update the database credentials according to your local environment.

##  Installation

### 1. Clone the repository

```bash
git clone YOUR_REPOSITORY_URL
```

### 2. Move the project

Place the project inside your XAMPP `htdocs` directory:

```text
C:\xampp\htdocs\Money Management App
```

### 3. Start XAMPP

Start:

* Apache
* MySQL

### 4. Create Database

Open:

```text
http://localhost/phpmyadmin
```

Create:

```text
money_management
```

and import/run the required SQL schema.

### 5. Configure Database

Update:

```text
config/database.php
```

with your MySQL credentials.

### 6. Run the Application

Open:

```text
http://localhost/Money%20Management%20App/
```

## Security

The project follows basic security practices including:

* Password hashing using PHP `password_hash()`
* Password verification using `password_verify()`
* PDO prepared statements
* Input validation
* Email validation
* HTTP method validation
* JSON API responses
* Foreign key relationships
* Database-level constraints

##  Git Branches

The project uses separate branches for development.

```text
main
api
```

The `api` branch contains the backend API implementation.

## Current API

Currently implemented:

* User registration
* User login
* Add transaction
* Get transactions
* Dashboard summary

## Future Improvements

Planned improvements include:

* Session/JWT authentication
* Logout API
* Edit transactions
* Delete transactions
* Custom categories
* Monthly financial reports
* Expense charts
* Advanced transaction filtering
* User profile management
* Responsive UI
* Dark mode
* Advanced analytics
* Improved API authorization

##  Contributing

Contributions are welcome.

1. Fork the repository
2. Create a feature branch

```bash
git checkout -b feature/new-feature
```

3. Commit your changes

```bash
git commit -m "Add new feature"
```

4. Push the branch

```bash
git push origin feature/new-feature
```

5. Open a Pull Request

## 📄 License

This project is available for educational and personal development purposes.

