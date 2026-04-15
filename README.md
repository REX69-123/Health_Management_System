## About Health Management System (Health Portal)

A robust, industry-standard web application built on Laravel for managing clinic operations, staff administration, and patient portal access. 

This system utilizes multi-authentication to strictly separate Administrative/Staff capabilities from Patient Data, ensuring secure access to medical records, appointments, and portal logins.

# Members

PM - Christian Attos
QA - Adrian Calvez
FRONT END - Rex Salibay
BACK END - Matthew Ikee Crispino

## Prerequisites

Before setting up the system, ensure your server or local machine has the following installed:

* **PHP** >= 8.2
* **Composer** (PHP dependency manager)
* **Node.js & NPM** (Frontend asset compiling)
* **MySQL** or **MariaDB**

## Instructions to start the system

Use the terminal that has -Health_Management_System only!!
-> step

1. Turn on xampp and open IDE Vs Code then open folder, Choose the folder location then create new folder and use it
2. Go to the VS Code terminal then type this to clone repo (Copy and paste the 2 commands below on the terminal)

git clone https://github.com/REX69-123/Health_Management_System.git 
cd Health_Management_System

4. Download the Local_Clinic_DB sql file and put into your database PhpMyAdmin or MySQL Workbench
6. Rename .env.example to .env
7. Go to env file upon opening the project folder find and change the DB_Database into DB_DATABASE=Local_Clinic_DB, Session Driver into file and APP URL to APP_URL=http://127.0.0.1:8000
8. Go to Vs Code terminal then Composer install -> npm install -> npm run build -> php artisan key:generate -> php artisan storage:link -> php artisan migrate -> php artisan migrate:fresh --seed and type composer run dev ( if it asks question when running migrate and migrate:fresh click yes also if it asks for npm aufit fix when running npm install run npm audit fix)
9. To open as admin Type this on browser 127.0.0.1:8000/login and 127.0.0.1:8000/portal/login as patient
10. To login as admin Email: admin@clinic.com Pass: Password

## How to troubleshoot
1. php artisan optimize:clear to clear all cache
2. Php artisan key:generate it doesnt have app key in env

# Visual Documentation
<img width="1365" height="637" alt="image" src="https://github.com/user-attachments/assets/b95e5a1e-2d2e-425e-a475-3b53fb78c04d" />
The main hub for staff to manage patients, appointments, and medical records.

<img width="1352" height="638" alt="image" src="https://github.com/user-attachments/assets/19babe90-2947-45e0-8c95-69f52e44318f" />
The isolated, secure view where patients can review their age, status, and history.


