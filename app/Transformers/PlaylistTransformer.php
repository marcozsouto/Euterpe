<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Playlist;

/**
 * Class PlaylistTransformer.
 *
 * @package namespace App\Transformers;
 */
class PlaylistTransformer extends TransformerAbstract
{
    /**
     * Transform the Playlist entity.
     *
     * @param \App\Entities\Playlist $model
     *
     * @return array
     */
    public function transform(Playlist $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
