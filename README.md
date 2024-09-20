# Takeover - Clothing Website

**Takeover** is a robust e-commerce platform built using **Laravel**. It offers an intuitive shopping experience for users to browse and purchase clothing items. This project is designed with scalability and performance in mind, providing efficient APIs and a seamless interface for both customers and administrators.

## Features

- **Product Management**: Add, edit, and delete products with categories, sizes, colors.
- **Image Gallery**: Upload multiple images per product to showcase different variants.
- **Shopping Cart**: Add, update, and remove items from the shopping cart.
- **Order Management**: View order details, manage status updates, and track user purchases.
- **User Authentication**: Secure login and registration with email verification.
- **Responsive Design**: Fully responsive front-end interface using React.js.

## Tech Stack

- **Backend**: Laravel 10
- **Frontend**: HTML - CSS - JAVASCRIPT - BOOTSTRAP
- **Database**: MySQL
- **Authentication**: Laravel Breeze (support for email and username login)

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/yourusername/takeover-ecommerce.git
    cd takeover-ecommerce
    ```

2. Install dependencies:

    ```bash
    composer install
    npm install
    ```

3. Set up your `.env` file:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure your database in the `.env` file:

    ```bash
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_db_name
    DB_USERNAME=your_db_username
    DB_PASSWORD=your_db_password
    ```

5. Run the migrations and seed the database:

    ```bash
    php artisan migrate --seed
    ```

6. Start the development server:

    ```bash
    php artisan serve
    ```

7. Compile the frontend assets:

    ```bash
    npm run dev
    ```

## Usage

- **Admin Panel**: Access the admin dashboard for managing products, users, and orders.
- **Shop**: Browse products by category, filter by size, color, and other attributes.
- **Checkout**: Add items to the cart, proceed to checkout, and make payments.

## Contributing

At this time, **contributions are not needed**. This project is actively developed and maintained, and no external help is required.
