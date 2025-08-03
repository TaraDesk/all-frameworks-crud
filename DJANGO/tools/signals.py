from django.db.models.signals import post_delete, pre_save
from django.dispatch import receiver
import os
from .models import Tool

@receiver(post_delete, sender=Tool)
def delete_image_on_delete(sender, instance, **kwargs):
    if instance.image:
        instance.image.delete(save=False)


@receiver(pre_save, sender=Tool)
def delete_old_image_on_update(sender, instance, **kwargs):
    if not instance.pk:
        return
    try:
        old_file = sender.objects.get(pk=instance.pk).image
    except sender.DoesNotExist:
        return
    new_file = instance.image
    if old_file != new_file and old_file:
        old_file.delete(save=False)
