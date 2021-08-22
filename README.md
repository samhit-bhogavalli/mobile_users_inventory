API ROUTES FOR MOBILE USERS INVENTORY APP

- GET /api/users (offset and limit are optional query params, additional filters can also be given like user_name, email and Mobile_number in query parameters)
- POST /api/users
body { "user_name": "name", "mobile_number": "xxxxxxxxxx", "email": "xxx@xxxxx" }
- DELETE /api/users/delete (give conditions in query parameters)

