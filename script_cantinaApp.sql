create database cantinaApp;

use cantinaApp;

create table lanche(
id int not null auto_increment primary key,
nome varchar(45) not null,
preco double not null,
descricao varchar(45)
);

CREATE TABLE funcionario(
  idFuncionario int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome varchar(60) NOT NULL,
  email varchar(60) NOT NULL,
  senha varchar(60) NOT NULL
)

select * from lanche;
select * from funcionario