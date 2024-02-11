CREATE TABLE reservas(
    idreserva INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    criadoEm DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizadoEm DATETIME NULL,
    idusuario INT NOT NULL,
    idsala INT NOT NULL,
    periodo VARCHAR(10) NOT NULL,
 
    FOREIGN KEY (idusuario) REFERENCES usuarios(idusuario),
    FOREIGN KEY (idsala) REFERENCES salas(idsala)
);