<?php return array (
  'providers' => 
  array (
    0 => 'Illuminate\\Cache\\CacheServiceProvider',
    1 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    2 => 'Laravel\\Sail\\SailServiceProvider',
    3 => 'Laravel\\Tinker\\TinkerServiceProvider',
    4 => 'Laravel\\Ui\\UiServiceProvider',
    5 => 'Carbon\\Laravel\\ServiceProvider',
    6 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    7 => 'Termwind\\Laravel\\TermwindServiceProvider',
    8 => 'Spatie\\Sitemap\\SitemapServiceProvider',
    9 => 'App\\Providers\\RouteServiceProvider',
    10 => 'App\\Providers\\AppServiceProvider',
  ),
  'eager' => 
  array (
    0 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
    1 => 'Laravel\\Ui\\UiServiceProvider',
    2 => 'Carbon\\Laravel\\ServiceProvider',
    3 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    4 => 'Termwind\\Laravel\\TermwindServiceProvider',
    5 => 'Spatie\\Sitemap\\SitemapServiceProvider',
    6 => 'App\\Providers\\RouteServiceProvider',
    7 => 'App\\Providers\\AppServiceProvider',
  ),
  'deferred' => 
  array (
    'cache' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.store' => 'Illuminate\\Cache\\CacheServiceProvider',
    'cache.psr6' => 'Illuminate\\Cache\\CacheServiceProvider',
    'memcached.connector' => 'Illuminate\\Cache\\CacheServiceProvider',
    'Illuminate\\Cache\\RateLimiter' => 'Illuminate\\Cache\\CacheServiceProvider',
    'Laravel\\Sail\\Console\\InstallCommand' => 'Laravel\\Sail\\SailServiceProvider',
    'Laravel\\Sail\\Console\\PublishCommand' => 'Laravel\\Sail\\SailServiceProvider',
    'command.tinker' => 'Laravel\\Tinker\\TinkerServiceProvider',
  ),
  'when' => 
  array (
    'Illuminate\\Cache\\CacheServiceProvider' => 
    array (
    ),
    'Laravel\\Sail\\SailServiceProvider' => 
    array (
    ),
    'Laravel\\Tinker\\TinkerServiceProvider' => 
    array (
    ),
  ),
);