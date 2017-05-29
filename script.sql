
create schema if not exists`iac`
DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

use iac;

create table if not exists `usuario` (
	ID_Usuario int primary key NOT NULL AUTO_INCREMENT,
    Nome_Usuario varchar(45),
    Senha varchar(45),
    Email varchar(45),
    Imagem varchar (100)

);

create table if not exists `professor`(
	ID_Professor int primary key

);

create table if not exists `aluno`(
	ID_Aluno int primary key

);

create table if not exists `curso`(
	ID_Curso int primary key NOT NULL AUTO_INCREMENT,
    Nome_curso varchar(45)
);
create table if not exists `disciplina`(
	ID_Disciplina int primary key NOT NULL AUTO_INCREMENT,
    Nome_disciplina varchar(45),
    ID_Curso int
)DEFAULT CHARSET=utf8;
create table if not exists `assunto`(
	ID_assunto int primary key NOT NULL AUTO_INCREMENT,
    Nome_assunto varchar(45),
    ID_Disciplina int
)DEFAULT CHARSET=utf8;
create table if not exists `exercicio`(
	ID_Exercicio int primary key NOT NULL AUTO_INCREMENT,
    titulo varchar(45),
    a1 varchar(100),
    a2 varchar(100),
    a3 varchar(100),
    a4 varchar(100),
    a5 varchar(100),
    Correta tinyint,
    Negativos int,
    Positivos int,
    ID_Assunto int
);
create table if not exists `lista`(

	ID_Lista int primary key NOT NULL AUTO_INCREMENT,
    Nome_Lista varchar(45),
    ID_Assunto int

);
create table if not exists `usuario_has_curso`(
	ID_Usuario int,
    ID_Curso int,
    primary key(`ID_Usuario`,`ID_Curso`)
);

create table if not exists `aluno_has_lista`(
	ID_Usuario int,
    ID_Lista int,
	primary key(`ID_Usuario`,`ID_Lista`)
);

create table if not exists `aluno_faz_lista`(
	-- ID_Faz int auto_increment,
    ID_Usuario int,
    ID_Lista int,
    Data_ date,
    Escore int,
    primary key(`ID_Usuario`,`ID_Lista`)
);
create table if not exists `lista_has_exercicio`(
	ID_Exercicio int,
    ID_Lista int,
	primary key(`ID_Exercicio`,`ID_Lista`)
);
alter table aluno add foreign key(ID_Aluno) references usuario (ID_Usuario);
alter table professor add foreign key(ID_Professor) references usuario (ID_Usuario);
alter table lista_has_exercicio add foreign key(ID_Lista) references lista (ID_Lista);
alter table lista_has_exercicio add foreign key(ID_Exercicio) references exercicio (ID_Exercicio);
alter table usuario_has_curso add foreign key(ID_Usuario) references Usuario (ID_Usuario);
alter table usuario_has_curso add foreign key(ID_Usuario) references Usuario (ID_Usuario);
alter table aluno_has_lista add foreign key(ID_Usuario) references Aluno (ID_Aluno);
alter table aluno_has_lista add foreign key(ID_Lista) references Lista (ID_Lista);
alter table aluno_faz_lista add foreign key(ID_Usuario) references Aluno (ID_Aluno);
alter table aluno_faz_lista add foreign key(ID_Lista) references Lista (ID_Lista);

alter table disciplina add foreign key(ID_Curso) references Curso (ID_Curso);
alter table assunto add foreign key(ID_Disciplina) references Disciplina (ID_Disciplina);
alter table exercicio add foreign key(ID_Assunto) references Assunto (ID_Assunto);
alter table lista add foreign key(ID_Assunto) references Assunto (ID_Assunto);

alter table curso add column tag varchar(7) not null default "";
insert into curso values (null,"BACHARELADO EM CIENCIA DA COMPUTA��O","BCC");
insert into curso values (null,"BACHARELADO EM SISTEMAS DE INFORMA��O","BSI");
insert into curso values (null,"BACHARELADO EM CIENCIA DA COMPUTA��O","BCC");
