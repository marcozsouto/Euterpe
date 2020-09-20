<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ArtistRepository;
use App\Entities\Artist;
use App\Validators\ArtistValidator;

/**
 * Class ArtistRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ArtistRepositoryEloquent extends BaseRepository implements ArtistRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Artist::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ArtistValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
