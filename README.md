Text job for Asabix

Used routes (php artisan route:list)

GET|HEAD   api/posts ................................................ posts.index › Api\ApiPostController@index
POST       api/posts ................................................ posts.store › Api\ApiPostController@store
POST       api/posts/{id} ......................................... posts.update › Api\ApiPostController@update
GET|HEAD   api/posts/{post} ........................................... posts.show › Api\ApiPostController@show
DELETE     api/posts/{post} ..................................... posts.destroy › Api\ApiPostController@destroy
GET|HEAD   api/tags ................................................... tags.index › Api\ApiTagController@index
POST       api/tags ................................................... tags.store › Api\ApiTagController@store
POST       api/tags-translations .................................... Api\ApiTagController@storeTagTranslations
POST       api/tags-translations/{id} .............................. Api\ApiTagController@updateTagTranslations
DELETE     api/tags-translations/{id} .............................. Api\ApiTagController@deleteTagTranslations
POST       api/tags/{id} ............................................ tags.update › Api\ApiTagController@update
GET|HEAD   api/tags/{tag} ............................................... tags.show › Api\ApiTagController@show
DELETE     api/tags/{tag} ......................................... tags.destroy › Api\ApiTagController@destroy
GET|HEAD   api/user ...........................................................................................
GET|HEAD   sanctum/csrf-cookie .............. sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show