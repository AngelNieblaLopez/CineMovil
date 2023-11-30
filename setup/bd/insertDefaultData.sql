USE cine_movil;
INSERT INTO type_of_worker(name) values ("Física");
INSERT INTO type_of_worker (name) values ("App movil");

INSERT INTO enviroment_server (name) values ('development');
INSERT INTO enviroment_server (name) values ('production');
INSERT INTO enviroment_server (name) values ('staging');

INSERT INTO `role` (name, is_worker) values ("cutomer v1", 0);

-- INSERT INTO config (name, enviroment_server_id, default_customer_role_id, app_worker_id) values ("Development", 1, 1, 1)