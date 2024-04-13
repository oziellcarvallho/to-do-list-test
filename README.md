# To-Do-List

## **Pré-requisitos para a instalação**

- PHP 8.2

## **Instalação**

Copie o arquivo “.env.example” dê no nome “.env” ao novo arquivo e faça a configuração do banco de dados.

Execute os comandos abaixo no termial:
- composer install
- composer dump-autoload
- php artisan config:cache
- php artisan migrate
- php artisan db:seed

## **Execução**

Execute o comando `php artisan serve` no terminal ou use um servidor ngnix ou apache.

## **Usuários pré cadastrados**

| Tipo | E-mail  | Senha |
|--|--|--|
| Super Admin | super@admin.com | 123456 |
| Administrador | admin@test.com | 123456 |
| Usuário | user@test.com | 123456 |