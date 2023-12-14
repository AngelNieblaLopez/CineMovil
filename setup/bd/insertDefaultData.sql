USE cine_movil;
INSERT INTO `role` (name, is_worker) values ("cutomer v1", 0);
INSERT INTO `role` (name, is_worker) values ("App interna", 0);

INSERT INTO type_of_worker(name) values ("Física");
INSERT INTO type_of_worker (name) values ("App movil");

INSERT INTO auth (password) values ("123456");
INSERT INTO user (auth_id, name, last_name, second_last_name, role_id, email) values (1, "App movil", "", "", 2, "appmovil@gmail.com");
INSERT INTO worker (user_id, type_of_worker_id) values (1, 2);

INSERT INTO enviroment_server (name) values ('development');
INSERT INTO enviroment_server (name) values ('production');
INSERT INTO enviroment_server (name) values ('staging');



INSERT INTO payment_status (name) values ("En proceso");
INSERT INTO payment_status (name) values ("Rechazado");
INSERT INTO payment_status (name) values ("Pagado");


INSERT INTO movie_clasification (name, min_age) VALUES ("A", 12);
INSERT INTO movie_clasification (name, min_age) VALUES ("B", 15);
INSERT INTO movie_clasification (name, min_age) VALUES ("C", 18);

INSERT INTO category (name, description) VALUES ("Animada", "Pelicula animada");
INSERT INTO category (name, description) VALUES ("Live action", "Película live action animada");
INSERT INTO category (name, description) VALUES ("Horror", "Película de miedo");

INSERT INTO movie (name, description, category_id, movie_clasification_id, duration, image_url) VALUES ("Harry Potter y la piedra filosofal", "Harry Potter y la piedra filosofal", 1, 1,120, "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSmef6ypjGcpnDOcGhZUr7tGf9-a4ROfEp-rkwzRIeWMBjBFkQA");
INSERT INTO movie (name, description, category_id, movie_clasification_id, duration, image_url) VALUES ("Harry Potter y la cámara secreta", "Harry Potter y la cámara secreta", 2, 2, 100, "https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTKoQi-Ht4amTZpAnqxHWCTuTDGbP0k7Ez3uoivUCHb_u6aeWHz");
INSERT INTO movie (name, description, category_id, movie_clasification_id, duration, image_url) VALUES ("oso ted 1", "Oso ted 1", 1, 1, 150, "https://t2.gstatic.com/licensed-image?q=tbn:ANd9GcT_B-IlDVnnUHpautmNU6eQhCt51OJ1qVj8OynbLoZqp45M9cpwKfg4figW7ap2Tdab");
INSERT INTO movie (name, description, category_id, movie_clasification_id, duration, image_url) VALUES ("calabozos y dragones", "Calabozos y dragones", 2, 2, 200, "https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcRbDPbdEhbaUTBZ11YUQT22b1tyb_lnuIqMI1W4mSCPB_HyXo5P");
INSERT INTO movie (name, description, category_id, movie_clasification_id, duration, image_url) VALUES ("Harry Potter y el prisionero de Azkaban", "Harry Potter y el prisionero de Azkaban", 3, 3, 200, "https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcQRjZMuMo-D49IgcC_NOcqRzZOD2veP2kAdM2gffSKBCK2CjYdn");
INSERT INTO movie (name, description, category_id, movie_clasification_id, duration, image_url) VALUES ("Gato con botas: el último deseo", "Gato con botas: el último deseo", 1, 1, 140, "https://www.dreamworks.com/storage/cms-uploads/puss-in-boots-the-last-wish-poster-thumbnail2.jpg");

INSERT INTO function_status (name) VALUES ("Pendiente");
INSERT INTO function_status (name) VALUES ("En curso");
INSERT INTO function_status (name) VALUES ("Finalizada");
INSERT INTO function_status (name) VALUES ("Cancelada");


/* SEATS */
INSERT INTO column_of_seat (name) value ("1");
INSERT INTO column_of_seat (name) value ("2");
INSERT INTO column_of_seat (name) value ("3");
INSERT INTO column_of_seat (name) value ("4");
INSERT INTO column_of_seat (name) value ("5");
INSERT INTO column_of_seat (name) value ("6");

INSERT INTO row_of_seat (name) value ("A");
INSERT INTO row_of_seat (name) value ("B");
INSERT INTO row_of_seat (name) value ("C");
INSERT INTO row_of_seat (name) value ("D");

INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (1, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (2, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (3, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (4, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (5, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (6, 1);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (1, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (2, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (3, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (4, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (5, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (6, 2);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (1, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (2, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (3, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (4, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (5, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (6, 3);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (1, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (2, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (3, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (4, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (5, 4);
INSERT INTO position_of_seat (column_of_seat_id, row_of_seat_id) VALUE (6, 4);

/* SEATS */