<?php

namespace App\Presenters;

use App\Transformers\MusicTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class MusicPresenter.
 *
 * @package namespace App\Presenters;
 */
class MusicPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new MusicTransformer();
    }
}
