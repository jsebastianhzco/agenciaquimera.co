# agenciaquimera.co

🛡️ **Plugin WordPress – Agencia Quimera**

Plugin personalizado desarrollado para WordPress, diseñado como firma digital técnica y panel informativo para sitios web desarrollados por la agencia.

---

## 🎯 ¿Qué hace?

Este plugin añade un panel técnico al dashboard de WordPress con información relevante del sitio:

- Nombre del sitio y URL
- Fecha de desarrollo (basado en la primera página creada)
- Versión de WordPress y PHP
- Theme activo (y detección de child theme)
- Estado del certificado SSL y modo debug
- Detección del plugin Elementor

Además, incluye mejoras visuales en el frontend:

- Footer personalizado en todas las páginas públicas con:
  - Derechos reservados
  - Firma visual de la agencia (logo + texto)
  - Diseño responsive con fuente Jost

---

## ⚙️ CI/CD y Actualizaciones Automáticas

Este plugin incluye integración y despliegue continuo (**CI/CD**) usando **GitHub Actions**, lo que permite que las actualizaciones se desplieguen automáticamente al hacer push en la rama principal.

También integra el componente [Plugin Update Checker](https://github.com/YahnisElsts/plugin-update-checker/releases/tag/v5.6), permitiendo que el plugin verifique actualizaciones desde un repositorio privado de GitHub.

✅ El plugin puede actualizarse automáticamente cuando se instala en sitios de clientes.


---

## 🛡️ Características adicionales

- Protege el plugin para que **no pueda ser desactivado** desde el panel de administración.
- Añade un ícono y estilo visual especial al menú lateral de WordPress.

---

## 💼 Caso de uso

Este plugin es utilizado por **Agencia Quimera** como parte de su flujo de trabajo para desarrollos WordPress, asegurando que todos los sitios lleven firma, branding y metadatos técnicos visibles de forma estandarizada.

---

## 📄 Licencia

Este proyecto está pensado para uso interno. No está publicado en el directorio oficial de plugins de WordPress.
