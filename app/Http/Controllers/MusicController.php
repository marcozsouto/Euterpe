<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\MusicCreateRequest;
use App\Http\Requests\MusicUpdateRequest;
use App\Repositories\MusicRepository;
use App\Validators\MusicValidator;

/**
 * Class MusicController.
 *
 * @package namespace App\Http\Controllers;
 */
class MusicController extends Controller
{
    /**
     * @var MusicRepository
     */
    protected $repository;

    /**
     * @var MusicValidator
     */
    protected $validator;

    /**
     * MusicController constructor.
     *
     * @param MusicRepository $repository
     * @param MusicValidator $validator
     */
    public function __construct(MusicRepository $repository, MusicValidator $validator)
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
        $music = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $music,
            ]);
        }

        return view('music.index', compact('music'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MusicCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MusicCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $music = $this->repository->create($request->all());

            $response = [
                'message' => 'Music created.',
                'data'    => $music->toArray(),
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
        $music = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $music,
            ]);
        }

        return view('music.show', compact('music'));
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
        $music = $this->repository->find($id);

        return view('music.edit', compact('music'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MusicUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MusicUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $music = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Music updated.',
                'data'    => $music->toArray(),
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
                'message' => 'Music deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Music deleted.');
    }
}
