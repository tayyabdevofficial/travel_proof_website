## 🛠 Installation & Setup
Follow these steps to get the project running locally:

### 1\. Clone the repository
  * git clone https://github.com/tayyabdevofficial/travel_proof_website.git
  * cd travel_proof_website

### 2\. Install Dependencies
  * composer install
  * npm install && npm run build

### 3\. Environment Configuration
Copy the example env file and generate your application key:
  * cp .env.example .env
  * php artisan key:generate

### 4\. Database Setup
Configure your database settings in the `.env` file, then run the migrations:
  * php artisan migrate --seed

### 5\. Start the Server
  * php artisan serve
  * Visit `http://localhost:8000` in your browser.

## 📺 Connect with Me
Portfolio: https://tayyabdev.com/

Built with ❤️ by Tayyab Dev