# 📦 Sistema de Controle de Vendas e Estoque

Este projeto é uma aplicação **Single Page Application (SPA)** desenvolvida com **Laravel 10.10**, **Vue.js**, criada para a disciplina de **Programação Web**. Essa é uma aplicação de gerenciamento de vendas e estoque de produtos, com autenticação e controle de permissões de usuários.

## ⚙️ Requisitos

- PHP >= 8.1
- Composer
- Node.js e NPM
- Laravel >= 10.10
- Vue.js 3
- MySQL ou PostgreSQL

## 🏗️ Estrutura e Tecnologias

O sistema foi desenvolvido com base na arquitetura **MVC com Repository Pattern**, promovendo separação de responsabilidades e facilitando a manutenção do código.

- **Laravel Breeze**: Implementa autenticação com Vue e Inertia  
- **Vue.js**: Interface interativa e reativa  
- **Inertia.js**: Integração entre Laravel e Vue sem uso de APIs REST  
- **Autenticação com controle de permissões**`  

## 🧩 Entidades do Sistema

- **Cliente**  
- **Endereço**  
- **Fornecedor**  
- **Produto**  
- **Funcionário**  
- **Venda**  
- **User** (usuários do sistema)  
- **Role** (perfis de permissão)  

## 🖼️ Imagens do Sistema

### 🔹 Dashboard (Dashboard)
![Dashboard](public/screenshots/dashinicial.png)

### 🔹 Tela Inicial da Aplicação
![Login](public/screenshots/telainicial.png)

### 🔹 Tela Login 
![Login](public/screenshots/telalogin.png)

### 🔹 Tela Registro 
![Registro](public/screenshots/telacadastro.png)

### 🔹 Tela de Funcionários
![Funcionários](public/screenshots/telafuncionarios.png)

#### Cadastro de Funcionário
![Cadastro Funcionário](public/screenshots/cadastrofuncionario.png)

#### Edição do Funcionário
![Editar Funcionário](public/screenshots/editarfuncionario.png)

#### Detalhes do Funcionário
![Detalhe Funcionário](public/screenshots/detalhefuncionario.png)

### 🔹 Tela de Fornecedores
![Fornecedores](public/screenshots/telafornecedores.png)

#### Cadastro de Fornecedor
![Cadastro Fornecedor](public/screenshots/cadastrofornecedor.png)

#### Edição do Fornecedor
![Editar Fornecedor](public/screenshots/editarfornecedor.png)

#### Detalhes do Fornecedor
![Detalhe Fornecedor](public/screenshots/detalhefornecedor.png)

### 🔹 Tela de Produtos
![Produtos](public/screenshots/telaprodutos.png)

#### Cadastro de Produtos
![Cadastro Produtos](public/screenshots/cadastroproduto.png)

#### Edição de Produtos
![Editar Produtos](public/screenshots/editarproduto.png)

#### Detalhes de Produtos
![Detalhe Produtos](public/screenshots/detalheproduto.png)

### 🔹 Tela de Vendas
![Vendas](public/screenshots/telavendas.png)

#### Detalhe das Vendas
![Detalhe Vendas](public/screenshots/detalhevendas.png)

### 🔹 Funcionalidades Extras

#### Filtro de Registros

![Filtro de Registros](public/screenshots/filtro.png)

#### Exclusão de Registros

![Exclusão de Registros](public/screenshots/apagarregistro.png)

#### Tela de Edição de Perfil

![Edição Perfil](public/screenshots/telauser.png)

## 🔐 Autenticação e Permissões

A autenticação é feita via Laravel Breeze com Vue + Inertia.

## 🚀 Como rodar o projeto

- Depois de clonar o repositório certifique-se de criar e configurar o arquivo .env para conectar com o banco.

```bash
# Clonar o repositório
git clone https://github.com/DuduHenriqueMg/seu-projeto.git
cd seu-projeto

# Instalar as dependências PHP
composer install

# Instalar as dependências do Node
npm install

# Copiar o arquivo de .env.exemaple e configurar o .env
cp .env.example .env
php artisan key:generate

# Rodar as migrations e o DatabaseSeeder
php artisan migrate --seed

# Rodar o ambiente JS
npm run dev

# Rodar o projetto
php artisan serve
