# Collective
A slim 3 based skeleton project that utilizes the ADR pattern [ http://pmjones.io/adr/ ].
Collective does not include an ORM or PDO wrappers, this is left up to you to choose!

# Installation

## Config
config/app.config holds your Dependency Container Default Values.
To turn Twig Caching off set `$container["config"]["cache_path"] = false`

## Environment
The application expects you to set your web root to the public directory and have the ability to rewrite URLS. A default .htaccess is provided.

