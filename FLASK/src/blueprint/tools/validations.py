from flask_wtf import FlaskForm
from wtforms import StringField
from flask_wtf.file import FileField, FileAllowed, FileRequired
from wtforms.validators import DataRequired, ValidationError, URL

from .models import Tool

class CreateTool(FlaskForm):
    name = StringField(validators=[DataRequired()])
    description = StringField(validators=[DataRequired()])
    image = FileField(validators=[FileRequired(), FileAllowed(['jpg', 'png'])])
    link = StringField(validators=[DataRequired(), URL()])

class UpdateTool(FlaskForm):
    name = StringField(validators=[DataRequired()])
    description = StringField(validators=[DataRequired()])
    image = FileField(validators=[FileAllowed(['jpg', 'png'])])
    link = StringField(validators=[DataRequired(), URL()])