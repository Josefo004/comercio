USE Ecommerce;

DROP TABLE dbo.CategoriaGeneros;

CREATE TABLE dbo.CategoriaGeneros(
	IdCategoriaGenero INT PRIMARY KEY IDENTITY (1, 1),
	Descripcion VARCHAR(100) NOT NULL,
);

INSERT INTO CategoriaGeneros (Descripcion) VALUES('SIN CATEGORIA');
INSERT INTO CategoriaGeneros (Descripcion) VALUES('MUJER');
INSERT INTO CategoriaGeneros (Descripcion) VALUES('VARON');
INSERT INTO CategoriaGeneros (Descripcion) VALUES('NIÑA');
INSERT INTO CategoriaGeneros (Descripcion) VALUES('NIÑO');

-- *************************
-- *************************
-- *************************

USE Ecommerce;

DROP TABLE dbo.CategoriaProducto;

CREATE TABLE dbo.CategoriaProductos(
	IdCategoriaProducto INT PRIMARY KEY IDENTITY (1, 1),
	Descripcion VARCHAR(200) NOT NULL,
);

INSERT INTO CategoriaProductos (Descripcion) VALUES('SIN CATEGORIA PRODUCTO');
INSERT INTO CategoriaProductos (Descripcion) VALUES('POLERA - CAMISETA');
INSERT INTO CategoriaProductos (Descripcion) VALUES('POLO - POLERA CON CUELLO');
INSERT INTO CategoriaProductos (Descripcion) VALUES('SUDADERA');
INSERT INTO CategoriaProductos (Descripcion) VALUES('CONJUNTO DEPORTIVO');
INSERT INTO CategoriaProductos (Descripcion) VALUES('BUZO');
INSERT INTO CategoriaProductos (Descripcion) VALUES('CANGURO');
INSERT INTO CategoriaProductos (Descripcion) VALUES('CHAQUETA');
INSERT INTO CategoriaProductos (Descripcion) VALUES('CHAMARRA');
INSERT INTO CategoriaProductos (Descripcion) VALUES('JERSEY - CHOMPA');
INSERT INTO CategoriaProductos (Descripcion) VALUES('ABRIGO');
INSERT INTO CategoriaProductos (Descripcion) VALUES('LLAVERO');


-- *************************
-- *************************
-- *************************

USE Ecommerce;

DROP TABLE dbo.Tallas;

CREATE TABLE dbo.Tallas(
	IdTalla INT PRIMARY KEY IDENTITY (1, 1),
	Talla VARCHAR(5) NOT NULL,
	DescripcionTalla VARCHAR(100) NOT NULL
);

INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('NTT', 'NO TIENE TALLA');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('XS', 'EXTRA SMALL, TALLA EXTRA PEQUEÑA');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('S', 'SMALL, TALLA PEQUEÑA');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('M', 'MEDIUM, TAllA MEDIA');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('L', 'LARGE, TALLA GRANDE');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('XL', 'EXTRA LARGE, TALLA EXTRA GRANDE');


-- *************************
-- *************************
-- *************************

USE Ecommerce;

DROP TABLE dbo.Productos;

CREATE TABLE dbo.Productos(
	IdProducto INT PRIMARY KEY IDENTITY (1, 1),
	IdCategoriaGenero INT NOT NULL,
	IdCategoriaProducto INT NOT NULL,
	CodigoProducto VARCHAR(10) NULL,
	NombreProducto VARCHAR(100) NULL,
	DescripcionProducto VARCHAR(200) NULL,
	Imagen VARCHAR(2000) NULL,
	PrecioVenta DECIMAL (10, 2) NOT NULL,
	PrecioPreVenta DECIMAL (10, 2) NULL,
	FechaCaducidadPreVenta DATE NULL,
	PrecioReserva DECIMAL (10, 2) NULL,
	FechaCreacion DATETIME DEFAULT (getdate()) NOT NULL,
	CONSTRAINT FK_IdCategoriaGenero_Productos FOREIGN KEY (IdCategoriaGenero) REFERENCES dbo.CategoriaGenero(IdCategoriaGenero),
	CONSTRAINT FK_IdCategoriaProducto_Productos FOREIGN KEY (IdCategoriaProducto) REFERENCES dbo.CategoriaProducto(IdCategoriaProducto),
);


-- *************************
-- *************************
-- *************************

USE Ecommerce;

DROP TABLE dbo.ProductoTallas;

CREATE TABLE dbo.ProductoTallas(
	IdProductoTalla INT PRIMARY KEY IDENTITY (1, 1),
	IdProducto INT NOT NULL,
	IdTalla INT NOT NULL,
	Cantidad INT DEFAULT 0 NULL,
	FechaCreacion DATETIME DEFAULT (getdate()) NOT NULL,
	FechaModificacion DATETIME NULL,
	CONSTRAINT FK_IdProducto_ProductoTallas FOREIGN KEY (IdProducto) REFERENCES dbo.Productos(IdProducto),
	CONSTRAINT FK_IdTalla_ProductoTallas FOREIGN KEY (IdTalla) REFERENCES dbo.Tallas(IdTalla),
);


-- ****************************************************************************************************
-- ****************************************************************************************************
-- ****************************************************************************************************
-- ****************************************************************************************************


USE Ecommerce;

DROP TABLE dbo.CategoriaGenero;

CREATE TABLE dbo.CategoriaGenero(
	IdCategoriaGenero INT PRIMARY KEY IDENTITY (1, 1),
	Descripcion VARCHAR(100) NOT NULL,
);

INSERT INTO CategoriaGenero (Descripcion) VALUES('SIN CATEGORIA');
INSERT INTO CategoriaGenero (Descripcion) VALUES('MUJER');
INSERT INTO CategoriaGenero (Descripcion) VALUES('VARON');
INSERT INTO CategoriaGenero (Descripcion) VALUES('NIÑA');
INSERT INTO CategoriaGenero (Descripcion) VALUES('NIÑO');

select * from CategoriaGenero;

ALTER TABLE dbo.Productos
  ADD CodigoProducto VARCHAR(10) NULL;

ALTER TABLE dbo.Productos
  ADD IdCategoriaGenero INT DEFAULT 1 NOT NULL;
  
ALTER TABLE dbo.Productos
  ADD CONSTRAINT FK_IdCategoriaGenero_Productos FOREIGN KEY (IdCategoriaGenero) REFERENCES dbo.CategoriaGeneros(IdCategoriaGenero);

ALTER TABLE dbo.Productos
  ADD CodigoEstado CHAR(1) DEFAULT 'V'  NOT NULL;
  
ALTER TABLE dbo.Productos
  ADD CONSTRAINT FK_CodigoEstado_Productos FOREIGN KEY (CodigoEstado) REFERENCES dbo.Estados(CodigoEstado);

ALTER TABLE dbo.Productos
  ADD IdCategoriaProducto INT DEFAULT 1 NOT NULL;
  
ALTER TABLE dbo.Productos
  ADD CONSTRAINT FK_IdCategoriaProducto_Productos FOREIGN KEY (IdCategoriaProducto) REFERENCES dbo.CategoriaProductos(IdCategoriaProducto);

ALTER TABLE dbo.Productos
  DROP CONSTRAINT FK_IdCategoriaGenero_Productos;

select * from Productos;

update Productos set Imagen = 'AUJmIbzvbe6UktWlsMC6lhz0JiLuxOpw/polera2.jpg' where IdProducto in (28,30,32,34,36,38,40,42)

update Productos set Imagen = '-F-5nC5Dm34LkgpfLjlEbAPqVbQ8IVB1/polera femenina.jpg' where IdProducto in (29,31,33,35,37,39,41,43)

UPDATE Productos SET IdCategoriaGenero=1 WHERE IdProducto=21;
UPDATE Productos SET IdCategoriaGenero=2 WHERE IdProducto=22;
UPDATE Productos SET IdCategoriaGenero=3 WHERE IdProducto=23;
UPDATE Productos SET IdCategoriaGenero=4 WHERE IdProducto=24;
UPDATE Productos SET IdCategoriaGenero=5 WHERE IdProducto=25;
UPDATE Productos SET IdCategoriaGenero=1 WHERE IdProducto=26;
UPDATE Productos SET IdCategoriaGenero=2 WHERE IdProducto=27;
UPDATE Productos SET IdCategoriaGenero=3 WHERE IdProducto=28;
UPDATE Productos SET IdCategoriaGenero=4 WHERE IdProducto=29;
UPDATE Productos SET IdCategoriaGenero=5 WHERE IdProducto=30;
UPDATE Productos SET IdCategoriaGenero=1 WHERE IdProducto=31;
UPDATE Productos SET IdCategoriaGenero=2 WHERE IdProducto=32;
UPDATE Productos SET IdCategoriaGenero=3 WHERE IdProducto=33;
UPDATE Productos SET IdCategoriaGenero=4 WHERE IdProducto=34;
UPDATE Productos SET IdCategoriaGenero=5 WHERE IdProducto=35;
UPDATE Productos SET IdCategoriaGenero=1 WHERE IdProducto=36;
UPDATE Productos SET IdCategoriaGenero=2 WHERE IdProducto=37;
UPDATE Productos SET IdCategoriaGenero=3 WHERE IdProducto=38;
UPDATE Productos SET IdCategoriaGenero=4 WHERE IdProducto=39;
UPDATE Productos SET IdCategoriaGenero=5 WHERE IdProducto=40;
UPDATE Productos SET IdCategoriaGenero=1 WHERE IdProducto=41;
UPDATE Productos SET IdCategoriaGenero=2 WHERE IdProducto=42;

UPDATE Productos SET NombreProducto=(SELECT CategoriaProducto.Descripcion FROM CategoriaProducto WHERE CategoriaProducto.IdCategoriaGenero=Productos.IdCategoriaProducto);

UPDATE Productos SET NombreProducto=UPPER(LEFT(NombreProducto, 1)) + LOWER(SUBSTRING(NombreProducto, 2, LEN(NombreProducto)));

ALTER TABLE dbo.Productos
  ADD FechaCaducidadPreVenta DATE NULL;

-- ****************************************************************************************************
-- ****************************************************************************************************
-- ****************************************************************************************************
-- ****************************************************************************************************

ALTER TABLE dbo.ProductoTallas
  ADD Cantidad INT DEFAULT 1 NOT NULL;

ALTER TABLE dbo.ProductoTallas
  DROP CONSTRAINT id;

-- ** Averiguar el nombre de las llaves foraneas
SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'ProductoTallas' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.ProductoTallas
  DROP CONSTRAINT FK__ProductoT__IdTal__7E37BEF6;

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'ProductoTallas' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'ProductoTallas' AND CONSTRAINT_TYPE = 'PRIMARY KEY';

ALTER TABLE dbo.ProductoTallas
  DROP CONSTRAINT PK__Producto__271D2C843548FC8C

ALTER TABLE dbo.ProductoTallas
  DROP CONSTRAINT FK__ProductoT__IdPro__7D439ABD;


USE Ecommerce;

DROP TABLE dbo.Tallas;

CREATE TABLE dbo.Tallas(
	IdTalla INT PRIMARY KEY IDENTITY (1, 1),
	Talla VARCHAR(5) NOT NULL,
	DescripcionTalla VARCHAR(100) NOT NULL
);

INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('NTT', 'NO TIENE TALLA');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('XS', 'EXTRA SMALL, TALLA EXTRA PEQUEÑA');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('S', 'SMALL, TALLA PEQUEÑA');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('M', 'MEDIUM, TAllA MEDIA');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('L', 'LARGE, TALLA GRANDE');
INSERT INTO Tallas (Talla, DescripcionTalla) VALUES('XL', 'EXTRA LARGE, TALLA EXTRA GRANDE');

ALTER TABLE dbo.Productos
  ALTER COLUMN Precio DECIMAL(10, 2) NULL;

--** Insertada masiva de tallas a los productos
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(21, 2, 2);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(22, 3, 3);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(22, 4, 4);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(22, 5, 7);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(22, 6, 8);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(23, 2, 9);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(23, 3, 10);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(26, 4, 11);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(26, 5, 0);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(26, 6, 2);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(26, 2, 3);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(27, 3, 4);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(27, 4, 5);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(27, 5, 6);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(27, 6, 7);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(28, 2, 8);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(28, 3, 9);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(28, 4, 10);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(28, 5, 11);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(29, 6, 1);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(29, 2, 2);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(29, 3, 2);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(30, 4, 3);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(30, 5, 4);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(31, 6, 7);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(31, 2, 8);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(32, 3, 9);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(32, 4, 10);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(33, 5, 11);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(33, 6, 0);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(33, 2, 2);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(34, 3, 3);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(34, 4, 4);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(34, 5, 5);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(34, 6, 6);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(35, 2, 7);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(35, 3, 8);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(36, 4, 9);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(36, 5, 10);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(36, 6, 11);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(36, 2, 1);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(37, 3, 2);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(37, 4, 2);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(37, 5, 3);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(37, 6, 4);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(38, 2, 7);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(38, 3, 8);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(38, 4, 9);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(38, 5, 10);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(39, 6, 11);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(39, 2, 12);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(39, 3, 2);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(40, 4, 3);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(40, 5, 4);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(41, 6, 5);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(41, 2, 6);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(42, 1, 7);
insert into ProductoTallas (IdProducto, IdTalla, Cantidad) values(44, 2, 8);



--** Borramos la tabla carrito items
use ecommerce;

select * from Usuarios u;

SELECT * FROM Productos;

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'CarritoItems' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.CarritoItems
  DROP CONSTRAINT FK__Carrito_I__Codig__403A8C7D;
  
DROP TABLE dbo.CarritoItems;

--** ordenes
select * from Ordenes;

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'Ordenes' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.Ordenes
  DROP CONSTRAINT FK__Ordenes__CodigoU__33D4B598;

ALTER TABLE [dbo].[Ordenes] ALTER COLUMN [CodigoUsuario] char(15);

--** Eliminar pagos Ordenes
SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'PagosOrdenes' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.PagosOrdenes
  DROP CONSTRAINT FK__PagosOrde__IdOrd__3A81B327;

ALTER TABLE dbo.PagosOrdenes
  DROP CONSTRAINT FK__PagosOrde__Codig__3B75D760;

ALTER TABLE dbo.PagosOrdenes
  DROP CONSTRAINT FK__PagosOrde__Codig__3D5E1FD2;

DROP TABLE dbo.PagosOrdenes;

--** Nueva estructura de ordenes

USE Ecommerce;

DROP TABLE dbo.Ordenes;

CREATE TABLE dbo.Ordenes(
	IdOrden INT PRIMARY KEY IDENTITY (1, 1),
	CodigoEstado CHAR(1) DEFAULT 'P'  NOT NULL,
	TotalOrden DECIMAL (10, 2) NOT NULL,
	CodigoQR VARCHAR(2000) NULL,
	CodigoUsuarioCreacion CHAR(15) NOT NULL,
	FechaCreacion DATETIME DEFAULT (getdate()) NOT NULL, 
	CodigoUsuarioActualizacion CHAR(15) NULL,
	FechaActualizacion DATETIME NULL, 
	Observacion VARCHAR(500) NULL,
	CONSTRAINT FK_CodigoEstado_Ordenes FOREIGN KEY (CodigoEstado) REFERENCES dbo.Estados(CodigoEstado),
	CONSTRAINT FK_CodigoUsuarioCreacion_Ordenes FOREIGN KEY (CodigoUsuarioCreacion) REFERENCES dbo.Usuarios(CodigoUsuario),
	CONSTRAINT FK_CodigoUsuarioActualizacion_Ordenes FOREIGN KEY (CodigoUsuarioActualizacion) REFERENCES dbo.Usuarios(CodigoUsuario)
);

USE Ecommerce;

DROP TABLE dbo.DetalleOrdenes;

CREATE TABLE dbo.DetalleOrdenes(
	IdDetalleOrden INT PRIMARY KEY IDENTITY (1, 1),
	IdOrden INT NOT NULL,
	IdProducto INT NOT NULL,
	IdProductoTalla INT NOT NULL,
	Talla VARCHAR(100) NOT NULL,
	CodigoProducto VARCHAR(10) NOT NULL,
	ProductoPara VARCHAR(100) NOT NULL,
	NombreProducto VARCHAR(100) NOT NULL,
	Imagen VARCHAR(2000) NOT NULL,
	Precio DECIMAL (10, 2) NOT NULL,
	Cantidad INT NOT NULL,
	Total DECIMAL (10, 2) NOT NULL,
	FechaRegistro DATETIME DEFAULT (getdate()) NOT NULL, 
	CONSTRAINT FK_IdOrden_DetalleOrdenes FOREIGN KEY (IdOrden) REFERENCES dbo.Ordenes(IdOrden),
	CONSTRAINT FK_IdProducto_DetalleOrdenes FOREIGN KEY (IdProducto) REFERENCES dbo.Productos(IdProducto),
	CONSTRAINT FK_IdProductoTalla_DetalleOrdenes FOREIGN KEY (IdProductoTalla) REFERENCES dbo.ProductoTallas(IdProductoTalla)
);

--** Borrado de Ordenes y detalleOrdenes
use  Ecommerce;

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'DetalleOrdenes' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.DetalleOrdenes
  DROP CONSTRAINT FK_IdOrden_DetalleOrdenes;

ALTER TABLE dbo.DetalleOrdenes
  DROP CONSTRAINT FK_IdProducto_DetalleOrdenes;

ALTER TABLE dbo.DetalleOrdenes
  DROP CONSTRAINT FK_IdProductoTalla_DetalleOrdenes;

DROP TABLE dbo.DetalleOrdenes;

--**
SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'Ordenes' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.Ordenes
  DROP CONSTRAINT FK_CodigoEstado_Ordenes;

ALTER TABLE dbo.Ordenes
  DROP CONSTRAINT FK_CodigoUsuarioCreacion_Ordenes;

ALTER TABLE dbo.Ordenes
  DROP CONSTRAINT FK_CodigoUsuarioActualizacion_Ordenes;

DROP TABLE dbo.Ordenes;

--** Ordenes Pagadas

USE Ecommerce;

DROP TABLE dbo.OrdenesPagadas;

CREATE TABLE dbo.OrdenesPagadas(
	IdOrdenPagada INT PRIMARY KEY IDENTITY (1, 1),
	IdOrden INT NOT NULL,
	TotalOrden DECIMAL (10, 2) NOT NULL,
	FechaCreacion DATETIME DEFAULT (getdate()) NOT NULL,
	CONSTRAINT FK_IdOrden_OrdenesPagadas FOREIGN KEY (IdOrden) REFERENCES dbo.Ordenes(IdOrden),
);

--** aumento campos a Ordenes
ALTER TABLE dbo.Ordenes
  ADD Email VARCHAR(100) NOT NULL;
ALTER TABLE dbo.Ordenes
	ADD Celular VARCHAR(15) NOT NULL;
ALTER TABLE dbo.Ordenes
	ADD NombreCompleto VARCHAR(500) NOT NULL;


--**
use Ecommerce;

select * from Usuarios;

delete from Usuarios where CodigoUsuario='jmv';

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'Ordenes' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.Ordenes
  DROP CONSTRAINT FK_CodigoUsuarioCreacion_Ordenes;

ALTER TABLE dbo.Ordenes
  DROP CONSTRAINT FK_CodigoUsuarioActualizacion_Ordenes;

ALTER TABLE dbo.Ordenes ALTER COLUMN CodigoUsuarioCreacion VARCHAR(15);  

ALTER TABLE dbo.Ordenes ALTER COLUMN CodigoUsuarioActualizacion VARCHAR(15);  

ALTER TABLE dbo.Ordenes
  ADD CONSTRAINT FK_CodigoUsuarioCreacion_Ordenes FOREIGN KEY (CodigoUsuarioCreacion) REFERENCES dbo.Usuarios(CodigoUsuario);

ALTER TABLE dbo.Ordenes
  ADD CONSTRAINT FK_CodigoUsuarioActualizacion_Ordenes FOREIGN KEY (CodigoUsuarioActualizacion) REFERENCES dbo.Usuarios(CodigoUsuario);



--** 
SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'Productos' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.Productos
  DROP CONSTRAINT FK_CodigoUsuarioCreacion_Productos;

ALTER TABLE dbo.Productos
  DROP CONSTRAINT FK_CodigoUsuarioActualizacion_Productos;

ALTER TABLE dbo.Productos ALTER COLUMN CodigoUsuarioCreacion VARCHAR(15);  

ALTER TABLE dbo.Productos ALTER COLUMN CodigoUsuarioActualizacion VARCHAR(15);  

ALTER TABLE dbo.Ordenes
  ADD CONSTRAINT FK_CodigoUsuarioCreacion_Productos FOREIGN KEY (CodigoUsuarioCreacion) REFERENCES dbo.Usuarios(CodigoUsuario);

ALTER TABLE dbo.Ordenes
  ADD CONSTRAINT FK_CodigoUsuarioActualizacion_Productos FOREIGN KEY (CodigoUsuarioActualizacion) REFERENCES dbo.Usuarios(CodigoUsuario);


--**
SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'Usuarios' AND CONSTRAINT_TYPE = 'PRIMARY KEY';

ALTER TABLE dbo.Usuarios
  DROP CONSTRAINT PK_Usuarios;

ALTER TABLE dbo.Usuarios ALTER COLUMN CodigoUsuario VARCHAR(15) NOT NULL;  

ALTER TABLE dbo.Usuarios ADD PRIMARY KEY (CodigoUsuario);


SELECT * 
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
WHERE CONSTRAINT_NAME LIKE 'DF__Productos__Codig__2E1BDC42';


--**

use Ecommerce;

select * from Usuarios;

delete from Usuarios where CodigoUsuario='jmv';

SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'Ordenes' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.Ordenes
  DROP CONSTRAINT FK_CodigoUsuarioCreacion_Ordenes;

ALTER TABLE dbo.Ordenes
  DROP CONSTRAINT FK_CodigoUsuarioActualizacion_Ordenes;

ALTER TABLE dbo.Ordenes ALTER COLUMN CodigoUsuarioCreacion VARCHAR(15);  

ALTER TABLE dbo.Ordenes ALTER COLUMN CodigoUsuarioActualizacion VARCHAR(15);  

ALTER TABLE dbo.Ordenes
  ADD CONSTRAINT FK_CodigoUsuarioCreacion_Ordenes FOREIGN KEY (CodigoUsuarioCreacion) REFERENCES dbo.Usuarios(CodigoUsuario);

ALTER TABLE dbo.Ordenes
  ADD CONSTRAINT FK_CodigoUsuarioActualizacion_Ordenes FOREIGN KEY (CodigoUsuarioActualizacion) REFERENCES dbo.Usuarios(CodigoUsuario);



--** 
SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'Productos' AND CONSTRAINT_TYPE = 'FOREIGN KEY';

ALTER TABLE dbo.Productos
  DROP CONSTRAINT FK_CodigoUsuarioCreacion_Productos;

ALTER TABLE dbo.Productos
  DROP CONSTRAINT FK_CodigoUsuarioActualizacion_Productos;

ALTER TABLE dbo.Productos ALTER COLUMN CodigoUsuarioCreacion VARCHAR(15);  

ALTER TABLE dbo.Productos ALTER COLUMN CodigoUsuarioActualizacion VARCHAR(15);  

ALTER TABLE dbo.Ordenes
  ADD CONSTRAINT FK_CodigoUsuarioCreacion_Productos FOREIGN KEY (CodigoUsuarioCreacion) REFERENCES dbo.Usuarios(CodigoUsuario);

ALTER TABLE dbo.Ordenes
  ADD CONSTRAINT FK_CodigoUsuarioActualizacion_Productos FOREIGN KEY (CodigoUsuarioActualizacion) REFERENCES dbo.Usuarios(CodigoUsuario);


--**
SELECT CONSTRAINT_NAME
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS
WHERE TABLE_NAME = 'Usuarios' AND CONSTRAINT_TYPE = 'PRIMARY KEY';

ALTER TABLE dbo.Usuarios
  DROP CONSTRAINT PK_Usuarios;

ALTER TABLE dbo.Usuarios ALTER COLUMN CodigoUsuario VARCHAR(15) NOT NULL;  

ALTER TABLE dbo.Usuarios ADD PRIMARY KEY (CodigoUsuario);


SELECT * 
FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS 
WHERE CONSTRAINT_NAME LIKE 'DF__Productos__Codig__2E1BDC42';

--* reiniciar auto numerico
DBCC CHECKIDENT (Ordenes, RESEED, 0);

DBCC CHECKIDENT (DetalleOrdenes, RESEED, 0);

--** Modificando Ordenes
use Ecommerce;

ALTER TABLE dbo.Ordenes
  ALTER COLUMN CodigoQr NVARCHAR(MAX) null;


ALTER TABLE dbo.Ordenes
	ADD FechaCaducidad DATETIME NULL;

ALTER TABLE dbo.ProductoTallas
	ADD CantidadVendida INT DEFAULT 0 NULL;