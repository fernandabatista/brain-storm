create schema if not exists`iac`
DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

use iac;

create table if not exists `usuario` (
	ID_Usuario int primary key NOT NULL AUTO_INCREMENT,
    Nome_Usuario varchar(45),
    Senha varchar(100),
    Email varchar(100) unique,
    Imagem varchar (100) default "img/img_default.png",
	Aluno boolean
);

create table if not exists `curso`(
	ID_Curso int primary key NOT NULL AUTO_INCREMENT,
    Nome_Curso varchar(100) unique,
    Tag varchar(7)
);

create table if not exists `disciplina`(
	ID_Disciplina int primary key NOT NULL AUTO_INCREMENT,
    Nome_Disciplina varchar(100),
    ID_Curso int
)DEFAULT CHARSET=utf8;

create table if not exists `assunto`(
	ID_Assunto int primary key NOT NULL AUTO_INCREMENT,
    Nome_Assunto varchar(100),
    ID_Disciplina int
)DEFAULT CHARSET=utf8;


create table if not exists `exercicio`(
	ID_Exercicio int primary key NOT NULL AUTO_INCREMENT,
    titulo varchar(255),
    a1 varchar(100),
    a2 varchar(100),
    a3 varchar(100),
    a4 varchar(100),
    a5 varchar(100),
    Correta tinyint,
    Negativos int default 0,
    Positivos int default 0,
    ID_Assunto int
);


create table if not exists `lista`(

	ID_Lista int primary key NOT NULL AUTO_INCREMENT,
    Nome_Lista varchar(100),
    ID_Assunto int

);
create table if not exists `usuario_has_curso`(
	ID_Usuario int, 
    ID_Curso int, 
    primary key(`ID_Usuario`,`ID_Curso`)
);

create table if not exists `usuario_has_lista`(
	ID_Usuario int,
    ID_Lista int,
	primary key(`ID_Usuario`,`ID_Lista`)
);

create table if not exists `usuario_faz_lista`(
	ID_Faz int auto_increment,
    ID_Usuario int,
    ID_Lista int,
    Data_ date,
    Escore int,
    primary key(`ID_Faz`)
);
create table if not exists `lista_has_exercicio`(
	ID_Exercicio int,
    ID_Lista int,
	primary key(`ID_Exercicio`,`ID_Lista`)
);

create table if not exists `admin`(
	ID_Admin int primary key NOT NULL AUTO_INCREMENT,
    Email_Admin varchar(50) UNIQUE,
    Senha_Admin varchar(50)
);

alter table lista_has_exercicio add foreign key(ID_Lista) references lista (ID_Lista);
alter table lista_has_exercicio add foreign key(ID_Exercicio) references exercicio (ID_Exercicio);
alter table usuario_has_curso add foreign key(ID_Usuario) references Usuario (ID_Usuario);
alter table usuario_has_curso add foreign key(ID_Usuario) references Usuario (ID_Usuario);
alter table usuario_has_lista add foreign key(ID_Usuario) references Usuario (ID_Usuario);
alter table usuario_has_lista add foreign key(ID_Lista) references Lista (ID_Lista);
alter table usuario_faz_lista add foreign key(ID_Usuario) references Usuario (ID_Usuario);
alter table usuario_faz_lista add foreign key(ID_Lista) references Lista (ID_Lista);

alter table disciplina add foreign key(ID_Curso) 
	references Curso (ID_Curso) on delete cascade;
alter table assunto add foreign key(ID_Disciplina)
	references Disciplina (ID_Disciplina) on delete cascade;
alter table exercicio add foreign key(ID_Assunto) 
	references Assunto (ID_Assunto) on delete cascade;
alter table lista add foreign key(ID_Assunto) 
	references Assunto (ID_Assunto) on delete cascade;

insert into curso values (null,"BACHARELADO EM CIENCIA DA COMPUTAÇÃO","BCC");
insert into curso values (null,"ANÁLISE E DESENVOLVIMENTO DE SISTEMAS","TADS");
insert into curso values (null,"INFORMÁTICA BIOMÉDICA","IBM");

INSERT INTO `iac`.`disciplina` (`ID_Disciplina`, `Nome_Disciplina`, `ID_Curso`) VALUES ('1', 'CONSTRUCAO DE COMPILADORES', '1');
INSERT INTO `iac`.`disciplina` (`ID_Disciplina`, `Nome_Disciplina`, `ID_Curso`) VALUES ('2', 'INTELIGENCIA ARTIFICIAL', '1');
INSERT INTO `iac`.`disciplina` (`ID_Disciplina`, `Nome_Disciplina`, `ID_Curso`) VALUES ('3', 'MODELAGEM DE DADOS', '2');
INSERT INTO `iac`.`disciplina` (`ID_Disciplina`, `Nome_Disciplina`, `ID_Curso`) VALUES ('4', 'LINGUAGEM ESTRUTURADA', '2');
INSERT INTO `iac`.`disciplina` (`ID_Disciplina`, `Nome_Disciplina`, `ID_Curso`) VALUES ('5', 'PSICOLOGIA', '2');

INSERT INTO `iac`.`assunto` (`Nome_Assunto`, `ID_Disciplina`) VALUES ('OUTPUTS', '4');
INSERT INTO `iac`.`assunto` (`Nome_Assunto`, `ID_Disciplina`) VALUES ('LAÇOS DE REPETICAO', '4');
INSERT INTO `iac`.`assunto` (`Nome_Assunto`, `ID_Disciplina`) VALUES ('MOTIVAÇÃO', '5');

INSERT INTO `iac`.`admin` (`Email_Admin`, `Senha_Admin`) VALUES ('guabiner@gmail.com', 'banana');

INSERT INTO `iac`.`usuario` (`Nome_Usuario`, `Senha`, `Email`, `Aluno`) VALUES ('Joao Eugenio', '1234', 'j@gmail.com', '0');
INSERT INTO `iac`.`usuario` (`Nome_Usuario`, `Senha`, `Email`, `Aluno`) VALUES ('Alex Kutzke', '123', 'a@gmail.com', '0');
INSERT INTO `iac`.`usuario` (`Nome_Usuario`, `Senha`, `Email`, `Aluno`) VALUES ('Gustavo Abiner', '1234', 'g@gmail.com', '1');
INSERT INTO `iac`.`usuario` (`Nome_Usuario`, `Senha`, `Email`, `Aluno`) VALUES ('Neves', '1234', 'n@gmail.com', '0');
INSERT INTO `iac`.`disciplina` (`ID_Disciplina`, `Nome_Disciplina`, `ID_Curso`) VALUES ('NULL', 'MATEMÁTICA APLICADA', '2');
INSERT INTO `iac`.`assunto` (`Nome_Assunto`, `ID_Disciplina`) VALUES ('DETERMINANTES', '6');
INSERT INTO `iac`.`exercicio` (`titulo`, `a1`, `a2`, `a3`, `a4`, `a5`, `Correta`, `Negativos`, `Positivos`, `ID_Assunto`) VALUES ('Calcule o determinante da seguinte matriz:
\n\r1 0 2\n', '0', '1', '2', '-18', '4', '4', '0', '0', '4');

INSERT INTO `iac`.`usuario_haS_curso` (`ID_Usuario`, `ID_Curso`) VALUES ('3', '1');
INSERT INTO `iac`.`usuario_haS_curso` (`ID_Usuario`, `ID_Curso`) VALUES ('3', '2');

INSERT INTO `iac`.`ASSUNTO` (`Nome_Assunto`, `ID_Disciplina`) VALUES ('EQUAÇÕES DE SEGUNDO GRAU', '6');
INSERT INTO `iac`.`ASSUNTO` (`Nome_Assunto`, `ID_Disciplina`) VALUES ('SENOS E COSSENOS', '6');
INSERT INTO `iac`.`ASSUNTO` (`Nome_Assunto`, `ID_Disciplina`) VALUES ('PRODUTO ESCALAR', '6');
INSERT INTO `iac`.`ASSUNTO` (`Nome_Assunto`, `ID_Disciplina`) VALUES ('MULTIPLICAÇÃO', '6');

INSERT INTO `iac`.`assunto` (`Nome_Assunto`, `ID_Disciplina`) VALUES ('SOMA', '6');

alter table Curso add unique(Nome_Curso);

INSERT INTO CURSO VALUES(NULL,"ESPECIALIZAÇÃO EM ENGENHARIA DE SOFTWARE","ES");
INSERT INTO CURSO VALUES(NULL,"CIÊNCIAS EXATAS",CE);

select * from exercicio;

insert into usuario_faz_lista(ID_Faz,ID_Usuario,ID_Lista) values(null,0,13);
select * from usuario_faz_lista;