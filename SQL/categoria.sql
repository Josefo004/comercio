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
	IdTalla INT NOT NULL,
	Cantidad INT DEFAULT 1 NOT NULL,
	FechaCreacion DATE DEFAULT (getdate()) NOT NULL,
	FechaModificacion DATE NULL,
	CONSTRAINT FK_IdProducto_ProductoTallas FOREIGN KEY (IdProducto) REFERENCES dbo.Productos(IdProducto),
	CONSTRAINT FK_IdTalla_ProductoTallas FOREIGN KEY (IdTalla) REFERENCES dbo.Tallas(IdTalla),
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
	FechaCreacion DATE DEFAULT (getdate()) NOT NULL,
	FechaModificacion DATE NULL,
	CONSTRAINT FK_IdProducto_ProductoTallas FOREIGN KEY (IdProducto) REFERENCES dbo.Productos(IdProducto),
	CONSTRAINT FK_IdTalla_ProductoTallas FOREIGN KEY (IdTalla) REFERENCES dbo.Tallas(IdTalla),
);

