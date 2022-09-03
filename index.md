<p align="center">
  <img src="https://user-images.githubusercontent.com/64106883/184724831-634672ea-1d41-431a-84d1-972467dcd979.png" alt="غناوران سیستم و ارتباطات دامون">
</p>

<h1 align="center">Laravel 9 - <a href="https://damoon.pro" target="_blank">Damoon</a></h1>


### Installation

```
composer create-project damoonpro/laravel
```


---

**TODO :** ✍️

---

**Routes** 🚀

| URL | METHOD | REQUEST | DESCRIPTION                                                                               | RESPONSE |
| ----- | ----- | ----- |-------------------------------------------------------------------------------------------| ---- |
| v1/login/SMS | POST | { mobile } | send a code to mobile for authentication<br>you can send only 1 request per 2 minute      | { message, user = { mobile } } |
| v1/login/SMS/verify | POST | { mobile, code } | verify mobile to authentication. <br>you can send 3 request per 2 minute                  |  { message, token = { type, value }} or<br>{ message, login { message, status } } |

---

### Admin message configuration : 🧰

**Description :** 📚
1. get every sms configuration that sets.
2. update sms text.
if you want to update sms text you have to put alias in update route.

| URL                                    | METHOD | REQUEST | DESCRIPTION                | RESPONSE                        |
|----------------------------------------|--------| ----- |----------------------------|---------------------------------|
| v1/admin/config/message                | GET    | { ---- } | collect sms configurations | [ { alias, help, text, label }] |
| v1/admin/config/message/{alias}/update | PUT    | { ---- } | update message text        | { message, sms = { label } }    |
