# 🚗 Projeto API de Carros - Laravel 12

Este projeto é uma API RESTful construída em **Laravel 12** para gerenciamento de carros, se quiser testa-lá e só acessar [API_CARROS](https://homeat.space/api/cars) e abaixos estão os seus endpoints📍.

| Método | Rota             | Protegida | Descrição                                 |
| ------ | ---------------- | --------- | ----------------------------------------- |
| POST   | `/api/register`  | ❌         | Registrar um novo usuário                 |
| POST   | `/api/login`     | ❌         | Login do usuário e geração de token       |
| DELETE   | `/api/logout`    | ✅         | Logout do usuário (revoga token)          |
| GET    | `/api/cars`      | ✅         | Listar todos os carros                    |
| POST   | `/api/cars`      | ✅         | Criar um novo carro                       |
| GET    | `/api/cars/{id}` | ❌         | Mostrar detalhes de um carro específico   |
| PUT    | `/api/cars/{id}` | ✅         | Atualizar totalmente um carro existente   |
| PATCH  | `/api/cars/{id}` | ✅         | Atualizar parcialmente um carro existente |
| DELETE | `/api/cars/{id}` | ✅         | Deletar um carro                          |

---

## ⚙️ Requisitos

- PHP >= 8.2
- Composer
- MySQL ou MariaDB
- Node.js & NPM
- Laravel 12

---

## 🔧 Instalação Local

1. **Clonar o repositório**

   ```bash
   git clone https://github.com/maxwillias/api_carros.git
   cd api_carros
   ```
   
2. **Instale as dependências**

   ```bash
   composer install
   npm install
   ```
    
3. **Copie o arquivo de configuração**

   ```bash
   cp .env.example .env
   ```  

4. **Gere a chave da aplicação**

   ```bash
   php artisan key:generate
   ```  

5. **Configure o banco de dados na .env**

   ```bash
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_api
   DB_USERNAME=root
   DB_PASSWORD=secret
   ```  

6. **Rode as migrations**

   ```bash
   php artisan migrate
   ```  

7. **Rode o comando**

   ```bash
   php artisan sync:cars
   ```  

8. **Inicie o servidor**

   ```bash
   php artisan serve
   ```

A API estará disponível em:
👉 http://127.0.0.1:8000/api/cars

**Rotas de autenticação**

1. **Registrar usuário**  
    POST http://127.0.0.1:8000/api/register  
    Body (JSON):
   ```bash
   {
      "name": "Seu Nome",
      "email": "usuario@teste.com",
      "password": "123456",
      "password_confirmation": "123456"
   }
   ```
   
    Retorno (JSON)
   ```bash
   {
      "user": {
        "id": 1,
        "name": "Seu Nome",
        "email": "usuario@teste.com",
        "created_at": "...",
        "updated_at": "..."
      },
      "token": "SEU_TOKEN_GERADO_PELO_SANCTUM"
    }
   ```
3. **Fazer login**  
    POST http://127.0.0.1:8000/api/login  
    Body (JSON):
   ```bash
   {
      "email": "usuario@teste.com",
      "password": "123456",
   }
   ```
   
    Retorno (JSON)
   ```bash
   {
      "user": {
        "id": 1,
        "name": "Seu Nome",
        "email": "usuario@teste.com",
        "email_verified_at": null,
        "created_at": "...",
        "updated_at": "..."
      },
      "token": "SEU_TOKEN_GERADO_PELO_SANCTUM"
    }
   ```
4. **Logout**  
   DELETE http://127.0.0.1:8000/api/logout  
    Retorno (JSON)
   ```bash
   {
    "message": "Você está deslogado."
   }
   ```

**Como rodar o script de deploy**  

Depois de ter o seu EC2 configurado e com seu projeto laravel nele, basta seguir as seguinte instruções:  

1. **Dar permissão de execução**
   ```bash
   chmod +x deploy.sh
   ```
2.**Preencher variavéis na .env**
   ```bash
    USER=SEU_USUÁRIO
    HOST=SEU_HOST_OU_IP
    APP_PATH=/var/www/seu_projeto
    SSH_KEY_PATH=~/.ssh/sua_chave.pem
   ```    
3.**Rodar o deploy**  
   ```bash
    ./deploy.sh
   ```

