# Video App

## Installation instructions
* `git clone https://github.com/Nualiian/video_app`
* `composer install`
* `npm install`
* `bower install`
* set your databse conenction credentials in `config/database.php`
* `.htaccess` directive has to be allowed in your server config
* `gulp build` has to be run at least first time even when developing to compile materialize sass framework and its fonts (this is disabled in watch task to reduce compiling time to minimum while actively developing)
* `gulp watch` for development watching of resources
* change your apache / nginx config to accept moduel rewrite
* ready!
