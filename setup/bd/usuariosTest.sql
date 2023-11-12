use cine_movil;

create table usuariosTest (
id int auto_increment primary key,
nombre varchar(255),
apellido_paterno varchar(255),
apellido_materno varchar(255)
);

INSERT INTO usuariosTest values (1,"Angel", "Niebla", "Lopez");
INSERT INTO usuariosTest values (2,"Angel1", "Niebla1", "Lopez1");
INSERT INTO usuariosTest values (3,"Angel2", "Niebla2", "Lopez2");