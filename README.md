# Use para iniciar rapidamente um novo projeto laravel #

### Projeto inicia com: ###
* Login
* Registro de usuários
* Página home inicial
* Menu Usuários
* Menu Grupos
* Menu Permissões

### Como instalar? ###

*  git clone https://github.com/alesandroalan/laravel_fast_project.git
*  cd laravel_fast_project
*  composer install
*  configure a database no arquivo <code>.env</code>
*  pa migrate:install
*  pa migrate
*  pa db:seed RoleAndPermissionSeeder
*  pa serve
*  Acesse http://localhost:port

### Como criar novos CRUDs ###
* php artisan make:crud nameOfYourCrud "column1:type, column2" (theory)
* Exemplo:
<code>php artisan make:crud post "title:string, content:text"</code>

* Criar tabela no banco de dados: <code>php artisan migrate</code>

Inserir rota no arquivo <code>web.php</code>
Route::resource('posts', PostsController::class);

### Remover CRUDs ###

* php artisan rm:crud nameOfYourCrud --force

* Exemplo: <code>php artisan rm:crud post --force</code>

Veja o manual completo de uso em:
https://github.com/misterdebug/crud-generator-laravel

### Dependências ###

*  <code>"php": "^8.1"</code>
*  <code>"guzzlehttp/guzzle": "^7.2"</code>
*  <code>"jeroennoten/laravel-adminlte": "^3.9"</code>
*  <code>"laravel/framework": "^10.10"</code>
*  <code>"laravel/sanctum": "^3.3"</code>
*  <code>"laravel/tinker": "^2.8"</code>
*  <code>"laravel/ui": "^4.4"</code>
*  <code>"laravelcollective/html": "^6.4"</code>
*  <code>"spatie/laravel-permission": "^6.3</code>

### Imagens ###

