-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 15, 2021 at 08:18 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apialdeas`
--

-- --------------------------------------------------------

--
-- Table structure for table `abordajinterno`
--

CREATE TABLE `abordajinterno` (
  `id` int(11) NOT NULL,
  `incidenteid` int(11) NOT NULL,
  `status` text NOT NULL,
  `plan` varchar(50) NOT NULL,
  `plan_docto` varchar(50) NOT NULL,
  `documentos` varchar(50) NOT NULL,
  `documentos_docto` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `fechaUpdate` date NOT NULL,
  `programa` int(11) DEFAULT NULL,
  `folioabordaje` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `nombrecargo` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cargos`
--

INSERT INTO `cargos` (`id`, `nombrecargo`, `descripcion`, `activo`) VALUES
(10, 'Colaborador SOS', 'Pendiente', 1),
(11, 'Cuidador de AtenciÃ³n Directa', 'Pendiente', 1),
(12, 'NiÃ±a o NiÃ±o Participantes', 'Pendiente', 1),
(13, 'Persona anÃ³nima', 'Pendiente', 1),
(14, 'Persona Externa', 'Pendiente', 1),
(15, 'Otro', 'Pendiente', 1);

-- --------------------------------------------------------

--
-- Table structure for table `conciencia`
--

CREATE TABLE `conciencia` (
  `id` int(11) NOT NULL,
  `estatus` text NOT NULL,
  `clasificacion` varchar(50) NOT NULL,
  `activo` varchar(50) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `docto` varchar(50) DEFAULT NULL,
  `estatusplan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `denuncialegal`
--

CREATE TABLE `denuncialegal` (
  `id` int(11) NOT NULL,
  `incidenteid` int(11) DEFAULT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
  `foliodenuncia` varchar(50) DEFAULT NULL COMMENT 'Folio de la denuncia',
  `programa` varchar(50) DEFAULT NULL,
  `consenso` varchar(50) NOT NULL COMMENT 'Texto para redactar conclusiones del consenso',
  `consensodocto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos del consenso ',
  `soportecontacto` varchar(50) NOT NULL COMMENT 'Contacto al soporte legal',
  `soporteantes` varchar(50) NOT NULL COMMENT 'acompañamiento del soporte antes',
  `soportedurante` varchar(50) NOT NULL COMMENT 'acompañamiento del soporte legal durante',
  `soporteemocionalcontacto` varchar(50) NOT NULL COMMENT 'contacto con el soporte emocional',
  `soporteemocionalantes` varchar(50) NOT NULL COMMENT 'soporte emocional antes ',
  `soporteemocionaldurante` varchar(50) NOT NULL COMMENT 'soporte emocional durante',
  `medidasd` varchar(50) NOT NULL COMMENT 'Se han tomado medidas : SI,NO,POR CONFIRMAR',
  `medidasd_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de las medidas tomadas',
  `medidastexto` text NOT NULL COMMENT 'Texto acerca de las medidas tomadas',
  `fechaCreacion` date NOT NULL COMMENT 'fecha de creacion',
  `fechaUpdate` date NOT NULL COMMENT 'fecha de actualizacion',
  `estado` varchar(50) NOT NULL COMMENT 'Estado de la denuncia ABIERTO O CERRADO',
  `informapatronato` varchar(50) DEFAULT NULL,
  `docto_informapatronato` varchar(50) DEFAULT '0',
  `informaoficinaregional` varchar(50) DEFAULT NULL,
  `docto_informaoficinaregional` varchar(50) DEFAULT '0',
  `informaenterector` varchar(50) DEFAULT NULL,
  `docto_informaenterector` varchar(50) DEFAULT '0',
  `docto_soportelegal` varchar(50) DEFAULT '0',
  `docto_soporteemocional` varchar(50) DEFAULT '0',
  `denunciapresentada` varchar(50) DEFAULT NULL,
  `docto_denunciapresentada` varchar(50) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `denuncialegal`
--

INSERT INTO `denuncialegal` (`id`, `incidenteid`, `foliodenuncia`, `programa`, `consenso`, `consensodocto`, `soportecontacto`, `soporteantes`, `soportedurante`, `soporteemocionalcontacto`, `soporteemocionalantes`, `soporteemocionaldurante`, `medidasd`, `medidasd_docto`, `medidastexto`, `fechaCreacion`, `fechaUpdate`, `estado`, `informapatronato`, `docto_informapatronato`, `informaoficinaregional`, `docto_informaoficinaregional`, `informaenterector`, `docto_informaenterector`, `docto_soportelegal`, `docto_soporteemocional`, `denunciapresentada`, `docto_denunciapresentada`) VALUES
(1, 5, 'DL--1-2021', '1', 'CONFIRMADO', '\"17\"', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', '\"14\"', 'y aunque teu quejesy aunque teu quejesy aunque teu quejesy aunque teu quejesy aunque teu quejesy aunque teu quejesy aunque teu quejesy aunque teu quejesy aunque teu quejesy aunque teu quejesy aunque teu quejesy aunque teu quejes', '2021-08-09', '2021-08-09', 'cerrado', 'SI', '\"10\"', 'SI', '\"11\"', 'NO', '\"12\"', '\"16\"', '\"13\"', 'SI', '\"15\"');

-- --------------------------------------------------------

--
-- Table structure for table `doctos`
--

CREATE TABLE `doctos` (
  `id` int(11) NOT NULL COMMENT 'Identificador unico del registro y llave primaria',
  `incidenteId` int(11) NOT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
  `nombreOriginal` text NOT NULL COMMENT 'Nombre del documento',
  `ext` varchar(50) NOT NULL COMMENT 'tipo de extesion del documento',
  `fechaCreacion` date NOT NULL COMMENT 'Fecha en la que se creo el documento',
  `fechaUpdate` date NOT NULL COMMENT 'Fecha en la que se actualizo el documento',
  `nombreinterno` text NOT NULL COMMENT 'Nombre que se le asigna en servidor',
  `directorio` text NOT NULL COMMENT 'carpeta en la que se aloja dentro del servidor'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctos`
--

INSERT INTO `doctos` (`id`, `incidenteId`, `nombreOriginal`, `ext`, `fechaCreacion`, `fechaUpdate`, `nombreinterno`, `directorio`) VALUES
(1, 0, 'ticket-chocolate.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628553674918', 'contenedorpdf'),
(2, 0, 'Formato+Workbook+Glossary.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628553769545', 'contenedorpdf'),
(3, 0, 'RebelBot-PasarelasOpenPay(4).pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628555959562', 'contenedorpdf'),
(4, 0, 'jjesussalinas(1).pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628556999507', 'contenedorpdf'),
(5, 0, '2020-3T20-Reporte.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628560357868', 'contenedorpdf'),
(6, 0, '1625673424018.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628562213805', 'contenedorpdf'),
(7, 0, 'RebelBot-PasarelasOpenPay.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628562339570', 'contenedorpdf'),
(8, 0, '1625673424018.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628562582299', 'contenedorpdf'),
(9, 0, 'E0800F4J70(1).pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628566479262', 'contenedorpdf'),
(10, 0, '2c1365_36ae3fd50fdb4d4397eff96e78afd66d.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628567033065', 'contenedorpdf'),
(11, 0, '1625673424018.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628567056504', 'contenedorpdf'),
(12, 0, 'Formato+Irregular+Verbs+Conjugator.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628567070351', 'contenedorpdf'),
(13, 0, 'RebelBot IT - Ultimos servicios 290720.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628567105077', 'contenedorpdf'),
(14, 0, 'cedula de identificacion fiscal.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628567293572', 'contenedorpdf'),
(15, 0, 'Manual-EC-PM-80250.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628567315176', 'contenedorpdf'),
(16, 0, 'MÃ‰TODO GRÃFICO DE SINGAPUR 1Â° GRADO (IMPRIMIBLE).pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628567327448', 'contenedorpdf'),
(17, 0, 'PROCESO_CRUD_ROLES.pdf', 'pdf', '2021-08-09', '2021-08-09', 'docto_1628568097377', 'contenedorpdf');

-- --------------------------------------------------------

--
-- Table structure for table `doctosapoyo`
--

CREATE TABLE `doctosapoyo` (
  `id` int(11) NOT NULL COMMENT 'Identificador de la tabla',
  `nombredocto` text,
  `descripcion` text,
  `link` text,
  `categoria` text,
  `activo` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctosapoyo`
--

INSERT INTO `doctosapoyo` (`id`, `nombredocto`, `descripcion`, `link`, `categoria`, `activo`) VALUES
(1, 'Politica de Proteccion Infantil', 'Politica de Proteccion Infantil', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21703&parId=D1B73E758E4318E6%21690&o=OneUp', 'vi', 1),
(2, 'CÃ³digo de Conducta ', 'CÃ³digo de Conducta ', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21709&parId=D1B73E758E4318E6%21690&o=OneUp', 'vi', 1),
(3, 'Directorio de Emergencia', 'Directorio de Emergencia', '.', 'vi', 0),
(4, 'Violentometro', 'Violentometro', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21707&parId=D1B73E758E4318E6%21690&o=OneUp', 'vi', 0),
(5, 'Politica de Proteccion Infantil', 'Politica de Proteccion Infantil', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21703&parId=D1B73E758E4318E6%21690&o=OneUp', 'v integral', 1),
(6, 'CÃ³digo de Conducta', 'CÃ³digo de Conducta', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21709&parId=D1B73E758E4318E6%21690&o=OneUp', 'v integral', 1),
(7, 'Violentometro', 'Violentometro', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21707&parId=D1B73E758E4318E6%21690&o=OneUp', 'v integral', 1),
(8, 'GuÃ­a de intervenciÃ³n PAS y CSP', 'GuÃ­a de intervenciÃ³n PAS y CSP', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21700&parId=D1B73E758E4318E6%21690&o=OneUp', 'v integral', 1),
(9, 'GuÃ­a de intervenciÃ³n Familiar PAS y CSP', 'GuÃ­a de intervenciÃ³n Familiar PAS y CSP', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21704&parId=D1B73E758E4318E6%21690&o=OneUp', 'v integral', 1),
(10, 'Manual de investigaciÃ³n interna', 'Manual de investigaciÃ³n interna', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21718&parId=D1B73E758E4318E6%21690&o=OneUp', 'dl', 1),
(11, 'Herramientas para investigacion interna', 'Herramientas para investigacion interna', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21709&parId=D1B73E758E4318E6%21690&o=OneUp', 'dl', 1),
(12, 'Manual de investigaciÃ³n interna', 'Manual de investigaciÃ³n interna', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21718&parId=D1B73E758E4318E6%21690&o=OneUp\",       ', 'i', 1),
(13, 'Herramientas para investigacion interna', 'Herramientas para investigacion interna', 'https://onedrive.live.com/?authkey=%21AhxF5wMG%5FSJ00H0&cid=D1B73E758E4318E6&id=D1B73E758E4318E6%21709&parId=D1B73E758E4318E6%21690&o=OneUp', 'i', 1);

-- --------------------------------------------------------

--
-- Table structure for table `evidencias`
--

CREATE TABLE `evidencias` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `descripcion` text NOT NULL,
  `ubicacion` text NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `investigacionid` int(11) NOT NULL,
  `activo` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incidente`
--

CREATE TABLE `incidente` (
  `id` bigint(20) NOT NULL COMMENT 'Identificador unico del registro y llave primaria',
  `folio` varchar(50) NOT NULL COMMENT 'Folio que identifica el incidente durante el proceso',
  `programa` varchar(50) NOT NULL COMMENT 'Programa en donde se genero el incidente',
  `fechaAlta` datetime NOT NULL COMMENT 'fecha de creacion del registro',
  `fechaUpdate` datetime NOT NULL COMMENT 'Fecha de Actualizacion del registro',
  `usuarioCreador` int(11) NOT NULL COMMENT 'usuario que creo el. registro',
  `involucrados` text NOT NULL COMMENT 'Texto en donde se describen los involucrados',
  `elaboro` varchar(50) NOT NULL COMMENT 'Nombre si se conoce del denunciante',
  `cargousuario` varchar(50) NOT NULL COMMENT 'cargo del denunciante',
  `registrohechos` text NOT NULL COMMENT 'Texto en donde se registran los hechos',
  `prefildelagresor` varchar(50) NOT NULL COMMENT 'Perfil del Agresor : Adulto a niña/niño o Entre pares',
  `paadultocolaborador` varchar(50) DEFAULT NULL COMMENT 'Opciones: Colaborador SOS, Familiar o Adulto Externo',
  `paadultocolaboradortipo` varchar(50) DEFAULT NULL COMMENT 'Opciones a escoger de COlaborador SOS u Opciones de Famila',
  `pafamilia` varchar(50) DEFAULT NULL COMMENT 'obsoleto',
  `pafamiliatipo` varchar(50) DEFAULT NULL COMMENT 'obsoleto',
  `adultoexterno` varchar(50) DEFAULT NULL COMMENT 'obsoleto',
  `perfilvictima` varchar(50) NOT NULL COMMENT 'Niña o niño',
  `recibeayuda` varchar(50) NOT NULL COMMENT 'Es apoyado o no por SOS',
  `medidasproinmediatas` text NOT NULL COMMENT 'Texto para describir las medidas integrales que se han tomado en primer instancia',
  `incidenteconfirmado` varchar(50) NOT NULL COMMENT 'Primera evaluación del incidente',
  `testigos` text COMMENT 'Texto para la descripcion de los testigos involucrados en el incidente',
  `nnj` varchar(50) NOT NULL COMMENT 'obsoleto',
  `etapa` int(11) NOT NULL COMMENT 'etapa actual en la que se encuentra el incidente-uso grafico',
  `activo` int(11) NOT NULL COMMENT 'Estado del status',
  `etapauno` varchar(50) DEFAULT NULL COMMENT 'Para uso grafico  , muestr u oculta el boton de valoracion inicial',
  `etapados` varchar(50) DEFAULT NULL COMMENT ' 	Para uso grafico , muestr u oculta el boton de valoracion Integral',
  `etapatres` varchar(50) DEFAULT NULL COMMENT ' 	Para uso grafico , muestr u oculta el boton de seguimiento',
  `etapacuatro` varchar(50) DEFAULT NULL COMMENT ' 	Para uso grafico , muestr u oculta el boton de cierre',
  `coloretapauno` varchar(50) DEFAULT NULL COMMENT 'Para manejo del color actual del boton de valoracion inicial',
  `coloretapados` varchar(50) DEFAULT NULL COMMENT 'Para manejo del color actual del boton de valoracion Integral',
  `coloretapatres` varchar(50) DEFAULT NULL COMMENT 'Para manejo del color actual del boton de seguimiento',
  `coloretapacuatro` varchar(50) DEFAULT NULL COMMENT 'Para manejo del color actual del boton de cierre',
  `textocierre` text COMMENT 'Texto del dictamen del cierre del incidente',
  `estado` varchar(50) DEFAULT NULL COMMENT 'Estado de este incidente, puede ser abierto , cerrado o cerrado por no ser incidente',
  `fechaCierre` date DEFAULT NULL,
  `actavaloracion` int(11) DEFAULT NULL,
  `actavaloracion_docto` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incidente`
--

INSERT INTO `incidente` (`id`, `folio`, `programa`, `fechaAlta`, `fechaUpdate`, `usuarioCreador`, `involucrados`, `elaboro`, `cargousuario`, `registrohechos`, `prefildelagresor`, `paadultocolaborador`, `paadultocolaboradortipo`, `pafamilia`, `pafamiliatipo`, `adultoexterno`, `perfilvictima`, `recibeayuda`, `medidasproinmediatas`, `incidenteconfirmado`, `testigos`, `nnj`, `etapa`, `activo`, `etapauno`, `etapados`, `etapatres`, `etapacuatro`, `coloretapauno`, `coloretapados`, `coloretapatres`, `coloretapacuatro`, `textocierre`, `estado`, `fechaCierre`, `actavaloracion`, `actavaloracion_docto`) VALUES
(1, 'TH-1-2021', '10', '2021-08-09 00:00:00', '2021-08-09 00:00:00', 25, 'sdrfasfasdfasdf asdf asdf asdfasd fsad fsda fsad fdsa fsad fsda fdsaf sdaf sadf sda fsadf sdaf sdaf sad fsdaf asd', 'marcos cabrera', 'Colaborador SOS', 'el registro de los hecho ', 'ADULTO A NIÃ‘A O NIÃ‘O', 'COLABORADOR SOS', 'SOPORTE TÃ‰CNICO', '', '', '', 'NIÃ‘A', 'RECIBE AYUDA SOS', 'las medidas de seguridad', 'SI', 'el testigo ', '', 1, 1, 'visible', 'visible', 'invisible', 'invisible', 'yellow', 'yellow', 'yellow', 'yellow', '.', 'en espera de valoracion', NULL, 0, NULL),
(2, 'MO-1-2021', '2', '2021-08-09 00:00:00', '2021-08-09 00:00:00', 25, '\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;', 'marcos cabrer', 'Colaborador SOS', 'sdfasd fasd fsda fasd fasd fasdf sda fsadf sda fsadf sdaf sdaf sdaf sadf sadf', 'ADULTO A NIÃ‘A O NIÃ‘O', 'COLABORADOR SOS', 'SOPORTE TÃ‰CNICO', '', '', '', 'NIÃ‘A', 'RECIBE AYUDA SOS', '\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;', 'SI', '\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;', '', 1, 1, 'visible', 'visible', 'invisible', 'invisible', 'yellow', 'yellow', 'yellow', 'yellow', '.', 'en espera de valoracion', NULL, 0, NULL),
(3, 'TX-1-2021', '7', '2021-08-09 00:00:00', '2021-08-09 00:00:00', 25, 'zcx\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;', 'asdfasdfsadfsda', 'Cuidador de AtenciÃ³n Directa', '\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;', 'ADULTO A NIÃ‘A O NIÃ‘O', 'COLABORADOR SOS', 'OTRO', '', '', '', 'NIÃ‘O', 'NO RECIBE AYUDA SOS', '\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;', 'SI', '\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;\n         this.ocultarFileinput= false;\n         this.archivoEnLinea= true;\n         this.nombre_de_archivo_original =  this.elArchivo;    \n         this.subionotok= true;', '', 1, 1, 'visible', 'visible', 'invisible', 'invisible', 'yellow', 'yellow', 'yellow', 'yellow', '.', 'en espera de valoracion', NULL, 0, NULL),
(4, 'MX-1-2021', '3', '2021-08-09 00:00:00', '2021-08-09 00:00:00', 25, 'asdfasd fsad fsadf sadf sad fsdaf sdasdf sda af sd', 'adfa sdfas dfsda fsd fsdf sadf sdaf sd fsdaf sdf ', 'Cuidador de AtenciÃ³n Directa', 'sdf asdf sdafsad fsad fds fdsfsdafsdafsdafsadfasdfasdfasdfsadf', 'ADULTO A NIÃ‘A O NIÃ‘O', 'COLABORADOR SOS', 'ATENCION DIRECTA', '', '', '', 'NIÃ‘A', 'RECIBE AYUDA SOS', 'dsafasd fasdf sadf sdf sda fsdaf sdaf sadf sdaf sadfasd f', 'SI', 'adsfasdf asdf asd fasd fsd   dsaf sda fasd fsdaf asdf sdaf sadf asdf sdaf sadf', '', 1, 1, 'visible', 'visible', 'visible', 'visible', 'green', 'yellow', 'yellow', 'yellow', '.', 'en llenado de respuesta', NULL, NULL, '4'),
(5, 'TIJ-1-2021', '1', '2021-08-09 00:00:00', '2021-08-09 00:00:00', 25, 'marcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabrera', 'marcso cabrera', 'NiÃ±a o NiÃ±o Participantes', 'marcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabrera', 'ADULTO A NIÃ‘A O NIÃ‘O', 'COLABORADOR SOS', 'SOPORTE TÃ‰CNICO', '', '', '', 'NIÃ‘A', 'RECIBE AYUDA SOS', 'marcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabrera', 'SI', 'marcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabrera', '', 1, 1, 'visible', 'visible', 'visible', 'visible', 'green', 'green', 'yellow', 'yellow', '.', 'en llenado de seguimiento', NULL, NULL, '6');

-- --------------------------------------------------------

--
-- Table structure for table `investigacion`
--

CREATE TABLE `investigacion` (
  `id` int(11) NOT NULL COMMENT ' 	Identificador unico del registro y llave primaria',
  `incidenteid` int(11) NOT NULL COMMENT 'Llave secundaria, es el identificador del incidente ',
  `folioinvestigacion` varchar(50) NOT NULL COMMENT 'Folio de la Investigacion',
  `programa` varchar(50) DEFAULT NULL,
  `registroincidentes_docto` text NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
  `cartautorizacion_docto` varchar(50) NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
  `terminosreferencia_doctp` varchar(50) NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
  `plan_docto` varchar(50) NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
  `informe_docto` varchar(50) NOT NULL COMMENT 'Id del docuemento en la tabla Doctos',
  `fechaCreacion` date NOT NULL COMMENT 'Fe cha de la creacion del Registro',
  `fechaUpdate` date NOT NULL COMMENT 'Fecha de actualizacion del registro',
  `estado` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `investigacion`
--

INSERT INTO `investigacion` (`id`, `incidenteid`, `folioinvestigacion`, `programa`, `registroincidentes_docto`, `cartautorizacion_docto`, `terminosreferencia_doctp`, `plan_docto`, `informe_docto`, `fechaCreacion`, `fechaUpdate`, `estado`) VALUES
(1, 4, 'INV--1-2021', '3', '0', '0', '0', '0', '0', '2021-08-09', '2021-08-09', 'EN PROCESO');

-- --------------------------------------------------------

--
-- Table structure for table `parametros`
--

CREATE TABLE `parametros` (
  `id` int(11) NOT NULL,
  `nombreParametro` text NOT NULL,
  `descripcion` text NOT NULL,
  `valor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parametros`
--

INSERT INTO `parametros` (`id`, `nombreParametro`, `descripcion`, `valor`) VALUES
(1, 'numerow', 'numero de whatsapp para soporte de la app', '921308299700000'),
(2, 'correosoporte', 'correo para el soporte ', 'gabrielmoralestaylor@gmail.com, mcabrera@rebelbot.mx'),
(3, 'versionapp', 'nunmero de version de la app', '0.1.0'),
(4, 'messenger', 'cuenta de faceboook messenger', 'Pasteleriachocolatecoatza'),
(5, 'imagenEnLogin', 'imagen para desplegar en login', 'https://www.aldeasinfantiles.org.mx/getmedia/74fbaa0b-d357-480f-988c-adc2cba98bbf/conocenos.jpg?width=1366'),
(6, 'acuerdoprivacidad', 'el acuerdo para poder accesar a la plataforma', '<div align=\"center\"><h4>Aviso de Privacidad Aldeas Infantiles SOS MÃ©xico Aldeas </h4></div><div><br></div><div align=\"center\"><b>Infantiles </b>SOS MÃ©xico es una InstituciÃ³n de Asistencia Privada, independiente, no gubernamental, sin inclinaciÃ³n religiosa y de desarrollo social, que tiene como principal objetivo la formaciÃ³n de familias para niÃ±os y niÃ±as que han perdido la protecciÃ³n de sus padres, <br></div><div align=\"left\"><br></div><div align=\"left\"><b>i</b>ntegrÃ¡ndolos en un sistema que les permita desarrollar una vida normal, logrando asÃ­ convertirlos en jÃ³venes de provecho  La OrganizaciÃ³n tiene como fines, entre otros, proveer de cuidados familiares, proteger y dar bienestar a los niÃ±os, niÃ±as y jÃ³venes privados del cuidado <br></div><div align=\"left\">parental o en peligro de encontrarse en esa situaciÃ³n, mediante la implementaciÃ³n del programa de Aldeas Infantiles SOS que proporcionan a los niÃ±os, niÃ±as y jÃ³venes, un hogar integrado por una madre social, hermanos (sociales o biolÃ³gicos), una vida en comunidad, segÃºn el concepto de Hermann Gmeiner, en concordancia con las Directrices sobre las Modalidades Alternativas de Cuidado de los NiÃ±os de Naciones Unidas1, la ConvenciÃ³n sobre los Derechos del NiÃ±o2 y la ConstituciÃ³n PolÃ­tica de los Estados Unidos Mexicanos. Para el cumplimiento de dichos fines, Aldeas Infantiles SOS MÃ©xico implementa diferentes programas para recibir donativos, contando con la autorizaciÃ³n del Servicio de AdministraciÃ³n Tributaria y bajo los mÃ¡s estrictos parÃ¡metros de transparencia, asÃ­ como de protecciÃ³n de datos. Los programas a travÃ©s de los cuales recibe donativos se pueden consultar en nuestra pÃ¡gina de internet <br></div><div><br></div><div><br></div><div>www.aldeasinfantiles.org.mx  De conformidad con lo anterior, el objetivo del presente Aviso de Privacidad es informar las caracterÃ­sticas del tratamiento de los datos personales de los participantes o posibles participantes que apoyen los programas de donaciÃ³n de Aldeas Infantiles SOS MÃ©xico, en tÃ©rminos de lo dispuesto por la Ley Federal de ProtecciÃ³n de Datos Personales en PosesiÃ³n de los Particulares. La informaciÃ³n y datos personales de nuestros colaboradores, en sus distintos niveles, es muy importante, razÃ³n por la cual es tratada de manera estrictamente confidencial y con la secrecÃ­a necesaria para lograr los fines de la OrganizaciÃ³n, transmitir confianza a nuestros donantes o posibles donantes, por lo que hacemos un esfuerzo permanente para salvaguardarla.  Identidad y domicilio del responsable En concordancia con el derecho a la protecciÃ³n de datos personales en posesiÃ³n de particulares consagrado en el artÃ­culo 6Â° de la ConstituciÃ³n PolÃ­tica de los Estados Unidos Mexicanos, asÃ­ como en cumplimiento a las disposiciones de la Ley Federal de ProtecciÃ³n de Datos Personales en PosesiÃ³n de los Particulares, y con base en los principios de licitud, consentimiento, informaciÃ³n, calidad, finalidad, lealtad, proporcionalidad y responsabilidad; Aldeas Infantiles SOS MÃ©xico, I.A.P., con domicilio ubicado en Av. Morelos No. 43 Col. Rosas del Tepeyac, Del. Gustavo A. Madero, C.P. 07050, MÃ©xico D.F., es responsable de recabar y proteger sus datos personales, asÃ­ como del uso que se le dÃ© a los mismos.  Finalidad del tratamiento de datos Sus datos personales son utilizados para las siguientes finalidades: A) Los datos personales de los donantes nacionales e internacionales son utilizados de manera interna para fines estadÃ­sticos, administrativos y de recaudaciÃ³n de fondos. B) Los datos personales proporcionados de manera voluntaria por los posibles donantes, son utilizados para darlos de alta en cualquiera de nuestros programas y a partir de ello, comenzar a recibir sus donativos de manera periÃ³dica. C) Los datos personales proporcionados por los donantes, son utilizados para el cobro de los donativos, envÃ­o de comprobantes fiscales, emisiÃ³n de recibos deducibles de impuestos y, en su caso, para el cumplimiento de obligaciones legales. D) Los datos personales de nuestros donantes tambiÃ©n son utilizados para, con su consentimiento, enviarles informaciÃ³n relacionada a la AsociaciÃ³n, la causa, los programas de ayuda, los niÃ±os y niÃ±as y otras formas de apoyar a travÃ©s de correos electrÃ³nicos, correspondencia fÃ­sica, llamadas telefÃ³nicas, entre otros medios de contacto. Aldeas Infantiles SOS MÃ©xico no proporciona informaciÃ³n de sus donantes a ninguna empresa externa para fines mercadotÃ©cnicos, publicitarios o de prospecciÃ³n. Los datos personales no serÃ¡n utilizados para fines mercadotÃ©cnicos, publicitarios o de prospecciÃ³n comercial, salvo para el envÃ­o de la informaciÃ³n relacionada con la AsociaciÃ³n, en tÃ©rminos del inciso D anterior. En caso de que no desee que sus datos personales sean utilizados para las finalidades anteriormente descritas, usted puede negarse desde este momento o, posteriormente, manifestar su negativa mediante el envÃ­o de un correo electrÃ³nico a protecciondedatos@aldeasinfantiles.org.mx.  Datos personales que podrÃ¡n ser recabados y tratados Para los fines antes citados requerimos obtener los siguientes datos personales: A) Nombre completo B) DirecciÃ³n o domicilio C) Fecha de nacimiento D) Sexo E) TelÃ©fono F) Correo electrÃ³nico G) Documento oficial de identificaciÃ³n H) InformaciÃ³n financiera para la realizaciÃ³n de los cargos autorizados (informaciÃ³n contenida en tarjetas de dÃ©bito o crÃ©dito) En tÃ©rminos de lo dispuesto por el Ãºltimo pÃ¡rrafo del artÃ­culo 8 de la Ley Federal de ProtecciÃ³n de Datos Personales en PosesiÃ³n de los Particulares, en los casos en los que se obtenga la informaciÃ³n financiera seÃ±alada en el inciso H anterior, se solicitarÃ¡ el consentimiento expreso del donante para el tratamiento de dicha informaciÃ³n, a travÃ©s del formato o boleta mediante la cual sea recabada. De conformidad con lo anterior, en tÃ©rminos del presente Aviso de Privacidad, no se da tratamiento a datos personales sensibles, cuya utilizaciÃ³n indebida pudiera afectar la esfera mÃ¡s Ã­ntima de su titular o cuya utilizaciÃ³n indebida pueda dar origen a discriminaciÃ³n o conlleve a un riesgo grave para el titular. Los datos personales que se recaban, en tÃ©rminos de lo seÃ±alado anteriormente, no incluyen aspectos que pudieran revelar origen racial o Ã©tnico, estado de salud presente y futuro, informaciÃ³n genÃ©tica, creencias religiosas, filosÃ³ficas y morales, afiliaciÃ³n sindical, opiniones polÃ­ticas o preferencia sexual.  Opciones y medios para limitar el uso o divulgaciÃ³n de los datos En todo momento usted podrÃ¡ limitar el uso o divulgaciÃ³n del tratamiento de sus datos personales, para tal efecto pÃ³ngase en contacto al correo electrÃ³nico, protecciondedatos@aldeasinfantiles.org.mx, es necesario que presente su peticiÃ³n al responsable del manejo de la informaciÃ³n de la OrganizaciÃ³n cuyos datos de contacto vienen a continuaciÃ³n.  Medios para ejercer los derechos ARCO AsÃ­ tambiÃ©n, tiene derecho de acceder a sus datos personales que poseemos y a los detalles del tratamiento de los mismos, rectificar en caso de ser inexactos o incompletos, cancelarlos cuando considere que no se requieren para alguna de las finalidades seÃ±aladas en el aviso de privacidad, asÃ­ como a oponerse al tratamiento de los mismos y/o revocar en los casos que proceda, cuando la ley especÃ­fica lo permita, el consentimiento que para tal fin nos haya otorgado, a travÃ©s de los procedimientos que hemos implementado para tal efecto. Para conocer mÃ¡s detalles sobre el procedimiento respectivo, requisitos y plazos, puede contactar al responsable de manejo de la InformaciÃ³n, Lic. Sair Pinilla al siguiente correo electrÃ³nico, protecciondedatos@aldeasinfantiles.org.mx. Su peticiÃ³n debe de ir acompaÃ±ada de la siguiente informaciÃ³n: Nombre completo de la persona que desea revocar el consentimiento, documento de identidad que acredite la personalidad o documento que acredite la representaciÃ³n legal en su caso. DescripciÃ³n clara y precisa de los datos personales respecto de los que se busca ejercer alguno de los derechos antes mencionados. Domicilio, correo electrÃ³nico u otro medio para comunicarle la respuesta a su solicitud. Cualquier otro documento que facilite la localizaciÃ³n de los datos personales. SÃ³lo en los casos procedentes y en los supuestos en que la ley especÃ­fica lo permita, manifestaciÃ³n expresa de que desea que el tratamiento de todos los datos personales recabados por nosotros sean revocados. Tendremos un plazo de 20 dÃ­as contados a partir desde la fecha en que se recibiÃ³ la solicitud para atender y comunicarle la determinaciÃ³n adoptada, a efecto de que, si resulta procedente, se haga efectiva la misma dentro de los 15 dÃ­as siguientes a la fecha en que se comunica la respuesta. TratÃ¡ndose de solicitudes de acceso de datos personales, procederÃ¡ la entrega previa acreditaciÃ³n de la identidad del solicitante o representante legal segÃºn corresponda. Los plazos antes referidos podrÃ¡n ser ampliados una sola vez por un periodo igual, siempre y cuando asÃ­ lo justifiquen las circunstancias del caso. Le informamos tambiÃ©n que utilizamos tecnologÃ­as de informaciÃ³n para fines estadÃ­sticos, para cualquier duda igualmente contacte a la persona responsable del manejo de la informaciÃ³n antes mencionada.  RevocaciÃ³n del consentimiento Usted tiene derecho a revocar su consentimiento, asÃ­ como oponerse al tratamiento de sus datos personales para las finalidades que no sean indispensables para la relaciÃ³n jurÃ­dica. La revocaciÃ³n de su consentimiento para el tratamiento de sus datos personales, la podrÃ¡ realizar en tÃ©rminos del pÃ¡rrafo anterior.  SubcontrataciÃ³n de servicios Aldeas Infantiles SOS MÃ©xico I.A.P, en algunos casos, recabarÃ¡ los datos requeridos para el cumplimiento de su objeto y para las finalidades que se seÃ±alan en el presente Aviso de Privacidad, a travÃ©s de personal que labore para empresas con las cuales tenga celebrados contratos de prestaciÃ³n de servicios. El objetivo de dichos contratos, en tÃ©rminos generales, es la prestaciÃ³n de servicios orientados a la obtenciÃ³n de nuevos donantes con vocaciÃ³n de permanencia para la aportaciÃ³n de recursos financieros para las actividades que desarrolla la OrganizaciÃ³n. Las empresas con las cuales Aldeas Infantiles SOS MÃ©xico I.A.P., actualmente tiene celebrado contratos de prestaciÃ³n de servicios en los tÃ©rminos seÃ±alados en el pÃ¡rrafo anterior, son: Fundraisers MÃ©xico, S de R.L. de C.V. y Human Kind S.A. de C.V. Al recabar los datos, dichas empresas prestadoras de servicios actÃºan en nombre y representaciÃ³n de Aldeas Infantiles SOS MÃ©xico I.A.P. y se obligan a cumplir con las obligaciones de confidencialidad y de protecciÃ³n de datos personales en los mismos tÃ©rminos que dicha OrganizaciÃ³n, asÃ­ como a resguardar, proteger y velar por la privacidad de los datos que el personal que trabaje en dichas empresas recabe y solamente utilizarlos para dar cumplimiento al objetivo de dichos contratos. Las empresas no podrÃ¡n proporcionar, utilizar, transferir ningÃºn tipo de datos a ningÃºn tercero que no sea Aldeas Infantiles SOS MÃ©xico, I.A.P. quien los utilizarÃ¡ exclusivamente para las finalidades descritas en el presente Aviso de Privacidad. Concretamente, en tÃ©rminos de los contratos de prestaciÃ³n de servicios correspondientes, los prestadores de servicios se comprometen a que no negociaran, explotaran ni utilizaran, en manera alguna, los datos recabados en representaciÃ³n de Aldeas Infantiles S.O.S., de los posibles donantes o donantes adquiridos durante Ia vigencia del contrato o despuÃ©s de su rescisiÃ³n, asÃ­ como que atenderÃ¡ a la normativa mexicana en lo referente a las medidas de seguridad. Aldeas Infantiles SOS MÃ©xico I.A.P. serÃ¡ responsable de vigilar que las empresas que correspondan, den cumplimiento a las disposiciones aplicables en materia de protecciÃ³n de datos personales en posesiÃ³n de los particulares.  Transferencia de datos Para lograr el objeto y fines que persigue Aldeas Infantiles SOS MÃ©xico I.A.P., los datos personales de los donantes podrÃ¡n ser transferidos y tratados dentro y fuera del territorio por el personal de la SecretarÃ­a General de SOS Kinderdorf International (Oficina Internacional de Aldeas Infantiles SOS MÃ©xico), cuya sede se encuentra ubicada en Innsbruck, Austria. Las transferencias internacionales de datos se realizarÃ­an con la finalidad de elaborar anÃ¡lisis estadÃ­sticos y control de transparencia del manejo de la informaciÃ³n y ejecuciÃ³n de operaciones de la organizaciÃ³n en MÃ©xico, ademÃ¡s de garantizar el resguardo de la informaciÃ³n de los donantes y todo lo relacionado a la recaudaciÃ³n de fondos. Las transferencias internacionales de datos no se realizarÃ¡n por fines distintos a los relacionados con la misiÃ³n de la OrganizaciÃ³n, ni tampoco se realizarÃ¡ con la finalidad de proporcionar informaciÃ³n sobre los donantes a ninguna empresa externa. Si usted no manifiesta oposiciÃ³n alguna en el renglÃ³n seÃ±alado a continuaciÃ³n para tal efecto: no consiento que mis datos personales sean transferidos o no lo informa al responsable mediante el procedimiento establecido anteriormente citado, se entenderÃ¡ que ha otorgado su consentimiento para ello. No obstante lo anterior, nos comprometemos a que la informaciÃ³n que se transfiere a terceros y que se encuentran previstas en las excepciones que fija la ley de la materia para tal efecto, sea tratada de forma responsable, confidencial y exclusivamente por aquellas personas que requieren del conocimiento de dichos datos. Asimismo, usted podrÃ¡ manifestar la negativa de que su informaciÃ³n sea transferida, mediante el envÃ­o de un correo electrÃ³nico a: protecciondedatos@aldeasinfantiles.org.mx  Procedimiento y medios por el cual se comunicarÃ¡ a los titulares de cambios al aviso de privacidad. Atendiendo las directrices de la autoridad competente, en su caso, de ser necesario realizaremos cambios o modificaciones al aviso de privacidad, atendiendo tambiÃ©n los fines de la organizaciÃ³n y el interÃ©s superior del niÃ±o. En su caso estas modificaciones estarÃ¡n disponibles en nuestra pÃ¡gina de internet www.aldeasinfantiles.org.mx o se las haremos llegar a la brevedad al Ãºltimo correo electrÃ³nico que nos haya proporcionado.ô€€€ Una vez que se puso a mi disposiciÃ³n el presente aviso de privacidad, autorizo y consiento expresa y/o tÃ¡citamente a Aldeas Infantiles SOS MÃ©xico, el manejo y tratamiento de mis datos personales, por no tener oposiciÃ³n alguna para ello, lo anterior de conformidad con el artÃ­culo 8Â°, pÃ¡rrafo tercero de la Ley Federal de ProtecciÃ³n de Datos Personales en PosesiÃ³n de los Particulares. Para los casos de tratamiento de datos personales que no requieran el consentimiento expreso o tÃ¡cito de los titulares se aplicarÃ¡ lo dispuesto en el artÃ­culo 10 de la Ley de la materia.  Ciudad de MÃ©xico, Distrito Federal, a octubre de 2014. Este documento atiende las disposiciones de la ley aplicable, para casos especÃ­ficos y en atenciÃ³n al objeto social y fines de la OrganizaciÃ³n, se atenderÃ¡ la situaciÃ³n concreta y se le pondrÃ¡ a la vista el aviso de privacidad simplificado cuyo contenido actualiza la informaciÃ³n requerida en las fracciones I y II del artÃ­culo 16 de la ley de la materia y remite al presente aviso de privacidad completo. Cualquier modificaciÃ³n a este aviso de privacidad podrÃ¡ consultarlo en la pÃ¡gina www.aldeasinfantiles.org.mx. Si usted considera que su derecho de protecciÃ³n de datos personales ha sido lesionado por alguna conducta de nuestros empleados o de nuestras actuaciones o respuestas, presume que en el tratamiento de sus datos personales existe alguna violaciÃ³n a las disposiciones previstas en la Ley Federal de ProtecciÃ³n de Datos Personales en PosesiÃ³n de los Particulares, podrÃ¡ interponer la queja o denuncia correspondiente ante el IFAI, para mayor informaciÃ³n visite www.ifai.org.mx.  Consiento que mis datos personales sean tratados para las finalidades </div>'),
(7, 'enviarcorreos', 'se pueden enviar correos ', 'NO'),
(8, 'cadenasas', 'cadena de conexion al contenedor en azure', 'https://demorebelbotstorage.queue.core.windows.net/?sv=2020-02-10&ss=bfqt&srt=sco&sp=rwdlacuptfx&se=2021-07-03T05:03:51Z&st=2021-06-26T21:03:51Z&spr=https,http&sig=gelyqB%2FBuM6m2vI621zyIDRKbq8GCOOSGJwQGLM6FRA%3D'),
(9, 'xxxx', 'xxxxx', 'https://demorebelbotstorage.blob.core.windows.net/?sv=2020-02-10&ss=bfqt&srt=sco&sp=rwdlacuptfx&se=2021-07-03T05:03:51Z&st=2021-06-26T21:03:51Z&spr=https,http&sig=gelyqB%2FBuM6m2vI621zyIDRKbq8GCOOSGJwQGLM6FRA%3D'),
(10, 'xxxx', 'xxxxx', 'https://demorebelbotstorage.blob.core.windows.net/?sv=2020-02-10&ss=bfqt&srt=sco&sp=rwdlacuptfx&se=2021-07-03T05:03:51Z&st=2021-06-26T21:03:51Z&spr=https,http&sig=gelyqB%2FBuM6m2vI621zyIDRKbq8GCOOSGJwQGLM6FRA%3D');

-- --------------------------------------------------------

--
-- Table structure for table `permisosimpresion`
--

CREATE TABLE `permisosimpresion` (
  `id` int(11) NOT NULL,
  `usuarioid` int(11) NOT NULL,
  `incidenteid` int(11) NOT NULL,
  `etapa` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `respuesta` varchar(50) NOT NULL,
  `usuarioidautorizo` int(11) NOT NULL,
  `vigente` varchar(50) NOT NULL,
  `fechapeticion` date NOT NULL,
  `fechaautorizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `programas`
--

CREATE TABLE `programas` (
  `id` int(11) NOT NULL,
  `programa` varchar(50) NOT NULL,
  `abreviatura` varchar(50) NOT NULL,
  `prefijofolio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programas`
--

INSERT INTO `programas` (`id`, `programa`, `abreviatura`, `prefijofolio`) VALUES
(1, 'ACOGIMIENTO FAMILIAR TIJUANA', 'AF-TIJUANA', 'TIJ'),
(2, 'ACOGIMIENTO FAMILIAR MORELIA', 'AF-MORELIA', 'MO'),
(3, 'ACOGIMIENTO FAMILIAR CDMNX', 'AD-CDMX', 'MX'),
(7, 'ACOGIMIENTO FAMILIAR TUXTLA', 'AF TUXTLA', 'TX'),
(8, 'ACOGIMIENTO FAMILIAR COMITAN', 'AF COMITAN', 'CO'),
(9, 'FORTALECIMIENTO FAMILIAR HUEHUETOCA', 'FF HUEHUETOCA', 'HU'),
(10, 'FORTALECIMIENTO FAMILIAR TEHUACAN', 'FF TEHUACAN', 'TH'),
(11, 'FORTALECIMIENTO FAMILIAR COMITAN', 'FF COMITAN', 'COMITAN');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `NOMBREDELROL` varchar(50) NOT NULL,
  `ALTADECATALOGOS` varchar(50) NOT NULL,
  `BAJADECATALOGOS` varchar(50) NOT NULL,
  `MODIFICACIOnDECATALOGOS` varchar(50) NOT NULL,
  `ALTADEUSUARIOS` varchar(50) NOT NULL,
  `BAJADEUSUARIOS` varchar(50) NOT NULL,
  `MODIFICACIONDEUSUARIOS` varchar(50) NOT NULL,
  `ALTADEROL` varchar(50) NOT NULL,
  `BAJADEROL` varchar(50) NOT NULL,
  `MODIFICACIONDEROL` varchar(50) NOT NULL,
  `ALTADEVALORACIONINICIAL` varchar(50) NOT NULL,
  `MODIFICACIONREAPERTURAVALORACIONINICIAL` varchar(50) NOT NULL,
  `EDITARANTESDECIERREDELAVALORACIONINICIAL` varchar(50) NOT NULL,
  `BAJAVALORACIONINICIAL` varchar(50) NOT NULL,
  `IMPRESIONVALORACIONINICIAL` varchar(50) NOT NULL,
  `VISUALIZACIONVALORACIONINICIAL` varchar(50) NOT NULL,
  `ALTADEVALORACIONINTEGRAL` varchar(50) NOT NULL,
  `MODIFICACIONREAPERTURAVALORACIONINTEGRAL` varchar(50) NOT NULL,
  `EDITARANTESDECIERREDELAVALORACIONINTEGRAL` varchar(50) NOT NULL,
  `BAJAVALORACIONINTEGRAL` varchar(50) NOT NULL,
  `IMPRESIONVALORACIONINTEGRAL` varchar(50) NOT NULL,
  `VISUALIZACIONVALORACIONINTEGRAL` varchar(50) NOT NULL,
  `ALTADESEGUIMIENTO` varchar(50) NOT NULL,
  `MODIFICACIONDESEGUIMIENTO` varchar(50) NOT NULL,
  `EDITARDESEGUIMIENTO` varchar(50) NOT NULL,
  `BAJADESEGUIMIENTO` varchar(50) NOT NULL,
  `IMPRESIONDESEGUIMIENTO` varchar(50) NOT NULL,
  `VISUALIZACIONDESEGUIMIENTO` varchar(50) NOT NULL,
  `ALTADECIERRE` varchar(50) NOT NULL,
  `MODIFICACIONDECIERRE` varchar(50) NOT NULL,
  `EDICIONDECIERRE` varchar(50) NOT NULL,
  `BAJADECIERRE` varchar(50) NOT NULL,
  `IMPRESIONDECIERRE` varchar(50) NOT NULL,
  `VISUALIZACIONDECIERRE` varchar(50) NOT NULL,
  `ALTADENUNCIA` varchar(50) NOT NULL,
  `MODIFCACIONDENUNCIA` varchar(50) NOT NULL,
  `EDICIONDENUNCIA` varchar(50) NOT NULL,
  `BAJADENUNCIA` varchar(50) NOT NULL,
  `IMPRESIONDENUNCIA` varchar(50) NOT NULL,
  `VISUALIZACIONDENUNCIA` varchar(50) NOT NULL,
  `ALTAINVESTIGACION` varchar(50) NOT NULL,
  `MODIFICACIONINVESTIGACION` varchar(50) NOT NULL,
  `EDICIONINVESTIGACION` varchar(50) NOT NULL,
  `BAJAINVESTIGACION` varchar(50) NOT NULL,
  `IMPRESIONINVESTIGACION` varchar(50) NOT NULL,
  `VISUALIZACIONINVESTIGACION` varchar(50) NOT NULL,
  `ALTAEVIDENCIA` varchar(50) NOT NULL,
  `MODIFCACIONEVIDENCIA` varchar(50) NOT NULL,
  `EDICIONEVIDENCIA` varchar(50) NOT NULL,
  `BAJAEVIDENCIA` varchar(50) NOT NULL,
  `IMPRESIONEVIDENCIA` varchar(50) NOT NULL,
  `VISUALIZACIONEVIDENCIA` varchar(50) NOT NULL,
  `ALTADEARCHIVOS` varchar(50) NOT NULL,
  `MODIFICACIONARCHIVOS` varchar(50) NOT NULL,
  `IMPRESIONARCHIVOS` varchar(50) NOT NULL,
  `VISUALIZACIONARCHIVOS` varchar(50) NOT NULL,
  `ACTIVO` varchar(50) DEFAULT NULL,
  `RECIBECORREOS` varchar(50) DEFAULT NULL,
  `AUTORIZAIMPRESION` varchar(50) DEFAULT NULL,
  `VISIBILIDADDEINCIDENTES` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `NOMBREDELROL`, `ALTADECATALOGOS`, `BAJADECATALOGOS`, `MODIFICACIOnDECATALOGOS`, `ALTADEUSUARIOS`, `BAJADEUSUARIOS`, `MODIFICACIONDEUSUARIOS`, `ALTADEROL`, `BAJADEROL`, `MODIFICACIONDEROL`, `ALTADEVALORACIONINICIAL`, `MODIFICACIONREAPERTURAVALORACIONINICIAL`, `EDITARANTESDECIERREDELAVALORACIONINICIAL`, `BAJAVALORACIONINICIAL`, `IMPRESIONVALORACIONINICIAL`, `VISUALIZACIONVALORACIONINICIAL`, `ALTADEVALORACIONINTEGRAL`, `MODIFICACIONREAPERTURAVALORACIONINTEGRAL`, `EDITARANTESDECIERREDELAVALORACIONINTEGRAL`, `BAJAVALORACIONINTEGRAL`, `IMPRESIONVALORACIONINTEGRAL`, `VISUALIZACIONVALORACIONINTEGRAL`, `ALTADESEGUIMIENTO`, `MODIFICACIONDESEGUIMIENTO`, `EDITARDESEGUIMIENTO`, `BAJADESEGUIMIENTO`, `IMPRESIONDESEGUIMIENTO`, `VISUALIZACIONDESEGUIMIENTO`, `ALTADECIERRE`, `MODIFICACIONDECIERRE`, `EDICIONDECIERRE`, `BAJADECIERRE`, `IMPRESIONDECIERRE`, `VISUALIZACIONDECIERRE`, `ALTADENUNCIA`, `MODIFCACIONDENUNCIA`, `EDICIONDENUNCIA`, `BAJADENUNCIA`, `IMPRESIONDENUNCIA`, `VISUALIZACIONDENUNCIA`, `ALTAINVESTIGACION`, `MODIFICACIONINVESTIGACION`, `EDICIONINVESTIGACION`, `BAJAINVESTIGACION`, `IMPRESIONINVESTIGACION`, `VISUALIZACIONINVESTIGACION`, `ALTAEVIDENCIA`, `MODIFCACIONEVIDENCIA`, `EDICIONEVIDENCIA`, `BAJAEVIDENCIA`, `IMPRESIONEVIDENCIA`, `VISUALIZACIONEVIDENCIA`, `ALTADEARCHIVOS`, `MODIFICACIONARCHIVOS`, `IMPRESIONARCHIVOS`, `VISUALIZACIONARCHIVOS`, `ACTIVO`, `RECIBECORREOS`, `AUTORIZAIMPRESION`, `VISIBILIDADDEINCIDENTES`) VALUES
(14, 'ROL SIN ENVIO DE CORREOS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', '1', 'NO', 'NO', 'PROPIOS'),
(15, 'ROL SIN ENVIO DE CORREOS', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', '1', 'NO', 'NO', 'PROPIOS'),
(16, 'ROL PRIORITARIO UNO', 'SI', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'SI', 'SI', 'SI', 'SI', 'NO', 'SI', 'SI', 'SI', 'SI', 'SI', 'NO', 'SI', 'SI', 'SI', 'SI', 'SI', 'NO', 'SI', 'SI', 'SI', 'SI', 'SI', 'NO', 'SI', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', 'NO', '1', 'SI', 'SI', 'PROGRAMA'),
(17, 'SUPERADMIN', 'SI', 'SI', 'SI', 'SI', 'NO', 'NO', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', 'SI', '1', 'SI', 'SI', 'TODOS');

-- --------------------------------------------------------

--
-- Table structure for table `seguimiento`
--

CREATE TABLE `seguimiento` (
  `id` int(11) NOT NULL COMMENT 'Identificador unico del registro y llave primaria',
  `incidenteid` int(11) DEFAULT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
  `status` text COMMENT 'Texto para inidicar el Estatus de esta parte del proceso',
  `plan` varchar(50) DEFAULT NULL COMMENT 'Estatus del Plan : Si,NO,POR CONFIRMAR',
  `documentos` varchar(50) NOT NULL,
  `notificaciondif` text NOT NULL COMMENT 'Estatus de la notificacion al DIF si es que aplica : Si,NO,POR CONFIRMAR',
  `notificacionautoridad` text NOT NULL COMMENT 'Estatus de la notificacion al Autoridad si es que aplica : Si,NO,POR CONFIRMAR',
  `notificacionpfn` text NOT NULL COMMENT 'Estatus de la Notificaion al PFN : Si,NO,POR CONFIRMAR',
  `notificaciodenunciante` text NOT NULL COMMENT 'Estatus de la notificaion  a la persona que hizo la denuncia : Si,NO,POR CONFIRMAR',
  `actavaloracion` text NOT NULL COMMENT 'Estatus del Acta de Valoracion: Si,NO,POR CONFIRMAR',
  `planrecuperacion` text NOT NULL COMMENT 'Estatus del Plan de recuperacion : Si,NO,POR CONFIRMAR',
  `actavaloracion_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de acta de valoracion',
  `documentos_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de los documentos oficiales ',
  `notificaciondenunciante_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de la notificacion al denunciante',
  `notificacionautoridad_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de la notificacion a la autoridad',
  `notificaciondif_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de la notificacion al DIF',
  `notificacionpfn_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos de la notificacion al PFN',
  `plan_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos del Plan y cronograma',
  `planrecuperacion_docto` varchar(50) NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos del Plan de recuperacion',
  `protocolosos` varchar(50) DEFAULT NULL COMMENT 'Estatus de la respuesta (Denuncia o investigacion) SI, NO, PENDIENTE',
  `estado` varchar(50) DEFAULT NULL COMMENT 'En este camo se almacen el estado del seguimiento, si ya todos las condiciones se cumplen para cerrar el seguimiento  valores: abierto y/o cierre'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seguimiento`
--

INSERT INTO `seguimiento` (`id`, `incidenteid`, `status`, `plan`, `documentos`, `notificaciondif`, `notificacionautoridad`, `notificacionpfn`, `notificaciodenunciante`, `actavaloracion`, `planrecuperacion`, `actavaloracion_docto`, `documentos_docto`, `notificaciondenunciante_docto`, `notificacionautoridad_docto`, `notificaciondif_docto`, `notificacionpfn_docto`, `plan_docto`, `planrecuperacion_docto`, `protocolosos`, `estado`) VALUES
(1, 4, '', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', '0', '0', '0', '0', '0', '0', '0', '0', 'PENDIENTE', 'abierto'),
(2, 5, '', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', 'POR CONFIRMAR', '0', '0', '0', '0', '0', '0', '0', '0', 'PENDIENTE', 'abierto');

-- --------------------------------------------------------

--
-- Table structure for table `testigoscierre`
--

CREATE TABLE `testigoscierre` (
  `id` int(11) NOT NULL COMMENT 'Identificador unico del registro y llave primaria',
  `incidenteid` int(11) DEFAULT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
  `nombre` text COMMENT 'Nombre del testigo que participa en el cierre del incidente',
  `cargo` varchar(50) DEFAULT NULL COMMENT 'Cargo  que ostenta el testigo '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testigoscierre`
--

INSERT INTO `testigoscierre` (`id`, `incidenteid`, `nombre`, `cargo`) VALUES
(1, 23, 'sdafsdaf asdf sdaf ', 'COLABORADOR SOS'),
(2, 23, 'asdfasdf sdaf sdaf sadf sda', 'CUIDADORA DE ATENCION DIRECTA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `level_access` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genero` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fechanacimiento` datetime DEFAULT NULL,
  `edad` decimal(10,0) DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `sucursalfavorita` int(11) DEFAULT NULL,
  `stripeid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebookid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `level_access`, `genero`, `celular`, `fechanacimiento`, `edad`, `foto`, `sucursalfavorita`, `stripeid`, `facebookid`) VALUES
(832, 'marcos cabrera', 'dev@gmail.com', NULL, '12345', NULL, NULL, NULL, 'root', 'masculino', '9213082997', '2020-10-24 00:00:00', '42', 'sin foto', 1, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `programa` int(11) NOT NULL,
  `fechaCreacion` date NOT NULL,
  `activo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`, `programa`, `fechaCreacion`, `activo`) VALUES
(19, 'JORGE VELAZQUEZ', 'd@g.com', '1234', '16', 1, '2021-01-08', '0'),
(20, 'Marcos Alberto cabrera abarca', 'dev.marcoscabrera@yahoo.com', '12345', '17', 8, '2021-02-09', '1'),
(21, 'Luis Morales Taylor', 'lmorales@rebelbot.mx', '12345', '17', 8, '2021-02-09', '1'),
(22, 'administrado del sistema', 'administrador@sos.com', '12345', '16', 0, '2021-02-12', '1'),
(23, 'dr strange', 'mymundokidscoatza@gmail.com', '12345', '16', 0, '2021-03-03', '1'),
(24, 'noobmaster69@gmail.com', 'nm@master.com', '12345', '14', 3, '2021-03-23', '1'),
(25, 'maca cabrera abarca', 'mcabrera@rebelbot.mx', '12345', '17', 11, '2021-04-19', '1'),
(26, 'soldado raso ,sin tantos privilefios', 'sr@sr.com', '12345', '17', 3, '2021-04-19', '1');

-- --------------------------------------------------------

--
-- Table structure for table `valoracionintegral`
--

CREATE TABLE `valoracionintegral` (
  `id` int(11) NOT NULL COMMENT 'Identificadro unico del registro',
  `incidenteid` int(11) NOT NULL COMMENT 'Llave secundaria, es el identificador del incidente',
  `fechacreacion` date NOT NULL COMMENT 'fecha en la que se creo el registro',
  `fechaupdate` date NOT NULL COMMENT 'fecha en la que se actualizo el registro',
  `textovi` text NOT NULL COMMENT 'Testo en donde se describe la valoracion acerca de este incidente',
  `tipologiadelincidente` varchar(50) NOT NULL COMMENT 'si es de caracter interno o externo',
  `niveldelincidente` varchar(50) NOT NULL COMMENT 'Bajo nivel , Alto Nivel o Critico',
  `tipodecaso` varchar(50) NOT NULL COMMENT 'Seleccion entre Abusos ,Negligencia o Violaacion',
  `confirmaincidente` varchar(50) NOT NULL COMMENT 'Se confirma a traves de la valoracion si es un incidente o no.',
  `confirmaincidentenumerico` decimal(10,0) DEFAULT NULL COMMENT 'Uso Grafico, determina un comportamiento en la pantalla. su valor es 1 y 2',
  `tipoderespuesta` varchar(50) NOT NULL COMMENT 'Denuncia Penal, Investigacion Interna, Abordaje interno y cuando el regstro se crea por primera vez tiene su valor es "En proceso de Valoracion"',
  `estadorespuesta` varchar(50) DEFAULT NULL,
  `colorestadorespuesta` varchar(50) DEFAULT NULL,
  `medidasintegrales` text NOT NULL COMMENT 'Identificador del documento , es el id del registro en la tabla doctos',
  `activo` bit(1) NOT NULL COMMENT 'Estado del registro',
  `estado` varchar(50) DEFAULT NULL COMMENT 'Si el todo el registro ha sido completado el valor cambiar cerrado.'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `valoracionintegral`
--

INSERT INTO `valoracionintegral` (`id`, `incidenteid`, `fechacreacion`, `fechaupdate`, `textovi`, `tipologiadelincidente`, `niveldelincidente`, `tipodecaso`, `confirmaincidente`, `confirmaincidentenumerico`, `tipoderespuesta`, `estadorespuesta`, `colorestadorespuesta`, `medidasintegrales`, `activo`, `estado`) VALUES
(1, 1, '2021-08-09', '2021-08-09', '.', '.', '.', '.', 'En Proceso de Valoracion', '0', 'En Proceso de Valoracion', 'abierto', 'yellow', '0', b'1', 'abierto'),
(2, 2, '2021-08-09', '2021-08-09', '.', '.', '.', '.', 'En Proceso de Valoracion', '0', 'En Proceso de Valoracion', 'abierto', 'yellow', '0', b'1', 'abierto'),
(3, 3, '2021-08-09', '2021-08-09', '.', '.', '.', '.', 'En Proceso de Valoracion', '0', 'En Proceso de Valoracion', 'abierto', 'yellow', '0', b'1', 'abierto'),
(4, 4, '2021-08-09', '2021-08-09', 'esta es una valoracion integral esta es una valoracion integral esta es una valoracion integral ', 'INTERNO', 'Comportamiento ProblemÃ¡tico A-N (Adulto-NiÃ±o)', ' ABUSO FISICO', 'SI ES UN INCIDENTE', '2', 'INVESTIGACION INTERNA', 'abierto', 'yellow', '0', b'1', 'abierto'),
(5, 5, '2021-08-09', '2021-08-09', 'marcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabreramarcso cabrera', 'INTERNO', 'Comportamiento Inapropiado', ' ABUSO FISICO', 'SI ES UN INCIDENTE', '2', 'DENUNCIA LEGAL', 'cerrado', 'green', '8', b'1', 'cerrado');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abordajinterno`
--
ALTER TABLE `abordajinterno`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conciencia`
--
ALTER TABLE `conciencia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `denuncialegal`
--
ALTER TABLE `denuncialegal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctos`
--
ALTER TABLE `doctos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctosapoyo`
--
ALTER TABLE `doctosapoyo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evidencias`
--
ALTER TABLE `evidencias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidente`
--
ALTER TABLE `incidente`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investigacion`
--
ALTER TABLE `investigacion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permisosimpresion`
--
ALTER TABLE `permisosimpresion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programas`
--
ALTER TABLE `programas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testigoscierre`
--
ALTER TABLE `testigoscierre`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `valoracionintegral`
--
ALTER TABLE `valoracionintegral`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abordajinterno`
--
ALTER TABLE `abordajinterno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `conciencia`
--
ALTER TABLE `conciencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `denuncialegal`
--
ALTER TABLE `denuncialegal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `doctos`
--
ALTER TABLE `doctos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro y llave primaria', AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `doctosapoyo`
--
ALTER TABLE `doctosapoyo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la tabla', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `evidencias`
--
ALTER TABLE `evidencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incidente`
--
ALTER TABLE `incidente`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro y llave primaria', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `investigacion`
--
ALTER TABLE `investigacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' 	Identificador unico del registro y llave primaria', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parametros`
--
ALTER TABLE `parametros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `permisosimpresion`
--
ALTER TABLE `permisosimpresion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programas`
--
ALTER TABLE `programas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro y llave primaria', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `testigoscierre`
--
ALTER TABLE `testigoscierre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador unico del registro y llave primaria', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=833;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `valoracionintegral`
--
ALTER TABLE `valoracionintegral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificadro unico del registro', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
