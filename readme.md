# Publishing Dashboard

Built in two weeks to grab and store a wordpress RSS feed and allow users to post to the official twitter account with editorial control.

![screenshot of publishing dashboard](https://raw.github.com/jamesduffy/publishing-dashboard/master/screenshot.png)


### Requirements

* PHP
* PHP Composer
* MySQL


### Setup Instructions

1. Clone or download the master repository
   ```
   git clone https://github.com/jamesduffy/publishing-dashboard.git && cd publisher-dashboard
   ```
2. Run `composer update`
3. Update MySQL connection variables in `/app/config/database.php`
4. Update Twitter variables in `/app/config/packages/thujohn/twitter/config.php`
  1. With your app's CONSUMER_KEY and CONSUMER_SECRET
  2. With your official twitter account's ACCESS_TOKEN and ACCESS_TOKEN_SECRET
5. Run `php artisan migrate`
6. Add two tasks to your server to run in the background using `crontab -e`
```
0 * * * *	php /path/to/project/artisan stats:twitter
0 0 * * *	php /path/to/project/artisan stats:twittercount
*/5 * * * *	php /path/to/project/artisan articles:get
* * * * *	php /path/to/project/artisan campaigns:publish
```


### Contributing

All issues and pull requests should be filed to the project's [GitHub Repository](https://github.com/jamesduffy/publishing-dashboard)


### Credits

Publishing Dashboard is built with these awesome open-sourced software:

* [Laravel 4](http://laravel.com/)
* [SimplePie](http://simplepie.org/)
* [L4 Feed Reader](https://github.com/awjudd/l4-feed-reader)
* [thujohn/twitter-l4](https://github.com/thujohn/twitter-l4)
* [jelovac/bitly4laravel](https://github.com/jelovac/bitly4laravel)
* [Bootstrap](http://getbootstrap.com/)
* [Font Awesome](http://fontawesome.io/)


### License

Publishing Dashboard is open-sourced software licensed under GPLv3 included in license.txt.
