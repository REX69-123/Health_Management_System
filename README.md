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

1. Turn on xampp and open IDE Vs Code
2. Clone the Repository Download the project files to your local environment.
3. Download the Local_Clinic_DB sql file and put into your database PhpMyAdmin or MySQL Workbench
4. Go to Vs Code terminal then Composer install -> npm install -> php artisan key:generate
5. Go to Env file upon opening the project folder find and change the DB_Database into DB_DATABASE=Local_Clinic_DB
6. Go to terminal then php artisan storage:link -> php artisan migrate -> php artisan migrate:fresh --seed and type composer run dev
7. To open as admin Type this on browser 127.0.0.1:8000/login and 127.0.0.1:8000/portal/login as patient

## How to troubleshoot
php artisan optimize:clear to clear all cache

# Visual Documentation
<img width="1365" height="637" alt="image" src="https://github.com/user-attachments/assets/b95e5a1e-2d2e-425e-a475-3b53fb78c04d" />
The main hub for staff to manage patients, appointments, and medical records.

<img width="1352" height="638" alt="image" src="https://github.com/user-attachments/assets/19babe90-2947-45e0-8c95-69f52e44318f" />
The isolated, secure view where patients can review their age, status, and history.


