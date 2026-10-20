
-- Cria banco se não existir
CREATE DATABASE IF NOT EXISTS app_db;
USE app_db;

-- Cria tabela de posições
CREATE TABLE IF NOT EXISTS position (
    id INT NOT NULL AUTO_INCREMENT,
    description VARCHAR(50) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_position_description (description)
);

-- Cria tabela de usuários
CREATE TABLE IF NOT EXISTS usuario (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    telefone VARCHAR(11) NULL,
    senha VARCHAR(255) NOT NULL,
    position_id INT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY uq_usuario_email (email),
    CONSTRAINT fk_usuario_position
        FOREIGN KEY (position_id)
        REFERENCES position (id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);

-- Cria tabela de notícias
CREATE TABLE IF NOT EXISTS news (
    id BIGINT NOT NULL AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    excerpt VARCHAR(300) NULL,
    content MEDIUMTEXT NOT NULL,
    status ENUM('draft', 'published') NOT NULL DEFAULT 'draft',
    author_id INT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    published_at TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (id),
    KEY idx_news_status_created (status, created_at),
    KEY idx_news_author (author_id),
    CONSTRAINT fk_news_author
        FOREIGN KEY (author_id)
        REFERENCES usuario (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);

-- Insere cargos iniciais sem duplicar registros
INSERT INTO position (description)
VALUES ('Desenvolvedor'), ('Gerente'), ('Analista')
ON DUPLICATE KEY UPDATE description = VALUES(description);

-- Insere usuário inicial se não existir
INSERT INTO usuario (nome, email, telefone, senha, position_id)
SELECT
    'shalom pereira dos santos',
    'shalomsantos@gmail.com',
    '85985013193',
    '$2y$10$4Rj73DXXb/2N6410.zJlhuHUU6DJr2422CKYI1QkwZ1kgJCrEmX2a',
    (SELECT id FROM position WHERE description = 'Desenvolvedor' LIMIT 1)
WHERE NOT EXISTS (
    SELECT 1
    FROM usuario
    WHERE email = 'shalomsantos@gmail.com'
);
