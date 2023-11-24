-- teste

-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS crowdfunding_db; 
USE crowdfunding_db;

-- Tabela de Usuários
CREATE TABLE IF NOT EXISTS users (
    id_user INT NOT NULL AUTO_INCREMENT,        -- Identificador único para cada usuário (chave primária).
    username VARCHAR(255) NOT NULL,             -- Nome de usuário do usuário.
    email VARCHAR(255) NOT NULL,                -- Endereço de e-mail do usuário.
    password VARCHAR(255) NOT NULL,             -- Senha do usuário.
    user_type VARCHAR(50) NOT NULL,             -- Tipo de usuário (criador ou apoiador).
    notification_preference VARCHAR(255),       -- Preferência de notificação do usuário.
    PRIMARY KEY (id_user)
);

-- Tabela de Projetos
CREATE TABLE IF NOT EXISTS projects (
    id_project INT NOT NULL AUTO_INCREMENT,         -- Identificador único para cada projeto (chave primária).
    name VARCHAR(255) NOT NULL,                     -- Nome do projeto.
    description TEXT NOT NULL,                      -- Descrição detalhada do projeto.
    state VARCHAR(255) NOT NULL,                    -- Estado onde o projeto está localizado.
    city VARCHAR(255) NOT NULL,                     -- Cidade onde o projeto está localizado.
    profitability DECIMAL(10, 2) NOT NULL,          -- Rentabilidade estimada do projeto.
    deadline DATE NOT NULL,                         -- Data de prazo final para o projeto.
    financial_goal DECIMAL(10, 2) NOT NULL,         -- Meta financeira estabelecida para o projeto.
    raised_amount DECIMAL(10, 2) DEFAULT 0,         -- Valor captado até o momento (inicializado com 0).
    completion_percentage DECIMAL(10, 2) DEFAULT 0, -- Percentual de conclusão do projeto (inicializado com 0).
    updates TEXT,                                   -- Atualizações do projeto.
    PRIMARY KEY (id_project)
);

-- Tabela de Contribuições
CREATE TABLE IF NOT EXISTS contributions (
    id_contribuicao INT NOT NULL AUTO_INCREMENT,        -- Identificador único para cada contribuição (chave primária).
    contribution_date DATE NOT NULL,                    -- Data em que a contribuição foi feita.
    amount DECIMAL(10, 2) NOT NULL,                     -- Valor da contribuição.
    selected_reward VARCHAR(255),                       -- Recompensa selecionada pelo apoiador.
    id_user INT NOT NULL,                               -- ID do apoiador que fez a contribuição (chave estrangeira referenciando `users`).
    id_project INT NOT NULL,                            -- ID do projeto que recebeu a contribuição (chave estrangeira referenciando `projects`).
    PRIMARY KEY (id_contribuicao),
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_project) REFERENCES projects(id_project)
);

-- -- Tabela de Recompensas
-- CREATE TABLE IF NOT EXISTS rewards (
--     id_rewards INT NOT NULL AUTO_INCREMENT,          -- Identificador único para cada recompensa (chave primária).
--     reward_name VARCHAR(255) NOT NULL,               -- Nome da recompensa.
--     id_project INT NOT NULL,                         -- ID do projeto associado à recompensa (chave estrangeira referenciando `projects`).
--     PRIMARY KEY (id_rewards),
--     FOREIGN KEY (id_project) REFERENCES projects(id_project)
-- );
