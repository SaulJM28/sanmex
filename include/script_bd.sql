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


create table tip_san(
    id_tsan int(11) primary key not null auto_increment,
    nom_tip varchar(255) default null,
    fec_cre datetime,
    estatus varchar(255) default null
);

create table clientes(
    id_clie int(11) primary key not null auto_increment,
    nom_clie varchar(255) default null,
    tel_clie varchar(255) default null,
    rfc varchar(255) default null,
    razon_social varchar(255) default null,
    nom_con varchar(255) default null,
    num_con varchar(255) default null,
    fec_cre datetime, 
    estatus varchar(255) default null,
);

create table direcciones(
    id_dire int(11) primary key not null auto_increment,
    estado text DEFAULT null,
    municipio text DEFAULT null,
    colonia text DEFAULT null,
    calle text DEFAULT null,
    num_ext text DEFAULT null,
    num_int text DEFAULT null,
    cp text DEFAULT null,
    coordenadas text DEFAULT null
);

create table bitacora_servicio (
    id_bit int(11) primary key not null auto_increment,
    servicio text DEFAULT null,
    cliente text DEFAULT null,
    sanitario text DEFAULT null,
    operador text DEFAULT null, 
    fecha TIMESTAMP, 
    evidencia text DEFAULT null,
    comentario text DEFAULT null,
    estatus text DEFAULT null,
);

create table rutas (
    id_rut int(11) primary key not null auto_increment,
    nom_rut varchar(255) DEFAULT null,
    id_ope int(11),
    estatus varchar(255) DEFAULT null
);

DELIMITER $$
CREATE TRIGGER `after_update_servicio_sani` AFTER UPDATE ON `servicio_sani` FOR EACH ROW
BEGIN
    UPDATE TABLE sanitarios
    SET  estatus = 'DISPONIBLE'
    WHERE id_san = OLD.id_san;
END $$