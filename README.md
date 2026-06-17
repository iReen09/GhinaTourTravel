# PT Ghina Tour Travel — Company Profile & Booking System

A web-based **company profile and tour package catalog/booking system** for **PT Ghina Tour Travel**, built with **Laravel**.

The core problem we set out to solve: travel agencies still rely heavily on manual processes — phone calls, printed brochures, and spreadsheet-based order tracking. This application centralizes everything into one platform, making it easy for potential customers to browse packages and book instantly, while giving the agency a powerful back-office to manage their content without touching any code.

## ✨ Technologies

- `Laravel`
- `PHP`
- `MySQL`
- `Tailwind CSS`
- `Vite`

## 🚀 Features

- Interactive tour package catalog with destination filtering
- Integrated photo & video gallery documentation per tour
- One-click booking via WhatsApp, eliminating phone tag
- Dynamic admin panel for managing packages, facilities, and media assets
- Automatic dummy data seeder with local image generation for instant local setup

## 📍 The Process

**The problem:** Travel agencies lose potential customers because their information is scattered — prices on one sheet, photos on another, bookings via a separate chat. Customers can't self-serve, and agents waste time answering repetitive questions.

**Our approach:** We broke the problem into two user groups and solved for each independently.

For **customers**, we built a clean, browsable catalog so they can explore packages, view real photos and videos, compare inclusions, and initiate a booking — all without needing to contact anyone first.

For **admins**, we eliminated the need for any technical knowledge. The Laravel-powered back-office lets the agency update pricing, swap images, add new destinations, and review incoming orders through a simple dashboard — no code, no FTP, no spreadsheets.

To keep local development frictionless, we also built an automated seeder that generates dummy image files on-the-fly using PHP GD, so the app never looks empty on a fresh setup.

## 🚦 Running the Project

1. Clone the repository
2. Install dependencies: `composer install` & `npm install`
3. Setup environment: `cp .env.example .env` and configure your database credentials
4. Generate app key: `php artisan key:generate`
5. Link storage folder: `php artisan storage:link`
6. Migrate and seed the database: `php artisan migrate:fresh --seed`
7. Start the backend server: `php artisan serve`
8. Start the frontend compiler: `npm run dev`
9. Open `http://localhost:8000` in your browser

## 📦 Preview

<video src="preview.mp4" controls="controls" width="100%">
  Your browser does not support the video tag.
</video>
