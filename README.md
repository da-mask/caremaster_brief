# CareMaster Brief

A web application utilising Laravel, Vue, Inertia.js, and TailwindCSS.

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