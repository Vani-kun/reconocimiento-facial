CREATE TABLE `aulas` (
  `numero` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `caras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descriptor` text NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `horarios` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

CREATE TABLE `horario` (
  `id` int(11) NOT NULL,
  `asignatura` text NOT NULL,
  `seccion` varchar(10) NOT NULL,
  `profesor` text NOT NULL,
  `entrada` time NOT NULL,
  `salida` time NOT NULL,
  `aula` int(11) NOT NULL,
  `dia` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


CREATE TABLE `horas` (
  `id` int(11) NOT NULL,
  `entrada` time NOT NULL,
  `salida` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `materias` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `secciones` (
  `numero` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `entrada` time NOT NULL,
  `salida` time NOT NULL,
  `fecha` date NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `secciones` (`numero`) VALUES
('A'),
('B'),
('C'),
('D');


ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `caras`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `horario`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `horas`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `materias`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `caras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;


ALTER TABLE `horario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;


ALTER TABLE `horas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;


ALTER TABLE `materias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;


