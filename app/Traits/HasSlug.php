<?php

namespace App\Traits;

use App\Actions\Utility\SlugGenerator;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            $model->generateSlug();
        });

        static::updating(function ($model) {
            $model->generateSlugOnUpdate();
        });
    }

    protected function generateSlug(): void
    {
        $from = static::$slugFrom ?? 'name';
        $to = static::$slugTo ?? 'slug';

        if (! empty($this->{$to})) {
            return;
        }

        if (empty($this->{$from})) {
            return;
        }

        $this->{$to} = SlugGenerator::generate(
            $this->{$from},
            static::class,
            $to
        );
    }

    protected function generateSlugOnUpdate(): void
    {
        $from = static::$slugFrom ?? 'name';
        $to = static::$slugTo ?? 'slug';

        // only regenerate if source changed
        if (! $this->isDirty($from)) {
            return;
        }

        $this->{$to} = SlugGenerator::generate(
            $this->{$from},
            static::class,
            $to
        );
    }
}
