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
- Validaciones en tiempo real usando Livewire y Livewire Forms'
- Restricciones de integridad referencial en base de datos.

### Arquitectura Livewire

- Se usa Livewire Forms para encapsular el estado y las validaciones del formulario de usuarios.
- El formulario 'UserForm' centraliza:
 - Estado de los campos ('name', 'last_name', 'email')
 - Reglas de validación
 - Lógica de persistencia ('store')
- El componente Livewire 'Users/Create' delega la lógica del formulario al Form, manteniendo el componente liviano y enfocado en la interacción.