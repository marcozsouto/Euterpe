<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ArtistCreateRequest;
use App\Http\Requests\ArtistUpdateRequest;
use App\Repositories\ArtistRepository;
use App\Validators\ArtistValidator;

/**
 * Class ArtistsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ArtistsController extends Controller
{
    /**
     * @var ArtistRepository
     */
    protected $repository;

    /**
     * @var ArtistValidator
     */
    protected $validator;

    /**
     * ArtistsController constructor.
     *
     * @param ArtistRepository $repository
     * @param ArtistValidator $validator
     */
    public function __construct(ArtistRepository $repository, ArtistValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $artists = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $artists,
            ]);
        }

        return view('artists.index', compact('artists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArtistCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ArtistCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $artist = $this->repository->create($request->all());

            $response = [
                'message' => 'Artist created.',
                'data'    => $artist->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $artist = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $artist,
            ]);
        }

        return view('artists.show', compact('artist'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artist = $this->repository->find($id);

        return view('artists.edit', compact('artist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ArtistUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ArtistUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $artist = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Artist updated.',
                'data'    => $artist->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Artist deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Artist deleted.');
    }
}
