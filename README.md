# All Frameworks Crud

A comprehensive showcase of **CRUD (Create, Read, Update, Delete)** implementations across various programming languages and frameworks.  
This project aims to provide developers with quick reference examples for building CRUD apps in popular tech stacks.

## Purpose

The goal of this repository is to:
- Demonstrate how CRUD operations are handled in different frameworks.
- Help developers compare patterns, syntax, and structure across ecosystems.
- Serve as a reference for beginners and experienced developers alike.

## Shared Architectural Concepts

To ensure consistency and comparability, every subproject will follow a **common architectural approach** whenever possible, implementing the same core concepts across frameworks:

| Concept         | Description                                                                 |
|----------------|-----------------------------------------------------------------------------|
| **Routing**     | Clean route structure that maps to basic CRUD operations, using GET/POST methods where needed                          |
| **Middleware**  | Framework-specific request/response middleware  |
| **Observer/Events** | Simple event handling or observer pattern usage   |
| **Validation**  | Input validation layer before DB actions                                    |
| **Error Handling** | Centralized error handling strategy                                      |
| **Database Access** | Basic ORM/Query builder usage                                           |
| **Authentication** | Each project includes a basic login/register flow |
| **File Upload**    | Supports uploading and storing files        |

Even though HTTP method support may vary (some use only GET/POST), each subproject simulates full CRUD (Create, Read, Update, Delete) behavior — sometimes via extra input fields or hidden method values in forms.

## Structure

Each folder corresponds to a language/framework combo and contains a basic CRUD implementation.
Each subproject contains Minimal working example and Instructions to run

## Included Frameworks

| Language   | Framework            | Status         |
| ---------- | -------------------- | -------------- |
| Python     | Django               | ✅ Completed    |
| Python     | Flask                | ✅ Completed    |
| PHP        | Laravel              | ✅ Completed    |
| JavaScript | SvelteKit + Supabase | 🕓 Coming Soon |
| Java       | Spring Boot          | 🕓 Coming Soon |

## How to Use

Each folder contains its own `README.md` with setup and usage instructions.

## Inspiration

This project is inspired by the desire to unify learning paths across stacks, reduce boilerplate, and accelerate onboarding for new tools and languages.

## License

This project is licensed under the MIT License.