# Pxl
Pxl.lt's open source clone. Made in Laravel, in which I currently do not have experience.
Please feel free to join the project and contribute to it. The sooner you would like
to see this project up and running on your own site, the sooner you should help us out
and contribute! Currently I am working on this by myself, in my spare time.

If you plan on helping out, please do get in touch so I can set up a Trello board to plan some kind of roadmap.

[Twitter](https://twitter.com/MaxKorlaar) &bull; [Blog](https://maxkorlaar.com/blog)

### Functions (planned)
I do plan on keeping the core functionality of the previous Pxl.lt, as that is what made it stand out.
Task list, not in particular order:
- [x] Login, registration system (public and private)
- [x] Personal account management
- [x] List of users
- [x] Admin account management
- [ ] Admin site settings (different from the settings in .env)
- [x] Image upload support
- [x] Automatic deletion for images. Default & per-image setting. (A personal favourite, must have for limited space)
- [x] Gallery
- [x] Preferences per user
- [x] Automatic deletion time default per user
- [ ] View others' galleries (as admin, make it an option?)
- [ ] Custom domain support, custom storage location support (This will be difficult with Laravel.
It would be possible to set up your webserver to link a specific directory to a specific domain,
but additional configuration **will** be required for setting up preview pages - aka links without extensions)
- [x] Image preview page, somehow linked to that custom location most likely
- [ ] Image preview page that can be overridden via template. Custom template name or database?
- [x] ShareX support via copy/paste JSON-based config
- [x] Access tokens for users, resettable. Required for uploading
- [x] JSON-based API for simple requests, mostly for ShareX support
- [x] Social media metadata on the image preview page (OpenGraph, oEmbed)
- [x] Account deletion ~~(Admin setting?)~~
- [ ] Enforce limits on accounts? Images / space / etc?
- [ ] Amazon S3 support via Laravel (Maybe?)
- [ ] Pxl-goodbye: Zip download of all your data? (Note:
May have performance and timeout issues in PHP. Must look into it in detail later.)

## Helping out
I would love to see people help out! So, if you were doubting about forking it or even submitting
a pull request or suggestion, please go ahead!
If you, just like me, have few to none knowledge about Laravel, the PHP framework this project uses,
then please do [read their documentation](https://laravel.com/docs/master). I constantly check the docs, because
the framework is full of interesting and useful but maybe even confusing functionality!
If you can't figure out how to set it up on your development machine (I do not run a local development server,
but instead use a VPS for it), please consult Laravel's docs as well.
It should be similar to the small guide below.

### A short guide on setting it up server-side:
* Upload all files, except for the ones listed in the .gitignore file, to your server
    * If you can use `git`, then use this instead. Clone this repo in the location.
* In your web server, change the root directory to '/path/to/pxl-project-directory/**public**'.
* Set up Pxl by installing composer **first** and executing `php composer install` in Pxl's directory (_Unless your composer
file is named `composer.phar`, then it's `php composer.phar install`_)
* Configure Pxl by copying `env.example` to `.env` and editing the environment configuration.
* Execute `php artisan key:generate` to automatically generate a secure key that will be put into `.env`
(should be the one where this readme is located).
* Blank screen? Check if you have set up everything. To be sure, check Laravel's docs and make sure all directory permissions are set up correctly!
* After setting up your `.env` variables, MySQL database and user, and directory permissions, Pxl should work.
If you get error 500, it might be possible that you haven't set up the tables yet. Do so by executing `php artisan migrate`.
* Using `php artisan up` and `php artisan down` you may toggle maintenance mode.
* You may update your database by using `php artisan migrate` and clean it by using `php artisan migrate:reset` **Warning!** This will most likely clear your database. Don't execute this on your PRODUCTION machine.
* In order to set up the automatic deletion of (specified) images, add this to your crontab: `* * * * * php /path-to-pxl/artisan schedule:run >> /dev/null 2>&1`.

It's built on top of Laravel, so please do read their (quickstart) documentation,
on setting up the project on your development machine. (Hint: It also involves composer.)

##### Regarding Pxl.lt, the inspiration for this project:


>My wholehearted apologies for everyone who used pxl and enjoyed it for their own domain or just as is. I'm really sorry about making the decision to shut the project down, but it was for the best. After a long night I have decided to reboot the project - not as you would expect it. I'm not going to host anything, but instead I'll do my best to recreate the concept of pxl, fully open sourced on Github.

>Many requested the source or offered to buy it, but I didn't want to. Not because I wanted it strictly private or thought it was worth more, but because the code was just unusable in other situations. This project will allow me to build it to be easily understood. Maybe some people would even care to contribute if they see something odd.

_Context: Pxl.lt was compromised in terms of security and the service was shut down._
