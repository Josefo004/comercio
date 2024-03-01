USE Pagos;

DROP TABLE dbo.Tramites;

CREATE TABLE dbo.Tramites(
	CodigoTramite INT PRIMARY KEY IDENTITY (1, 1),
	Tramite VARCHAR(100) NOT NULL,
  CodigoEstado CHAR(1) DEFAULT 'V' NOT NULL,
  MULTIPLICAR BIT DEFAULT 0 NOT NULL
);

insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(1, 'Solicitud MEMORIAL SIMPLE', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(3, 'Solicitud DEF. MOD. GRADUACION 1ra. opcion', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(4, 'Solicitud DEF. MOD. GRADUACION 2da. opcion', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(5, 'Solicitud DEF. MOD. GRADUACION 3ra. opcion', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(6, 'Solicitud COLACION DE GRADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(7, 'Solicitud TIT. PROVISION NAL.', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(8, 'APROBACION MOD. DE GRADUACION', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(9, 'Solicitud CEPI TITULOS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(10, 'Solicitud CEPI CONVALIDACION', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(11, 'Solicitud CEPI REGULARIDAD', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(12, 'Solicitud CEPI CONCLUSION DE ESTUDIOS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(13, 'Solicitud CEPI CERTIFICADO DE DOCENCIA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(14, 'Solicitud CEPI MODULOS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(15, 'Solicitud CEPI MODALIDAD DE GRADUACION', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(16, 'Solicitud CEPI CARGA HORARIA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(17, 'Solicitud EXTENSION APROBACION INTERNADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(18, 'SOLVENCIA UNIVERSITARIA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(19, 'SOLVENCIA UNIVERSITARIA-EGRESADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(20, 'LEGALIZACION Fotocopia DIP. BACHILLER', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(21, 'LEGALIZACION Fotocopia DIP. ACADEMICO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(22, 'LEGALIZACION Fotocopia T. P. N.', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(23, 'LEGALIZACION Fotocopia TIT. POSGRADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(24, 'LEGALIZACION Fotocopia RESOLUCIONES', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(25, 'LEGALIZACION Fotocopia MATRICULA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(26, 'LEGALIZACION Fotocopia MEMORANDO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(27, 'LEGALIZACION CERT. ESTUDIANTES EXTRANJEROS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(28, 'CERTIFICADO DE SERVICIOS ADMINISTRATIVO', 'V', 1);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(29, 'CERTIFICADO DE SERVICIOS DOCENTE', 'V', 1);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(30, 'CERTIFICADO CALIFICACIONES Trámite Nal. A-1', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(31, 'CERTIFICADO CALIFICACIONES Trámite Nal. C-1', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(32, 'CERTIFICADO CALIFICACIONES Trámite Ext. A-1', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(33, 'CERTIFICADO CALIFICACIONES Trámite Ext. C-1', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(34, 'FORMULARIO LEGALIZACION DE PROGR. TRAMITE NAL', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(35, 'FORMULARIO LEGALIZACION DE PROGR. TRAMITE EXT.', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(36, 'LEGALIZACION PROGR. POR ASIGNATURA TRAMITE NAL. ', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(37, 'LEGALIZACION PROGR. POR ASIGNATURA TRÁMITE EXT.', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(38, 'FORMULARIO LEGALIZ. PROGR. POSGRADO TRAMITE NAL.', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(39, 'FORMULARIO LEGALIZ. PROGR. POSGRADO TRAMITE EXT.', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(40, 'LEGALIZACION POR PROGRAMA POSGRADO TRAMITE NAL. ', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(41, 'LEGALIZACION POR PROGRAMA POSGRADO TRAMITE EXT. ', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(42, 'LEGALIZACION DE RESOLUCION TITULO POSGRADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(43, 'Solicitud MEMORIAL SIMPLE (Estudiante)', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(44, 'CARATULA UNIVERSITARIA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(45, 'AUTENTICIDAD', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(46, 'TRAMITES ACADEMICOS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(47, 'KARDEX ACADEMICO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(48, 'TRAMITES ADMINISTRATIVOS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(49, 'CERTIFICADO DEL EJERCICIO DOC-ADM', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(50, 'SOLICITUD SIMPLE', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(51, 'LEGALIZACION FOTOC. DOCUMENTOS ACADEMICOS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(52, 'LEGALIZACION FOTOC. HABERES PERCIBIDOS DESCUENTOS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(53, 'FOLDER PARA BECARIO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(54, 'CAMBIO DE CARRERA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(55, 'TRASPASO ESTUDIANTES NACIONALES', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(56, 'TRASPASO EXTRANJEROS TRAMITE NACIONAL', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(57, 'TRASPASO EXTRANJEROS TRAMITE INTERNACIONAL', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(58, 'FOLDER UNIVERSITARIO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(59, 'Solicitud CEPI PROGRAMAS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(60, 'Solicitud CERTIFICADO DE TRABAJO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(61, 'SOLVENCIA UNIVERSITARIA ADM-DOC', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(62, 'OTRAS CERTIFICACIONES', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(63, 'Solicitud LICENCIA O DECLARATORIA EN COMISION', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(64, 'LEGALIZACION DE FOTOC. PAPELETA DE PAGO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(67, 'Solicitud CERTIF. TUTORIAS, COMISION DE GRADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(68, 'Solicitud EXAMEN DE COMPETENCIA, CONCURSO MERITOS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(70, 'LEGALIZACION FOTO. CERTIFICADOS DOCUMENTOS (Univ.)', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(71, 'LEGALIZACION DOCUMENTOS (DOC-ADM)', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(72, 'SOLICITUD TRAMITE DE REVALIDACION POSGRADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(73, 'Adquisic. CONVOC. CGOS. JERARQ.', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(74, 'CONTRATO DE TRABAJO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(75, 'GUIA ESTUDIANTE', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(76, 'DIPLOMA ACADEMICO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(77, 'DIPLOMA ACADEMICO P/ EXTRANJEROS', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(78, 'TITULO PROVISION NACIONAL', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(79, 'TITULO PROVISION NACIONAL (Extranjeros)', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(80, 'DIPLOMADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(81, 'TITULO ACADEMICO ESPECIALIDAD', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(82, 'TITULO ACADEMICO MAESTRIA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(83, 'TITULO ACADEMICO DOCTORADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(84, 'REVALIDACION TIT. PROVISION NAL.', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(85, 'REVALIDACION TITULO DIPLOMADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(86, 'REVALIDACION TITULO ESPECIALIDAD', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(87, 'REVALIDACION TITULO MAESTRIA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(88, 'REVALIDACION TITULO DOCTORADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(89, 'REVALIDACION TIT. ESPECIALIDAD CLINICO QUIRURGICO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(90, 'REVALIDACION DIPLOMA ACADEMICO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(91, 'DIPLOMA ACADEMICO EXCELENCIA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(92, 'DIPLOMA ACADEMICO DISCAPACIDAD', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(93, 'TITULO PROVISION NACIONAL EXCELENCIA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(94, 'TITULO PROVISION NACIONAL DISCAPACIDAD', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(95, 'LEGALIZACION DIPLOMADO - Posgrado', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(96, 'SUPLETORIO DIPLOMA DE BACHILLER', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(97, 'SUPLETORIO EGRESO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(98, 'SUPLETORIO ACADEMICO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(99, 'SUPLETORIO ACADEMICO EXTRANJERO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(100, 'SUPLETORIO TITULO PROV. NACIONAL', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(101, 'SUPLETORIO TITULO PROV. NACIONAL EXTRANJERO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(102, 'SUPLETORIO DIPLOMADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(103, 'SUPLETORIO ESPECIALIDAD', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(104, 'SUPLETORIO MAESTRIA', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(105, 'SUPLETORIO DOCTORADO', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(106, 'ADMISIONES ESPECIALES', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(107, 'DIPLOMA ACADEMICO (CONVENIO)', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(108, 'TITULO PROVISION NACIONAL (CONVENIO)', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(109, 'RENOVACION C.U', 'V', 0);
insert into Tramite (CodigoTramite, Tramite, CodigoEstado, Multiplicar) values(1109, 'CU PROVISIONAL A VIGENTE', 'V', 0);

USE Pagos;

DROP TABLE dbo.Conceptos;

CREATE TABLE dbo.Conceptos(
	CodigoConcepto INT PRIMARY KEY IDENTITY (1, 1),
	Concepto VARCHAR(100) NOT NULL,
  Monto DECIMAL (10, 2) NULL,
  Estado BIT DEFAULT 0 NOT NULL
);

insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(1, 'MEMORIAL', 20, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(2, 'DIPLOMA ACADEMICO Nal.', 435, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(3, 'TPN', 500, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(4, 'PRO CLUB UNIVERSITARIO', 8, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(5, 'MEMORIAL', 120, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(6, 'MEMORIAL', 100, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(7, 'MEMORIAL', 120, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(8, 'MEMORIAL', 60, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(9, 'SOLVENCIA', 5, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(10, 'PRO CLUB UNIVERSITARIO', 2, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(11, 'LEGALIZACION Fot.DIP.BACHILLER', 30, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(12, 'PRO CLUB UNIVERSITARIO', 1, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(13, 'LEGALIZACION Fot. ACADEMICO', 70, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(14, 'LEGALIZACION Fot. T.P.N.', 90, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(19, 'LEGALIZACION Fot. TIT.POSGRADO', 300, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(20, 'LEGALIZACION Fot. RESOLUCIONES', 15, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(21, 'LEGALIZACION Fot. MATRICULA', 7, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(22, 'LEGALIZACION Fot. MEMORANDO', 32, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(23, 'LEL. CERT. EST. EXTRANJEROS', 7, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(24, 'CERTIFICADO  SERVICIOS ADM ', 60, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(25, 'CERTIFICADO  SERVICIOS DOC', 80, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(26, 'CERTIFICADO CALIF. NAL. A-1', 23, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(27, 'CERTIFICADO CALIF. NAL C-1', 10, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(28, 'CERTIFICADO CALIF. EXT. A-1', 58, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(29, 'CERTIFICADO CALIF. EXT C-1', 53, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(30, 'FORMULARIO Legalización de Progr. Trámite Nacional', 45, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(31, 'FORMULARIO Legalización de Progr. Trámite Exterior', 200, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(32, 'LEGALIZACION Progr. por Asignatura Trámite Nacional ', 20, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(33, 'LEGALIZACION Progr. por Asignatura Trámite Exterior', 100, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(34, 'FORMULARIO Legalización de Progr. Posgrado Trámite Nacional', 300, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(35, 'FORMULARIO Legalización de Progr. Posgrado Trámite Exterior', 400, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(36, 'LEGALIZACION por Programa Posgrado Trámite Nacional ', 50, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(37, 'LEGALIZACION por Programa Posgrado Trámite Exterior ', 70, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(38, 'LEGALIZACION de Resolución Título Posgrado', 100, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(39, 'MEMORIAL', 0, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(40, 'CARATULA UNIVERSITARIA', 2, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(41, 'AUTENTICIDAD', 20, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(42, 'TRAMITES ACADEMICOS', 10, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(43, 'KARDEX ACADEMICA', 2, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(44, 'TRAMITES ADM', 10, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(45, 'CERTIFICADO EJERCICIO DOC-ADM', 17, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(46, 'SOLICITUD SIMPLE', 20, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(47, 'LEGALIZACION fotoc. doc. academicos', 15, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(48, 'LEGALIZACION fotoc. haberes y descuentos', 32, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(49, 'FOLDER PARA BECARIO', 3, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(50, 'CAMBIO DE CARRERA', 30, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(51, 'TRASPASO ESTUDIANTES NACIONALES', 150, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(52, 'TRASPASO EXTRANJEROS TRAMITE NACIONAL', 400, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(53, 'TRASPASO EXTRANJEROS TRAMITE INTERNACIONAL', 800, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(54, 'FOLDER', 10, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(55, 'MEMORIAL', 40, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(56, 'SOLVENCIA', 28, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(57, 'CERTIFICACION', 50, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(58, 'LICENCIA, DECLATATORIA EN COMISION', 30, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(59, 'PAPELETA DE PAGO', 10, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(60, 'MEMORIAL', 220, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(61, 'FOTOCOPIAS', 45, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(62, 'LEGALIZACION DOCUMENTOS', 35, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(63, 'Colocar nombre', 220, 0);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(64, 'Adquisic. CONVOC. CGOS. JERARQ.', 100, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(65, 'Registro de Contratos Nacionales', 16, 0);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(66, 'Refrenda de Finiquitos', 33, 0);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(67, 'Contrato de Trabajo', 100, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(68, 'Guia Estudiante', 36, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(69, 'DIPLOMA ACADEMICO EXTRANJEROS', 600, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(70, 'TITULO PROVISION NACIONAL', 450, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(71, 'TITULO PROVISION NACIONAL (Extranjeros)', 800, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(72, 'DIPLOMADO', 490, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(73, 'ESPECIALIDAD', 800, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(74, 'MAESTRIA', 800, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(75, 'DOCTORADO', 1050, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(76, 'REVALIDACION TITTULO PROVISION NACIONAL', 1300, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(77, 'REVALIDACION TITULO DIPLOMADO', 500, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(78, 'REVALIDACION TITULO DIPLOMADO', 800, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(79, 'REVALIDACION TITULO MAESTRIA', 800, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(80, 'REVALIDACION TITULO MAESTRIA', 1000, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(81, 'REVALIDACION TITULO ESPECIALIDAD CLINICO QUIRURGICO', 1000, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(82, 'REVALIDACION DIPLOMA ACADEMICO', 500, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(83, 'DIPLOMA ACADEMICO EXCELENCIA', 0, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(84, 'DIPLOMA ACADEMICO DISCAPACIDAD', 0, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(85, 'TITULO PROVISION NACIONAL EXCELENCIA', 0, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(86, 'TITULO PROVISION NACIONAL DISCAPACIDAD', 0, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(87, 'LEGALIZACION DIPLOMADO - Posgrado', 120, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(88, 'Supletorio de Diploma de Bachiller', 400, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(89, 'Supletorio de Egreso', 750, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(90, 'Supletorio de Diploma Académico', 750, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(91, 'Supletorio de Diploma Académico Extranjero', 700, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(92, 'Supletorio Título Provision Nacional', 1500, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(93, 'Supletorio Título Provision Nacional Extranjero', 1700, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(94, 'Supletorio de Diplomado', 760, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(95, 'Supletorio de Especialidad', 1510, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(96, 'Supletorio de Maestria', 1700, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(97, 'Supletorio de Doctorado', 1900, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(98, 'SOLICITUD y APERTURA FOLDER VIRTUAL', 30, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(99, 'DIPLOMA ACADEMICO (CONVENIO)', 0, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(100, 'TITULO PROVISION NACIONAL (CONVENIO)', 0, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(101, 'CARNET UNIVERSITARIO', 50, 1);
insert into Conceptos(CodigoConcepto, Concepto, Monto, Estado) values(1101, 'PRO CLUB UNIVERSITARIO', 16, 1);

USE Pagos;

DROP TABLE dbo.TipoCuenta;

CREATE TABLE dbo.TipoCuenta(
	TipoCuenta INT PRIMARY KEY IDENTITY (1, 1),
	Descripcion VARCHAR(100) NOT NULL,
  Cuenta VARCHAR(50) NULL,
  Banco VARCHAR(100) NULL,
);

insert into TipoCuenta(TipoCuenta, Descripcion, Cuenta, Banco) values(1, 'FONDOS EN CUSTODIA', '415-554', 'UNION');
insert into TipoCuenta(TipoCuenta, Descripcion, Cuenta, Banco) values(2, 'RECURSOS PROPIOS', '416-451', 'UNION');
