CREATE TABLE posts
(
    id          BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    title       VARCHAR(255) NOT NULL,
    content     TEXT         NOT NULL,
    author_id   BIGINT UNSIGNED DEFAULT NULL,
    thumbnail   TEXT,
    created_at  DATETIME DEFAULT NOW(),
    category_id BIGINT UNSIGNED,

    CONSTRAINT author_id_fk FOREIGN KEY (author_id) REFERENCES users (id) ON DELETE SET NULL,
    CONSTRAINT category_id_fk FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE SET NULL
);