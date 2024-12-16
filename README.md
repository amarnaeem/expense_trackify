# Trackify

Trackify is a comprehensive application designed to manage and track expenses and incomes, providing detailed reports based on user preferences. This README file will guide you through setting up the Trackify application locally using XAMPP.

## Prerequisites

Before starting, ensure the following prerequisites are met:

1. **XAMPP**: Download and install [XAMPP](https://www.apachefriends.org/index.html).
2. **PHP**: Ensure PHP version 7.4 or higher is installed (included with XAMPP).
3. **MySQL Database**: XAMPP includes MySQL, which will be used to manage the database.
4. **Git**: Install Git for version control if you haven't already. [Download Git](https://git-scm.com/).

---

## Steps to Set Up Trackify Locally

### Option 1: Clone the Repository Using Git

1. Open your terminal or Git Bash.
2. Navigate to the `htdocs` directory in your XAMPP installation folder:
   ```bash
   cd /path-to-xampp/htdocs
   ```
3. Clone the Trackify repository:
   ```bash
   git clone https://github.com/yourusername/trackify.git
   ```
4. Navigate into the project directory:
   ```bash
   cd trackify
   ```

### Option 2: Copy the Folder Directly

1. Download the Trackify project as a ZIP file from the repository (or obtain it directly).
2. Extract the ZIP file.
3. Copy the extracted folder into the `htdocs` directory of your XAMPP installation:
   ```
   /path-to-xampp/htdocs/trackify
   ```

---

### Set Up the Database

1. Open XAMPP and start the **Apache** and **MySQL** modules.
2. Open your browser and go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
3. Create a new database:
   - Click on "New" in the left sidebar.
   - Enter `trackify_db` as the database name.
   - Choose "utf8mb4_general_ci" as the collation and click "Create."
4. Import the database schema:
   - Click on the `project/db/trackify_db` database.
   - Click "Import" in the top menu.
   - Click "Choose File," navigate to the `database/trackify.sql` file in the project folder, and click "Go."

### Configure Environment Variables

1. Open the project folder and locate the `config.php` file in the `includes` directory.
2. Update the following settings:
   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'trackify_db');
   ?>
   ```

### Run the Application

1. Open your browser and navigate to:
   ```
   http://localhost/trackify
   ```
2. You should see the Trackify login page. If not, double-check the steps above.

---

## Features

- **User Authentication**: Register, login, and manage your account securely.
- **Expense Tracking**: Add, edit, and delete expense records.
- **Income Tracking**: Add, edit, and delete income records.
- **Reports**: Generate detailed reports by month, year, or custom date ranges.
- **Password Reset**: Includes "Forgot Password" and secure password reset functionality.

---

## Common Issues and Troubleshooting

### Issue: Unable to Start Apache or MySQL

- Ensure no other applications are using ports 80 or 3306 (e.g., Skype).
- Update the XAMPP configuration to use alternative ports if needed.

### Issue: Database Connection Error

- Double-check the credentials in `config.php`.
- Ensure the `trackify_db` database is created and imported correctly.

### Issue: Blank Page or Errors on Load

- Enable error reporting by updating `php.ini` in the XAMPP installation folder:
   ```ini
   display_errors = On
   display_startup_errors = On
   ```
- Restart Apache after making changes.

---

## Folder Structure

```
trackify/
├── database/           # Database dump files
├── includes/           # PHP configuration and utility scripts
├── public/             # Frontend assets (CSS, JS, images)
├── views/              # HTML and PHP files for views
├── index.php           # Main entry point
├── config.php          # Database configuration
└── README.md           # Documentation
```

---

## Future Enhancements

- API support for mobile integration.
- Advanced analytics and visualization.
- Multi-user and role-based access.

---

## Contribution

Feel free to contribute to Trackify by submitting issues or creating pull requests. Follow the repository's contribution guidelines.

---

## License

Trackify is licensed under the [MIT License](LICENSE).

