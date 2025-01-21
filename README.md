# Youdemy - Online Learning Platform

## Overview
Youdemy is an online learning platform designed to provide an interactive and personalized experience for students and teachers. The platform allows users to browse, search, and enroll in courses, while teachers can create and manage their courses. Admins oversee user accounts, course content, and platform statistics.

---

## Features

### Front Office
- **Visitors**:
  - Browse course catalog with pagination.
  - Search courses by keywords.
  - Register as a Student or Teacher.

- **Students**:
  - View course details (description, content, instructor).
  - Enroll in courses.
  - Access "My Courses" section.

- **Teachers**:
  - Add, edit, and delete courses.
  - View course statistics (enrollments, etc.).

### Back Office
- **Admin**:
  - Validate teacher accounts.
  - Manage users (activate, suspend, delete).
  - Manage courses, categories, and tags.
  - View global statistics (total courses, popular categories, etc.).

---

## Technical Stack
- **Backend**: PHP (OOP principles, sessions, prepared statements).
- **Frontend**: HTML5, CSS, JavaScript (native client-side validation).
- **Database**: Relational database (MySQL) with one-to-many and many-to-many relationships.
- **Security**: Input validation, XSS and CSRF prevention, SQL injection protection.

---

## Prerequisites

Before you begin, ensure you have met the following requirements:

- You have installed [Node.js](https://nodejs.org/) and [npm](https://www.npmjs.com/).
- You have a running instance of [PostgreSQL](https://www.postgresql.org/).
- You have a running instance of Apache.

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/tahajaiti/Youdemy
    ```
2. Navigate to the project directory:
    ```sh
    cd Youdemy
    ```
3. Install the dependencies:
    ```sh
    npm install
    composer install
    ```

## Configuration

1. Go to `Config.php` file located inside `App/Config/`:
    ```env
    DB_HOST=localhost
    DB_PORT=PORT
    DB_USER=root
    DB_PASS=yourpassword
    DB_NAME=youdemy
    ```

## Running the Project

1. Start the development server.
2. Open your browser and navigate to `http://localhost/`.

## License

This project is open source. Do WHAT YOU WANT!