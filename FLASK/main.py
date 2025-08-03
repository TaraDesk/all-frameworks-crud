import os

from src.app import create_app

flask_app = create_app()

def main():
    flask_app.run(port=int(os.environ.get('PORT', 22)))

if __name__ == "__main__":
    main()
