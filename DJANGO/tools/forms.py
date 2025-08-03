from django import forms
from .models import Tool

class CreateForm(forms.ModelForm):
    class Meta:
        model = Tool
        fields = ['name', 'description', 'link', 'image']

class UpdateForm(forms.ModelForm):
    class Meta:
        model = Tool
        fields = ['name', 'description', 'link', 'image']