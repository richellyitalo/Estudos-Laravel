# estudos-laravel
Cursos básicos e avançados para o entendimento do framework

# CORS
* Cria um middleware chamado CORS
* No método `handle` do método, adiciona os códigos seguintes antes do `$next($request)`: 
* `header('Access-Control-Allow-Origin : * ');`
* `header('Access-Control-Allo-Headers : Content-type, X-Auth-Token, Authorization, Origin');`
* Adiciona no`Kernel.php` ao `$routeMiddleware` a instrução `'CORS' => \App\Http\Middleware\CORS:class`
* Para esse middleware efetivar em todas as rotas, no mesmo `Kernel.php`, adiciona em `$middleware = [...`: `\App\Http\Middleware\CORS::class`

# JWT (TymonDesign)
* Para instalar a versão do último commit:
* `composer require tymon/jwt-auth:dev-branch#hash-docommit`
* `composer require tymon/jwt-auth:dev-develop#e190b6a75372e7e5e3a6d2cf0e4456313412299f`
* Em `config/auth.php` alterar na chave **api** o driver de **token** para **jwt**
* No terminal: `php artisan jwt:secret`
