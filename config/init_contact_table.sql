DROP TABLE IF EXISTS book;

CREATE TABLE book (
    id             int(11)       NOT NULL AUTO_INCREMENT,
    name           varchar(255)  NOT NULL,
    email_address  varchar(255)  NOT NULL,
    phone_number   varchar(255)  NOT NULL,
    PRIMARY KEY (id)
);