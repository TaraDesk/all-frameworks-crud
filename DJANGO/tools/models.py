import uuid, re
from django.contrib.auth import get_user
from django.db import models

def slugify(text):
    slug = re.sub(r'[^\w\s-]', '', text).strip().lower()
    slug = re.sub(r'[\s_-]+', '-', slug)
    unique_id = str(uuid.uuid4())[:8]
    slug = f"{slug}-{unique_id}"
    return slug

def generate_unique_filename(instance, filename):
    ext = filename.split('.')[-1]
    unique_name = str(uuid.uuid4())
    new_filename = f'{unique_name}.{ext}'
    return new_filename

class Tool(models.Model):
    id = models.BigAutoField(primary_key=True)
    user_id = models.ForeignKey("core.User", verbose_name="User", on_delete=models.CASCADE)
    name = models.CharField(max_length=255)
    description = models.TextField()
    link = models.URLField()
    slug = models.SlugField(max_length=255)
    image = models.ImageField(upload_to=generate_unique_filename)
    created_at = models.DateTimeField(auto_now_add=True)
    updated_at = models.DateTimeField(auto_now=True)

    def save(self, *args, **kwargs):
        unique_id = uuid.uuid4().hex[:8]
        if self.pk:
            orig = type(self).objects.get(pk=self.pk)
            if orig.name != self.name:
                self.slug = slugify(self.name)
        else:
            self.slug = slugify(self.name)
        super().save(*args, **kwargs)