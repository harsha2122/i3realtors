<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait HasAuditLog
{
    protected static function bootHasAuditLog(): void
    {
        static::created(function ($model) {
            static::logAudit('created', $model, [], $model->toArray());
        });

        static::updated(function ($model) {
            $oldValues = array_intersect_key($model->getOriginal(), $model->getDirty());
            static::logAudit('updated', $model, $oldValues, $model->getDirty());
        });

        static::deleted(function ($model) {
            static::logAudit('deleted', $model, $model->toArray(), []);
        });
    }

    protected static function logAudit(string $event, $model, array $oldValues, array $newValues): void
    {
        // Remove sensitive fields
        $sensitiveFields = ['password', 'remember_token', 'api_token'];
        $oldValues = array_diff_key($oldValues, array_flip($sensitiveFields));
        $newValues = array_diff_key($newValues, array_flip($sensitiveFields));

        AuditLog::create([
            'user_id'        => Auth::id(),
            'event'          => $event,
            'auditable_type' => get_class($model),
            'auditable_id'   => $model->getKey(),
            'old_values'     => empty($oldValues) ? null : $oldValues,
            'new_values'     => empty($newValues) ? null : $newValues,
            'ip_address'     => Request::ip(),
            'user_agent'     => Request::userAgent(),
            'url'            => Request::fullUrl(),
        ]);
    }
}
