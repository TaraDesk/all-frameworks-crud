from flask.cli import with_appcontext
from .extensions import db
from sqlalchemy import MetaData
import click, os

from src.blueprint.tools.models import Tool

def register_commands(app):
    app.cli.add_command(migrate_fresh)
    app.cli.add_command(migrate_clean)


@click.command("migrate_fresh")
@with_appcontext
def migrate_fresh():
    from flask_migrate import upgrade

    meta = MetaData()
    meta.reflect(bind=db.engine)

    meta.drop_all(bind=db.engine)

    upgrade()

@click.command("migrate_clean")
@with_appcontext
def migrate_clean():
    from flask_migrate import upgrade

    meta = MetaData()
    meta.reflect(bind=db.engine)

    for tool in Tool.query.all():
        if tool.image and os.path.exists(tool.image):
            try:
                os.remove(tool.image)
            except Exception as e:
                click.echo(f"Error deleting file {tool.image}: {e}")

    meta.drop_all(bind=db.engine)

    upgrade()