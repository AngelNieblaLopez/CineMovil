CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    auth_id INT PRIMARY KEY,
    name VARCHAR(64) NOT NULL,
    last_name VARCHAR(64) NOT NULL,
    second_last_name VARCHAR(64) NOT NULL,
    role_id VARCHAR(124) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE auth (
    id INT PRIMARY KEY AUTO_INCREMENT,
    password VARCHAR(128) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE role (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE page (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE module (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64) NOT NULL,
    page_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE role_module (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role_id INT,
    module_id INT,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE movie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64),
    description varchar(3024),

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE room (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type_room_id INT NOT NULL,
    cinema_id INT NOT NULL,
    name VARCHAR(64),
    available bit NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE type_room (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(64),
    price DECIMAL(10,3),

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE seat_of_room (
    id INT PRIMARY KEY AUTO_INCREMENT,
    room_id INT,
    name VARCHAR(64),
    available bit NOT NULL,
    position_of_seat_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE position_of_seat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    column_of_seat_id INT NOT NULL,
    row_of_seat_id INT NOT NULL,

    
    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE column_of_seat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL UNIQUE,
    
    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE row_of_seat (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL UNIQUE,
    
    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE cinema (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    location_id INT NOT NULL,
    movie_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE location (
    id INT PRIMARY KEY AUTO_INCREMENT,
    description varchar(1024),
    lat VARCHAR(128),
    long VARCHAR(128),

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE function (
    id INT PRIMARY KEY AUTO_INCREMENT,
    cinema_id INT NOT NULL,
    start_date TIMESTAMP NOT NULL,
    function_status_id INT,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

 CREATE TABLE function_status (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    
    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE seat_of_function (
    id INT PRIMARY KEY AUTO_INCREMENT,
    seat_of_room_id INT,
    price DECIMAL(10,3),
    
    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);


CREATE TABLE order (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT NOT NULL,
    seller_id INT NOT NULL,
    payment_status_id INT NOT NULL,
    

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE order_detail (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    seat_of_function_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE seller (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    type_of_seller_id NOT NULL,
    
    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE client (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    
    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE type_of_seller (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    
    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);



CREATE TABLE payment_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    total DECIMAL(12,3),
    taxes DEIMAL (12,3),
    subtotal DECIMAL (12,3),
    payment_status_id INT NOT NULL,
    

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
)



CREATE TABLE payment_status (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);


CREATE TABLE config (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,

    app_seller_id INT NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
);

CREATE TABLE enviroment_server (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name varchar(255) NOT NULL,

    created_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT UTC_TIMESTAMP() ON UPDATE,
    status_id bit NOT NULL DEFAULT 1;
)
