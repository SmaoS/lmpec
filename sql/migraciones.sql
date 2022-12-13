CREATE TABLE `cliente` (
  `id_cliente` bigint(18) NOT NULL AUTO_INCREMENT,
  `cc_cliente` bigint(18) NOT NULL,
  `tel_cliente` varchar(20) NOT NULL,
  `email_cliente` varchar(100) NOT NULL,
  `dire_resid_cliente` varchar(100) NOT NULL,
  `insta_cliente` varchar(100) DEFAULT NULL,
  `ind_fuerza` bigint(20) DEFAULT 0,
  `contrasena` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

INSERT INTO cliente
(id_cliente, cc_cliente, tel_cliente, email_cliente, dire_resid_cliente, insta_cliente, ind_fuerza, contrasena)
VALUES(1, 1121853083, '3133133434', 'cliente1@gmail.com', 'carrera 45 20-20 sur', 'Mauricio Tovar', 1, '1234');

CREATE TABLE `producto` (
  `id_pro` bigint(18) NOT NULL AUTO_INCREMENT,
  `tipo_pro` varchar(20) NOT NULL,
  `ref_pro` varchar(100) NOT NULL,
  `nombre_pro` varchar(100) NOT NULL,
  `descrip_pro` varchar(100) DEFAULT NULL,
  `precio_pro` decimal(18,2) NOT NULL,
  `cant_pro` bigint(18) DEFAULT NULL,
  PRIMARY KEY (`id_pro`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

CREATE TABLE `mesas` (
  `secuencia` bigint(20) NOT NULL AUTO_INCREMENT,
  `estado` bigint(5) NOT NULL DEFAULT 0,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`secuencia`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

CREATE TABLE `ventas` (
  `id_vent` bigint(18) NOT NULL AUTO_INCREMENT,
  `id_cliente_vent` bigint(18) NOT NULL,
  `estado_vent` bigint(5) NOT NULL,
  `fecha_vent` datetime NOT NULL,
  `desc_vent` varchar(400) DEFAULT NULL,
  `sub_total_vent` decimal(18,2) DEFAULT NULL,
  `total_vent` decimal(18,2) DEFAULT NULL,
  `impues_vent` decimal(18,2) DEFAULT NULL,
  `mesa` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id_vent`),
  KEY `ventas_FK2` (`id_cliente_vent`),
  KEY `ventas_FK1` (`mesa`),
  CONSTRAINT `ventas_FK` FOREIGN KEY (`id_cliente_vent`) REFERENCES `cliente` (`id_cliente`),
  CONSTRAINT `ventas_FK1` FOREIGN KEY (`mesa`) REFERENCES `mesas` (`secuencia`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

CREATE TABLE `mesa_det` (
  `secuencia` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_producto` bigint(20) NOT NULL,
  `cantidad` bigint(20) NOT NULL,
  `estado` bigint(20) NOT NULL DEFAULT 0,
  `valor` bigint(20) NOT NULL,
  `mesa` bigint(5) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `valor_total` bigint(20) DEFAULT 0,
  `id_venta` bigint(20) DEFAULT 0,
  PRIMARY KEY (`secuencia`),
  KEY `mesa_det_FK` (`id_producto`),
  KEY `mesa_det_FK1` (`mesa`),
  CONSTRAINT `mesa_det_FK` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_pro`),
  CONSTRAINT `mesa_det_FK1` FOREIGN KEY (`mesa`) REFERENCES `mesas` (`secuencia`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

CREATE TABLE `pedidos` (
  `id_pedido` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `estado` bigint(5) NOT NULL,
  `usuario` bigint(20) NOT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `valor` bigint(20) DEFAULT 0,
  PRIMARY KEY (`id_pedido`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

CREATE TABLE `pedidos_det` (
  `secuencia` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_pedido` bigint(20) NOT NULL,
  `id_producto` bigint(20) NOT NULL,
  `cantidad` bigint(20) NOT NULL,
  `valor` bigint(20) NOT NULL,
  `valor_total` bigint(20) NOT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`secuencia`),
  KEY `pedidos_det_FK_1` (`id_producto`),
  KEY `pedidos_det_FK2` (`id_pedido`),
  CONSTRAINT `pedidos_det_FK2` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  CONSTRAINT `pedidos_det_FK_1` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_pro`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

CREATE TABLE `fecha_sistema` (
  `fecha_sistema` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO fecha_sistema
(fecha_sistema)
VALUES('2022-10-29');

CREATE TABLE `teso_movimientos` (
  `secuencia` bigint(20) NOT NULL AUTO_INCREMENT,
  `forma_pago` bigint(5) NOT NULL DEFAULT 0,
  `id_tipo` bigint(5) NOT NULL DEFAULT 0,
  `id_producto` bigint(20) DEFAULT NULL,
  `cantidad` bigint(20) NOT NULL,
  `valor` bigint(20) NOT NULL,
  `id_venta` bigint(20) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `mesa` bigint(5) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`secuencia`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1;

CREATE TABLE `cierre` (
  `secuencia` bigint(20) NOT NULL AUTO_INCREMENT,
  `fecha_cierre` datetime NOT NULL,
  `fecha_inicial` datetime NOT NULL,
  `fecha_final` datetime NOT NULL,
  `saldo_sistema` bigint(20) NOT NULL,
  `saldo_caja` bigint(20) NOT NULL,
  `observaciones` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`secuencia`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

