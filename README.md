
## About Gusti Leave Information System

This project was made for Completing College Final Project,
Follow the steps below for setup the project

---
-- Tools

- Composer
- NodeJS
- XAMPP
- Git
- VS Code

-- Steps

Note: Before you begin, make sure you have the necessary software and dependencies installed, such as PHP, Composer, and a web server (e.g., Apache or Nginx).

Step 1: Install the project in your environment
1. Git Pull/Clone Project

Step 2: Set Up Your Environment
1. Make sure you have PHP installed on your machine. Open a terminal/command prompt and run the following command to check the PHP version:
   ```bash
   php -v
   ```
2. Install Composer if you haven't already. You can download it from [getcomposer.org](https://getcomposer.org/download/) and follow the installation instructions for your operating system.

Step 3: Configure Your Database
1. Create a new database for your Laravel project using your preferred database management tool (e.g., phpMyAdmin, MySQL Workbench).
2. Copy the `.env.example` file in the Laravel project's root directory and rename it to `.env`. Open the `.env` file and update the database configuration settings, including `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.

Step 4: Install Dependencies
1. Open a terminal/command prompt and navigate to the directory where you extracted the Laravel project files (e.g., "leave_information_system").
2. Run the following command to install Laravel's dependencies using Composer:
   ```bash
   composer install
   ```

Step 5: Generate an Application Key
1. In the same terminal window, run the following command to generate a unique application key for your Laravel project:
   ```bash
   php artisan key:generate
   ```

Step 6: Run Migrations and Seed Data (Optional)
1. If the project includes database migrations and seeders, you can run them to set up the database schema and initial data. Use the following commands:
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

Step 7: Start the Development Server
1. Finally, start the Laravel development server by running the following command:
   ```bash
   php artisan serve
   ```
2. Open a web browser and navigate to the URL provided by the `php artisan serve` command (usually `http://localhost:8000`) to access your Laravel project.

Congratulations! You have successfully installed a Laravel project using the source code from a .rar archive. You can now start developing and customizing your Laravel application

Step 8: Login as Admin role.
1. After successfully running the website, login as admin by entering
Name: HR-Admin
Password:123123

Step 9: Add Title list, Department list, Employee List, Leave Type
1. Add a list of title and Department by entering Title and Department menu on sidebar
2. Add Employee list by choosing Employee Data Menu on sidebar and filling the required text field and selecting Department and also Title of the Employee
3. Add a Leave Type that later can be picked by Employee to applying leave.


Step 10: Register as Employee and Select which employee you want to log in later
1. On a login Page press “Create One” button
2. Fill the needed credentials and select employee from employee list uploaded by admin that match your identity.
3. Registration process completed

Step 11: Check your Leave Balances
1. To check your leave balance, select “Remain Leave” option from Menu 
2. Your Remain Leave Balance will be shown 

Step 12: Proposing for Leave
1. To proposing Leave, click on the blue button that says “Propose Leave” on the sidebar
2. Fill all the credentials needed and also don’t forget to attach the document if you proposing leave that required for documents
3. Leave proposed and you just need to wait for approval from Supervisor and Admin

Notes: Leave only will be count in a Leave Balances card is a Leave request that already approved by HR or Supervisor


Step 13: Approving Leave
1. In Approving Leave you need to sign in as employee who have a title Supervisor, Manager and Director that assigned as Supervisor role by HR
2. After sign in as Supervisor role or Admin role you can access the Leave Request Menu and tick the checkbox then click submit.


