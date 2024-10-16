-- Crear la tabla para almacenar el polígono
CREATE TABLE cobertura (
    id INT AUTO_INCREMENT PRIMARY KEY,
    geom POLYGON NOT NULL
);

-- Insertar el polígono en la tabla
INSERT INTO cobertura (geom) VALUES (
    ST_GeomFromText('POLYGON((
        -74.0537967 4.706828, -74.0550198 4.699422, -74.0545782 4.6994764, 
        -74.0539006 4.6994346, -74.0512591 4.698956, -74.0493163 4.6985925, 
        -74.0476916 4.6981478, -74.0451969 4.6973285, -74.0439343 4.6967373, 
        -74.0432036 4.6964491, -74.0414644 4.6961395, -74.0376749 4.695146, 
        -74.0357523 4.6947512, -74.0238774 4.6912262, -74.0203193 4.7014128, 
        -74.0287699 4.7020616, -74.0304902 4.7025676, -74.0337435 4.7036584, 
        -74.0352014 4.7041208, -74.0355221 4.7042571, -74.036772 4.7045031, 
        -74.0376623 4.7043042, -74.0384081 4.704193, -74.0404698 4.7039734, 
        -74.0426872 4.7040676, -74.0433238 4.7041682, -74.0436332 4.7042153, 
        -74.0440992 4.7042831, -74.0444395 4.7043263, -74.0445299 4.7043386, 
        -74.0445572 4.7043335, -74.0456496 4.7045521, -74.0471767 4.7049842, 
        -74.0487079 4.705415, -74.0512439 4.7061272, -74.0525079 4.7064746, 
        -74.0531278 4.7066429, -74.0537967 4.706828))
    ')
);

-- Verificar si un punto está dentro del polígono
SET @longitud = -74.0500;  -- Reemplaza con la longitud deseada
SET @latitud = 4.7000;     -- Reemplaza con la latitud deseada

SELECT 
    CASE 
        WHEN ST_Contains(geom, ST_GeomFromText(CONCAT('POINT(', @longitud, ' ', @latitud, ')'))) THEN 'Dentro' 
        ELSE 'Fuera' 
    END AS resultado
FROM 
    cobertura
WHERE 
    id = 1;  -- Asumiendo que el polígono tiene ID = 1
