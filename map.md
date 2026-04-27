# Project Analysis: Baladiyati (Multi-Tenant SaaS)

This document provides an overview of the project structure, routes, and core functionality for **Baladiyati**, a multi-tenant SaaS application designed for municipalities.

## 🏗️ Core Architecture
The application follows a **Landlord/Tenant** architecture using `spatie/laravel-multitenancy`.
- **Landlord Domain**: The central management platform (e.g., `baladiyati.test`).
- **Tenant Domains**: Individual platforms for each municipality (e.g., `municipality-name.baladiyati.test`).

---

## 🛤️ Route Map & Functionality

### 1. Landlord Platform (Central Admin)
This domain is used for global administration and tenant management.

| Route | Name | Method | Description |
| :--- | :--- | :--- | :--- |
| `/` | `home` | GET | Landing page for the Baladiyati SaaS platform. |
| `/admin` | `filament.admin.*` | GET/POST | **Filament Admin Panel**: Used by system admins to manage municipalities (Tenants). |
| `/admin/tenants` | `tenants.index` | GET | List and manage all municipality tenants. |

### 2. Tenant Platform (Municipality Sites)
Each municipality has its own isolated space. These routes require a valid tenant session.

| Route | Name | Method | Description |
| :--- | :--- | :--- | :--- |
| `/` | - | GET | Public welcome page for the specific municipality. |
| `/dashboard` | `dashboard` | GET | **Authenticated User Dashboard**: Requires login and email verification. |
| `/settings` | - | GET | Redirects to profile settings. |
| `/settings/profile` | `profile.edit` | GET | **Livewire Component**: Edit user profile information. |
| `/settings/appearance` | `appearance.edit` | GET | **Livewire Component**: Toggle themes and UI appearance. |
| `/settings/security` | `security.edit` | GET | **Livewire Component**: Manage passwords and Two-Factor Authentication (2FA). |

---

## 🛠️ Technology Stack
- **Backend**: Laravel 13
- **Administration**: Filament v5 (Tenant management)
- **Frontend Logic**: Livewire 4
- **UI Components**: Flux UI (Premium component library)
- **Styling**: Tailwind CSS 4
- **Authentication**: Laravel Fortify (Headless auth)
- **Multi-Tenancy**: Spatie Multitenancy (Subdomain-based)

## 📂 Key File Locations
- **Routes**: `routes/web.php` (Landlord/Tenant logic), `routes/settings.php` (User settings).
- **Models**: `app/Models/Tenant.php`, `app/Models/User.php`.
- **Admin Panel**: `app/Filament/Resources/Tenants/`.
- **UI Pages**: `app/Livewire/` (Settings components).
