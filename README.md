# 🏥 Healix-HMS

> **Modern Hospital & Clinic Management System built with Laravel**

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap)
![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)

---

# 📖 About

**Healix-HMS** is a modern, scalable, and modular **Hospital & Clinic Management System** developed with **Laravel 12**.

It is designed to simplify healthcare operations by managing patients, doctors, appointments, prescriptions, pharmacy, laboratory, billing, inventory, staff, and reports from one centralized dashboard.

The project is built with a clean architecture, making it easy to maintain, extend, and transform into a complete **SaaS (Software as a Service)** platform.

---

# 🎯 Goals

- Digitalize hospital operations
- Reduce paperwork
- Improve patient management
- Automate appointments
- Manage pharmacy & laboratory
- Simplify billing
- Generate reports instantly
- Ready for Multi-Hospital SaaS

---

# ✨ Key Features

- Authentication & Authorization
- Dashboard
- Patient Management
- Doctor Management
- Appointment System
- OPD Management
- IPD Management
- Prescription Module
- Pharmacy
- Laboratory
- Billing & Accounts
- Inventory
- Staff Management
- Reports & Analytics
- SMS Notifications
- Email Notifications
- PDF Export
- Excel Export
- Multi Hospital Support
- Multi Branch Support
- Super Admin Panel

---

# 🛠 Tech Stack

| Technology | Version |
|------------|----------|
| Laravel | 12 |
| PHP | 8.3+ |
| MySQL | Latest |
| Bootstrap | 5 |
| Blade | Latest |
| Vite | Latest |
| JavaScript | ES6 |
| Laravel Queue | ✓ |
| Laravel Scheduler | ✓ |
| Spatie Permission | ✓ |
| DomPDF | ✓ |
| Laravel Excel | ✓ |

---

# 📂 Project Structure

```
Healix-HMS
│
├── app
├── bootstrap
├── config
├── database
├── public
├── resources
├── routes
├── storage
├── tests
└── vendor
```

---

# 🚀 Installation

Clone the repository

```bash
git clone https://github.com/yourusername/healix-hms.git
```

Go to project

```bash
cd healix-hms
```

Install dependencies

```bash
composer install
```

Install frontend packages

```bash
npm install
```

Create environment file

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Configure your database in `.env`

```env
DB_DATABASE=healix
DB_USERNAME=root
DB_PASSWORD=
```

Run migrations

```bash
php artisan migrate
```

Seed database

```bash
php artisan db:seed
```

Run development server

```bash
php artisan serve
```

Compile assets

```bash
npm run dev
```

---

# 🔐 Authentication

## Features

- Login
- Logout
- Forgot Password
- Reset Password
- Email Verification
- Profile Management
- Change Password
- Remember Me
- Session Management

---

# 👥 Patient Management

Patient Management is the heart of Healix-HMS.

Every patient's complete medical journey is stored in one centralized profile.

---

## Patient Registration

- Register New Patient
- Auto Generated Unique Patient ID
- Patient QR Code
- Profile Photo
- National ID
- Passport Number
- Birth Certificate Number
- Full Name
- Date of Birth
- Gender
- Blood Group
- Marital Status
- Occupation
- Religion
- Nationality
- Phone Number
- Email
- Address
- Emergency Contact
- Guardian Information

---

## Patient Profile

Each patient profile contains:

### Personal Information

- Patient ID
- Full Name
- Age
- Gender
- Blood Group
- Address
- Phone
- Email
- Emergency Contact

---

### Medical Information

- Allergies
- Chronic Diseases
- Previous Diseases
- Family Medical History
- Smoking Status
- Alcohol Status
- Weight
- Height
- BMI
- Current Medications

---

## Patient Timeline

A complete medical timeline including

- Registration
- Appointments
- Doctor Visits
- Prescriptions
- Lab Tests
- Reports
- Admissions
- Billing
- Follow-ups

Example

```
12 Jan 2026
Patient Registered

15 Jan 2026
Appointment with Dr. Ahmed

15 Jan 2026
Prescription Added

16 Jan 2026
CBC Test

16 Jan 2026
Lab Report Uploaded

25 Jan 2026
Follow-up Visit
```

---

## Previous Visits

- Visit Date
- Doctor
- Department
- Symptoms
- Diagnosis
- Treatment
- Follow-up

---

## Appointment History

- Upcoming Appointments
- Previous Appointments
- Cancelled Appointments
- Missed Appointments

---

## Prescriptions

Patient can view all previous prescriptions.

Each prescription contains

- Doctor
- Medicines
- Dosage
- Duration
- Instructions
- Follow-up Date

---

## Laboratory Reports

Patient profile stores

- CBC
- Blood Test
- Urine Test
- X-Ray
- ECG
- MRI
- CT Scan
- Ultrasound
- PDF Reports

---

## Medical Documents

- Prescription PDF
- Laboratory Reports
- Radiology Reports
- Medical Certificate
- Vaccination Record
- Insurance Documents

---

## Billing History

- Consultation Bills
- Pharmacy Bills
- Laboratory Bills
- Admission Bills
- Payment History
- Due Amount
- Invoice Download

---

## Search Patient

Search by

- Patient ID
- Name
- Mobile Number
- National ID
- Passport
- Blood Group

---

## Patient Portal

Patients can

- View Profile
- View Appointments
- Download Prescriptions
- Download Reports
- View Bills
- Payment History
- Update Personal Information

---

## Patient Statistics

Dashboard includes

- Total Patients
- Active Patients
- New Patients
- Today's Registration
- Male Patients
- Female Patients
- Child Patients
- Senior Citizens

---

# 🔜 Next Module

- 👨‍⚕️ Doctor Management
- 📅 Appointment Management
- 🩺 OPD
- 🏥 IPD
- 💊 Prescription System
---

# 👨‍⚕️ Doctor Management

The Doctor Management module enables administrators to manage doctors, their departments, schedules, consultation fees, availability, and patient history.

---

## Doctor Registration

- Register New Doctor
- Employee ID
- Doctor ID (Auto Generated)
- Profile Photo
- Full Name
- Gender
- Date of Birth
- Blood Group
- Phone Number
- Email Address
- National ID
- Medical License Number
- Qualification
- Experience
- Specialization
- Department
- Joining Date
- Consultation Fee
- Visiting Fee
- Address
- Emergency Contact
- Status (Active / Inactive)

---

## Doctor Profile

Each doctor profile includes

- Personal Information
- Qualifications
- Specialization
- Experience
- Department
- Weekly Schedule
- Consultation Fee
- Assigned Patients
- Appointment Statistics
- Revenue Statistics
- Performance Overview

---

## Doctor Schedule

- Daily Schedule
- Weekly Schedule
- Visiting Hours
- Break Time
- Holidays
- Leave Management
- Emergency Availability

---

## Doctor Availability

- Available
- Busy
- On Leave
- Emergency Duty

---

## Doctor Dashboard

- Today's Appointments
- Upcoming Appointments
- Today's Patients
- Completed Consultations
- Pending Consultations
- Revenue Summary
- Follow-up Patients
- Recent Prescriptions

---

## Doctor Search

Search by

- Doctor ID
- Name
- Department
- Specialization
- Phone Number

---

# 🏢 Department Management

- Create Department
- Edit Department
- Delete Department
- Department Head
- Doctor Assignment
- Department Statistics

Examples

- Medicine
- Cardiology
- Neurology
- Orthopedics
- Pediatrics
- Gynecology
- Dermatology
- ENT
- Ophthalmology
- Dental
- Surgery
- Urology

---

# 📅 Appointment Management

The Appointment module manages all patient appointments and doctor schedules.

---

## Appointment Booking

- Online Appointment
- Walk-in Appointment
- Emergency Appointment
- Follow-up Appointment

---

## Appointment Information

- Appointment Number
- Patient
- Doctor
- Department
- Date
- Time
- Consultation Type
- Status
- Notes

---

## Appointment Status

- Pending
- Confirmed
- Checked In
- In Progress
- Completed
- Cancelled
- No Show

---

## Queue Management

- Queue Token
- Queue Number
- Live Queue
- Estimated Waiting Time
- Current Serving Token

---

## Appointment Calendar

- Daily View
- Weekly View
- Monthly View
- Doctor Schedule Calendar

---

## Appointment Reminder

Automatic Notifications

- SMS Reminder
- Email Reminder

---

## Appointment Search

Search by

- Patient
- Doctor
- Date
- Department
- Status

---

# 🩺 OPD Management

OPD (Outdoor Patient Department) manages patients who visit without hospital admission.

---

## OPD Registration

- Register OPD Visit
- Select Patient
- Select Doctor
- Department
- Visit Date
- Token Number

---

## Consultation

Doctor can record

- Chief Complaint
- Symptoms
- Medical History
- Physical Examination
- Diagnosis
- Treatment Plan

---

## Vital Signs

- Blood Pressure
- Pulse Rate
- Temperature
- Oxygen Saturation
- Weight
- Height
- BMI

---

## Diagnosis

- Disease Name
- ICD Code (Future)
- Severity
- Notes

---

## Doctor Notes

- Observation
- Advice
- Lifestyle Recommendation
- Follow-up Date

---

## OPD History

Patient profile automatically stores

- Visit History
- Diagnosis
- Prescriptions
- Reports
- Follow-up

---

# 🏥 IPD Management

IPD manages admitted patients.

---

## Patient Admission

- Admit Patient
- Admission Number
- Admission Date
- Assigned Doctor
- Assigned Nurse
- Ward
- Cabin
- Bed

---

## Admission Details

- Admission Reason
- Initial Diagnosis
- Medical History
- Allergies
- Emergency Contact

---

## Daily Monitoring

- Daily Notes
- Nurse Observation
- Doctor Rounds
- Vital Signs
- Progress Notes

---

## Bed Transfer

- Transfer Bed
- Transfer Ward
- Transfer Cabin

---

## Discharge

- Discharge Date
- Final Diagnosis
- Treatment Summary
- Medicines
- Follow-up
- Discharge Certificate

---

## IPD Billing

Automatically calculate

- Bed Charge
- Doctor Visit Charge
- Nursing Charge
- Medicine Charge
- Laboratory Charge
- Procedure Charge

---

# 💊 Prescription Management

The Prescription Module allows doctors to create digital prescriptions.

---

## Create Prescription

- Select Patient
- Select Doctor
- Diagnosis
- Medicines
- Dosage
- Frequency
- Duration
- Advice
- Follow-up Date

---

## Medicine Information

For every medicine

- Medicine Name
- Strength
- Route
- Frequency
- Duration
- Quantity

Example

- Paracetamol 500mg
- 1 Tablet
- Three Times Daily
- 5 Days

---

## Prescription Notes

Doctor can write

- Diet Advice
- Lifestyle Advice
- Exercise Recommendation
- Additional Notes

---

## Printable Prescription

Generate

- A4 PDF
- Hospital Header
- Doctor Signature
- QR Verification
- Patient Information

---

## Prescription History

View all previous prescriptions

Filter by

- Doctor
- Date
- Department

---

## Prescription Templates

Doctors can save templates for common diseases

Examples

- Fever
- Cold
- Diabetes
- Hypertension
- Gastric
- Asthma

---

## Prescription Search

Search by

- Prescription Number
- Patient
- Doctor
- Date

---

# 📈 Doctor Analytics

Dashboard includes

- Total Doctors
- Active Doctors
- Today's Consultations
- Monthly Consultations
- Top Performing Doctors
- Revenue by Doctor
- Average Consultation Time

---

# 🔜 Next Module

- 💉 Pharmacy
- 🧪 Laboratory
- 💰 Billing & Accounts
- 📦 Inventory
- 👩‍⚕️ Nurse Management
- 👨‍💼 Staff Management
- 📊 Reports & Analytics
---

# 💉 Pharmacy Management

The Pharmacy Management module enables hospitals and clinics to efficiently manage medicine inventory, purchases, suppliers, sales, stock, and prescriptions.

---

## Medicine Management

- Add New Medicine
- Edit Medicine
- Delete Medicine
- Medicine Categories
- Generic Name
- Brand Name
- Manufacturer
- Medicine Type
- Strength
- Unit
- Purchase Price
- Selling Price
- VAT
- Barcode / QR Code
- Batch Number
- Expiry Date
- Storage Location
- Status (Active / Inactive)

---

## Medicine Categories

- Tablet
- Capsule
- Syrup
- Injection
- Ointment
- Cream
- Drops
- Inhaler
- Saline
- Vaccine

---

## Purchase Management

- Purchase Order
- Supplier Selection
- Batch Number
- Purchase Date
- Invoice Number
- Quantity
- Purchase Price
- Discount
- Tax
- Total Amount

---

## Supplier Management

- Supplier Registration
- Company Name
- Contact Person
- Mobile Number
- Email Address
- Address
- Trade License
- Purchase History
- Due Payments

---

## Inventory Control

- Current Stock
- Available Stock
- Reserved Stock
- Stock Adjustment
- Stock Transfer
- Batch Tracking
- Stock History

---

## Stock Alerts

Automatic Alerts

- Low Stock
- Out of Stock
- Expired Medicine
- Near Expiry Medicine

---

## Pharmacy Sales

- Medicine Sales
- POS Billing
- Prescription Sales
- Non-Prescription Sales
- Discount
- Tax
- Invoice Printing

---

## Pharmacy Reports

- Daily Sales
- Monthly Sales
- Medicine Stock Report
- Expired Medicine Report
- Supplier Report
- Purchase Report
- Profit Report

---

# 🧪 Laboratory Management

Manage laboratory tests, sample collection, report generation, and patient diagnostics.

---

## Test Categories

- Blood Test
- CBC
- Urine Test
- Stool Test
- Lipid Profile
- Liver Function Test
- Kidney Function Test
- Blood Sugar
- ECG
- X-Ray
- MRI
- CT Scan
- Ultrasound
- Covid Test

---

## Laboratory Services

- Create Lab Test
- Assign Patient
- Assign Technician
- Sample Collection
- Test Processing
- Test Completion
- Report Upload

---

## Laboratory Report

Each report includes

- Patient Information
- Test Name
- Sample Date
- Report Date
- Test Result
- Reference Range
- Doctor Remarks
- Technician Signature

---

## Laboratory Status

- Pending
- Sample Collected
- Processing
- Completed
- Delivered

---

## Laboratory Reports

Generate

- PDF Report
- Print Report
- Download Report

---

## Laboratory Dashboard

- Pending Tests
- Completed Tests
- Today's Samples
- Today's Reports
- Monthly Statistics

---

# 💰 Billing & Accounts

Complete hospital financial management system.

---

## Billing Modules

- Consultation Billing
- Admission Billing
- Pharmacy Billing
- Laboratory Billing
- Procedure Billing
- Service Billing

---

## Invoice

Invoice contains

- Invoice Number
- Patient Information
- Services
- Medicines
- Tests
- Taxes
- Discount
- Grand Total

---

## Payment Methods

- Cash
- Card
- Mobile Banking
- Bank Transfer

---

## Payment Status

- Paid
- Partial
- Due
- Refunded

---

## Financial Reports

- Daily Revenue
- Monthly Revenue
- Annual Revenue
- Outstanding Due
- Cash Collection
- Payment History

---

# 🛏 Bed & Ward Management

---

## Ward Management

- Create Ward
- Edit Ward
- Delete Ward
- Ward Capacity

---

## Bed Management

- Bed Number
- Ward
- Cabin
- Floor
- Bed Type
- Availability
- Occupied
- Reserved
- Cleaning

---

## Cabin Management

- General Ward
- Semi Private
- Private Cabin
- VIP Cabin
- ICU
- CCU

---

# 👩‍⚕️ Nurse Management

---

## Nurse Registration

- Employee ID
- Name
- Qualification
- Experience
- Department
- Shift
- Contact Information

---

## Nurse Activities

- Assigned Patients
- Medicine Administration
- Daily Observation
- Vital Signs
- Nursing Notes
- Shift Report

---

## Shift Management

- Morning Shift
- Evening Shift
- Night Shift

---

# 👨‍💼 Staff Management

Manage all hospital employees.

---

## Staff Types

- Receptionist
- Accountant
- Nurse
- Doctor
- Pharmacist
- Lab Technician
- Cashier
- Cleaner
- Administrator

---

## Employee Management

- Employee ID
- Department
- Designation
- Joining Date
- Salary
- Attendance
- Leave
- Performance

---

## Attendance

- Check In
- Check Out
- Working Hours
- Late Entry
- Overtime

---

# 📦 Inventory Management

Track all hospital assets and consumables.

---

## Inventory Categories

- Medical Equipment
- Surgical Equipment
- Office Equipment
- Furniture
- Consumables
- Stationery

---

## Asset Information

- Asset Name
- Asset Code
- Category
- Purchase Date
- Warranty
- Supplier
- Condition
- Location

---

## Inventory Features

- Asset Tracking
- Purchase Orders
- Stock In
- Stock Out
- Damage Records
- Maintenance Schedule
- Vendor Management

---

# 📊 Reports & Analytics

Generate comprehensive reports.

---

## Patient Reports

- Patient Registration Report
- Visit Report
- OPD Report
- IPD Report
- Follow-up Report

---

## Doctor Reports

- Consultation Report
- Appointment Report
- Revenue Report
- Performance Report

---

## Pharmacy Reports

- Sales Report
- Purchase Report
- Stock Report
- Expiry Report

---

## Laboratory Reports

- Test Report
- Technician Report
- Daily Test Report
- Monthly Test Report

---

## Financial Reports

- Income Report
- Expense Report
- Profit Report
- Tax Report

---

## Inventory Reports

- Asset Report
- Purchase Report
- Damage Report
- Stock Report

---

## Dashboard Analytics

- Total Patients
- Active Doctors
- Today's Appointments
- Today's Revenue
- Available Beds
- Low Stock Medicines
- Pending Laboratory Tests
- Monthly Growth
- Revenue Chart
- Patient Statistics
- Department Performance

---

# 🔔 Notification System

Automatic Notifications

- Appointment Confirmation
- Appointment Reminder
- Follow-up Reminder
- Prescription Ready
- Laboratory Report Ready
- Payment Confirmation
- Due Reminder

Supported Channels

- SMS
- Email

---

# 🔜 Next Module

- 🚀 SaaS Features
- 👑 Super Admin
- ⚙️ System Settings
- 🔐 Security
- 📤 Export
- 🛠 Tech Stack
- 📁 Folder Structure
- 🗺 Roadmap
- 🤝 Contributing
- 📄 License

---

# 🚀 SaaS Features

Healix-HMS is designed with a **Multi-Tenant SaaS Architecture**, allowing multiple hospitals and clinics to operate independently from a single application.

---

## 🏥 Multi Hospital Support

- Register Unlimited Hospitals
- Separate Hospital Database (Future Support)
- Independent Hospital Dashboard
- Individual Branding
- Hospital-wise Reports
- Hospital Status (Active / Suspended)

---

## 🏢 Multi Branch Management

Each hospital can have multiple branches.

### Features

- Branch Registration
- Branch Dashboard
- Branch-wise Doctors
- Branch-wise Staff
- Branch-wise Inventory
- Branch-wise Pharmacy
- Branch-wise Laboratory
- Branch-wise Reports

---

# 👑 Super Admin Panel

The Super Admin controls the entire SaaS platform.

---

## Dashboard

- Total Hospitals
- Total Branches
- Total Doctors
- Total Patients
- Active Users
- Monthly Revenue
- Active Subscriptions
- Expired Plans

---

## Hospital Management

- Register Hospital
- Approve Hospital
- Suspend Hospital
- Delete Hospital
- View Hospital Statistics
- Login as Hospital Admin

---

## Subscription Management

### Plans

- Free Trial
- Starter
- Professional
- Enterprise

### Billing Cycle

- Monthly
- Quarterly
- Yearly

---

## Feature Toggle

Enable or Disable Modules

- Patient
- Doctor
- Appointment
- OPD
- IPD
- Pharmacy
- Laboratory
- Billing
- Inventory
- Reports
- SMS
- Email

---

## White Label

Hospitals can customize

- Logo
- Hospital Name
- Address
- Contact Information
- Theme Color
- Invoice Header
- Prescription Header

---

## SaaS Settings

- Trial Period
- Maximum Users
- Maximum Doctors
- Maximum Patients
- Maximum Branches
- Storage Limit

---

# ⚙️ System Settings

Hospital Admin can configure

- Hospital Information
- Logo
- Currency
- Timezone
- Language
- Date Format
- Invoice Prefix
- Prescription Prefix
- Patient ID Prefix
- SMTP Configuration
- SMS Gateway Configuration

---

# 🔐 Roles & Permissions

## Default Roles

- Super Admin
- Hospital Admin
- Doctor
- Receptionist
- Nurse
- Pharmacist
- Lab Technician
- Accountant
- Patient

---

## Permission Examples

- Create Patient
- Edit Patient
- Delete Patient
- Create Appointment
- View Reports
- Manage Billing
- Manage Inventory
- Manage Staff
- Manage Settings

---

# 🔒 Security

- Laravel Authentication
- CSRF Protection
- XSS Protection
- SQL Injection Protection
- Password Hashing
- Role Based Access Control
- Permission Middleware
- Audit Logs
- Activity Logs
- Login History
- Session Management

---

# 📩 Notification System

Supported Channels

- SMS
- Email

Notification Types

- Appointment Confirmation
- Appointment Reminder
- Follow-up Reminder
- Bill Payment Confirmation
- Lab Report Ready
- Prescription Ready

---

# 📄 Export & Printing

Export

- PDF
- Excel
- CSV

Printable Documents

- Prescription
- Invoice
- Lab Report
- Patient Card
- Medical Certificate

---

# 📊 Dashboard Widgets

- Today's Patients
- Today's Appointments
- Today's Revenue
- Monthly Revenue
- Active Doctors
- Available Beds
- Low Stock Medicines
- Pending Lab Reports
- Recent Activities

---

# 📁 Suggested Folder Structure

```
app
├── Console
├── Events
├── Exceptions
├── Helpers
├── Http
│   ├── Controllers
│   ├── Middleware
│   └── Requests
├── Models
├── Notifications
├── Policies
├── Providers
├── Services
└── Traits
```

---

# 🗺 Development Roadmap

## Phase 1

- Authentication
- Dashboard
- Patient Module
- Doctor Module
- Appointment Module

---

## Phase 2

- OPD
- Prescription
- Pharmacy
- Laboratory
- Billing

---

## Phase 3

- Inventory
- Staff Management
- Reports
- Notifications
- PDF & Excel Export

---

## Phase 4

- Multi Hospital
- Multi Branch
- Subscription System
- Super Admin
- SaaS Features

---

## Phase 5

- Mobile App
- REST API
- Telemedicine
- AI Integration
- WhatsApp Notification

---

# 📱 Future Roadmap

- Android App
- iOS App
- Patient Portal
- Doctor Portal
- QR Patient Card
- QR Prescription Verification
- AI Prescription Assistant
- AI Medical Report Summary
- Voice Notes
- Online Video Consultation

---

# 🛠 Tech Stack

## Backend

- Laravel 12
- PHP 8.3+

## Frontend

- Blade
- Bootstrap 5
- JavaScript
- Vite

## Database

- MySQL

## Packages

- Spatie Laravel Permission
- Laravel Excel
- DomPDF
- Laravel Scheduler
- Laravel Queue

---

# 📌 Upcoming Integrations

- SSLCommerz
- bKash
- Nagad
- Stripe
- Twilio
- WhatsApp API
- Google Calendar
- Google Meet
- Zoom

---

# 🤝 Contributing

Contributions are welcome!

1. Fork the repository
2. Create your feature branch

```bash
git checkout -b feature/new-feature
```

3. Commit your changes

```bash
git commit -m "Add new feature"
```

4. Push to your branch

```bash
git push origin feature/new-feature
```

5. Open a Pull Request

---

# 🐞 Issues

If you find any bug or have any feature request, please open an issue.

---

# ⭐ Support

If you like this project, please consider giving it a ⭐ on GitHub.

---

# 📜 License

This project is licensed under the **MIT License**.

---

# 👨‍💻 Author

**Polok**

Full Stack Laravel Developer

---

# ❤️ Healix-HMS

> **Modern Healthcare Management System for Hospitals & Clinics**

Built with ❤️ using Laravel.

---

## 📌 Project Status

> 🚧 **Currently Under Active Development**

This project is continuously evolving with the goal of becoming a complete, enterprise-grade Hospital & Clinic Management SaaS platform.