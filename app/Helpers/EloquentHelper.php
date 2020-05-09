<?php
namespace App\Helpers;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class EloquentHelper
{
    public function saveUnique(Model $model, Closure $setter, $tries = 10)
    {
        return $this->trySaveUnique($model, $setter, $tries);
    }

    private function trySaveUnique(
        Model $model,
        Closure $setter,
        $maxTries,
        $tryCount = 1
    ) {
        $updated = $setter($model);
        $model = $updated ?? $model;
        try {
            $model->save();
        } catch (QueryException $e) {
            if (($e->errorInfo[1] ?? null) !== 1062) {
                throw $e;
            }

            // 規定回数失敗したら何かわからんけど諦める
            if ($tryCount > $maxTries) {
                throw $e;
            }

            // 重複エラーの場合は再実行する
            return $this->trySaveUnique(
                $model,
                $setter,
                $maxTries,
                $tryCount + 1
            );
        }

        return $model;
    }
}
