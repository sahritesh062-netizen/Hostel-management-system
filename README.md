\# 🏨 Hostel Management System



A web-based \*\*Hostel Management System\*\* developed using \*\*PHP, MySQL, HTML, CSS, and JavaScript\*\* to simplify hostel administration and student management.



The system provides an organized platform for managing students, rooms, complaints, mess menus, and administrative activities.



\---



\## 📌 Project Overview



The Hostel Management System is designed to digitize common hostel management tasks.



Instead of maintaining student, room, and complaint information manually, administrators can manage the information through a centralized web application.



\### 🎯 Objectives



\* Manage hostel rooms efficiently

\* Register and manage student information

\* Track room availability

\* Manage student complaints

\* Manage weekly mess menus

\* Provide a dedicated admin dashboard

\* Reduce manual record keeping

\* Provide an easy-to-use hostel management interface



\---



\## ✨ Features



\### 👨‍💼 Admin Management



\* Secure admin login

\* Admin dashboard

\* Student management

\* Add students

\* Edit student details

\* Delete student records

\* View student information

\* Room management

\* Edit room information

\* Complaint status management

\* Mess menu management



\### 🏠 Room Management



\* View available rooms

\* View room details

\* Track room capacity

\* Manage AC and Non-AC rooms

\* Monitor room availability



\### 👨‍🎓 Student Management



\* Student registration

\* Student details

\* Roll number management

\* Room allocation

\* Student information display

\* Student record editing



\### 📝 Complaint Management



\* Register complaints

\* View complaints

\* Edit complaints

\* Delete complaints

\* Update complaint status

\* Admin complaint management



\### 🍽️ Mess Management



\* Weekly mess menu

\* Breakfast management

\* Lunch management

\* Snacks management

\* Dinner management

\* Admin menu updates



\---



\## 🛠️ Technologies Used



| Technology   | Purpose                       |

| ------------ | ----------------------------- |

| HTML5        | Website structure             |

| CSS3         | Styling and responsive design |

| JavaScript   | Client-side functionality     |

| PHP          | Backend development           |

| MySQL        | Database management           |

| XAMPP        | Local development server      |

| Git \& GitHub | Version control               |



\---



\## 📂 Project Structure



```text

Hostel-management-system/

│

├── admin/

│   ├── add\_student.php

│   ├── complaint\_status.php

│   ├── dashboard.php

│   ├── delete\_student.php

│   ├── display\_student.php

│   ├── edit\_room.php

│   ├── edit\_student.php

│   ├── menu\_management.php

│   └── student\_management.php

│

├── assets/

│   ├── css/

│   │   ├── admin\_style.css

│   │   └── style.css

│   │

│   └── images/

│       └── logo.png

│

├── includes/

│   ├── auth.php

│   ├── db.php

│   ├── footer.php

│   ├── function.php

│   ├── header.php

│   ├── logout.php

│   └── sidebar.php

│

├── complaint.php

├── delete\_complaint.php

├── edit\_complaint.php

├── index.html

├── index.php

├── login.php

├── mess\_menu.php

├── my\_details.php

├── register\_complaints.php

├── view\_complaint.php

└── view\_rooms.php

```



\---



\## ⚙️ Installation \& Setup



\### 1. Install XAMPP



Download and install \*\*XAMPP\*\* with:



\* Apache

\* MySQL



Start both services from the XAMPP Control Panel.



\---



\### 2. Clone the Repository



```bash

git clone https://github.com/sahritesh062-netizen/Hostel-management-system.git

```



Move the project into the XAMPP `htdocs` directory:



```text

C:\\xampp\\htdocs\\

```



The final path should be:



```text

C:\\xampp\\htdocs\\hostel-management-system

```



\---



\### 3. Create the Database



Open:



```text

http://localhost/phpmyadmin

```



Create a database named:



```text

hostel\_db

```



Import the provided SQL database file into `hostel\_db`.



> \*\*Note:\*\* If the SQL file is not included in the repository, the required tables must be created manually or exported from the development database.



\---



\### 4. Configure Database Connection



Open:



```text

includes/db.php

```



Configure the MySQL connection according to your XAMPP setup.



Example:



```php

$conn = mysqli\_connect(

&#x20;   "localhost",

&#x20;   "root",

&#x20;   "",

&#x20;   "hostel\_db",

&#x20;   3307

);

```



If your MySQL server uses the default port, change `3307` to `3306`.



\---



\### 5. Run the Project



Open your browser and visit:



```text

http://localhost/Hostel-management-system/

```



If required, open:



```text

http://localhost/Hostel-management-system/index.html

```



\---



\## 🔐 Admin Login



The admin login is handled through the MySQL `admin` table.



Example development credentials:



```text

Username: admin

Password: admin

```



> \*\*Security Note:\*\* Change the default credentials before deploying the application to a production server.



\---



\## 🗄️ Database



The application uses MySQL to store:



\* Admin accounts

\* Student information

\* Room information

\* Complaints

\* Mess menu information



Main database:



```text

hostel\_db

```



\---



\## 📊 System Workflow



```text

&#x20;                   ┌─────────────────────┐

&#x20;                   │       User          │

&#x20;                   └──────────┬──────────┘

&#x20;                              │

&#x20;                              ▼

&#x20;                   ┌─────────────────────┐

&#x20;                   │    Hostel Website   │

&#x20;                   └──────────┬──────────┘

&#x20;                              │

&#x20;                ┌─────────────┴─────────────┐

&#x20;                │                           │

&#x20;                ▼                           ▼

&#x20;       ┌─────────────────┐        ┌─────────────────┐

&#x20;       │ Student Section │        │  Admin Section  │

&#x20;       └────────┬────────┘        └────────┬────────┘

&#x20;                │                          │

&#x20;                └────────────┬─────────────┘

&#x20;                             ▼

&#x20;                   ┌─────────────────────┐

&#x20;                   │     PHP Backend     │

&#x20;                   └──────────┬──────────┘

&#x20;                              │

&#x20;                              ▼

&#x20;                   ┌─────────────────────┐

&#x20;                   │     MySQL Database  │

&#x20;                   └─────────────────────┘

```



\---



\## 🔮 Future Improvements



Possible future enhancements include:



\* Online hostel fee payment

\* Student attendance tracking

\* Email notifications

\* SMS notifications

\* Room allocation automation

\* Password hashing and stronger authentication

\* Role-based access control

\* Responsive mobile application

\* Hostel maintenance tracking

\* Advanced admin analytics

\* Cloud deployment



\---



\## 🔒 Security Considerations



For production deployment, the following improvements are recommended:



\* Use password hashing with `password\_hash()`

\* Use prepared statements for all database queries

\* Implement CSRF protection

\* Validate and sanitize user input

\* Use HTTPS

\* Implement stronger authentication

\* Store database credentials securely

\* Add session timeout functionality



\---



\## 📸 Screenshots



Add screenshots of the application here:



```text

screenshots/

├── dashboard.png

├── login.png

├── rooms.png

├── students.png

├── complaints.png

└── mess-menu.png

```



Example:



```markdown

!\[Admin Dashboard](screenshots/dashboard.png)

```



\---



\## 👨‍💻 Author



\*\*Ritesh Sah\*\*



Computer Science (AI \& ML) Student



GitHub:

https://github.com/sahritesh062-netizen



\---



\## 📄 License



This project is developed for educational and academic purposes.



You are free to modify and improve the project for learning and personal use.



\---



\## ⭐ Support



If you find this project useful, consider giving the repository a ⭐ on GitHub.



\*\*Repository:\*\*

https://github.com/sahritesh062-netizen/Hostel-management-system



