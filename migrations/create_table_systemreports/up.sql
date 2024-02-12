CREATE TABLE systemreports(
  idreport INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  nome VARCHAR(50) NOT NULL,
  descricao TEXT NOT NULL,
  type ENUM("problema", "sugestao"),
  from_page TEXT NOT NULL
);