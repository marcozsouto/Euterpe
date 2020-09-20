<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Artist;

/**
 * Class ArtistTransformer.
 *
 * @package namespace App\Transformers;
 */
class ArtistTransformer extends TransformerAbstract
{
    /**
     * Transform the Artist entity.
     *
     * @param \App\Entities\Artist $model
     *
     * @return array
     */
    public function transform(Artist $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
