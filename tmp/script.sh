#!/bin/sh

PGPASSWORD=123456 psql -U postgres -h localhost -d pace -w -c "COPY movimiento(cedula, codigo, tipo_movimiento_id, monto, f_contable, f_creacion, usr_creacion) FROM '$1.csv' DELIMITER ';' CSV HEADER;"

echo "proceso exitoso"
