# Twitter-like Application

A feature-rich Twitter clone built with Laravel and Tailwind CSS, supporting user interactions like tweeting, liking, and retweeting.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## About This Project

This is a full-featured Twitter clone built with Laravel, featuring user authentication, tweet management, and social interactions. The application demonstrates modern web development practices and can be used as a learning resource or a starting point for more complex social media applications.

## Features

- **User Authentication**
  - Secure registration and login
  - Password reset functionality
  - Email verification
  - Profile management

- **Tweet Management**
  - Create, edit, and delete tweets
  - Rich text formatting
  - Image uploads
  - Hashtag support

- **Social Features**
  - Like and unlike tweets
  - Retweet functionality
  - Tweet replies
  - User mentions (@username)
  - Follow/Unfollow users

- **Advanced Features**
  - Real-time notifications
  - Tweet search functionality
  - Responsive design for all devices
  - Tweet analytics
  - User activity feed

## Built With

- [Laravel](https://laravel.com) - The PHP Framework For Web Artisans
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- [Vue.js](https://vuejs.org/) - Progressive JavaScript Framework
- [Alpine.js](https://alpinejs.dev/) - A rugged, minimal framework for composing JavaScript behavior
- [Livewire](https://laravel-livewire.com/) - Full-stack framework for Laravel
- [MySQL](https://www.mysql.com/) - Database Management System
- [Redis](https://redis.io/) - In-memory data structure store

## AI Integration

This project leverages various AI tools to enhance development and user experience:

### Development with AI

1. **Code Generation & Assistance**
   - **GitHub Copilot**: Used for AI-powered code completion and suggestions
   - **Claude.ai**: Helps with code reviews, documentation, and complex problem-solving
   - **ChatGPT**: Assists in generating boilerplate code and explaining complex concepts

2. **Code Quality**
   - **GitHub Copilot X**: For advanced code suggestions and pull request assistance
   - **Amazon CodeWhisperer**: Alternative AI coding companion for security-focused development

3. **Documentation**
   - AI-assisted documentation generation
   - Automated code commenting

### AI-Powered Features

1. **Content Moderation**
   - Automated detection of inappropriate content
   - Sentiment analysis on tweets

2. **User Experience**
   - Smart feed algorithm
   - Personalized content recommendations
   - Automated content summarization

3. **Accessibility**
   - AI-powered alt text generation for images
   - Content readability improvements

## Getting Started

### Prerequisites

- PHP >= 8.1
- Composer (latest version)
- Node.js >= 16.x & NPM >= 8.x
- MySQL >= 8.0 or PostgreSQL >= 13
- Redis (for caching and queues)
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/orquesta_handson.git
   cd orquesta_handson
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Setup**
   - Create a new database
   - Update `.env` with your database credentials
   - Run migrations and seeders
     ```bash
     php artisan migrate --seed
     ```

6. **Compile Assets**
   ```bash
   npm run dev
   # or for production
   # npm run build
   ```

7. **Start the Development Server**
   ```bash
   php artisan serve
   ```

8. **Queue Worker (for background jobs)**
   ```bash
   php artisan queue:work
   ```

9. **Visit the Application**
   Open your browser and visit: [http://localhost:8000](http://localhost:8000)

### Testing

Run the test suite:
```bash
php artisan test
```

### Development with AI Tools

1. **Using GitHub Copilot**
   - Install the GitHub Copilot extension in your IDE
   - Get real-time code suggestions as you type
   - Use `//` to describe what you want to achieve

2. **Using Claude.ai**
   - Great for code reviews and architectural decisions
   - Can help optimize database queries
   - Excellent for generating documentation

3. **Using ChatGPT**
   - Good for generating boilerplate code
   - Helps with debugging error messages
   - Can suggest best practices for Laravel development

### Installation

1. Clone the repository
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Install NPM dependencies:
   ```bash
   npm install
   ```
4. Create a copy of your .env file:
   ```bash
   cp .env.example .env
   ```
5. Generate an app encryption key:
   ```bash
   php artisan key:generate
   ```
6. Configure your database in the .env file
7. Run migrations:
   ```bash
   php artisan migrate
   ```
8. Build assets:
   ```bash
   npm run build
   ```
9. Start the development server:
   ```bash
   php artisan serve
   ```

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

We welcome contributions from the community! To contribute to this project:

1. Fork the repository
2. Create a new branch for your feature (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Code Style
- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard
- Write tests for new features
- Update documentation when necessary
- Keep commits small and focused

### AI-Assisted Development
When using AI tools for development:
- Always review AI-generated code
- Ensure code follows project standards
- Document any AI-generated code sections
- Be mindful of intellectual property rights

Contributions are welcome! Please feel free to submit a Pull Request.

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework For Web Artisans
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- [Vue.js](https://vuejs.org/) - The Progressive JavaScript Framework
- All the amazing open-source packages that made this project possible

## AI Tools Used in Development

- **GitHub Copilot** - For intelligent code completion
- **Claude.ai** - For code reviews and architectural decisions
- **ChatGPT** - For generating documentation and explaining concepts
- **Amazon CodeWhisperer** - For alternative code suggestions

## Support

For support, please open an issue in the GitHub repository or contact the maintainers.

This project is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
