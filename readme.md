# Setup
```
composer install
php artisan migrate
php artisan storage:link
```

For the simplicity of creating a user, I'm using laravel's default Auth module.

```
php artisan serve
```
go to http://localhost:8000/register and create a user account

# Generating Password Grant Tokens:
```
php artisan passport:client --password
```

> Note the client ID and secret and make the below endpoint to get the access token

```
GET http://localhost:8000/oauth/token
{
    {
        "grant_type": "password",
        "client_id": "6",
        "client_secret" : "tvbY62smjPXR8dgFlJb4vAUZbx937UItAIx4It0f",
        "username": "raj@gmail.com",
        "password": "rajkumar",
        "scope" :"*"
    }
}
```
Note the access token which will be used to authenticate a protected route such as:

```
GET http://localhost:8000/api/view/1
pass these in headers:
{
    "Content-Type": "application/json",
    "Accept","value":"application/json",
    "Authorization": "Bearer access_token"
}
```


# API Endpoints (Protected routes)
```
POST http://localhost:8000/api/add  ## create a new product
PUT http://localhost:8000/api/update/{id}  ## update existing product
DELETE http://localhost:8000/api/delete/{id}  ## delete the product
GET http://localhost:8000/api/view/{id}  ## view details of a product
GET http://localhost:8000/api/all  ## view all product
```

# API Endpoints (unprotected routes)
### To make this easier to upload images quicky, these APIs don't require access token

```
POST http://localhost:8000//api/image/add  ## create a new Image
PUT http://localhost:8000/api/image/update/{id}  ## update existing Image
DELETE http://localhost:8000/api/image/delete/{id}  ## delete the Image
```


> Images added with above API will be included in products API and all images will return with below endpoints:
```
GET http://localhost:8000/api/view/{id}  ## view details of a product
GET http://localhost:8000/api/all  ## view all product
```
