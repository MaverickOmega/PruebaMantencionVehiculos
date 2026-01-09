# PruebaMantencionVehiculos

## Tecnologías usadas

- Laravel 12
- Livewire 3.7
- Livewire Forms
- Eloquent ORM
- SQLite / MySQL
- Blade

## Requisitos

## Instalación

## Decisiones de diseño

### Modulo User

- Se usa el modelo 'User' provisto por Laravel para autenticación.
- Se agregó el atributo 'last_name' como **nullable** para cumplir con los requisitos de CRUD sin afectar el Login/Register.

### Modulo Vehículo

El módulo de vehículos se encuentra **parcialmente implementado**, cubriendo las siguientes funcionalidades:

- Creación de vehículos mediante formularios Livewire.
- Listado de vehículos con información del dueño asociado.
- Validaciones de datos en tiempo real.
- Integridad referencial a nivel de base de datos.

### Relación Usuarios y Vehículos

- Un usuario puede tener uno o más vehículos.
- Cada vehículo pertenece a un único usuario (dueño actual).
- Se implementó una clave foránea 'vehicles.user_id' -> users.id.

### Restricciones de base de datos

- No se permite eliminar un usuario si tiene vehículos asociados ('ON DELETE RESTRICT').

- Si el ID de un usuario cambia, se actualiza en los vehículos ('ON UPDATE CASCADE').

## Funcionalidades implementadas.

- CRUD de usuarios (Create, Read y Update)
  - Crear usuarios con validaciones
  - Listar usuarios
  - Editar usuarios existentes
- Validaciones en tiempo real usando Livewire y Livewire Forms'
- Restricciones de integridad referencial en base de datos.

- CRUD de vehículos (Create, Read y Update):
 - Crear vehículos con validaciones
 - Listar vehículos junto el nombre completo del dueño.
- Validaciones de integridad referencial en base de datos.

### Arquitectura Livewire

- Se usa Livewire Forms para encapsular el estado y las validaciones del formulario de usuarios y vehículos.
- El formulario 'UserForm' centraliza:
 - Estado del formulario ('name', 'last_name', 'email')
 - Reglas de validación
 - Lógica de persistencia para Create y Update

- El formulario 'VehicleForm' centraliza:
 - Estado del formulario ('brand', 'model', 'license_plate', 'year', 'price', 'user_id')
 - Reglas de validación
 - Lógica de persistencia para creación y edición de vehículos
 - Carga de dueños disponibles mediante relaciones Eloquent

Esta separación permite:
- Reducir la responsabilidad de los componentes Livewire ('Create', 'Update').
- Reutilizar validaciones y lógica entre creación y edición.
- Facilitar el mantenimiento y escabilidade del código.

### Validación de edicion de usuarios.

Durante la edición de usuarios, se implementó una validación condicional para el campo email, permitiendo mantener el mismo correo sin disparar la restricción de unicidad. Se logró utilizando reglas de validación dinámicas que ignoran el ID del usuario actual al validar el campo email.

Durante la edición de vehículos, se implementó una validación condicional para el campo license_plate (la patente), permitiendo mantener la misma patente sin disparar la restricción de unicidad. Esto se logró ignorando el ID del vehículo actual en la regla unique.