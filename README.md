# Collective
Collective is a slim 3 based skeleton project that recommends utilizing the ADR pattern [ http://pmjones.io/adr/ ].
Collective will allow you to configure your app strictly from the app.config file. 
Of course you are not limited to doing so.

# Installation

## Config
config/app.config holds your Dependency Container Default Values.
To turn Twig Caching off:
```php
$container["config"]["cache_path"] = false
```

## Environment
The application expects you to set your web root to the public directory and have the ability to rewrite URLS. A default .htaccess is provided.

# Routes
Routes can be configured in the app.config class for easy configuration.
Each route must have a pattern (key) and a callable element. Middleware and names are optional

```php
    'routes' => [
        'get' => [
            '/' => [ "callable" => HelloWorldAction::class, "mw" => [], "name" => "" ]
        ]
    ]
```

# Application Middleware
Application middleware can be configured in the app.config file as well.

```php
    "app-middleware" => [
        LoggerMiddleware::class
    ]
```

# Middleware Closures
Middleware closures can be added at any point before run by wrapping your closure with a factory closure from pimple.
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
