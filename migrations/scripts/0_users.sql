CREATE TABLE users
(
    id       BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    email    VARCHAR(150) NOT NULL UNIQUE,
    password TEXT         NOT NULL,
    is_admin BOOL DEFAULT 0,
    name     VARCHAR(50)  NOT NULL,
    surname  VARCHAR(50)  NOT NULL
);