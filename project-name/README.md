# Project Name

This project is a web application designed for managing academic information, including student and lecturer records, assignments, and user authentication.

## Directory Structure

- **assets/**: Contains all the static files for the application.
  - **css/**: CSS files for styling the web application.
  - **js/**: JavaScript files for client-side scripting.
  - **images/**: Image files used in the web application.

- **config/**: Contains configuration files.
  - **config.php**: Configuration settings for connecting to a MySQL database.

- **includes/**: Contains common PHP files used across the application.
  - **header.php**: Common header section for web pages.
  - **footer.php**: Common footer section for web pages.
  - **navbar.php**: Navigation bar for the web application.

- **pages/**: Contains the main web pages of the application.
  - **index.php**: Homepage of the web application.
  - **login.php**: User login functionality.
  - **register.php**: User registration functionality.
  - **dashboard.php**: User dashboard after logging in.
  - **students.php**: Admin interface for managing student records.
  - **lecturers.php**: Admin interface for managing lecturer records.
  - **assignments.php**: Interface for managing assignments.

- **admin/**: Contains admin-specific pages.
  - **manage_users.php**: Admin interface for managing user accounts.
  - **reports.php**: Generates reports for the admin.

- **db/**: Contains database-related files.
  - **thesis_management.sql**: SQL structure for the database.

- **logout.php**: Handles user logout functionality.

- **.htaccess**: Apache configuration settings if needed.

## Installation

1. Clone the repository to your local machine.
2. Navigate to the project directory.
3. Set up the database using the `thesis_management.sql` file.
4. Update the `config/config.php` file with your database credentials.
5. Open the application in your web browser.

## Usage

- Access the homepage at `index.php`.
- Use the login and registration pages to manage user accounts.
- Admin users can manage students and lecturers through their respective pages.
- The dashboard provides an overview of user-specific information.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request for any enhancements or bug fixes.

## License

This project is licensed under the MIT License. See the LICENSE file for details.