<?php

namespace App\Presenters;

use App\Transformers\AlbumTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AlbumPresenter.
 *
 * @package namespace App\Presenters;
 */
class AlbumPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AlbumTransformer();
    }
}
