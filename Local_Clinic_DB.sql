-- 1. Setup Database
CREATE DATABASE IF NOT EXISTS Local_Clinic_DB;
USE Local_Clinic_DB;

DROP TABLE IF EXISTS appointments;
DROP TABLE IF EXISTS medical_records;
DROP TABLE IF EXISTS patients;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(50) DEFAULT 'patient',
  remember_token VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE patients (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  first_name VARCHAR(255) NOT NULL,
  last_name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone VARCHAR(20) NULL,
  address TEXT NULL,
  dob DATE NOT NULL,
  gender ENUM('Male', 'Female', 'Other') NOT NULL,
  patient_number VARCHAR(50) NOT NULL,
  status VARCHAR(50) DEFAULT 'Active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY patients_email_unique (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE medical_records (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL, 
  title VARCHAR(255) NOT NULL,
  description TEXT NULL,
  file_path VARCHAR(255) NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX idx_medical_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE appointments (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL, 
  patient_id BIGINT UNSIGNED NOT NULL,
  appointment_date DATE NOT NULL,
  appointment_time TIME NOT NULL,
  purpose VARCHAR(255) NOT NULL,
  status ENUM('Pending', 'Confirmed', 'Cancelled', 'Completed') DEFAULT 'Pending',
  notes TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX idx_appointment_email (email),
  CONSTRAINT fk_patient_appointment
    FOREIGN KEY (patient_id)
    REFERENCES patients (id)
    ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (name, email, password, role) 
VALUES (
    'Clinic Administrator', 
    'admin@clinic.com', 
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 
    'admin'
);

CREATE TABLE IF NOT EXISTS patients (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  patient_number VARCHAR(20) NOT NULL UNIQUE, -- e.g., PNT-2026-0001
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  email VARCHAR(150) UNIQUE NOT NULL,
  phone VARCHAR(20) NULL,
  dob DATE NOT NULL,
  gender ENUM('Male', 'Female', 'Other') NOT NULL,
  address TEXT NULL,
  status ENUM('Active', 'On Hold', 'Pending', 'Inactive') DEFAULT 'Active',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE = InnoDB;

INSERT INTO patients (patient_number, first_name, last_name, email, dob, gender, status)
VALUES ('PNT-2026-0001', 'Test', 'Patient', 'test@example.com', '1990-01-01', 'Male', 'Active');

CREATE TABLE sessions (
  id varchar(255) NOT NULL,
  user_id bigint(20) unsigned DEFAULT NULL,
  ip_address varchar(45) DEFAULT NULL,
  user_agent text DEFAULT NULL,
  payload longtext NOT NULL,
  last_activity int(11) NOT NULL,
  PRIMARY KEY (id),
  KEY sessions_user_id_index (user_id),
  KEY sessions_last_activity_index (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE appointments MODIFY COLUMN status ENUM('Pending', 'Confirmed', 'Rescheduled', 'Cancelled', 'Completed') DEFAULT 'Pending';