# Word Puzzle API

## Project Overview

Word Puzzle API is a backend service developed in Laravel that enables the generation of word-based puzzles, validates user solutions, and maintains a leaderboard of the best results. This API provides functionalities such as creating new games, submitting solutions, viewing the leaderboard, and retrieving the results of a specific game.

## Features

- **Register and Login**: Firstly, you need to register that you can use other features
- **Game Generation**: Creates a random sequence of letters that always contains at least one valid English word.
- **Solution Validation**: Checks whether the submitted word is a valid English word and can be formed using the available letters.
- **Leaderboard**: Maintains a list of the top 10 unique words with the highest scores.
- **Game Results**: Displays the current status of the game, total score, and remaining valid words.

## Setup Instructions

This project uses Docker for easy setup and execution.

### Prerequisites

- **Docker** (version 20.10 or later)
- **Docker Compose** (version 1.29 or later)

### Installation Steps

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/Andraaaa/word-puzzle.git
   cd word-puzzle
   ```

2. **Copy the `.env` file**:
   ```bash
   cp .env.example .env
   ```
   Ensure that the parameters in the `.env` file are correctly set.

3. **Start Docker Containers**:
   ```bash
   docker-compose up -d
   ```
   This command will start the application and its associated services in Docker containers.

4. **Run Migrations and Seeders**:
   ```bash
   docker-compose exec app php artisan migrate
   ```
   This command will create the necessary database tables and populate them with initial data.

5. **Access the Application**:
   The application will be available at `http://localhost:8000`.

## Approach and Rationale

1. **Using Docker**: Docker provides a consistent and isolated environment for the application, making setup and development easier.

2. **Laravel Framework**: Laravel offers a robust set of tools and functionalities that accelerate development and maintainability.

3. **SOLID Principles**: Adhering to SOLID principles contributes to scalability and easier code maintenance.

4. **Repository Pattern**: This pattern abstracts data access, making testing easier and allowing potential changes in how data is stored.

5. **Test-Driven Development (TDD)**: Writing tests before implementing features ensures the application functions correctly and reduces the likelihood of errors.

## API Endpoints

- **Register**: `POST /api/register`
- **Login**: `POST /api/login`
- **Logout**: `POST /api/logout`
- **Create a New Game**: `POST /api/game`
- **Submit a Solution**: `POST /api/submission`
- **View the Leaderboard**: `GET /api/leaderboard`
- **Retrieve Game Results**: `GET /api/game/{gameId}/result`

For detailed information on each endpoint, including required parameters and response structures, refer to the API documentation.

## Running Tests

To execute the test suite, use the following command:

```bash
docker-compose exec app php artisan test
```

This command will run all tests and display the results.

## Conclusion

This project uses Docker for seamless setup and execution, ensuring a consistent development environment. The use of the Laravel framework, along with SOLID principles and the Repository pattern, enhances code scalability and maintainability. A test-driven development (TDD) approach ensures that the application meets expectations and minimizes errors.

