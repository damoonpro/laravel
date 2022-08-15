![logo-dark](https://user-images.githubusercontent.com/64106883/184711882-8f607ba0-75b6-48e5-8e76-ecf9e71d5ff7.png)


# Laravel 9 - Damoon

**Description** :books:

- Required specifications


**TODO :** ✍️

<br>


**Routes** :rocket:

| URL | METHOD | REQUEST | DESCRIPTION                                                                               | RESPONSE |
| ----- | ----- | ----- |-------------------------------------------------------------------------------------------| ---- |
| v1/login/SMS | POST | { mobile } | send a code to mobile for authentication<br>you can send only 1 request per 2 minute      | { message, user = { mobile } } |
| v1/login/SMS/verify | POST | { mobile, code } | verify mobile to authentication. <br>you can send 3 request per 2 minute                  |  { message, token = { type, value }} or<br>{ message, login { message, status } } |

<br>

### Admin message configuration : 🧰

**Description :** :books:
1. get every sms configuration that sets.
2. update sms text.
if you want to update sms text you have to put alias in update route.

| URL                                    | METHOD | REQUEST | DESCRIPTION                | RESPONSE                        |
|----------------------------------------|--------| ----- |----------------------------|---------------------------------|
| v1/admin/config/message                | GET    | { ---- } | collect sms configurations | [ { alias, help, text, label }] |
| v1/admin/config/message/{alias}/update | PUT    | { ---- } | update message text        | { message, sms = { label } }    |
