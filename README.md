# Brief Realisation

### Setup

1. Clone the repository and run the following commands:

```bash
composer install
npm install
npm run build
php artisan key:generate
php artisan migrate
```

2. Register a new user at `/register`

3. Login to the admin area at `/login`

4. Create a new company using `Create a Company` button on the dashboard

5. View Company list on the dashboard

6. Create a new employee using `Create a Employee` button on the company edit page

7. View Employee list on the company edit page

8. Edit the company using `Edit Company` button

9. Delete the employee using `Delete` button on the company edit page

## CareMaster Brief

### Models
Create the following models with attributes:

- Company
   - Name
   - Abn
   - Email
   - Address
 - Employee
   - First Name
   - Last Name
   - Email
   - Address

### Admin Area
Build into the admin area:
- a login page and admin area.
- a landing page dashboard that shows the number of Companies and Employees in the database
- a companies list page that shows all existing companies
- a way to create new companies
- a way to edit companies
- on the company edit page
    - create a new employee record that is automatically linked to the company on creation
    - a list of the employees that are currently linked to the company
    - a way to delete employee records from a company - which deletes the employee record entirely (as opposed to unlinking it and leaving the record orphaned)