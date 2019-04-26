# Laravel JWT

Projeto Laravel com JWT (JSON Web Token)

## Pré requisito
- Composer (gerenciador de pacotes)
- PHP 7.1
- Mysql 8


## Preparando ambiente
###### Download do projeto

```sh 
$ git clone  git@github.com:willyms/laravel-jwt.git 
```

###### Vamos renomear o arquivo .env.example para apenas .env, e adicionar algumas como banco de dados.
> ##### .env
> ##### APP_NAME=Laravel
> ##### APP_ENV=local
> ##### APP_KEY=
> ##### JWT_SECRET=
> ##### APP_DEBUG=true
> ##### APP_URL=http://localhost
> ##### 
> ##### LOG_CHANNEL=stack
> ##### 
> ##### DB_CONNECTION=mysql
> ##### DB_HOST=127.0.0.1
> ##### DB_PORT=3306
> ##### DB_DATABASE=db_dev
> ##### DB_USERNAME=root
> ##### DB_PASSWORD=
> 
###### No caso eu apenas adicionei o usuário root do meu MySQL e a minha senha praticamente inquebravel.
###### Executer o comando abaixo para gerar as chaves do APP_KEY e JWT_SECRET.
```sh
 $ php artisan key:generate
 $ php artisan jwt:secret 
```
###### Instalar as dependências do projeto
```sh
 $ cd laravel_jwt
 $ composer install 
```
##### Por fim, verifique se você tem um banco de dados chamado ```db_dev``` e execute o comando abaixo.
```sh
 $ php artisan migrate --seed
```
##### Saída 
```sh
$ php artisan migrate --seed
Migration table created successfully.
Migrating: 2019_04_25_130555_create_companies_table
Migrated:  2019_04_25_130555_create_companies_table
Migrating: 2019_04_25_134500_create_jobs_table
Migrated:  2019_04_25_134500_create_jobs_table
Seeding: CompaniesSeed
Seeding: JobsSeed
Database seeding completed successfully.
```

## Listando rostas
```sh
 $ php artisan route:list
```
##### Saída 
```sh
+--------+-----------+------------------------------+-------------------+--------------------------------------------------+----------------+
| Domain | Method    | URI                          | Name              | Action                                           | Middleware     |
+--------+-----------+------------------------------+-------------------+--------------------------------------------------+----------------+
|        | GET|HEAD  |                              |                   | Closure                                          | web            |
|        | GET|HEAD  | api                          |                   | Closure                                          | api            |
|        | GET|HEAD  | api/                         |                   | Closure                                          | api            |
|        | POST      | api/auth/login               |                   | App\Http\Controllers\AuthController@authenticate | api            |
|        | GET|HEAD  | api/auth/me                  |                   | App\Http\Controllers\AuthController@me           | api,jwt.verify |
|        | POST      | api/companies                | companies.store   | App\Http\Controllers\CompaniesController@store   | api,jwt.verify |
|        | GET|HEAD  | api/companies                | companies.index   | App\Http\Controllers\CompaniesController@index   | api,jwt.verify |
|        | GET|HEAD  | api/companies/create         | companies.create  | App\Http\Controllers\CompaniesController@create  | api,jwt.verify |
|        | GET|HEAD  | api/companies/{company}      | companies.show    | App\Http\Controllers\CompaniesController@show    | api,jwt.verify |
|        | PUT|PATCH | api/companies/{company}      | companies.update  | App\Http\Controllers\CompaniesController@update  | api,jwt.verify |
|        | DELETE    | api/companies/{company}      | companies.destroy | App\Http\Controllers\CompaniesController@destroy | api,jwt.verify |
|        | GET|HEAD  | api/companies/{company}/edit | companies.edit    | App\Http\Controllers\CompaniesController@edit    | api,jwt.verify |
|        | GET|HEAD  | api/jobs                     | jobs.index        | App\Http\Controllers\JobsController@index        | api,jwt.verify |
|        | POST      | api/jobs                     | jobs.store        | App\Http\Controllers\JobsController@store        | api,jwt.verify |
|        | GET|HEAD  | api/jobs/create              | jobs.create       | App\Http\Controllers\JobsController@create       | api,jwt.verify |
|        | PUT|PATCH | api/jobs/{job}               | jobs.update       | App\Http\Controllers\JobsController@update       | api,jwt.verify |
|        | GET|HEAD  | api/jobs/{job}               | jobs.show         | App\Http\Controllers\JobsController@show         | api,jwt.verify |
|        | DELETE    | api/jobs/{job}               | jobs.destroy      | App\Http\Controllers\JobsController@destroy      | api,jwt.verify |
|        | GET|HEAD  | api/jobs/{job}/edit          | jobs.edit         | App\Http\Controllers\JobsController@edit         | api,jwt.verify |
+--------+-----------+------------------------------+-------------------+--------------------------------------------------+----------------+
```
## Teste com [Postman](https://chrome.google.com/webstore/detail/postman/fhbjgbiflinjbdggehcddcbncdddomop?hl=pt-BR)
##### Executando o comandao abaixo para iniciar o sevidor
```sh
 $ php artisan serve
```
##### Uma vez que você já tenha o postman instalado, vamos realizar um request do tipo GET no endpoint ```/api/``` e ver o retorno:
![alt text](https://github.com/willyms/laravel-jwt/blob/master/postman-imagem-01.PNG)

#### Agora, vamos realizar um request do tipo POST no endpoint ```/api/auth/login``` e ver o retorno:
![alt text](https://github.com/willyms/laravel-jwt/blob/master/postman-imagem-02.PNG)
#### O email é gerando automaticamente (confirar na tabela do seu bando de dados), porém a senha é unica 'secret'.
