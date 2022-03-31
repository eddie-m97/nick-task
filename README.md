# Websites API

1. Clone repository</li>
2. Configure .env (Also queue driver)</li>
3. Install Composer</li>
4. Generate application key ```php artisan key:generate```</li>
4. Migrate & seed ```php artisan migrate --seed```</li>
5. Serve ```php artisan serve```</li>
6. Listen for queues with ```php artisan queue:work```</li>
7. Send posts with ```php artisan posts:send```

ADD
I used 2 queues: send-email and process-post
I suggest to use horizon for queue management.

[Postman collection](https://www.getpostman.com/collections/593dacf0c9b8c857cf65)
