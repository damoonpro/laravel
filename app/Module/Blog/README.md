# Blog module 🧩
## Description 📚
when you want to use this module you have to move every file to correct directory<br><br>
**Pay attention**  ⚠️ 
<br>make sure about you setting the correct namespace for files

**Routes** 🚀

##### Guest routes

| URL | METHOD | REQUEST | RESPONSE                                                                                                                                 | DESCRIPTION                                                                               |
| ----- | ----- | ----- |------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------|
| v1/blog/ | GET | { ---- } | user = { name, id }, <br> categories = [ { label , slug } ], <br> title, slug, description, meta_title, meta_description, confirmed      | this is for guest users and set paginate to 12                                            | 
| v1/blog/filter | GET | filter | user = { name, id }, <br> categories = [ { label , slug } ], <br> title, slug, description, meta_title, meta_description, confirmed      | this is for guest users and set paginate to 12 but it filter                              | 
| v1/blog/{slug} | GET | { ---- } | title, slug, description, body, meta_title, meta_description, likes, confirmed, user = { name, id }, categories = [ { label, slug } ] , replies = [ {id, text, user = { name }, ! replies = [ ] ] | this route get alot of information about blog to guest user but  **maybe not found page** |
<br>

##### User routes

| URL                     | METHOD | REQUEST                                                | RESPONSE                                                                                                                                                                                         | DESCRIPTION                                                                               |
|-------------------------| ----- |--------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------|
| v1/me/blog/create       | POST | title, description, body, meta_title, meta_description | message , blog = [ slug, confirmed ]                                                                                                                                                             | This routes make a blog for user so it **important to user logged in**                    |
| v1/me/blog/{slug}/update | PUT | title, description, body, meta_title, meta_description | message , blog = [ slug ]                                                                                                                                                                        | This routes update a blog that user was created and it is **important to user logged in** |
| v1/me/blog/{slug}       | GET | { ---- }                                               | title, slug, description, body, meta_title, meta_description, likes, confirmed, user = { name, id }, categories = [ { label, slug } ], replies = [ {id, text, user = { name }, ! replies = [ ] ] | this route get alot of information about blog to guest user but  **maybe not found page** |
| v1/me/blog              | GET | { ---- }                                               | user = { name, id }, <br> categories = [ { label , slug } ], <br> title, slug, description, meta_title, meta_description, confirmed                                                              | this is for authenticated users and set paginate to 12 **make sure about loggin**         | 
| v1/blog/{slug}/like     | POST | { ----- }                                              | message , blog = { slug }                                                                                                                                                                        | Users can like or deslike blog                                                            |
| v1/blog/{slug}/reply | POST | { text, ~parent_i~ }                                   | message, reply = { id, blog = { slug } }                                                                                                                                                         | reply a blog if parent_id sets it is answer the replyed text                              |

<br>

##### Admin routes

| URL                            | METHOD | REQUEST       | RESPONSE                                                                                                                                                                                         | DESCRIPTION                                                                                 |
|--------------------------------| ----- |---------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------|
| v1/admin/blog/{slug}/confirmed | POST | { ----- }     | message, blog = { slug } | Enable or disable blog by admin                                                             |
| v1/admin/blog                  | GET | { ---- }      | user = { name, id }, <br> categories = [ { label , slug } ], <br> title, slug, description, meta_title, meta_description, confirmed                                                              | this is for admin users, to see all blogs and set paginate to 12 **make sure about loggin** | 
| v1/admin/blog/filter           | GET | user, filters | user = { name, id }, <br> categories = [ { label , slug } ], <br> title, slug, description, meta_title, meta_description, confirmed      | this is for admin users admin can filter blog by user id and set paginate to 12             | 
