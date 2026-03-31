-- Cria banco se não existir
CREATE DATABASE IF NOT EXISTS app_db;
USE app_db;

-- 1. Cria tabela de posições (Cargos) primeiro
CREATE TABLE IF NOT EXISTS position (
    id INT NOT NULL AUTO_INCREMENT, 
    description VARCHAR(50) NOT NULL,
    PRIMARY KEY (id)
);
-- Cria tabela de usuários
CREATE TABLE IF NOT EXISTS usuario (
    id INT NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    telefone VARCHAR(11) NULL,
    senha VARCHAR(20) NOT NULL,
    position_id INT,
    PRIMARY KEY (id),
    UNIQUE KEY (email)  -- evita duplicidade de email
);
-- Insere cargos iniciais
INSERT INTO position (description) VALUES ('Desenvolvedor'), ('Gerente'), ('Analista');

-- Insere usuário inicial se não existir (novo -> position: 'desenvolvedor')
INSERT INTO usuario (nome, email, telefone, senha, position_id)
SELECT 'shalom pereira dos santos', 'shalomsantos@gmail.com', '85985013193', '123', 1
FROM DUAL
WHERE NOT EXISTS (
    SELECT 1 FROM usuario WHERE email = 'shalomsantos@gmail.com'
);