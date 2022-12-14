create database sanmex;
use sanmex;


create table usuarios(
    id_usu int(11) primary key not null auto_increment,
    nom_usu varchar(255) DEFAULT NULL,
    pwd_usu varchar(255) DEFAULT NULL,
    tip_usu varchar(255) DEFAULT NULL,
    estatus varchar(255) DEFAULT NULL,
    fec_cre date
);


create table operadores(
    id_ope int(11) primary key not null auto_increment,
    nom varchar(255) default NULL,
    ap1 varchar(255) default NULL,
    ap2 varchar(255) default NULL,
    tel varchar(255) default NULL,
    id_usu int(11),
    fec_cre datetime, 
    estatus varchar(255)
);

create table sanitarios(
    id_san int(11) primary key not null auto_increment,
    num_san varchar(255) default null,
    tip_san varchar(255) default null,
    fec_cre datetime,
    estatus varchar(255) default null
);
