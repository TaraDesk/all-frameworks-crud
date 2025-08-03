<?php

namespace App\Observers;

use App\Models\Tool;
use Illuminate\Support\Facades\Storage;

class ToolObserver
{
    /**
     * Handle the Tool "created" event.
     */
    public function created(Tool $tool): void
    {
        //
    }

    /**
     * Handle the Tool "updated" event.
     */
    public function updated(Tool $tool): void
    {
        if ($tool->wasChanged('image')) {
            $oldImage = $tool->getOriginal('image');

            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }            
        }
    }

    /**
     * Handle the Tool "deleted" event.
     */
    public function deleted(Tool $tool): void
    {
        if ($tool->image) {
            Storage::disk('public')->delete($tool->image);
        }
    }

    /**
     * Handle the Tool "restored" event.
     */
    public function restored(Tool $tool): void
    {
        //
    }

    /**
     * Handle the Tool "force deleted" event.
     */
    public function forceDeleted(Tool $tool): void
    {
        //
    }
}