# Blog module
## Description
when you want to use this module you have to move every file to correct directory<br><br>
**Pay attention**  ⚠️ 
<br>make sure about you set the correct namespace

**Routes** 🚀

##### Guest routes

| URL | METHOD | REQUEST | RESPONSE | DESCRIPTION |
| ----- | ----- | ----- | ----- | ----- |
| v1/blog/ | GET | { ---- } | user = { name, id }, <br> categories = [ { label , slug } ], <br> title, slug, description, meta_title, meta_description, confirmed | this is for guest users and set paginate to 12 | 
