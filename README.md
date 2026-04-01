


Teste Backend PHP – Versotech realizado por Marcel

🛠 Ferramentas utilizadas
Docker: para criar o ambiente isolado e rodar o Laravel sem depender de XAMPP.

Docker Compose: para orquestrar o container da aplicação.

PHP 8.2: versão utilizada no container.

Composer: para instalar dependências do Laravel.

SQLite: banco de dados utilizado, simples e compatível com o teste.

Laravel: framework PHP para construção da API.

🚀 Como rodar o projeto

1. Clonar o repositório
git clone -b desenvolvimento https://github.com/MarcelFinavaro/teste-backend-php.git .


2. Subir os containers
Na raiz do projeto:
docker-compose up -d

3. Instalar dependências
Entrar no container:
docker-compose run app bash
composer install

4. Configurar ambiente
Copiar o arquivo de exemplo:
cp .env.example .env

Editar .env para usar SQLite:
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite

Criar o arquivo do banco:
touch database/database.sqlite

5. Inicializar aplicação
Dentro do container:
php artisan key:generate
php artisan migrate

Sair do container e reiniciar:
exit
docker-compose up -d


## População das tabelas base

O projeto já contém seeders para inserir os dados de exemplo nas tabelas `produtos_base` e `precos_base`.

### Executar os seeders

Dentro do container, rode:

```bash
php artisan db:seed --class=ProdutosBaseSeeder
php artisan db:seed --class=PrecosBaseSeeder

Isso irá inserir os 12 produtos e os 12 preços conforme o enunciado do teste.

### 3. Testar direto no banco
Depois de rodar os seeders, você pode verificar os dados:

- Usando o **artisan tinker**:
  ```bash
  php artisan tinker
  >>> DB::table('produtos_base')->get();
  >>> DB::table('precos_base')->get();

Ou direto no SQLite:
sqlite3 database/database.sqlite
sqlite> SELECT * FROM produtos_base;
sqlite> SELECT * FROM precos_base;



🌐 Endpoints da API
Sincronizar produtos  
POST /api/sincronizar/produtos

Sincronizar preços  
POST /api/sincronizar/precos

Listar produtos com preços (paginado)  
GET /api/produtos-precos?page=1&per_page=10


✅ Testes
Rodar os testes automatizados dentro do container:
php artisan test




