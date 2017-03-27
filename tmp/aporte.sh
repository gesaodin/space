#!/bin/sh

echo "Iniciando el proceso de inserción en PostgresQL"
psql -U postgres -h localhost -d pace_produccion -c \
"COPY movimiento(cedula, codigo, tipo_movimiento_id, monto, f_contable, f_creacion, usr_creacion) \
FROM '/home/crash/space/tmp/203ca9b8.csv' DELIMITER ';' CSV HEADER;
"

echo "------------------------------------------------"
echo ""
echo "Proceso finalizado..."

