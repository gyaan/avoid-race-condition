## About Project

Now days we have application where we need to focus on concurrency, scalability and avoid assigning same resource to the multiple request.

Take an example of selling phones for a certain duration and there are many users are trying to buy the phones, it’s definitely possible that many buying request will be concurrent and same phone can be sold to multiple users.

To avoid above problem we need to lock a specific phone for a specific request. To do so we can use MySQL Pessimistic locking using Laravel lockForUpdate function. It will avoid to select the row for the other request and will be locked till the mysql transaction completes.

Even same thing can be used when we have multiple workers and we trying to do similar thing and there is possibility that same resource can be select by different different workers.


## installation of project

It's a laravel project and just below mentioned artisan command will do the stuff.

clone the repository, create .env file, specify the database details in the env file and run below commands.

- php artisan migrate:fresh
- php artisan db:seed
- php artisan serve

## demonstrate the concurrency handling using below rest api end points

<app_url>/user/{user_id}/buy/phone


