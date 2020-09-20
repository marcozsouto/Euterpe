<?php

namespace App\Presenters;

use App\Transformers\PlaylistTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PlaylistPresenter.
 *
 * @package namespace App\Presenters;
 */
class PlaylistPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PlaylistTransformer();
    }
}
