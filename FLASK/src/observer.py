from sqlalchemy import event, inspect
from sqlalchemy.orm import Session
import os

from .extensions import db
from src.blueprint.core.models import User
from src.blueprint.tools.models import Tool

def register_observer():
    event.listen(Session, 'before_flush', delete_user_tools_before_flush)
    event.listen(Session, 'before_flush', delete_old_tool_images_on_update)
    event.listen(Tool, 'after_delete', after_tool_delete)

def delete_user_tools_before_flush(session, flush_context, instances):
    for obj in session.deleted:
        if isinstance(obj, User):
            tools = Tool.query.filter_by(user_id=obj.id).all()
            for tool in tools:
                if tool.image and os.path.exists(tool.image):
                    os.remove(tool.image)
                session.delete(tool)

def delete_old_tool_images_on_update(session, flush_context, instances):
    for obj in session.dirty:
        if isinstance(obj, Tool):
            state = inspect(obj)
            hist = state.attrs.image.history

            if hist.has_changes():
                old_image = hist.deleted[0] if hist.deleted else None
                if old_image and os.path.exists(old_image):
                    os.remove(old_image)

def after_tool_delete(mapper, connection, target):
    if target.image and os.path.exists(target.image):
        os.remove(target.image)
