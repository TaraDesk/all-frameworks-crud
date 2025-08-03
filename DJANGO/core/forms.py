import re
from django import forms
from django.core.exceptions import ValidationError
from django.contrib.auth.forms import UserCreationForm

from .models import User

class RegisterForm(UserCreationForm):
    class Meta:
        model = User
        fields = ['name', 'email', 'password1', 'password2']
        labels = {
            'password1': 'Password',
            'password2': 'Password Confirmation',
        }

    def clean_password1(self):
        password = self.cleaned_data.get('password1')

        if not re.search(r'\d', password):
            raise ValidationError("This field must contain at least one number.")

        return password

class LoginForm(forms.Form):
    email = forms.EmailField(max_length=255)
    password = forms.CharField(max_length=255)

class ProfileForm(forms.ModelForm):
    class Meta:
        model = User
        fields = ['name', 'email']