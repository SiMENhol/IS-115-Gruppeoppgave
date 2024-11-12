create database if not exists HotellServicedb;
use HotellServicedb;
create table if not exists Hotellrom (
    Id int not null unique,
    TypeRom varchar(50) not null,
    RomStatus boolean not null,
    Plasser int not null,
    RomBeskrivelse varchar(255),
    PrisPrNatt int not null,
        CONSTRAINT PK_Hotellrom PRIMARY KEY (Id)
);

create table if not exists Brukere (
    Id int not null unique,
    Epost varchar(255),
    Brukernavn varchar(50),
    Passord varchar(50),
    Rolle varchar(50),
    DatoLaget datetime,
        CONSTRAINT PK_Brukere PRIMARY KEY (Id)
);

create table if not exists Reservasjon(
    Id int not null unique,
    BrukerId int,
    RomId int,
    CheckInDato datetime,
    CheckOutDato datetime,
    ReservasjonStatus varchar(50),
        CONSTRAINT PK_Reservasjon PRIMARY KEY (Id),
        FOREIGN KEY (BrukerId)
            REFERENCES Brukere(Id),
        FOREIGN KEY (RomId)
            REFERENCES Hotellrom (Id)
);