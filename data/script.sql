
CREATE DATABASE IF NOT EXISTS reforesta;
USE reforesta;

-- Tabla plantaciones
CREATE TABLE plantaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    ubicacion VARCHAR(100) NOT NULL,    
    fecha VARCHAR(10) NOT NULL,         
    participantes INT NOT NULL       
);

-- Tabla arboles
CREATE TABLE arboles (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    especie VARCHAR(100) NOT NULL,      
    cantidad INT NOT NULL,              
    plantacion_id INT NOT NULL,         
    CONSTRAINT fk_plantacion
        FOREIGN KEY (plantacion_id)
        REFERENCES plantaciones(id)
        ON DELETE CASCADE               
);

-- Tabla limpiezas
CREATE TABLE limpiezas (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    ubicacion VARCHAR(100) NOT NULL,    
    fecha VARCHAR(10) NOT NULL,         
    cantidadRecogida_Kg INT NOT NULL,   
    participantes INT NOT NULL,         
    descripcion TEXT
    );

-- Tabla actividades
CREATE TABLE actividades (
    id INT AUTO_INCREMENT PRIMARY KEY,  
    titulo VARCHAR(255) NOT NULL,       
    fecha VARCHAR(10) NOT NULL,         
    ubicacion VARCHAR(100) NOT NULL,    
    duracion INT NOT NULL,              
    descripcion TEXT,                   
    publico VARCHAR(50) DEFAULT 'General'
    );

INSERT INTO plantaciones (id, ubicacion, fecha, participantes) VALUES
(1, 'Etxarri', '10-10-2021', 50),
(2, 'Uharte', '04-11-2022', 25),
(3, 'Cirauki', '21-02-2023', 34),
(4, 'Monreal', '19-10-2023', 50),
(5, 'Sarriguren', '02-12-2023', 50),
(6, 'Mañeru', '11-02-2024', 66),
(7, 'Mañeru', '16-11-2024', 50),
(8, 'Zizur', '05-12-2024', 60);

INSERT INTO arboles (especie, cantidad, plantacion_id) VALUES
('Olmo', 300, 1),
('Olmo', 70, 2),
('Fresno', 150, 3),
('Olmo', 100, 4),
('Fresno', 100, 4),
('Abedul', 300, 5),
('Olmo', 200, 6),
('Haya', 100, 6),
('Olmo', 300, 7);

INSERT INTO limpiezas (id, ubicacion, fecha, cantidadRecogida_Kg, participantes, descripcion) VALUES
(1, 'Iruña', '10-10-2021', 100, 50, 'Cauce del rio Arga'),
(2, 'Mendebaldea', '04-11-2022', 80, 25, 'Zonas verdes'),
(3, 'Iruña', '21-02-2023', 110, 34, 'Cauce del rio Elortz'),
(4, 'Monreal', '19-10-2023', 140, 50, 'Monte Higa de monreal'),
(5, 'Sarriguren', '02-12-2023', 97, 50, 'Monte Malkaitz y Tangorri'),
(6, 'Mañeru', '11-02-2024', 150, 26, 'Meandro de Ribalta'),
(7, 'Iruña', '16-11-2024', 200, 44, 'Cauce del rio Sadar');

INSERT INTO actividades (id, titulo, fecha, ubicacion, duracion, descripcion, publico) VALUES
(1, 'Paseo para conocer las plantas de Pamplona', '17-06-2022', 'Uharte', 50, 'Proyecto mapeo del Ailanto', 'General'),
(2, 'El problema del Ailanto', '11-04-2023', 'Lizarra', 50, 'Proyecto Mapeo del Ailanto', 'Adulto'),
(3, 'Paseo para conoceer las plantas de Pamplona', '07-05-2023', 'Iruña', 50, 'Museo de educacion ambiental', 'General'),
(4, 'Charla divulgativa', '07-05-2023', 'Mañeru', 50, 'Dia del arbol', 'General'),
(5, 'Taller sensibilación', '18-08-2023', 'Mendebaldea', 50, 'Campamentos infantiles', 'Infantil'),
(6, 'El problema del Ailanto', '16-02-2024', 'Iruña', 50, 'Mapeo del Ailanto', 'General'),
(7, 'Paseo para conocer las plantas de Pamplona', '04-05-2024', 'Iruña', 50, 'Proyecto Conciencia Ecológica', 'General');
