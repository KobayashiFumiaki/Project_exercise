DROP TABLE IF EXISTS alarm;

CREATE TABLE alarm (
    number  int(11)       NOT NULL AUTO_INCREMENT,
    hour    int(11)       NOT NULL,
    minute  int(11)       NOT NULL,
    switch  varchar(255)  NOT NULL,
    PRIMARY KEY (number)
);