# Doctor's Office Management System API

This is a RESTful API for managing a doctor's office, developed using Laravel. The API provides endpoints for managing authentication, doctors, patients, appointments, prescriptions, medical histories, and medications.

## Table of Contents

-   [Requirements](#requirements)
-   [Installation](#installation)
-   [Configuration](#configuration)
-   [Usage](#usage)
    -   [Authentication](#authentication)
    -   [Doctors](#doctors)
    -   [Patients](#patients)
    -   [Appointments](#appointments)
    -   [Prescriptions](#prescriptions)
    -   [Medical Histories](#medical-histories)
    -   [Medications](#medications)
    -   [Profile](#profile)

## Requirements

This project requires the following to run:

-    PHP 8.2+
-    Laravel v11.0+

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/doctor-office-management.git
    cd doctor-office-management
    ```

2. Install the dependencies:

    ```bash
    composer install
    ```

3. Set up the environment variables:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure your database in the `.env` file:

5. Set up the environment variables:

    ```bash
    php artisan migrate --seed
    ```

6. Start the development server

    ```bash
    php artisan serve
    ```

## Configuration

Ensure you configure the following environment variables in your `.env` file:


    DB_CONNECTION
    DB_HOST
    DB_PORT
    DB_DATABASE
    DB_USERNAME
    DB_PASSWORD


## Usage

### Authentication

-   Register a new user
    -    Endpoint: `POST /auth/register`
    -    Request Body:
            ```json
                 {
                      "name": "User Name",
                      "email": "patient@test.com",
                      "password": "password",
                      "password_confirmation": "password",
                      "type": "patient",
                      "phone": "0123456789"
                 }
            ``` 
-   Login
    -    Endpoint: `POST /auth/login`
    -    Request Body:
          ```json
                  {
                      "email": "doctor@example.com",
                      "password": "password"
                  }
            ```
          
-   Logout
    -    Endpoint: `POST /auth/logout`
    -    Authentication: Bearer token

-   Forgot Password
    -    Endpoint: `POST /auth/forgot-password`

-   Reset Password
    -    Endpoint: `PATCH /auth/reset-password`

-   Verify Email
    -    Endpoint: `POST /auth/verify-email`

-   Send Verification Email
    -    Endpoint: `POST /auth/send-verification-email`
    -    Authentication: Bearer token

### Doctors
-   Get One Doctor
    -    Endpoint: `GET /doctors/{id}`
    -    Authentication: Bearer token
 
 -   Get All Doctors
    -    Endpoint: `GET /doctors/`
    -    Authentication: Bearer token
 
### Patients
-   Get One Patient
    -    Endpoint: `GET /patients/{id}`
    -    Authentication: Bearer token
 
-   Get All Patients
    -    Endpoint: `GET /patients/`
    -    Authentication: Bearer token
 
### Appointments
-   Create Appointment
    -    Endpoint: `POST /appointments`
    -    Request Body:
            ```json
                 {
                      "patient_id": 1,
                      "date": "2024-07-03",
                      "time": "07:25:00",
                      "reason": "test reason"
                 }
    -    Authentication: Bearer token
 
-   Update Appointment
    -    Endpoint: `PATCH /appointments/{id}`
    -    Request Body:
            ```json
                 {
                      "patient_id": 1,
                      "date": "2024-07-03",
                      "time": "07:25:00",
                      "reason": "test reason"
                 }
    -    Authentication: Bearer token
-   Get One Appointment
    -    Endpoint: `GET /appointments/{id}`
    -    Authentication: Bearer token

-   Get All Appointments
    -    Endpoint: `GET /appointments/`
    -    Authentication: Bearer token
 
-  Delete Appointment
    -    Endpoint: `DELETE /appointments/{id}`
    -    Authentication: Bearer token

### Prescriptions
-   Create Prescription
    -    Endpoint: `POST /prescriptions`
    -    Request Body:
            ```json
                    {
                      "patient_id": 1,
                      "prescription_medications": [
                        {
                          "medication_id": 1,
                          "dosage": "3",
                          "frequency": "5",
                          "start_date": "2024-07-04",
                          "end_date": "2024-07-04"
                        }
                      ]
                    }
    -    Authentication: Bearer token
 
-   Update Prescription
    -    Endpoint: `PATCH /prescriptions/{id}`
    -    Request Body:
            ```json
                    {
                      "patient_id": 1,
                      "prescription_medications": [
                        {
                          "medication_id": 1,
                          "dosage": "3",
                          "frequency": "5",
                          "start_date": "2024-07-04",
                          "end_date": "2024-07-04"
                        }
                      ]
                    }
    -    Authentication: Bearer token
-   Get One Prescription
    -    Endpoint: `GET /prescriptions/{id}`
    -    Authentication: Bearer token

-   Get All Prescriptions
    -    Endpoint: `GET /prescriptions/`
    -    Authentication: Bearer token
    
-  Delete Prescription
    -    Endpoint: `DELETE /prescriptions/{id}`
    -    Authentication: Bearer token

### Medical Histories
-   Create Medical History
    -    Endpoint: `POST /medical-histories`
    -    Request Body:
            ```json
                    {
                      "patient_id": 1,
                      "diagnosis": "Diagnosis example",
                      "treatment": "Treatment example",
                      "notes": "Notes example"
                    }
            ```
    -    Authentication: Bearer token
 
-   Update Medical History
    -    Endpoint: `PATCH /medical-histories/{id}`
    -    Request Body:
            ```json
                    {
                      "patient_id": 1,
                      "diagnosis": "Diagnosis example",
                      "treatment": "Treatment example",
                      "notes": "Notes example"
                    }
            ```
    -    Authentication: Bearer token
      
-   Get One Medical History
    -    Endpoint: `GET /medical-histories/{id}`
    -    Authentication: Bearer token

-   Get All Medical Histories
    -    Endpoint: `GET /medical-histories/`
    -    Authentication: Bearer token
    
-  Delete Medical History
    -    Endpoint: `DELETE /medical-histories/{id}`
    -    Authentication: Bearer token

### Medications
-   Create Medication
    -    Endpoint: `POST /medications`
    -    Request Body:
            ```json
                    {
                      "name": "Medication name",
                      "description": "Medication description"
                    }
            ```
    -    Authentication: Bearer token
 
-   Update Medication
    -    Endpoint: `PATCH /medications/{id}`
    -    Request Body:
            ```json
                    {
                      "name": "Medication name",
                      "description": "Medication description"
                    }
            ```
    -    Authentication: Bearer token
      
-   Get One Medication
    -    Endpoint: `GET /medications/{id}`
    -    Authentication: Bearer token

-   Get All Medication
    -    Endpoint: `GET /medications/`
    -    Authentication: Bearer token
    
-  Delete Medication
    -    Endpoint: `DELETE /medications/{id}`
    -    Authentication: Bearer token

### Profile

- Get Profile
  - Endpoint: `GET /profile`
  - Authentication: Bearer token

- Update Profile
  - Endpoint: `PATCH /profile`
  - Request Body:
    ```json
    {
      "name": "Updated name",
      "email": "updatedemail@example.com",
      "phone": "Updated phone number"
    }
    ```
  - Authentication: Bearer token

- Delete Profile
  - Endpoint: `DELETE /profile`
  - Authentication: Bearer token

- Change Password
  - Endpoint: `PATCH /profile/change-password`
  - Request Body:
    ```json
    {
      "current_password": "currentpassword",
      "new_password": "newpassword",
      "new_password_confirmation": "newpassword"
    }
    ```
  - Authentication: Bearer token
