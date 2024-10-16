CREATE TABLE Curso (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

CREATE TABLE Estudiante (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    curso_id INT,
    FOREIGN KEY (curso_id) REFERENCES Curso(id)
);

CREATE TABLE Evaluacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    calificacion FLOAT DEFAULT NULL,
    curso_id INT,
    FOREIGN KEY (curso_id) REFERENCES Curso(id)
);

CREATE TABLE Pregunta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pregunta_texto VARCHAR(255) NOT NULL,
    tipo ENUM('Sencilla', 'Multiple', 'Abierta') NOT NULL
);

CREATE TABLE Evaluacion_Pregunta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    evaluacion_id INT,
    pregunta_id INT,
    FOREIGN KEY (evaluacion_id) REFERENCES Evaluacion(id),
    FOREIGN KEY (pregunta_id) REFERENCES Pregunta(id)
);

CREATE TABLE Respuesta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    respuesta_texto VARCHAR(255) NOT NULL,
    es_correcta BOOLEAN NOT NULL,
    estudiante_id INT,
    pregunta_id INT,
    FOREIGN KEY (estudiante_id) REFERENCES Estudiante(id),
    FOREIGN KEY (pregunta_id) REFERENCES Pregunta(id)
);
