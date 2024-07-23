CREATE TABLE tarefas (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    prioridade VARCHAR(55) NOT NULL,
    done ENUM('Pendente', 'Concluída') DEFAULT 'Pendente',
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
