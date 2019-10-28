create table admin
(
    id    int auto_increment
        primary key,
    uname varchar(50)  null,
    pword varchar(255) null
);

create table category
(
    id   int auto_increment
        primary key,
    name varchar(50) not null
);

create table client
(
    id         int auto_increment
        primary key,
    first_name varchar(50)  not null,
    last_name  varchar(50)  not null,
    street     varchar(100) null,
    suburb     varchar(50)  null,
    postcode   char(4)      null,
    state      char(6)      null,
    mobile     varchar(12)  null,
    email      varchar(50)  null,
    mail_list  char(1)      null
);

create table product
(
    id                int auto_increment
        primary key,
    name              varchar(30)    null,
    country_of_origin varchar(40)    null,
    purchase_price    decimal(11, 2) null,
    sale_price        decimal(11, 2) null,
    description       varchar(50)    null
);

create table product_category
(
    product_id  int not null,
    category_id int not null,
    primary key (product_id, category_id),
    constraint `cate_pro-cate___fk`
        foreign key (category_id) references category (id),
    constraint `product_pro-cate___fk`
        foreign key (product_id) references product (id)
);

create table product_image
(
    id         int auto_increment
        primary key,
    image_name varchar(40) not null,
    product_id int         not null,
    constraint product_image_fk
        foreign key (product_id) references product (id)
);

create table project
(
    id          int auto_increment
        primary key,
    date        date        null,
    name        varchar(50) null,
    description varchar(50) null,
    country     varchar(40) null,
    amount      int         null,
    city        varchar(40) null
);

