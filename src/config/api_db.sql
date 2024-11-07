CREATE DATABASE api_db;

USE api_db;

CREATE TABLE Cliente(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    telefone VARCHAR(20)
);

CREATE TABLE Funcionario(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cargo VARCHAR(100),
    salario DOUBLE
);

CREATE TABLE Mesa(
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    cargo VARCHAR(100),
    status VARCHAR(20),
    id_cliente INT,
    FOREIGN KEY (id_cliente) REFERENCES Cliente(id) ON DELETE SET NULL
);

CREATE TABLE Pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    status VARCHAR(50),
    preco_total DOUBLE,
    id_funcionario INT,
    id_mesa INT,
    FOREIGN KEY (id_funcionario) REFERENCES Funcionario(id) ON DELETE SET NULL,
    FOREIGN KEY (id_mesa) REFERENCES Mesa(id) ON DELETE CASCADE
);

CREATE TABLE Item_pedido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    descricao VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    id_pedido INT,
    FOREIGN KEY (id_pedido) REFERENCES Pedido(id) ON DELETE CASCADE
);



