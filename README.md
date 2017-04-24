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
* enable rewrite module in your server's engine config
* ready!


## Technická dokumentácia

### Nastavenia
Nastavenia aplikácie môžete nájsť v priečinku `config`. Jednotlivé nastavenia sú nasledovné:

#### `config/database.php`
Nastavenie databázy

#### `config/database.php`
Nastavenia jazykov aplikácie.

### API aplikácie
API sa riadi REST architektúrou. V nasledujúcej sekcii sa nachádza prehľad všetkých koncových bodov aplikácie.

#### Middleware-y
##### `redirectIfNotAdmin`
Ak užívateľ nemá admin privilégia, na daný koncový bod sa nedostane.

##### `redirectIfNotLoggedIn`
Ak užívateľ nie je prihlásený, na daný koncový bod sa nedostane.

#### Koncové body užívateľov

##### `GET @ /` => `PagesController::index()`
Domovská stránka aplikácie.

##### `GET @ /register` => `PagesController::register()`
Middleware: `redirectIfNotAdmin()`

##### `GET @ /login` => `PagesController::login()`
Zobrazí stránku pre prihlásenie užívateľa.

##### `GET @ /logout` => `PagesController::logout()`
Odhlási užívateľa.

#### Koncové body prednášok

##### `GET @ /lecture/create` => `PagesController::logout()`
Middleware: `redirectIfNotLoggedIn()`
            `redirectIfNotAdmin()`
Zobrazí formu pre vytvorenie novej prednášky.




