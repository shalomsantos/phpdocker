-- Cria banco se não existir
CREATE DATABASE IF NOT EXISTS basicus;
USE basicus;

-- Cria tabela de usuários
CREATE TABLE IF NOT EXISTS usuario (
    id INT NOT NULL AUTO_INCREMENT, 
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    telefone VARCHAR(11) NULL,
    senha VARCHAR(20) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (email)  -- evita duplicidade de email
);

-- Insere usuário inicial se não existir
INSERT INTO usuario (nome, email, telefone, senha)
SELECT 'shalom pereira dos santos', 'shalomsantos@gmail.com', '85985013193', '123'
FROM DUAL
WHERE NOT EXISTS (
    SELECT 1
    FROM usuario
    WHERE email = 'shalomsantos@gmail.com'
);
