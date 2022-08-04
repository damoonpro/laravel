# Blog module 🧩
## Description 📚
when you want to use this module you have to move every file to correct directory<br><br>
**Pay attention**  ⚠️ 
<br>make sure about you setting the correct namespace for files

**Routes** 🚀

##### Guest routes

| URL | METHOD | REQUEST | RESPONSE | DESCRIPTION                                                  |
| ----- | ----- | ----- | ----- |--------------------------------------------------------------|
| v1/blog/ | GET | { ---- } | user = { name, id }, <br> categories = [ { label , slug } ], <br> title, slug, description, meta_title, meta_description, confirmed | this is for guest users and set paginate to 12               | 
| v1/blog/filter | GET | filter | user = { name, id }, <br> categories = [ { label , slug } ], <br> title, slug, description, meta_title, meta_description, confirmed | this is for guest users and set paginate to 12 but it filter | 

<br>

##### User routes

| URL | METHOD | REQUEST | RESPONSE | DESCRIPTION                                                            |
| ----- | ----- | ----- | ----- |------------------------------------------------------------------------|
| v1/me/blog/create | POST | title, description, body, meta_title, meta_description | message , blog = [ slug, confirmed ] | This routes make a blog for user so it **important to user logged in** |
