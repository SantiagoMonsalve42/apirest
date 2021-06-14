create database proyecto;

use proyecto;

create table tipo_documento(
id_tipo_documento int AUTO_INCREMENT,
tipo_documento varchar(75) NOT NULL UNIQUE ,
primary key (id_tipo_documento)
);
ALTER TABLE tipo_documento AUTO_INCREMENT=650;

create table cargo(
id_cargo int AUTO_INCREMENT,
descripcion_cargo varchar(75) NOT NULL UNIQUE,
primary key (id_cargo)
);
ALTER TABLE tipo_documento AUTO_INCREMENT=9950;

create table empresa(
id_empresa int AUTO_INCREMENT,
id_tipo_documento int,
numero_documento int NOT NULL UNIQUE,
nombre varchar(50) NOT NULL,
correo varchar(50) NOT NULL ,
telefono int NOT NULL,
primary key(id_empresa),
FOREIGN KEY (id_tipo_documento) REFERENCES tipo_documento(id_tipo_documento)
);
ALTER TABLE empresa AUTO_INCREMENT=7000;


create table persona(
id_persona int AUTO_INCREMENT,
id_tipo_documento int,
id_cargo int,
id_empresa int,
numero_documento int UNIQUE,
nombre1 varchar(50) NOT NULL,
nombre2 varchar(50),
apellido1 varchar(50) NOT NULL,
apellido2 varchar(50),
correo varchar(75) NOT NULL UNIQUE ,
fecha_nacimiento date NOT NULL,
primary key (id_persona),
FOREIGN KEY (id_tipo_documento) REFERENCES tipo_documento(id_tipo_documento),
FOREIGN KEY (id_cargo) REFERENCES cargo(id_cargo),
FOREIGN KEY (id_empresa) REFERENCES empresa(id_empresa)
);
ALTER TABLE persona AUTO_INCREMENT=10000;

create table experiencia_laboral(
id_experiencia_laboral int AUTO_INCREMENT,
id_persona int,
descripcion varchar(75) NOT NULL,
fecha_inicio date NOT NULL,
fecha_final date NOT NULL, 
primary key (id_experiencia_laboral),
FOREIGN KEY (id_persona) REFERENCES persona(id_persona)
);
ALTER TABLE experiencia_laboral AUTO_INCREMENT=1;

create table institucion_educativa(
id_institucion_educativa int AUTO_INCREMENT,
nombre varchar(75) NOT NULL,
primary key (id_institucion_educativa)
);
ALTER TABLE institucion_educativa AUTO_INCREMENT=10000;

create table estudios(
id_estudios int AUTO_INCREMENT,
id_persona int,
id_institucion_educativa int,
descripcion varchar(75) NOT NULL,
fecha_inicio date NOT NULL,
fecha_final date NOT NULL,
primary key (id_estudios),
FOREIGN KEY (id_persona) REFERENCES persona(id_persona),
FOREIGN KEY (id_institucion_educativa) REFERENCES institucion_educativa(id_institucion_educativa)
);
ALTER TABLE estudios AUTO_INCREMENT=10;



