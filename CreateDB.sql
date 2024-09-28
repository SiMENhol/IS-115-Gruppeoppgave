create database if not exists HotellServicedb;
use HotellServicedb;
create table if not exists Hotellrom (
    Id int not null unique,
    TypeRom varchar(50),
        CONSTRAINT PK_Hotellrom PRIMARY KEY (Id)
);
create table if not exists Brukere (
    Id int not unique,
    Brukernavn varchar(50),
    Passord varchar(50),
    Rolle varchar(50),
    DatoLaget datetime,
        CONSTRAINT PK_Brukere PRIMARY KEY (Id)
);
