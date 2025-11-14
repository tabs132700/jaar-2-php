# PHP Login System

This project is a minimal login system built with PHP, PDO, and OOP principles.

## Prerequisites
- PHP 8.1+
- MySQL 5.7+/MariaDB

## Setup
1. Create the database schema:
   ```bash
   mysql -u root -p < sql/schema.sql
   ```
2. Update the environment variables for database access (optional, defaults shown):
   ```bash
   export DB_DSN="mysql:host=localhost;dbname=login_app;charset=utf8mb4"
   export DB_USER="root"
   export DB_PASSWORD=""
   ```
3. Start a PHP development server from the project root:
   ```bash
   php -S localhost:8000 -t public
   ```
4. Visit `http://localhost:8000/login.php` to log in.

## Creating Users
Use the `createUser` method (e.g., via a temporary script) or generate a hash from the command line:
```bash
php -r "echo password_hash('secret', PASSWORD_DEFAULT) . PHP_EOL;"
```
Then insert the user with the generated hash:
```sql
INSERT INTO users (name, email, password)
VALUES ('Jane Doe', 'jane@example.com', '$2y$...');
```

## Project Structure
```
public/
  index.php
  login.php
src/
  Database.php
  User.php
templates/
  login_form.php
sql/
  schema.sql
```

## Security Notes
- Passwords are hashed using `password_hash` and verified with `password_verify`.
- Database interactions use prepared statements and exceptions.
- Sessions are used to persist authentication state.
