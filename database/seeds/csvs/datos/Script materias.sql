
select unidad_academica, materia, nombre, tipo_de_materia, promovible, requiere_cursada, permite_libres,carga_horaria_tot,tipo_de_periodo,horas_semanales
from fcyt_basavilbaso:sga_materias
where estado in ('A')
union
select unidad_academica, materia, nombre, tipo_de_materia, promovible, requiere_cursada, permite_libres,carga_horaria_tot,tipo_de_periodo,horas_semanales
from fcyt_chajari:sga_materias
where estado in ('A')
union
select unidad_academica, materia, nombre, tipo_de_materia, promovible, requiere_cursada, permite_libres,carga_horaria_tot,tipo_de_periodo,horas_semanales
from fcyt_crimi:sga_materias
where estado  in ('A')
union
select unidad_academica, materia, nombre, tipo_de_materia, promovible, requiere_cursada, permite_libres,carga_horaria_tot,tipo_de_periodo,horas_semanales
from fcyt_diamante:sga_materias
where estado in ('A')
union
select unidad_academica, materia, nombre, tipo_de_materia, promovible, requiere_cursada, permite_libres,carga_horaria_tot,tipo_de_periodo,horas_semanales
from fcyt_oroverde:sga_materias
where estado in ('A')
union
select unidad_academica, materia, nombre, tipo_de_materia, promovible, requiere_cursada, permite_libres,carga_horaria_tot,tipo_de_periodo,horas_semanales
from fcyt_profe:sga_materias
where estado in ('A')
union
select unidad_academica, materia, nombre, tipo_de_materia, promovible, requiere_cursada, permite_libres,carga_horaria_tot,tipo_de_periodo,horas_semanales
from fcyt_seguridad:sga_materias
where estado in ('A')
union
select unidad_academica, materia, nombre, tipo_de_materia, promovible, requiere_cursada, permite_libres,carga_horaria_tot,tipo_de_periodo,horas_semanales
from fcyt_maestrias:sga_materias
where estado in ('A')

select unidad_academica, materia, nombre, tipo_de_materia, promovible, requiere_cursada, permite_libres,carga_horaria_tot,tipo_de_periodo,horas_semanales
from fcyt_uruguay:sga_materias
where estado in ('A')
