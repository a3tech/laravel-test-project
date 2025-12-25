# Laravel Application Installation

## Installation Steps

1.  Rename the `.env.example` file to `.env`

2.  Run the following command to install dependencies:

    ``` bash
    composer install
    ```

3. Run the migration using:

    ``` bash
    php artisan migrate
    ```

4.  Run the application using:

    ``` bash
    php artisan serve
    ```

5.  API documentation can be found in:

        Test.postman_collection.json

## Notes

-   Make sure PHP and Composer are installed on your machine before
    starting.
-   The default server will run at `http://127.0.0.1:8000`.