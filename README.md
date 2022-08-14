**Description** :books:

- Required specifications


**TODO :** ✍️

<br>


**Routes** :rocket:

| URL | METHOD | REQUEST | DESCRIPTION                                                                               | RESPONSE |
| ----- | ----- | ----- |-------------------------------------------------------------------------------------------| ---- |
| v1/login/SMS | POST | { mobile } | send a code to mobile for authentication<br>you can send only 1 request per 2 minute      | { message, user = { mobile } } |
| v1/login/SMS/verify | POST | { mobile, code } | verify mobile to authentication. <br>you can send 3 request per 2 minute                  |  { message, token = { type, value }} or<br>{ message, login { message, status } } |
