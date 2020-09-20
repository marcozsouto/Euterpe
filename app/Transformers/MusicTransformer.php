<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Music;

/**
 * Class MusicTransformer.
 *
 * @package namespace App\Transformers;
 */
class MusicTransformer extends TransformerAbstract
{
    /**
     * Transform the Music entity.
     *
     * @param \App\Entities\Music $model
     *
     * @return array
     */
    public function transform(Music $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
