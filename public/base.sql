create table articles
(
    Id              bigint auto_increment
        primary key,
    Titre           varchar(50)  null,
    Description     text         null,
    DateAjout       date         null,
    Auteur          varchar(50)  null,
    ImageRepository varchar(50)  null,
    ImageFileName   varchar(255) null
);

create table techno_category
(
    CategoryId   int(20) auto_increment
        primary key,
    CategoryName varchar(50) null,
    CategorySlug varchar(50) null
);

