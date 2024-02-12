CREATE TABLE salas(
    idsala INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    reservado BOOL NOT NULL DEFAULT false,
    listagem ENUM('ativa', 'excluida') NOT NULL DEFAULT 'ativa'
);
