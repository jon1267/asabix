Text job for Asabix

Used routes (php artisan route:list)

GET|HEAD   api/posts .......................... posts.index › Api\ApiPostController@index<br>
POST       api/posts .......................... posts.store › Api\ApiPostController@store<br>
POST       api/posts/{id} ................... posts.update › Api\ApiPostController@update<br>
GET|HEAD   api/posts/{post} ..................... posts.show › Api\ApiPostController@show<br>
DELETE     api/posts/{post} ............... posts.destroy › Api\ApiPostController@destroy<br>
GET|HEAD   api/tags ............................. tags.index › Api\ApiTagController@index<br>
POST       api/tags ............................. tags.store › Api\ApiTagController@store<br>
POST       api/tags/{id} ...................... tags.update › Api\ApiTagController@update<br>
GET|HEAD   api/tags/{tag} ......................... tags.show › Api\ApiTagController@show<br>
DELETE     api/tags/{tag} ................... tags.destroy › Api\ApiTagController@destroy<br>
POST       api/tags-translations .............. Api\ApiTagController@storeTagTranslations<br>
POST       api/tags-translations/{id} ........ Api\ApiTagController@updateTagTranslations<br>
DELETE     api/tags-translations/{id} ........ Api\ApiTagController@deleteTagTranslations<br>