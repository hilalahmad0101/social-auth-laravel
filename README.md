# 🔐 Laravel Social Authentication

A complete Laravel application demonstrating social login integration with multiple providers including Google, GitHub, Discord, Facebook, and more using Laravel Socialite.

## ✨ Features

- 🚀 **Multiple Social Providers**: Google, GitHub, Discord, Facebook, Twitter, LinkedIn
- 👥 **User Management**: Automatic user creation and linking
- 🎨 **Clean UI**: Beautiful login interface with provider buttons
- 🔄 **Account Linking**: Link multiple social accounts to one user
- ⚡ **Fast Setup**: Easy configuration and deployment

## 🛠️ Technologies Used

- **Laravel 10+**
- **Laravel Socialite**
- **MySQL/PostgreSQL**
- **Tailwind CSS**
- **Blade Templates**

## 📋 Prerequisites

- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL/PostgreSQL database

## 🚀 Quick Start

### 1. Clone the Repository

```bash
git clone https://github.com/hilalahmad0101/social-auth-laravel.git
cd social-auth-laravel
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install NPM dependencies
npm install && npm run dev
```

### 3. Environment Setup

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=social_auth_laravel
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Run migrations:

```bash
php artisan migrate
```

### 5. Social Provider Configuration

Add your social provider credentials to `.env`:

```env
# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback

# GitHub OAuth
GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_REDIRECT_URI=http://localhost:8000/auth/github/callback

# Discord OAuth
DISCORD_CLIENT_ID=your_discord_client_id
DISCORD_CLIENT_SECRET=your_discord_client_secret
DISCORD_REDIRECT_URI=http://localhost:8000/auth/discord/callback

# Facebook OAuth
FACEBOOK_CLIENT_ID=your_facebook_client_id
FACEBOOK_CLIENT_SECRET=your_facebook_client_secret
FACEBOOK_REDIRECT_URI=http://localhost:8000/auth/facebook/callback

# Linkedin OAuth
LINKEDIN_CLIENT_ID=linkedin_client_id
LINKEDIN_CLIENT_SECRET=linkedin_client_secret
LINKEDIN_REDIRECT_URI=http://localhost:8000/auth/facebook/callback
```

### 6. Run the Application

```bash
php artisan serve
```

Visit `http://localhost:8000` and start using social authentication!

## 🔧 Setting Up Social Providers

### Google OAuth Setup

1. Go to [Google Cloud Console](https://console.cloud.google.com/)
2. Create a new project or select existing
3. Enable Google+ API
4. Create OAuth 2.0 credentials
5. Add authorized redirect URIs

### GitHub OAuth Setup

1. Go to [GitHub Developer Settings](https://github.com/settings/developers)
2. Create a new OAuth App
3. Set Authorization callback URL to `http://your-domain.com/auth/github/callback`

### Discord OAuth Setup

1. Go to [Discord Developer Portal](https://discord.com/developers/applications)
2. Create a new application
3. Go to OAuth2 settings
4. Add redirect URI: `http://your-domain.com/auth/discord/callback`

### Facebook OAuth Setup

1. Go to [Facebook for Developers](https://developers.facebook.com/)
2. Create a new app
3. Add Facebook Login product
4. Configure Valid OAuth Redirect URIs

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/Auth/
│   │   ├── GoogleAuthController.php
│   │   ├── GitHubController.php
│   │   ├── DiscordController.php
│   │   └── FacebookController.php
│   └── Models/
│       └── User.php
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       ├── auth/
│       └── dashboard/
├── routes/
│   └── web.php
└── config/
    └── services.php
```

## 🎯 How It Works

1. **User clicks social login button** → Redirects to provider's OAuth page
2. **User authorizes the app** → Provider redirects back with authorization code
3. **App exchanges code for access token** → Gets user information from provider
4. **User creation/linking** → Creates new user or links to existing account
5. **Authentication** → Logs user into the application

## 🔐 Security Features

- ✅ Secure Token Handling
- ✅ Account Linking Prevention for Security

## 🎨 UI Features

- Responsive design with Tailwind CSS
- Error handling and user feedback
- Clean and modern interface

## 📱 Screenshots

*Add screenshots of your application here*

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙋‍♂️ Author

**Hilal Ahmad**
- GitHub: [@hilalahmad0101](https://github.com/hilalahmad0101)
- LinkedIn: [Connect with me](https://linkedin.com/in/hilal-ahmad)

## ⭐ Show Your Support

Give a ⭐ if this project helped you!

## 📞 Support

If you have any questions or need help, feel free to:
- Open an issue on GitHub
- Contact me on LinkedIn
- Send an email

---

**Happy Coding! 🚀**
