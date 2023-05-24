Product Management System
=========================

This is a simple Product Management System that was developed as part of a task for Scandiweb recruitment. It allows you to add and manage products with different types, such as DVDs, books, and furniture. The system provides a user-friendly interface for adding and viewing products, and it includes server-side validation to prevent duplicate SKUs.

Main Features
-------------

*   Add new products with different types: DVD, Book, and Furniture.
*   Specify specific attributes based on the selected product type.
*   Validate the SKU to prevent duplicates.
*   User-friendly interface for easy product management.
*   Responsive design for optimal viewing on different devices.

Processes Used
--------------

*   **Object-Oriented Programming**: The project follows an object-oriented approach to structure the code and implement different product types as classes.
*   **Server-side Validation**: The system performs server-side validation to check if the SKU already exists before adding a new product. This prevents duplicate SKUs and provides a smooth user experience.
*   **Bootstrap Framework**: The user interface is designed using the Bootstrap framework, which provides a responsive layout and pre-styled components for a modern and visually appealing interface.
*   **Client-side Formatting**: The SKU input field is formatted using JavaScript to accept only uppercase characters and display the input in the XXX-XXX-XXX format for better readability.

Getting Started
---------------

Thank you for choosing this project developed as part of a Task for Scandiweb! This project allows you to manage and store product information in a database. To get started, follow the steps below:

1.  **Clone the repository:** Begin by cloning this repository to your local machine using the following command:
    
    ```
    git clone https://KaiqueGovani@bitbucket.org/kaiquegovani/scandiwebtask.git
    ```
    
2.  **Configure the database connection:** Open the `config.php` file located in the `php` directory. In this file, you'll find the database connection configurations. Make sure to update the values according to your own database setup. Specify the correct hostname, database name, username, and password.
    
    ```
    // Database configuration 
    define('DB_HOST', 'localhost');
    define('DB_USER', 'your-username');
    define('DB_PASS', 'your-password');
    define('DB_NAME', 'your-database-name');
    ```
    
3.  **Import the database:** Next, import the provided SQL file (`database.sql`) into your database management system. This file contains the necessary tables and structure for the product management system.
    
4.  **Run the application:** Start a local development server (e.g., using XAMPP, WAMP, or MAMP) or configure your server to run the project. Make sure the server is set up to serve the project from the root directory or a designated virtual host.
    
5.  **Access the application:** Once the server is running, open a web browser and navigate to the URL where the project is hosted. You should see the main page, where you can add, edit, and delete products.
    
6.  **Manage products:** Use the provided user interface to add new products, edit existing ones, and delete products. The form fields are dynamically generated based on the selected product type (DVD, Book, or Furniture), ensuring the relevant attributes are captured.
    

_Please_, note that this project assumes you have PHP and a compatible web server environment set up. Make sure to meet the minimum requirements and have the necessary dependencies installed.

License
-------

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT). Feel free to use and modify it according to your needs.

Contributing
------------

Contributions are welcome! If you have any suggestions, bug fixes, or feature enhancements, please submit a pull request or open an issue.

Contact
-------

If you have any questions, please feel free to contact me at [kaique.govani@hotmail.com](mailto:kaique.govani@hotmail.com).



___
<sup>Note: This README file was written with the assistance of an AI language model. While efforts have been made to ensure the accuracy and clarity of the information provided, please review and modify the content as necessary to fit your specific project requirements and circumstances.</sup>


