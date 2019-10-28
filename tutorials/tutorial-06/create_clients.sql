create table Client
(
    id         int auto_increment,
    first_name varchar(50) null,
    last_name  varchar(50) null,
    constraint Client_pk
        primary key (id)
);

INSERT INTO Client (id, first_name, last_name)
VALUES (1, 'John', 'Doe');
INSERT INTO Client (id, first_name, last_name)
VALUES (2, 'Jane', 'Doe');
INSERT INTO Client (id, first_name, last_name)
VALUES (3, 'Alice', 'Salt');
