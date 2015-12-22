# Collective
A slim 3 based skeleton project that utilizes the ADR pattern [ http://pmjones.io/adr/ ].
Collective does not include an ORM or PDO wrappers, this is left up to you to choose!

# Installation

## Config
config/app.config holds your Dependency Container Default Values.
To turn Twig Caching off:
`
$container["config"]["cache_path"] = false
`

## Environment
The application expects you to set your web root to the public directory and have the ability to rewrite URLS. A default .htaccess is provided.

# Routes
Routes can be configured in the app.config class for easy configuration.
Each route must have a pattern (key) and a callable element. Middleware and names are optional

`
    'routes' => [
        'get' => [
            '/' => [ "callable" => HelloWorldAction::class, "mw" => [], "name" => "" ]
        ]
    ]
`

# Application Middleware
Application middleware can be configured in the app.config file as well.

`
    "app-middleware" => [
        LoggerMiddleware::class
    ]
`

# Middleware Closures
Middleware closures can be added at any point before run by wrapping your closure with a factory closure from pimple.
`
       $this->collective->addMw("Test2", function ($c) {
                return function ($req, $res, $next) {
                    $res = $next($req, $res);
                    $res->write("Test2");

                    return $res;
                };
            }
        );
`