
# BarberShop

Sistema de gerenciamento para barbearias, desenvolvido em PHP com conexão a um banco de dados MySQL.

## 📋 Descrição

Este projeto visa facilitar o gerenciamento de clientes, serviços e agendamentos em uma barbearia.
Possui funcionalidades como cadastro de usuários (administradores e barbeiros), clientes, serviços oferecidos e agendamentos com diferentes status (pendente, confirmado, cancelado).

## 🛠️ Tecnologias Utilizadas

- **PHP**: Linguagem principal para o desenvolvimento do backend.
- **MySQL**: Banco de dados relacional para armazenamento das informações.
- **PDO (PHP Data Objects)**: Utilizado para a conexão segura com o banco de dados.
- **HTML/CSS**: Para a estrutura e estilização das páginas.
- **MD5**: Para criptografar as senhas dos usuários (recomenda-se substituir por `password_hash` para maior segurança).

## 📁 Estrutura do Projeto

```
barberShop/
├── Barbearia/
│   ├── config.php
│   ├── login.php
│   ├── painel.php
│   ├── clientes.php
│   ├── servicos.php
│   ├── agendamentos.php
│   └── ...
├── database_barber.sql
├── README.md
```

- `config.php`: Arquivo de configuração para conexão com o banco de dados.
- `login.php`: Página de login que valida o usuário e inicia a sessão.
- `painel.php`: Painel principal após o login, com acesso às funcionalidades do sistema.
- `clientes.php`: Gerenciamento de clientes.
- `servicos.php`: Gerenciamento de serviços oferecidos.
- `agendamentos.php`: Gerenciamento de agendamentos.
- `database_barber.sql`: Script SQL para criação do banco de dados.

## 🚀 Como Executar

1. Clone o repositório:

```bash
git clone https://github.com/correcode/barberShop.git
```

2. Importe o arquivo `database_barber.sql` em seu servidor MySQL para criar o banco de dados necessário.

3. Configure o arquivo `config.php` com as credenciais do seu banco de dados:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'nome_do_banco');
define('DB_USER', 'usuario');
define('DB_PASS', 'senha');
```

4. Coloque os arquivos do projeto em seu servidor web (por exemplo, Apache) e acesse `login.php` para iniciar o sistema.

## 🔐 Segurança

- As senhas dos usuários são criptografadas utilizando MD5. Para maior segurança, é recomendável utilizar `password_hash` e `password_verify` do PHP.
- As sessões são utilizadas para manter o estado de autenticação do usuário.

## 👨‍💻 Autor

- GitHub: [correcode](https://github.com/correcode)

---

Este sistema é uma solução prática para o gerenciamento de barbearias, facilitando o controle de clientes, serviços e agendamentos.
