create table product_image
(
    id         int auto_increment,
    product_id int         not null,
    image_name varchar(40) not null,
    FOREIGN KEY fk_prod (product_id)
        REFERENCES product (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,
    constraint product_image_pk
        primary key (id)
);
