API ROUTES FOR MOBILE USERS INVENTORY APP

- GET /api/users (offset and limit are optional query params)
- GET /api/users/{user_name}/by_user_name
- GET /api/users/{email}/by_email
- GET /api/users/{mobile_number}/by_mobile_number
- POST /api/users
body { "user_name": "name", "mobile_number": "xxxxxxxxxx", "email": "xxx@xxxxx" }
- DELETE /api/users/{user_name}/delete_by_user_name
- DELETE /api/users/{mobile_number}/delete_by_mobile_number
- DELETE /api/users/{email}/delete_by_email
