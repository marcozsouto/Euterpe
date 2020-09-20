<?php

namespace App\Presenters;

use App\Transformers\ArtistTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ArtistPresenter.
 *
 * @package namespace App\Presenters;
 */
class ArtistPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ArtistTransformer();
    }
}
