[![Build Status](https://travis-ci.org/geggleto/Collective.svg)](https://travis-ci.org/geggleto/Collective)

# Collective
Collective is a skeleton project based on Slim 3, and Twig.

# Install the Application

Run this command from the directory in which you want to install your new Collective/Slim Framework application.

```php
php composer.phar create-project geggleto/collective [my-app-name]
```

Replace [my-app-name] with the desired directory name for your new application. You'll want to:

Point your virtual host document root to your new application's public/ directory.
Ensure logs/ is web writable.


## Config
`config/app.config` holds your Dependency Container Default Values.
To turn Twig Caching off:
```php
$container["config"]["cache_path"] = false
```

## Environment
The application expects you to set your web root to the public directory and have 
the ability to rewrite URLS. A default .htaccess is provided.

# Architecture
Collective provides base classes that are container aware so you don't need to write your own!

## Actions
Collective provides an extendable class `Geggleto\Helper\BaseAction` for your Actions 
if you are following ADR.

## Controllers
Collective provides an extendable class `Geggleto\Helper\BaseContainerClass` for your 
Controllers if you are following MVC.

## Middleware
Collective provides an extendable class `Geggleto\Helper\BaseMiddleware` for your Middleware.

## Dependency Resolution
In any class that extends either (`BaseAction`, `BaseMiddleware` or `BaseContainerClass`), 
any dependency listed in `app.config` will be  available in the class by accessing 
it through the `app.config` key as a class variable.
  
That is to say, if I want to access the session object in an action
```php
//Access Session object in a Action
public function __invoke (ServerRequestInterface $request, ResponseInterface $response, array $args)
{
    return $this->twig->render($response, "hello.twig", [$this->session->get('name')]);
}
```

# Routes
Routes can be configured in the `app.config` class for easy configuration.
Each route must have a pattern (key) and a callable element. Middleware and names are optional

```php
    'routes' => [
        //What HTTP Verb
        'get' => [
            //   / => Pattern
            //   callable => What action to run
            //   mw => What middleware are we running
            //   name => name the route
            '/' => [ "callable" => HelloWorldAction::class, "mw" => [], "name" => "" ]
        ]
    ]
```

# Application Middleware
Application middleware can be configured in the `app.config` file as well.

```php
    "app-middleware" => [
        LoggerMiddleware::class
    ]
```

# Middleware Closures
Middleware closures can be added at any point before run by wrapping your closure 
with a factory closure from pimple.
```php
   $this->collective->addMw("Test2", function ($c) {
            return function ($req, $res, $next) {
                $res = $next($req, $res);
                $res->write("Test2");
                return $res;
            };
        }
    );
```

# Session
Sessions are on by default.
If you want to turn sessions off or swap packages, then remove the "session" key 
from the `app.config` file. The session class uses whatever your php is configured 
to use [which is files by default].

Supported Syntax:
```php
$this->session->get('key');
$this->session->put('key', 'value');
$this->session->has('key');
$this->session->key;
$this->session->key = 'value';
isset($this->session->key);
```

If you want to use a different storage engine than the php default check this.
(http://php.net/manual/en/function.session-set-save-handler.php)

# Flash Messages
Flash Messages require the Session component. It is enabled by default
Flash Messages will be deleted on the next request.

```php
//Create a flash message ... do it someplace
$this->flash->put('message', 'my message');
```

```php
//Access the message on the next request via ServerRequestInterface
$request->getAttribute('message');
```

```php
//Access the message in Twig on the next request
{{ flash['message'] }}
```

# CLI Tools
Collective provides a Symfony console app for creating Actions and Middleware easily.

### Actions
```php
php cli.php create:action MyActionClassName
```

### Middleware
```php
php cli.php create:middleware MyMiddlewareClassName
```

# Error Pages
Custom Error handlers are provided for:
 - Page not found ``` templates/404.twig ```
 - Method not allowed ``` templates/405.twig ```
 - Server Error ``` templates/500.twig ```

# Optional Packages
... Coming soon

# Config Options
For development you should disable Twig Caching as it can be a giant pain.
```
"cache_path" => "../cache", ==> "cache_path" => false,
```