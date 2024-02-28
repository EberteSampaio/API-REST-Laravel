<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Projeto  API-REST em Laravel


## Sobre esse projeto

Olá, sou desenvolvedor back-end e decidi aprimorar meu aprendizado desenvolvendo um API. Optei por desenvolver em php (Laravel) devido ao foco que tenho nesta linguagem desde o começo de 2023.

Motivos:
* O conceito e implementação de uma API estão presentes em diversas empresas, onde acaba se tornando um bom ponto de estudos para se focar.
* APIs facilitam o acesso a dados. Isso é crucial em um mundo onde a troca eficiente de informações é vital para muitos negócios e processos.
* Variedade de usos em um projeto. Seja ele particular ou empresarial.

Neste projeto, tento aplicar um simples CRUD e outras funcionalidades para me familiarizar com projetos que disponibilizam API's.


# Clonar repositório

**Http**:

```
git clone https://github.com/EberteSampaio/API-REST-laravel.git
```

**SSH**:

```
git clone git@github.com:EberteSampaio/API-REST-laravel.git
```

**GitHub CLI**:

```
gh repo clone EberteSampaio/API-REST-laravel

```

## Rotas

**GET**

- Autores

```php
<?php

Route::get('/authors',[AuthorController::class, 'index']);

?>
```

- Gêneros

```php
<?php

Route::get('/genres',[GenreController::class,'index']);

?>
```
- Livros
```php
<?php

Route::get('/books',[BookController::class,'index']);

?>
```





**POST**

- Autores

```php
<?php

Route::post('/authors-store',[AuthorController::class,'store']);

?>
```

- Gêneros


```php
<?php

Route::post('/genres-store',[GenreController::class,'store']);

?>
```

- Livros

```php
<?php

Route::post('/books-store',[BookController::class,'store']);

?>
```




