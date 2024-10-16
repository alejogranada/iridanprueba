--Query para obtener la calificación de todos los estudiantes que presentaron una evaluación
SELECT 
    e.id AS estudiante_id,
    e.nombre AS estudiante_nombre,
    ev.id AS evaluacion_id,
    ev.fecha AS evaluacion_fecha,
    ev.calificacion
FROM 
    Estudiante e
JOIN 
    Respuesta r ON e.id = r.estudiante_id
JOIN 
    Evaluacion ev ON r.pregunta_id IN (
        SELECT pregunta_id 
        FROM Evaluacion_Pregunta 
        WHERE evaluacion_id = ev.id
    )
GROUP BY 
    e.id, ev.id
ORDER BY 
    e.id, ev.id;
