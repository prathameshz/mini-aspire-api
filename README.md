## Mini Aspire Api - Laravel Project

Project is about to create basc API's for loan management

The task are mentioned below:

 - Build API's which allows users to register and login.
 - Build API's which allows users to create loan and show loan.
 - Build API's which allows users to create repayments.

## Installation Instructions

- Run `composer install`
- Run `php artisan aspire:api`

## API Documentation

- Postman Collection [ https://documenter.getpostman.com/view/3987935/UVe9SA4y]

## New Pages created
- mini-aspire-api\app\Http\Controllers\Api\LoansController.php
- mini-aspire-api\app\Http\Controllers\Api\RepaymentsController.php
- mini-aspire-api\app\Http\Controllers\Auth\RegisterController.php
- mini-aspire-api\app\Http\Controllers\Auth\LoginController.php
- mini-aspire-api\app\Http\Resources\Loan.php
- mini-aspire-api\app\Http\Resources\Repayment.php
- mini-aspire-api\app\Models\Loan.php
- mini-aspire-api\app\Models\Repayment.php

## Pages Modified
- mini-aspire-api\app\Http\Middleware\Authenticate.php
- mini-aspire-api\routes\api.php
- mini-aspire-api\config\database.php
- mini-aspire-api\.env

## TODO
