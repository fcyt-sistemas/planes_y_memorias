select distinct unidad_academica, carrera, plan, nro_resolucion,cnt_materias, estado
from fcyt_basavilbaso:sga_planes
where estado in ('A','V')
union
select distinct unidad_academica, carrera, plan, nro_resolucion,cnt_materias, estado
from fcyt_chajari:sga_planes
where estado in ('A','V')
union
select distinct unidad_academica, carrera, plan, nro_resolucion,cnt_materias, estado
from fcyt_crimi:sga_planes
where estado  in ('A','V')
union
select distinct unidad_academica, carrera, plan, nro_resolucion,cnt_materias, estado
from fcyt_diamante:sga_planes
where estado in ('A','V')
union
select distinct unidad_academica, carrera, plan, nro_resolucion,cnt_materias, estado
from fcyt_oroverde:sga_planes
where estado in ('A','V')
union
select distinct unidad_academica, carrera, plan, nro_resolucion,cnt_materias, estado
from fcyt_profe:sga_planes
where estado in ('A','V')
union
select distinct unidad_academica, carrera, plan, nro_resolucion,cnt_materias, estado
from fcyt_seguridad:sga_planes
where estado in ('A','V')
union
select distinct unidad_academica, carrera, plan, nro_resolucion,cnt_materias, estado
from fcyt_maestrias:sga_planes
where estado in ('A','V')

//uruguay
select distinct unidad_academica, carrera, plan, nro_resolucion,cnt_materias, estado
from fcyt_uruguay:sga_planes
where estado in ('A','V')