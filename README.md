Blog Application
================

How it works?
-------------
1. First is the kernel
Kernel is the main point of framework. It will handle request, routing, congroller and response.

* autoloader is responsible for class including
* Kernel handles request
* request is given to router
* Router guesses controller and action which should be used for given action
* Controller is provided by ControllerFactory 
* Controller process action
* Action must return response object
* Response is responsible for redirection on rendering view


2. Config
* in config/routes.php there is possibility to add routes
* all config is stored in config.php

3. DB
* is in db/ 
* there is main object SqlLite (singleton) which is responsible for connection with db
* objects like PostDb and UserDb are responsible for specific models

4. Structure
    * app/ - all methods
    * assets/ - js, css etc
    * config/ - configuration
    * db/ - database

If I had more time
------------------
* PHPDoc would be done
* Unit tests would be done
* Exceptions would be catched - in kernel
    * and some beautiful page would be generated for that
* Adding users would be done
* Session verification would have specific function to that. This method I used is kind of lame.
* Prefixes for CSSes. If I do a project i use PostCSS which does that for me. Cool tool! So far - looks fine for Chrome.
* Comments...


 by Hubert Sosinski. 
