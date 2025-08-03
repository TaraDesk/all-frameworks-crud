# Flask Framework 

This project is the **Flask** implementation of a basic CRUD application for the all-frameworks-crud collection. In addition to CRUD operations, the project also includes a basic authentication system (login/register) and file upload functionality, offering a complete foundation for typical web applications.

Since HTML forms support only `GET` and `POST`, actions like **update** and **delete** are handled by posting additional hidden fields (`_method`) within the same POST endpoint.

## Requirements

- Python 3.12+
- Flask
- SQLite
- virtualenv

## Installation

### 1. Clone the Main Repository and Navigate to the Flask Subproject

```bash
git clone https://github.com/TaraDesk/all-frameworks-crud.git
```

### 2. Create and Activate a Virtual Environment

```bash
python -m venv venv
source venv/bin/activate
```

### 3. Install Dependencies

```bash
pip install -r requirements.txt
```

### 4. Set Up the Environment

Create a `.env` file to store environment variables, or set them manually. To create the `.env` file, run:

```bash
cd all-frameworks-crud/FLASK
touch .env
```

Then, open the `.env` file and add your environment variables.

```bash
SECRET_KEY=your-secret-key
```

### 5. Initialize the Database

```bash
flask --app src.app db init
flask --app src.app db migrate
flask --app src.app db upgrade
```
### 6. Run the Application

```bash
python main.py
```
Once the server starts, **click the link shown in your terminal** (usually `http://127.0.0.1:5000`) to open the app in your browser.

## Project Structure

| Path                   | Description                                                                          |
| ---------------------- | ------------------------------------------------------------------------------------ |
| `src/app.py`           | Main application entry point                                                         |
| `src/blueprint/core/`  | Contains routes, logic, models, and templates for authentication and user management |
| `src/blueprint/tools/` | Contains routes, logic, models, and templates for tools management                   |
| `templates/`           | Jinja2 templates used for rendering the UI                                           |
| `static/`              | Static assets such as CSS, JavaScript, and uploaded files                            |
| `src/middleware.py`    | Custom middleware definitions                                                        |
| `src/observer.py`      | Custom observer logic                                                                |
| `src/commands.py`      | Custom CLI commands                                                                  |

## Features & Concepts Implemented

| Concept             | Description                                                               |
| ------------------- | ------------------------------------------------------------------------- |
| **Routing**         | Routes use Flask’s `@app.route()` with GET/POST methods only              |
| **Middleware**      | Custom middleware added to match other frameworks |
| **Validation**      | Input validation handled with Flask-WTF               |
| **Error Handling**  | Validation and flash messages displayed in Jinja templates                |
| **Database Access** | Uses Flask SQLAlchemy ORM                                                       |
| **Authentication**  | Basic session-based login and registration using Flask Login                                |
| **File Upload**     | Supports file uploads using Flask’s `request.files` and secure filenames  |

## Available Routes

| Method  | URI               | Description                                        |
|---------|-------------------|----------------------------------------------------|
| GET     | `/`               | Entrance page (login/register)                    |
| POST    | `/login`          | Process login                                     |
| POST    | `/register`       | Process registration                              |
| GET     | `/tools`          | List all tools created by the authenticated user  |
| POST    | `/tools`          | Create a new tool                                 |
| GET     | `/tools/{slug}`   | View a specific tool                              |
| POST    | `/tools/{slug}`   | Update the specified tool                         |
| POST  | `/tools/{slug}`   | Delete the specified tool                         |
| GET     | `/profile`        | Show the user's profile                           |
| POST    | `/profile`        | Update the user's profile                         |
| POST  | `/profile`        | Delete the user's account                         |
| POST    | `/logout`         | Log out the authenticated user                   |

> ⚠️ Note: Since HTML forms support only `GET` and `POST`, `PUT` and `DELETE` actions are handled by posting a hidden `_method` field in POST handlers.

## License

This project is licensed under the MIT License.

## Part of

**[`all-frameworks-crud`](https://github.com/TaraDesk/all-frameworks-crud)** – a multi-framework learning project showing how CRUD patterns work across languages.
