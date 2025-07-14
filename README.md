# agenciaquimera.co

🛡️ **WordPress Plugin – Agencia Quimera**

Custom WordPress plugin developed to serve as a digital signature and technical admin panel for agency-built websites.

---

## 🎯 What does it do?

This plugin adds a technical panel to the WordPress admin dashboard with the following information:

- Site name and URL
- Development date (based on first page created)
- WordPress and PHP version
- Active theme (and child theme detection)
- SSL status and debug mode
- Elementor plugin detection

It also provides the following frontend enhancements:

- Custom footer added to all frontend pages with:
  - Copyright notice
  - Visual signature of the agency (logo + text)
  - Responsive design using the Jost font

---

---

## ⚙️ CI/CD & Auto Updates

This plugin includes continuous integration and deployment using **GitHub Actions**, allowing automatic updates to be deployed when changes are pushed to the main branch.

It also integrates the [Plugin Update Checker](https://github.com/YahnisElsts/plugin-update-checker/releases/tag/v5.6) to enable custom update checking functionality from a private GitHub repository.

✅ Plugin is able to auto-update itself when deployed on client WordPress sites.


## 🛡️ Extra Features

- Protects itself from being disabled from the admin panel.
- Adds a custom icon and visual style to the WordPress admin sidebar.

---

## 💼 Use Case

This plugin is used by **Agencia Quimera** as part of its custom WordPress development workflow, ensuring all websites carry clear authorship, branding, and system metadata in a consistent and visible way.

---

## 📄 License

This project is intended for internal use only. Not published to the WordPress Plugin Directory.
