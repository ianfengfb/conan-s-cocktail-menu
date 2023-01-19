# Conan's cocktail menu app

An app for my friend Conan who is quiet into making cocktails. Currently running published @ https://phplaravel-608300-3175778.cloudwaysapps.com/

![Alt text](/public/images/screenshot.png "Conan's workshop")

## Usage

### Accounts

Only the main account could accept orders, manage the cocktail menu, see all the orders and all the customers.

All new registered accounts could only place new orders and see their own orders.

To set up main account, go to UserController.php and replace main@mail.com email address.

### Notifications

Using Pusher to push real time notifications when order is placed or order status is changed.

Make sure you config .env file (BROADCAST_DRIVER=pusher, PUSHER_APP_ID,KEY,SECRET and CLUSTER to your Pusher account information).

### Database Setup
This app uses MySQL. To use something different, open up config/Database.php and change the default driver.

To use MySQL, make sure you install it, setup a database and then add your db credentials(database, username and password) to the .env.example file and rename it to .env

### Migrations
To create all the nessesary tables and columns, run the following
```
php artisan migrate
```

### Seeding The Database
To add the dummy listings with a single user, run the following
```
php artisan db:seed
```

### File Uploading
When uploading listing files, they go to "storage/app/public". Create a symlink with the following command to make them publicly accessible.
```
php artisan storage:link
```

### Running Then App
Upload the files to your document root, Valet folder or run 
```
php artisan serve
```
