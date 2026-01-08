# PruebaMantencionVehiculos

Proyecto desarrollado en Laravel 12.

## Requisitos

## Instalación

## Decisiones de diseño

### Modeulo user

- Se usa el modelo 'User' provisto por Laravel para autenticación.
- Se agregó el atributo 'last_name' como **nullable** para cumplir con los requisitos de CRUD sin afectar el Login/Register.

### Relación Usuarios y vehículos

- Un usuario puede tener uno o más vehículos.
- Cada vehículo pertenece a un único usuario (dueño actual).
- Se implementó una clave foránea 'vehicles.user_id' -> users.id.

### Restricciones de base de datos

- No se permite eliminar un usuario si tiene vehículos asociados ('ON DELETE RESTRICT').

- Si el ID de un usuario cambia, se actualiza en los vehículos ('ON UPDATE CASCADE').