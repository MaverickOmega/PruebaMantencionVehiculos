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

## Funcionalidades implementadas.

- CRUD de usuarios (Livewire)
  - Crear usuarios con validaciones
  - Listar usuarios
  - Editar usuarios existentes
- Validaciones en tiempo real usando Livewire y Livewire Forms'
- Restricciones de integridad referencial en base de datos.

### Arquitectura Livewire

- Se usa Livewire Forms para encapsular el estado y las validaciones del formulario de usuarios.
- El formulario 'UserForm' centraliza:
 - Estado del formulario ('name', 'last_name', 'email')
 - Reglas de validación
 - Lógica de persistencia para Create y Update

Esta separación permite:
- Reducir la responsabilidad de los componentes Livewire ('Create', 'Update').
- Reutilizar validaciones y lógica entre creación y edición.
- Facilitar el mantenimiento y escabilidade del código.

#### Validación de edicion de usuarios.

Durante la edición de usuarios, se implementó una validación condicional para el campo email, permitiendo mantener el mismo correo sin disparar la restricción de unicidad. Se logró utilizando reglas de validación dinámicas que ignoran el ID del usuario actual al validar el campo email.