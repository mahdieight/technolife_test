## TechnoPay Challenge

This is a test project for the technical assessment of the company TechnoLife. In this project, I have endeavored to complete the test project of this company with my own knowledge.

## API Endpoint for Orders
To access the list of orders, use the following API endpoint:

`http://{base_url}:{app_port}/api/backoffice/orders`



## Filtering Options
You can filter orders using the following parameters:
- `status`
- `amount[min,max]`
- `mobile_number`
- `national_code`

## Example of Filtering
Here is an example of filtering orders with all parameters:

`http://{base_url}:{app_port}/api/backoffice/orders?status=doing&national_code=0015481069&amount[min]=100&amount[max]=900000&mobile_number=09122760658`

## Quick Start
To avoid entering data manually, we have prepared factories and seeders for you. You can populate the users and orders tables using the following command.

`php artisan db:seed`

## Powered by Docker
Don't get caught up in details :) To launch the project quickly, you can use the docker-compose file provided in this project to bring the application up as fast as possible and view the output.
