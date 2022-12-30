CREATE TABLE categories
(
    id         BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title       VARCHAR(100) NOT NULL,
    description TEXT         NOT NULL,
    image       TEXT
);