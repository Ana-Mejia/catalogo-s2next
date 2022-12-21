CREATE DATABASE evaluacion;
USE evaluacion;

CREATE TABLE menu(
    id          int auto_increment not null,
    menu_id     int,
    nombre      varchar(255) not null,
    descripcion varchar(255) not null,
    activo      tinyint(1) default 1,
    created_at  timestamp default CURRENT_TIMESTAMP,
    updated_at  timestamp default CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT pk_menu PRIMARY KEY(id),
    CONSTRAINT fk_menu_submenu FOREIGN KEY(menu_id) REFERENCES menu(id)
) ENGINE=InnoDb;