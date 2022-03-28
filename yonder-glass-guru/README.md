

## LARAVEL REST API using PASSPORT to implement oAuth 2.0

This project implement creates a Laravel REST API using Passport to implement OAauth 2.0. It reads a QR code from an image posted to an endpoint in order to extract information and use it to get a quotation for a replacement widscreen.

Once you clone the project , run **composer install** inside the project directory **yonder-glass-guru**  to install all dependencies
 1. Create a mysql database
 2. configure the **.env** fire with the correct database in order to connect to the database
 3. run  **php artisan migrate** to create the database structure
4. run  **php artisan db:seed --class=FitmentCentresTableSeeder** a few times to create create some fitment centres records for testing

 5. run **php artisan passport:install**  to generate encryption keys for creating secure access tokens
 6. Create a new testing user by posting [**POST**] the following parameters  **[name , email , password]** to the **http://localhost:8000/api/signup**  endpoint
 7. Signin by posting [**POST**] the following parameters  **[email , password]** to the **http://localhost:8000/api/signin**  endpoint. Once you successfully login , a token will be generated for use in all subsequent api requests.
 8. The next operation is to post [**POST**] the image parameter   **[licence_qr]** to the **http://localhost:8000/api/quotation/request**  endpoint. Make sure under Authorization you select OAuth 2.0 and paste the Access Token returned on successful login. You sould get a result similar to the following . 
 ```
{
    "success": true,
    "reference": "62412ae189ed5",
    "fitment_cost": 794,
    "data": [
        "GMTTEAFM8DA033285",
        "AUDI",
        "A3",
        "2003",
        "DG44PLGP",
        "20220301",
        "20230301"
    ]
}
```
 9. The next operation is to post [**POST**] the image parameter   **[licence_qr]** to the **http://localhost:8000/api/quotation/request**  endpoint. Make sure under Authorization you select OAuth 2.0 and paste the Access Token returned on successful login. You sould get a result similar to the following . 
 ```
{
    "success": true,
    "data": {
        "reference": "62412ae189ed5",
        "vin": "GMTTEAFM8DA033285",
        "make": "AUDI",
        "manufacturer": "A3",
        "year": "2003",
        "registration": "DG44PLGP",
        "issue_date": "2022-03-01",
        "expires_date": "2023-03-01",
        "fitment_cost": "889",
        "fitment_centre_id": "3",
        "first_name": "John",
        "last_name": "Doe",
        "email": "info@*********.com",
        "mobile": "*************",
        "accepted": "1",
        "updated_at": "2022-03-28T02:42:12.000000Z",
        "created_at": "2022-03-28T02:42:12.000000Z",
        "id": 6
    }
}
```
