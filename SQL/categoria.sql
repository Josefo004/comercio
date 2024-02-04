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
	Cantidad INT DEFAULT 0 NOT NULL,
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
  ADD CodigoProducto VARCHAR(10) NULL,

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
  ADD FechaCaducidadPreVenta DATE NULL,
  ADD FechaCaducidadReserva DATE NULL,

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