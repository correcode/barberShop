-- Criando o bano de dados
CREATE DATABASE IF NOT EXISTS barbearia;
USE barbearia;

-- Tabela de usuarios (barbeiros e admins)
CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  senha VARCHAR(100) NOT NULL, -- Senha sera armazenada criptografada
  tipo ENUM('admin', 'barbeiro') NOT NULL, -- Define se e admin ou barbeiro
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de clientes
CREATE TABLE  clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  telefone VARCHAR(20) NOT NULL,
  email VARCHAR(100) UNIQUE NULL,
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de servicos
CREATE TABLE servicos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  descricao TEXT,
  preco DECIMAL(10,2) NOT NULL,
  duracao INT NOT NULL, -- Duracao do servico em minutos
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de agendamentos 
CREATE TABLE agendamentos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  cliente_id INT NOT NULL,
  barbeiro_id INT NOT NULL,
  servico_id INT NOT NULL,
  data_hora DATETIME NOT NULL,
  status ENUM('pendente', 'confirmado', 'cancelado') DEFAULT 'pendente',
  criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
  FOREIGN KEY (barbeiro_id) REFERENCES usuarios(id) ON DELETE CASCADE,
  FOREIGN KEY (servico_id) REFERENCES servicos(id) ON DELETE CASCADE
);

-- Inserindo um usuario admin padrao
INSERT INTO usuarios (nome, email, senha, tipo)
VALUE ('Admin,' 'admin@barbearia.com', MD5('admin123'), 'admin');
