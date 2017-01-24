# Pxl
Pxl.lt's open source clone. Made in Laravel, in which I currently do not have experience.
Please feel free to join the project and contribute to it.

A short guide on setting it up server-side:
* Upload all files, except for the ones listed in the .gitignore file, to your server
* In your web server, change the root directory to '/path/to/pxl/public'.
* Configure Pxl by renaming env.example to .env and editing the environment configuration.
* Set up Pxl by installing composer and executing `php composer install` in Pxl's directory
(should be the one where this readme is located).
* Using `php artisan up` and `php artisan down` you may toggle maintenance mode.

It's built on top of Laravel, so please do read their (quickstart) documentation,
on setting up the project on your development machine. (Hint: It also involves composer.)

>My wholehearted apologies for everyone who used pxl and enjoyed it for their own domain or just as is. I'm really sorry about it all having happened, and after a sleepless night I have decided to reboot the project - not as you would expect it. I'm not going to host anything, but instead I'll do my best to recreate the concept of pxl, fully open sourced on Github.

>Many requested the source or offered to buy it, but I didn't want to. Not because I wanted it strictly private or thought it was worth more, but because the code was just unusable in other situations. This project will allow me to build it to be easily understood. Maybe some people would even care to contribute if they see something odd.
