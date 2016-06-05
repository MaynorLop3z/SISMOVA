SELECT Sensor.NombreSensor,Sensor.idVariable,Sensor.Descripcion
FROM Estaciones.Sensor
where Sensor.idArduino=1;
DELETE FROM `Estaciones`.`Arduino` WHERE `idArduino`='5';
DELETE FROM `Estaciones`.`Sensor` WHERE `idSensor`='5';
INSERT INTO `Estaciones`.`Variable` (`NombreVariable`, `Unidad`) VALUES ('Proximidad', 'Metros');
DELETE FROM `Estaciones`.`Variable` WHERE `idVariable`='5';
UPDATE `Estaciones`.`Variable` SET `Descripcion`='Agregar DEscripcion' WHERE `idVariable`='6';
UPDATE `Estaciones`.`Variable` SET `NombreVariable`='Proximidad2', `Unidad`='Metros2', `Descripcion`='Agregar DEscripcion2' WHERE `idVariable`='6';
