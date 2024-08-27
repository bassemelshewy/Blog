# Blog Project

## Overview

This project is a simple blog application built using Laravel. It allows users to register, create, read, update, and delete blog posts and comments. Email notifications are sent using Mailgun when new comments are added to posts. 

## Features

- **User Authentication**: Register and login with secure routes.
- **CRUD Operations**: 
  - **Posts**: Create, read, update, and delete posts.
  - **Comments**: Add and delete comments.
- **Email Notifications**: Notify post authors when a new comment is added.
- **Database Design**: Utilizes Laravel migrations and Eloquent ORM for relationships.

## Requirements

- PHP 8.x
- Laravel 9.x (or the latest version)
- MySQL/PostgreSQL
- Mailgun, SendGrid, or similar
- Git for version control

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/your-username/blog-project.git
   cd blog-project
   
2. **Install Dependencies**

   ```bash
   composer install

3. **Setup Environment File**

   ```bash
   cp .env.example .env

  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=your_database
  DB_USERNAME=your_username
  DB_PASSWORD=your_password
  
  MAIL_MAILER=mailgun
  MAILGUN_DOMAIN=your_domain
  MAILGUN_SECRET=your_mailgun_secret

4. **Generate Application Key**

   ```bash
   php artisan key:generate
   
5. **Run Migrations**

   ```bash
   php artisan migrate

6. **Start the Development Server**

   ```bash
   php artisan serve

## Usage

  1. User Registration and Login
      - Access /register to create a new account.
      - Access /login to log in to an existing account.

  2. Managing Posts
      - **Create**: After logging in, navigate to /posts/create.
      - **Read**: The homepage / will list all posts. Click on a post to view its details.
      - **Update**: Navigate to /posts/{id}/edit to edit a post you created.
      - **Delete**: Use the delete option on your posts list or post detail page.

  3. Managing Comments
      - **Add Comment**: On a post detail page, use the comment form to add comments.
      - **Delete Comment**: You can delete comments you have added from the post detail page.

## Email Notifications

When a new comment is added to a post, an email notification will be sent to the post author. 

**Important**: This project uses a free Mailgun account, which requires you to add and verify authorized recipients before sending emails. Please make sure to configure your Mailgun account accordingly by following these steps:

1. Go to your Mailgun dashboard.
2. Navigate to **Authorized Recipients**.
3. Add and verify the email addresses that should receive notifications.

Ensure Mailgun is configured correctly in your `.env` file with the necessary domain and secret key.



   
