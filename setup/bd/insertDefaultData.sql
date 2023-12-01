USE cine_movil;
INSERT INTO type_of_worker(name) values ("Física");
INSERT INTO type_of_worker (name) values ("App movil");

INSERT INTO enviroment_server (name) values ('development');
INSERT INTO enviroment_server (name) values ('production');
INSERT INTO enviroment_server (name) values ('staging');

INSERT INTO `role` (name, is_worker) values ("cutomer v1", 0);


INSERT INTO type_room (name, price) value ("Clásica",100);
INSERT INTO type_room (name, price) value ("VIP",150);
INSERT INTO type_room (name, price) value ("3D",150);