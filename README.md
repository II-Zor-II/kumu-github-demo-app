## KUMU-API-DEMO-APP

### How To Execute Endpoints


1.) Using Postman :
 * New Tab - use URL
 ```angular2html
localhost/api/user
```
2.) Register a user by
 * Choosing [POST] as method
 * Add request parameters : username & password
 ```angular2html
 1. click Body
 2. click Raw (radio button)
 3. choose JSON ( right side option )
Ex: 
{
    "username" : "test",
    "password" : "strong_password"
}
```
 * hit SEND
 
3.) Make sure to save the "access_token" in a text pad. This will server as your authorization grant.

4.) New Tab - use URL
```angular2html
localhost/api/users/github
```
5.) Make sure headers are properly added for api endpoints
  ```angular2html
Accept : application/json
```
if not 
```angular2
1. Go to Headers tab
2. Add new Key :  Accept
3. Add new value :  application/json
```

6.) Add Authorization Bearer Token
```angular2
1. Go to Authorization Tab
2. click Type - Choose Bearer Token
3. Paste on the input box on the right side the access_token you received after registration
 Ex: 1|ODGaIQpp16W8JUi0yMAIPqXD7FmFn0PonhxPxzgU
```

7.) Add request Params
```angular2
1. click Body
2. click Raw (radio button)
3. choose JSON ( right side option)
EX:
{
    "users" : [
        "II-Zor-II",
        "taylorotwell"
    ]
}
```
* hit Send
