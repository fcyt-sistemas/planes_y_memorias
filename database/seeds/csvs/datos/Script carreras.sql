select unidad_academica, carrera, nombre, plan_vigente, tipo_de_carrera, nro_resolucion
from fcyt_basavilbaso:sga_carreras
where estado = 'A'
union
select unidad_academica, carrera, nombre, plan_vigente, tipo_de_carrera, nro_resolucion
from fcyt_chajari:sga_carreras
where estado = 'A'
union
select unidad_academica, carrera, nombre, plan_vigente, tipo_de_carrera, nro_resolucion
from fcyt_crimi:sga_carreras
where estado = 'A'
union
select unidad_academica, carrera, nombre, plan_vigente, tipo_de_carrera, nro_resolucion
from fcyt_diamante:sga_carreras
where estado = 'A'
union
select unidad_academica, carrera, nombre, plan_vigente, tipo_de_carrera, nro_resolucion
from fcyt_oroverde:sga_carreras
where estado = 'A'
union
select unidad_academica, carrera, nombre, plan_vigente, tipo_de_carrera, nro_resolucion
from fcyt_profe:sga_carreras
where estado = 'A'
union
select unidad_academica, carrera, nombre, plan_vigente, tipo_de_carrera, nro_resolucion
from fcyt_seguridad:sga_carreras
where estado = 'A'


select unidad_academica, carrera, nombre, plan_vigente, tipo_de_carrera, nro_resolucion
from fcyt_uruguay:sga_carreras
where estado = 'A'