-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 05:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vinoteca`
--

-- --------------------------------------------------------

--
-- Table structure for table `bodegas`
--

CREATE TABLE `bodegas` (
  `id_bodega` int(11) NOT NULL,
  `bodega` varchar(45) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bodegas`
--

INSERT INTO `bodegas` (`id_bodega`, `bodega`, `pais`, `provincia`, `descripcion`) VALUES
(5, 'Catena Zapata', 'Argentina', 'Mendoza', 'Nuestra visión consiste en elaborar vinos intensos e inolvidables, verdaderamente expresivos del terroir. La historia de Catena es la historia del vino argentino.'),
(6, 'Cordon blanco', 'Argentina', 'Buenos Aires', ' Radicada en Tandil'),
(7, 'Saletein', 'Argentina', 'Mendoza', 'El objetivo de Bodegas Salentein es claro: elaborar vinos de la más alta calidad, comprometidos con la tierra en la que nacen. Durante su elaboración, Salentein respeta la naturaleza y, al mismo tiempo, se involucra con la comunidad de la zona; porque la gente se convierte en un componente esencial que se refleja en la expresión de los vinos.'),
(8, 'Rutini', 'Argentina', 'Mendoza', 'Rutini Wines se convierte en 1925 en la primera bodega en plantar viñedos en el Valle de Uco, reconocido hoy en el mundo como una de las principales regiones vitivinícolas de Mendoza y de toda Argentina'),
(9, 'Trapiche', 'Argentina', 'Mendoza', 'Exploramos la tierra combinando tradición y tecnología para que descubras nuevas sensaciones en cada uno de nuestros vinos.'),
(10, 'Luigi Bosca', 'Argentina', 'Mendoza', 'Nuestros viñedos han ido creciendo, respetando el equilibrio y la armonía de la naturaleza. Elaboramos grandes vinos apoyados en una visión de largo plazo y de consistencia a través del tiempo.'),
(11, 'Casas del bosque', 'Chile', 'Valle de Casablanca', 'Nuestros vinos están elaborados con amor y con orgullo, vinos con carácter y tipicidad única provenientes de nuestros propios viñedos certificados sustentabables con el compromiso y respeto de nuestro entorno, la biodiversidad y todos actores que habitan en ella, reduciendo nuestro impacto al medioambiente.'),
(12, 'El esteco', 'Argentina', 'Salta', 'Sus viñedos son trabajados día a día creando historias que se ven reflejadas en las cosechas, marcas que influyen en la cualidad de sus uvas y de las que nacen vinos cuidados y perfectos.'),
(13, 'Finca Quara', 'Argentina', 'Salta', 'Nuestras uvas finas de calidad superior están destinadas a la elaboración de vinos de alta gama.');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `password`) VALUES
(1, 'webadmin@gmail.com', '$2y$10$qQxQ.6y7vUBfx8.5xn5QTekbO8HVMsDBxx4i6PWUkQ704G5hh53zy');

-- --------------------------------------------------------

--
-- Table structure for table `vinos`
--

CREATE TABLE `vinos` (
  `id` int(11) NOT NULL,
  `vino` varchar(45) NOT NULL,
  `bodega` int(11) NOT NULL,
  `anio` int(11) NOT NULL,
  `maridaje` varchar(45) NOT NULL,
  `cepa` varchar(45) NOT NULL,
  `stock` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `caracteristica` text NOT NULL,
  `recomendado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vinos`
--

INSERT INTO `vinos` (`id`, `vino`, `bodega`, `anio`, `maridaje`, `cepa`, `stock`, `precio`, `caracteristica`, `recomendado`) VALUES
(1, 'Cordon Blanco', 6, 2021, 'Carne', 'Syrah', 12, 2500, 'Este vino presenta características muy diferenciables que, sobre ciertos umbrales, recuerdan al lugar de origen: vinos más delicados en color, aromas exóticos y sabores con taninos suaves de su breve crianza en roble.', 0),
(2, 'Angelica Zapata', 5, 2022, 'Pescado', 'Merlot', 9, 4000, 'Es un vino elegante y complejo de color rojo violáceo con destellos rubíes, de nariz delicada, donde sobresalen aromas que recuerdan a de frutos rojos del bosque y notas suaves de especias como pimienta negra y clavo de olor, aportados por las uvas del viñedo La Pirámide, y aromas a frutos rojos y negros maduros como cassis y grosellas aportados por las uvas de Adrianna.', 1),
(3, 'Cordon Blanco', 6, 2021, 'Pastas', 'Sauvignon Blanc', 4, 6500, 'Es un delicado vino joven de baja graduación alcohólica. De uvas cosechadas temprano para conservar su acidez y sabor a fruta fresca, es ideal para acompañar platos suaves en donde destacamos el equilibrio.', 1),
(4, 'Salentein Numina', 7, 2020, 'Pescado', 'Petit Verdot', 8, 3500, 'De un color rojo violáceo intenso, presenta notas mentoladas y especiadas como el regaliz y el laurel combinadas con notas de frutos negros como arándanos y cassis dando como resultado un vino expresivo y de gran complejidad.En boca es intenso, presenta taninos firmes y jugosos, que le confieren un final fresco y prolongado.', 0),
(5, 'Trumpeter', 8, 2021, 'Carne', 'Malbec', 6, 2000, 'De un impactante color violeta. Nariz frutal destacando ciruelas, cerezas y notas florales que nos recuerdan a las violetas. Posee gran cuerpo y su vivaz estructura acentúa sus taninos intensos que se vuelven aterciopelados en el retrogusto.', 1),
(6, 'Angelica Zapata', 5, 2021, 'Vegetales', 'Cabernet Franc', 7, 4500, 'Presenta un color rojo rubí con suaves tonalidades violáceas. Posee aroma intenso y concentrado con notas de cassis, grosellas maduras, y toques de vainilla y especias dulces como pimienta negra y clavo de olor. De impacto dulce y excelente estructura en boca, muestra frutos rojos maduros con marcados dejos a eucalipto y pimienta negra.', 1),
(7, 'Mariano Di Paola', 8, 2020, 'Carne roja', 'Merlot-Malbec', 2, 6500, 'De color muy intenso con matices violáceos. En la nariz aparecen notas frutales con toques de especias y una leve sensación floral. En boca es un vino de gran concentración y persistencia, muy especiado y frutal, con taninos muy firmes, pero a su vez muy suaves.', 1),
(8, 'Antología XXXVIII', 8, 2023, 'Pastas', 'Malbec', 20, 2500, 'Rojo muy intenso, con matiz azulado. Regala una nariz con acentos florales de violeta, combinados con otros –frutales- de cereza y guinda. También, surgen notas de menta y especias. En boca, se aprecia la jugosidad de la uva Malbec (mayoritaria en el corte), así como también la riqueza de sus aromas. Redondo, de gran longitud, destaca su persistente y sedoso final.', 1),
(9, 'Fond de Cave Gran Reserva', 9, 2021, 'Carne negra', 'Cabernet sauvignon', 5, 5500, 'De color rojo granate con destellos oscuros, sus primeros aromas recuerdan a frutas negras maduras, sintiéndose luego el pimiento verde, que aporta frescura con un sutil carácter herbáceo. En boca presenta sabor a almendras tostadas y frutas acarameladas que acompañan una envolvente armonía entre acidez y tenacidad. En el paladar queda el recuerdo de su paso sedoso.', 0),
(10, 'Salentein Primus', 7, 2020, 'Carne blanca', 'Chardonnay', 15, 3500, 'Presenta un color amarillo dorado con reflejos verdosos, brillante. En nariz es intenso, dulce, aromas a frutas que se combinan con notas florales. Su paso por roble francés le otorga complejidad. En boca es amplio, untuoso y de gran concentración. Posee marcada acidez natural y un prolongado y elegante final.', 1),
(11, 'Iscay', 9, 2020, 'Carne Rojas', 'Pinot Noir', 2, 7500, 'De color rojo profundo con aromas aciruelados en nariz, este vino entrega notas florales y un toque de pimienta blanca. En boca es fresco, con taninos dulces que hacen de este blend un ejemplar elegante.', 0),
(12, 'Manos', 9, 2020, 'Carne Rojas', 'Malbec', 2, 7500, 'Color rojo rubí profundo con intensos aromas de frutos rojos de ciruela, guinda y regaliz. Boca exquisita, de gran dulzura, con reminiscencias de higos y cassis. Un final complejo largo y persistente, característico de los grandes vinos.', 0),
(13, 'La linda', 10, 2021, 'Carne blancas', 'Pinot Noir', 23, 5440, 'De aromas intensos a flores blancas y frutas tropicales. Su paladar es expresivo y perfumado, de paso fluido y refrescante. Es un vino con gracia, vibrante y directo, con tipicidad varietal inconfundible y final cítrico persistente y agradable.', 1),
(14, 'Luigi Bosca', 10, 2021, 'Carne blancas', 'Rosé', 23, 5440, 'Sus aromas son vibrantes, con notas de frutas rojas, membrillo, miel y flores blancas. En boca es vivaz y refrescante, de paladar franco y tenso. Es un rosado voluptuoso, con agarre y un carácter expresivo y bien sutil. De buen cuerpo, final persistente y delicado.', 1),
(15, 'Botanic Series', 11, 2020, 'Carne blancas', 'Riesling', 2, 7500, 'Color pajizo pálido, en la nariz es ligeramente floral, con notas de membrillo y duraznos. Fresco y profundo en boca, de acidez equilibrada, y de final largo y mineral. El vino se puede disfrutar ahora e, incluso, beber en los próximos diez años.', 1),
(16, 'Casas del Bosque Reserva', 11, 2020, 'Carne Rojas', 'Carmenere', 2, 7500, 'Buen color, púrpura intenso con reflejos violeta. El vino se nota vivo y vibrante, con notas a tabaco y especias. En nariz el típico pimentón verde de la cepa se funde bien con las especias de la barrica. En boca hay un equilibrio y una coherencia con los aroma de la nariz. La sensación en el paladar es de un vino voluptuoso, maduro y con taninos suaves.', 0),
(17, 'Don David', 12, 2020, 'Carne Rojas', 'Tannat', 2, 7500, 'Violáceos, vivaz. Profundo con grandes tonalidades negras. El tipo de lágrima formada en la copa denota una muy buena estructura y concentración.Elevada intensidad aromática. Encontramos notas especiadas, clavo de olor, chocolate blanco y vainilla.Taninos representativos del varietal, con gran estructura. Percepción de especies y roble. Largo final y elegante bouquet.', 1),
(18, 'Old Vines', 12, 2020, 'Carne Rojas', 'Malbec', 2, 7500, 'Joven. Posee un tono violáceo y muy buena intensidad. Lágrimas que tiñen la copa.Frutado. Conserva un delicado aroma a hierbas frescas, frutos rojos y ciruelas. Intenso y con gran entrada de boca. Fresco y con taninos de centro de boca.', 0),
(19, 'Quara de Altura', 13, 2020, 'Pastas', 'Torrontes', 2, 3500, ' De color amarillo pálido con tonalidades verdosas brillantes, nuestro TORRONTÉS DE ALTURA una nariz expresiva, con notas de frutos tropicales y final floral.', 0),
(20, 'Quara', 13, 2020, 'Carnes negras', 'Merlot', 2, 2500, 'Se trata de un vino joven y fresco. Para su elaboración se riega lo mínimo e indispensable las plantas, para que la uva quede más concentrada y sabrosa. El resultado es un vino con carácter, ideal para cualquier momento.', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bodegas`
--
ALTER TABLE `bodegas`
  ADD PRIMARY KEY (`id_bodega`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `vinos`
--
ALTER TABLE `vinos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bodega` (`bodega`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bodegas`
--
ALTER TABLE `bodegas`
  MODIFY `id_bodega` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vinos`
--
ALTER TABLE `vinos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vinos`
--
ALTER TABLE `vinos`
  ADD CONSTRAINT `vinos_ibfk_1` FOREIGN KEY (`bodega`) REFERENCES `bodegas` (`id_bodega`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
