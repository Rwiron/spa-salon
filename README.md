
# Salon and Spa Booking System

## Introduction
Welcome to the **Salon and Spa Booking System**, a Laravel-based web application designed to streamline the process of booking services at a salon or spa. This application provides an elegant and intuitive interface for customers to explore services, view specialties, and make bookings effortlessly.

## Features
- **Customer-Focused Booking**:  
  Customers can browse available services and book appointments with ease.
- **Service Specialties**:  
  View detailed information about the specialties offered, such as spa treatments, hair styling, and more.
- **Admin Dashboard**:  
  Manage the services, bookings, and customer information seamlessly.
- **Dynamic Pricing**:  
  Flexible pricing for different services and specialties, allowing transparency for customers.
- **Appointment Management**:  
  Automated tracking and updates for customer bookings.
- **User Authentication**:  
  Secure login and account management for both customers and admin staff.

## Technology Stack
- **Frontend**: Blade Templating, Tailwind CSS
- **Backend**: Laravel Framework
- **Database**: MySQL
- **Additional Tools**: Composer, Artisan, Postman (API testing)

## Installation

### Prerequisites
1. PHP >= 8.0
2. Composer
3. MySQL
4. Laravel >= 10.x

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/Rwiron/spa-salon/.git
   ```
2. Navigate to the project directory:
   ```bash
   cd salon-and-spa
   ```
3. Install dependencies:
   ```bash
   composer install
   ```
4. Configure the environment:
   - Copy the `.env.example` file and rename it to `.env`.
   - Update the `.env` file with your database credentials and other configurations.

5. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed
   ```
6. Serve the application:
   ```bash
   php artisan serve
   ```

## Usage
- Visit the application URL (`http://localhost:8000` by default) to explore services and make bookings.
- Access the admin dashboard at `/admin`.

## Contributing
We welcome contributions to enhance the features and functionality of this project. Please fork the repository and submit a pull request.

## License
This project is licensed under the MIT License.

---
**Author**: Wiron R  
**Date**: October 11, 2024
