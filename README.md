# MAW11 - Exercice Looper

## Subject

Create a copy of this web application: [Exercice Looper](https://maw-looper.mycpnv.ch/)

## Deadlines

- **Intermediate:** 31.10.2024
- **Final:** 21.12.2024

## Requirements

You must use:

- HTML5
- CSS
- PHP
- Object-Oriented Programming (OOP)

## Installation

### Local Installation (for Development)

#### Prerequisites:

1. Have PHP and a database connection service installed.
2. Verify the installation in a shell:
    ```bash
    php -v
    ```
   Successful verification occurs if the command is recognized.

#### Procedure:

1. Clone the repository from GitHub or download it as a ZIP file:
    ```bash
    git clone <repository_url>
    ```
   Example: Clone it into the folder `C:/Users/<username>/Documents/Github/`.

2. Set up the database:
    - Run the provided script `create_db.sql` located in the `modelisation` folder to create the necessary database.
    - Database connection details are:
      ```php
      DBConnection::setUp(
          'mysql:host=127.0.0.1;port=3308;dbname=looper;charset=utf8mb4',
          'root',
          'root_password'
      );
      ```

3. Install dependencies:
    ```bash
    composer install
    ```
   Run this command in the root of the project directory.

4. Start the development server:
    ```bash
    php -S localhost:4444 -t public
    ```

## Progress

### Completed Features:

- Exercise creation works.
- Field creation works.
- Fields can be viewed within an exercise.

### Known Issues:

- Exercises cannot be viewed.
- Fields cannot be viewed individually.
- Exercises cannot be filled.
- Responses cannot be viewed.
- CSS is broken.
- No best practices like dotenv or similar are followed.
- Code documentation is minimal.