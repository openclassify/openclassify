# OAuth2 Connect Module

The Connect Module makes it quick and easy to access your application and Streams data via a secure public API.

## Commands

    php artisan passport:install

    php artisan passport:client --password

    chmod 600 storage/streams/default/oauth-*
    
    
#API Routes

This section will go over everything you need to know about API routes.

    /api/entries/{namespace}/{stream}
    
The entries endpoint exposes Stream entries specified by the namespace and stream parameters.

### Parameters


Key | Required | Type | Example | Description
--- | --- | --- | --- |---
namespace | true | string | pages | The namespace of the Stream you want to access entries for.
stream | true | string | pages | The slug of the Stream you want to access entries for within the provided namespace.


    /api/entries/{namespace}/{stream}/{id}


The entries endpoint also exposes single Stream entries specified by the namespace, stream, and id parameters.

### Parameters

Key | Required | Type | Example | Description
--- | --- | --- | --- |---
namespace | true | string | pages | The namespace of the Stream you want to access entries for.
stream | true | string | pages | The slug of the Stream you want to access entries for within the provided namespace.
id | true | integer | 10 | The ID of the entry you want to access within the provided namespace and stream

<hr>

## Example Authentication

###### Request:

        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
        
        var urlencoded = new URLSearchParams();
        urlencoded.append("grant_type", "password");
        urlencoded.append("client_id", "******");
        urlencoded.append("client_secret", "**********************************");
        urlencoded.append("username", "admin@example.com");
        urlencoded.append("password", "admin123");
        
        var requestOptions = {
         method: 'POST',
         headers: myHeaders,
         body: urlencoded,
         redirect: 'follow'
        };
        
        fetch("https://your-site/oauth/token", requestOptions)
         .then(response => response.text())
         .then(result => console.log(result))
          .catch(error => console.log('error', error));



###### Response:

        {
           "token_type": "Bearer",
           "expires_in": 31536000,
           "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiODAwMjZiMTUwMDU0MWFhMTI2MWY4MmI1ZWM5MDI5NTdiZTAyNjg4ZDc1MjAxYWQ3OWM1ZmQwODFiMjdjYjIyYzE2ZTI1ZjJiMmNkYzk2Y2EiLCJpYXQiOjE2MjI3OTY2NDMuMjUyMjQ0LCJuYmYiOjE2MjI3OTY2NDMuMjUyMjQ3LCJleHAiOjE2NTQzMzI2NDMuMjIzMjcyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.HiruzlEaSeGNcTzuC8pdoE3pYpWI5HLY4Y7AhbzQES90LS79YdlIRF_Lly0vD3NIX4KrlD-7YwrYEThT2WkWhdVpm090zaqmZodcqoJvsnqMvOLfhPyWrkoCGd7aGATvA40bpehnBkA-vmKnBNYMEZoNv59As43DM6szy-_0f-oFhX0aDV6PT2M0LaT4hjfBsYXr82aZmSZeauGHCrrW9fnjD6jUkqbkRhp4bdpaTbKjzmcnAfIGCRM6BoODR06J9u6LFz9Q-ARJBEbT_ziS7W1wpkEKLAICYZLKpwsrU8iSJunb0swODB2mRUyrw4VaOQaI5NBpOyg4ugEsUJvf3m1xMJZ7PncV2ABjKsKN-3ScababoUSzR-btWxESaNae3OJAEYsn9aJHXqvWgdgmTVEHNobNt7ugYcnRW-DR8wAcK1Lf3lAmnGY8loyjPz5RmW5Q8L--qDDjY-zVtCWHph82SNZ_E0VsWYXVvuPm0xf5IgluuUEeaNDqVOzyQfehj7N4yJ8rcZ3CGcvZ4Mmz0TmXBnSB4fWAhOuzd875NSZzyS2NWWn9wEf-TQHIdQVFKexfnzO-BemnxIxElVcs4vYRnQYbCKwGxirzb1DcaXUY4rP3s-Vl0mJO_Jx3jm17XLVgsOhgquXJbFG7bloV08ldKaeFBwHLJdcFoChgtFM",
           "refresh_token": "def50200ab26d4d931dd76c2082f3814fe58e618a5e35727ab8e516fd484d89d01696e65b3af32e1a8b9580b229abf7036945d65b050b7e72d626eb600f0bf777f554f0b40d254f5156d474bd26e38ec45c7d7ca279d74b3dcee9933db9a17e06ead14e7bc77e58339a7ed7a92c10a4eea46d5626cc4483f22e8fc0bc694aae8142eef8d4ebba16eb1d14e8cfe5a7fee8a65ca41ffde618f6871af2dd08e24e76bda6e0f7ea1498cdad28b1ee8c33e72319ec6c4a3d5c412774eca5154de6f02c6c0c3ba160b387d6bbfa0c7b24f317d181d8a35c3ed321f35a788afb3da33a20850dffdbe7d3844677a50feab7c82c1e7c7fbd01c80d6bc62de0d881168807ab392cf70588ef4365adac73a63f12757a738cda29b2ccee964cbab7ac0613090c7d9571d916221fe11513ac54583843159f69476b9f7c9b906364a938ffd37df49b8cead153090d18367850dffbf156fac2ef6a91848480dbe6d4158d9d83034fb"
        }
        
<hr>

## Example Create

###### Request
        var myHeaders = new Headers();
        
        /**
        * Copy and Paste Authentication Response "access_token" for Authorization
        */
        
        myHeaders.append("Authorization", "Bearer PASTE_HERE_ACCESS_TOKEN");
        myHeaders.append("Content-Type", "application/json");
        
        var raw = JSON.stringify({
           "en": {"name": "TEST EN Title"}, // Translatable Field
           "tr": {"name": "TEST TR Title"}, // Translatable Field
           "slug":"test"
        });
        
        var requestOptions = {
           method: 'POST', // It is used for the POST method creation function.
           headers: myHeaders,
           body: raw,
           redirect: 'follow'
        };
        
        /**
        * addon_slug : advs, cats, posts, ...
        * stream_slug : "advs" for Advs Module, "category" for Cats Module, "categories" for Posts Module, ...
        */
        
        /**
        * Example
        * addon_slug : “posts”,
        * stream_slug : “categories”
        */
        
        fetch("https://your-site/api/entries/addon_slug/stream_slug", requestOptions)
           .then(response => response.text())
           .then(result => console.log(result))
           .catch(error => console.log('error', error));


###### Response

        {
           "updated_by_id": null,
           "created_by_id": null,
           "sort_order": 2,
           "slug": "test",
           "updated_at": "2021-06-14T08:32:48.000000Z",
           "created_at": "2021-06-14T08:32:48.000000Z",
           "id": 2,
           "name": "TEST EN Title",
           "description": null,
           "meta_title": null,
           "meta_description": null
        }
        
        
<hr>

## Example Update

###### Request

        var myHeaders = new Headers();
        
        /**
        * Copy and Paste Authentication Response "access_token" for Authorization
        */
        
        myHeaders.append("Authorization", "Bearer PASTE_HERE_ACCESS_TOKEN");
        myHeaders.append("Content-Type", "application/json");
        
        var raw = JSON.stringify({
           "en": {"name": "TEST EN New Title"}, // Translatable Field
           "tr": {"name": "TEST TR New Title"}, // Translatable Field
           "slug":"test_updated"
        });
        
        var requestOptions = {
           method: 'PUT', // It is used for the PUT method update function.
           headers: myHeaders,
           body: raw,
           redirect: 'follow'
        };
        
        /**
        * addon_slug : advs, cats, posts, ...
        * stream_slug : "advs" for Advs Module, "category" for Cats Module, "categories" for Posts Module, …
        * entry_id : Represents the ID (primary_id) found in the database
        */
        
        /**
        * Example
        * addon_slug : “posts”,
        * stream_slug : “categories”,
        * entry_id : “1”
        */
        
        
        fetch("https://your-site/api/entries/addon_slug/stream_slug/entry_id", requestOptions)
           .then(response => response.text())
           .then(result => console.log(result))
           .catch(error => console.log('error', error));
           
           
###### Response

        true
        
<hr>

## Example Delete

###### Request

        var myHeaders = new Headers();
        
        /**
        * Copy and Paste Authentication Response "access_token" for Authorization
        */
        
        myHeaders.append("Authorization", "Bearer PASTE_HERE_ACCESS_TOKEN");
        myHeaders.append("Content-Type", "application/json");
        
        var requestOptions = {
           method: 'DELETE', // It is used for the DELETE method delete function.
           headers: myHeaders,
           redirect: 'follow'
        };
        
        /**
        * addon_slug : advs, cats, posts, ...
        * stream_slug : "advs" for Advs Module, "category" for Cats Module, "categries" for Posts, ...
        */
        
        
        /**
        * Example
        * addon_slug : “posts”,
        * stream_slug : “categories”,
        * entry_id : “1”
        */
        
        fetch("https://your-site/api/entries/addon_slug/stream_slug/entry_id", requestOptions)
           .then(response => response.text())
           .then(result => console.log(result))
           .catch(error => console.log('error', error));


###### Response

        true
        
<hr>

## Example List

###### Request

            var myHeaders = new Headers();
            
            /**
            * Copy and Paste Authentication Response "access_token" for Authorization
            */
            
            myHeaders.append("Authorization", "Bearer PASTE_HERE_ACCESS_TOKEN");
            myHeaders.append("Content-Type", "application/json");
            
            var requestOptions = {
               method: 'GET', // It is used for the GET method get function.
               headers: myHeaders,
               redirect: 'follow'
            };
            
            /**
            * addon_slug : advs, cats, posts, ...
            * stream_slug : "advs" for Advs Module, "category" for Cats Module, "categries" for Posts, ...
            */
            
            
            /**
            * Example
            * addon_slug : “posts”,
            * stream_slug : “categories”
            */
            
            fetch("https://your-site/api/entries/addon_slug/stream_slug", requestOptions)
               .then(response => response.text())
               .then(result => console.log(result))
               .catch(error => console.log('error', error));



###### Response


            {
               "data": [
               {
                   "id": 1,
                   "sort_order": 1,
                   "created_at": "2021-06-01T11:48:32.000000Z",
                   "created_by_id": null,
                   "updated_at": "2021-06-01T11:48:32.000000Z",
                   "updated_by_id": null,
                   "deleted_at": null,
                   "slug": "news",
                   "name": "News",
                   "description": "Company news and updates.",
                   "meta_title": null,
                   "meta_description": null
               },
               {
                   "id": 3,
                   "sort_order": 2,
                   "created_at": "2021-06-14T08:49:45.000000Z",
                   "created_by_id": null,
                   "updated_at": "2021-06-14T08:49:45.000000Z",
                   "updated_by_id": null,
                   "deleted_at": null,
                   "slug": "test_updated",
                   "name": "TEST EN New Title",
                   "description": null,
                   "meta_title": null,
                   "meta_description": null
               }
            ],
               "pagination": {
               "current_page": 1,
                   "first_page_url": "/api/entries/posts/categories?page=1",
                   "from": 1,
                   "last_page": 1,
                   "last_page_url": "/api/entries/posts/categories?page=1",
                   "links": [
                   {
                       "url": null,
                       "label": "&laquo; Previous",
                       "active": false
                   },
                   {
                       "url": "/api/entries/posts/categories?page=1",
                       "label": "1",
                       "active": true
                   },
                   {
                       "url": null,
                       "label": "Next &raquo;",
                       "active": false
                   }
               ],
                   "next_page_url": null,
                   "path": "/api/entries/posts/categories",
                   "per_page": 15,
                   "prev_page_url": null,
                   "to": 2,
                   "total": 2
            }
            }


<hr>

## Example Detail Entry


###### Request

            var myHeaders = new Headers();
            
            /**
            * Copy and Paste Authentication Response "access_token" for Authorization
            */
            
            myHeaders.append("Authorization", "Bearer PASTE_HERE_ACCESS_TOKEN");
            myHeaders.append("Content-Type", "application/json");
            
            var requestOptions = {
               method: 'GET', // It is used for the GET method get function.
               headers: myHeaders,
               redirect: 'follow'
            };
            
            /**
            * addon_slug : advs, cats, posts, ...
            * stream_slug : "advs" for Advs Module, "category" for Cats Module, "categries" for Posts, ...
            */
            
            
            /**
            * Example
            * addon_slug : “posts”,
            * stream_slug : “categories”,
            * entry_id : “1” or “2”
            */
            
            fetch("https://your-site/api/entries/addon_slug/stream_slug/entry_id", requestOptions)
               .then(response => response.text())
               .then(result => console.log(result))
               .catch(error => console.log('error', error));


###### Response


            {
               "data": {
               "id": 2,
                   "sort_order": 2,
                   "created_at": "2021-06-14T08:49:45.000000Z",
                   "created_by_id": null,
                   "updated_at": "2021-06-14T08:49:45.000000Z",
                   "updated_by_id": null,
                   "deleted_at": null,
                   "slug": "test_updated",
                   "name": "TEST EN New Title",
                   "description": null,
                   "meta_title": null,
                   "meta_description": null
            }
            }


