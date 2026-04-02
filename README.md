# Teste Técnico – Desenvolvedor PHP Laravel

## 📋 Sobre o Projeto

API REST desenvolvida em Laravel 11 para processamento, transformação e sincronização de dados de produtos e preços, utilizando Views SQL para padronização das informações.

### 🎯 Funcionalidades

- Sincronização de produtos da tabela base para tabela de destino
- Sincronização de preços da tabela base para tabela de destino
- Listagem paginada de produtos com seus respectivos preços
- Processamento via Views SQL com normalização de dados
- Filtros por categoria e faixa de preço

## 🛠️ Tecnologias Utilizadas

- **PHP 8.2**
- **Laravel 11**
- **SQLite**
- **Docker**
- **Docker Compose**

## 📦 Estrutura do Banco de Dados

### Tabelas Base (Origem)
| Tabela | Descrição |
|--------|-----------|
| `produtos_base` | Dados brutos dos produtos |
| `precos_base` | Dados brutos dos preços |

### Tabelas de Destino
| Tabela | Descrição |
|--------|-----------|
| `produto_insercao` | Produtos processados e sincronizados |
| `preco_insercao` | Preços processados e sincronizados |

### Views SQL
| View | Descrição |
|------|-----------|
| `view_produtos` | Produtos normalizados (apenas ativos) |
| `view_precos` | Preços normalizados (apenas ativos com valores válidos) |

## 🚀 Como Executar o Projeto

### Pré-requisitos

- [Docker](https://www.docker.com/products/docker-desktop/)
- [Docker Compose](https://docs.docker.com/compose/install/)

#### 1. Clone o repositório

https://github.com/MarcelFinavaro/teste-backend-php.git

observação: utilizar a branche "desenvolvimento" a branche main permanece o teste original. 

2. Suba os containers Docker
docker-compose up -d

3. Acesse o container
docker exec -it laravel_app bash

4. Instale as dependências do Composer
composer install

5. Configure o ambiente

cp .env.example .env
php artisan key:generate

6. Execute as migrations e seeders
php artisan migrate
php artisan db:seed

7. Inicie o servidor
php artisan serve --host=0.0.0.0 --port=8000

8. Acesse a API
A API estará disponível em: http://localhost:8000/api

🧪 Testando a API
Você pode testar os endpoints utilizando curl ou ferramentas como Postman/Insomnia.

# Teste de conexão
curl http://localhost:8000/api/hello

# Sincronizar produtos
curl -X POST http://localhost:8000/api/sincronizar/produtos

# Sincronizar preços
curl -X POST http://localhost:8000/api/sincronizar/precos

# Listar produtos com preços (paginado)
curl "http://localhost:8000/api/produtos-precos?per_page=10&page=1"

# Com filtros
curl "http://localhost:8000/api/produtos-precos?categoria=COMPONENTES&preco_min=500&preco_max=2000"

📚 Documentação da API
Endpoints
1. Sincronizar Produtos
POST /api/sincronizar/produtos

Executa a sincronização dos produtos da tabela base para a tabela de destino.

Resposta de sucesso:
{
    "success": true,
    "message": "Produtos sincronizados com sucesso",
    "total_processados": 20
}

2. Sincronizar Preços
POST /api/sincronizar/precos

Executa a sincronização dos preços da tabela base para a tabela de destino.

Resposta de sucesso:
{
    "success": true,
    "message": "Preços sincronizados com sucesso",
    "total_processados": 20
}

3. Listar Produtos com Preços
GET /api/produtos-precos

Retorna lista paginada de produtos com seus respectivos preços.

Parâmetros (query string):

Parâmetro	Tipo	Default	Descrição
per_page	int	15	Número de itens por página
page	int	1	Número da página
categoria	string	-	Filtro por categoria
preco_min	float	-	Preço mínimo
preco_max	float	-	Preço máximo

Resposta de sucesso:

{
    "success": true,
    "data": [
        {
            "id": 1,
            "codigo": "PRD001",
            "nome": "Teclado Mecânico RGB",
            "categoria": "PERIFERICOS",
            "descricao": "Teclado com iluminação RGB e switches azuis",
            "preco": 499.9,
            "moeda": "BRL"
        }
    ],
    "pagination": {
        "current_page": 1,
        "last_page": 2,
        "per_page": 10,
        "total": 20,
        "from": 1,
        "to": 10
    }
}

🧪 Testes Automatizados
Para executar os testes:
docker exec -it laravel_app php artisan test

📊 Estrutura do Projeto

teste-backend-php/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── SincronizacaoController.php
│   └── Models/
│       ├── ProdutoBase.php
│       ├── PrecoBase.php
│       ├── ProdutoInsercao.php
│       └── PrecoInsercao.php
├── database/
│   ├── migrations/
│   │   ├── [migrations das tabelas base e destino]
│   │   └── [migrations das views SQL]
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── ProdutosBaseSeeder.php
│       └── PrecosBaseSeeder.php
├── routes/
│   └── api.php
├── docker-compose.yml
├── Dockerfile
└── README.md

🔍 Validação dos Requisitos
Requisito	Status	Descrição
PHP 8.0+	✅	PHP 8.2
Laravel 11.0+	✅	Laravel 11
SQLite	✅	Banco de dados SQLite
Docker	✅	Container configurado
Docker Compose	✅	docker-compose.yml
API REST	✅	Endpoints exclusivamente REST
Views SQL	✅	view_produtos e view_precos
Sincronização	✅	Sem duplicidade, apenas ativos
Paginação	✅	Via query string
Testes	✅	Estrutura de testes configurada

👨‍💻 Autor
Marcel Finavaro
Desenvolvido como parte de teste técnico para vaga de Desenvolvedor para Implantação de Sistemas (PHP + SQL)