<?php

namespace App\Observers;

use App\Services\MetaActivity;
use Illuminate\Database\Eloquent\Model;

class ModelActivityObserver
{
    protected function key(Model $model): string
    {
        // default pakai nama tabel
        return method_exists($model, 'metaActivityName')
            ? $model::metaActivityName()
            : $model->getTable();
    }

    public function created(Model $model): void  { MetaActivity::touch($this->key($model)); }
    public function updated(Model $model): void  { MetaActivity::touch($this->key($model)); }
    public function deleted(Model $model): void  { MetaActivity::touch($this->key($model)); }
    public function restored(Model $model): void { MetaActivity::touch($this->key($model)); }
    public function forceDeleted(Model $model): void { MetaActivity::touch($this->key($model)); }
}
