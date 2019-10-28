create table product_category
(
    id          int auto_increment,
    product_id  int not null,
    category_id int not null,
    FOREIGN KEY fk_cat (category_id)
        REFERENCES category (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    FOREIGN KEY fk_prod (product_id)
        REFERENCES product (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    constraint product_category_pk
        primary key (id)
);
