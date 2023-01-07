CREATE DATABASE gerenciadorTarefas

GO

USE gerenciadorTarefas

GO

CREATE TABLE tasks (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    task_name VARCHAR(150) ,
    task_description VARCHAR(150),
    task_image VARCHAR(100),
    task_date DATE
)
GO

INSERT INTO `tasks` (`id`, `task_name`, `task_description`, `task_image`, `task_date`) VALUES (NULL, 'teste', 'teste de descriçao', NULL, '2022-01-01'), (NULL, 'teste 2', 'teste 2 descricao', NULL, '2022-01-31')
