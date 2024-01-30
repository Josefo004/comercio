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

-- *************************
-- *************************
-- *************************

USE Ecommerce;

DROP TABLE dbo.CategoriaProducto;

CREATE TABLE dbo.CategoriaProducto(
	IdCategoriaProducto INT PRIMARY KEY IDENTITY (1, 1),
	Descripcion VARCHAR(200) NOT NULL,
);

INSERT INTO CategoriaProducto (Descripcion) VALUES('CAMISETA - POLERA');
INSERT INTO CategoriaProducto (Descripcion) VALUES('CAMISA');
INSERT INTO CategoriaProducto (Descripcion) VALUES('CHAQUETA');
INSERT INTO CategoriaProducto (Descripcion) VALUES('CHAMARRA');
INSERT INTO CategoriaProducto (Descripcion) VALUES('JERSEY - CHOMPA');
INSERT INTO CategoriaProducto (Descripcion) VALUES('SUDADERA');
INSERT INTO CategoriaProducto (Descripcion) VALUES('CANGURO');
INSERT INTO CategoriaProducto (Descripcion) VALUES('ABRIGO');
INSERT INTO CategoriaProducto (Descripcion) VALUES('POLO - POLERA CON CUELLO');
INSERT INTO CategoriaProducto (Descripcion) VALUES('MEDIAS');


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
	Cantidad INT DEFAULT 1 NOT NULL,
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
  ADD IdCategoriaGenero INT DEFAULT 1 NOT NULL;
  
ALTER TABLE dbo.Productos
  ADD CONSTRAINT FK_IdCategoriaGenero_Productos FOREIGN KEY (IdCategoriaGenero) REFERENCES dbo.CategoriaGenero(IdCategoriaGenero);

ALTER TABLE dbo.Productos
  ADD CodigoEstado CHAR(1) DEFAULT 'V'  NOT NULL;
  
ALTER TABLE dbo.Productos
  ADD CONSTRAINT FK_CodigoEstado_Productos FOREIGN KEY (CodigoEstado) REFERENCES dbo.Estados(CodigoEstado);

select * from Productos;

update Productos set Imagen = 'AUJmIbzvbe6UktWlsMC6lhz0JiLuxOpw/polera2.jpg' where IdProducto in (28,30,32,34,36,38,40,42)

update Productos set Imagen = '-F-5nC5Dm34LkgpfLjlEbAPqVbQ8IVB1/polera femenina.jpg' where IdProducto in (29,31,33,35,37,39,41,43)



