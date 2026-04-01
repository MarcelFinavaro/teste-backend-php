


Teste Backend PHP – Versotech
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





# Teste Técnico – Desenvolvedor PHP Laravel

## Objetivo

Desenvolver uma aplicação backend responsável pelo processamento, transformação e sincronização de dados de produtos e preços, utilizando Views SQL para padronização das informações e disponibilizando os dados por meio de uma API REST.

---

## Requisitos Técnicos

Tecnologias obrigatórias:

* PHP 8.0+
* Laravel 11.0+
* SQLite
* Docker
* Docker Compose

---

## Restrições Obrigatórias

O projeto deve:

* Rodar integralmente via Docker.
* Possuir arquivo `docker-compose.yml`.
* Expor exclusivamente endpoints de API REST.
* Conter testes automatizados.
* Incluir instruções de execução no `README.md`.
* Documentar os endpoints disponíveis.

O projeto não deve:

* Exigir instalação de dependências na máquina host além do Docker.
* Conter qualquer tipo de interface web.

---

## Modelagem de Banco de Dados

### Tabelas de Origem

Devem ser criadas duas tabelas base:

* `produtos_base`
* `precos_base`

O script de criação das tabelas base encontra-se na raiz do projeto.

### Tabelas de Destino

Devem ser criadas duas tabelas para armazenamento dos dados processados:

* `produto_insercao`
* `preco_insercao`

Considere modelagem adequada, chaves e índices quando necessário.

---

## Processamento com Views SQL

A transformação dos dados deve ser realizada obrigatoriamente por meio de Views SQL.

Devem ser criadas:

* Uma View para produtos.
* Uma View para preços.

As Views devem contemplar:

* Normalização dos dados.
* Processamento apenas de registros ativos.

---

## Processo de Sincronização

A sincronização deve:

* Consumir os dados a partir das Views.
* Inserir, atualizar ou remover registros nas tabelas de destino.
* Evitar duplicidade.
* Evitar operações desnecessárias.

---

## API REST

A aplicação deve disponibilizar os seguintes endpoints:

### Sincronizar Produtos

POST /api/sincronizar/produtos

Executa o processo de transformação e sincronização dos dados de `produtos_base` para `produto_insercao`.

---

### Sincronizar Preços

POST /api/sincronizar/precos

Executa o processo de transformação e sincronização dos dados de `precos_base` para `preco_insercao`.

---

### Listar Produtos Sincronizados (Paginado)

GET /api/produtos-precos

Deve retornar os produtos processados com seus respectivos preços de forma paginada.
A paginação deve aceitar parâmetros de controle via query string.

---

## Como executar o projeto?

{Esta seção deve ser preenchida pelo candidato com as instruções necessárias para execução da aplicação.}
