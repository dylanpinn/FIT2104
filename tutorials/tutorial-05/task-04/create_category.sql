create table Category
(
    id          int auto_increment,
    description varchar(50) null,
    constraint Category_pk
        primary key (id)
);

INSERT INTO category (id, description)
VALUES (1, 'Decoration');
INSERT INTO category (id, description)
VALUES (2, 'Food');
INSERT INTO category (id, description)
VALUES (3, 'Toys');
