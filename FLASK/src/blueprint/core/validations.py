import re
from flask_login import current_user
from flask_wtf import FlaskForm
from wtforms import StringField
from wtforms.validators import DataRequired, ValidationError, Length

from .models import User

class RegisterForm(FlaskForm):
    name = StringField(validators=[DataRequired()])
    email = StringField(validators=[DataRequired()])
    password = StringField(validators=[DataRequired(), Length(min=8)])
    password_confirmation = StringField(validators=[DataRequired()])

    def validate_email(self, field):
        if User.query.filter_by(email=field.data).first():
            raise ValidationError("This field must be unique.")

    def validate_password(self, field):
        if not re.search(r'\d', field.data):
            raise ValidationError("This field must contain at least one number.")

    def validate_password_confirmation(self, field):
        if field.data != self.password.data:
            raise ValidationError("Passwords must match.")

class LoginForm(FlaskForm):
    email = StringField(validators=[DataRequired()])
    password = StringField(validators=[DataRequired()])

class UpdateForm(FlaskForm):
    name = StringField(validators=[DataRequired()])
    email = StringField(validators=[DataRequired()])

    def validate_email(self, field):
        user = current_user
        if user.email != field.data and User.query.filter_by(email=field.data).first():
            raise ValidationError("Email address must be unique.")