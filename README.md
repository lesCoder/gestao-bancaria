<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Executando a Aplicação
    Esta é uma aplicação simples que cria, realiza e registra operações financeiras em uma conta.
    A implementação é feita utilizando o framework Laravel com testes unitários
# Executando a Aplicação

### Esta aplicação faz uso do sail (Docker) para evitar problemas de "na minha máquina funciona". Vamos aos comandos:
### Sobe os containers.
        ./vendor/bin/sail up
    
### Acesse o container de nome "gestao-bancaria-laravel.test-1" com os comandos abaixo, sendo o primeiro para listar e o segundo para fazer o acesso remoto
        docker container ls
        docker exec -it <ID DO CONTAINER> /bin/bash
    
### Instale as dependências do projeto com docker
        composer install

### Copie o conteúdo do arquivo .env.exemple para o .env

### Rode as migrações
        php artisan migrate

### Rode a suite de testes, ela faz a verificação da aplicação e suas funcionalidades, se tudo passar estamos bem.
        php artisan test

## Endpoint da Aplicação

# 1. Criar uma Conta

Este endpoint permite criar uma nova conta com o número especificado e um saldo inicial.

    URL: POST http://localhost/api/conta

Exemplo do Corpo da Solicitação (JSON):

    {
        "numero_conta": "112233",
        "valor": 500.00
    }

Resposta de Sucesso (HTTP 201 Created):

    {
        "status": true,
        "message": "Conta criada com sucesso!"
    }



# 2. Obter Detalhes da Conta
Este endpoint permite obter os detalhes de uma conta específica com base no ID da conta fornecido.

    URL: GET http://localhost/api/conta/{id}

Parâmetros de URL:

{id}: O ID da conta que deseja consultar.
Resposta de Sucesso (HTTP 200 OK):

    {
        "id": 11,
        "saldo": 500.00
    }

# 3. Realizar uma Transação
Este endpoint permite realizar uma transação financeira em uma conta específica.

    URL: POST http://localhost/api/transacao

Exemplo do Corpo da Solicitação (JSON):

    {
        "conta_id": 11,
        "forma_pagamento": "P",
        "valor": 75
    }

Resposta de Sucesso (HTTP 201 Created):


    {
        "message": "Transação realizada com sucesso.",
        "conta": {
            "numero_conta": "112233",
            "saldo": 65
        }
    }


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
