# Use para iniciar rapidamente um novo projeto laravel #

### Projeto inicia com: ###
* Área de administração
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
*  php artisan migrate:install
*  php artisan migrate
*  php artisan db:seed RoleAndPermissionSeeder
*  php artisan serve
*  Acesse http://localhost:port

### Como criar novos CRUDs ###
* php artisan make:crud nameOfYourCrud "column1:type, column2" (theory)
* Exemplo:
<code>php artisan make:crud post "title:string, content:text"</code>

* Criar tabela no banco de dados: <code>php artisan migrate</code>

Inserir rota no arquivo <code>web.php</code>
Route::resource('posts', PostsController::class);

Se quiser adicionar uma permissão para esse grupo de rotas, crie dessa forma:
Route::resource('posts', PostsController::class)->middleware('can:menu_posts');

* Adicione suas traduções em <code>lang/vendor/adminlte/pt_BR/main.php</code>
* Adicione novos menus em: config/adminlte.php, no array <code>menu</code>, linha 292
Exemplo:

```
    [
      'text' => 'Posts',
      'icon'    => 'fas fa-icon',
      'url'    => 'posts',
      'can' => 'menu_posts',//parametro opcional, crie a permissão menu_posts
    ],
```

### Remover CRUDs ###

* php artisan rm:crud nameOfYourCrud --force

* Exemplo: <code>php artisan rm:crud post --force</code>
* É necessário remover o arquivo de migration manualmente

Veja o manual de uso completo em:
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

![login](https://github.com/alesandroalan/laravel_fast_project/assets/7017456/4d5e5cd8-445d-4c71-83f7-40831d200eb6)
![register](https://github.com/alesandroalan/laravel_fast_project/assets/7017456/0e2a5c3e-0378-47c7-8dcd-2d6eee6edb89)
![home-page](https://github.com/alesandroalan/laravel_fast_project/assets/7017456/eef0ae5f-05c3-4da5-afc1-4fe9cad334e4)
![users](https://github.com/alesandroalan/laravel_fast_project/assets/7017456/56847f31-63c6-4a5a-98a4-2b7567e4202a)
![users-create](https://github.com/alesandroalan/laravel_fast_project/assets/7017456/df24b4ba-f998-470a-8063-009a5cec061c)
![groups](https://github.com/alesandroalan/laravel_fast_project/assets/7017456/a78b2f76-1b55-48e7-8ba2-4f2da551200c)
![permissions](https://github.com/alesandroalan/laravel_fast_project/assets/7017456/b980a2ba-d7c9-4b0b-bb71-0ed2ef69f0a1)

